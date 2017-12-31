<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailerQueue extends Model
{

  protected $table = "mailer_queue";

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function setOtherAttrsAttribute($value){
    if(empty($value)) return;
    $this->other_attributes = json_encode($value);
  }

  public function getOtherAttrsAttribute(){
    return $this->other_attributes ? json_decode($this->other_attributes, true) : array();
  }

  //
  
}
