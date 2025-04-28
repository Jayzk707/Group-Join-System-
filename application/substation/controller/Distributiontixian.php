<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Distributiontixian extends Base{

	
	public function index()
	{
		$res = model("distributiontixian")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'dt_content' => trim(input("content")),
				'dt_status'  => trim(input("status")),
				'dt_shtime'  => date("Y-m-d H:i:s"),
			];
			$duid = input('duid');
			$money = input('money');
			$res = model("distributiontixian")->Edit($DATA,$id,$duid,$money);
			return _Json($res);
		}
		$info = model("distributiontixian")->GetOne($id);
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