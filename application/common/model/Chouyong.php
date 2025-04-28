<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Chouyong extends Base{
	
    protected $name = 'chouyong';

    
    public function GetAll($page){
        return $this->where("1 = 1")->order("cy_date desc")->paginate($page);
    }
  
	public function Add($data){
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加点卡信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加点卡信息失败!'];
		}
	}
	
}