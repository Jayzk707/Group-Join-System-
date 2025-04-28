<?php
namespace app\common\model;
use think\Db;

class Userslogs extends Base{
	
    protected $name = 'users_logs';


	public function WriteLogs($uid,$typeid,$ip){
		$DbInfo = [
			'u_id'       => $uid,
			'ul_addtime' => date("Y-m-d H:i:s"),
			'ul_ip'      => $ip,
			'ul_type'    => $typeid,
		];
		return $this->insert($DbInfo);
	}
	
	public function GetAll($page){
		return $this->where("u_id = ".__UID__)->order("ul_id desc")->paginate($page);
	}
	
    public function getUlTypeAttr($value)
    {
        $ul_type = [1=>'登录',2=>'退出',3=>'修改密码'];
        return $ul_type[$value];
    }	

	
}