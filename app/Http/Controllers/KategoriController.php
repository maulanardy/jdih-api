<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function get(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;

        return Kategori::where('KATEGORI_ISAKTIF', 1)->orderBy('KATEGORI_ID', 'ASC')->paginate($limit);
    }

    public function getProdukHukum(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;

        return Kategori::where('KATEGORI_TYPE', "Produk Hukum")->where('KATEGORI_ISAKTIF', 1)->orderBy('KATEGORI_ID', 'ASC')->paginate($limit);
    }

    public function getInformasiHukum(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;

        return Kategori::where('KATEGORI_TYPE', "Informasi Hukum")->where('KATEGORI_ISAKTIF', 1)->orderBy('KATEGORI_ID', 'ASC')->paginate($limit);
    }

    public function getById(Request $request, $id){
        if($id){
            $limit = $request->has('limit') ? $request->limit : 10;

            return Kategori::find($id);
        } else {
            return response()->json(['message' => 'id required'], 400);
        }
    }
}
