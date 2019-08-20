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

    }
    public function add()
    {
        return view('clearing/add');
    }
    public function do_add(Request $request)
    {
        $data=$request->all();
        dd($data);
    }

}