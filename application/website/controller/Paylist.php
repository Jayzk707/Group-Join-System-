<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Paylist extends Base{
	
	public function Index(){
		$res = model("Paylist")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'pl_title'   => trim(input("title")),
				'pl_ico'     => trim(input("ico")),
				'pl_url'     => trim(input("url")),
				'pl_content' => trim(input("content")),
				'pl_status'  => trim(input("status")),
				'pl_code'    => trim(input("code")),
				'pl_actname' => trim(input("actname")),
			];

			$res = model("Paylist")->Add($DATA);
			return _Json($res);
		}
		return view();
	}
	
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			
			$DATA = [
				'pl_title'   => trim(input("title")),
				'pl_ico'     => trim(input("ico")),
				'pl_url'     => trim(input("url")),
				'pl_content' => trim(input("content")),
				'pl_status'  => trim(input("status")),
				'pl_code'    => trim(input("code")),
				'pl_actname' => trim(input("actname")),
			];
			
			$res = model("Paylist")->Edit($DATA,$id);
			return _Json($res);
		}	
		$info = model("Paylist")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	

	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Paylist")->Del($id);
			return _Json($res);
		}
	}	
	
	
}