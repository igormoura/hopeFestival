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
    $page = Input::get('page', 1);
    $perPage = 10;

    $counselors = new LengthAwarePaginator(
        $items->forPage($page, $perPage), $items->count(), $perPage, $page
    );

    return view('reports.index',compact('counselors'));
  }

  public function register(Request $request)
  {
    $validator = Validator::make(Request::all(), [
      'code_bar' => 'required'
      ]); 
    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else 
    {
      $codeBar = DB::table('code_bars')->where('serial', Input::get('code_bar'))->first();
      if(isset($codeBar))
      {
        if($codeBar->active==0)
        {
          $codeBar = CodeBar::find($codeBar->id);
          $codeBar->active = 1;
          $codeBar->save();
          
          $codeBarCounselor=Request::all();

          $counselor = Counselor::find($codeBarCounselor['counselor']);
          
          $counselor->accreditation = 1;
          $counselor->save();

          DB::table('accreditation')->insert(
            ['code_bar_id' => $codeBar->id, 
            'counselor_id'=> $codeBarCounselor['counselor'],
            'created_at' =>  new \DateTime('NOW'),
            'updated_at' =>  new \DateTime('NOW')]
            );
          return redirect('counselors');
        }else{
          return redirect()->back()->withErrors("Codigo de barra já registrado.");
        }
        
      }

      return redirect()->back()->withErrors("Code Bar not found.");
    }
  }

  public function checkingCodeBar(Request $request)
  {
    $checkingCodeBar=Request::all();
    $codeBar = DB::table('code_bars')->where('serial', $checkingCodeBar['code_bar'])->first();

    if(!empty($codeBar)){
      $accreditation = DB::table('accreditation')->where('code_bar_id', $codeBar->id)->first();
      if(!empty($accreditation))
      {
        $checking_db = DB::table('checking')->whereAccreditationIdAndDayEvent($accreditation->id, \Date('Y-m-d'))->get();
        if(!empty($checking_db))
        {
          return redirect()->back()->withErrors("Checking já realizado");
        }
        elseif(empty($checking_db))
        {
          DB::table('checking')->insert(
            ['accreditation_id' => $accreditation->id, 
            'confirmed'=> 1,
            'day_event'=> \Date('Y-m-d'),
            'created_at' =>  new \DateTime('NOW'),
            'updated_at' =>  new \DateTime('NOW')]
            );
          return redirect('counselors');
        }
      }
      return redirect()->back()->withErrors("Codigo de barra não credenciado a um conselheiro.");      
    }
    Session::flash('message1', 'My message');
    return redirect()->back();
  }

  public function checking(Request $request)
  {

      $checking=Request::all();
      $accreditation = DB::table('accreditation')->where('counselor_id', $checking['counselor'])->first();
      $counselor = Counselor::find($checking['counselor']);
      $checking_db = DB::table('checking')->whereAccreditationIdAndDayEvent($accreditation->id, $checking['day_event'])->get();

      if(!empty($checking_db))
      {
        return redirect()->back()->withErrors($counselor->name." Já realizou o checking no dia ".date("d/m/Y", strtotime($checking['day_event'])));
      }
      elseif(empty($checking_db))
      {
        DB::table('checking')->insert(
          ['accreditation_id' => $accreditation->id, 
          'confirmed'=> 1,
          'day_event'=> $checking['day_event'],
          'created_at' =>  new \DateTime('NOW'),
          'updated_at' =>  new \DateTime('NOW')]
          );
        return redirect('counselors');
      }

      return redirect()->back()->withErrors("Code Bar not found.");
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $applications_version = array();
    $applications = Application::lists('name', 'id');

    foreach ($applications as $id => $application) {
      $versions = Version::where('application_id', $id)
      ->orderBy('id', 'desc')
      ->get();
      foreach ($versions as $id => $version) {
        $applications_version=array($version->id=>$application.' - '.$version->name) + $applications_version; 
      }
    }
    return view('counselors.create', array('applications_version'=>$applications_version));
  }

  /**
   * Store a newly created resource in storage.
   * 
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make(Request::all(), [
      'name' => 'required',
      'document' => 'required',
      'email' => 'required|email|max:255|unique:counselors',
      'phone' => 'required',
      'version_id' => 'required',
      ]); 

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else 
    {
      if(!$this->valDocument(Input::get('document'))){
        return redirect()->back()->withErrors(['The document field is invalid.']);
      }
      $counselor=Request::all();
      Counselors::create($counselor);
      return redirect('counselors');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $counselor=Counselors::find($id);
    return view('counselors.show',compact('counselor'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $counselor=Counselors::find($id);
    $applications_version = array();
    $applications = Application::lists('name', 'id');
    foreach ($applications as $id => $application) {
      $versions = Version::where('application_id', $id)
      ->orderBy('id', 'desc')
      ->get();
      foreach ($versions as $id => $version) {
        $applications_version=array($version->id=>$application.' - '.$version->name) + $applications_version; 
      }
    }
    return view('counselors.edit', array('counselor' => $counselor,'applications_version'=>$applications_version));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $validator = Validator::make(Request::all(), [
      'name' => 'required',
      'document' => 'required', 
      'email' => 'required|email|max:255',
      'phone' => 'required',
      'version_id' => 'required',
      ]); 

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else {
      if(!$this->valDocument(Input::get('document'))){
        return redirect()->back()->withErrors(['Invalid document, please enter a correct Document!']);
      }
      $counselorUpdate=Request::all();
      $counselor=Counselors::find($id);
      $counselor->update($counselorUpdate);
      return redirect('counselors');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Counselors::find($id)->delete();
    return redirect('counselors');
  }
}
