<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: Customer.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $fillable=[
      'code_bar_id',
      'counselor_id'
    ];

    public function counselor()
    {
      return $this->belongsTo('App\Models\Counselor');
    }

    public function codeBar()
    {
      return $this->belongsTo('App\Models\CodeBar');
    }

}
