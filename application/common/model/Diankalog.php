<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Diankalog extends Base{
	
    protected $name = 'dianka_log';

    public function GetFzAll($page){
        return $this->alias("dkl")->where("dkl.su_id = ".__SUID__)->join("__BILL__ b","b.bl_id = dkl.bl_id")->order("dkl.dkl_id desc")->paginate($page);
    }

   public function GetFzCYAll($page){
        return $this->alias("dkl")->where("dkl.dkl_su_id = ".__SUID__)->join("__BILL__ b","b.bl_id = dkl.bl_id")->order("dkl.dkl_id desc")->paginate($page);
    }


}