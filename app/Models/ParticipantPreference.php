<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantPreference extends Model
{

  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }
  
  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  //
  
}
