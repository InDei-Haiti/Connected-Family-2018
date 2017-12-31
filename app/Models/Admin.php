<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Ability;
use App\Models\AdminAbility;

class Admin extends Model
{
  
  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function settingLogs(){
    return $this->hasMany('App\Models\SettingLog');
  }

  public function adminAbilities(){
    return $this->hasMany('App\Models\AdminAbility');
  }

  public function getAbilitiesAttribute(){
    $AdminAbilities = AdminAbility::where('admin_id', $this->id)->get()->all();
    if(count($AdminAbilities) == 0)
      return NULL;
    $abilities = [];
    foreach ($AdminAbilities as $AdminAbility)
      $abilities[] = $AdminAbility->ability;
    return $abilities;
  }

  public function hasAbility($ability){
    if(!$ability = Ability::where('name', $ability)->get()->first())
      return false;
    return in_array($ability, $this->abilities) 
            || in_array(Ability::where('name', 'full')->get()->first(), $this->abilities);
  }

  //
  
}
