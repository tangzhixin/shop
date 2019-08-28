<?php

namespace App\Http\Controllers\yuekao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use phpDocumentor\Reflection\Location;

class YuekaoController extends Controller
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
        echo 111;
    }
}