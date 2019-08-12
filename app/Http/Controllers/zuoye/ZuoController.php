<?php

namespace App\Http\Controllers\zuoye;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ZuoController extends Controller
{
    public function register(){
        return view('zuo/register');
    }
    public function do_register(){

    }
}