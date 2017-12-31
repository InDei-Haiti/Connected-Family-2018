<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Date;
use Excel;
use Validator;
use App\Models\Preference;
use App\Models\Participant;
use App\Models\InterviewDate;
use App\Models\ParticipantInterview;
use App\Models\ParticipantPreference;

class RecruitmentController extends Controller
{

  public function showInterveiws(){
    $user = Auth::user();
    $committee_id = $user->memberHistories[0]->committee_id;
    $committee_preference = [
      70101 => 12080, // IT
      70104 => 12081, // L&R
      70105 => 12079, // FR
      70106 => 12082, // PR
      70107 => 12078, // AC
      70108 => 12076, // PM
      70109 => 12084, // HRM
      70110 => 12083, // M&P
      70111 => 12077, // Marketing
    ];
    $preference_id = $committee_preference[$committee_id];
    $interview_dates = InterviewDate::where('preference_id', $preference_id)->get()->all();
    return view('dashboard.recruitment.interviews')->with([
      'interview_dates' => $interview_dates,
      
    ]);
  }

  public function showParticipants(){
    $user = Auth::user();
    $committee_id = $user->memberHistories[0]->committee_id;
    $committee_preference = [
      70101 => 12080, // IT
      70104 => 12081, // L&R
      70105 => 12079, // FR
      70106 => 12082, // PR
      70107 => 12078, // AC
      70108 => 12076, // PM
      70109 => 12084, // HRM
      70110 => 12083, // M&P
      70111 => 12077, // Marketing
    ];
    $preference_id = $committee_preference[$committee_id];
    $participation_preferences = ParticipantPreference::where('preference_id', $preference_id)->get()->all();
    $participants = [];
    if($participation_preferences)
      foreach($participation_preferences as $p)
        $participants[] = $p->participant;
    return view('dashboard.recruitment.participants')->with([
      'participants' => $participants,
      're_preference_id' => $preference_id,

    ]);
  }

  public function doExportParticipants(){
    $user = Auth::user();
    $committee_id = $user->memberHistories[0]->committee_id;
    $committee_preference = [
      70101 => 12080, // IT
      70104 => 12081, // L&R
      70105 => 12079, // FR
      70106 => 12082, // PR
      70107 => 12078, // AC
      70108 => 12076, // PM
      70109 => 12084, // HRM
      70110 => 12083, // M&P
      70111 => 12077, // Marketing
    ];
    $preference_id = $committee_preference[$committee_id];
    $participation_preferences = ParticipantPreference::where('preference_id', $preference_id)->get()->all();
    $participants = [];
    if($participation_preferences)
      foreach($participation_preferences as $p)
        $participants[] = $p->participant;
    $ex_participants = [];
    foreach ($participants as $participant) {
      if($participant->preferences[0]->id != $preference_id) continue;
      $education = $participant->user->educationalInformation->academic_year->name;
      if($participant->user->educationalInformation->department)
        $education .=  " - " . $participant->user->educationalInformation->department->name;
      $education .= ", " . $participant->user->educationalInformation->college->name . " - " . $participant->user->educationalInformation->uni->name;
      $preferences = [];
      foreach($participant->preferences as $preference)
        $preferences[] = $preference->name;
      $state = "Waiting. NO IV.";
      if($participant->interview) {
        if($participant->participantInterview->result == NULL) 
          $state = "Waiting";
        else if($participant->participantInterview->result == 1)
          $state = "Accepted for " . $participant->participantInterview->preference->name;
        else
          $state = "Rejected";        
      }
      $ex_participants[] = [
        'Participant ID' => $participant->id,
        'Date' => ($participant->interview) ? Date::format($participant->interview->date, "interview") : "N/A",
        'Name' => $participant->user->name,
        'Email' => $participant->user->email,
        'Mobile' => $participant->user->mobile->number,
        'Education' => $education,
        'Facebook' => $participant->user->socialLink("facebook") ? $participant->user->socialLink("facebook") : "N/A",
        'Preferences' => implode(", ", $preferences),
        'Old Member' => count($participant->user->memberHistories) > 0 ? "YES" : "NO",
        'State' => $state
      ];          
    }

    Excel::create("Participants " . Date::format(Date::now(), "interview"), function($excel) use($ex_participants) {
      $excel->sheet('Sheet 1', function($sheet) use($ex_participants) {
        $sheet->fromArray($ex_participants);
      });
    })->download('xlsx');
  }

  public function doInterviewDelete(Request $request){
    $validator = Validator::make($request->all(), [
      'interview' => 'required|exists:interview_dates,id',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $interview_date = InterviewDate::find($request->input('interview'));
    // add closed event constraint!
    if($interview_date->taken > 0){
      $interview_date->available = false;
      if($interview_date->save())
        return response()->json(['state' => 'success']);
    } else if($interview_date->delete())
        return response()->json(['state' => 'success']);
    return response()->json(['state' => 'something']);
  }

  public function stateParticipant(Request $request){
    $participant = Participant::find($request->input('id'));
    if(!$participant) 
      return response()->json(['state' => 'failed', 'msg' => "[EP01] Participant is not found!"]);
    if($request->input('for') == 'iv'){
      $piv = $participant->interview;
      if(!$piv) return response()->json(['state' => 'failed', 'msg' => "[EP02] Participant has no interview date selected!"]);
      if($request->input('state') == 1){
        $rPreference = Preference::find($request->input('prefId'));
        if(!$rPreference)
          return response()->json(['state' => 'failed', 'msg' => "[EP03] Preference not found!"]);
      }
      $piv = ParticipantInterview::where('participant_id', $participant->id)->get()->first();
      $piv->result = $request->input('state');
      $piv->preference_id = $request->input('state') ? $request->input('prefId') : NULL;
      $piv->save();
      return response()->json([
        'state' => 'success',
        'button_id' => $participant->id,
        'button_state' => $request->input('state') == '1' ? 0 : 1,
        'button_for' => $request->input('for'),
        'prefId' => $request->input('prefId'),
        'prefName' => $request->input('state') ? $rPreference->name : ''
        ]);
    } else return response()->json(['state' => 'failed', 'msg' => "[EP04] Under Construction!"]);
  }

}
