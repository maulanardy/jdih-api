<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use App\Models\Kategori;

class ProdukHukumController extends Controller
{
    public function produk(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;
        $kategoriIds = Kategori::where('KATEGORI_TYPE', 'Produk Hukum')->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        return ProdukHukum::whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->orderBy('PRODUK_TAHUN', 'DESC')->orderBy('PRODUK_TIMESTAMP', 'DESC')->paginate($limit);
    }

    public function informasi(Request $request){
        $limit = $request->has('limit') ? $request->limit : 5;
        $kategoriIds = Kategori::where('KATEGORI_TYPE', 'Informasi Hukum')->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        return ProdukHukum::whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->orderBy('PRODUK_TAHUN', 'DESC')->orderBy('PRODUK_TIMESTAMP', 'DESC')->paginate($limit);
    }

    public function produkByCategory(Request $request){
        if($request->has('categories')){
            $limit = $request->has('limit') ? $request->limit : 10;
            $kategoriIds = explode(",", $request->categories);
    
            return ProdukHukum::whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->orderBy('PRODUK_TAHUN', 'DESC')->orderBy('PRODUK_TIMESTAMP', 'DESC')->paginate($limit);
        } else {
            return response()->json(['message' => 'categories required'], 400);
        }
    }

    public function produkById(Request $request, $id){
        if($id){
            return ProdukHukum::where('PRODUK_ID', $id)->with('file')->first();
        } else {
            return response()->json(['message' => 'id required'], 400);
        }
    }
}
