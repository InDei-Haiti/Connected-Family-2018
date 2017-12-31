<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Magazine;
use App\Models\Article;

class MagazineController extends Controller
{

  public function show($name){
    $magazine = Magazine::where('name', $name)->get()->first();
    if(!$magazine) abort(404);
    return view('magazine.slider')->with([
      'articles' => $magazine->articles,
      'articlesCount' => count($magazine->articles),
    ]);
  }
}
