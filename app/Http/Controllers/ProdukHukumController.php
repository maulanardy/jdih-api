<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukHukum;
use App\Models\Kategori;

class ProdukHukumController extends Controller
{
    public function produk(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;
        $sort = $request->has('sort') ? $request->sort : 'DESC';

        $kategoriIds = Kategori::where('KATEGORI_TYPE', 'Produk Hukum')->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        $produk = ProdukHukum::join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort);
        
        return $produk->paginate($limit);
    }

    public function produkSearch(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;
        $sort = $request->has('sort') ? $request->sort : 'DESC';

        $kategoriIds = Kategori::where(function ($query) use ($request) {
            $query->where('KATEGORI_TYPE', 'Produk Hukum')->orWhere('KATEGORI_TYPE', 'Informasi Hukum');
        })->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        $produk = ProdukHukum::join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort);
        
        if($request->has('keyword')){
            $produk = $produk->where(function ($query) use ($request) {
                $query->where('PRODUK_JUDUL', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('PRODUK_JUDULJDIHN', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('PRODUK_DESC', 'LIKE', '%'.$request->keyword.'%');
            });
        }

        $paginated = $produk->paginate($limit);
        
        return $paginated->appends($request->input());
    }

    public function informasi(Request $request){
        $limit = $request->has('limit') ? $request->limit : 5;
        $sort = $request->has('sort') ? $request->sort : 'DESC';

        $kategoriIds = Kategori::where('KATEGORI_TYPE', 'Informasi Hukum')->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        return ProdukHukum::join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort)->paginate($limit);
    }

    public function informasiSearch(Request $request){
        $limit = $request->has('limit') ? $request->limit : 10;
        $sort = $request->has('sort') ? $request->sort : 'DESC';

        $kategoriIds = Kategori::where('KATEGORI_TYPE', 'Informasi Hukum')->where('KATEGORI_ISAKTIF', 1)->pluck("KATEGORI_ID");

        $produk = ProdukHukum::join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort);
        
        if($request->has('keyword')){
            $produk = $produk->where(function ($query) use ($request) {
                $query->where('PRODUK_JUDUL', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('PRODUK_JUDULJDIHN', 'LIKE', '%'.$request->keyword.'%')
                        ->orWhere('PRODUK_DESC', 'LIKE', '%'.$request->keyword.'%');
            });
        }

        $paginated = $produk->paginate($limit);
        
        return $paginated->appends($request->input());
    }

    public function produkByCategory(Request $request){
        if($request->has('categories')){
            $limit = $request->has('limit') ? $request->limit : 10;
            $sort = $request->has('sort') ? $request->sort : 'DESC';
            $kategoriIds = explode(",", $request->categories);

            $produk = ProdukHukum::distinct('PRODUK_NOMOR_PERATURAN')->join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort);
            
            if($request->has('judul_not')){
                $produk = $produk->where('PRODUK_JUDUL', 'NOT LIKE', '%'.$request->judul_not.'%');
            }

            if($request->has('judul')){
                $produk = $produk->where('PRODUK_JUDUL', 'LIKE', '%'.$request->judul.'%');
            }

            if($request->has('upt')){
                $produk = $produk->where('PRODUK_USER_NAMA', $request->upt);
            }

            if($request->has('bahasa')){
                $produk = $produk->where('PRODUK_BAHASA', $request->bahasa);
            }

            $paginated = $produk->paginate($limit);
            
            return $paginated->appends($request->input());
        } else {
            return response()->json(['message' => 'categories required'], 400);
        }
    }

    public function produkSearchByCategory(Request $request){
        if($request->has('categories')){
            $limit = $request->has('limit') ? $request->limit : 10;
            $sort = $request->has('sort') ? $request->sort : 'DESC';
            $kategoriIds = explode(",", $request->categories);

            $produk = ProdukHukum::join('TRA_FILEUPLOADS', 'TRA_FILEUPLOADS.F_TABLE_COLVALUE', '=', 'TRA_PRODUK_HUKUM.PRODUK_ID')->where('F_TYPE', 'PRODUK')->where('F_ISACTIVE', '1')->whereIn('PRODUK_KATEGORI_ID', $kategoriIds)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->with('file')->with('log')->orderBy('PRODUK_TAHUN', $sort)->orderBy('PRODUK_TIMESTAMP', $sort);
            
            if($request->has('judul_not')){
                $produk = $produk->where('PRODUK_JUDUL', 'NOT LIKE', '%'.$request->judul_not.'%');
            }

            if($request->has('judul')){
                $produk = $produk->where('PRODUK_JUDUL', 'LIKE', '%'.$request->judul.'%');
            }

            if($request->has('upt')){
                $produk = $produk->where('PRODUK_USER_NAMA', $request->upt);
            }

            if($request->has('bahasa')){
                $produk = $produk->where('PRODUK_BAHASA', $request->bahasa);
            }

            if($request->has('keyword')){
                $produk = $produk->where(function ($query) use ($request) {
                    $query->where('PRODUK_JUDUL', 'LIKE', '%'.$request->keyword.'%')
                          ->orWhere('PRODUK_JUDULJDIHN', 'LIKE', '%'.$request->keyword.'%')
                          ->orWhere('PRODUK_DESC', 'LIKE', '%'.$request->keyword.'%');
                });
            }

            $paginated = $produk->paginate($limit);
            
            return $paginated->appends($request->input());
        } else {
            return response()->json(['message' => 'categories required'], 400);
        }
    }

    public function produkById(Request $request, $id){
        if($id){
            return ProdukHukum::where('PRODUK_ID', $id)->with('file')->with('log')->first();
        } else {
            return response()->json(['message' => 'id required'], 400);
        }
    }

    public function countPermenaker(Request $request){
        return ProdukHukum::select(ProdukHukum::raw('PRODUK_STATUS, COUNT(PRODUK_ID) as JUMLAH'))
        ->whereIn('PRODUK_KATEGORI_ID', [16])
        ->where('PRODUK_STATUS', '<>', 99)
        ->where('PRODUK_JUDUL', 'LIKE', '%MENAKER%')
        ->groupBy('PRODUK_STATUS')
        ->get();
    }

    public function countPerBp2mi(Request $request){
        return ProdukHukum::select(ProdukHukum::raw('PRODUK_STATUS, COUNT(PRODUK_ID) as JUMLAH'))
        ->whereIn('PRODUK_KATEGORI_ID', [17])
        ->where('PRODUK_STATUS', '<>', 99)
        ->groupBy('PRODUK_STATUS')
        ->get();
    }

    public function countKepka(Request $request){
        return ProdukHukum::select(ProdukHukum::raw('PRODUK_STATUS, COUNT(PRODUK_ID) as JUMLAH'))
        ->whereIn('PRODUK_KATEGORI_ID', [7])
        ->where('PRODUK_STATUS', '<>', 99)
        ->where('PRODUK_JUDUL', 'LIKE', '%KEPKA%')
        ->groupBy('PRODUK_STATUS')
        ->get();
    }

    public function countSEKepala(Request $request){
        return ProdukHukum::select(ProdukHukum::raw('PRODUK_STATUS, COUNT(PRODUK_ID) as JUMLAH'))
        ->whereIn('PRODUK_KATEGORI_ID', [8])
        ->where('PRODUK_STATUS', '<>', 99)
        ->groupBy('PRODUK_STATUS')
        ->get();
    }
}
