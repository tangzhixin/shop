<?php

namespace App\Http\Controllers\zhokao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Studen extends Controller
{
    public function index(Request $request){
        $req=$request->all();

//        dd($req);
        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        if(!$redis->get('info')){
            if(!empty($req['place']) || !empty($req['arrival'])){
                $redis->incr('num');
            }else{
                $list=DB::table('Studen')->get();
//                dd($list);
            }

            $num=$redis->get('num');
            echo "搜索的次数:".$num;
            if($num > 5){
                $redis_info=json_encode($list);
                $redis->set('info',$redis_info,3 * 60);
            }
        }else{
            $list=json_decode($redis->get('info'),1);
        }
//        dd($num);

        if(!empty($req['place']) || !empty($req['arrival'])){
            $info=DB::table('Studen')->where('place','like','%'.$req['place'].'%')->where('arrival','like','%'.$req['arrival'].'%')->paginate(2);
        }else{
            $info=DB::table('Studen')->paginate(2);
        }
//        dd($req);

        return view('zhokao/index',['data'=>$info,'place'=>$req['place'],'arrival'=>$req['arrival']]);
    }
    public function add(){
        return view('zhokao/add');
    }
    public function do_add(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('Studen')->insert(
            ['train'=>$data['train'],'place'=>$data['place'],'arrival'=>$data['arrival'],'price'=>$data['price'],'sheets'=>$data['sheets'],'place_time'=>time(),'arrival_time'=>time()]
        );
        if($obj){
            return redirect('Studen/index');
        }
    }

}