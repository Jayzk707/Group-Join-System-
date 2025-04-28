<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;
use think\Config;
class Index extends Base{
	public function home()
	{
		echo "首页";
		exit;
	}
	
	public function index()
	{
		return view();
	}



	
	//主控后台，直登操作
	public function login_admin()
	{
		Config::load(CONF_PATH.'extra/ip.php');
		$ip = config('ip');
		//if(Request::instance()->isAjax()){
			$data = [
				'username' => trim(input('username')),
				'password' => trim(input('password')),
			];
			$res = model("distribution")->Login($data);

			if($res['status']==1){
				$this->SetLoginSession($res['userinfo']);
			}
			$url =  url('center/index');
			header("Location: ".$url);
			exit;
		//}

	}

	
	public function login()
	{
		
		if(Request::instance()->isAjax()){
			$data = [
				'username' => trim(input('username')),
				'password' => trim(input('password')),
			];
			$res = model("distribution")->Login($data);
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
		//取出分站域名
		$substation = model("substation")->GetOne($userinfo['su_id']);
		session("du_name",$userinfo['du_name']);
		session("du_id",$userinfo['du_id']);
		session("su_id",$userinfo['su_id']);
		session("su_domain",$substation['su_domain']);
	}
	
	public function SetOutLoginSession(){
		session("du_name",null);
		session("du_id",null);
		session("su_id",null);
		session("su_domain",null);
	}
}