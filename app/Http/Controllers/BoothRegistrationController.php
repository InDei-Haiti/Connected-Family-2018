<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;

use App\Models\Event;
use App\Models\Preference;
use App\Models\User;
use App\Models\Mobile;
use App\Models\Uni;
use App\Models\College;
use App\Models\Department;
use App\Models\DepartmentGroup;
use App\Models\AcademicYear;
use App\Models\EducationalInformation;
use App\Models\Participant;
use App\Models\ParticipantPreference;
use App\Models\InterviewDate;
use App\Models\GroupDiscussionDate;

class BoothRegistrationController extends Controller
{

  public function index()
  {
    $new_event = Event::getNewEvent();
    if(!$new_event)
      return redirect("registration");
    $unis = Uni::where('type', 'main')->get()->all();
    $colleges = College::where('type', 'main')->get()->all();
    $department_groups = DepartmentGroup::all();
    $years = AcademicYear::all();
    $preferences = Preference::where('event_id', $new_event->id)->get()->all();
    return view('event.booth-registration')->with(
      [
        'unis' => $unis,
        'colleges' => $colleges,
        'department_groups' => $department_groups,
        'years' => $years,
        'preferences' => $preferences,
      ]
    );
  }

  public function register(Request $request){
    $new_event = Event::getNewEvent();
    if(!$new_event) die();
    $validator = Validator::make($request->all(), [
      'name' => 'required|regex:/^[\pL\s\-]+$/u|max:64|min:8',
      'email' => 'required|email|max:128',
      'mobile' => 'required|digits:11',
      'uni' => 'required|exists:unis,name',
      'other_uni' => 'required_if:uni,Other',
      'college' => 'required|exists:colleges,name',
      'other_college' => 'required_if:college,Other',
      'department' => 'required_if:college,Faculty of Engineering',
      'other_department' => 'required_if:department,Other',
      'year' => 'required|exists:academic_years,name',
      // 'pref' => 'required|array|min:1'
      'stPreference' => 'required'
    ], [
      'other_uni.required_if' => 'The other university field is required.',
      'other_college.required_if' => 'The other college field is required.',
      'other_department.required_if' => 'The other department field is required.',
      'department.required_if' => 'The department field is required when college is Engineering.',
      /*
      'pref.array' => "[PREF_ARR_ERR] Please, Reload the page and try again!. If you got the same message feel free to contanct anyone for IT Committee."
      */
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    if($request->input('uni') == "Other"){
      $validator = Validator::make($request->all(), [
        'other_uni' => 'regex:/^[\pL\s\-]+$/u|max:50|min:3',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    }
    if($request->input('college') == "Other"){
      $validator = Validator::make($request->all(), [
        'other_college' => 'regex:/^[\pL\s\-]+$/u|max:50|min:3',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    }
    if($request->input('college') == "Faculty Of Engineering"){
      $validator = Validator::make($request->all(), [
        'department' => 'exists:departments,name'
      ],[
        'department.exists' => '[DEP_404_ERR] Please, Reload the page and try again. If you got the same message feel free to contanct anyone from IT Committee.'
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    }
    if($request->input('department') == "Other"){
      $validator = Validator::make($request->all(), [
        'other_department' => 'regex:/^[\pL\s\-]+$/u|max:50|min:10',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    }

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

    $user = User::where('email', $request->input('email'))->get()->first();
    $mobile = Mobile::where('number', $request->input('mobile'))->get()->first();
    if($user && $mobile && $mobile->user->id != $user->id){
        return response()->json(['state' => 'danger', 'fields' => ['mobile' => "The entered mobile number is registered before with this " . $mobile->user->email . " email and The entered email is registered before with different mobile nubmer!"]]);
    }

    if(!$user && $mobile) {
      $user = User::find($mobile->user_id);
      $user->email = $request->input('email');
      $user->save();
    } elseif($user && !$mobile) {
      $mobile = Mobile::where('user_id', $user->id)->get()->first();
      if(!$mobile) $mobile = new Mobile;
      $mobile->number = $request->input('mobile');
      $mobile->save();
    } elseif(!$user && !$mobile) {
      $user = new User;
      $user->name = ucwords(strtolower($request->input('name')));
      $user->username = uniqid();
      $user->email = $request->input('email');
      $user->password = Hash::make("connected-family");
      $user->save();
      $mobile = new Mobile;
      $mobile->user_id = $user->id;
      $mobile->number = $request->input('mobile');
      $mobile->save();
    }

    $uni = Uni::where('name', $request->input('uni'))->get()->first()->id;
    if($request->input('uni') == "Other"){
      $newUni = new Uni;
      $newUni->name = $request->input('other_uni');
      $newUni->save();
      $uni = $newUni->id;
    }
    $college = College::where('name', $request->input('college'))->get()->first()->id;
    if($request->input('college') == "Other"){
      $newCollege = new College;
      $newCollege->name = $request->input('other_college');
      $newCollege->save();
      $college = $newCollege->id;
    }
    $department = NULL;
    if($request->input('college') != "Faculty of Engineering") $department = NULL;
    else if($request->input('department') == "Other"){
      $newDepartment = new Department;
      $newDepartment->name = $request->input('other_department');
      $newDepartment->save();
      $department = $newDepartment->id;
    } else $department = Department::where('name', $request->input('department'))->get()->first()->id;
    $year = AcademicYear::where('name', $request->input('year'))->get()->first()->id;
    if($user->educationalInformation) $ei = EducationalInformation::where('user_id', $user->id)->get()->first();
    else $ei = new EducationalInformation;
    $ei->user_id = $user->id;
    $ei->uni_id = $uni;
    $ei->college_id = $college;
    $ei->department_id = $department;
    $ei->academic_year_id = $year;
    $ei->save();

    foreach ($participation_preferences as $p){
      $user_allowedPreferences = BoothRegistrationController::getAllowedPreferences($user, $ei, $new_event);
      if(!in_array(Preference::find($p), $user_allowedPreferences)){
        $allowedPreferences = "";
        if($user_allowedPreferences) foreach($user_allowedPreferences as $preference)
          $allowedPreferences .= $preference->name . ", ";
        return response()->json(['state' => 'danger', 'fields' =>
          ['stPreference' => "[PREF_405_ERR] You may have selected a preference you're not allowed to select check your preferences. Allowed preferences are $allowedPreferences If you are sure they are right feel free to contact anyone form IT Committee."]
        ]);
      }
    }
        // [PREF_405_ERR] Please, Reload the page and try again. If you get the same message, feel free to contact us via facebook page and describe the error with screenshot!

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
      return response()->json(['state' => 'danger', 'fields' => ['name' => "You have registered before in this event and you are no longer able to update your participation in this event."]]);
    if(!$new_participant){
      foreach ($participant->participantPreferences as $p)
        $p->delete();
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

    if(!$user->isAbleToRegister()) Auth::sendConfirmation();

    return response()->json(['state' => 'success']);
  }

  public static function getAllowedPreferences($user, $user_education, $event)
  {
    $preferences = [];
    $db_preferences = Preference::where('event_id', $event->id)->get()->all();
    $part_preferences = [];
    if($participant = $user->participation($event))
      $part_preferences = $participant->preferences;
    foreach ($db_preferences as $p) {
      $allowed_college = false;
      if($p->colleges->isEmpty()) $allowed_college = true;
      else if(in_array($user_education->college, $p->colleges->all())) $allowed_college = true;
      $allowed_department = false;
      if($p->departments->isEmpty()) $allowed_department = true;
      else if(in_array($user_education->department, $p->departments->all())) $allowed_department = true;
      $allowed_academic_year = false;
      if($p->min_academic_year === NULL) $allowed_academic_year = true;
      else if($user_education->academic_year->id >= $p->min_academic_year->id) $allowed_academic_year = true;
      if($allowed_college && $allowed_department && $allowed_academic_year) $preferences[] = $p;
    }
    return $preferences;
  }

}
