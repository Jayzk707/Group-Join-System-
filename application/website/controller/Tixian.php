<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;
class Tixian extends Base{

	public function index()
	{
		$res = model("substationtixian")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_content' => trim(input("content")),
				'st_status'  => trim(input("status")),
				'su_shtime'  => date("Y-m-d H:i:s"),
			];
			$suid = input('suid');
			$money = input('money');
			$res = model("Substationtixian")->Edit($DATA,$id,$suid,$money);
			return _Json($res);
		}
		$info = model("Substationtixian")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	public function del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("distributiontixian")->Del($id); //删除分站信息
			return _Json($res);
		}
	}
	
}