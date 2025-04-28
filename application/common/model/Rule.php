<?php
namespace app\common\model;
use think\Db;

class Rule extends Base{
	
    protected $name = 'auth_rule';

	public function GetAll(){
		//return $this->where("1=1")->paginate($page);
		$info = $this->where("said = 0")->order("sort asc")->select(); //查出一级
		if(!empty($info)){
			foreach($info as $k=>$v){
				$v['data'] = $this->where("said = ".$v['id'])->order("sort asc")->select();
			}
		}
		return $info;
	}
	
	public function GetStatusAll($status){
		return $this->where("status = {$status}")->select();
	}

	public function GetOne($id,$type="id"){
		if($type=="id"){
			return $this->where("id = {$id}")->limit(1)->find();
		}else{
			return $this->where("name = '{$id}' or title = '{$id}'")->limit(1)->find();
		}
	}

	public function Add($data){
		$validate = \think\Loader::validate('Rule');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		$res = $this->GetOne($data['title'],"rule");
		if(!empty($res)) return ['status'=>1004,'msg'=>'此权限名称已经存在，请重新输入!'];
		
		$res = $this->GetOne($data['name'],"rule");
		if(!empty($res)) return ['status'=>1003,'msg'=>'此权限路径已经存在，请重新输入!'];
		
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加权限模块信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加权限模块信息失败!'];
		}
	}
	
	public function Addgroup($data){
		$res = $this->GetOne($data['title'],"rule");
		if(!empty($res)) return ['status'=>1004,'msg'=>'此权限分类已经存在，请重新输入!'];
		
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加权限分类信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加权分类块信息失败!'];
		}
	}
	
	public function Edit($data,$id){
		if(empty($id)) return ['status'=>1002,'msg'=>"id值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1003,'msg'=>"数据不存在，请刷新重试！"];

		$res = $this->where("id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改权限模块信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改权限模块信息失败!'];
		}
	}
	
	
	public function Del($id){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];
		$resflag = $this->where("id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除权限模块信息成功！','id' => $id];
		}else{
			return ['status'=>1003,'msg'=>'删除权限模块信息失败!'];
		}
	}
	
	public function Delgroup($id){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];
		
		$count = $this->where("said = {$id}")->count();
		if($count > 0 ) return ['status'=>1004,'msg'=> "此权限分类存在数据无法删除！"];
		
		$resflag = $this->where("id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除权限分类信息成功！','id' => $id];
		}else{
			return ['status'=>1003,'msg'=>'删除权限分类信息失败!'];
		}
	}
	

	
}