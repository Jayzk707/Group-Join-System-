<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
use think\Db;
class Distribution extends Base{

	
	public function index()
	{
		$res = model("distribution")->GetAll($this->page);
		$list = $res->all();
		foreach($list as $k=>$v){
			$list[$k]['count_group'] = 0;
			$list[$k]['count_group'] = Db("wxgroup")->where("du_id = {$list[$k]['du_id']}")->count("wxg_id");
			
			$list[$k]['count_z_money'] = 0;
			$list[$k]['count_z_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and bl_status = 2")->sum("bl_money");
			
			$list[$k]['count_s_money'] = 0;
			$list[$k]['count_s_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and bl_status = 2")->sum("bl_scalemoney");
			
			$list[$k]['count_p_money'] = 0;
			$list[$k]['count_p_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and bl_status = 2")->sum("bl_substationmoney");
			
			
			$list[$k]['count_daymoney'] = 0;
			$list[$k]['count_daymoney'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and bl_status = 2")->whereTime('bl_addtime', 'today')->sum("bl_money");
			
			
			//月抽拥
			$list[$k]['count_cs'] = 0;
			$bill_moon = Db::query("SELECT sum(bl_money) as zj FROM `web_bill` where DATE_FORMAT(bl_addtime,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m') and 	du_id = ".$list[$k]['du_id']);
			$list[$k]['count_cs'] = $bill_moon[0]['zj'];
			
		}
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$list);	
		return view();
	}
	
	public function add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'      => __SUID__,
				'dg_id'      => trim(input("dg_id")),
				'du_money'   => 0,
				'du_name'    => trim(input("name")),
				'du_pass'    => trim(input("pass")),
				'du_addtime' => date("Y-m-d H:i:s"),
				'du_status'  => trim(input("status")),
				'du_phone'   => trim(input("phone")),
				'du_zfb'     => trim(input("zfb")),
				'du_wx'      => trim(input("wx")),
				'du_smname'  => trim(input("smname")),
				'du_tmp'  => trim(input("du_tmp")),
				'du_tmpstr'  => trim(input("paylists")),
			];

			$res = model("distribution")->Add($DATA);
			return _Json($res);
		}
		
		$res = model("wxgrouptmp")->GetAll($this->page);
		$this->assign("tmp",$res);	
		
		$res = model("distributiongroup")->GetAll($this->page);
		$this->assign("list",$res);
		return view();
	}
	
	public function edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'dg_id'      => trim(input("dg_id")),
				'du_name'    => trim(input("name")),
				'du_pass'    => trim(input("pass")),
				'du_status'  => trim(input("status")),
				'du_phone'   => trim(input("phone")),
				'du_zfb'     => trim(input("zfb")),
				'du_wx'      => trim(input("wx")),
				'du_smname'  => trim(input("smname")),
				'du_tmp'  => trim(input("du_tmp")),
				'du_tmpstr'  => trim(input("paylists")),
				
			];
			
			$res = model("distribution")->Edit($DATA,$id);
			return _Json($res);
		}
		
		$res = model("wxgrouptmp")->GetAll($this->page);
		$this->assign("tmp",$res);	
		
		$info = model("distribution")->GetOne($id);
		$this->assign("info",$info);
		$res = model("distributiongroup")->GetAll($this->page);
		$this->assign("list",$res);
		return view();
	}
	
	public function del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("distribution")->Del($id); //删除分销信息
			if($res['status'] == 1){
			    //删除分销群组
			    model("distribution")->DelDuID($id);
			    //删除分销提现记录
			    model("distributiontixian")->DelDuID($id);
			    //删除分销帐单记录
			    model("bill")->DelDuID($id);
			}
			return _Json($res);
		}
	}
	
}