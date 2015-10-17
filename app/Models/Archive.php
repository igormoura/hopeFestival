<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Archive.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
  protected $fillable=[
    'name',
    'archive_url'
  ];

  public function versions()
	{
  	return $this->belongsToMany('App\Models\Version');
	}
}
