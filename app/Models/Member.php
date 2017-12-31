<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

  public function user(){
    return $this->belongsTo('App\Models\User');
  }
  
  public function committee(){
    return $this->belongsTo('App\Models\Committee');
  }
  
  public function position(){
    return $this->belongsTo('App\Models\Position');
  }
  
  public function analytics(){
    return $this->hasMany('App\Models\MemberAnalytic');
  }

  public function delete(){
    if($this->user->image)
      $this->user->image->delete();
    parent::delete();
  }

  //
  
}
