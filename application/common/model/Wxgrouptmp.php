<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Wxgrouptmp extends Base{
	
    protected $name = 'wxgroup_tmp';

	public function GetOne($id){
		return $this->where("wxgt_id = ".$id)->find();
	}	
	
	
	public function GetAllSuID($page){
		return $this->where("su_id = ".__DSUID__)->order("wxgt_id desc")->paginate($page);
	}
	
	
	public function GetAllSuIDTmp($page,$tmp){
	    $array = explode(",",$tmp);
		$array = array_filter($array);
	    $ids    = implode(",",$array);
		return $this->where("su_id = ".__DSUID__." and wxgt_id in ({$ids})")->paginate($page);
	}
	
	
	public function GetAll($page){
		return $this->where("su_id = ".__SUID__)->order("wxgt_id desc")->paginate($page);
	}	
	
	
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加群组模板信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加模板信息失败!'];
		}
	}
	
	
	public function edit($data,$id){
		$res = $this->where("wxgt_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改群组模板信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改群组模板信息失败!'];
		}
	}
	

	
	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组模板信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组模板信息失败!'];
		}
	}
	
	
	
	public function Del($id){
		$resflag = $this->where("wxgt_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组模板信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组模板信息失败!'];
		}
	}
	
	
}