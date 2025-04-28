<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Voicelist extends Base{
	
	public function Index(){
		$res = model("Voicelist")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'vol_title'   => trim(input("title")),
				'vol_content' => trim(input("content")),
			];
			$res = model("Voicelist")->Add($DATA);
			return _Json($res);
		}
		return view();
	}
	
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'vol_title'   => trim(input("title")),
				'vol_content' => trim(input("content")),
			];
			$res = model("Voicelist")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("Voicelist")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	

	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Voicelist")->Del($id);
			return _Json($res);
		}
	}	
	
	
}