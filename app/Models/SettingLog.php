<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingLog extends Model
{
  
  public function admin(){
    return $this->belongsTo('App\Models\Admin');
  }

  public function setting(){
    return $this->belongsTo('App\Models\Setting');
  }

  //

}
