<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

  public function magazine(){
    return $this->belongsTo('App\Models\Magazine');
  }

  //

}
