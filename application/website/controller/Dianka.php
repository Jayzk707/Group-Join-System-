<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Dianka extends Base{
	
	public function Index(){
		$res = model("Dianka")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
		    $name = input('title');
			$DATA = [
				'dk_addtime'  => date("Y-m-d H:i:s"),
				'dk_status'   => 2,
				'dk_pay_time' => date("Y-m-d H:i:s"),
				'dk_money'    => trim(input("money")),
				'dk_type'     => 3,
			];
			$res = model("Dianka")->Add($DATA,$name);
			return _Json($res);
		}
		return view();
	}

	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Dianka")->Del($id);
			return _Json($res);
		}
	}	
	
	
}