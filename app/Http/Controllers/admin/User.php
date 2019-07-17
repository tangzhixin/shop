<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class User extends Controller
{
    public function index(Request $request){
        $where=[
          ['state','!=',1],
        ];
        $data=DB::table('user')->where($where)->paginate(3);
        $a=session('state');
        return view('User/index',['data'=>$data]);
    }
}
