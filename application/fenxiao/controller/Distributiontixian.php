<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;
class Distributiontixian extends Base{

	
	public function index()
	{
		$res = model("distributiontixian")->GetDuIdAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function add()
	{
		$res = model("distribution")->GetOneDuid();
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'      => $res['su_id'],
				'du_id'      => __DUID__,
				'dt_addtime' => date("Y-m-d H:i:s"),
				'dt_money'   => trim(input("money")),
				'dt_img'   => trim(input("dt_img")),
			];

			$res = model("distributiontixian")->Add($DATA);
			return _Json($res);
		}		
		
		$this->assign("info",$res);	
		return view();
	}

	
}