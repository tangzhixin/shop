<?php

namespace App\Http\Controllers\zuoye;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Diaoyan extends Controller
{
    // 登录
    public function login()
    {
        return view('zuoye/diaoyan/login');
    }
    // 登录执行
    public function login_do(Request $request)
    {
        $data = $request->post();
        $res = DB::table('users')->where('user','=',$data['user'])->where('pwd','=',$data['pwd'])->first();
//        dd($res);
        if(!empty($res)){
            return redirect('diaoyan/add_probject');
        }else{
            return redirect('diaoyan/login');
        }
    }
    //添加调研项目
    public function add_probject()
    {
        return view('zuoye/diaoyan/add_probject');
    }
    // 执行调研添加
    public function add_probject_do(Request $request)
    {
        $probject = $request->post();
        $pid = DB::table('probject')->insertGetId(['probject'=>$probject['probject']]);
        if(!empty($pid)){
            return redirect('diaoyan/add_question?id='.$pid);
        }

    }
    //添加调研问题
    public function add_question(Request $request)
    {
        $pid = $request->input('id');
        return view('zuoye/diaoyan/add_question',['pid'=>$pid]);
    }
    //执行问题添加
    public function add_question_do(Request $request)
    {
        $data = $request->post();
        $res = DB::table('question')->insert([
            'question'=>$data['question'],
            'type'=>$data['type'],
            'pid'=>$data['pid']
        ]);
        $qid = DB::getPdo()->LastInsertId();
        if($res){
            return redirect('diaoyan/add_option?qid='.$qid);
        }
    }
    //添加问题选项
    public function add_option(Request $request)
    {
        $qid = $request->input('qid');
        return view('zuoye/diaoyan/add_option',['qid'=>$qid]);
    }
    //执行选项添加
    public function add_option_do(Request $request)
    {
        $data = $request->post();
        $res = DB::table('option')->insert([
            "a"=>$data['a'],
            "b"=>$data['b'],
            "c"=>$data['c'],
            "d"=>$data['d'],
            'qid'=>$data['qid']
        ]);
        if($res){
            return redirect('diaoyan/list');
        }
    }
    // 调研列表
    public function list()
    {
        $data = DB::table('probject')->paginate(5);
        return view('zuoye/diaoyan/list',['data'=>$data]);
    }
    //启动调研
    public function start(Request $request)
    {
        $pid = $request->input('pid');
        $data = DB::table('question')->join('option','question.qid','=','option.oid')->where('pid','=',$pid)->get();
        return view('zuoye/diaoyan/start',['data'=>$data]);
    }
    // 调研删除
    public function del(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('probject')->where(['pid'=>$data['pid']])->delete();
//        dd($obj);
        if($obj){
            echo "删除成功";
        }
    }
    public function tang(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('probject')->where(['pid'=>$data['pid']])->first();
//        dd($obj);
        return view('zuoye/diaoyan/monthly',['data'=>$obj]);
    }
}
