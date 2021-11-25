<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $table = 'A_USERWEB';
    protected $primaryKey = 'USER_ID';
    protected $keyType = 'string';
    public $timestamps = false;
}