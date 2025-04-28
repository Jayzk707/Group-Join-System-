<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Substation extends Base{
	
    protected $name = 'Substation';
	
	//减去提现金额
	public function shenqiangtuihuiMoeny($money){
		$DATA = array();
		$DATA['su_fz_money'] = $money;
		$this->where("su_id = ".__SUID__)->update($DATA);
	}	
	
	//退回提现金额
	public function tuihuiMoeny($money,$duid){
		$info = $this->GetOne($duid);
		$money = $info['su_fz_money'] + $money;
		$DATA = [
			'su_fz_money' => $money,
		];
		$res = $this->where("su_id = {$duid}")->update($DATA);
		if($res){
			return ['status'=>1,'msg'=>'修改分站信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分站信息失败!'];
		}
	}
	
	//分站登录
	public function Login($data){
		//$validate = \think\Loader::validate('Users');
        //if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		if(empty($data['username'])){
			return ['status'=>1002,'msg'=>'用户名不能为空!'];
		}
		
		if(empty($data['password'])){
			return ['status'=>1002,'msg'=>'密码不能为空!'];
		}
		
		$this->UserInfo = $this->where("su_name = '{$data['username']}' and su_pass = '".$data['password']."'")->find();
		
		if(empty($this->UserInfo)) return ['status'=>1002,'msg'=>'此帐号不存在!'];
		
		if($this->UserInfo['su_status']==2) return ['status'=>1003,'msg'=>'此帐号已被禁用!'];
		if($this->UserInfo['su_status']==3) return ['status'=>1003,'msg'=>'此帐号已到期!'];
		
		//$request = Request::instance();
		//if($this->SetLoginInfo($request->ip())){
			return ['status'=>1,'msg'=>'登录成功','userinfo'=>$this->UserInfo];
		//}else{
		//	return ['status'=>1004,'msg'=>'登录失败'];
		//}
		
	}
	
	//分站修改密码
	public function Password($data,$uid){
		//判断旧密码是否正确
		$info = $this->where("su_id = {$uid} and su_pass = '".$data['oldpassword']."'")->limit(1)->find();
		if(empty($info)){
			return ['status'=>1001,'msg'=>"旧密码错误，请输入正确的密码！"];
		}
		
		//判断新密码是否与旧密码一样
		if($data['oldpassword'] == $data['password']) return ['status'=>1002,'msg'=>"新密码不能和旧密码一致！"];
		
		//新密码和确认密码要一样
		if($data['endpassword'] != $data['password']) return ['status'=>1003,'msg'=>"确认密码须与新密码一致！"];
		
		$_DATA = [
			'su_pass'    => $data['password'],
		];
		
		$res = $this->where("su_id = {$uid}")->update($_DATA);
		if($res){
			return ['status'=>1,'msg'=>'修改密码成功！','id' => $res];
		}else{
			return ['status'=>1004,'msg'=>'修改密码失败!'];
		}
	}
	
	public function GetFzAll($page){
		return $this->where("s.su_s_id = ".__SUID__)->alias("s")->order("su_id asc")->join("__SUBSTATION_GROUP__ sg","sg.su_g_id = s.su_g_id")->paginate($page);
	}
	
	public function GetFzAllS($page,$s){
		return $this->where("s.su_s_id = ".__SUID__." and s.su_title like '%{$s}%' or s.su_domain like '%{$s}%'")->alias("s")->join("__SUBSTATION_GROUP__ sg","sg.su_g_id = s.su_g_id")->paginate($page);
	}
	
	public function GetAll($page){
		return $this->where("1=1")->alias("s")->join("__SUBSTATION_GROUP__ sg","sg.su_g_id = s.su_g_id")->order("su_id asc")->paginate($page);
	}
	
	
	public function GetAllS($page,$s){
		return $this->where("s.su_title like '%{$s}%' or s.su_domain like '%{$s}%'")->alias("s")->join("__SUBSTATION_GROUP__ sg","sg.su_g_id = s.su_g_id")->paginate($page);
	}
	
	
	public function GetFzOne($id){
		return $this->where("su_id = {$id} and su_s_id = ".__SUID__)->limit(1)->find();
	}	
	
	public function GetOne($id){
		return $this->where("su_id = {$id}")->limit(1)->find();
	}
	
	public function GetOneUser($name){
		return $this->where("su_name = '{$name}'")->limit(1)->find();
	}
	
	public function GetOneDomain($domain){
		return $this->where("su_domain = '{$domain}'")->limit(1)->find();
	}
	
	public function Add($data){
		
		$data['su_domain'] = str_ireplace("https://","", $data['su_domain']);
		$data['su_domain'] = str_ireplace("http://","", $data['su_domain']);
		$data['su_domain'] = str_ireplace("/","", $data['su_domain']);
		
		$uInfo = $this->GetOneUser($data['su_name']);
		if(!empty($uInfo)){
			return ['status'=>1001,'msg'=>'分站帐号已存在，请重新设置!'];
		}
		
		$dInfo = $this->GetOneDomain($data['su_domain']);
		if(!empty($dInfo)){
			return ['status'=>1001,'msg'=>'分站域名已存在，请重新设置!'];
		}
		
		$sugInfo = model("Substationgroup")->GetOne($data['su_g_id']);
		if(empty($sugInfo)){
			return ['status'=>1003,'msg'=>'分站群组不存在，请先添加群组!'];
		}
		
		//计算到期时间
		if($sugInfo['su_g_day'] == 0){ //当前时间加99年
			$endday = date("Y-m-d",strtotime("+99 year"));
		}else{
			$endday = date("Y-m-d",strtotime("+".$sugInfo['su_g_day']." month"));
		}
		//计算到期时间
		

		$data['su_endtime'] = $endday;
		
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加分站信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加分站信息失败!'];
		}
	}
	
	public function Edit($data,$id){
		
		$data['su_domain'] = str_ireplace("https://","", $data['su_domain']);
		$data['su_domain'] = str_ireplace("http://","", $data['su_domain']);
		$data['su_domain'] = str_ireplace("/","", $data['su_domain']);
		
		$uInfo = $this->GetOneUser($data['su_name']);
		if(!empty($uInfo)){
			if($uInfo['su_id']!=$id){
				return ['status'=>1001,'msg'=>'分站帐号已存在，请重新设置!'];
			}
		}
		
		$dInfo = $this->GetOneDomain($data['su_domain']);
		if(!empty($dInfo)){
			if($dInfo['su_id']!=$id){
				return ['status'=>1001,'msg'=>'分站域名已存在，请重新设置!'];
			}
		}
		

		if(empty($data['su_pass'])){
			$info = $this->GetOne($id);
			$data['su_pass'] = $info['su_pass'];
		}
		

		$res = $this->where("su_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改分站信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分站信息失败!'];
		}
	}
	
	public function EditS($data,$id){
		$res = $this->where("su_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改分站信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分站信息失败!'];
		}
	}
	
	
	
	public function DelFz($id){
		$resflag = $this->where("su_id = {$id} and su_s_id = ".__SUID__)->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分站信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分站信息失败!'];
		}
	}
	
	
	public function Del($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分站信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分站信息失败!'];
		}
	}

	
}