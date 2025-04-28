<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Wxgroup extends Base{
	
    protected $name = 'wxgroup';

	public function GetDuAll($page){
		return $this->where("du_id = ".__DUID__)->order("wxg_id desc")->paginate($page);
	}

	public function GetOne($id){
		return $this->where("wxg_id = ".$id)->find();
	}	
	
	public function GetSuAll($page){
		return $this->alias("b")->
				join("__DISTRIBUTION__ d","b.du_id = d.du_id")-> //查询出分销人员信息
				where("b.su_id = ".__SUID__)->order("b.wxg_id desc")->paginate($page);
	}	
	

	
	public function GetSuAllS($page,$s){
		return $this->alias("b")->
				join("__DISTRIBUTION__ d","b.du_id = d.du_id")-> //查询出分销人员信息
				where("b.su_id = ".__SUID__." and b.wxg_title like '%{$s}%'")->order("b.wxg_id desc")->paginate($page);
	}
	
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加群组信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加信息失败!'];
		}
	}
	
	
	public function edit($data,$id){
		$res = $this->where("wxg_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改群组信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改群组信息失败!'];
		}
	}
	
	
	public function DelDuID($id){
		$resflag = $this->where("du_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组信息失败!'];
		}
	}
	
	
	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组信息失败!'];
		}
	}
	
	
	
	public function Del($id){
		$resflag = $this->where("wxg_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组信息失败!'];
		}
	}
	
	
}