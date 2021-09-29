<?php
namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function get(){
        return News::where('BERITA_STATUS', 1)->with('image')->orderBy('BERITA_TIMESTAMP', 'DESC')->paginate(5);
    }

    public function detail($id){
        return News::where('BERITA_ID', $id)->with('image')->first();
    }
}
