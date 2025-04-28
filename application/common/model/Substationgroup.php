<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Substationgroup extends Base{
	
    protected $name = 'Substation_group';

	public function GetAll($page){
		return $this->where("1 = 1")->paginate($page);
	}	
	
	public function GetOne($id){
		return $this->where("su_g_id = {$id}")->limit(1)->find();
	}

	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加分站群组信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加分站群组信息失败!'];
		}
	}
	
	
	public function Edit($data,$id){
		$res = $this->where("su_g_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改分站群组信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改分站群组信息失败!'];
		}
	}	
	
	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分站群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分站群组信息失败!'];
		}
	}
	
	
	public function Del($id){
		$resflag = $this->where("su_g_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分站群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分站群组信息失败!'];
		}
	}
	
}