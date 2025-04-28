<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Substationgroup extends Base{
	
	public function Index(){
		$res = model("Substationgroup")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_g_title'   => trim(input("title")),
				'su_g_day'     => trim(input("daycount")),
				'su_g_paylist' => trim(input("paylist_list")),
				'su_g_content' => trim(input("content")),
			];

			$res = model("Substationgroup")->Add($DATA);
			return _Json($res);
		}
		$Paylist = model("Paylist")->GetAllStatus(100,1);
		$this->assign("Paylist",$Paylist);	
		return view();
	}
	
	
	public function edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			
			$DATA = [
				'su_g_title'   => trim(input("title")),
				'su_g_day'     => trim(input("daycount")),
				'su_g_paylist' => trim(input("paylist_list")),
				'su_g_content' => trim(input("content")),
			];
			
			$res = model("Substationgroup")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("Substationgroup")->GetOne($id);
		$this->assign("info",$info);
		$Paylist = model("Paylist")->GetAllStatus(100,1);
		$this->assign("Paylist",$Paylist);	
		return view();
	}
	

	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Substationgroup")->Del($id);
			return _Json($res);
		}
	}	
	
	
}