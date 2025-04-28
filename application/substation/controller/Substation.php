<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
use think\Db;

class Substation extends Base{
	
	public function Index(){
	    $s = input("s");
	    $this->assign('s', $s);
	    if(empty($s)){
		    $res = model("Substation")->GetFzAll($this->page);
	    }else{
	        $res = model("Substation")->GetFzAllS($this->page,$s);
	    }
		$list = $res->all();
		foreach($list as $k=>$v){
			$list[$k]['count_fx'] = 0;
			$list[$k]['count_fx'] = Db("distribution")->where("su_id = {$list[$k]['su_id']}")->count("du_id");
			
			$list[$k]['count_group'] = 0;
			$list[$k]['count_group'] = Db("wxgroup")->where("su_id = {$list[$k]['su_id']}")->count("wxg_id");
			
			
			$list[$k]['count_daymoney'] = 0;
			$list[$k]['count_daymoney'] = Db("bill")->where("su_id = {$list[$k]['su_id']} and bl_status = 2")->whereTime('bl_addtime', 'today')->sum("bl_money");
			
			
			$list[$k]['count_zmoney'] = 0;
			$list[$k]['count_zmoney'] = Db("bill")->where("su_id = {$list[$k]['su_id']} and bl_status = 2")->sum("bl_money");
			
			$list[$k]['count_zylmoney'] = 0;
			$list[$k]['count_zylmoney'] = Db("bill")->where("su_id = {$list[$k]['su_id']} and bl_status = 2")->sum("bl_substationmoney");
			
			//月抽拥
			$list[$k]['count_cs'] = 0;
			$bill_moon = Db::query("SELECT sum(dkl_money) as zj FROM `web_dianka_log` where DATE_FORMAT(dkl_addtime,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m') and su_id = ".$list[$k]['su_id']);
			$list[$k]['count_cs'] = $bill_moon[0]['zj'];
		}
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$list);	
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
			    'su_s_id'    => __SUID__,
				'su_g_id'    => trim(input("su_g_id")),
				'su_status'  => trim(input("status")),
				'su_title'   => trim(input("title")),
				'su_domain'  => trim(input("domain")),
				'su_name'    => trim(input("username")),
				'su_pass'    => trim(input("password")),
				'su_addtime' => date("Y-m-d H:i:s"),
				'su_dk'      => trim(input("su_dk")),
				'su_dk_cd'   => trim(input("su_dk_cd")),
				'su_fzonoff'   => 1,
			];

			$res = model("Substation")->Add($DATA);
			return _Json($res);
		}
		$Substationgroup = model("Substationgroup")->GetAll(100);
		$this->assign("Substationgroup",$Substationgroup);	
		return view();
	}
	
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			
			$DATA = [
				'su_g_id'    => trim(input("su_g_id")),
				'su_status'  => trim(input("status")),
				'su_title'   => trim(input("title")),
				'su_domain'  => trim(input("domain")),
				'su_name'    => trim(input("username")),
				'su_pass'    => trim(input("password")),
				'su_endtime' => trim(input("enddate")),
				'su_dk'      => trim(input("su_dk")),
				'su_dk_cd'   => trim(input("su_dk_cd")),
			];
			
			$res = model("Substation")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("Substation")->GetFzOne($id);
		$this->assign("info",$info);
		$Substationgroup = model("Substationgroup")->GetAll(100);
		$this->assign("Substationgroup",$Substationgroup);	
		return view();
	}
	

	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Substation")->DelFz($id); //删除分站信息
			if($res['status'] == 1){
			    //删除分站群组
			    model("substationgroup")->DelSuID($id); //删除分站支付配置信息
			    //删除分站支付
			    model("SubstationPaylist")->Del($id); //删除分站支付配置信息
			    
			    //删除分站-分销人员信息
			    model("Distribution")->DelSuID($id);
			    //删除分站-分销人员群组信息
			    model("Distributiongroup")->DelSuID($id);
			    //删除分站-分销人员提现信息
			    model("Distributiontixian")->DelSuID($id);
			    //删除分站-分销人员微信群信息
			    model("wxgroup")->DelSuID($id);
			    //删除分站-分销人员帐单信息
			    model("bill")->DelSuID($id);
			    //删除分站-模板信息
			    model("wxgrouptmp")->DelSuID($id);
			}
			return _Json($res);
		}
	}	
	
	
}