<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantTest extends Model
{
  
  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }

  //
  
}
