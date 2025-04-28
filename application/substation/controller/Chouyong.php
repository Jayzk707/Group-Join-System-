<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;

class Chouyong extends Base{
	
	public function Index(){
		$res = model("Diankalog")->GetFzCYAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
}