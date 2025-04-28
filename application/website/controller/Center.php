<?php
namespace app\website\controller;
use app\website\controller\Base;
use think\Session;
use think\Request;
use think\Db;

class Center extends Base{
	
	public function Index(){
		import('Navigat.Navigat');
		$Navigat = new \Navigat;
		$Nav = $Navigat->show_navigat(__UID__);
		$this->assign("__NAV__",$Nav);
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
	    $z_money_count = Db("bill")->where("bl_status = 2")->sum("bl_money");
	    //总订单量
	    $z_bill_count = Db("bill")->where("bl_status = 2")->count("bl_id");
	    //总用户数
	    $z_user_count = Db("distribution")->where("1=1")->count("du_id");
	    
	    //当天销售额
	    $d_money_count = Db("bill")->where("bl_status = 2")->whereTime('bl_addtime', 'today')->sum("bl_money");
	    //当天订单量
	    $d_bill_count = Db("bill")->where("bl_status = 2")->whereTime('bl_addtime', 'today')->count("bl_id");
	    //当天新用户数
	    $d_user_count = Db("distribution")->where("1=1")->whereTime("du_addtime",'today')->count("du_id");


	    //图表使用
	    $date_array = $this->to_sex_day();
	    $date_count = count($date_array);
	    $timg = array();
	    for($i=0;$i<$date_count;$i++){
	        $timg[$i]['date'] = $date_array[$i];
	        $dada = date("Y-m-d",strtotime("+1 day",strtotime($timg[$i]['date'])));
	        $money = Db("bill")->where("bl_status = 2")->whereTime('bl_addtime','between',[$timg[$i]['date'],$dada])->sum("bl_money");
	        $usercount = Db("bill")->where("bl_status = 2")->whereTime('bl_addtime','between',[$timg[$i]['date'],$dada])->count("bl_id");
	        $timg[$i]['money'] = $money;
	        $timg[$i]['usercount'] = $usercount;
	    }
	    $this->assign("timg",$timg);
	    //图表使用

        //排行榜group by
        $bill_day = Db::query("SELECT s.*,sum(b.bl_money) as zj FROM `web_bill` as b INNER JOIN `web_substation` as s on s.su_id = b.su_id where to_days(b.bl_addtime) = to_days(now()) and b.bl_status = 2 group by b.su_id order by zj desc limit 10");
        $this->assign("bill_day",$bill_day);
        
        $bill_week = Db::query("SELECT s.*,sum(b.bl_money) as zj FROM `web_bill` as b INNER JOIN `web_substation` as s on s.su_id = b.su_id where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(b.bl_addtime) and b.bl_status = 2 group by b.su_id order by zj desc limit 10");
        $this->assign("bill_week",$bill_week);
        
        $bill_moon = Db::query("SELECT s.*,sum(b.bl_money) as zj FROM `web_bill` as b INNER JOIN `web_substation` as s on s.su_id = b.su_id where DATE_FORMAT(b.bl_addtime,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m') and b.bl_status = 2 group by b.su_id order by zj desc limit 10");
        $this->assign("bill_moon",$bill_moon);
        
        
        $bill_z = Db::query("SELECT s.*,sum(b.bl_money) as zj FROM `web_bill` as b INNER JOIN `web_substation` as s on s.su_id = b.su_id where b.bl_status = 2 group by b.su_id order by zj desc limit 10");
        $this->assign("bill_z",$bill_z);
        
        //排行榜 //

	    $this->assign("d_money_count",$d_money_count);
	    $this->assign("d_bill_count",$d_bill_count);
	    $this->assign("d_user_count",$d_user_count);
	    $this->assign("z_money_count",$z_money_count);
	    $this->assign("z_bill_count",$z_bill_count);
	    $this->assign("z_user_count",$z_user_count);
		return view();
	}
	

}