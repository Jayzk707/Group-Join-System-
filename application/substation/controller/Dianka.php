<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;

class Dianka extends Base{
	
	public function Index(){
	    //查出自已信息
	    $info = Db("substation")->where("su_id = ".__SUID__)->find();
	    $this->assign("info",$info);
	    
		$res = model("Dianka")->GetFzAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Add(){
	    $res = model("Setup")->GetAll();
	    $this->assign("info",$res);
	    return view();
	}
	
	public function qrcode($text){
	    header("Content-type:image/png"); 
        require_once _PATH_.'/extend/phpqrcode/phpqrcode.php';
		$Level    = 'L';  //容错级别 
		$Size     = 10;    //生成图片大小  
		$timsss   = microtime();
		$filename = _PATH_.'/upload/qrcode/'.$timsss.'.png';  //二维码信息地址
		\QRcode::png($text,$filename , $Level, $Size, 2);   //生成二维码
		return '/upload/qrcode/'.$timsss.'.png';
	}
	

	
	public function pay(){
	    if(Request::instance()->isAjax()){
	        header("Content-type:text/html;charset=utf-8");
	        /*
	        1.先生成订单
	        2.生成二维码支付
	        */
	        $type = trim(input("types"));
	        $money = trim(input("money"));
			$DATA = [
				'su_id'      => __SUID__,
				'dk_addtime' => date("Y-m-d H:i:s"),
				'dk_status'  => 1,
				'dk_money'   => $money,
				'dk_type'    => $type,
			];
			$res = model("Dianka")->AddS($DATA);
			if($res['status'] == 1){
			    $setupinfo = model("Setup")->GetAll();
			    $orderid = $res['id'];
			    if($type==1){
        		    /*微信支付*/
            		import('paylist.payweixin.pay');
                    $classname = "Pay_payweixin";
                    $PayModel  = new $classname;
            		$PayModel->config = array(
                        'appid'      => $setupinfo['appid'],
                        'appsecret'  => $setupinfo['appsecret'],
                        'mch_id'     => $setupinfo['mchid'],
                        'pay_apikey' => $setupinfo['apikey'],
                    );
                   
                    $result = $PayModel->wxpayNATIVE($money,"积分充值",$orderid);
                    
                    if(@$result['status'] == 0 and !empty($result['status'])){
                        $res['status'] = 0;
                        $res['msg'] = @$result['msg'];
                    }else{
                        if(@$result['return_code']=="SUCCESS"){
                            $res['status'] = 1;
                            $res['msg'] = $this->qrcode($result['code_url']);
                        }else{
                            $res['status'] = 0;
                            $res['msg'] = "未知返回错误";
                        }
                    }
			    }else{
                    $config = array (
                        'app_id' => $setupinfo['zfbappid'],//应用ID,您的APPID。
                        'merchant_private_key' => $setupinfo['zfbskey'],//商户私钥 
                        'notify_url' => "http://".$_SERVER['HTTP_HOST']."/notifyzfb.php",//异步通知地址 
                        'return_url' => "http://".$_SERVER['HTTP_HOST']."/notifyzfb.php",//同步跳转 
                        'charset' => "UTF-8",//编码格式 
                        'sign_type'=>"RSA2", //签名方式
                        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",//支付宝网关
                        'alipay_public_key' => $setupinfo['zfbgkey'], //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
                    );
                    
                    $out_trade_no = $orderid;
                    $total_amount = $money;
                    
                    /*** 请填写以下配置信息 ***/
                    $appid        = $config["app_id"];  //https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
                    $notifyUrl    = $config["notify_url"];     //付款成功后的异步回调地址
                    $outTradeNo   = $out_trade_no;     //你自己的商品订单号，不能重复
                    $payAmount    = $total_amount;          //付款金额，单位:元
                    $orderName    = '积分充值';    //订单标题
                    $signType     = 'RSA2';			//签名算法类型，支持RSA2和RSA，推荐使用RSA2
                    $rsaPrivateKey=$config["merchant_private_key"];		//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
                    /*** 配置结束 ***/
                    import('paylist.payzfb.pay');
                    $classname = "Pay_payzfb";
                    $aliPay  = new $classname;
                    //$aliPay = new AlipayService();
                    $aliPay->setAppid($appid);
                    $aliPay->setNotifyUrl($notifyUrl);
                    $aliPay->setRsaPrivateKey($rsaPrivateKey);
                    $aliPay->setTotalFee($payAmount);
                    $aliPay->setOutTradeNo($outTradeNo);
                    $aliPay->setOrderName($orderName);
                    $result = $aliPay->doPay();
                    $result = $result['alipay_trade_precreate_response'];
                    if($result['code'] && $result['code']=='10000'){
                        //这里处理你的业务逻辑，如生成订单
                        $res['status'] = 1;
                        $res['msg'] = $this->qrcode($result['qr_code']);
                    }else{
                        $res['status'] = 0;
                        $res['msg'] = $result['msg'].' : '.$result['sub_msg'];
                    }
			    }
                return _Json($res);
			}else{
			    return _Json($res);
			}
	    }
	}
	
}