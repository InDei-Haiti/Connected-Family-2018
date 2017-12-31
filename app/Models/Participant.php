<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ParticipantPreference;
use App\Models\ParticipantInterview;
use App\Models\ParticipantGroupDiscussion;

class Participant extends Model
{

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }

  public function participantInterview(){
    return $this->hasOne('App\Models\ParticipantInterview');
  }

  public function participantGroupDiscussion(){
    return $this->hasOne('App\Models\ParticipantGroupDiscussion');
  }

  public function participantPreferences(){
    return $this->hasMany('App\Models\ParticipantPreference');
  }

  public function PST(){
    return $this->hasOne('App\Models\ParticipantPST');
  }

  public function test(){
    return $this->hasOne('App\Models\ParticipantTest');
  }

  public function competition(){
    return $this->hasOne('App\Models\ParticipantCompetition');
  }

  public function getPreferencesAttribute(){
    $participationPreferences = ParticipantPreference::where('participant_id', $this->id)->get()->all();
    $preferences = [];
    foreach ($participationPreferences as $participationPreference)
      $preferences[] = $participationPreference->preference;
    return $preferences;
  }

  public function getInterviewAttribute(){
    $piv = ParticipantInterview::where('participant_id', $this->id)->get()->first();
    if($piv)
      return $piv->interview_date;
    return NULL;
  }

  public function getGroupDiscussionAttribute(){
    $pgd = ParticipantGroupDiscussion::where('participant_id', $this->id)->get()->all();
    if($pgd)
      return $pgd->groupDiscussionDate;
    return NULL;
  }
  
  //

}
