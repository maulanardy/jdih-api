<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'TRA_FAQ';
    protected $primaryKey = 'FAQ_ID';
    public $timestamps = false;
}