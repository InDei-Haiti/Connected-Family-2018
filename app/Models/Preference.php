<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\PreferenceCollege;
use App\Models\PreferenceDepartment;
use App\Models\PreferenceMinAcademicYear;

class Preference extends Model
{

  public function event(){
    return $this->belongsTo('App\Models\Event');
  }

  public function participantPreference(){
    return $this->hasMany('App\Models\ParticipantPreference');
  }

  public function getParticipantsAttribute(){
    return null;
  }

  public function getCollegesAttribute(){
    $pcs = PreferenceCollege::where('preference_id', $this->id)->get()->all();
    if(count($pcs) == 0)
      return collect(NULL);
    $colleges = [];
    foreach ($pcs as $pc)
      $colleges[] = $pc->college;
    return collect($colleges);
  }

  public function getDepartmentsAttribute(){
    $pds = PreferenceDepartment::where('preference_id', $this->id)->get()->all();
    if(count($pds) == 0)
      return collect(NULL);
    $departments = [];
    foreach ($pds as $pd)
      $departments[] = $pd->department;
    return collect($departments);
  }

  public function getMinAcademicYearAttribute(){
    $pmay = PreferenceMinAcademicYear::where('preference_id', $this->id)->get()->first();
    if(!$pmay)
      return NULL;
    return $pmay->academic_year;
  }

  public function getStepsArrAttribute(){
    return explode('>', $this->steps);
  }

  //

}
