<?php
namespace app\substation\controller;
use app\substation\controller\Base;
use think\Session;
use think\Request;

class Upload extends Base
{

	
    public function uploadface()
    {
		$JsonMessage['success'] = 'error';
		$UP_type = "bmp,jpg,png,gif,jpeg";
		$UP_type = explode(",",$UP_type); //上传类型\
		
		$UP_file = _PATH_."/upload/face/";  //上传目录
		$_UP_file = "/upload/face/";
		if(!is_dir($UP_file)){
			 mkdir ($UP_file,0777,true);
		}
		
		$tmp_arr = $_FILES['file'];
		$_type   = explode("/",$tmp_arr['type']);
		$_type   = @$_type[1];
		$tmp_name= time();
		$tmp_name= $tmp_name.".".$_type;
		if(!in_array($_type,$UP_type)){
			$JsonMessage['success'] = 'error';
			$JsonMessage['msg'] = 'error:文件类型错误，只支持bmp,jpg,png,gif！';
			echo json_encode($JsonMessage);
			exit;
		}
		if(move_uploaded_file($tmp_arr["tmp_name"],$UP_file.$tmp_name)){
			$JsonMessage['success'] = 'ok';
			$JsonMessage['fileurl'] = $_UP_file.$tmp_name;
			$JsonMessage['msg']     = '上传成功';
			echo json_encode($JsonMessage);
			exit;
		}else{
			$JsonMessage['success'] = 'error';
			$JsonMessage['msg'] = 'error:文件保存失败，请确认有写入权限！';
			echo json_encode($JsonMessage);
			exit;
		};
    }

}
