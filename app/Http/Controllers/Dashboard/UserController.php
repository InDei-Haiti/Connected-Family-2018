<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use App\Models\User;

class UserController extends Controller
{

  public function showManage(){
    return view('dashboard.users.manage')->with([
      'users' => User::all(),

    ]);
  }

  public function doDelete(){

  }


}
