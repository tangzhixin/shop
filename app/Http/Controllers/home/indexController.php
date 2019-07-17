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
//        echo 111;die;
        $goods_id = $request->input('id');
        $goodsInfo = DB::table('goods')->find($goods_id);
        $goodsInfo = get_object_vars($goodsInfo);
//        dd($goodsInfo);
//                dd(session('name'));
        $data = get_object_vars(session('name'));
//        dd($data);
        $info = DB::table('cart')->where('goods_id', '=', $goods_id)->first();
//        dd($info);
        $where=[
            ['goods_id','=',$goods_id],
        ];
        if (!empty($info)) {
            DB::table('cart')->where($where)->update(['goods_num' => $info->goods_num + 1]);
            return redirect('home/cart');
        } else {
            $res = DB::table('cart')->insert(
                ['goods_id' => $goodsInfo['id'], 'goods_price' => $goodsInfo['goods_price'], 'add_time' => time(), 'goods_pic' => $goodsInfo['goods_pic'], 'goods_name' => $goodsInfo['goods_name'], 'uid' => $data['id'], 'goods_num' => 1]
            );
            if ($res) {
//                echo "添加数据库成功";
                return redirect('home/cart');
            }
        }
    }
    // 购物车列表
    public function cart(Request $request){
        $user_id=session('name');
        $user_id=get_object_vars($user_id);
        $user_id=$user_id['id'];
//        dd($user_id);
        $cart=DB::table('cart')->join('goods','goods.id','=','cart.goods_id')->get();
//        dd($cart);
        $goods_ids="";
        foreach ($cart as $k=>$v){
            $goods_ids .=$v->goods_id.",";
        }
//        dd($goods_ids);
        $where=[
            ['uid','=',$user_id],
        ];
//        dd($where);
        $total=DB::table('cart')->where($where)->pluck('goods_price')->toArray();
//        dd($total);
//        array_sum($total);
        return view('home/cart',['cart'=>$cart,'goods_ids'=>$goods_ids,'total'=>array_sum($total)]);
    }
    // 添加订单
    public function order_create(Request $request){

    }
    // 订单详情页
    public function order(){

    }
}
