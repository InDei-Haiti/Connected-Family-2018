<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Image;
use Mailer;
use Storage;
use App\Models\MailerQueue;
use App\Models\UserProfilePicture as ProfilePicture;

class HelperController extends Controller
{

  /* DONE */
  public function handler($function, $token = ""){
    if($function == "ImgScaler") self::imgScaler();
    if($function == "ImgRemover") self::imgRemover();
    if($function == "MailerQueue") self::mailerQueue();
    abort(404);
  }

  /* DONE */
  private static function imgScaler(){
    // define
    $imgDirName = ['32', '64', '128', '256', '512'];
    //
    $originalDir = Storage::directories('/public/imgs/original');
    for($i = 0, $countImgDirName = count($imgDirName); $i < $countImgDirName; $i++)
      if(Storage::exists("/public/imgs/" . $imgDirName[$i]))
        Storage::makeDirectory("/public/imgs/" . $imgDirName[$i]);
    for($i = 0, $countImgDirName = count($imgDirName); $i < $countImgDirName; $i++)
      $imgDir[] = Storage::directories('/public/imgs/' . $imgDirName[$i]);
    // on original sub dirs
    for($i = 0; $i < count($originalDir); $i++) {
      // create missing directories...
      for($j = 0, $countImgDir = count($imgDir); $j < $countImgDir; $j++) {
        $osdr = str_replace('original', $imgDirName[$j], $originalDir[$i]);
        if(!isset($imgDir[$j][$i]) || $osdr !== $imgDir[$j][$i])
          Storage::makeDirectory($osdr);
      }
      // create missing imgs...
      $originalSubDir = Storage::files($originalDir[$i]);
      for($k = 0; $k < count($originalSubDir); $k++){
        for($j = 0; $j < count($imgDir); $j++) {
          $ossdr = str_replace('original', $imgDirName[$j], $originalSubDir[$k]);
          $imgExists = Storage::exists($ossdr);
          if(!$imgExists){
            $img = Image::make(Storage::get($originalSubDir[$k]));
            if(strpos($ossdr, 'pictures')){
              $img->fit($img->width(), $img->width(), function(){}, 'top');
              $img->resize((int)$imgDirName[$j], (int)$imgDirName[$j]);
            } else {
              $img->resize((int)$imgDirName[$j], null, function ($constraint) {
                $constraint->aspectRatio();
              });
            }
            $img->save(storage_path('app/' . $ossdr));
          }
        }
      }
    }
  }

  /* DONE */
  private static function imgRemover(){
    $images = ProfilePicture::all();
    foreach($images as $image)
      $db_images[] = $image->src;
    $originalDir = Storage::files('/public/imgs/original/pictures');
    foreach($originalDir as $file)
      $original_images[] = pathinfo($file)["basename"];
    $imgDirName = ['32', '64', '128', '256', '512'];
    foreach($original_images as $original_image)
      if(!in_array($original_image, $db_images)){
        if(file_exists(storage_path("app/public/imgs/original/pictures/".$original_image))) unlink(storage_path("app/public/imgs/original/pictures/".$original_image));
        $count = count($imgDirName);
        for($j = 0; $j < $count; $j++)
          if(file_exists(storage_path("app/public/imgs/original/pictures/".$original_image))) unlink(storage_path("app/public/imgs/" . $imgDirName[$j] . "/pictures/".$original_image));
      }
  }

  /* DONE */
  private static function mailerQueue(){
    $queue = MailerQueue::where('state', false)->get()->all();
    foreach ($queue as $mail) {
      if(Mailer::isAbleToSend()){
        Mailer::send($mail->subject, $mail->view, $mail->user, $mail->other_attrs, $mail->sender);
        $mail->state = true;
        $mail->save();
      }
    }
  }

}
