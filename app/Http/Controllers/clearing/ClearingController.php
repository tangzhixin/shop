<?php

namespace App\Http\Controllers\clearing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use DB;
use Illuminate\Support\Facades\Storage;

class ClearingController extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

    public function index()
    {
        return view('clearing/index');
    }
    public function list()
    {
        $data=DB::connection('access')->table('clearing')->groupBy('mingcheng')->select(['mingcheng'])->orderBy('mingcheng')->get()->toArray();
        dd($data);
        return view('clearing/list',['obj'=>$data]);
    }
    public function add()
    {
        return view('clearing/add');
    }
    public function do_add(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $obj=DB::connection('access')->table('clearing')->insert([
            'jibie'=>$data['jibie'],
            'mingcheng'=>$data['mingcheng'],
            'erming'=>$data['erming'],
            'url'=>$data['url'],
            'leixing'=>$data['leixing']
        ]);
        if($obj){
            return redirect('clearing/list');
        }
    }
    // 推送
    public function tang()
    {

    }

}