<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Bill extends Base{
	
    protected $name = 'bill';

	public function GetDuAll($page){
		return $this->
				alias("b")->
				join("__WXGROUP__ wg","b.wxg_id = wg.wxg_id")-> //查询微信营销群组
				join("__SUBSTATION_PAYLIST__ sp","b.su_pl_id = sp.su_pl_id")->  //查询分站支付接口信息
				join("__PAYLIST__ p","sp.pl_id = p.pl_id")-> //查询出支付接口名称
				where("b.du_id = ".__DUID__)->
				order("b.bl_id desc")->
				paginate($page);
	}
	
	
	public function GetSuAll($page){
		return $this->
				alias("b")->
				join("__DISTRIBUTION__ d","b.du_id = d.du_id")-> //查询出分销人员信息
				join("__WXGROUP__ wg","b.wxg_id = wg.wxg_id")-> //查询微信营销群组
				join("__SUBSTATION_PAYLIST__ sp","b.su_pl_id = sp.su_pl_id")->  //查询分站支付接口信息
				join("__PAYLIST__ p","sp.pl_id = p.pl_id")-> //查询出支付接口名称
				where("b.su_id = ".__SUID__)->
				order("b.bl_id desc")->
				paginate($page);
	}	
	
	
	public function Del($id){
		$resflag = $this->where("bl_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除帐单信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除帐单信息失败!'];
		}
	}
	
	public function DelDuID($id){
		$resflag = $this->where("du_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除帐单信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除帐单信息失败!'];
		}
	}
	
	public function DelSuID($id){
		$resflag = $this->where("su_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除帐单信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除帐单信息失败!'];
		}
	}
	
	
	public function DelWxgID($id){
		$resflag = $this->where("wxg_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除帐单信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除帐单信息失败!'];
		}
	}
	
}