<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ParticipantGroupDiscussion;

class GroupDiscussionDate extends Model
{

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }

  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  public function getParticipantsAttribute(){
    $pgds = ParticipantGroupDiscussion::where('group_discussion_date_id', $this->id)
            ->get()->all();
    if(count($pgds) == 0)
      return NULL;
    $participants = [];
    foreach ($pgds as $pgd)
      $participants[] = $pgd->participant;
    return $participants;
  }

  //
  
}
