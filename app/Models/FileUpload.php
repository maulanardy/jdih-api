<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $table = 'TRA_FILEUPLOADS';
    protected $primaryKey = 'F_ID';
    public $timestamps = false;
}