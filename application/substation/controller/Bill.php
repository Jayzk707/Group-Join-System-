<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Bill extends Base{

	
	public function index()
	{
		$res = model("bill")->GetSuAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("bill")->Del($id); //删除分站信息
			return _Json($res);
		}
	}

}