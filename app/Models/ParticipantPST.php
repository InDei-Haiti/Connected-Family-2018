<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantPST extends Model
{

  /**
   *  Define table name in database!
   */
  protected $table = "participant_psts";

  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }
  
  //
  
}
