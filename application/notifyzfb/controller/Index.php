<?php
namespace app\notifyzfb\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
use think\Config;

class Index extends Controller{

	public function _initialize(){

	}
	
	
    //获取支付宝发送过来的数据
    public function getRequestData(){
        $response = file_get_contents("php://input");
        parse_str($response,$json_gbk); //$json_gbk
        if(empty($json_gbk)) return [null,null];
        //编码转utf-8
        $json_utf8 = $this->array_iconv($json_gbk);
        if(empty($json_utf8)){
            $this->_log('转换失败','notify');
        }
        return [$json_gbk,$json_utf8];
    }

	public function index(){
        $response = file_get_contents("php://input");
        //$response = 'gmt_create=2022-07-18+22%3A52%3A50&charset=GBK&seller_email=18763637327&subject=%BB%FD%B7%D6%B3%E4%D6%B5&sign=KTdk9SFk98%2FgIPGSWSbWNjVVoLb6x6GbdyJ86SdIJKpZLaokcEsN4LfMlKllX2hvzbubzDE6HF8%2BAq8TZGn8ryILXUHvjMZWK%2FauvG92x9LSkaPRk76RgNW8aHxDW8G24n8%2ByVc132H43IcZZqkNiVCnmS85XvxdYJAObAMjYaA2wJYUvRTu%2BWeocHq7YKX1T52WTajFwUPuw6ZvcaLBanUyeHEsgC38mKCNIGoNcflFVFaUEbLgHlkg6z%2Bk%2B8YZyS3r0suykBlGguRpQ5JSV2tHO3gzZzz3L892P1oD%2FAO3bFiXCmfiWXaO5smNT5gA9BdOJFy%2FDcdw0G9rIMMyeA%3D%3D&buyer_id=2088002450223299&invoice_amount=0.01&notify_id=2022071800222225259023291441168163&fund_bill_list=%5B%7B%22amount%22%3A%220.01%22%2C%22fundChannel%22%3A%22PCREDIT%22%7D%5D&notify_type=trade_status_sync&trade_status=TRADE_SUCCESS&receipt_amount=0.01&buyer_pay_amount=0.01&app_id=2021001166613270&sign_type=RSA2&seller_id=2088022931802892&gmt_payment=2022-07-18+22%3A52%3A59&notify_time=2022-07-18+22%3A52%3A59&version=1.0&out_trade_no=139&total_amount=0.01&trade_no=2022071822001423291408718093&auth_app_id=2021001166613270&buyer_logon_id=myp***%40pennuo.com&point_amount=0.00';
        $response_array = explode("&",$response);
        $orderid = 0;
        $count = count($response_array);
        for($i=0;$i<$count;$i++){
            $response_array_1 = explode("=",$response_array[$i]);
            if($response_array_1[0] == "out_trade_no"){
                $orderid = $response_array_1[1];
            }
        }
        
        //$response_json = json_encode($response_array);
        //file_put_contents('./sss11s.txt',$response,FILE_APPEND);
        //file_put_contents('./log123.txt',$out_trade_no,FILE_APPEND);
        if($orderid > 0){
    		$orderid = $orderid;
    		$data = [
    			'dk_status'   => 2,
    			'dk_pay_time' => date("Y-m-d H:i:s"),
    		];
    		$res = Db("dianka")->where("dk_id = '{$orderid}' and dk_status = 1")->update($data);
    		if($res){ //如果更新成功，就给用户增加点数
    			$binfo = Db("dianka")->where("dk_id = '{$orderid}'")->find(); //查出订单信息
    			$sinfo = Db("substation")->where("su_id = ".$binfo['su_id'])->find(); //查出人员信息
    			$money = $sinfo['su_dk'] + $binfo['dk_money'];
    			$udata = [
    				'su_dk' => $money,
    			];
    			Db("substation")->where("su_id = ".$binfo['su_id'])->update($udata);
    			//1记录扣点信息 2扣除用户身上点卡
    		}
    		exit("success"); 
        }
	}
	
	
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
	
/*

@desc：xml转数组

@param data xml字符串

@return arr 解析出的数组

*/

function xmltoarray($data){
    $obj = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
    $json = json_encode($obj);
    $arr = json_decode($json, true);      
    return $arr;

}
	


}