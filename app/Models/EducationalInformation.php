<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalInformation extends Model
{

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function uni(){
    return $this->belongsTo('App\Models\Uni');
  }

  public function college(){
    return $this->belongsTo('App\Models\College');
  }

  public function department(){
    return $this->belongsTo('App\Models\Department');
  }

  public function academic_year(){
    return $this->belongsTo('App\Models\AcademicYear');
  }

  //
  
}
