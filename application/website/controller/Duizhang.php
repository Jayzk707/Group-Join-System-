<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;
use think\Db;

class Duizhang extends Base{
	
	public function Index(){
		$res = model("Duizhang")->GetAll($this->page);
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	

	public function Add(){
        $subinfo = model("Substation")->GetAll(1000);
        $count   = count($subinfo);
        for($i=0;$i<$count;$i++){
            $days = 1;
            $info = Db::query("SELECT * FROM `web_duizhang` where TO_DAYS(NOW()) - TO_DAYS(dz_date) = {$days} and su_id = ".$subinfo[$i]['su_id']);
            if(empty($info)){
                $bill_day = Db::query("SELECT bl_addtime,sum(bl_money) as zj FROM `web_bill` where TO_DAYS(NOW()) - TO_DAYS(bl_addtime) = {$days} and bl_status = 2 and su_id = ".$subinfo[$i]['su_id']);
                if(!empty($bill_day[0]['zj'])){
        			$DATA = [
        				'su_id'     => $subinfo[$i]['su_id'],
        				//'dz_date'   => date("Y-m-d",strtotime("-1 day")),
        				'dz_date'   => date("Y-m-d",strtotime($bill_day[0]['bl_addtime'])),
        				'dz_money'  => $bill_day[0]['zj'],
        				'dz_status' => 1,
        			];
        			$res = model("Duizhang")->Add($DATA);
                }
                
            }
        }
        
	}
	
	
	/*
	public function Add(){
        $info = Db::query("SELECT * FROM `web_chouyong` where TO_DAYS(NOW()) - TO_DAYS(cy_date) = 1");
        if(empty($info)){
                $bill_day = Db::query("SELECT sum(dkl_money) as zj FROM `web_dianka_log` where TO_DAYS(NOW()) - TO_DAYS(dkl_addtime) = 1");
                if(!empty($bill_day[0]['zj'])){
        			$DATA = [
        				'cy_date'   => date("Y-m-d",strtotime("-1 day")),
        				'cy_money'  => $bill_day[0]['zj'],
        			];
        			$res = model("chouyong")->Add($DATA);
                }
        
            }
	}
	*/
	

	public function Edit(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$DATA = [
				'dz_status' => 2,
			];
			
			$res = model("Duizhang")->Edit($DATA,$id);
			return _Json($res);
		}
	}


	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("Duizhang")->Del($id);
			return _Json($res);
		}
	}
	
	
}