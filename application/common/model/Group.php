<?php
namespace app\common\model;
use think\Db;

class Group extends Base{
	
    protected $name = 'auth_group';

	public function GetAll($page){
		return $this->field("*,(select count(uid) FROM {$this->Prefix}auth_group_access ga where ga.group_id = g.id) as count")->alias("g")->where("1=1")->paginate($page);
	}
	
	public function ShowAll($where = "1=1"){
		return $this->where($where)->select();
	}

	public function GetOne($id,$type="id"){
		if($type=="id"){
			return $this->where("id = {$id}")->limit(1)->find();
		}else{
			return $this->where("title = '{$id}'")->limit(1)->find();
		}
	}

	public function Add($data){
		$validate = \think\Loader::validate('Group');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		$res = $this->GetOne($data['title'],"group");
		if(!empty($res)) return ['status'=>1003,'msg'=>'此群组名称已经存在，请重新输入!'];
			
		$res = $this->insertGetId($data);
		if($res){
			return ['status'=>1,'msg'=>'添加群组信息成功！','id' => $res];
		}else{
			return ['status'=>1002,'msg'=>'添加群组信息失败!'];
		}
	}
	
	public function Edit($data,$id){
		if(empty($id)) return ['status'=>1002,'msg'=>"id值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1003,'msg'=>"数据不存在，请刷新重试！"];
		
		$validate = \think\Loader::validate('Group');
        if(!$validate->check($data)) return ['status'=>1001,'msg'=>$validate->getError()];
		
		$res = $this->GetOne($data['title'],"group");
		
		if(!empty($res)){
			if($res['id'] != $id) return ['status'=>1003,'msg'=>'此群组名称已经存在，请重新输入!'];
		}
		
		$res = $this->where("id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'修改群组信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'修改群组信息失败!'];
		}
	}
	
	
	public function Auth($data,$id){
		if(empty($id)) return ['status'=>1002,'msg'=>"id值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1003,'msg'=>"数据不存在，请刷新重试！"];
		
		$res = $this->where("id = {$id}")->update($data);
		if($res){
			return ['status'=>1,'msg'=>'设置群组权限信息成功！','id' => $res];
		}else{
			return ['status'=>1005,'msg'=>'设置群组权限信息失败!'];
		}
	}
	
	
	public function Del($id){
		if(empty($id)) return ['status'=>1001,'msg'=> "ID值不能为空！"];
		$res = $this->GetOne($id);
		if(empty($res)) return ['status'=>1002,'msg'=> "数据不存在！"];
		$res = Db("auth_group_access")->limit(1)->where("group_id = {$id}")->find();
		if(!empty($res)) return ['status'=>1003,'msg'=> "此群组下存在授权用户，无法删除！"];
		$resflag = $this->where("id = {$id}")->delete();
		if($resflag){
			return ['status'=>1,'msg'=>'删除群组信息成功！','id' => $id];
		}else{
			return ['status'=>1004,'msg'=>'删除群组信息失败!'];
		}
	}


	
}