<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Application.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  protected $fillable=[
	  'name',
	  'description'
  ];

  public function versions()
  {
    return $this->hasMany('App\Models\Version');
  }
}
