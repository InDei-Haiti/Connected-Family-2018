<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Auth;
use Date;
use App\Models\Event;
use App\Models\InterviewDate;
use App\Models\ParticipantInterview;

class InterviewController extends Controller
{

  public function show($event){
    if(!$user = Auth::user())
      return Auth::redirectToLogin('Please, Login (or Register from link below) first to be able to register in our current event.');
    $exploded = explode('-', $event);
    if(!$event = Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first())
      return view('errors.404');
    if(!$participant = $user->participation($event))
      return redirect()->route('event-registration', ['event' => $event->name . "-" . $event->year]);
    if(!$user->isAbleToRegister())
      return redirect()->route('event-registration', ['event' => $event->name . "-" . $event->year]);
    /*
     * Code to be here
     *    Check if participant is allowed to select/update interview!
     */
    $db_interview_dates = array_merge(InterviewDate::where('event_id', $event->id)
                                                   ->where('date', '>', Date::now())
                                                   ->whereRaw('taken < max')
                                                   ->where('available', true)
                                                   ->where('preference_id',
                                                           $participant->preferences[0]->id)
                                                   ->orderBy('date', 'asc')
                                                   ->get()->all(),
                                      InterviewDate::where('event_id', $event->id)
                                                   ->where('date', '>', Date::now())
                                                   ->whereRaw('taken < max')
                                                   ->where('available', true)
                                                   ->whereNull('preference_id')
                                                   ->orderBy('date', 'asc')
                                                   ->get()->all());
    if($participant->interview && !in_array($participant->interview, $db_interview_dates))
      $db_interview_dates = array_merge($db_interview_dates, [$participant->interview]);
    return view('event.interview')->with([
      'event' => $event,
      'participant' => $participant,
      'interview_dates' => $db_interview_dates,
    ]);
  }

  public function select($event, Request $request){
    if(!$user = Auth::user())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You\'re NOT login!']]);
    $exploded = explode('-', $event);
    if(!$event = Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'Event NOT Found!']]);
    if(!$participant = $user->participation($event))
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You\'re NOT participant!']]);
    if(!$user->isAbleToRegister())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You\'re NOT able to enter here!']]);
    /*
     * Code to be here
     *    Check if participant is allowed to select/update interview!
     */
    if(!$participant->updatable)
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You can\'t update your interview!']]);
    $validator = Validator::make($request->all(), [
      'interview' => 'required|exists:interview_dates,id',
    ], [], ['interview' => 'Interview Date']);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $interview_date = InterviewDate::where('id', $request->input('interview'))->sharedLock()->get()->first();
    $db_interview_dates = array_merge(InterviewDate::where('event_id', $event->id)
                                                   ->where('date', '>', Date::now())
                                                   ->whereRaw('taken < max')
                                                   ->where('available', true)
                                                   ->where('preference_id',
                                                           $participant->preferences[0]->id)
                                                   ->orderBy('date', 'asc')
                                                   ->get()->all(),
                                      InterviewDate::where('event_id', $event->id)
                                                   ->where('date', '>', Date::now())
                                                   ->whereRaw('taken < max')
                                                   ->where('available', true)
                                                   ->whereNull('preference_id')
                                                   ->orderBy('date', 'asc')
                                                   ->get()->all());
    if($participant->interview && !in_array($participant->interview, $db_interview_dates))
      $db_interview_dates = array_merge($db_interview_dates, [$participant->interview]);
    if(!in_array($interview_date, $db_interview_dates))
      return response()->json(['state' => 'danger', 'fields' => [
          'interview' => "The selected interview is currently unavailable. Reload the page to load the available interview dates."
        ]
      ]);
    if(!empty($participant->interview)){
      $x = ParticipantInterview::where('participant_id', $participant->id)->get()->first();
      if($x->interview_date_id != $request->input('interview')) $y = InterviewDate::where('id', $x->interview_date_id)->sharedLock()->get()->first();
      else $y = $interview_date;
      $y->taken--;
      $y->save();
      $x->delete();
    }
    $participant_interview = new ParticipantInterview;
    $participant_interview->participant_id = $participant->id;
    $participant_interview->interview_date_id = $interview_date->id;
    $participant_interview->save();
    $interview_date->taken++;
    $interview_date->save();
    return response()->json(['state' => 'success']);
  }


}
