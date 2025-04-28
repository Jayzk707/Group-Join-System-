<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Dianka extends Base{
	
    protected $name = 'dianka';

    public function GetFzAll($page){
        return $this->alias("dk")->where("su_id = ".__SUID__)->order("dk.dk_id desc")->paginate($page);
    }


    public function GetAll($page){
        return $this->alias("dk")->join("__SUBSTATION__ s","dk.su_id = s.su_id")->  //查询分站支付接口信息
				where("1 = 1")->order("dk.dk_id desc")->paginate($page);
    }
    

	public function Add($data,$name){
		$uInfo = model("Substation")->GetOneUser($name);
		if(empty($uInfo)){
			return ['status'=>1001,'msg'=>'分站不存在，请输入正确的分站帐号!'];
		}
		
		$data['su_id'] = $uInfo['su_id'];
		$res = $this->insertGetId($data);
		if($res){
		    $su_dk = $uInfo['su_dk'] + $data['dk_money'];
		    $DATAs = [
				'su_dk'  => $su_dk,
			];
		    model("Substation")->EditS($DATAs,$data['su_id']);
			return ['status'=>1,'msg'=>'添加点卡信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加点卡信息失败!'];
		}
	}
	
	
	public function AddS($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加点卡信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加点卡信息失败!'];
		}
	}

	public function Del($id){
		$resflag = $this->where("dk_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除点卡信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除点卡信息失败!'];
		}
	}
	
}