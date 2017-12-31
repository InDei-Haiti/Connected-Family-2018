<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Excel;
use App\Models\Member;

class CrewController extends Controller
{

  /* DONE */
  public function show($year = null){
    $crewYears = DB::table('members')->select('year')
                                     ->distinct()->orderBy('year', 'desc')
                                     ->get()->all();
    $valid = true;
    if($year){
      $valid = false;
      foreach ($crewYears as $crewYear)
        if($crewYear->year == trim($year)){
          $valid = true;
          break;
        }
    }
    if(!$valid)
      return view('errors.404');
    if(!$year) $year = $crewYears[0]->year;
    $members = Member::where('year', $year)
                     ->orderBy('position_id', 'desc')
                     ->get()->all();
    return view('crew.crew')->with([
      'members' => $members,
      'crewYears' => $crewYears,
      'year' => $year
    ]);
  }

  /* DONE */
  public function export($year){
    $crewYears = DB::table('members')->select('year')
                                     ->distinct()->orderBy('year', 'desc')
                                     ->get()->all();
    $valid = true;
    if($year){
      $valid = false;
      foreach ($crewYears as $crewYear)
        if($crewYear->year == trim($year)){
          $valid = true;
          break;
        }
    }
    if(!$valid)
      return view('errors.404');
    if(!$year) $year = $crewYears[0]->year;
    $members = Member::where('year', $year)
                     ->orderBy('position_id', 'desc')
                     ->get()->all();
    $ex_members = [];
    foreach ($members as $member) {
      $education = $member->user->educationalInformation->academic_year->name;
      if($member->user->educationalInformation->department)
        $education .=  " - " . $member->user->educationalInformation->department->name;
      $education .= ", " . $member->user->educationalInformation->college->name . " - " . $member->user->educationalInformation->uni->name;
      if(strtotime($member->user->educationalInformation->updated_at) > strtotime('2017-09-01 00:00:00'))
        $education .= " (UPDATED)";
      $email = "N/A";
      if($member->user->email) {
        $email = $member->user->email;
        if($member->user->emailConfirmation) if($member->user->emailConfirmation->confirmed)
          $email .= " (VERIFIED)";
      }
      $facebook = "N/A";
      if($member->user->socialLink("facebook")){
        $facebook = $member->user->socialLink("facebook");
        if($member->user->socialInformation('facebook')->linked)
          $facebook .= " (VERIFIED)";
      }
      $ex_members[] = [
        '#' => $member->id,
        'Committee' => $member->committee->name,
        'Position' => $member->position->name,
        'Name' => $member->user->name,
        'email' => $email,
        'Mobile' => $member->user->mobile ? $member->user->mobile->number : "N/A",
        'Education' => $education,
        'Facebook' => $facebook,
      ];
    }
    Excel::create("Crew'" . substr($year, 2) . date(' @ l d/m/Y', time()), function($excel) use($ex_members) {
      $excel->sheet('Crew', function($sheet) use($ex_members) {
        $sheet->fromArray($ex_members);
      });
    })->download('xlsx');
  }

 
}
