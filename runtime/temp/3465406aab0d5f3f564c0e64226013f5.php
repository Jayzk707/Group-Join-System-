<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:42:"template/substation/distribution/edit.html";i:1674402504;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
  <title><?php echo session("su_title"); ?> <?php echo $subweb['oaname']; ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/template/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/template/layuiadmin/style/admin.css" media="all">
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.1/css/all.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
        
        <div class="layui-form-item">
            <label class="layui-form-label">所属群组</label>
            <div class="layui-input-block">
				<select name="dg_id" id="dg_id">
					<option value="0"> === 请选择群组 === </option>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo $vo['dg_id']; ?>" <?php if($info['dg_id']==$vo['dg_id']): ?>selected<?php endif; ?>><?php echo $vo['dg_title']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
          </div>  
        
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input name="name" type="text" class="layui-input" id="name"   placeholder="用户名" value="<?php echo $info['du_name']; ?>">
            </div>
          </div>  
          

         <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
              <input name="pass" type="text" class="layui-input" id="pass"   placeholder="密码" value="<?php echo $info['du_pass']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
              <input name="smname" type="text" class="layui-input" id="smname"   placeholder="真实姓名"  value="<?php echo $info['du_smname']; ?>">
            </div>
          </div>
          

          <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-block">
              <input name="phone" type="text" class="layui-input" id="phone"   placeholder="账号"  value="<?php echo $info['du_phone']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">支付宝</label>
            <div class="layui-input-block">
              <input name="zfb" type="text" class="layui-input" id="zfb"   placeholder="支付宝"  value="<?php echo $info['du_zfb']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
              <input name="wx" type="text" class="layui-input" id="wx"   placeholder="微信号"  value="<?php echo $info['du_wx']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" <?php if($info['du_status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="2" title="禁用" <?php if($info['du_status']==2): ?>checked=""<?php endif; ?>>
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">模板权限</label>
            <div class="layui-input-block">
              <input type="radio" name="du_tmp" value="1" title="所有功能" <?php if($info['du_tmp']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="du_tmp" value="2" title="指定模板" <?php if($info['du_tmp']==2): ?>checked=""<?php endif; ?>>
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">模板</label>
            <div class="layui-input-block">
                <?php if(is_array($tmp) || $tmp instanceof \think\Collection || $tmp instanceof \think\Paginator): $i = 0; $__LIST__ = $tmp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="model" value="<?php echo $vo['wxgt_id']; ?>" title="<?php echo $vo['wxgt_title']; ?>" <?php if(in_array(($vo['wxgt_id']), is_array($info['du_tmpstr'])?$info['du_tmpstr']:explode(',',$info['du_tmpstr']))): ?>checked<?php endif; ?>>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
          </div>
          
	  
         <div class="layui-form-item layui-layout-admin">
              <div class="layui-footer" style="left: 0;">
                <div class="layui-btn sub">立即提交</div>
                <button type="reset" class="layui-btn layui-btn-primary ">重置</button>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<script src="/template/layuiadmin/layui/layui.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/template/showjs.js"></script>
<script>
  layui.config({
    base: '/template/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index','util','form', 'laydate','set','layer']);
</script> 

<script>
$(".sub").click(function(){
	//if(!$(".btn").hasClass("sub")){return false;}
	
	var dg_id   = $("#dg_id").val();
	var name    = $("#name").val();
	var pass    = $("#pass").val();
	var smname  = $("#smname").val();
	var phone   = $("#phone").val();
	var zfb     = $("#zfb").val();
	var wx      = $("#wx").val();
	var status  = $("input[name='status']:checked").val();
    var du_tmp  = $("input[name='du_tmp']:checked").val();
 
	var paylists  = "";
	$.each($('input:checkbox'),function(){
		if(this.checked){
			paylists += $(this).val()+",";
		}
	});
 
 	if(dg_id==0){
		show_error("请选择分销群组!");
		return false;
	}
 
	if(name==""){
		show_error("用户名不能为空!");
		return false;
	}
	
	if(pass==""){
		show_error("密码不能为空!");
		return false;
	}

	$.ajax({
		type:"POST",
		url:"<?php echo url('distribution/edit'); ?>",
		dataType:"json",
		data:{
			id:<?php echo $info['du_id']; ?>,
			dg_id:dg_id,
			name:name,
			pass:pass,
			smname:smname,
			phone:phone,
			zfb:zfb,
			wx:wx,
			status:status,
			du_tmp:du_tmp,
			paylists:paylists,
		},
		success:function(res){
			if(res.status == 1){
				window.parent.layer.closeAll();//关闭弹窗
				window.parent.location.reload();
				//show_toast_callurl(res.data,"<?php echo url('device/index'); ?>","success");
			}else{
				show_error(res.msg);
			}
		},
		error:function(jqXHR){
			console.log("Error: "+jqXHR.status);
		},
	});
	
});
</script>
</body>
</html>
