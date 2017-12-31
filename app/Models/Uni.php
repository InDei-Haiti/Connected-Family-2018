<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uni extends Model
{

  public function educationalInformations(){
    return $this->hasMany('App\Models\EducationalInformation');
  }

  //
  
}
