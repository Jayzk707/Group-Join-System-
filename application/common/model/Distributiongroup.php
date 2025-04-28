<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Distributiongroup extends Base{
	
    protected $name = 'Distribution_group';
	
	public function GetAll($page){
		return $this->where("su_id = ".__SUID__)->paginate($page);
	}
	
	public function GetAllStatus($page,$ststus){
		return $this->where("pl_status = {$ststus}")->paginate($page);
	}
	
	public function GetOne($id){
		return $this->where("dg_id = {$id} and su_id = ".__SUID__)->limit(1)->find();
	}
	
	
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加分销群组信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加分销群组信息失败!'];
		}
	}
	
	public function edit($data,$id){
		$res = $this->where("dg_id = {$id} and su_id = ".__SUID__)->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改分销群组信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分销群组信息失败!'];
		}
	}	

	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销群组信息失败!'];
		}
	}
	
	public function Del($id){
		$resflag = $this->where("dg_id = {$id} and su_id = ".__SUID__)->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销群组信息失败!'];
		}
	}

	
}