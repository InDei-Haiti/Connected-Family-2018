<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Event;

class EventController extends Controller
{

  public function showAdd(){
    return view('dashboard.events.add');
  }

  public function showManage(){
    return view('dashboard.events.manage')->with([
      'events' => Event::orderBy('id', 'desc')->get()->all(),
    ]);
  }

  public function doAdd(Request $request){
    $validator = Validator::make($request->all(), [
      'year' => 'required|numeric|digits:4|min:2011',
      'name' => 'required|alpha|min:2|max:15',
      'description' => 'required|string|min:100',
      'started_at' => 'required|date_format:Y-m-d H:i:s',
      'ended_at' => 'required|date_format:Y-m-d H:i:s',
      'preferences_type' => 'required|in:2r2,2r1,*r1',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    if (strtotime($request->input('ended_at')) < strtotime($request->input('started_at')))
      return response()->json(['state' => 'danger', 'fields' => [
          'ended_at' => 'End date MUST be after start date!'
        ]
      ]);
    $event = new Event;
    $event->year = $request->input('year');
    $event->name = $request->input('name');
    $event->description = $request->input('description');
    $event->started_at = $request->input('started_at');
    $event->ended_at = $request->input('ended_at');
    $event->preferences_type = $request->input('preferences_type');
    if($event->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'notsaved']);
  }

  public function doEdit(Request $request){
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:events',
      'year' => 'required|numeric|digits:4|min:2011',
      'name' => 'required|alpha|min:2|max:15',
      'description' => 'required|string|min:100',
      'started_at' => 'required|date_format:Y-m-d H:i:s',
      'ended_at' => 'required|date_format:Y-m-d H:i:s',
      'preferences_type' => 'required|in:2r2,2r1,*r1',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('id'));
    if($event->isClosed() || $event->isOpened())
      return response()->json(['state' => 'danger', 'fields' => [
          'name' => 'You can\'t edit opened nor closed events!'
        ]
      ]);
    if (strtotime($request->input('ended_at')) < strtotime($request->input('started_at')))
      return response()->json(['state' => 'danger', 'fields' => [
          'ended_at' => 'End date MUST be after start date!'
        ]
      ]);
    $event->year = $request->input('year');
    $event->name = $request->input('name');
    $event->description = $request->input('description');
    $event->started_at = $request->input('started_at');
    $event->ended_at = $request->input('ended_at');
    $event->preferences_type = $request->input('preferences_type');
    if($event->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'notsaved']);
  }

  public function doDelete(Request $request){
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:events',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('id'));
    if($event->isClosed() || $event->isOpened())
      return response()->json(['state' => 'danger', 'fields' => [
          'id' => 'You can\'t edit opened nor closed events!'
        ]
      ]);
    if($event->delete())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'something']);
  }

  public function doPublish(Request $request){
    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:events',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $event = Event::find($request->input('id'));
    $event->published = true;
    if($event->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'something']);
  }

  public function showStatistics($event) {
    $event = Event::find($event);
    if(!$event)
      return view('dashboard.errors.404');
    return view('dashboard.events.statistics')->with(['event' => $event]);
  }

  //

}
