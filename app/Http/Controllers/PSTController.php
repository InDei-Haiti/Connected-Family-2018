<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participant;
use App\Models\ParticipantPst;
use App\Models\PstAnswer;

class pstController extends Controller
{
  public function show(){
    // check, login?
    if(!session()->has('connected-family-session-participation-id')){
      session()->flash('notSignin', true);
      return redirect()->route('sign-in');
    }
    $participant = Participant::find(session()->get('connected-family-session-participation-id'));
    // check pst accessability uni level
    if($participant->user->educationalInformation->uni->id == __DB_ASU_UNI_ID__)
      return redirect()->route('participant-index');
    // check pst accessability pref level
    $group_discussion_pref = false;
    foreach ($participant->preferences as $preference)
      if($preference->id != __DB_NOT_PST_PREF_ID__)
        $group_discussion_pref = true;
    if(!$group_discussion_pref)
      return redirect()->route('participant-index');
    // check, takes pst?
    if($participant->pst)
      if($participant->pst->degree !== NULL)
        return redirect()->route('participant-index');
    // show PST
    $mins = 29; $secs = 59;
    if($participant->pst) {
      $reminder = $participant->pst->end_at - time();
      $mins = floor($reminder/60);
      $secs = $reminder%60;
    }
    return view('pst')->with(['log_exist' => $participant->pst,'mins' => $mins, 'secs' => $secs]);

  }

  public function end(Request $request){
    if(!session()->has('connected-family-session-participation-id'))
      return response()->json(['state' => 'failed', 'redirectTo' => "/"]);
    $participant = Participant::find(session()->get('connected-family-session-participation-id'));
    $timeNow = time();
    if(!$participant->pst){
      $participantPST = new ParticipantPst;
      $participantPST->participant_id = $participant->id;
      $participantPST->start_at = $timeNow;
      $participantPST->end_at = $timeNow + (30 * 60);
      $participantPST->save();
    }
    // regenerate participant 
    $participant = Participant::find(session()->get('connected-family-session-participation-id'));
    if($timeNow >= $participant->pst->end_at || $request->input('done') == 'yes'){
      $degree = 0;
      for($i = 1; $i <= 25; $i++){
        $pstAnswer = PstAnswer::where('question', $i)->get()->first();
        if($request->input('ans_'.$i) == $pstAnswer->answer)
          $degree++;
      }
      $participantPST = ParticipantPst::where('participant_id', $participant->id)->get()->first();
      $participantPST->degree = $degree;
      $participantPST->save();
      return response()->json(['state' => 'redirect', 'redirectTo' => '/participant']);
    }
    if($timeNow < $participant->pst->end_at){
      return response()->json(['state' => 'success']);
    }
  }

}
