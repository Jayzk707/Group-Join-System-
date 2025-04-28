<?php
namespace app\common\model;
use think\Db;
use think\Request;

class Dwxgroup extends Base{
	
    protected $name = 'qwxgroup';

    public function GetFzAll($page){
        return $this->alias("b")->
				join("__DISTRIBUTION__ d","b.du_id = d.du_id")-> //查询出分销人员信息
				where("b.su_id = ".__SUID__)->order("b.qwxg_id desc")->paginate($page);
    }



}