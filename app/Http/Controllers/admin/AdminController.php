<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminController extends Controller
{
    // 登录
    public function login(){
//        echo 111;die;
        return view('admin/login');
    }
    // 执行登录
    public function do_login(Request $request){
        $data=$request->all();
        $password=md5($data['password']);
        $where=[
            ['name','=',$data['name']],
            ['password','=',$data['password']],
        ];
        $arr=DB::table('user')->where($where)->first();
        $arr=get_object_vars($arr);
//        dd($arr);
        $state=$arr['state'];
        $count=DB::table('user')->count();
//        dd($count);
        if($count<=0){
            echo "登录失败,账户或密码不对";die;
        }else{
            session(['name'=>$data['name'],'password'=>$password,'state'=>$state]);
            return redirect('User/index');
        }
    }
    public function state(Request $request){
        $data=$request->all();
//        dd($data);
        $arr=[$data['field']=>$data['value']];
        $where=[
            ['id','=',$data['id']],
        ];
        $res=DB::table('user')->where($where)->update($arr);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'失败']);die;
        }
    }

    // 注册
    public function register(){
        return view('admin/register');
    }
    // 执行注册
    public function do_register(Request $request){
        $req=$request->all();
        // dd($req);
        $data=(
        ['name'=>$req['name'],'password'=>$req['password'],'reg_time'=>time()]
        );
        // dd($data);
        $where=[
            ['name','=',$data['name']],
        ];
        // dd($where);
        $obj=DB::table('user')->where($where)->count();
        // dd($obj);
        if($obj>0)
        {
            echo "字段已经存在";die;
        }
        $res=DB::table('user')->insert(
            ['name'=>$req['name'],'password'=>$req['password'],'reg_time'=>time()]
        );
        if($res){
            return redirect('admin/login');
        }
    }

    public function index(Request $request){
//         echo 111;die;
        $req=$request->all();
//         var_dump($req);
        $search="";
        if(!empty($req['search'])){
            $search=$req['search'];
            $info=DB::table('goods')->where('goods_name','like','%'.$req['search'].'%')->paginate(2);
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
            $path=$request->file('goods_pic')->store('home');
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
            $path=$request->file('goods_pic')->store('home');
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
