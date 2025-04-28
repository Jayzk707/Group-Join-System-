<?php
namespace app\substation\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;
use think\Config;
class Base extends Controller{
	
	public $page = 20;//默认分页
	protected $Url = ""; //URL地址
	protected $controller = ""; //控制器
	protected $action = ""; //方法
	protected $UrlNoPower = [
		1 => "index/index",
		2 => "index/login",
		3 => "index/outlogin",
		5 => "index/login_admin",
	];//不要进行登录权限认证的控制	
	
	public function _initialize(){
		$this->CheckWhiteIP();
		$this->webConfig();
		$this->SetUrl();
		if(!in_array($this->Url,$this->UrlNoPower)){
			if(empty(session("su_id"))){
				if(Request::instance()->isAjax()){
					return _Json(['status'=>9999,'msg'=>'请先登录']);
				}else{
					exit("请先登录"); 
				}
			}
			$webinfo = model("Setup")->GetAll();
	    	$this->assign("webinfo",$webinfo);
	    	
	    	
	    	$fzinfo = model("Substation")->GetOne(session("su_id"));
	    	$this->assign("fzinfo",$fzinfo);
	    	
	    	//证明有上线,查出上家信息
	    	if($fzinfo['su_s_id'] != 0){
	    	    $fzsinfo = model("Substation")->GetOne($fzinfo['su_s_id']);
	    	    $this->assign("fzsinfo",$fzsinfo);
	    	}
	    	
	    	
			define("__SUID__",session("su_id")); //分站用户ID
			define("__SUGID__",session("su_g_id")); //分站群组ID
		}
	}
	
	//检测白名单IP
	public function CheckWhiteIP(){
		Config::load(CONF_PATH.'extra/ip.php');
		$ip = config('ip');
		if(config('onoff')){
			$doip = $_SERVER['HTTP_HOST'];
			$ip_array = explode("|",$ip);
			if(!in_array($doip,$ip_array)){
				exit("Error：搭建出错，如需帮助，www.9k9ym.com！<br>系统已经记录了您的访问IP：".$doip);
			}
		}
	}
	
	//调用系统配置信息
	protected function webConfig(){
		Config::load(CONF_PATH.'extra/web.php');
		$web = config('web');
		$this->page = config('page');
		$this->assign("subweb",$web);
	}	
	
	//设置URL地址信息全部转小写
	protected function SetUrl(){
		$request = Request::instance();
		$this->controller = $request->controller();
		$this->action = $request->action();
		$this->Url = strtolower($this->controller."/".$this->action);
	}
	
}
