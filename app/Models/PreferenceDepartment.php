<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceDepartment extends Model
{

  protected $table = "preference_departments";

  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  public function department(){
    return $this->belongsTo('App\Models\Department');
  }

  //

}
