<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;
use think\Db;

class Chouyong extends Base{
	
	public function Index(){
		$res = model("Chouyong")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function Add(){
        $info = Db::query("SELECT * FROM `web_chouyong` where TO_DAYS(NOW()) - TO_DAYS(cy_date) = 1");
        if(empty($info)){
                $bill_day = Db::query("SELECT sum(dkl_money) as zj FROM `web_dianka_log` where TO_DAYS(NOW()) - TO_DAYS(dkl_addtime) = 1 and dkl_su_id = 0");
                if(!empty($bill_day[0]['zj'])){
        			$DATA = [
        				'cy_date'   => date("Y-m-d",strtotime("-1 day")),
        				'cy_money'  => $bill_day[0]['zj'],
        			];
        			$res = model("chouyong")->Add($DATA);
                }
        
            }
	}

	
}