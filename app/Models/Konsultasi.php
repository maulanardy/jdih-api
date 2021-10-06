<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'TRA_KONSULTASI';
    protected $primaryKey = 'KONSUL_ID';
    public $timestamps = false;
}