<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;

class Center extends Base{
	
	public function Index(){
		return view();
	}
	
	
    public function to_sex_day(){
        $today = date("Y-m-d");
        $arr = array();
        $old_time = strtotime('-6 day',strtotime($today));
        for($i = 0;$i <= 6; ++$i){
            $t = strtotime("+$i day",$old_time);
            $arr[]=date('Y-m-d',$t);
        }
        return $arr;
    }
	
	public function home(){
	    

	    
	    //总销售额
	    $z_money_count = Db("bill")->where("bl_status = 2 and du_id = ".session("du_id"))->sum("bl_money");
	    //总订单量
	    $z_bill_count = Db("bill")->where("du_id = ".session("du_id")." and bl_status = 2")->count("bl_id");

	    //当天销售额
	    $d_money_count = Db("bill")->where("bl_status = 2 and du_id = ".session("du_id"))->whereTime('bl_addtime', 'today')->sum("bl_money");
	    //当天订单量
	    $d_bill_count = Db("bill")->where("du_id = ".session("du_id")." and bl_status = 2")->whereTime('bl_addtime', 'today')->count("bl_id");

	    $this->assign("d_money_count",$d_money_count);
	    $this->assign("d_bill_count",$d_bill_count);

	    $this->assign("z_money_count",$z_money_count);
	    $this->assign("z_bill_count",$z_bill_count);
	    
	    
	    //图表使用
	    $date_array = $this->to_sex_day();
	    $date_count = count($date_array);
	    $timg = array();
	    for($i=0;$i<$date_count;$i++){
	        $timg[$i]['date'] = $date_array[$i];
	        $dada = date("Y-m-d",strtotime("+1 day",strtotime($timg[$i]['date'])));
	        $money = Db("bill")->where("bl_status = 2 and du_id = ".session("du_id"))->whereTime('bl_addtime','between',[$timg[$i]['date'],$dada])->sum("bl_money");
	        $timg[$i]['money'] = $money;
	    }
	    $this->assign("timg",$timg);
	    //图表使用
	    
	    
	    
		return view();
	}
	

}