<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Models\Rating;

class RatingController extends Controller
{
    public function find(Request $request){
        $exist = Rating::where('RATING_IPADDR', $request->ip())->whereMonth('RATING_TIMESTAMP', '=', Carbon::now()->format("m"))->first();
        if(!$exist){
            $model = new Rating();
            // $model->rating_value = $request->rating;
            $model->rating_ipaddr = $request->ip();
            $model->rating_timestamp = Carbon::now();
            $model->save();

            return response()->json(['code' => 'RATE_INIT'], 201);
        } else {
            if($exist->RATING_VALUE == null){
                return response()->json(['code' => 'RATE_REQUIRED'], 400);
            } else {
                return response()->json(['code' => 'RATE_EXIST'], 201);
            }
        }

        return new Response("An error occurred", 500);
    }

    public function create(Request $request){
        $exist = Rating::where('RATING_IPADDR', $request->ip())->whereMonth('RATING_TIMESTAMP', '=', Carbon::now()->format("m"))->first();
        if(!$exist){
            return response()->json(['code' => 'RATE_NOT_FOUND'], 400);
        } else {
            if($exist->RATING_VALUE == null){
                $exist->rating_value = $request->rating;
                $exist->save();

                return response()->json(['code' => 'SAVED'], 201);
            } else {

                return response()->json(['code' => 'EXIST'], 400);
            }
        }

        return new Response("An error occurred", 500);
    }
}
