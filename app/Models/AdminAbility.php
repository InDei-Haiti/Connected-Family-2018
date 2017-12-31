<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAbility extends Model
{

  public function admin(){
    return $this->belongsTo('App\Models\Admin');
  }

  public function ability(){
    return $this->belongsTo('App\Models\Ability');
  }
  
  //
  
}
