<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Group extends Base{
	
	public function Index(){
		$res = model("Group")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'     => trim(input("title")),
				'status'    => trim(input("status")),
			];
			$res = model("Group")->Add($DATA);
			return _Json($res);
		}	
		return view();
	}
	
	public function Edit(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'title'     => trim(input("title")),
				'status'    => trim(input("status")),
			];
			$res = model("Group")->Edit($DATA,$id);
			return _Json($res);
		}
		$info = model("Group")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Group")->Del($id);
			if($res['status']==1){
				Db("navigat_group")->where("group_id = {$id}")->delete();
			}
			return _Json($res);
		}
	}

	public function addnavigat(){
		$id = input('id');
		
		if(Request::instance()->isAjax()){
			Db("navigat_group")->where("group_id = {$id}")->delete();
			$navs = input("navs");
			$nav_array = explode(",",$navs);
			//print_r($nav_array);
			$count = count($nav_array);
			if($count > 0){
				$count = $count - 1;
				for($i=0;$i<$count;$i++){
					//echo $nav_array[$i]."---";
					$DATA = [
						'ns_id' => $nav_array[$i],
						'group_id' => $id,
					];
					Db("navigat_group")->insertGetId($DATA);
				}
			}
			$json = ['status'=>1,'msg'=>'设置导航信息成功！'];
			return _Json($json);
		}
		
		$info = model("Group")->GetOne($id);
		$this->assign("info",$info);
		
		
		$res = model("Navigat")->GetAll();
		$this->assign("list",$res);
		
		$auth = model("rule")->GetStatusAll(1);
		$this->assign("auth",$auth);
		
		$groupinfo = Db("navigat_group")->where("group_id = {$id}")->select();
		$nav_ids    = [];
        foreach ($groupinfo as $g) {
            $nav_ids = array_merge($nav_ids, explode(',', trim($g['ns_id'], ',')));
        }
        $nav_ids = array_unique($nav_ids);
		$nav_ids = implode(",",$nav_ids);
		$this->assign("nav_ids",$nav_ids);
		return view();
	}
	
	
	public function addauth(){
		$id = input('id');
		if(Request::instance()->isAjax()){
			$DATA = [
				'rules'     => trim(input("rules")),
			];
			$res = model("Group")->Auth($DATA,$id);
			return _Json($res);
		}
		$res = model("rule")->GetAll();
		$this->assign("list",$res);
		
		$auth = model("rule")->GetStatusAll(1);
		$this->assign("auth",$auth);
		
		$info = model("Group")->GetOne($id);
		$this->assign("info",$info);
		return view();
	}

}