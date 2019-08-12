<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommController extends Controller
{
    public function index(Request $request){
//        echo 123;
        $req=$request->all();
        // var_dump($req);
        $search="";
        if(!empty($req['search'])){
            $search=$req['search'];
            $info=DB::table('commodity')->where('b_name','like','%'.$req['search'].'%')->paginate(2);
        }else{
            $info=DB::table('commodity')->paginate(2);
        }

        return view('/comm/index',['info'=>$info,'search'=>$search]);
    }
    public function insert(){
        return view('/comm/insert');
    }
    public function do_insert(Request $request){
        $data=$request->all();
        $path=$request->file('b_pic');
//        dd($path);
        if(empty($path)){
            echo "file";die;
        }else{
            $path=$request->file('b_pic')->store('monthly');
        }
        $path=('/storage/'.$path);
//        dd($obj);
        $res=DB::table('commodity')->insert(
            ['b_name'=>$data['b_name'],'b_pic'=>$path,'b_repertory'=>$data['b_repertory'],'add_time'=>time()]
        );
        if($res){
            return redirect('comm/index');
        }
    }
    public function del(Request $request){
        $data=$request->all();
//        dd($data['b_id']);
        $where=[
            ['b_id','=',$data['b_id']],
            ];
        $res=DB::table('commodity')->where($where)->delete();
        if($res){
            return redirect('comm/index');
        }
    }

    public function update(Request $request){
        $data=$request->all();
        $obj=DB::table('commodity')->where(['b_id'=>$data['b_id']])->first();
        return view('comm/update',['obj'=>$obj]);
    }

    public function do_update(Request $request){
        $files=$request->file('b_pic');
        $id=$request->all()['b_id'];
        $where=[
            ['b_id','=',$id]
        ];
        if(empty($files)){
            echo "false";
        }else{
            $path=$request->file('b_pic')->store('monthly');
            $b_pic=('/storage/'.$path);
            $arr=['b_pic'=>$b_pic];
            $res=DB::table('commodity')->where($where)->update($arr);
        }
        $data=$request->all();
        $obj=['b_name'=>$data['b_name'],'b_repertory'=>$data['b_repertory'],'add_time'=>time()];
        $res=DB::table('commodity')->where($where)->update($obj);
        if($res){
            return redirect('comm/index');
        }else{
            echo "false";
        }
    }
}
