<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Paylist extends Base{
	
    protected $name = 'Paylist';
	
	//分站使用
	/*
	查询出自已所属会员组，所可以支持的支付方式
	*/
	public function GetSubstationAll()
	{
		$subInfo = model("Substationgroup")->GetOne(__SUGID__); //查出自已会员组的信息ID
		$paylist = $subInfo['su_g_paylist'];
		$paylist = substr($paylist,0,strlen($paylist)-1);
		$paylist_array = explode(",",$paylist);
		$paylist_count = count($paylist_array);
		//if($paylist_count == 1){
			return $this->where("pl_status = 1")->select();	
		//}else{
		//	$where = [];
		//	$where['pl_status'] = 1;
		//	$where['pl_id'] = ['between',$paylist];
		//	return $this->where($where)->select();
		//}
	}
	
	public function GetAll($page){
		return $this->where("1=1")->paginate($page);
	}
	
	public function GetAllStatus($page,$ststus){
		return $this->where("pl_status = {$ststus}")->paginate($page);
	}
	
	public function GetOne($id){
		return $this->where("pl_id = {$id}")->limit(1)->find();
	}
	
	
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加支付信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加支付信息失败!'];
		}
	}
	
	public function Edit($data,$id){
		
		
		$res = $this->where("pl_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改支付信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改支付信息失败!'];
		}
	}	
	
	public function Del($id){
		$resflag = $this->where("pl_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除支付信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除支付信息失败!'];
		}
	}

	
}