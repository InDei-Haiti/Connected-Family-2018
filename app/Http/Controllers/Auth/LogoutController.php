<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class LogoutController extends Controller
{

  public function logout(Request $request){
    if(!Auth::check())
      return Auth::redirectToLogin();
    Auth::logout();
    return redirect()->route('home');
  }



}
