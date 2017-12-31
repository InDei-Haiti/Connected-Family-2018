<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model
{

  protected static $shortMonth = [
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'May',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Aug',
    9 => 'Sep',
    10 => 'Oct',
    11 => 'Nov',
    12 => 'Dec',
  ];
  
  protected static $longMonth = [
    1 => 'Jan',
    2 => 'Feb',
    3 => 'Mar',
    4 => 'Apr',
    5 => 'May',
    6 => 'Jun',
    7 => 'Jul',
    8 => 'Aug',
    9 => 'Sep',
    10 => 'Oct',
    11 => 'Nov',
    12 => 'Dec',
  ];
  
  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function format($style = 'short'){
    if($style == 'short')
      return $this->day . " " . self::$shortMonth[$this->month] . ", " . $this->year; 
    else if($style == 'long')
      return self::$longMonth[$this->month] . " " . $this->day . ", " . $this->year;
  }

  public function editFormat(){
    $format = $this->year;
    $format .= "-";
    $format .= $this->month < 10 ? "0" . $this->month : $this->month;
    $format .= "-";
    $format .= $this->day < 10 ? "0" . $this->day : $this->day;
    return $format;
  }

  //
  
}
