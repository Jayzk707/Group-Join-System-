<?php
class Pay_xunhu{
	
	public $dates = array(); //用于保存外部传进去的参数
	public $orderid = ""; //订单号
	public $money   = "";//订单价格
	public $title   = "";
	public $wxgid   = "";
	public $domain  = "";
	
	public function index()
	{
		require_once 'api.php';
		$appid_array     = explode("-",$this->dates['su_pl_content_1']);
		$appsecret_array = explode("-",$this->dates['su_pl_content_2']);
		$rand_count = array_rand($appid_array,1);
		$appid      = $appid_array[$rand_count];
		$appsecret  = $appsecret_array[$rand_count];

		$my_plugin_id   ='my-plugins-id';
		
		$callback_url = "http://".$this->domain."/group.php/index/index/id/".$this->wxgid.".html";
		$return_url   = "http://".$this->domain."/group.php/index/successok/id/".$this->wxgid.".html";
		$notify_url   = "http://".$this->domain."/group.php/index/notify/orderid/".$this->orderid."/id/".$this->wxgid.".html";
		
		$data=array(
			'version'        => '1.1',//固定值，api 版本，目前暂时是1.1
			'lang'           => 'zh-cn', //必须的，zh-cn或en-us 或其他，根据语言显示页面
			'plugins'        => $my_plugin_id,//必须的，根据自己需要自定义插件ID，唯一的，匹配[a-zA-Z\d\-_]+
			'appid'          => $appid, //必须的，APPID
			'trade_order_id' => $this->orderid, //必须的，网站订单ID，唯一的，匹配[a-zA-Z\d\-_]+
			'payment'        => 'wechat',//必须的，支付接口标识：wechat(微信接口)|alipay(支付宝接口)
			'type'           => 'WAP',//固定值"WAP" H5支付必填
			//'wap_url'        => "http://127.0.0.1/",//网站域名，H5支付必填
			//'wap_name'       => "http://127.0.0.1/",//网站域名，或者名字，必填，长度32或以内 H5支付必填
			'total_fee'      => $this->money,//人民币，单位精确到分(测试账户只支持0.1元内付款)
			'title'          => $this->title, //必须的，订单标题，长度32或以内
			'time'           => time(),//必须的，当前时间戳，根据此字段判断订单请求是否已超时，防止第三方攻击服务器
			'notify_url'     => $notify_url, //必须的，支付成功异步回调接口
			'return_url'     => $return_url,//必须的，支付成功后的跳转地址
			'callback_url'   => $callback_url,//必须的，支付发起地址（未支付或支付失败，系统会会跳到这个地址让用户修改支付信息）
			//'modal'          => null, //可空，支付模式 ，可选值( full:返回完整的支付网页; qrcode:返回二维码; 空值:返回支付跳转链接)
			'nonce_str'      => str_shuffle(time())//必须的，随机字符串，作用：1.避免服务器缓存，2.防止安全密钥被猜测出来
		);
		$hashkey      = $appsecret;
		$data['hash'] = XH_Payment_Api::generate_xh_hash($data,$hashkey);
		$url          = 'https://api.xunhupay.com/payment/do.html';
		$response     = XH_Payment_Api::http_post($url, json_encode($data));
		$result       = $response?json_decode($response,true):null;
		if(!$result){
			return ['status'=>1000,'msg'=>'Internal server error!'];
		}
		$hash         = XH_Payment_Api::generate_xh_hash($result,$hashkey);
		if(!isset( $result['hash'])|| $hash!=$result['hash']){
			return ['status'=>1000,'msg'=>'Invalid sign!'];
		}

		if($result['errcode']!=0){
			return ['status'=>1000,'msg'=>$result['errmsg']];
		}

		$pay_url =$result['url'];
		return ['status'=>1,'msg'=>$pay_url];
	
	}
}