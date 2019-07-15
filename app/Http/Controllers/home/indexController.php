<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class indexController extends Controller
{
    // 商品列表页
    public function index(Request $request){
        $data=$request->all();
        $obj=DB::table('goods')->get();
//        dd($obj);
        return view('home/index',['goods_info'=>$obj]);
    }
    // 商品详情页
    public function product(Request $request){
        $id = $request->all('id');
//        dd($id);
        $data = DB::table('goods')->find($id);
//         dd($data);
        return view('home/product',['data'=>$data]);
    }
    // 添加到购物车
    public function do_product(Request $request){

    }
}
