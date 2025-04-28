<?php
namespace app\fenxiao\controller;
use app\fenxiao\controller\Base;
use think\Session;
use think\Request;
class Wxgrouptmp extends Base{

	
	public function index()
	{
	    $d_info = Db("distribution")->where("du_id = ".session("du_id"))->find();
	    if($d_info['du_tmp']==1){
		    $res = model("wxgrouptmp")->GetAllSuID($this->page);
	    }else{
	        $res = model("wxgrouptmp")->GetAllSuIDTmp($this->page,$d_info['du_tmpstr']);
	    }
		$page = $res->render();
		$this->assign('page', $page);
		$this->assign("list",$res);	
		return view();
	}
	
	
	public function edit()
	{
		$id = trim(input("id"));
		$res = model("wxgrouptmp")->GetOne($id);
		if(Request::instance()->isAjax()){
			$dinfo = model("distribution")->GetOneDuid();
			$DATA = [
				'du_id'           => __DUID__,
				'su_id'           => $dinfo['su_id'],
				'wxg_money'       => $res['wxgt_money'],
				'wxg_img'         => $res['wxgt_img'],
				'wxg_title'       => $res['wxgt_title'],
				'wxg_subtitle'    => $res['wxgt_subtitle'],
				'wxg_status'      => $res['wxgt_status'],
				'wxg_addtime'     => date("Y-m-d H:i:s"),
				'wxg_qjj_title'   => $res['wxgt_qjj_title'],
				'wxg_qjj_content' => $res['wxgt_qjj_content'],
				'wxg_buttitle'    => $res['wxgt_buttitle'],
				'wxg_redcount'    => $res['wxgt_redcount'],
				'wxg_dzcount'     => $res['wxgt_dzcount'],
				'wxg_xxcount'     => $res['wxgt_xxcount'],
				'wxg_kuai_title'     => $res['wxgt_kuai_title'],
				'wxg_kuai_content'   => $res['wxgt_kuai_content'],
				'wxg_qunyou_content' => $res['wxgt_qunyou_content'],
				'wxg_adurl' => $res['wxgt_adurl'],
				'wxg_headfile' => $res['wxgt_headfile'],
				'wxg_kefu' => $res['wxgt_kefu'],
				'wxg_kuai_title1' => $res['wxgt_kuai_title1'],
				'wxg_kuai_imgs1' => $res['wxgt_kuai_imgs1'],
			];

			$res = model("wxgroup")->Add($DATA);
			return _Json($res);
		}
		
		$this->assign("info",$res);	
		return view();
	}
	

}