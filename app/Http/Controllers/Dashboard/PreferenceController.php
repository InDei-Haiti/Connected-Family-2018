<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Event;
use App\Models\College;
use App\Models\Department;
use App\Models\Preference;
use App\Models\AcademicYear;
use App\Models\DepartmentGroup;
use App\Models\PreferenceCollege;
use App\Models\PreferenceDepartment;
use App\Models\PreferenceMinAcademicYear;

class PreferenceController extends Controller
{

  public function showAdd(){
    return view('dashboard.preferences.add')->with([
      'colleges' => College::all(),
      'department_groups' => DepartmentGroup::all(),
      'events' => Event::orderBy('id', 'desc')->get()->all(),
      'ac_years' => AcademicYear::all(),
    ]);
  }

  public function showManage(){
    return view('dashboard.preferences.manage')->with([
      'preferences' => Preference::orderBy('event_id', 'desc')->get()->all(),
      'colleges' => College::all(),
      'department_groups' => DepartmentGroup::all(),
      'events' => Event::orderBy('id', 'desc')->get()->all(),
    ]);
  }

  public function doAdd(Request $request){
    $validator = Validator::make($request->all(), [
      'event' => 'required|exists:events,id',
      'name' => 'required|string|max:255',
      'description' => 'required|string',
      'type' => 'required|in:Course,Training,Internship,Membership',
      'steps' => 'required',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('event'));
    if($event->isClosed() || $event->isOpened())
      return response()->json(['state' => 'danger', 'fields' => [
          'event' => 'You can\'t add preferences to opened or closed Events!'
        ]
      ]);
    $preference = new Preference;
    $preference->event_id = $request->input('event');
    $preference->name = $request->input('name');
    $preference->description = $request->input('description');
    $preference->type = $request->input('type');
    $preference->steps = $request->input('steps');
    $preference_save = false;
    if($preference->save())
      $preference_save = true;
    $min_academic_year_saved = true;
    if($request->input('min_academic_year') != ''){
      $validator = Validator::make($request->all(), [
        'min_academic_year' => 'required|exists:academic_years,id',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
      $min_academic_year_saved = false;
      $min_academic_year = new PreferenceMinAcademicYear;
      $min_academic_year->preference_id = $preference->id;
      $min_academic_year->academic_year_id = $request->input('min_academic_year');
      if($min_academic_year->save())
        $min_academic_year_saved = true;
    }
    $colleges_saved = true;
    if($request->input('colleges') != null){
      $vaild_college = true;
      foreach ($request->input('colleges') as $college_id)
        if(!College::find($college_id)){
          $vaild_college = false;
          break;
        }
      if (!$vaild_college)
        return response()->json(['state' => 'danger', 'fields' => [
            'colleges' => 'Error! Reload the page and try again. If you get the same error call IT Head'
          ]
        ]);
      $colleges_saved = false;
      foreach ($request->input('colleges') as $college_id){
        $preference_college = new PreferenceCollege;
        $preference_college->preference_id = $preference->id;
        $preference_college->college_id = $college_id;
        if($preference_college->save())
          $colleges_saved = true;        
      }
    }
    $departments_saved = true;
    if($request->input('departments') != null){
      $vaild_department = true;
      foreach ($request->input('departments') as $department_id)
        if(!Department::find($department_id)){
          $vaild_department = false;
          break;
        }
      if (!$vaild_department)
        return response()->json(['state' => 'danger', 'fields' => [
            'departments' => 'Error! Reload the page and try again. If you get the same error call IT Head'
          ]
        ]);
      $departments_saved = false;
      foreach ($request->input('departments') as $department_id){
        $preference_department = new PreferenceDepartment;
        $preference_department->preference_id = $preference->id;
        $preference_department->department_id = $department_id;
        if($preference_department->save())
          $departments_saved = true;        
      }
    }
    if($preference_save && $min_academic_year_saved && $colleges_saved && $departments_saved)
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'notsaved']);
  }

  public function doDelete(){
    
  }

  public function doEdit(){
    
  }

  //

}
