<?php

namespace App\Http\Controllers\zuoye;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GuessController extends Controller
{
    public function index(Request $request){
        $data=$request->all('end_time');
//        dd($data);
        $obj=DB::table('guess')->get();
//        dd($obj);
        return view('guess/index',['obj'=>$obj]);
    }
    public function add(){
        return view('guess/add');
    }
    public function do_add(Request $request){
        $data=$request->all();
//        dd($data);
        $times=time()+7200;
        $obj=DB::table('guess')->insert(
            ['name'=>$data['name'],'cname'=>$data['cname'],'end_time'=>$times]
        );
        if($obj){
            return redirect('guess/index');
        }

    }
    // 前台竞猜列表
    public function gue_index(Request $request){
        $data=$request->all('end_time');
//        dd($data);
        $obj=DB::table('guess')->get();
//        dd($obj);
        return view('guess/gue_index',['obj'=>$obj]);
    }
    // 添加竞猜
    public function gues($id){
//        dd($id);
        $obj=DB::table('guess')->where('id','=',$id)->first();
//        dd($obj);
        return view('guess/gues',['obj'=>$obj]);
    }
    public function result($id){
        $obj=DB::table('guess')->where('id','=',$id)->first();
//        dd($obj);
        return view('guess/result',['obj'=>$obj]);
    }
    public function update(Request $request){
        $data=$request->all();
//        dd($data);
        $obj=DB::table('guess')->where('id','=',$data['id'])->update(
            ['qsfp'=>$data['qsfp']]
        );
        return redirect('guess/gue_index');
    }

}