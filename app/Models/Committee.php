<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{

  public function members(){
    return $this->hasMany('App\Models\Member');
  }

  //
  
}
