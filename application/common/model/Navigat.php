<?php
namespace app\common\model;
use think\Db;

class Navigat extends Base{
	
	public $name = "navigat_show";
	
	public function GetAll(){
		$nav_info = $this->where("sns_id = 0")->order("ns_status desc,ns_sort asc")->select();
		foreach ($nav_info as $k=>$v) { //查询下级目录内容
			$nav_info[$k]['data'] = array();
			//$nav_info[$k]['number'] = 0;
			$nav_maps_2 = [
				'sns_id' => $v['ns_id'],
			];
			$nav_info_2 = $this->where($nav_maps_2)->order("ns_status desc,ns_sort asc")->select(); //查出二级导航信息
			if(!empty($nav_info_2)){
				//$nav_info[$k]['number'] = 1;
				$nav_info[$k]['data'] = $nav_info_2;
			}
        }
		return $nav_info;
	}
	
	public function GetOne($id,$type="id"){
		if($type == "id"){
			return $this->where("ns_id = {$id}")->limit(1)->find();
		}elseif($type == "snsid"){
			return $this->where("sns_id = {$id}")->limit(1)->select();
		}
	}

	public function Add($data){
		$validate = \think\Loader::validate('Navigat');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		if($data['ns_sort']==""){
			$data['ns_sort'] = 999;
		}
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加导航信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加导航信息失败!'];
		}
	}
	
	public function Edit($data,$id){
		if(empty($id)) return ['status'=>1002,'msg'=>"id值不能为空！"];
		$validate = \think\Loader::validate('Navigat');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1003,'msg'=>"数据不存在，请刷新重试！"];
			
		$res = $this->where("ns_id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改导航信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改导航信息失败!'];
		}

	}
	
	public function Del($id){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];
		if($res['sns_id']==0){
			$res_sj = $this->GetOne($res['ns_id'],"snsid");
			if(!empty($res_sj)){
				return ['status'=>1004,'msg'=> "此导航下存在下级分类，请先删除下级分类！"];
			}
		}
		
		$resflag = $this->where("ns_id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除导航信息成功！','id' => $id];
		}else{
			return ['status'=>1003,'msg'=>'删除导航信息失败!'];
		}
	}
	
}