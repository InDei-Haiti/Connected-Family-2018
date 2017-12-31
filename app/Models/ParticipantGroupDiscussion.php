<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantGroupDiscussion extends Model
{

  public function groupDiscussionDate(){
    return $this->belongsTo('App\Models\GroupDiscussionDate');
  }
  
  public function participant(){
    return $this->belongsTo('App\Models\Participant');
  }

  //
  
}
