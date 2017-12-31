<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function getDirectionAttribute(){
    return preg_match("/^[a-zA-Z0-9]*$/", $this->content[0]) ? "ltr" : "rtl";
  }

  //

}
