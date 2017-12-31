<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ParticipantInterview;

class InterviewDate extends Model
{

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }
  
  public function admin(){
    return $this->belongsTo('App\Models\Admin');
  }
  
  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }
  
  public function getParticipantsAttribute(){
    $pivs = ParticipantInterview::where('interview_date_id', $this->id)->get()->all();
    if(count($pivs) == 0)
      return NULL;
    $participants = [];
    foreach ($pivs as $piv)
      $participants[] = $piv->participant;
    return $participants;
  }

  //

}
