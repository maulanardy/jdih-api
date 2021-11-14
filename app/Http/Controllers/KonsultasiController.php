<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Konsultasi;
use App\Mail\GreetingKonsultasi;

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
            Mail::to($request->email)->send(new GreetingKonsultasi($request->nama));
            return new Response("Created", 201);
        } else {
            return new Response("An error occurred", 500);
        }
    }
    public function test(Request $request){
        // Mail::to($request->user())->send(new OrderShipped($order));
        Mail::to("arbomb.serv@gmail.com")->send(new GreetingKonsultasi("Ardy"));
    }
}
