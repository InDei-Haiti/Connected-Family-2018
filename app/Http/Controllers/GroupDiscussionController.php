<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupDiscussionController extends Controller
{

  public function show(){
    if(!session()->has('connected-family-session-participation-id')){
      session()->flash('notSignin', true);
      return redirect()->route('sign-in');
    }
    $participant = Participant::find(session()->get('connected-family-session-participation-id'));
    // check group discussion accessability uni level
    if($participant->user->educationalInformation->uni->id != __DB_ASU_UNI_ID__)
      return redirect()->route('participant-index');
    // check group discussion accessability pref level
    $group_discussion_pref = false;
    foreach ($participant->preferences as $preference)
      if($preference->id != __DB_NOT_GD_PREF_ID__)
        $group_discussion_pref = true;
    if(!$group_discussion_pref)
      return redirect()->route('participant-index');
    $groupDiscussionDates = GroupDiscussionDate::where('event_id', __EVENT_ID__)
                                    ->where('available', 1)
                                    ->get()->all();
    return view('forms.group_discussion-date-selection')->with([
      'groupDiscussionDates' => $groupDiscussionDates,
      'participant' => $participant
    ]);
  }

  public function select(Request $request){
    if(!session()->has('connected-family-session-participation-id')){
      session()->flash('notSignin', true);
      return redirect()->route('sign-in');
    }
    $validator = Validator::make($request->all(), [
      'gd' => 'required|exists:group_discussion_dates,id',
    ],[
      'gd.exists' => __GD_DB_NOT_EXIST__
    ]);
    // response errors
    if ($validator->fails()) return response()->json(['state' => 'failed', 'response' => $validator->errors()]);
    $groupDiscussionDate = GroupDiscussionDate::find($request->input('gd'));
    if($groupDiscussionDate->taken >= $groupDiscussionDate->max)
      return response()->json(['state' => 'failed', 'response' => ['gd' => __GD_IS_FULL__]]);
    if($groupDiscussionDate->available == '0')
      return response()->json(['state' => 'failed', 'response' => ['gd' => __GD_IS_NOT_AVAILABLE__]]);
    $participant_id = session()->get('connected-family-session-participation-id');
    // check if take group discussion !!
    if(ParticipantGroupDiscussion::where('participant_id', $participant_id)->get()->first())
      return response()->json(['state' => 'failed', 'response' => ['gd' => __GD_IS_SELECTED__]]);
    $participantGroupDiscussion = new ParticipantGroupDiscussion;
    $participantGroupDiscussion->participant_id = $participant_id;
    $participantGroupDiscussion->group_discussion_date_id = $request->input('gd');
    $participantGroupDiscussion->save();
    $groupDiscussionDate->taken += 1;
    $groupDiscussionDate->save();
    return response()->json(['state' => 'success', 'redirectTo' => "/participant/select/group_discussion-date"]);
  }



}
