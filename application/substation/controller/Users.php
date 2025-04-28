<?php
namespace app\substation\controller;
use app\substation\controller\Base;
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
			$res = model("Substation")->Password($DATA,__SUID__);
			return _Json($res);
		}
		return view();
	}
	
	
}