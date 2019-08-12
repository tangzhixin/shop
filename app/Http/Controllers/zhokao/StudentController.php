<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Shop_goods;
use DB;

class StudentController extends Controller
{
    // 登录
    public function login(){
        return view('login');
    }
    // 登录处理
    public function do_login(Request $request){
//        // echo 111;die;
//        $req=$request->all();
//    //   dd($req);
//        // 拿出来赋给一个变量
//        $name=$req['name'];
//        // 存入session
//        $request->session()->put('name',"$name");
//        // dd($request);
//        // 从session拿出来赋给一个变量
//        $obj=session('name');
//        // dd($obj);
//        // 查询表是否存在
//        $res=DB::table('register')->select('name')->get()->toArray();
//        // dd($res);
//        // 返回指定的一列
//        $data=array_column($res,'name');
//        // dd($data);
//        // 判断
//        if($obj==$data[0])
//        {
//            return redirect('/student/index');
//        }else{
//            return redirect('/student/login');
//        }

        $req=$request->all();
        $name=DB::table('register')->where(['name'=>$req['name'],'pwd'=>$req['pwd']])->first();
//        dd($name);
        if(empty($name)){
            echo "<script>alert('账号或密码错误'),location.href='/student/login'</script>";
        }else{
            $request->session()->put('name',$name);
            return redirect('/home/index');
        }
        
    }
    // 注册
    public function register(){
        return view('register');
    }
    // 注册处理
    public function do_register(Request $request){
        // echo 111;die;
        $req=$request->all();
        // dd($req);
        $data=(
            ['name'=>$req['name'],'pwd'=>$req['pwd'],'email'=>$req['email']]
        );
        // dd($data);
        $where=[
            ['name','=',$data['name']],
        ];
        // dd($where);
        $obj=DB::table('register')->where($where)->count();
        // dd($obj);
        if($obj>0)
        {
            echo "字段已经存在";die;
        }
        $res=DB::table('register')->insert(
            ['name'=>$req['name'],'pwd'=>$req['pwd'],'email'=>$req['email']]
        );
        if($res){
            return redirect('student/login');
        }
    }

    public function index(Request $request){
        // DB::connection('shop')->enableQueryLog();
        // $info=Shop_goods::where('goods_name','like','%22%')->get()->toArray();
        // dd($info);
        // $sql=DB::connection('shop')->getQueryLog();
        // var_dump($sql);
        // dd($sql);
            //sql语句
        // $info=DB::table('student')->select(DB::raw('count(*) as num,ext'))->groupBy('ext')->get();
        // $info=DB::table('student')->orderBy('id','desc')->whereIn('id',[14,15])->orwhere(['ext'=>1])->get()->toArray();
        // $info=DB::table('student')
        // ->leftJoin('')
        // dd($info);



        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num=$redis->get('num');
        echo "访问的次数:".$num;
//        echo 111;
        // 接收所有值
        $req=$request->all();
        // var_dump($req);
        $search="";
        if(!empty($req['search'])){
            $search=$req['search'];
            $info=DB::table('student')->where('name','like','%'.$req['search'].'%')->paginate(2);
        }else{
            $info=DB::table('student')->paginate(2);
        }
        
        return view('studentList',['student'=>$info,'search'=>$search]);
    }
    public function delete(Request $request){
        // 接收所有值
        $data=$request->all();
        // dd($data);
        $res=DB::table('Student')->delete($data);
        if($res){
            return redirect('/student/index');
        }
    }
    // 添加学生信息,进入页面
    public function add(){
        return view('add');
    }
    // 添加学生信息,处理数据
    public function save(Request $add){
        $validateDate=$add->validate([
            'name'=>'required',
            'age'=>'required',
        ],[
            'name.required'=>'字段必填',
            'age.required'=>'年龄必填',
        ]);
        // 接收所有值
        $data=$add->all();
        
        // dd($data);
        $res=DB::table('Student')->insert(
            ['name'=>$data['name'],'age'=>$data['age'],'ext'=>$data['ext'],'add_time'=>time()]
        );
        // dd($res);
        if($res){
            return redirect('/student/index');
        }
    }
    public function update(Request $update){
        // 接收所有值
        $data=$update->all();
        // dd($data);
        $res=DB::table('Student')->where(['id'=>$data['id']])->first();
        // dd($res);   
        return view('update',['res'=>$res]);
    }

    public function updateadd(Request $updateadd){
        // 接收所有值
        $data=$updateadd->all();
        $res=DB::table('Student')->where(['id'=>$data['id']])->update(
            ['name'=>$data['name'],'age'=>$data['age'],'ext'=>$data['ext']]
        );
        // dd($res);
        if($res){
            return redirect('/student/index');
        }
    }

}
