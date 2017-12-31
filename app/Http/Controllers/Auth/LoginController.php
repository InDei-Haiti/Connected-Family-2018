<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use App\Models\User;

class LoginController extends Controller
{

  public function show(){
    if(Auth::check())
      return Auth::redirectToProfile();
    return view('auth.login');
  }

  public function login(Request $request){
    $this->validate($request,[
        'email' => 'required|email|exists:users|max:128',
        'password' => 'required',
      ],[
        'email.exists' => 'This E-Mail doesn\'t match our records!' ,
      ]
    );
    $user = User::where('email', $request->input('email'))->get()->first();
    if(!Hash::check($request->input('password'), $user->password))
      return redirect()->back()->with([
        'password' => 'This Password doesn\'t match our records!'
      ])->withInput($request->all());
    Auth::login($user, $request->input('remember'));
    return Auth::redirectToProfile();
  }

}
