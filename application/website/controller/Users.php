<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;

class Users extends Base{
	
	public function Index(){
		$res = model("Users")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function logs(){
		$res = model("Userslogs")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	public function password(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'oldpassword'    => trim(input("oldpassword")),
				'password'       => trim(input("password")),
				'endpassword'    => trim(input("endpassword")),
			];
			$res = model("Users")->Password($DATA,__UID__);
			return _Json($res);
		}
		return view();
	}
	
	public function Add(){
		if(Request::instance()->isAjax()){
			$DATA = [
				'username'    => trim(input("phone")),
				'password'    => trim(input("password")),
				'status'      => trim(input("status")),
				'supermanage' => trim(input("supermanage")),
			];
			$res = model("Users")->Add($DATA);
			return _Json($res);
		}
		$this->assign("password",_RandStr());	
		return view();
	}
	
	public function Addauth(){
		$id = input('id');
		$__USER_ACCESS__ = Db("auth_group_access")->where("uid = ".$id);
		if(Request::instance()->isAjax()){
			$groupid = input('groupid');
			$__USER_ACCESS__->delete();
			if(empty($groupid)){
				$res = ['status'=>1001,'msg'=>'请先勾选用户群组!'];
			}else{
				$group_array = explode(",",$groupid);
				$group_count = count($group_array) - 1;
				$data = [];
				for($i=0;$i<$group_count;$i++){
					$data[$i]['uid']      = $id;
					$data[$i]['group_id'] = $group_array[$i];
				}
				$resinfo = Db("auth_group_access")->insertAll($data);
				if($resinfo){
					$res = ['status'=>1,'msg'=>'设置用户群组成功！'];
				}else{
					$res = ['status'=>1002,'msg'=>'设置用户群组失败!'];
				}
			}
			return _Json($res);
		}
		$userinfo = model("Users")->GetOne($id);
		$res = model("Group")->ShowAll("status = 1");
		$access = $__USER_ACCESS__->field("group_id")->select(); //用户与群组关连表
		$tmp_access = "";
		foreach($access as $k => $v){
			foreach ($access[$k] as $index => $value) {
				$tmp_access = $tmp_access . $value . ",";
			}
		}
		$this->assign("access",$tmp_access);
		$this->assign("info",$userinfo);
		$this->assign("list",$res);	
		return view();
	}
	
	public function Status(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$status = input('status');
			$res = model("Users")->Status($id,$status);
			return _Json($res);
		}
	}
	
	public function SuperManage(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$status = input('status');
			$res = model("Users")->Supermanage($id,$status);
			return _Json($res);
		}
	}	
	
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Users")->Del($id);
			return _Json($res);
		}
	}	
	
	
}