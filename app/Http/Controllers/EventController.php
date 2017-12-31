<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Auth;
use App\Models\Event;
use App\Models\Preference;
use App\Models\Participant;
use App\Models\InterviewDate;
use App\Models\GroupDiscussionDate;
use App\Models\ParticipantPreference;

class EventController extends Controller
{

  /* DONE */
  public function all(){
    $events = Event::where('published', true)->orderBy('started_at', 'desc')->get()->all();
    return view('event.events')->with(['events' => $events]);
  }

  /* DONE */
  public function show($event){
    $exploded = explode('-', $event);
    if(count($exploded) != 2) return view('errors.404');
    $event = Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first();
    if(!$event) return view('errors.404');
    if(!$event->published) return view('errors.404');
    return view('event.event')->with(['event' => $event]);
  }

  /* DONE */
  public function showRegister($event){
    if(!$user = Auth::user())
      return Auth::redirectToLogin('Please, Login (or Register from link below) first to be able to register in our current event.');
    $exploded = explode('-', $event);
    if(!$event = Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first())
      return view('errors.404');
    return view('event.registration')->with([
      'event' => $event,
      'user' => $user,
      'preferences' => $user->allowedPreferences($event),

    ]);
  }

  public function register($event, Request $request){
    if(!$user = Auth::user())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You\'re NOT login!']]);
    if(!$user->isAbleToRegister())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You\'re data MUST be updated']]);
    $exploded = explode('-', $event);
    if(!Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'Event NOT Found!']]);
    /* new_event! */
    if(!$new_event = Event::orderBy('id', 'desc')->first())
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'Event registration CLOSED!']]);
    if($new_event->name . "-" . $new_event->year != $event)
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'Event registration CLOSED!']]);
    $participation_preferences = [];
    // event is 2r2 or 2r1
    if($new_event->preferences_type[0] !== "*"){
      // validate 1st pref
      $validator = Validator::make($request->all(), [
        'stPreference' => 'required|exists:preferences,id',
      ], [], ['stPreference' => '1st Preference']);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
      $participation_preferences[] = $request->input('stPreference');
      // validate 2nd pref
      if($new_event->preferences_type == "2r2" || $request->input('ndPreference')){
        $nd_pref_vali = "";
        if($new_event->preferences_type == "2r2") $nd_pref_vali = "required|";
        $validator = Validator::make($request->all(), [
          'ndPreference' => $nd_pref_vali . 'exists:preferences,id',
        ], [], ['ndPreference' => '2nd Preference']);
        if ($validator->fails())
          return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
        if($request->input('stPreference') == $request->input('ndPreference'))
          return response()->json(['state' => 'danger', 'fields' =>
            ['ndPreference' => '[PREF_REPT] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!']
          ]);
        $participation_preferences[] = $request->input('ndPreference');
      }
    }
    // event *r1
    else {

    }
    foreach ($participation_preferences as $p)
      if(!in_array(Preference::find($p), $user->allowedPreferences($new_event)))
        return response()->json(['state' => 'danger', 'fields' =>
          ['stPreference' => '[PREF_405_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!']
        ]);
    $new_participant = false;
    if(!$participant = Participant::where('user_id', $user->id)->where('event_id', $new_event->id)->get()->first()){
      $participant = new Participant;
      $participant->user_id = $user->id;
      $participant->event_id = $new_event->id;
      $participant->updatable = true;
      $participant->save();
      $new_participant = true;
    }
    if(!$participant->updatable)
      return response()->json(['state' => 'error', 'fields' => ['msg' => 'You can\'t change your preference']]);
    if(!$new_participant)
      foreach ($participant->participantPreferences as $p)
        $p->delete();
    if(!$new_participant){
      if($participant->interview){
        $iv = InterviewDate::find($participant->interview->id);
        $iv->taken--;
        $iv->save();
        $participant->participantInterview->delete();
      }
      if($participant->group_discussion){
        $gd = GroupDiscussionDate::find($participant->group_discussion->id);
        $gd->taken--;
        $gd->save();
        $participant->participantGroupDiscussion->delete();
      }
    }
    foreach ($participation_preferences as $p) {
      $participation_preference = new ParticipantPreference;
      $participation_preference->participant_id = $participant->id;
      $participation_preference->preference_id = $p;
      $participation_preference->save();
    }
    return response()->json(['state' => 'success']);
  }

  public function showTracking($event){
    // check login
    if(!$user = Auth::user())
      return Auth::redirectToLogin('Please, Login (or Register from link below) first to be able to register in our current event.');
    // check event existance
    $exploded = explode('-', $event);
    if(!$event = Event::where('name', $exploded[0])->where('year', $exploded[1])->get()->first())
      return view('errors.404');
    // check if participant
    if(!$participant = $user->participation($event))
      return redirect()->route('event-registration', ['event' => $event->name . "-" . $event->year]);
    // return
    return view('event.tracking')->with([
      'event' => $event,
      'user' => $user,

    ]);
  }

  //

}
