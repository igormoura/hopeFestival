<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Customer.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{
    protected $fillable=[
      'name',
      'email',
      'area_code',
      'phone',
      'phone_cel',
      'address',
      'number', 
      'complement',
      'city',
      'state',
      'church',
      'pastor',
      'accreditation'
    ];
}
