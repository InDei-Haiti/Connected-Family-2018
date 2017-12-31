<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

  public function educationalInformations(){
    return $this->hasMany('App\Models\EducationalInformation');
  }

  public function group(){
    return $this->belongsTo('App\Models\DepartmentGroup', 'department_group_id');
  }

  //

}
