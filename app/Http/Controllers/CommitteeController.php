<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Committee;
use App\Models\Member;

class CommitteeController extends Controller
{
  /* DONE */
  public function all(){
    $committees = Committee::all();
    return view('committee.committees')->with(['committees' => $committees]);
  }

  /* DONE */
  public function show($short_name, $year = null){
    $committee = Committee::where('short_name', $short_name)->get()->first();
    if (!$committee)  return view('errors.404');
    $committeeYears = DB::table('members')->where('committee_id', $committee->id)
                                          ->select('year')
                                          ->distinct()->orderBy('year', 'desc')
                                          ->get()->all();
    $valid = true;
    if ($year) {
      $valid = false;
      foreach ($committeeYears as $committeeYear) {
        if ($committeeYear->year == trim($year)) {
          $valid = true;
          break;
        }
      }
    }
    if (!$valid)  return view('errors.404');
    if (!$year)   $year = $committeeYears[0]->year;
    $members = Member::where('committee_id', $committee->id)
                     ->where('year', $year)
                     ->orderBy('position_id', 'desc')
                     ->get()->all();
    return view('committee.committee')->with([
        'committee' => $committee,
        'members' => $members,
        'committeeYears' => $committeeYears,
        'year' => $year
    ]);
  }
}
