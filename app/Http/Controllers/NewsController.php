<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
    public function get(Request $request){
        $sort = $request->has('sort') ? $request->sort : 'DESC';

        return News::where('BERITA_STATUS', 1)->with('image')->orderBy('BERITA_ID', $sort)->paginate(5);
    }

    public function detail($id){
        return News::where('BERITA_ID', $id)->with('image')->first();
    }
}
