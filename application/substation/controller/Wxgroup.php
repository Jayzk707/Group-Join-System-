<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;
class Wxgroup extends Base{

	
	public function index()
	{
	    $s = urldecode(input("s"));
	    $this->assign('s', $s);
	    
	    if(empty($s)){
	    	$res = model("wxgroup")->GetSuAll($this->page);
	    }else{
	        $res = model("wxgroup")->GetSuAllS($this->page,$s);
	    }
		$list = $res->all();
		foreach($list as $k=>$v){
			$list[$k]['count_z_money'] = 0;
			$list[$k]['count_z_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->sum("bl_money");
			
			$list[$k]['count_p_money'] = 0;
			$list[$k]['count_p_money'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->sum("bl_scalemoney");
			
			$list[$k]['count_ddx'] = 0;
			$list[$k]['count_ddx'] = Db("bill")->where("du_id = {$list[$k]['du_id']} and wxg_id = {$list[$k]['wxg_id']} and bl_status = 2")->count("bl_id");
		}
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function Del(){
		if(Request::instance()->isAjax()){
			$id = input('id');
			$res = model("wxgroup")->Del($id);
			if($res['status'] == 1){
				model("bill")->DelWxgID($id);
			}
			return _Json($res);
		}
	}
	

}