<?php

namespace App\Http\Controllers\long;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class LongitudeController extends Controller
{
    public function index(){
//        echo 111;die;
        return view('long/index');
    }
    public function info(Request $request){
//        dd($request->all());
        if(empty($request->all()['access_token']) || $request->all()['access_token'] != '45678'){
            echo json_encode(['arr'=>'-1']);
        }
        $info=DB::table('game')->get()->toArray();
        $info=json_decode(json_encode($info),1);
        echo json_encode($info);
    }
}