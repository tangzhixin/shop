<?php

namespace App\Http\Controllers\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use DB;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

    public function user_list()
    {
        $user_info=DB::connection('access')->table('user')->get();
        return view('agent/user_list',['tang'=>$user_info]);
    }
    // 生成用户二维码
    public function creat_qrcode(Request $request)
    {
        $uid=$request->all('id')['id'];
//        dd($uid);
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=[
            "action_name"=>"QR_LIMIT_SCENE",
            "action_info"=>[
                "scene"=>[
                    "scene_id"=>$uid
                ]
            ]
        ];
//        dd($data);
        $re=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($re,1);
//        dd($obj);
//        dd($uid);
        $tang=$obj['ticket'];
//        dd($tang);
        $url_tang='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tang;
//        dd($url_tang);
        $client=new Client();
        $response=$client->get($url_tang);
//        dd($response);
        $h=$response->getHeaders();
//        dd($h);
        $ext=explode('/',$h['Content-Type'][0])[1];
//        dd($ext);
        $file_name=time().rand(1000,9999).'.'.$ext;
        $path='qrcode/'.$file_name;
        $ree=Storage::disk('local')->put($path,$response->getBody());
//        dd($ree);
        $qrcode_url=env('APP_URL').'/storage/'.$path;
//        dd($qrcode_url);
        $res=DB::connection('access')->table('user')->where('id','=',$uid)->update(
            [
                'agent_code'=>$obj['ticket'],
                'qrcode_url'=>$qrcode_url
            ]);
        return redirect('agent/user_list');

    }
    // 用户推广用户列表
    public function agent_list(Request $request)
    {
        $data=$request->all()['id'];
//        dd($data);
        $obj=DB::connection('access')->table('user_agent')->where('uid','=',$data)->get();
//        dd($obj);

        return view('agent/agent_list',['obj'=>$obj]);
    }

    // 用户添加
    public function add()
    {
        return view('agent/add');
    }
    public function do_add(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $obj=DB::connection('access')->table('user')->insert(['name'=>$data['name']]);
//        dd($obj);
        if($obj){
            return redirect('agent/user_list');
        }
    }

    // 自定义菜单
    public function  profile()
    {
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=[
            "button"=>[
                [
                 "type"=>"click",
                  "name"=>"今日歌曲",
                  "key"=>"V1001_TODAY_MUSIC"
                ],
        [
          "name"=>"菜单",
           "sub_button"=>[
                [
                   "type"=>"view",
                   "name"=>"搜索",
                   "url"=>"http://www.soso.com/"
                ],
            [
                "type"=>"miniprogram",
                 "name"=>"wxa",
                 "url"=>"http://mp.weixin.qq.com",
                 "appid"=>"wx286b93c14bbf93aa",
                 "pagepath"=>"pages/lunar/index"
             ],
            [
                "type"=>"click",
               "name"=>"赞一下我们",
               "key"=>"V1001_GOOD"
            ]
           ]
        ]
            ]
        ];
//        $data=[
//            "button"=> [
//        [
//            "name"=> "扫码",
//            "sub_button"=>[
//                [
//                    "type"=> "scancode_waitmsg",
//                    "name"=> "扫码带提示",
//                    "key"=> "rselfmenu_0_0",
//                    "sub_button"=> [ ]
//                ],
//                [
//                    "type"=> "scancode_push",
//                    "name"=> "扫码推事件",
//                    "key"=> "rselfmenu_0_1",
//                    "sub_button"=> [ ]
//                ]
//            ]
//        ],
//        [
//            "name"=> "发图",
//            "sub_button"=> [
//                [
//                    "type"=> "pic_sysphoto",
//                    "name"=> "系统拍照发图",
//                    "key"=> "rselfmenu_1_0",
//                   "sub_button"=> [ ]
//                 ],
//                [
//                    "type"=> "pic_photo_or_album",
//                    "name"=> "拍照或者相册发图",
//                    "key"=> "rselfmenu_1_1",
//                    "sub_button"=> [ ]
//                ],
//                [
//                    "type"=> "pic_weixin",
//                    "name"=> "微信相册发图",
//                    "key"=> "rselfmenu_1_2",
//                    "sub_button"=> [ ]
//                ]
//            ]
//        ],
//        [
//            "name"=> "发送位置",
//            "type"=> "location_select",
//            "key"=> "rselfmenu_2_0"
//        ],
//        [
//            "type"=> "media_id",
//           "name"=> "图片",
//           "media_id"=> "MEDIA_ID1"
//        ],
//        [
//            "type"=>"view_limited",
//           "name"=>"图文消息",
//           "media_id"=>"MEDIA_ID2"
//        ]
//    ]
//        ];
//        dd($data);
        $obj=$this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
//        dd($obj);
        $aa=json_decode($obj,1);
        dd($aa);
    }

    public function input()
    {
        return view('agent/input');
    }

    public function do_input(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $obj=DB::connection('access')->table('menu')->insert(
            [
                'menu_type'=>$data['menu_type'],
                'menu_name'=>$data['menu_name'],
                'second_menu_name'=>$data['second_menu_name'],
                'menu_tag'=>$data['menu_tag'],
                'event_type'=>$data['event_type']
            ]
        );
        if($obj){
            return redirect('agent/index');
        }else{
            echo "失败";
        }
    }
    // 菜单列表
    public function index(Request $request)
    {
        $data1=DB::connection('access')->table('menu')->groupBy('menu_name')->select(['menu_name'])->orderBy('menu_name')->get()->toArray();
        foreach($data1 as $k=>$v){
//            dd($v);
            $data_info=DB::connection('access')->table('menu')->where(['menu_name'=>$v->menu_name])->orderBy('menu_name')->get()->toArray();
            $sub_button=[];
            foreach($data_info as $vv){
//                dump($vv);
                if($vv->menu_type==1){
                    if($vv->event_type=='click')
                    {
                        $data['button'][]=[
                            'type'=>$vv->event_type,
                            'name'=>$vv->menu_name,
                            'key'=>$vv->menu_tag,
                        ];
                    }else {
                        $data['button'][]=[
                            'type'=>$vv->event_type,
                            'name'=>$vv->menu_name,
                            'url'=>$vv->menu_tag,
                        ];
                    }
                }elseif($vv->menu_type==2){
                        if($vv->event_type=='click')
                        {
                            $sub_button[]=[
                              'type'=>$vv->event_type,
                              'name'=>$vv->menu_name,
                              'key'=>$vv->menu_tag,
                            ];
                        }else{
                            $sub_button[]=[
                              'type'=>$vv->event_type,
                              'name'=>$vv->menu_name,
                              'url'=>$vv->menu_tag,
                            ];
                        }
                }
            }

            if(!empty($sub_button)){
                $data['button'][]=['name'=>$vv->menu_name,'sub_button'=>$sub_button];
            }
        }
//        dd($sub_button);
//        dd($data);
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $re=$this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
//        dd($re);
        $obj=json_decode($re,1);
//        dd($obj);
//        dd($sub_button);
        $aa=DB::connection('access')->table('menu')->get();
        return view('agent/index',['data'=>$aa]);
    }
    // 菜单删除
    public function delete(Request $request)
    {
        $url='https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$this->wechat->get_access_token();
        dd($url);
    }

    // 获取线上的接口
    public function index_1()
    {
        $url='https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=[
            "menu"=> [
        "button"=>[
            [
                "type"=>"click",
                "name"=> "今日歌曲",
                "key"=> "V1001_TODAY_MUSIC",
                "sub_button"=> [ ]
            ],
            [
                "type"=> "click",
                "name"=>"歌手简介",
                "key"=>"V1001_TODAY_SINGER",
                "sub_button"=> [ ]
            ],
            [
                "name"=>"菜单",
                "sub_button"=>[
                    [
                        "type"=>"view",
                        "name"=>"搜索",
                        "url"=>"http://www.soso.com/",
                        "sub_button"=>[ ]
                    ],
                    [
                        "type"=>"view",
                        "name"=>"视频",
                        "url"=>"http://v.qq.com/",
                        "sub_button"=>[ ]
                    ],
                    [
                        "type"=>"click",
                        "name"=>"赞一下我们",
                        "key"=>"V1001_GOOD",
                        "sub_button"=>[ ]
                    ]
                ]
            ]
        ]
    ]
        ];
        $re=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($re,1);
//        dd($obj);
        $tang=$obj['menu']['button'];
//        dd($tang);
        $tangtang=[];
        foreach($tang as $v){
//            dump($v);
            if(empty($v['sub_button'])){
                // 一级菜单
//                dump($v);
                if($v['type']=='view'){
                    $tangtang[]=[
                        'menu_name'=>$v['name'],
                        'second_menu_name'=>'',
                        'menu_type'=>'1',
                        'event_type'=>$v['type'],
                        'menu_tag'=>$v['url']
                    ];

                }else{
                    $tangtang[]=[
                        'menu_name'=>$v['name'],
                        'second_menu_name'=>'',
                        'menu_type'=>'1',
                        'event_type'=>$v['type'],
                        'menu_tag'=>$v['key']
                    ];
                }

//                dump($tangtang);
            }

                if(!empty($v['sub_button'])){
                    // 二级菜单
//                    dd();
                    foreach($v['sub_button'] as $vv){
//                    dd();
                    if($vv['type']=='click'){
                        $tangtang[]=[
                            'menu_name'=>'',
                            'second_menu_name'=>$vv['name'],
                            'menu_type'=>'2',
                            'event_type'=>$vv['type'],
                            'menu_tag'=>$vv['key']
                        ];
                    }else{
                        $tangtang[]=[
                            'menu_name'=>'',
                            'second_menu_name'=>$vv['name'],
                            'menu_type'=>'2',
                            'event_type'=>$vv['type'],
                            'menu_tag'=>$vv['url']
                        ];
                    }
                }
            }

        }
//        dd($tangtang);
        return view('agent/index_1',['tangtang'=>$tangtang]);
    }


















    // 查看二维码
//    public function tanghu(Request $request)
//    {
//        $data=$request->all()['id'];
////        dd($data);
//        $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$data;
////        dd($url);
//        header("location:$url");
//    }
}