<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Controller: CounselorConstroller.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Counselor;
use App\Models\CodeBar;
use App\Models\CodeBarCounselor;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DB;

class CounselorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {

    $query = Counselor::query();

    if (Input::has('name'))
    {
      $name = Input::get('name');
      $query->where('name', 'LIKE', "%$name%")->orderBy('name')->paginate(10);
    }

    if (Input::has('name'))
    {
      $name = Input::get('name');
      $query->where('name', 'LIKE', "%$name%")->orderBy('name')->paginate(10);
    }

    $counselors = $query->paginate(10);
    return view('counselors.index',compact('counselors'));
  }


  public function search(Request $request)
  {
    $query = Counselor::query();
    if (Input::has('name'))
    {
      $name = Input::get('name');
      $query->where('name', 'LIKE', "%$name%")->orderBy('name')->paginate(10);
    }
    if (Input::has('name'))
    {
      $name = Input::get('name');
      $query->where('name', 'LIKE', "%$name%")->orderBy('name')->paginate(10);
    }
    $counselors = $query->paginate(10);
    return view('counselors.index',compact('counselors'));
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
        $codeBarCounselor=Request::all();
        DB::table('code_bar_counselors')->insert(
            ['code_bar_id' => $codeBar->id, 
             'counselor_id'=> $codeBarCounselor['counselor']]
        );
        return redirect('counselors');
      }

      return redirect()->back()->withErrors("Code Bar not found.");
    }
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

  public function valDocument($cpf)
  {
    $remove = array('.', '-');
    $add    = array('', '');
    $cpf  = str_replace($remove, $add, $cpf);
    $cpf = preg_replace('/[^0-9]/','',$cpf);
    $digitoA = 0;
    $digitoB = 0;
    for($i = 0, $x = 10; $i <= 8; $i++, $x--){
      $digitoA += $cpf[$i] * $x;
    }
    for($i = 0, $x = 11; $i <= 9; $i++, $x--){
      if(str_repeat($i, 11) == $cpf){
        return false;
      }
      $digitoB += $cpf[$i] * $x;
    }
    $somaA = (($digitoA%11) < 2 ) ? 0 : 11-($digitoA%11);
    $somaB = (($digitoB%11) < 2 ) ? 0 : 11-($digitoB%11);
    if($somaA != $cpf[9] || $somaB != $cpf[10]){
      return false; 
    }else{
      return true;
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
