<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Imager;
use Exception;
use App\Models\Privacy;
use App\Models\Preference;
use App\Models\Participant;
use App\Models\SocialInformation;

class User extends Model
{

  public function emailConfirmation(){
    return $this->hasOne('App\Models\EmailConfirmation');
  }

  public function mobile(){
    return $this->hasOne('App\Models\Mobile');
  }

  public function mobiles(){
    return $this->hasMany('App\Models\Mobile');
  }

  public function image(){
    return $this->hasOne('App\Models\UserProfilePicture');
  }

  public function getImageBase64($size){
    if($this->image && count($this->memberHistories) > 0)
      return Imager::getBase64('pictures', $this->image->src, $size);
    if($this->image)
      return Imager::getBase64('avatars', $this->image->src, $size);
    return Imager::getBase64('avatars', 'default-male.png', $size);
  }

  public function getImageMime(){
    if($this->image)
      return pathinfo($this->image->src)['extension'];
    return "png";
  }

  public function educationalInformation(){
    return $this->hasOne('App\Models\EducationalInformation');
  }

  public function passwordReset(){
    return $this->hasOne('App\Models\PasswordReset');
  }

  public function passwordResets(){
    return $this->hasMany('App\Models\PasswordReset');
  }

  public function participations(){
    return $this->hasMany('App\Models\Participant')->orderBy('created_at', 'desc');
  }

  /**
   *
   *
   *
   *
   */
  public function isAbleToRegister(){
    $email_confirmed = true;
    if(!$this->emailConfirmation) $email_confirmed = false;
    else if(!$this->emailConfirmation->confirmed) $email_confirmed = false;
    $education_updated = true;
    if(!$this->educationalInformation) $education_updated = false;
    else if(strtotime($this->educationalInformation->updated_at) < strtotime('01-09-2017'))
      $education_updated = false;
    return $email_confirmed && $this->mobile && $education_updated;
  }

  /**
   *  Get if user is participant of Event $event
   *
   *  @param  Event   $event
   *  @return boolean $state
   */
  public function isParticipant($event){
    return $this->participation($event) ? true : false;
  }

  /**
   *  Get participation for user in Event $event
   *
   *  @param  Event       $event
   *  @return Participant $participant
   */
  public function participation($event){
    return Participant::where('user_id', $this->id)->where('event_id', $event->id)->get()->first();
  }

  /**
   *  Get allowed preferences for user in specific Event $event
   *
   *  @param  Event $event
   *  @return array $preferences
   */
  public function allowedPreferences($event){
    $preferences = [];
    $db_preferences = Preference::where('event_id', $event->id)->get()->all();
    $part_preferences = [];
    if(!$this->educationalInformation)
      return $preferences;
    if($participant = $this->participation($event))
      $part_preferences = $participant->preferences;
    foreach ($db_preferences as $p) {
      if(in_array($p->id, [12080]) && !in_array($p, $part_preferences)) continue;
      // check college
      $allowed_college = false;
      if($p->colleges->isEmpty()) $allowed_college = true;
      else if(in_array($this->educationalInformation->college, $p->colleges->all())) $allowed_college = true;
      // check department
      $allowed_department = false;
      if($p->departments->isEmpty()) $allowed_department = true;
      else if(in_array($this->educationalInformation->department, $p->departments->all())) $allowed_department = true;
      // check academic year
      $allowed_academic_year = false;
      if($p->min_academic_year === NULL) $allowed_academic_year = true;
      else if($this->educationalInformation->academic_year->id >= $p->min_academic_year->id) $allowed_academic_year = true;
      // all constraints
      if($allowed_college && $allowed_department && $allowed_academic_year) $preferences[] = $p;
    }
    return $preferences;
  }

  public function memberHistories(){
    return $this->hasMany('App\Models\Member')->orderBy('created_at', 'desc');
  }

  public function birthday(){
    return $this->hasOne('App\Models\Birthday');
  }

  public function additionalInformations(){
    return $this->hasOne('App\Models\AdditionalInformation');
  }

  public function sessions(){
    return $this->hasMany('App\Models\Session');
  }

  public function socialInformations(){
    return $this->hasMany('App\Models\SocialInformation');
  }

  public function socialInformation($attribute){
    return SocialInformation::where('user_id', $this->id)
                            ->where('attribute', $attribute)
                            ->get()->first();
  }

  /**
   * The allowed social links' list.
   *
   * @var array
   */
  protected $socialList = [
    "facebook",
    "linkedin",
  ];

  /**
   *  Get social link for the given attribute for the current User instance.
   *
   *  @param  string $attribute
   *  @return miaxed(string, NULL)
   */
  public function socialLink($attribute){
    if(!in_array($attribute, $this->socialList))
      throw new Exception("[Invaild parameter \"\$attribute\"]The \"$attribute\" is NOT listed in the social list.");

    $social = SocialInformation::where('user_id', $this->id)
                        ->where('attribute', $attribute)
                        ->get()->first();

    return $social ? $social->value : NULL;
  }

  public function privacies(){
    return $this->hasMany('App\Models\Privacy');
  }

  /**
   * The attributes that have privacy constrain.
   *
   * @var array
   */
  protected $privaciesList = [
    "email",
    "mobile",
    "education",
    "birthday",
    "facebook",
    "linkedin",
  ];

  /**
   *  Check privacy for given attribute for the current User instance.
   *
   *  @param  string $attribute
   *  @return miaxed(boolean, NULL)
   */
  public function checkPrivacy($attribute){
    if(!in_array($attribute, $this->privaciesList))
      throw new Exception("[Invaild parameter \"\$attribute\"]The \"$attribute\" is NOT listed in the privacy list.");

    $privacy = Privacy::where('user_id', $this->id)
                        ->where('attribute', $attribute)
                        ->get()->first();

    return $privacy ? $privacy->value : NULL;
  }

  public function admin(){
    return $this->hasOne('App\Models\Admin');
  }

  public function ideas(){
    return $this->hasMany('App\Models\Idea');
  }

  //

}
