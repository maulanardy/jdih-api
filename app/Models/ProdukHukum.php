<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    protected $table = 'TRA_PRODUK_HUKUM';
    protected $primaryKey = 'PRODUK_ID';
    public $timestamps = false;

    public function file_upload()
    {
        return $this->hasMany(FileUpload::class, 'F_TABLE_COLVALUE');
    }

    public function file() {
        return $this->file_upload()->where('F_TABLE','=', 'TRA_PRODUK_HUKUM');
    }

    public function log()
    {
        return $this->hasMany(ProdukLog::class, 'LOG_PRODUK_ID');
    }
}