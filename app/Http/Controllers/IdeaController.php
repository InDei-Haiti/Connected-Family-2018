<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use Validator;
use View;

use App\Models\User;
use App\Models\Idea;
use App\Models\IdeaVote;

class IdeaController extends Controller
{

  public function add(Request $request){
    if(!$user = Auth::user()) return response()->json([]);
    $validator = Validator::make($request->all(), [
      'idea' => 'required|string',
    ]);
    if ($validator->fails())
      return response()->json(['state' => 'danger', 'fields' => $validator->errors()->toArray()]);
    $idea = new Idea;
    $idea->user_id = $user->id;
    $idea->content = $request->input('idea');
    if($idea->save()){
      $idea = Idea::find($idea->id);
      $nomore = count(User::find($user->id)->ideas) === 1 ? View::make('vendor.clear')->render() . View::make('vendor.idea.no-more')->render() : NULL;
      return response()->json([
        'state' => 'success',
        'msg' => "Your idea has been shared.",
        'content' => View::make('vendor.clear')->render() . View::make('vendor.idea.card', ['idea' => $idea])->render() . $nomore,
      ]);
    }
    return response()->json(['state' => 'error', 'msg' => '[PI_N_ERR]']);
  }

  public function show($username, $id){

  }

  public function vote(Request $request){

  }


}
