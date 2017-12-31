<?php

namespace App\Facades;
use Illuminate\Http\Request;

use Mail;
use App\Models\Mailer as MailerModel;
use App\Models\MailerQueue;

class Mailer
{

  /**
   *  Define variables that are needed in email template
   *
   */
  public static $emailAttrs;

  /**
   *  Send email with given subject and content to given user
   *
   *  @param  string $subject, string $view, User $user
   *  @return boolean
   */
  public static function send($subject, $view, $user, $otherEmailAttrs = [], $sender = 'no-reply', $queue = false){
    if(!self::isAbleToSend()){
      if(!$queue)
        return false;
      $queue = new MailerQueue;
      $queue->subject = $subject;
      $queue->view = $view;
      $queue->user_id = $user->id;
      $queue->other_attrs = $otherEmailAttrs;
      $queue->sender = $sender;
      $queue->save();
      return;
    }
    self::$emailAttrs = config("mail.$sender-email-attrs");
    config(["mail.username" => config("mail.$sender-username")]);
    config(["mail.password" => config("mail.$sender-password")]);
    Mail::send(
      "emails." . $view,
      array_merge(
        ['user' => $user],
        self::$emailAttrs,
        $otherEmailAttrs
      ),
      function ($mail) use ($user, $subject) {
        $mail->from(config('mail.username'), self::$emailAttrs['sender']);
        $mail->to($user->email, $user->name)->subject($subject);
    });
    $mailer = self::getOrCreateMailer();
    $mailer->send++;
    $mailer->save();
    return true;
  }


  /**
   *  Return max emails' number you can send per hour.
   *
   *  @param  NULL
   *  @return integer
   */
  public static function maxPerHour(){
    return config('mail.max_per_hour');
  }

  /**
   *  Return time to the next attempt in minute(s).
   *
   *  @param  NULL
   *  @return integer
   */
  public static function timeToNextAttempt(){
    return 60 - date('i', time());
  }

  /**
   *  Check if you reach your max of emails per hours for
   *  the current hour MailerModel
   *
   *  @param  NULL
   *  @return boolean
   */
  public static function isAbleToSend(){
    $mailer = self::getOrCreateMailer();
    if($mailer->send < self::maxPerHour())
      return true;
    return false;
  }

  /**
   *  Get the current hour MailerModel or create it.
   *
   *  @param  NULL
   *  @return MailerModel instance
   */
  private static function getOrCreateMailer(){
    $date = date('Y-m-d H', time());
    $mailer = MailerModel::where('date', $date)->get()->first();
    if(!$mailer){
      $mailer = new MailerModel;
      $mailer->date = $date;
      $mailer->save();
    }
    return $mailer;
  }



}
