<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Distributiontixian extends Base{
	
    protected $name = 'Distribution_tixian';
	
	//展示当前分销所有提现
	public function GetDuIdAll($page){
		return $this->where("du_id = ".__DUID__)->order("dt_id desc")->paginate($page);
	}
	
	//展示当前分站所有提现
	public function GetAll($page){
		return $this->alias("d")->join("__DISTRIBUTION__ du","d.du_id = du.du_id")->order("d.dt_id desc")->where("d.su_id = ".__SUID__)->paginate($page);
	}
	
	public function GetOne($id){
		return $this->alias("d")->join("__DISTRIBUTION__ du","d.du_id = du.du_id")->where("d.dt_id = {$id} and d.su_id = ".__SUID__)->limit(1)->find();
	}
	
	
	public function Add($data){
		
		if($data['dt_money'] <= 0){
			return ['status'=>1002,'msg'=>'提现金额不能小于等于0!'];
		}
		
		$res1 = model("distribution")->GetOneDuid();
		if($res1['du_money']<$data['dt_money']){
			return ['status'=>1002,'msg'=>'提现金额不能大于可提现金额!'];
		}
		
		$res = $this->insertGetId($data);
		if($res){
			$du_money = $res1['du_money'] - $data['dt_money'];
			model("distribution")->shenqiangtuihuiMoeny($du_money);
			return ['status'=>1,'msg'=>'添加支付信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加支付信息失败!'];
		}
	}
	
	
	public function edit($data,$id,$duid,$money){
		
		$res = $this->where("dt_id = {$id} and su_id = ".__SUID__)->update($data);
		if($res){
			if($data['dt_status'] == 3){ //退回分销会员费用
				//$duid
				model("distribution")->tuihuiMoeny($money,$duid);
			}
			return ['status'=>1,'msg'=>'审核分销人员提现信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'审核分销人员提现信息失败!'];
		}
	}	
	
	
	public function DelDuID($id){
		$resflag = $this->where("du_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销人员提现信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销人员提现信息失败!'];
		}
	}
	

	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销人员提现信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销人员提现信息失败!'];
		}
	}
	
	public function Del($id){
		$resflag = $this->where("dt_id = {$id} and su_id = ".__SUID__)->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分销人员提现信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分销人员提现信息失败!'];
		}
	}

	
}