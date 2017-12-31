<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Date;
use Excel;
use App\Models\Participant;
use App\Models\Preference;
use App\Models\ParticipantInterview;

define('__EVENT_ID__', 11006);


class ParticipantsController extends Controller
{

  public function show(){
    return view('dashboard.participants.manage')->with([
      'participants' => Participant::where('event_id', __EVENT_ID__)->get()->all(),

    ]);
  }

  public function export(){
    $participants = Participant::where('event_id', __EVENT_ID__)->get()->all();
    $ex_participants = [];
    foreach ($participants as $participant) {
      $education = $participant->user->educationalInformation->academic_year->name;
      if($participant->user->educationalInformation->department)
        $education .=  " - " . $participant->user->educationalInformation->department->name;
      $education .= ", " . $participant->user->educationalInformation->college->name . " - " . $participant->user->educationalInformation->uni->name;
      $preferences = [];
      foreach($participant->preferences as $preference)
        $preferences[] = $preference->name;
      $state = "Waiting";
      if($participant->interview)
        if($participant->participantInterview->result == NULL) $state = "Waiting";
        elseif($participant->participantInterview->result == 1) $state = "Accepted";
        else $state = "Rejected";
      $ex_participants[] = [
        'Participant ID' => $participant->id,
        'Date' => ($participant->interview) ? Date::format($participant->interview->date, "interview") : "N/A",
        'Name' => $participant->user->name,
        'Email' => $participant->user->email,
        'Mobile' => $participant->user->mobile->number,
        'Education' => $education,
        'Preferences' => implode(", ", $preferences),
        'State' => $state,
        'Old Member' => count($participant->user->memberHistories) > 0 ? "YES" : "NO"
      ];
    }

    Excel::create("Participants " . date('l d/m/Y', time()), function($excel) use($ex_participants) {
      $excel->sheet('Participants', function($sheet) use($ex_participants) {
        $sheet->fromArray($ex_participants);
      });
    })->download('xlsx');
  }

  public function state(Request $request){
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
