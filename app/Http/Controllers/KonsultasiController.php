<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Models\Konsultasi;

class KonsultasiController extends Controller
{
    public function create(Request $request){
        $model = new Konsultasi();
        $model->konsul_nama_depan = $request->nama;
        $model->konsul_nik = $request->nik;
        $model->konsul_email = $request->email;
        $model->konsul_pertanyaan = $request->pertanyaan;
        $model->konsul_penanya_timestamp = Carbon::now();
        $model->konsul_active_flag = 1;

        if($model->save()){
            return new Response("Created", 201);
        } else {
            return new Response("An error occurred", 500);
        }
    }
}
