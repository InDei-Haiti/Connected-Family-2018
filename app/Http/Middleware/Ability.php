<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Response;

class Ability
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next, $ability){
    if(!$user = Auth::user())
      if($request->method() == "GET")
        return new Response(view('errors.404'));
      else return response()->json(['state' => 'error', 'errors' => ['You\'re not login!']]);
    if(!$admin = $user->admin)
      if($request->method() == "GET")
        return new Response(view('errors.404'));
      else return response()->json(['state' => 'error', 'errors' => ['You\'re not an admin!']]);
    if($ability == 'all')
      return $next($request);
    if(!$admin->hasAbility($ability))
      if($request->method() == "GET")
        return new Response(view('dashboard.errors.401'));
      else return response()->json(['state' => 'error', 'errors' => ['You  don\'t have access rights!']]);
    return $next($request);
  }
}
