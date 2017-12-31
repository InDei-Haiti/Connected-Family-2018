<?php

namespace App\Facades;
use Illuminate\Http\Request;

use Helper;
use Storage;
use Exception;

class Imager
{

  public static function getBase64($folder, $name, $size){
    if(!Storage::exists("/public/imgs/original/$folder/$name")) return;
    while (!$exists = Storage::exists("/public/imgs/$size/$folder/$name"))
      Helper::run("ImgScaler");
    return base64_encode(Storage::get("/public/imgs/$size/$folder/$name"));
  }


}
