<?php

/**
 * VMS - Version Management System
 * Igor Moura - 2015 (Model: VersionArchives.php)
 * PSN (http://vms-igormoura.herokuapp.com)
 *
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VersionArchives extends Model
{
  protected $fillable=[
    'version_id',
    'archive_id'
  ];
}
