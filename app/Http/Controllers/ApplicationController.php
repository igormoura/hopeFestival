<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Controller: ApplicationConstroller.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
      $applications = Application::all();
      return view('applications.index',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      return view('applications.create');
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
        'description' => 'required'
      ]); 

      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator->errors());
      }
      else
      {
        $application=Request::all();
        Application::create($application);
        return redirect('applications');
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
      $application=Application::find($id);
      return view('applications.show',compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $application=Application::find($id);
      return view('applications.edit',compact('application'));
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
        'description' => 'required'
      ]); 
      
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator->errors());
      }
      else
      {
        $applicationUpdate=Request::all();
        $application=Application::find($id);
        $application->update($applicationUpdate);
        return redirect('applications');
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
      Application::find($id)->delete();
      return redirect('applications');
    }
}
