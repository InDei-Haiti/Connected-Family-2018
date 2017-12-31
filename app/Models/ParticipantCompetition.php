<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantCompetition extends Model
{

  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }

  //
  
}
