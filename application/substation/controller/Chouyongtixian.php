<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Chouyongtixian extends Base{

	
	public function index()
	{
		$res = model("substationtixian")->GetSuIdAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function add()
	{
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'      => __SUID__,
				'su_addtime' => date("Y-m-d H:i:s"),
				'su_money'   => trim(input("money")),
				'su_img'     => trim(input("dt_img")),
			];

			$res = model("substationtixian")->Add($DATA);
			return _Json($res);
		}
		return view();
	}

	
}