<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function add_goods(){
        return view('admin.add_goods');
    }
    public function  do_add_goods(Request $request){
//        dd($_FILES);
        $path=$request->file('goods_name')->store('goods');
//        dd($path);
        if(empty($path)){
            echo "file";die;
        }else{
            $path=$request->file('goods_name')->store('goods');
        }
        echo asset('storage').'/'.$path;
    }

}
