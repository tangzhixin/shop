<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pay;
class PayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEpAIBAAKCAQEA3YPcYVjEd7LI7I/abOGv+BQ7m5dBbZjFlBtQ5dOcbPJsSmT9hMyUdDsJURnT6cpub1cEOnBBxZljchsalYs931RVLT2tcI5UjUujUwTPmAg9Dn4IOywth/cvSl7JNwzGZruMZu69CACbtdH1TmQUEBpqRop8pubCIlPsq8F6FwdZZ/g2kIDj1NNK9Jb0a0/l0j5crafWWeLMx3mnkCrzCWdMesaDORG2eDFVqUPxxBT0q/fRAkn7b7GBLmfPOVQZ3oEIk6xhpSeUrup+ETF0Nyc3Jr/BpSs8JU27xzRIAdUgHpTHjQ1ambUMYTqnD6HY3xORf/sDSC4DkWkhwO4urQIDAQABAoIBABe83K315D/rgcqP89k9Ki1MhcK7p8BF4c5oSvgGADpQlDg4sE492h7GgM4XFXV1QvZdfc+BXhr9wAFnVCb4X+4BzIrnlCF+ryLhGyR3XIOvRlO6P8mPh2WNoJy4oZlrngs+R+Jz7P/hiM4oLMB0yw2atw7OImOEUQN6uN8DAcFbzh++IGSrCYuCQ5WFUhNAiVPevSUXh108w8MeNuBkE7IUEKSYkgDzZP49kPYSqCtDS7AH7kHeKaxJ2kw7sMX/3g8WoFF9FRktQtGMmBdo2AYUHJ4n656UvCzgHKo0SXOdci9oFy3Co5lJEgnsG5fhMWuDHl/AwtbunGEsJq/CVuECgYEA/SZZLv4oM/b3hkDCVcNavGl9/we7bEV32+PZAYTjz71hPtpURYfd9rEp8nul4Q3JjKjIwTVHD9+bCCQlpcc30+Gzq3BAvkiA/4c9D+r1XhNE6OJ2/zO764sbslgv4nvAzomR7hLayWUcDBZGBdDg5dhv/0xRcRQvl1cEWIYjjkUCgYEA4AJU/cYOPrNmNViPHwSYca2R2lr9o66RLcSI/d7YUlmzpWx+r4MA3Vph7Q0we5dd2kbHdKIqV1V9pWYLTUn9gY0W3zrqy+xUfmEu4hoZQmUzT/hfS3uqMXNKgz5bIKuOLxFWcsMSL184wcdJbx/jDqFt9HGWvY4oqKw/1EcceUkCgYEAjDZQUUnuZJHWmWKHAM+aEx9u7PGQarCzaXRyvnenYmmnUhPFd1mApGGONUMtJlDnoGPgBbuHp5AXI1Q6Ee8cyduKE1uyUHKCGIYEWSuvSbLsiPzeIg26eQTsi0RzCUO4D+18iVuiGMhK15sCn7gIyOWvar0Pos0mavGEc6+gQ+0CgYEAi0Pn4v3GzWRrHq84C2in/cSS8NWw6poU2Adfw7VPd6Mc9LNG74baesM+LkoM4klwp8tpJTHMcQ9NVg7i5+IgIPK+TXorjywWO5vfseHX4ldYV1dqp1ryrFuo739M2DrP4qM8w4xTOfBRMOfc16FTYD0sRtR3itFepb6w0CCFq0ECgYByV9ZxEVXesy0pwXlQt09CcnMEOQrILIUdjnV02Pj+tN5yty28ZooePqRGrT12g3KUi52aJBLJC4tt/7WUbdOijQb4gucy1O8kdfdprQjhVwj1m3oHRTsW1VVjctHBSuR0vsZ2cu9Y350WEObHI74vtitSe1Q6OMhhGtW0V9Qw+g==';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAiePUdKUqE+ij3/V6XwXvljxwcuGHKhrujKv5DNLN6DnHlXatkbmfkht5hD5QRMxrY+43YXHSpBfiZG6HafMEleDBK8FMDkKsRrcVkHI/wh+9mb0pARIGkosHZ36/eNMPKurUZyLrp5nm4+2H+FGyk6pf+vQ/Lscy9HVDvyJq27UrStN03/YkLDvPyUNGe05Y52NzIO0jkP5/V10kN1zXn+5hk2nc0NIwTwhpAZoDYvQTYETofTR1TXx8HrbGcTjP55x0Gn/V1VRxG1CLN3pRmwLf83u0RQ7Xorq5TeZF2RTFnxXoNEqUXgpS7TwbU+Y8ztdFtJPuPEFpAW/AklLQrwIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016092800618146';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/return_url';
    }

    public function do_pay(){
        $oid = time().mt_rand(1000,1111);  //订单编号
        //$this->ali_pay($oid);
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];
        return Pay::alipay()->web($order);
    }

    public function notify_url(){
        $post_json=file_get_contents("php://input");
        \Log::Info($post_json);
        $post=json_decode($post_json,1);
        // 业务处理
    }
    
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }

    

    /**
     * 根据订单号支付
     * [ali_pay description]
     * @param  [type] $oid [description]
     * @return [type]      [description]
     */
    public function ali_pay($oid){
        $order = [];
        $order_info = $order;
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => 10,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        dd($url);
        header("Location:".$url);
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        header('Refresh:2;url=/order_list');
        echo "<h2>订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转</h2>';
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
            //验证订单交易状态
            if($_POST['trade_status']=='TRADE_SUCCESS'){
                
            }
        }
        
        echo 'success';
    }
    //验签
    function verify($params) {
        $sign = $params['sign'];
        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
        
        
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        
        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
}
