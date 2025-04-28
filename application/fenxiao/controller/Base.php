<?php
namespace app\fenxiao\controller;
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
		4 => "center/home",
		5 => "index/login_admin",
		6 => "upload/uploadface",
	];//不要进行登录权限认证的控制	
	
	public function _initialize(){
		$this->CheckWhiteIP();
		$this->webConfig();
		$this->SetUrl();
		if(!in_array($this->Url,$this->UrlNoPower)){
			if(empty(session("du_id"))){
				if(Request::instance()->isAjax()){
					return _Json(['status'=>9999,'msg'=>'请先登录']);
				}else{
					exit("请先登录"); 
				}
			}
			
			$webinfo = model("Setup")->GetAll();
	    	$this->assign("webinfo",$webinfo);
			define("__DSUID__",session("su_id")); //分站用户ID
			define("__DUID__",session("du_id")); //分站用户ID
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
				exit("提醒Error：搭建配置出错，请认真看教程。需要帮助，请联系网站客服qiqi8899sm,付费咨询搭建问题 ！<br>系统已经记录了您的访问IP：".$doip);
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
