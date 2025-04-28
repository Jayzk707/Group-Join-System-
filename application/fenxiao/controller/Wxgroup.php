<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;
class Wxgroup extends Base{

	
	public function index()
	{
	    $d_info = Db("distribution")->where("du_id = ".session("du_id"))->find();
	    $this->assign('d_info', $d_info);
	    
	    
		$res = model("wxgroup")->GetDuAll($this->page);
		$list = $res->all();
		foreach($list as $k=>$v){
			$list[$k]['count_z_money'] = 0;
			$list[$k]['count_z_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->sum("bl_money");
			
			$list[$k]['count_p_money'] = 0;
			$list[$k]['count_p_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->sum("bl_scalemoney");
			
			$list[$k]['count_ddx'] = 0;
			$list[$k]['count_ddx'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->count("bl_id");
			
		}
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function turl()
	{
	    $url = input("url");
	    echo $url;
	    return view();
	}
	
	public function addimg(){
		return view(); 
	}
	
	public function editimg()
	{
		$id = trim(input("id"));
		$res = model("wxgroup")->GetOne($id);
		$this->assign("info",$res);	
		return view();
	}
	
	
	public function add()
	{
		if(Request::instance()->isAjax()){
			
			$dinfo = model("distribution")->GetOneDuid();
			
			$DATA = [
				'du_id'           => __DUID__,
				'su_id'           => $dinfo['su_id'],
				'wxg_money'       => trim(input("money")),
				'wxg_img'         => trim(input("wxg_headimg")),
				'wxg_title'       => trim(input("title")),
				'wxg_subtitle'    => trim(input("subtitle")),
				'wxg_status'      => trim(input("status")),
				'wxg_addtime'     => date("Y-m-d H:i:s"),
				'wxg_qjj_title'   => trim(input("qjj_title")),
				'wxg_qjj_content' => trim(input("qjj_content")),
				'wxg_buttitle'    => trim(input("buttitle")),
				'wxg_redcount'    => trim(input("redcount")),
				'wxg_dzcount'     => trim(input("dzcount")),
				'wxg_xxcount'     => trim(input("xxcount")),
				'wxg_kuai_title'     => trim(input("kuai_title")),
				'wxg_kuai_content'   => trim(input("kuai_content")),
				'wxg_qunyou_content' => trim(input("qunyou_content")),
				'wxg_adurl' => trim(input("wxg_adurl")),
				'wxg_headfile' => trim(input("headimg")),
				'wxg_kefu' => trim(input("wxg_kefu")),
				'wxg_content' => trim(input("wxg_content")),
				'wxg_type' => trim(input("wxg_type")),
				'wxg_kuai_title1' => trim(input("kuai_title1")),
				'wxg_kuai_imgs1' => trim(input("kuai_imgs1")),
				
				
				'wxg_jhao' => trim(input("wxg_jhao")),
				'wxg_jhaoimg' => trim(input("wxg_jhaoimg")),
				'wxg_jhaotitle' => trim(input("wxg_jhaotitle")),
				'wxg_jhaocontent' => trim(input("wxg_jhaocontent")),
				'wxg_paylists'    => trim(input("paylists")),
				'wxonoff'    => trim(input("wxonoff")),
			];

			$res = model("wxgroup")->Add($DATA);
			return _Json($res);
			
		}
		
		$substationPaylist = model("substationPaylist")->GetFxShow();
		$this->assign("substationPaylist",$substationPaylist);
		return view();
	}
	
	public function edit()
	{
		$id = trim(input("id"));
		if(Request::instance()->isAjax()){
			$DATA = [
				'wxg_money'       => trim(input("money")),
				'wxg_img'         => trim(input("wxg_headimg")),
				'wxg_title'       => trim(input("title")),
				'wxg_subtitle'    => trim(input("subtitle")),
				'wxg_status'      => trim(input("status")),
				'wxg_addtime'     => date("Y-m-d H:i:s"),
				'wxg_qjj_title'   => trim(input("qjj_title")),
				'wxg_qjj_content' => trim(input("qjj_content")),
				'wxg_buttitle'    => trim(input("buttitle")),
				'wxg_redcount'    => trim(input("redcount")),
				'wxg_dzcount'     => trim(input("dzcount")),
				'wxg_xxcount'     => trim(input("xxcount")),
				'wxg_kuai_title'     => trim(input("kuai_title")),
				'wxg_kuai_content'   => trim(input("kuai_content")),
				'wxg_qunyou_content' => trim(input("qunyou_content")),
				'wxg_adurl' => trim(input("wxg_adurl")),
				'wxg_headfile' => trim(input("headimg")),
				'wxg_kefu' => trim(input("wxg_kefu")),
				'wxg_content' => trim(input("wxg_content")),
				'wxg_kuai_title1' => trim(input("kuai_title1")),
				'wxg_kuai_imgs1' => trim(input("kuai_imgs1")),
				
				'wxg_jhao' => trim(input("wxg_jhao")),
				'wxg_jhaoimg' => trim(input("wxg_jhaoimg")),
				'wxg_jhaotitle' => trim(input("wxg_jhaotitle")),
				'wxg_jhaocontent' => trim(input("wxg_jhaocontent")),
				'wxg_paylists'    => trim(input("paylists")),
				'wxonoff'    => trim(input("wxonoff")),
			];

			$res = model("wxgroup")->Edit($DATA,$id);
			return _Json($res);
		}
		$res = model("wxgroup")->GetOne($id);
		$this->assign("info",$res);	
		$substationPaylist = model("substationPaylist")->GetFxShow();
		$this->assign("substationPaylist",$substationPaylist);
		return view();
	}
	
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("wxgroup")->Del($id);
			if($res['status'] == 1){
				model("bill")->DelWxgID($id);
			}
			return _Json($res);
		}
	}
	

}