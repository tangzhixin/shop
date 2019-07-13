<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{
    public function index(Request $request){
        // echo 111;
        $req=$request->all();
        // var_dump($req);
        $search="";
        if(!empty($req['search'])){
            $search=$req['search'];
            $info=DB::table('goods')->where('name','like','%'.$req['search'].'%')->paginate(2);
        }else{
            $info=DB::table('goods')->paginate(2);
        }

        return view('admin/index',['admin'=>$info,'search'=>$search]);
    }
    public function add(){
        return view('admin/add');
    }
    public  function  do_add(Request $request){
        $data=$request->all();
        $path=$request->file('goods_pic');
//        dd($path);
        if(empty($path)){
            echo "file";die;
        }else{
            $path=$request->file('goods_pic')->store('goods');
        }
        $path=('/storage/'.$path);
//        dd($obj);
        $res=DB::table('goods')->insert(
          ['goods_name'=>$data['goods_name'],'goods_pic'=>$path,'goods_price'=>$data['goods_price'],'add_time'=>time()]
        );
        if($res){
            return redirect('admin/index');
        }
    }

    public function del(Request $request){
        $data=$request->all();
        $res=DB::table('goods')->delete($data);
        if($res){
            return redirect('admin/index');
        }
    }

    public function update(Request $request){
        $data=$request->all();
        $obj=DB::table('goods')->where(['id'=>$data['id']])->first();
//        dd($obj);
        return view('admin/update',['obj'=>$obj]);
    }
    public function do_update(Request $request){
        $files=$request->file('goods_pic');
        $id=$request->all()['id'];
        $where=[
            ['id','=',$id]
        ];
        if(empty($files)){
            echo "false";
        }else{
            $path=$request->file('goods_pic')->store('goods');
            $goods_pic=('/storage/'.$path);
            $arr=['goods_pic'=>$goods_pic];
            $res=DB::table('goods')->where($where)->update($arr);
        }
        $data=$request->all();
        $obj=['goods_name'=>$data['goods_name'],'goods_price'=>$data['goods_price'],'add_time'=>time()];
        $res=DB::table('goods')->where($where)->update($obj);
        if($res){
            return redirect('admin/index');
        }else{
            echo "false";
        }
    }
}
