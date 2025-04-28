<?php
namespace app\substation\controller;
use app\substation\controller\Base;
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
		    $password = trim(input('password'));
            $password = str_ireplace("[AAA]", "#", $password);
		    
			$data = [
				'username' => trim(input('username')),
				'password' => $password,
			];
			$res = model("substation")->Login($data);
			
			if($res['status']==1){
				$this->SetLoginSession($res['userinfo']);
			}
			
			$url =  "http://{$_SERVER['HTTP_HOST']}".url('center/index');
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
			$res = model("substation")->Login($data);
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
	    session("su_title",$userinfo['su_title']);
		session("su_name",$userinfo['su_name']);
		session("su_g_id",$userinfo['su_g_id']);
		session("su_id",$userinfo['su_id']);
	}
	
	public function SetOutLoginSession(){
	    session("su_title",null);
		session("su_name",null);
		session("su_g_id",null);
		session("su_id",null);
	}
}