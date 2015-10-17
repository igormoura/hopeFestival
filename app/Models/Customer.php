<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Customer.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=[
      'name',
      'document',
      'email',
      'phone',
      'version_id'
    ];

    public function version()
    {
      return $this->belongsTo('App\Models\Version');
    }
}
