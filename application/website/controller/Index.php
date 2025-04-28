<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Index extends Base{
	
	public function Index(){
		//echo md5("123456qq");
		return view();
	}
	

	public function Login(){
		if(Request::instance()->isAjax()){
			$data = [
				'username' => trim(input('username')),
				'password' => trim(input('password')),
			];
			$res = model("users")->Login($data);
			if($res['status']==1){
				$this->SetLoginSession($res['userinfo']);
			}
			return _Json($res);
		}
	}
	
	public function OutLogin(){
		if(Request::instance()->isAjax()){
			$this->SetOutLoginSession();
			$res['status'] = "success";
			$res['data']   = "退出成功！";
			return _Json($res);
		}
	}
	
	protected function SetLoginSession($userinfo){
		session("uid",$userinfo['u_id']);
		session("uphone",$userinfo['u_phone']);
		session("unickname",$userinfo['u_nickname']);
		//session("gid",$userinfo['g_id']);
	}
	
	protected function SetOutLoginSession(){
		session("uid",null);
		session("uphone",null);
		session("unickname",null);
		//session("gid",null);
	}
	
}