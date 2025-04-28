<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;

class Users extends Base{
	

	public function password(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'oldpassword'    => trim(input("oldpassword")),
				'password'       => trim(input("password")),
				'endpassword'    => trim(input("endpassword")),
			];
			$res = model("distribution")->Password($DATA,__DUID__);
			return _Json($res);
		}
		return view();
	}
	
	
}