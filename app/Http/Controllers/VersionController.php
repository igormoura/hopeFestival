<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Controller: VersionConstroller.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Http\Controllers;

use App\Models\Version;
use App\Models\Application;
use App\Models\Archive;
use App\Models\VersionArchives;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Input;

class VersionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $versions=Version::all();
    return view('versions.index',compact('versions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    // queries the clients db table, orders by client_name and lists client_name and id
    //$applications = DB::table('applications')->orderBy('id', 'asc')->lists('name','id');
    $applications = Application::lists('name', 'id');
    $archives = Archive::lists('name','id');
    return view('versions.create', array('applications'=>$applications, 'archives'=>$archives));
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
      'number' => 'required',
      'application_id' => 'required',
      'archives' => 'required'
    ]); 
    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else
    {
      $version = Version::create(['name'           => Input::get('name'),
                                  'number'         => Input::get('number'),
                                  'application_id' => Input::get('application_id')]);
      $version->save();
      foreach (Input::get('archives') as $archive)
      {
        $versionArchives = VersionArchives::create(['version_id' => $version->id,'archive_id' => $archive]);
        $versionArchives->save();
      }
      return redirect('versions');
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
    $version=Version::find($id);
    return view('versions.show',compact('version'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $version=Version::find($id);
    $applications = Application::lists('name', 'id');
    return view('versions.edit',array('version'=>$version, 'applications'=>$applications));
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
      'number' => 'required',
      'application_id' => 'required'
    ]);

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else
    {
      $versionUpdate=Request::all();
      $version=Version::find($id);
      $version->update($versionUpdate);
      return redirect('versions');
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
    Version::find($id)->delete();
    return redirect('versions');
  }
}
