<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Version.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $fillable=[
      'name',
      'number',
      'application_id',
      'archives'
    ];

    public function application()
	  {
	    return $this->belongsTo('App\Models\Application');
	  }

	  public function archives()
	  {
	    return $this->belongsToMany('App\Models\Archive');
	  }

	  public function customer()
    {
      return $this->hasOne('App\Customer');
    }
}
