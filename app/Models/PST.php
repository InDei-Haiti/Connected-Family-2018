<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PST extends Model
{

  /**
   *  Define table name in database!
   */
  protected $table = "psts";

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }

  //
  
}
