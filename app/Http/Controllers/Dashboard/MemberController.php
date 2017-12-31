<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Member;
use App\Models\Position;
use App\Models\Committee;

class MemberController extends Controller
{

  public function showAdd(){
    return view('dashboard.members.add')->with([
      'users' => User::all(),
      'committees' => Committee::all(),
      'positions' => Position::all(),

    ]);
  }

  public function showManage(){
    return view('dashboard.members.manage')->with([
      'members' => Member::all(),
      'committees' => Committee::all(),
      'positions' => Position::all(),

    ]);
  }

  public function doAdd(Request $request){
    $validator = Validator::make($request->all(), [
      'user' => 'required|exists:users,id',
      'position' => 'required|exists:positions,id',
      'committee' => 'required|exists:committees,id',
      'year' => 'required|numeric|min:2011|max:2018',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $member = Member::where('user_id', $request->input('user'))
                    ->where('year', $request->input('year'))
                    ->get()->first();
    if($member)
      return response()->json(['state' => 'danger', 'fields' => ['user' => "This user already has a position in the entered year!"]]);
    $member = new Member;
    $member->user_id = $request->input('user');
    $member->committee_id = $request->input('committee');
    $member->position_id = $request->input('position');
    $member->year = $request->input('year');
    if($member->save())
      return response()->json(['state' => 'success']);
    return response()->json(['state' => 'stateless']);
  }

  public function doEdit(){

  }

  public function doDelete(){

  }

}
