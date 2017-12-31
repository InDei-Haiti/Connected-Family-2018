<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceCollege extends Model
{

  protected $table = "preference_colleges";

  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  public function college(){
    return $this->belongsTo('App\Models\College');
  }

  // 
}
