<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{

  public function educationalInformations(){
    return $this->hasMany('App\Models\EducationalInformation');
  }

  //
  
}
