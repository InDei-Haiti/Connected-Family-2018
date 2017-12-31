<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IdeaVote extends Model
{

  public function idea(){
    return $this->belongsTo('App\Models\Idea');
  }

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  //

}
