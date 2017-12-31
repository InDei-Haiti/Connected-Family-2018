<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Event;
use App\Models\Preference;
use App\Models\GroupDiscussionDate;

class GroupDiscussionController extends Controller
{

  public function showAdd(){
    return view('dashboard.group_discussions.add')->with([
      'events' => Event::orderBy('id', 'desc')->get()->all(),
      
    ]);
  }

  public function showManage(){
    return view('dashboard.group_discussions.manage')->with([
      'group_discussions' => GroupDiscussionDate::orderBy('event_id', 'desc')->get()->all(),

    ]);
  }

  public function doAdd(Request $request){
    $validator = Validator::make($request->all(), [
      'event' => 'required|exists:events,id',
      'date' => 'required|date_format:l d/m/Y h:iA',
      'max' => 'required|numeric',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('event'));
    if($event->isClosed() || $event->isOpened())
      return response()->json(['state' => 'danger', 'fields' => [
          'event' => 'You can\'t add group discussion dates to opened or closed Events!'
        ]
      ]);
    $group_discussion_date = new GroupDiscussionDate;
    $group_discussion_date->event_id = $request->input('event');
    $group_discussion_date->date = $request->input('date');
    $group_discussion_date->max = $request->input('max');
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
      $group_discussion_date->preference_id = $request->input('preference');
    }
    if($group_discussion_date->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'notsaved']);
  }

  public function doDelete(){
    
  }

  public function doEdit(){
    
  }

  //

}
