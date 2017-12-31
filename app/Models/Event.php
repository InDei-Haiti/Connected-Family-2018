<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

  public $timestamps = null;

  public function preferences(){
    return $this->hasMany('App\Models\Preference');
  }

  public function interviewDates(){
    return $this->hasMany('App\Models\InterviewDate');
  }

  public function groupDiscussionDates(){
    return $this->hasMany('App\Models\GroupDiscussionDate');
  }

  public function PSTs(){
    return $this->hasMany('App\Models\PST');
  }

  public function participants(){
    return $this->hasMany('App\Models\Participant');
  }

  public function isUpcoming(){
    return time() < strtotime($this->started_at) ? true : false;
  }

  public function isOpened(){
    return time() >= strtotime($this->started_at) && time() < strtotime($this->ended_at) ? true : false;
  }

  public function isClosed(){
    return time() > strtotime($this->ended_at) ? true: false;
  }

  /**
   *  new event is 1st published upcoming or opened event.
   *
   *  @param  void
   *  @return mix
   *          Event $new_event, new event exists.
   *          Null  $new_event, new event doesn't exist.
   */
  public static function getNewEvent(){
    $new_event = null;
    $events = Event::all();
    foreach ($events as $event)
      if( ( $event->isUpcoming() || $event->isOpened() ) && $event->published ){
        $new_event = $event;
        break;
      }
    return $new_event;
  }

  //

}
