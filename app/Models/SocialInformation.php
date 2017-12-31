<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialInformation extends Model
{
  
  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  //

}
