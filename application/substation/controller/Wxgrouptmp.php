<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Wxgrouptmp extends Base{

	
	public function index()
	{
		$res = model("wxgrouptmp")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'           => __SUID__,
				'wxgt_money'       => trim(input("money")),
				'wxgt_img'         => trim(input("wxgt_headimg")),
				'wxgt_title'       => trim(input("title")),
				'wxgt_subtitle'    => trim(input("subtitle")),
				'wxgt_status'      => trim(input("status")),
				'wxgt_addtime'     => date("Y-m-d H:i:s"),
				'wxgt_qjj_title'   => trim(input("qjj_title")),
				'wxgt_qjj_content' => trim(input("qjj_content")),
				'wxgt_buttitle'    => trim(input("buttitle")),
				'wxgt_redcount'    => trim(input("redcount")),
				'wxgt_dzcount'     => trim(input("dzcount")),
				'wxgt_xxcount'     => trim(input("xxcount")),
				'wxgt_kuai_title'     => trim(input("kuai_title")),
				'wxgt_kuai_content'   => trim(input("kuai_content")),
				'wxgt_qunyou_content' => trim(input("qunyou_content")),
				'wxgt_adurl'          => trim(input("wxgt_adurl")),
				'wxgt_headfile'       => trim(input("headimg")),
				'wxgt_kefu'           => trim(input("wxgt_kefu")),
				
				'wxgt_kuai_title1'           => trim(input("kuai_title1")),
				'wxgt_kuai_imgs1'           => trim(input("kuai_imgs1")),
			];
			$res = model("wxgrouptmp")->Add($DATA);
			return _Json($res);
		}
		return view();
	}
	
	public function edit()
	{
		$id = trim(input("id"));
		if(Request::instance()->isAjax()){
			$DATA = [
				'wxgt_money'       => trim(input("money")),
				'wxgt_img'         => trim(input("wxgt_headimg")),
				'wxgt_title'       => trim(input("title")),
				'wxgt_subtitle'    => trim(input("subtitle")),
				'wxgt_status'      => trim(input("status")),
				'wxgt_addtime'     => date("Y-m-d H:i:s"),
				'wxgt_qjj_title'   => trim(input("qjj_title")),
				'wxgt_qjj_content' => trim(input("qjj_content")),
				'wxgt_buttitle'    => trim(input("buttitle")),
				'wxgt_redcount'    => trim(input("redcount")),
				'wxgt_dzcount'     => trim(input("dzcount")),
				'wxgt_xxcount'     => trim(input("xxcount")),
				'wxgt_kuai_title'     => trim(input("kuai_title")),
				'wxgt_kuai_content'   => trim(input("kuai_content")),
				'wxgt_qunyou_content' => trim(input("qunyou_content")),
				'wxgt_adurl' => trim(input("wxgt_adurl")),
				'wxgt_headfile' => trim(input("headimg")),
				'wxgt_kefu' => trim(input("wxgt_kefu")),
				'wxgt_kuai_title1'           => trim(input("kuai_title1")),
				'wxgt_kuai_imgs1'           => trim(input("kuai_imgs1")),
			];

			$res = model("wxgrouptmp")->Edit($DATA,$id);
			return _Json($res);
		}
		$res = model("wxgrouptmp")->GetOne($id);
		$this->assign("info",$res);	
		return view();
	}
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("wxgrouptmp")->Del($id);
			return _Json($res);
		}
	}
	

}