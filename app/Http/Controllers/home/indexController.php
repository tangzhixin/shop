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
        //$user_id=session('name');
        //$user_id=get_object_vars($user_id);
        //$user_id=$user_id['id'];
//        dd($user_id);
        //$cart=DB::table('cart')->join('goods','goods.id','=','cart.goods_id')->get();
//        dd($cart);
        //$goods_ids="";
       // foreach ($cart as $k=>$v){
          //  $goods_ids .=$v->goods_id.",";

       // }
//        dd($goods_ids);
        //$where=[
           // ['uid','=',$user_id],
        //];
//        dd($where);
        //$total=DB::table('cart')->where($where)->pluck('goods_price')->toArray();
        //dd($total);
//        array_sum($total);
        //$res=array_sum($total);
        //dd($res);
        //return view('home/cart',['cart'=>$cart,'goods_ids'=>$goods_ids,'total'=>array_sum($total)]);
     // 以上的代码是我的
        $data=DB::table('cart')->get()->toArray();
//        dd($data);
        $goods_id=array_column($data,'goods_id');
//        dd($goods_id);
        $goods_id=implode(',',$goods_id);
//        dd($goods_id);
        // 总价
        $total=[];
        $pricetotal="";
        foreach ($data as $k=>$v){
            $v=get_object_vars($v);
            $total[]=$v['goods_num']*$v['goods_price'];
            $price=array_sum($total);
//            dd($price);
            $pricetotal=$price;
        }
//        dd($pricetotal);
        return view('home/cart',['data'=>$data,'total'=>$pricetotal,'goods_id'=>$goods_id]);
    }

    // 保存订单
    public function order_detail(Request $request){
        $data=$request->input('total');
        $obj=DB::table('cart')->get();
//        dd($obj);
        $order=time().mt_rand(1000,1111);
//       dd($order);
        $add_time=time();
//        dd($add_time);
        foreach($obj as $k=>$v){
            DB::table('order_detail')->insert([
                'oid'=>$order,
                    'goods_id'=>$v->goods_id,
                    'goods_name'=>$v->goods_name,
                    'goods_pic'=>$v->goods_pic,
                    'pay_mony'=>$data,
                    'add_time'=>$add_time
                ]
            );
        }

            return redirect('home/order_index');
    }
    public  function order_index(Request $request){

        $data=DB::table('cart')->get()->toArray();
//        dd($data);
        $goods_id=array_column($data,'goods_id');
//        dd($goods_id);
        $goods_id=implode(',',$goods_id);
//        dd($goods_id);
        // 总价
        $total=[];
        $pricetotal="";
        foreach ($data as $k=>$v){
            $v=get_object_vars($v);
            $total[]=$v['goods_num']*$v['goods_price'];
            $price=array_sum($total);
//            dd($price);
            $pricetotal=$price;
        }
//        dd($pricetotal);
        $obj=DB::table('order_detail')->get();
        return view('home/order_index',['obj'=>$obj,'total'=>$pricetotal]);
    }


    // 添加订单
    public function order_create(Request $request){
        $pay_money=$request->input('total');
//        dd($pay_money);
        $order=time().mt_rand(1000,1111);
//        dd($order);

        $uid=session('name');
        $uid=get_object_vars($uid);
//        dd($uid);
        $add_time=time();
//        dd($add_time);
        $res=DB::table('order')->insert(
            ['oid'=>$order,'uid'=>$uid['id'],'pay_money'=>$pay_money,'state'=>1,'pay_time'=>0,'add_time'=>$add_time]
        );
//        dd($res);
        if(!empty($res)){
           return redirect('home/order');
        }
    }
    // 订单详情页
    public function order(Request $request){
//        echo 111;die;
        $data=DB::table('order')->get();
//        dd($data);
        return view('home/order',['data'=>$data]);
    }
    // 删除订单
    public function order_del(Request $request){
        $id=$request->input('id');
        $res=DB::table('order')->where('id','=',$id)->delete();
        if(!empty($res)){
            return redirect('home/order');
        }
    }
    // 修改订单状态已过期
    public function order_status(Request $request){
        $order_id=$request->post('order_id');
        DB::table('order')->where('id','=',$order_id)->update(['status'=>3]);
    }
    public function return_url(Request $request){
        $data=$request->all();
        dd($data);
        echo "支付成功";
    }
}
