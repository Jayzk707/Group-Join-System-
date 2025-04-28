<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Users extends Base{
	
    protected $name = 'users';
	protected $UserInfo = "";
	
	public function GetAll($page){
		return $this->where("1=1")->paginate($page);
	}
	
	public function GetOne($id,$type="id"){
		if($type=="id"){
			return $this->where("u_id = {$id}")->limit(1)->find();
		}else{
			return $this->where("u_phone = '{$id}'")->limit(1)->find();
		}
	}
	
	
	public function Password($data,$uid){
		//判断旧密码是否正确
		$info = $this->where("u_id = {$uid} and u_password = '".md5($data['oldpassword'])."'")->limit(1)->find();
		if(empty($info)){
			return ['status'=>1001,'msg'=>"旧密码错误，请输入正确的密码！"];
		}
		
		//判断新密码是否与旧密码一样
		if($data['oldpassword'] == $data['password']) return ['status'=>1002,'msg'=>"新密码不能和旧密码一致！"];
		
		//新密码和确认密码要一样
		if($data['endpassword'] != $data['password']) return ['status'=>1003,'msg'=>"确认密码须与新密码一致！"];
		
		$_DATA = [
			'u_password'    => md5($data['password']),
		];
		
		$res = $this->where("u_id = {$uid}")->update($_DATA);
		if($res){
			return ['status'=>1,'msg'=>'修改密码成功！','id' => $res];
		}else{
			return ['status'=>1004,'msg'=>'修改密码失败!'];
		}
	}
	
	public function Add($data){
		$validate = \think\Loader::validate('Users');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		$res = $this->GetOne($data['username'],"users");
		if(!empty($res)) return ['status'=>1002,'msg'=>'账号已经存在，请重新输入!'];
		
		$_DATA = [
			'u_phone'       => $data['username'],
			'u_password'    => md5($data['password']),
			'u_status'      => $data['status'],
			'u_supermanage' => $data['supermanage'],
			'u_regtime'     => date("Y-m-d H:i:s"),
		];
		
		$res = $this->insertGetId($_DATA);
		if($res){
			return ['status'=>1,'msg'=>'添加用户信息成功！','id' => $res];
		}else{
			return ['status'=>1003,'msg'=>'添加用户信息失败!'];
		}
	}	
	
	public function Del($id){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];
		if($res['u_supermanage'] == 2) return ['status'=>1003,'msg'=> "超级管理员无法被删除！"];
		if($id == session("uid")) return ['status'=>1004,'msg'=> "您无法删除自已！"];
		$resflag = $this->where("u_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除用户信息成功！','id' => $id];
		}else{
			return ['status'=>1005,'msg'=>'删除用户信息失败!'];
		}
	}	
	
	public function Status($id,$status){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];

		if($id == session("uid")) return ['status'=>1004,'msg'=> "您无法修改自已的状态！"];
		if($status == 1){
			$status = 2;
		}else{
			$status = 1;
		}
		
		$data = [
			'u_status' => $status,
		];

		$res = $this->where("u_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改用户状态信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改用户状态信息失败!'];
		}
	}	
	
	public function Supermanage($id,$status){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];

		if($id == session("uid")) return ['status'=>1004,'msg'=> "您无法修改自已超管状态！"];
		if($status == 1){
			$status = 2;
		}else{
			$status = 1;
		}
		
		$data = [
			'u_supermanage' => $status,
		];

		$res = $this->where("u_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改用户超管状态信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改用户超管状态信息失败!'];
		}
	}	
	
	

	public function Login($data){
		$validate = \think\Loader::validate('Users');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		$this->UserInfo = $this->where("u_phone = '{$data['username']}' and u_password = '".md5($data['password'])."'")->find();
		
		if(empty($this->UserInfo)) return ['status'=>1002,'msg'=>'此帐号不存在!'];
		
		if($this->UserInfo['u_status']==2) return ['status'=>1003,'msg'=>'此帐号已被禁用!'];
		
		$request = Request::instance();
		if($this->SetLoginInfo($request->ip())){
			model("userslogs")->WriteLogs($this->UserInfo['u_id'],1,$request->ip());
			return ['status'=>1,'msg'=>'登录成功','userinfo'=>$this->UserInfo];
		}else{
			return ['status'=>1004,'msg'=>'登录失败'];
		}
		
	}
	
	//用户登录成功后，设置用户登录信息
	public function SetLoginInfo($ip){
		$DbInfo = [
			'u_count'     => $this->UserInfo['u_count'] + 1,
			'u_this_time' => date("Y-m-d H:i:s"),
			'u_this_ip'   => $ip,
			'u_last_time' => $this->UserInfo['u_this_time'],
			'u_last_ip'   => $this->UserInfo['u_this_ip'],
		];
		
		return $this->where("u_id = {$this->UserInfo['u_id']}")->update($DbInfo);
	}

	
}