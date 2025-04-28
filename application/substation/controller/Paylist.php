<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;

class Paylist extends Base{
	
	public function Index(){
		$res = model("Paylist")->GetSubstationAll();
		foreach($res as $k=>$v){
			$res[$k]['su_pl_status'] = 2;
			$subinfo = Db("substation_paylist")->where("pl_id = {$res[$k]['pl_id']}")->find();
			if(!empty($subinfo)){
				$res[$k]['su_pl_status'] = $subinfo['su_pl_status'];
			}
		}
		$this->assign("list",$res);	
		return view();
	}

	
	public function Edit(){
		$id = input('id');
		
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'   => __SUID__,
				'pl_id'     => $id,
				'su_pl_status'     => trim(input("status")),
				'su_pl_content_1' => trim(input("su_pl_content_1")),
				'su_pl_content_2' => trim(input("su_pl_content_2")),
				'su_pl_content_3' => trim(input("su_pl_content_3")),
				'su_pl_content_4' => trim(input("su_pl_content_4")),
				'su_pl_content_5' => trim(input("su_pl_content_5")),
				'su_pl_content_6' => trim(input("su_pl_content_6")),
				'su_pl_content_7' => trim(input("su_pl_content_7")),
				'su_pl_content_8' => trim(input("su_pl_content_8")),
				'su_pl_content_9' => trim(input("su_pl_content_9")),
				'su_pl_content_10' => trim(input("su_pl_content_10")),
			];

			$res = model("SubstationPaylist")->Edit($DATA);
			return _Json($res);
		}	
		$info = model("Paylist")->GetOne($id);
		$list = explode("|",$info['pl_actname']);
		$SubPaylist = model("SubstationPaylist")->Getone($id); //查出个人分站此支付信息的配置信息
		$this->assign("SubPaylist",$SubPaylist);
		$this->assign("info",$info);
		$this->assign("list",$list);
		return view();
	}
	

	
	
}