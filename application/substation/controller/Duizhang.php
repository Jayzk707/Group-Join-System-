<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
use think\Db;

class Duizhang extends Base{
	
	public function Index(){
		$res = model("Duizhang")->GetFzAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}

	
}