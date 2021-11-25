<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Upt;
use App\Models\UserWeb;
use App\Models\ProdukHukum;

class UptController extends Controller
{
    public function get(Request $request){
        $adminUpt = UserWeb::distinct('USER_ID')->join('M_UPT', 'A_USERWEB.USER_UNITKERJA', '=', 'M_UPT.UPT_ID')->where('USER_SECTION', 'ADMINUPT')->where('STATUS', 'ENABLE')->get();
        $adminUptHasProduk = [];

        foreach($adminUpt as $adm){
            $produk = ProdukHukum::where('PRODUK_USER_NAMA', $adm->USER_ID)->where('PRODUK_STATUS', '!=', 99)->where('PRODUK_STATUS_ACTIVE', 1)->get();
            if(!$produk->isEmpty()){
                $adminUptHasProduk[] = $adm;
            }
        }
        
        return $adminUptHasProduk;
    }
}
