<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Setup extends Base{
	
	public function Index(){
	    $res = model("Setup")->GetAll();
	    $this->assign("info",$res);
		return view();
	}

	
	public function Edit(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'appid'     => trim(input("appid")),
				'appsecret' => trim(input("appsecret")),
				'mchid'     => trim(input("mchid")),
				'apikey'    => trim(input("apikey")),
				'zfbappid'  => trim(input("zfbappid")),
				'zfbskey'   => trim(input("zfbskey")),
				'zfbgkey'   => trim(input("zfbgkey")),
				
				'text1'   => trim(input("text1")),
				'text2'   => trim(input("text2")),
				'text3'   => trim(input("text3")),
				'text4'   => trim(input("text4")),
				'text5'   => trim(input("text5")),
				'text6'   => trim(input("text6")),
				'text7'   => trim(input("text7")),
				'text8'   => trim(input("text8")),
				'text9'   => trim(input("text9")),
				'text10'   => trim(input("text10")),
				'text11'   => trim(input("text11")),
				'text12'   => trim(input("text12")),
				'text13'   => trim(input("text13")),
				'text14'   => trim(input("text14")),
				
				'text15'   => trim(input("text15")),
				'text16'   => trim(input("text16")),
				'text17'   => trim(input("text17")),
				'dkgg_content'   => trim(input("dkgg_content")),
				'zfbopen'   => trim(input("zfbopen")),
				'wxopen'   => trim(input("wxopen")),
				
			];
			$res = model("Setup")->Edit($DATA);
			return _Json($res);
		}
	}
	

	
	
}