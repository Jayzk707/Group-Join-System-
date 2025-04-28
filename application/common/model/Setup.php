<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Setup extends Base{

    protected $name = 'Setup';
    
    public function GetAll(){
        return $this->where("1 = 1")->limit(1)->find();
    }
    
	public function Edit($data){
		$res = $this->where("1 = 1")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改信息失败!'];
		}
	}
	

	
}