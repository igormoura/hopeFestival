<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Controller: ArchiveConstroller.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Version;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Input;
use Redirect;
use Session;

class ArchiveController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $archives=Archive::all();
    return view('archives.index',compact('archives'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $versions = Version::lists('name', 'id');
    return view('archives.create', array('versions'=>$versions));
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
      'archive_url' => 'required'
    ]);

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else
    {
      $archive=Request::all();
      Archive::create($archive);
      return redirect('archives');

      // Upload File - Error @igormoura
      /*if (Input::file('archive_url')) {
        $destinationPath = '/app/Files/'; // upload path
        $extension = Input::file('archive_url')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('archive_url')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        Session::flash('success', 'Upload successfully'); 
        return Redirect::to('archives');
      }
      else {
        // sending back with error message.
        Session::flash('error', 'uploaded file is not valid');
        return redirect()->back();
      }*/
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
    $archive=Archive::find($id);
    return view('archives.show',compact('archive'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $archive=Archive::find($id);
    return view('archives.edit',compact('archive'));
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
      'archive_url' => 'required'
    ]);

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors());
    }
    else
    {
      $archiveUpdate=Request::all();
      $archive=Archive::find($id);
      $archive->update($archiveUpdate);
      return redirect('archives');
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
    Archive::find($id)->delete();
    return redirect('archives');
  }
}
