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
//        $data=DB::connection('access')->table('clearing')->groupBy('mingcheng')->select(['mingcheng'])->orderBy('mingcheng')->get()->toArray();
////        dd($data);
//        foreach($data as $k=>$v){
////            dd($v);
////            dump($v);
////            dd();
//            $data_info=DB::connection('access')->table('clearing')->where(['mingcheng'=>$v->mingcheng])->orderBy('mingcheng')->get()->toArray();
////            dd($data_info);
//            $sub_button=[];
//            foreach($data_info as $vv){
////                dump($vv);
//                if($vv->jibie==1){
//                    if($vv->leixing=='click')
//                    {
//                        $data['button'][]=[
//                            'type'=>$vv->leixing,
//                            'name'=>$vv->mingcheng,
//                            'key'=>$vv->url,
//                        ];
//                    }else {
//                        $data['button'][]=[
//                            'type'=>$vv->leixing,
//                            'name'=>$vv->mingcheng,
//                            'url'=>$vv->url,
//                        ];
//                    }
//                }elseif($vv->jibie==2){
//                    if($vv->leixing=='click')
//                    {
//                        $sub_button[]=[
//                            'type'=>$vv->leixing,
//                            'name'=>$vv->mingcheng,
//                            'key'=>$vv->url,
//                        ];
//                    }else{
//                        $sub_button[]=[
//                            'type'=>$vv->leixing,
//                            'name'=>$vv->mingcheng,
//                            'url'=>$vv->url,
//                        ];
//                    }
//                }
//            }
////            dd($data);
////            dd($data_info);
////            dump($sub_button);
//
//            if(!empty($sub_button)){
//                $data['button'][]=['name'=>$vv->mingcheng,'sub_button'=>$sub_button];
//            }
//        }
////        dd($data);
//        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
////        dd($url);
//        $psuh_data['button']=$data['button'];
////        dd($psuh_data);
//        $req=$this->wechat->post($url,json_encode($psuh_data,JSON_UNESCAPED_UNICODE));
////        dd($req);
//        $aa=json_decode($req,1);
////        dd($aa);
////        dd($data);
//        $aa=DB::connection('access')->table('clearing')->get()
//;        return view('clearing/list',['obj'=>$aa]);

        $openid_info=DB::connection('access')->table('token')->get()->toArray();
//        $arr=array_column($openid_info,'nickname');
//        dd($openid_info);
//        dd($openid_tang);
        return view('clearing/list',['data'=>$openid_info]);
    }
    public function add(Request $request,$openid)
    {
//        dd($openid);
//        $aa=$request->session()->get('uid');
//        dd($aa);
        $data=$request->all()['nickname'];
//        dd($data);

//        dd($openid_tang);
        return view('clearing/add',['nickname'=>$data,'openid'=>$openid]);
    }
    public function do_add(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $openid='oUu1QwTNVoPux9LPWhUK_AGSbecQ';
        $user = $this->wechat->app->user->get($openid);
//        dd($user);
        // 模板消息
        $this->wechat->app->template_message->send([
            'touser'=>$data['openid'],
            'template_id'=>'Xgd1eEcHFDekVtkRCt4Q937LH2Moe_yeaSpfX34wX68',
            'url'=>env('APP_URL').'/clearing/list',
            'data'=>[
                'frist'=>$data['status'],
                'keyword1'=>$data['title'],
            ],
        ]);
//        dd(111);
        $tang=DB::connection('access')->table('clearing')->insert([
            'nickname'=>$data['nickname'],
            'title'=>$data['title'],
            'status'=>$data['status'],
            'from_user'=>$openid,
            'to_user'=>$data['openid'],
        ]);
        dd($tang);
//        if($obj){
//            return redirect('clearing/list');
//        }
    }

    public function login()
    {
        $request_uri=env('APP_URL').'/clearing/code';
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
            return redirect('clearing/list');
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


    // 推送
    public function tang(Request $request,$mingcheng)
    {
        $re=$request->all();
//        dd($re);
        $openid=DB::connection('access')->table('openid')->where(['uid'=>$re['id']])->value('openid');
//        dd($openid);
        $tangtang=DB::connection('access')->table('token')->where(['openid'=>$openid])->first();
        $tang=DB::connection('access')->table('clearing')->where($mingcheng)->first();
        $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=[
            "touser"=>$openid,
            "template_id"=>"VEvaoTx7SaNWeKL5IpHseLgJhQT0taHcLOpWYd6uAfc",
            "url"=>env('APP_URL').'/clearing/list',
            "data"=>[
                "first"=>[
                    "value"=>"表白消息",
                    "color"=>"#173177"
                ],
                "keyword1"=>[
                    "value"=>$this->wechat->get_info($openid)['nickname'],
                    "color"=>"#173177"
                ],
                "keyword2"=>[
                    "value"=>$tang['mingcheng'],
                    "color"=>"#173177"
                ],
                "remark"=>[
                    "value"=>"欢迎再次购买！",
                    "color"=>"#173177"
                ]
            ]
        ];
        dd($data);
    }

}