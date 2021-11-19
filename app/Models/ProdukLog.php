<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLog extends Model
{
    protected $table = 'LOG_DOKUMEN';
    protected $primaryKey = 'LOG_ID';
    public $timestamps = false;
}