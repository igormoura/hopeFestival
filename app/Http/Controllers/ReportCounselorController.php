<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Controller: CounselorConstroller.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Counselor;
use App\Models\CodeBar;
use App\Models\Accreditation;
use App\Models\Checking;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Input;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportCounselorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $counselors = Counselor::query();
    $counselors = $counselors->paginate(10);
    return view('reports.index',compact('counselors'));
  }

  public function reportByDate(Request $request)
  {
    $start_date = Input::get('start_date');
    $end_date   = Input::get('end_date');
    $counselors = array();

    if (Input::has('start_date') && Input::has('start_date'))
    {
      $checkings = DB::table('checking')->whereBetween('day_event', [$start_date, $end_date])->get();
      foreach ($checkings as $i => $checking) {
        $accreditation = DB::table('accreditation')->where('id', $checking->accreditation_id)->first();
        $counselor = Counselor::find($accreditation->counselor_id);  
        array_push($counselors, $counselor);
      }
    }

    $items = collect($counselors);
    $total = count($counselors);
    $page = Input::get('page', 1);
    $perPage = 10;

    if(Input::has('start_date'))
    {
      $begin =Input::get('start_date');
    }
    
    $counselors = new LengthAwarePaginator(
        $items->forPage($page, $perPage), $items->count(), $perPage, $page
    );

    return view('reports.index',compact('counselors', 'begin', 'end_date', 'total'));
  }
}
