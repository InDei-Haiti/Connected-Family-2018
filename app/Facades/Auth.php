<?php

namespace App\Facades;

session_start();

use Illuminate\Http\Request;
use Hash;
use Exception;
use App\Models\User;
use App\Models\Session;
use App\Models\PasswordReset;
use App\Models\EmailConfirmation;

class Auth
{

  /**
   *  Create Auth session
   *  @param User, $remember
   *  @return void
   */
  public static function login($user, $remember = false){
    if(Auth::check()) return true;
    /*
    $_SESSION['logined_user_id'] = $user->id;
    return true;
    */
    $user_id = $user->id;
    $ip = self::ip();
    $user_agent = self::user_agent();

    $session = Session::where('user_id', $user_id)
                      ->where('ip', $ip)
                      ->where('user_agent', $user_agent)
                      ->get()->first();

    if(!$session){
      $session = new Session;
      $session->user_id = $user_id;
      $session->ip = $ip;
      $session->user_agent = $user_agent;
    }

    $session->remember = $remember ? true : false;
    $session->expires_at = $remember ? Date::after('year') : Date::after('hour', 6);
    $session->save();

  }

  /**
   *  Function to generate hashed strings used as tokens
   *
   *  @param  string $plus an addition string to hash function
   *  @return hash $hashed a hashed string
   */
  public static function token($plus = 'ArtistS17IsTheBest!'){
    return hash('sha256', time() . md5($plus) . uniqid());
  }

  /**
   *  Send confirmation message to user that is login
   *
   *  @param  NULL
   *  @return mixed
   *          boolean $state in case of not login
   *          string $msg otherwise
   */
  public static function sendConfirmation(){
    if(!Auth::check())
      return false;
    $user = Auth::user();
    $token = Auth::token($user->email);
    $email_confirmation = $user->emailConfirmation;
    if(!$email_confirmation){
      $email_confirmation = new EmailConfirmation;
      $email_confirmation->user_id = $user->id;
      $email_confirmation->token = $token;
      $email_confirmation->save();
    } else {
      if($email_confirmation->confirmed)
        return "You've already confirmed your email!";
      $time_now = time();
      $updated_at = strtotime($email_confirmation->updated_at);
      $condition = $time_now - $updated_at;
      if($condition > 3600){
        $email_confirmation->token = $token;
        $email_confirmation->save();
      }
      else return "You can only send one confirmation email per hour!";
    }
    if(Mailer::isAbleToSend()){
      Mailer::send(
        'Email Confirmation','email-confirmation',
        $user, ['token' => $token]
      );
      return "Your confirmation email was sent to you!";
    }
    $time = Mailer::timeToNextAttempt();
    return "We can not send this email right now you can try again after $time minute(s)!";
  }

  /**
   *  Send reset email to user that has $email
   *    login or not login the function is working for both!
   *
   *  @param  string $email email of user
   *  @return array string $msg represent state of email requested to be sent
   */
  public static function sendReset($email){
    $user = User::where('email', $email)->get()->first();
    $token = Auth::token($user->email);
    $password_reset = PasswordReset::where('user_id', $user->id)
                                    ->whereNULL('reset')
                                    ->get()->first();
    if(!$password_reset){
      $password_reset = PasswordReset::where('user_id', $user->id)
                                    ->where('created_at', '>=', Date::before('hour'))
                                    ->get()->last();
      if(!$password_reset){
        $password_reset = new PasswordReset;
        $password_reset->user_id = $user->id;
        $password_reset->token = $token;
        $password_reset->save();
      } else
        return [
          'value' => "You can only send one password reset email per hour!",
          'type' => 'warning'
        ];
    } else
        return [
          'value' => "We've already sent to you an email to reset your password!",
          'type' => 'info'
        ];
    if(Mailer::isAbleToSend()){
      Mailer::send(
        'Password Reset','password-reset',
        $user, ['token' => $token]
      );
      return [
        'value' => "Your password reset email was sent to you!",
        'type' => 'success'
      ];
    }
    $time = Mailer::timeToNextAttempt();
    return [
      'value' => "We can not send this email right now you can try again after $time minute(s)!",
      'type' => 'info'
    ];
  }

  /**
   *  Redirect to profile for the user that is login
   *
   *  @param  NULL
   *  @return Redirect $redirect instance to route('profile')
   */
  public static function redirectToProfile(){
    return redirect()->route('profile', ['username' => Auth::user()->username]);
  }

  /**
   *  Redirect to login page with $msg
   *
   *  @param  string $msg that you want to display to user
   *  @return Redirect $redirect instance to route('login')
   */
  public static function redirectToLogin($msg = ''){
    return redirect()->route('login')->with(['msg' => 'You\'re NOT Login! ' . $msg]);
  }

  /**
   *  Create new User
   *  @param array contains name, email, password
   *  @return User
   */
  public static function create($data){
    if(!array_key_exists('name', $data)
      || !array_key_exists('email', $data)
      || !array_key_exists('password', $data))
      throw new Exception("[Invaild parameter \"\$data\"] Must have name, email, and password. One or more is not listed!");

    $user = new User;
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = $data['password'];
    $user->save();

    return $user;
  }

  /**
   *  Return current login user
   *  @param NULL
   *  @return mixed [User, NULL]
   */
  public static function user(){
    /*
    if(isset($_SESSION['logined_user_id']))
      if($user = User::find($_SESSION['logined_user_id']))
        return $user;
    return NULL;
    */
    $session = Session::where('ip', self::ip())
                      ->where('user_agent', self::user_agent())
                      ->where('expires_at', '>', Date::now())
                      ->get()->first();
    if(!$session) return NULL;
    self::updateSession($session);
    return $session->user;
  }

  /**
   *  Return current login user id
   *  @param NULL
   *  @return mixed [id, NULL]
   */
  public static function id(){
    return Auth::user() ? Auth::user()->id : NULL;
  }

  /**
   * Check if user is login or not
   *  @param NULL
   *  @return boolean
   */
  public static function check(){
    /*
    if(isset($_SESSION['logined_user_id']))
      return true;
    return false;
    */
    $session = Session::where('ip', self::ip())
                      ->where('user_agent', self::user_agent())
                      ->where('expires_at', '>', Date::now())
                      ->get()->first();
    if(!$session) return false;
    self::updateSession($session);
    return true;
  }

  /**
   *  Expire current user session
   *  @param NULL
   *  @return void
   */
  public static function logout(){
    if(!Auth::check()) return;
    /*
    unset($_SESSION['logined_user_id']);
    return;
    */

    $session = Session::where('user_id', Auth::id())
                      ->where('ip', self::ip())
                      ->where('user_agent', self::user_agent())
                      ->where('expires_at', '>', Date::now())
                      ->get()->first();

    $session->expires_at = Date::now();
    $session->save();
  }

  /**
   *  Return Guest ip
   *  @param NULL
   *  @return string
   */
  private static function ip(){
    return $_SERVER['REMOTE_ADDR'];
  }

  /**
   *  Return Guest user_agent [agent]
   *  @param NULL
   *  @return string
   */
  private static function user_agent(){
    return $_SERVER['HTTP_USER_AGENT'];
  }

  private static function updateSession($session) {
    if($session)
      if(!$session->remember) {
        $session->expires_at = Date::after('hour', 6);
        $session->save();
      }
  }

}
