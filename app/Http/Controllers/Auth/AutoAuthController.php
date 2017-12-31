<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Image;
use Mailer;
use Socialite;
use App\Models\User;
use App\Models\SocialInformation;
use App\Models\EmailConfirmation;
use App\Models\Image as UserImage;
use App\Models\AdditionalInformation;


class AutoAuthController extends Controller
{
  //
  public function redirectToProvider($provider, $wants = "login"){
    // 
    if(!in_array($provider, ['facebook', 'linkedin']))
      return view('errors.404');
    if(in_array($wants, ["connect", "get-picture", "login"])){
      self::setupSocialite($provider, $wants);
      return Socialite::driver($provider)->redirect();
    }
    return redirect()->route('register');
  }

  // 
  public function habdleProviderCallback($provider, $wants = "login"){
    // extend execution time for long response...
    ini_set('max_execution_time', 120);
    // 
    if(!in_array($provider, ['facebook', 'linkedin']))
      return view('errors.404');
    self::setupSocialite($provider, $wants);
    // Handle errors if canceled.
    try {
      $SocialiteUser = Socialite::driver($provider)->stateless()->user();
    } catch (\GuzzleHttp\Exception\ClientException $e) {
      return redirect()->route('login');
    }
    // Handle if email not supplied.
    if($SocialiteUser->email === null)
      return view('notifications.notification')->with([
        'title' => "Email permission NOT granted!",
        'msg' => "Email is REQUIRED. Give us an access to $provider email to be able to continue... To do so, Remove our app on $provider under Settings > Apps. Then try to login again.",
      ]);
    // Get User Data
    $name = $SocialiteUser->getName();
    $email = $SocialiteUser->email;
    $token = $SocialiteUser->token;
    // return "I'm $wants";
    /*** >>> START AUTH! <<< ***/
    if($wants == "login"){
      // Create/Get User by email
      $user = User::where('email', $email)->get()->first();
      if(!$user){
        // Creating new User
        $user = new User;
        $user->name = $name;
        $user->username = uniqid();
        $user->email = $email;
        $user->password = $token;
        $user->save();
      }
      // Do Login
      Auth::login($user, true);
      // Create/Get Email Confirmation
      if(!$user->emailConfirmation){
        $emailConf = new EmailConfirmation;
        $emailConf->user_id = $user->id;
        $emailConf->token = $token;
        $emailConf->save();
      } else $emailConf = $user->emailConfirmation;
      // Update Email Confirmation
      if(!$emailConf->confirmed && $provider == "facebook"){
        if($SocialiteUser->user["verified"]){
          $emailConf->confirmed = 1;
          $emailConf->save();
          Mailer::send('Welcome', 'welcome', $user);
        } else Auth::sendConfirmation();
      } else if(!$emailConf->confirmed) Auth::sendConfirmation();
    }
    if($wants == "login" || $wants == "connect"){
      if(!isset($user)) $user = Auth::user();
      if(!$user) Auth::redirectToLogin("Login first to be able to connect your profile with $provider");
      // skip this
      /*
      // Check email matching! in case of wants = connect...
      if($user->email != $email)
        return redirect()->route('edit-profile', ['username' => $user->username])->with([
            'si-errors' =>  "<b>ERROR, CAN'T CONNECT!</b><br>Your email, you registered with in our website, doesn't match the $provider email.",
            'scrollTo' =>  "si",
          ]);
      */
      // Create/Get provider link
      if(!$user->socialLink($provider))
        $socialInfo = new SocialInformation;
      else $socialInfo = $user->socialInformation($provider);
      // Update provider link
      if(!$socialInfo->linked){
        $socialInfo->user_id = $user->id;
        $socialInfo->attribute = $provider;
        if($provider == "facebook") $socialInfoLink = $SocialiteUser->profileUrl;
        if($provider == "linkedin") $socialInfoLink = $SocialiteUser->user["publicProfileUrl"];
        $socialInfo->value = $socialInfoLink;
        $socialInfo->linked = 1;
        $socialInfo->save();        
      }
      if($wants == 'connect') 
        return redirect()->route('edit-profile', ['username' => $user->username])->with([
            'scrollTo' =>  "si",
          ]);
      // Redirect to Profile
      return Auth::redirectToProfile();
    }
  }

  private static function setupSocialite($provider, $wants){
    $attrs = config("services.$provider");
    $attrs['redirect'] = env('APP_URL')."/auth/social/$provider/callback/$wants";
    config(["services.$provider" => $attrs]);
  }

}
