<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfilePicture extends Model
{

  protected $table = "user_profile_picture";

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  //
  
}
