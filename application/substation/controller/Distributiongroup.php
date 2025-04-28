<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Distributiongroup extends Base{

	
	public function index()
	{
		$res = model("distributiongroup")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'su_id'      => __SUID__,
				'dg_title'   => trim(input("title")),
				'dg_status'  => trim(input("status")),
				'dg_count'   => trim(input("count")),
				'dg_content' => trim(input("content")),
			];

			$res = model("distributiongroup")->Add($DATA);
			return _Json($res);
		}
		return view();
	}
	
	public function edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'dg_title'   => trim(input("title")),
				'dg_status'  => trim(input("status")),
				'dg_count'   => trim(input("count")),
				'dg_content' => trim(input("content")),
			];
			
			$res = model("distributiongroup")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("distributiongroup")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	
	public function del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("distributiongroup")->Del($id); //删除分站信息
			return _Json($res);
		}
	}
	
}