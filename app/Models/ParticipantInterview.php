<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantInterview extends Model
{

  public function interview_date(){
    return $this->belongsTo('App\Models\InterviewDate');
  }
  
  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }

  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  //
  
}
