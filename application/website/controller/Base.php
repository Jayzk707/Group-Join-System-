<?php
namespace app\website\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Request;
use think\Config;
class Base extends Controller{
	public $page = 20;//默认分页
	protected $LoginStatus = false;
	protected $Url = ""; //URL地址
	protected $controller = ""; //控制器
	protected $action = ""; //方法
	
	public $table_prefix = "web_";
	
	protected $UrlNoPower = [
		1 => "index/index",
		2 => "index/login",
		3 => "index/outlogin",
		4 => "center/home",
		5 => "upload/uploadpayico",
		5 => "duizhang/add",
		6 => "chouyong/add",
		
		7 => "substation/get1",
		8 => "substation/get2",
		9 => "substation/get3",
		
	];//不要进行登录权限认证的控制
	
	protected $ActionNoPower = [
		1 => "users/logs",
		2 => "users/password",
		3 => "website/getsizeurl",
	]; //登录后不要进行权限认证的，公众模块
	
	protected $ActionPower = [
		'index' => false,
		'add' => false,
		'edit' => false,
		'del' => false,
		'addgroup' => false,
		'editgroup' => false,
		'delgroup' => false,
		'addauth' => false,
		'status' => false,
		'supermanage' => false,
		'addnavigat' => false,
		'addrenew' => false, //域名续费使用
		'getmonitor' => false, //获取网站监控点
		'addmonitor' => false, //添加网站监控点
		'editmonitor' => false, //编辑网站监控点
		'delmonitor' => false, //删除网站监控点
		'getmonery' => false,
		'addmonery' => false,
		'editmonery' => false,
		'delmonery' => false,
		'addallmonery' => false, //批量添加收益
		'addall' => false,
		'backup' => false,
		'show' => false,
	]; //各控件页面默认权限显示判断，例add edit del
	
	public function _initialize(){
		$this->CheckWhiteIP();
		$this->webConfig();
		$this->SetUrl();
		if(!in_array($this->Url,$this->UrlNoPower)){
			$LoginStatus = $this->CheckLoginStatus();
			switch($LoginStatus){
				case 1: 
					if(Request::instance()->isAjax()){return _Json(['status'=>9999,'msg'=>'请先登录']);
					}else{exit("请先登录"); }
				break;
				case 2: 
					if(Request::instance()->isAjax()){return _Json(['status'=>9999,'msg'=>'权限不通过']);
					}else{exit("权限不通过"); }
				break;
			}
			define("__UID__",session("uid"));
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
				exit("提醒Error：搭建配置出错需要帮助，请联系网站客服！<br>系统已经记录了您的访问IP：".$doip);
			}
		}
	}
	
	//显示控制器权限处理
	public function ShowActionPower($AuthList){
		foreach($this->ActionPower as $key => $value){
			$controller = strtolower($this->controller."/".$key);
			if(in_array($controller,$AuthList)){
				$this->ActionPower[$key] = true;
			}else{
				$this->ActionPower[$key] = false;
			}
		}
		$this->assign("__APS__",$this->ActionPower);
	}

	//权限判断
	protected function CheckLoginStatus(){
		if(empty(session("uid"))){
			return 1;
		}else{
			import('Auth.Auth');
			$Auth = new \Auth;
			$Auth->instance();
			if(!in_array($this->Url,$this->ActionNoPower)){
				if($Auth->check($this->Url,session("uid"))){
					$this->ShowActionPower($Auth->AuthList_GL);
					return 3;
				}else{
					return 2;
				}
			}else{
				return 3;
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