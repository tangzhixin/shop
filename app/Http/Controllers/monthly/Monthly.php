<?php

namespace App\Http\Controllers\monthly;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Monthly extends Controller
{
    public function login(){
        return view('monthly/login');
    }

    public function do_login(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('monthly')->where(['name'=>$data['name'],'pwd'=>$data['pwd']])->first();
//        dd($obj);
        if(!empty($obj)){
            return redirect('monthly/index');
        }else{
            return redirect('monthly/login');
        }
    }

    public function add(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('liuyan')->insert(
            ['title'=>$data['title'],'add_time'=>time()]
        );
        return redirect('monthly/index');
    }

    public function index(Request $request){
        $data=$request->all();
//        dd($data);
        $name="";
        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num=$redis->get('num');
        echo "访问的次数:".$num;
        if(!empty($data['name'])){
            $name=$data['name'];
//            dd($name);
            $obj=DB::table('liuyan')->where('name','like','%'.$data['name'].'%')->paginate(2);
//            dd($obj);

        }else{
            $obj=DB::table('liuyan')->paginate(2);

        }
//        dd($obj);
        return view('monthly/index',['obj'=>$obj,'name'=>$name]);
    }
    public function del(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('liuyan')->where('id','=',$data['id'])->delete();
        if($obj){
            return redirect('monthly/index');
        }
    }
}