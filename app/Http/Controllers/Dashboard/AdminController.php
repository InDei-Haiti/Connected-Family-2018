<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Position;
use App\Models\Committee;

class AdminController extends Controller
{

  public function showAdd(){
    return view('dashboard.admins.add')->with([
    
    ]);
  }

  public function showManage(){
    return view('dashboard.admins.manage')->with([
      'admins' => Admin::all(),
    
    ]);
  }

  public function doAdd(){
    
  }

  public function doEdit(){
    
  }

  public function doDelete(){
    
  }

}
