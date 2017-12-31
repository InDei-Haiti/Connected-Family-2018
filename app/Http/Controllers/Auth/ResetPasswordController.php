<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use Auth;
use App\Models\PasswordReset;

class ResetPasswordController extends Controller
{

  public function showRequest(){
    return view('auth.passwords.email');
  }

  public function request(Request $request){
    $this->validate($request,[
        'email' => 'required|email|exists:users|max:255'
      ],[
        'email.exists' => 'This E-Mail doesn\'t match our records!' ,
      ]
    );
    $reset = Auth::sendReset($request->input('email'));
    return redirect()->back()->with(['msg' => $reset]);
  }

  public function showReset($token){
    $reset = PasswordReset::where('token', $token)->get()->first();
    if(!$reset)
      return redirect()->route('reset-password-request')->with([
        'msg' => [
          'value' => "Your token seems to be corrupted. Check link carefully.",
          'type' => "warning"
        ]
      ]);
    if($reset->reset)
      return redirect()->route('reset-password-request')->with([
        'msg' => [
          'value' => "Your token seems to be expired. You can request another one from form below.",
          "type" => 'warning'
        ]
      ]);
    return view('auth.passwords.reset')->with(['token' => $token]);
  }

  public function reset(Request $request){
    $this->validate($request,[
        'token' => 'required|exists:password_resets',
      ],[
        'token.exists' => 'Your token seems to be corrupted. Check link carefully.'
      ]
    );
    $this->validate($request,[
        'password' => 'required|confirmed|max:255|min:8',
      ]
    );
    $reset = PasswordReset::where('token', $request->input('token'))->get()->first();
    $user = $reset->user;
    $user->password = Hash::make($request->input('password'));
    $user->save();
    $reset->reset = true;
    $reset->save();
    Auth::login($user);
    return Auth::redirectToProfile();
  }


}
