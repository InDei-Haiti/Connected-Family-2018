<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentGroup extends Model
{

  protected $table = "department_group";

  public function departments(){
    return $this->hasMany('App\Models\Department');
  }

  //

}
