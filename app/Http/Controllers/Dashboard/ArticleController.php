<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Helper;
use Session;
use Redirect;

use App\Models\Article;

class ArticleController extends Controller
{

  public function showAdd(){
    return view('dashboard.articles.add')->with([

    ]);
  }

  public function showManage(){

  }

  public function doAdd(Request $request){
    $this->validate($request, [
      'title' => 'required|string|max:255',
      'name' => 'regex:/^[\pL\s\-]+$/u|max:255',
      'picture' => 'mimes:jpeg,png|max:1024',
      'image' => 'mimes:jpeg,png|max:1024',
      'email' => 'nullable|email|max:128',
      'content' => 'string',
      'lang' => 'required|in:ar,en'
    ]);

    $article = new Article;
    $article->magazine_id = 1;
    $article->title = $request->input('title');
    $article->name = ucwords(strtolower($request->input('name')));
    $article->email = $request->input('email');
    $article->content = $request->input('content');
    $article->lang = $request->input('lang');
    $article->image_src = $request->image ? basename($request->image->store('public/imgs/original/magazine')) : NULL;
    $article->picture_src = $request->picture ? basename($request->picture->store('public/imgs/original/magazine')) : NULL;
    $article->save();
    Helper::run('ImgScaler');
    Session::flash('success', "Added successfully!");
    return Redirect::back();
  }

  public function doEdit(){

  }

  public function doDelete(){

  }

}
