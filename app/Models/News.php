<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'TRA_BERITA';
    protected $primaryKey = 'BERITA_ID';
    public $timestamps = false;

    public function file_upload()
    {
        return $this->hasMany(FileUpload::class, 'F_TABLE_COLVALUE');
    }

    public function image() {
        return $this->file_upload()->where('F_TABLE','=', 'TRA_BERITA')->where('F_ISACTIVE','=', '1');
    }
}