<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Duizhang extends Base{
	
    protected $name = 'duizhang';
    
    public function GetFzAll($page){
        return $this->alias("dk")->join("__SUBSTATION__ s","dk.su_id = s.su_id")->  //查询分站支付接口信息
				where("dk.su_id = ".__SUID__)->order("dz_date desc")->paginate($page);
    }
    
    
    public function GetAll($page){
        return $this->alias("dk")->join("__SUBSTATION__ s","dk.su_id = s.su_id")->  //查询分站支付接口信息
				where("1 = 1")->order("dz_date desc")->paginate($page);
    }
  
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加点卡信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加点卡信息失败!'];
		}
	}
	
	
	public function Edit($data,$id){
		$res = $this->where("dz_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'对帐信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'对帐信息失败!'];
		}
	}
	

	public function Del($id){
		$resflag = $this->where("dz_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除对帐信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除对帐信息失败!'];
		}
	}
	
}