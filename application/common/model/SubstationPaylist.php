<?php
namespace app\common\model;
use think\Db;
use think\Request;

class SubstationPaylist extends Base{
	
    protected $name = 'Substation_paylist';
    
    public function GetFxShow(){
        return $this->alias("spl")
            ->join("__PAYLIST__ pl","pl.pl_id = spl.pl_id")
            ->where("spl.su_id = ".__DSUID__." and spl.su_pl_status = 1 and pl.pl_status = 1")
            ->select();
    }
	
	public function Getone($id)
	{
		return $this->where("su_id = ".__SUID__." and pl_id = ".$id)->find();
	}
	
	
	public function Edit($data){
		$subpaylist = $this->Getone($data['pl_id']);
		if(empty($subpaylist)){
			$res = $this->insertGetId($data);
		}else{
			$res = $this->where("su_id = ".__SUID__." and pl_id = ".$data['pl_id'])->update($data);
		}
		if($res){
			return ['status'=>1,'msg'=>'配置支付信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'配置支付信息失败!'];
		}
	}
	
	public function Del($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除分站支付配置信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除分站支付配置信息失败!'];
		}
	}	
	
}