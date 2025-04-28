<?php
class Pay_weixin{
	
	public $dates = array(); //用于保存外部传进去的参数
	public $orderid = ""; //订单号
	public $money   = "";//订单价格
	public $title   = "";
	public $wxgid   = "";
	public $domain  = "";
	public $config = array(
        'appid'		=> '',
        'appsecret' => '',
        'mch_id'	 	=> '',
        'pay_apikey' 	=> ''
    );
	
	public function index()
	{
	    
	    
		$appid_array     = explode("-",$this->dates['su_pl_content_1']);
		$appsecret_array = explode("-",$this->dates['su_pl_content_2']);
		$mch_id_array    = explode("-",$this->dates['su_pl_content_3']);
		$pay_apikey      = explode("-",$this->dates['su_pl_content_4']);
		
		
		$rand_count   = array_rand($mch_id_array,1);
		
		$appsecret    = $appsecret_array[$rand_count];
		$appid        = $appid_array[$rand_count];
		$pay_apikey   = $pay_apikey[$rand_count];
	    $mch_id_array = $mch_id_array[$rand_count];
	    
        $this->config = array(
            'appid'      => $appid,
            'appsecret'  => $appsecret,
            'mch_id'     => $mch_id_array,
            'pay_apikey' => $pay_apikey
        );
		$pay_url   = "http://".$this->domain."/group.php/index/wxpay/orderid/".$this->orderid."/appid/".$this->config['appid']."/mchid/".$this->config['mch_id']."/apikey/".$this->config['pay_apikey']."/appsecret/".$this->config['appsecret']."/id/".$this->wxgid.".html";
		return ['status'=>1,'msg'=>$pay_url];
	
	}
	

	/**
	 * 
	 * 构造获取code的url连接
	 * @param string $redirectUrl 微信服务器回跳的url，需要url编码
	 * 
	 * @return 返回构造好的url
	 */
	public function _CreateOauthUrlForCode($redirectUrl){
		//$config = new WxPayConfig();
		$urlObj["appid"] = $this->config['appid'];
		$urlObj["redirect_uri"] = "$redirectUrl";
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = $this->ToUrlParams($urlObj);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	
	
	/**
	 * 
	 * 通过code从工作平台获取openid机器access_token
	 * @param string $code 微信跳转回来带上的code
	 * 
	 * @return openid
	 */
	public function GetOpenidFromMp($code)
	{
		$url = $this->__CreateOauthUrlForOpenid($code);
		//初始化curl
		$MerchantId = $this->config['mch_id'];
		$ch = curl_init();
		$curlVersion = curl_version();
		//$config = new WxPayConfig();
		$ua = "WXPaySDK/3.0.9 (".PHP_OS.") PHP/".PHP_VERSION." CURL/".$curlVersion['version']." ".$MerchantId;

		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//运行curl，结果以jason形式返回
		$res = curl_exec($ch);
		curl_close($ch);
		
		//取出openid
		$data = json_decode($res,true);
		//$this->data = $data;
		if(empty($data['openid'])){
		    //print_r($this->config);
		    print_r($data);
		    exit;
		}
		return @$data['openid'];

	}
	
	
	/**
	 * 
	 * 构造获取open和access_toke的url地址
	 * @param string $code，微信跳转带回的code
	 * 
	 * @return 请求的url
	 */
	public function __CreateOauthUrlForOpenid($code)
	{
		//$config = new WxPayConfig();
		$urlObj["appid"] = $this->config['appid'];
		$urlObj["secret"] = $this->config['appsecret'];
		$urlObj["code"] = $code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = $this->ToUrlParams($urlObj);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	
	/**
	 * 格式化参数格式化成url参数
	 */
	public function ToUrlParams($data){
		$buff = "";
		foreach ($data as $k => $v)
		{
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		$buff = trim($buff, "&");
		return $buff;
	}
	
	
	/**
	 * 
	 * 产生随机字符串，不长于32位
	 * @param int $length
	 * @return 产生的随机字符串
	 */
	protected function getNonceStr($length = 32) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}
	
	
	
	/**
	 * 获取IP地址
	 * @return [String] [ip地址]
	 */
	protected function getip() {
        static $ip = '';
        $ip = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_CDN_SRC_IP'])) {
            $ip = $_SERVER['HTTP_CDN_SRC_IP'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        return $ip;
    }
    
    
    
	/**
	* 生成签名
	* @return 签名
	*/
	protected function makeSign($data){
	    //获取微信支付秘钥
		$key = $this->config['pay_apikey'];
		//签名步骤一：按字典序排序参数
		ksort($data);
		$string = $this->ToUrlParams($data);
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".$key;
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);
		return $result;
	}
	
	
	/**
     * 微信支付请求接口(POST)
     * @param string $openid 	openid
     * @param string $body 		商品简单描述
     * @param string $order_sn  订单编号
     * @param string $total_fee 金额
     * @return  json的数据
     */
	public function wxpayNATIVE($total_fee,$body,$order_sn){
		$config = $this->config;
		
		$notify_url   = "http://".$_SERVER['HTTP_HOST']."/notifysc.php";
		//统一下单参数构造
		$unifiedorder = array(
			'appid'			=> $config['appid'],
			'mch_id'		=> $config['mch_id'],
			'nonce_str'		=> self::getNonceStr(),
			'body'			=> $body,
			'out_trade_no'	=> $order_sn,
			'total_fee'		=> $total_fee * 100,
			'spbill_create_ip'=> self::getip(),
			'notify_url'=> $notify_url,
			'trade_type'=> 'NATIVE',
			'attach' =>'terst',
			'sign_type' => 'MD5'
		);

		$unifiedorder['sign'] = self::makeSign($unifiedorder);
		//请求数据,统一下单
		$xmldata = self::array2xml($unifiedorder);
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $res = self::curl_post_ssl($url, $xmldata);
        if(!$res){
			return array('status'=>0, 'msg'=>"Can't connect the server" );
        }
		$content = self::xml2array($res);
		if(strval($content['return_code']) == 'FAIL'){
			return array('status'=>0, 'msg'=>strval($content['return_msg']));
        }
        
	    return $content;
		//return json_encode($resdata);
	}
	
	/**
     * 微信支付请求接口(POST)
     * @param string $openid 	openid
     * @param string $body 		商品简单描述
     * @param string $order_sn  订单编号
     * @param string $total_fee 金额
     * @return  json的数据
     */
	public function wxpay($openid,$total_fee,$body,$order_sn){
		$config = $this->config;
		
		$notify_url   = "http://".$_SERVER['HTTP_HOST']."/notify.php";
		//统一下单参数构造
		$unifiedorder = array(
			'appid'			=> $config['appid'],
			'mch_id'		=> $config['mch_id'],
			'nonce_str'		=> self::getNonceStr(),
			'body'			=> $body,
			'out_trade_no'	=> $order_sn,
			'total_fee'		=> $total_fee * 100,
			'spbill_create_ip'=> self::getip(),
			'notify_url'=> $notify_url,
			'trade_type'=> 'JSAPI',
			'attach' =>'terst',
			'sign_type' => 'MD5',
			'openid'		=> $openid
		);

		$unifiedorder['sign'] = self::makeSign($unifiedorder);
		//请求数据,统一下单
		$xmldata = self::array2xml($unifiedorder);
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $res = self::curl_post_ssl($url, $xmldata);
        if(!$res){
			return array('status'=>0, 'msg'=>"Can't connect the server" );
        }
		$content = self::xml2array($res);
		if(strval($content['return_code']) == 'FAIL'){
			return array('status'=>0, 'msg'=>strval($content['return_msg']));
        }
        
		$time = time();
		settype($time, "string");  		//jsapi支付界面,时间戳必须为字符串格式
		$resdata = array(
            'appId'      	=> strval($content['appid']),
			'nonceStr'      => strval($content['nonce_str']),
            'package'       => 'prepay_id='.strval($content['prepay_id']),
            'signType'		=> 'MD5',
			'timeStamp'		=> $time
        );
		$resdata['paySign'] = self::makeSign($resdata);
		return json_encode($resdata);
	}
	/**
     * 将一个数组转换为 XML 结构的字符串
     * @param array $arr 要转换的数组
     * @param int $level 节点层级, 1 为 Root.
     * @return string XML 结构的字符串
     */
    protected function array2xml($arr) {
		if(!is_array($arr) || count($arr) <= 0)
		{
    		throw new WxPayException("数组数据异常！");
    	}
    	
    	$xml = "<xml>";
    	foreach ($arr as $key=>$val)
    	{
    		if (is_numeric($val)){
    			$xml.="<".$key.">".$val."</".$key.">";
    		}else{
    			$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
    		}
        }
        $xml.="</xml>";
        return $xml; 
    }
	
	/**
	 * 将xml转为array
	 * @param  string 	$xml xml字符串
	 * @return array    转换得到的数组
	 */
	protected function xml2array($xml){   
		//禁止引用外部xml实体
		if(!$xml){
			throw new WxPayException("xml数据异常！");
		}
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $res = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $res;
	}
	
	/**
	 * 微信支付发起请求
	 */
	protected function curl_post_ssl($url, $xmldata, $second=30,$aHeader=array()){
		$ch = curl_init();
		$curlVersion = curl_version();
		//$ua = "WXPaySDK/".self::$VERSION." (".PHP_OS.") PHP/".PHP_VERSION." CURL/".$curlVersion['version']." ".$config->GetMerchantId();

		//设置超时
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
		//curl_setopt($ch,CURLOPT_USERAGENT, $ua); 
		//设置header
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xmldata);
		//运行curl
		$data = curl_exec($ch);
		//返回结果
		if($data){
			curl_close($ch);
			return $data;
		} else { 
			$error = curl_errno($ch);
			curl_close($ch);
			throw new WxPayException("curl出错，错误码:$error");
		}
	}
}