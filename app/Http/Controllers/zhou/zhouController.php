<?php

namespace App\Http\Controllers\zhou;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\wechat\WechatController;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use DB;
use Illuminate\Support\Facades\Storage;

class zhouController extends Controller
{
    public $request;
    public $wechat;

    public function __construct(Request $request, Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

    public function list()
    {
       $data=DB::connection('access')->table('token')->get();
//       dd($data);
        return view('zhou/list',['data'=>$data]);
    }
    public function add(Request $request)
    {
        $re=$request->all();
//        dd($re);
        return view('zhou/add',['uid'=>$re['uid']]);
    }
    public function do_add(Request $request)
    {
        $re=$request->all();
//        dd($re);
        $openid=DB::connection('access')->table('openid')->where(['uid'=>$re['uid']])->value('openid');
//        dd($openid);
        $tangtang=DB::connection('access')->table('token')->where(['openid'=>$openid])->first();
//        dd($tangtang);
        $tang=DB::connection('access')->table('liya')->insert([
            'liya'=>$re['liya'],
            'name'=>$tangtang->nickname,
            'uid'=>$re['uid']
        ]);
        $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
        $data=[
          'touser'=>$openid,
          'template_id'=>'TrrX2O_7JNW4eBj2lRagG95Lsp9vYSv_B_GKmJGqCgs',
          'url'=>env('APP_URL').'/zhou/list',
          'data'=>[
            'first'=>[
                'value'=>'留言消息',
                'color'=>''
            ],
            'keyword1'=>[
                'value'=>$this->wechat->get_info($openid)['nickname'],
                'color'=>''
            ],
            'keyword2'=>[
                'value'=>$re['liya'],
                'color'=>''
            ]
          ],
        ];
        $req=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($req,1);
        //我的留言

        return $obj;
//        $data=DB::connection('access')->table('liya')->insert(
//            [
//                'liya'=>$re['liya']
//            ]
//        );
//        if($data)
//        {
//            return redirect('zhou/list');
//        }
    }
    public function index(Request $request)
    {
        $data=DB::connection('access')->table('liya')->get();
//        dd($data);
        return view('zhou/index',['data'=>$data]);
    }

    public function login()
    {
        $request_uri=env('APP_URL').'/zhou/code';
//        dd($request_uri);
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($request_uri).'&response_type=code&scope=snsapi_base&state=state#wechat_redirect';
//        dd($url);
        header('Location:'.$url);
//        dd(file_get_contents($url));
    }
    public function code(Request $request)
    {
        $re=$request->all();
//        dd($re);
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$re['code'].'&grant_type=authorization_code';
//        dd($url);
        $data=file_get_contents($url);
//        dd($data);
        $req=json_decode($data,1);
//        dd($req);
        $user_wechat=DB::connection('access')->table('openid')->where(['openid'=>$req['openid']])->first();
//        dd($user_wechat);
        // 用户基本信息
        $wechat_info=$this->wechat->get_info($req['openid']);
//        dd($wechat_info);
        if(!empty($user_wechat)){
            //已注册
            $request->session()->put(['uid'=>$user_wechat->uid]);
            return redirect('zhou/list');
        }else{
            //未注册
            $uid=DB::connection('access')->table('user')->insertGetId([
                'name'=>$wechat_info['nickname'],
                'password'=>'',
                'req_time'=>time()
            ]);
            $wechat_tang=DB::connection('access')->table('openid')->insert([
                'uid'=>$uid,
                'option'=>$user_wechat['uid']
            ]);
            //登录
            $request->session()->put(['uid'=>$user_wechat['uid']]);
        }
    }



}