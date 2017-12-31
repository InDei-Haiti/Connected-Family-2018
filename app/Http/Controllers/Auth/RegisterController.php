<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use Mailer;
use validator;
use App\Models\User;
use App\Models\EmailConfirmation;

class RegisterController extends Controller
{

  public function show(){
    if(Auth::check())
      return Auth::redirectToProfile();
    return view('auth.register');
  }

  public function register(Request $request){
    $this->validate($request,[
        'name' => 'required|regex:/^[\pL\s\-]+$/u|max:64|min:8',
        'email' => 'required|email|unique:users|max:128',
        'password' => 'required|confirmed|max:255|min:8',
      ]
    );
    $user = new User;
    $user->name = $request->input('name');
    $user->username = uniqid();
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->save();
    Auth::login($user);
    Auth::sendConfirmation();
    return Auth::redirectToProfile();
  }

  public function sendRequest(){
    $confirmation = Auth::sendConfirmation();
    if(!$confirmation)
      return Auth::redirectToLogin();
    return view('notifications.notification')->with(
      [
        'msg' => $confirmation,
        'title' => 'Email Confirmation',
      ]
    );
  }

  public function confirm($token){
    $confirmation = EmailConfirmation::where('token', $token)->get()->first();
    if(!$confirmation)
      return view('notifications.notification')->with(
        [
          'msg' => 'Your token seems to be expired. Go to your profile to request another one to confirm your email.',
          'title' => 'Email Confirmation',
        ]
      );
    $confirmation->confirmed = true;
    $confirmation->save();
    Mailer::send('Welcome', 'welcome', $confirmation->user);
    return view('notifications.notification')->with(
      [
        'msg' => 'Congratulations! You have confirmed your email.',
        'title' => 'Email Confirmation',
      ]
    );
  }

}
