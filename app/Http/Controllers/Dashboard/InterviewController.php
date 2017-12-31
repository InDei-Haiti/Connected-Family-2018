<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Auth;
use App\Models\Event;
use App\Models\Preference;
use App\Models\InterviewDate;

class InterviewController extends Controller
{

  public function showAdd(){
    return view('dashboard.interviews.add')->with([
      'events' => Event::orderBy('id', 'desc')->get()->all(),

    ]);
  }

  public function showManage(){
    return view('dashboard.interviews.manage')->with([
      'interviews' => InterviewDate::orderBy('event_id', 'desc')
                                   ->orderBy('date', 'asc')->get()->all(),

    ]);
  }

  public function doAdd(Request $request){
    $validator = Validator::make($request->all(), [
      'event' => 'required|exists:events,id',
      'date' => 'required|date_format:Y-m-d H:i:s',
      'max' => 'required|numeric',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('event'));
    $interview_date = new InterviewDate;
    $interview_date->event_id = $request->input('event');
    $interview_date->date = $request->input('date');
    $interview_date->max = $request->input('max');
    if($request->input('preference') != ''){
      $validator = Validator::make($request->all(), [
      'preference' => 'required|exists:preferences,id',
      ]);
      if ($validator->fails())
        return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
      if(Preference::find($request->input('preference'))->event->id != $request->input('event'))
        return response()->json(['state' => 'danger', 'fields' => [
            'preference' => 'Preference\'s Event MUST match selected Event!'
          ]
        ]);
      $interview_date->preference_id = $request->input('preference');
    }
    $interview_date->admin_id = Auth::user()->admin->id;
    $exist_interview_date = InterviewDate::where('date', $request->input('date'))
                                         ->where('event_id', $request->input('event'))
                                         ->where('preference_id', $request->input('preference'))
                                         ->get()->all();
    if($exist_interview_date)
      return response()->json(['state' => 'danger', 'fields' => [
          'date' => 'Date is already exists with same preference and within the same event!'
        ]
      ]);
    if($interview_date->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'notsaved']);
  }

  public function doDelete(Request $request){

  }

  public function doEdit(Request $request){

  }

  //

}
