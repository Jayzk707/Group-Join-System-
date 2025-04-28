<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Substationtixian extends Base{
	
    protected $name = 'Substation_tixian';
	
	//展示当前分销所有提现
	public function GetSuIdAll($page){
		return $this->where("su_id = ".__SUID__)->order("st_id desc")->paginate($page);
	}
	
	//展示当前分站所有提现
	public function GetAll($page){
		return $this->alias("d")->join("__SUBSTATION__ du","d.su_id = du.su_id")->order("d.st_id desc")->where("1=1")->paginate($page);
	}
	
	public function GetOne($id){
		return $this->alias("d")->join("__SUBSTATION__ du","d.su_id = du.su_id")->where("d.st_id = {$id}")->limit(1)->find();
	}
	
	
	
	
	public function Add($data){
	    
		if($data['su_money'] <= 0){
			return ['status'=>1002,'msg'=>'提现金额不能小于等于0!'];
		}
		
		$res1 = model("Substation")->GetOne(__SUID__);
		if($res1['su_fz_money']<$data['su_money']){
			return ['status'=>1002,'msg'=>'提现金额不能大于可提现金额!'];
		}
		
		$res = $this->insertGetId($data);
		if($res){
			$du_money = $res1['su_fz_money'] - $data['su_money'];
			model("Substation")->shenqiangtuihuiMoeny($du_money);
			return ['status'=>1,'msg'=>'添加支付信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加支付信息失败!'];
		}
	}
	
	
	public function edit($data,$id,$duid,$money){
		$res = $this->where("st_id = {$id}")->update($data);
		if($res){
			if($data['st_status'] == 3){ //退回分销会员费用
				//$duid
				model("Substation")->tuihuiMoeny($money,$duid);
			}
			return ['status'=>1,'msg'=>'审核提现信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'审核提现信息失败!'];
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