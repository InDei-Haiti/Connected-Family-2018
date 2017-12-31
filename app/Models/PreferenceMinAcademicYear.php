<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceMinAcademicYear extends Model
{

  protected $table = "preference_min_academic_year";

  public function preference(){
    return $this->belongsTo('App\Models\Preference');
  }

  public function academic_year(){
    return $this->belongsTo('App\Models\AcademicYear');
  }

  //
  
}
