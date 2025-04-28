<?php
namespace app\notifysc\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
use think\Config;

class Index extends Controller{

	public function _initialize(){

	}

	public function index(){
        $input = file_get_contents("php://input"); //接收POST数据
        $xml = $this->xml2array($input);
        //$xml = simplexml_load_string($input); //提取POST数据为simplexml对象
        //file_put_contents('./ssss.txt',$input,FILE_APPEND);
        //file_put_contents('./log123.txt',$out_trade_no,FILE_APPEND);
		$orderid = $xml['out_trade_no'];
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