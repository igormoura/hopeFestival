<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Customer.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Checking extends Model
{
    protected $fillable=[
      'accreditation_id',
      'confirmed',
      'day_event'
    ];
}
