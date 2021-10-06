<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function get(Request $request){
        return Faq::where('FAQ_STATUS', 1)->get();
    }
}
