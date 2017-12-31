<?php

namespace App\Facades;
use Illuminate\Http\Request;

use Exception;

class Date
{

  private static $timeInSeconds = [
    'year' => 1 * 60 * 60 * 24 * 365,
    'month' => 1 * 60 * 60 * 24 * 30,
    'week' => 1 * 60 * 60 * 24 * 7,
    'day' => 1 * 60 * 60 * 24,
    'hour' => 1 * 60 * 60,
    'minute' => 1 * 60,
    'second' => 1,
  ];

  public static function now(){
    return date('Y-m-d H:i:s', time());
  }

  public static function after($key, $times = 1){
    if(!array_key_exists($key, self::$timeInSeconds))
      throw new Exception("[Invaild parameter \"\$key\"] $key Must be listed in \"\$timeInSeconds\" list!");
    return date('Y-m-d H:i:s', time() + ( self::$timeInSeconds[$key] * $times ));
  }

  public static function before($key, $times = 1){
    if(!array_key_exists($key, self::$timeInSeconds))
      throw new Exception("[Invaild parameter \"\$key\"] $key Must be listed in \"\$timeInSeconds\" list!");
    return date('Y-m-d H:i:s', time() - ( self::$timeInSeconds[$key] * $times ));
  }

  public static function format($time, $type = 'birthday'){
    if($type == "birthday") 
      return date('d M, Y', strtotime($time));
    if($type == "event") 
      return date('d M, Y h:iA', strtotime($time));
    return date('l d/m/Y h:iA', strtotime($time));
  }

  /*

  public $fullDate;

  public $date;
  public $day;
  public $month;
  public $year;

  public $time;
  public $hour;
  public $minute;
  public $second;


  public function __construct($date){
    $this->fullDate = $date;
    $date_time = explode(' ', $date);
    $this->date = $date_time[0];
    $date = explode('-', $date_time[0]);
    $this->year = $date[0];
    $this->month = $date[1];
    $this->day = $date[2];
    $this->time = $date_time[1];
    $time = explode(':', $date_time[1]);
    $this->hour = $time[0];
    $this->minute = $time[1];
    $this->second = $time[2];
  }

  public function isBefore($date){
    $d = new Date($date);
    return strtotime($this->$fullDate) < strtotime($d->fullDate);
  }

  public function isAfter($date){
    $d = new Date($date);
    return strtotime($this->$fullDate) > strtotime($d->fullDate);
  }

  */

}
