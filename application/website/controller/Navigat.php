<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Navigat extends Base{
	
	public function Index(){
		$res = model("Navigat")->GetAll();
		$this->assign("list",$res);
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'sns_id'        => input("snsid"),
				'ns_title'      => input("title"),
				'ns_icon'       => input("icon"),
				'ns_sort'       => input("_sort"),
				'ns_status'     => input("status"),
				'ns_controller' => input("controller"),
				'ns_method'     => input("method"),
			];
			$res = model("Navigat")->Add($DATA);
			return _Json($res);
		}	
		$res = model("Navigat")->GetAll($this->page);
		$this->assign("list",$res);
		return view();
	}
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'sns_id'        => input("snsid"),
				'ns_title'      => input("title"),
				'ns_icon'       => input("icon"),
				'ns_sort'       => input("_sort"),
				'ns_status'     => input("status"),
				'ns_controller' => input("controller"),
				'ns_method'     => input("method"),
			];
			$res = model("Navigat")->Edit($DATA,$id);
			return _Json($res);
		}
		$res = model("Navigat")->GetAll($this->page);
		$this->assign("list",$res);
		$info = model("Navigat")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Navigat")->Del($id);
			if($res['status']==1){
				Db("navigat_group")->where("ns_id = {$id}")->delete();
			}
			return _Json($res);
		}
	}		
	

}