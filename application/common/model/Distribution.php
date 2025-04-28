<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Distribution extends Base{
	
    protected $name = 'Distribution';
	
	//分销登录
	public function Login($data){
		//$validate = \think\Loader::validate('Users');
        //if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		if(empty($data['username'])){
			return ['status'=>1002,'msg'=>'用户名不能为空!'];
		}
		
		if(empty($data['password'])){
			return ['status'=>1002,'msg'=>'密码不能为空!'];
		}
		

		$data['username'] = urldecode($data['username']);

		$this->UserInfo = $this->where("du_name = '{$data['username']}' and du_pass = '".$data['password']."'")->find();
		
		if(empty($this->UserInfo)) return ['status'=>1002,'msg'=>'此帐号不存在!'];
		
		if($this->UserInfo['du_status']==2) return ['status'=>1003,'msg'=>'此帐号已被禁用!'];
		
		//$request = Request::instance();
		//if($this->SetLoginInfo($request->ip())){
			return ['status'=>1,'msg'=>'登录成功','userinfo'=>$this->UserInfo];
		//}else{
		//	return ['status'=>1004,'msg'=>'登录失败'];
		//}
		
	}
	
	
	//分销修改密码
	public function Password($data,$uid){
		//判断旧密码是否正确
		$info = $this->where("du_id = {$uid} and du_pass = '".$data['oldpassword']."'")->limit(1)->find();
		if(empty($info)){
			return ['status'=>1001,'msg'=>"旧密码错误，请输入正确的密码！"];
		}
		
		//判断新密码是否与旧密码一样
		if($data['oldpassword'] == $data['password']) return ['status'=>1002,'msg'=>"新密码不能和旧密码一致！"];
		
		//新密码和确认密码要一样
		if($data['endpassword'] != $data['password']) return ['status'=>1003,'msg'=>"确认密码须与新密码一致！"];
		
		$_DATA = [
			'du_pass'    => $data['password'],
		];
		
		$res = $this->where("du_id = {$uid}")->update($_DATA);
		if($res){
			return ['status'=>1,'msg'=>'修改密码成功！','id' => $res];
		}else{
			return ['status'=>1004,'msg'=>'修改密码失败!'];
		}
	}
	
	//退回提现金额
	public function tuihuiMoeny($money,$duid){
		$info = $this->GetOne($duid);
		$money = $info['du_money'] + $money;
		$DATA = [
			'du_name'  => $info['du_name'],
			'du_money' => $money,
		];
		$this->edit($DATA,$duid);
	}
	
	//减去提现金额
	public function shenqiangtuihuiMoeny($money){
		$DATA = array();
		$DATA['du_money'] = $money;
		$this->where("du_id = ".__DUID__)->update($DATA);
	}
	
	public function GetAll($page){
		return $this->alias("d")->join("__DISTRIBUTION_GROUP__ dg","d.dg_id = dg.dg_id")->where("d.su_id = ".__SUID__)->paginate($page);
	}
	
	public function GetOneDuid(){
		return $this->where("du_id = ".__DUID__)->limit(1)->find();
	}
	
	public function GetOne($id){
		return $this->where("du_id = {$id} and su_id = ".__SUID__)->limit(1)->find();
	}
	
	
	public function GetOneUser($name){
		return $this->where("du_name = '{$name}'")->limit(1)->find();
	}	
	
	public function Add($data){
		
		$uInfo = $this->GetOneUser($data['du_name']);
		if(!empty($uInfo)){
			return ['status'=>1001,'msg'=>'分销人员已存在，请重新设置!'];
		}
		
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加分销人员信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加分销人员信息失败!'];
		}
	}
	
	public function edit($data,$id){
		
		$uInfo = $this->GetOneUser($data['du_name']);
		if(!empty($uInfo)){
			if($uInfo['du_id']!=$id){
				return ['status'=>1001,'msg'=>'分销人员已存在，请重新设置!'];
			}
		}
		
		$res = $this->where("du_id = {$id} and su_id = ".__SUID__)->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改分销人员信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分销人员信息失败!'];
		}
	}	

	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销人员信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销人员信息失败!'];
		}
	}
	
	public function Del($id){
		$resflag = $this->where("du_id = {$id} and su_id = ".__SUID__)->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销人员信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销人员信息失败!'];
		}
	}

	
}