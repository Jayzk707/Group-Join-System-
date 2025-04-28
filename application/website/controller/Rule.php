<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Rule extends Base{
	
	public function Index(){
		$res = model("rule")->GetAll();
		$this->assign("list",$res);
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'     => trim(input("title")),
				'name'      => trim(input("name")),
				'status'    => trim(input("status")),
				'condition' => trim(input("condition")),
				'said'      => trim(input("said")),
				'sort'      => trim(input("sort")),
			];
			$res = model("rule")->Add($DATA);
			return _Json($res);
		}
		$res = model("rule")->GetAll();
		$this->assign("list",$res);
		return view();
	}
	
	public function Addgroup(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'  => trim(input("title")),
				'status' => 1,
				'sort'   => trim(input("sort")),
			];
			$res = model("rule")->Addgroup($DATA);
			return _Json($res);
		}	
		return view();
	}
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'     => trim(input("title")),
				'name'      => trim(input("name")),
				'status'    => trim(input("status")),
				'condition' => trim(input("condition")),
				'said'      => trim(input("said")),
				'sort'      => trim(input("sort")),
			];
			$res = model("rule")->Edit($DATA,$id);
			return _Json($res);
		}
		$res = model("rule")->GetAll();
		$this->assign("list",$res);
		$info = model("rule")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	public function Editgroup(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'  => trim(input("title")),
				'sort'   => trim(input("sort")),
			];
			$res = model("rule")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("rule")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("rule")->Del($id);
			return _Json($res);
		}
	}		
	
	public function Delgroup(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("rule")->Delgroup($id);
			return _Json($res);
		}
	}
	
}