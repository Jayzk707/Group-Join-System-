<?php
namespace app\notify\controller;
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
        //file_put_contents('./log12.txt',$input,FILE_APPEND);
        //file_put_contents('./log123.txt',$out_trade_no,FILE_APPEND);
        
		$id      = input('id');
		$orderid = $xml['out_trade_no'];
		$data = [
			'bl_status'    => 2,
			'bl_zfaddtime' => date("Y-m-d H:i:s"),
		];
		$res = Db("bill")->where("bl_sncode = '{$orderid}' and bl_status = 1")->update($data);
		if($res){ //如果更新成功，就给用户增加点数
			$binfo = Db("bill")->where("bl_sncode = '{$orderid}'")->find();
			$dinfo = Db("wxgroup")->alias("wxg")->join("__DISTRIBUTION__ d","d.du_id = wxg.du_id")->where("wxg.wxg_id = ".$binfo['wxg_id'])->find();
			$money = $binfo['bl_scalemoney'] + $dinfo['du_money'];
			$udata = [
				'du_money' => $money,
			];
			Db("distribution")->where("du_id = ".$dinfo['du_id'])->update($udata);
			//1记录扣点信息 2扣除用户身上点卡
			//计算扣费计录
			$substation_info = Db("substation")->where("su_id = ".$binfo['su_id'])->find();
			if($substation_info['su_dk_cd'] > 0){
    			$dk_money = $binfo['bl_money'] * ($substation_info['su_dk_cd']/100); //扣费记录
    			$in_money = $substation_info['su_dk'] - $dk_money;
    			$data_dk = [
    			    'dkl_money'   => $dk_money,
    			    'dkl_addtime' => date("Y-m-d H:i:s"),
    			    'su_id'       => $binfo['su_id'],
    			    'bl_id'       => $binfo['bl_id'],
    			    'dkl_su_id'   => $substation_info['su_s_id'],
    		    ];
    		    
    		    Db("dianka_log")->insertGetId($data_dk);
    		    $data_user = [
    			    'su_dk'   => $in_money,
    		    ];
    		    Db("substation")->where("su_id = ".$binfo['su_id'])->update($data_user);
			}
			//记录扣点信息
			
			//二级分站处理，记录扣点信息
			/*
			1.判断是不是有上级
			*/
			if($substation_info['su_s_id'] != 0){
			    $substation_info_s = Db("substation")->where("su_id = ".$substation_info['su_s_id'])->find();
			    if($substation_info_s['su_dk_cd'] > 0){
			        //写入点卡记录表
        			$dk_money = $binfo['bl_money'] * ($substation_info_s['su_dk_cd']/100); //扣费记录
        			$in_money = $in_money - $dk_money;
        			$data_dk = [
        			    'dkl_money'   => $dk_money,
        			    'dkl_addtime' => date("Y-m-d H:i:s"),
        			    'su_id'       => $binfo['su_id'],
        			    'bl_id'       => $binfo['bl_id'],
        			    'dkl_su_id'   => 0,
        		    ];
        		    
        		    Db("dianka_log")->insertGetId($data_dk);
        		    //扣除分站点卡
        		    $data_user = [
        			    'su_dk'   => $in_money,
        		    ];
        		    Db("substation")->where("su_id = ".$binfo['su_id'])->update($data_user);
        		    //上级站点分红抽点
        		    $dk_money1 = $binfo['bl_money'] * ($substation_info['su_dk_cd']/100); //扣费记录
        		    $fz_money = $substation_info_s['su_fz_money'] + $dk_money1;
        		    $data_user1 = [
        			    'su_fz_money' => $fz_money,
        		    ];
        		    Db("substation")->where("su_id = ".$substation_info['su_s_id'])->update($data_user1);
        		    
			    }
			}
			
			//二级分站处理，记录扣点信息
			
			
			
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