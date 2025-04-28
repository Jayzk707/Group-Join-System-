<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"template/website/substation/edit.html";i:1674397840;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
  <title><?php echo $subweb['oaname']; ?></title>
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
				<select name="su_g_id" id="su_g_id">
					<option value="0"> === 请选择群组 === </option>
					<?php if(is_array($Substationgroup) || $Substationgroup instanceof \think\Collection || $Substationgroup instanceof \think\Paginator): $i = 0; $__LIST__ = $Substationgroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo $vo['su_g_id']; ?>" <?php if($info['su_g_id']==$vo['su_g_id']): ?>selected<?php endif; ?>><?php echo $vo['su_g_title']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
          </div> 
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站备注</label>
            <div class="layui-input-block">
              <input name="su_content" type="text" class="layui-input" id="su_content"   placeholder="分站备注" value="<?php echo $info['su_content']; ?>">
            </div>
          </div>
        
        <div class="layui-form-item">
            <label class="layui-form-label">分站名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title"   placeholder="分站名称" value="<?php echo $info['su_title']; ?>">
            </div>
          </div>   
  
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站域名</label>
            <div class="layui-input-block">
              <input name="domain" type="text" class="layui-input" id="domain"   placeholder="分站域名" value="<?php echo $info['su_domain']; ?>">
            </div>
          </div> 
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站帐号</label>
            <div class="layui-input-block">
              <input name="username" type="text" class="layui-input" id="username"   placeholder="分站帐号" value="<?php echo $info['su_name']; ?>">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站密码</label>
            <div class="layui-input-block">
              <input name="password" type="text" class="layui-input" id="password"   placeholder="分站密码">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">到期时间</label>
            <div class="layui-input-block">
              <input name="enddate" type="date" class="layui-input" id="enddate"   placeholder="到期时间" value="<?php echo $info['su_endtime']; ?>">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">点卡数</label>
            <div class="layui-input-block">
              <input name="su_dk" type="number" class="layui-input" id="su_dk"   placeholder="点卡数" value="<?php echo $info['su_dk']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">抽拥比</label>
            <div class="layui-input-block">
              <input name="su_dk_cd" type="number" class="layui-input" id="su_dk_cd"   placeholder="抽拥比" value="<?php echo $info['su_dk_cd']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站权限</label>
            <div class="layui-input-block">
              <input type="radio" name="su_fzonoff" value="1" title="关闭" <?php if($info['su_fzonoff']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="su_fzonoff" value="2" title="开启" <?php if($info['su_fzonoff']==2): ?>checked=""<?php endif; ?>>
            </div>
          </div>
          

           <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" <?php if($info['su_status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="2" title="禁用" <?php if($info['su_status']==2): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="3" title="到期" <?php if($info['su_status']==3): ?>checked=""<?php endif; ?>>
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
	var su_g_id  = $("#su_g_id").val();
	var title    = $("#title").val();
	var domain   = $("#domain").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var enddate  = $("#enddate").val();
	var status   = $("input[name='status']:checked").val();
    var su_fzonoff   = $("input[name='su_fzonoff']:checked").val();
    var su_dk = $("#su_dk").val();
    var su_dk_cd = $("#su_dk_cd").val();
    var su_content = $("#su_content").val();


	if(su_g_id==0){
		show_error("请先选择群组!");
		return false;
	}
	
	if(title==""){
		show_error("分站名称不能为空!");
		return false;
	}
	
	if(domain == ""){
		show_error("分站域名不能为空");
		return false;
	}
	
	
	if(username == ""){
		show_error("分站帐号不能为空");
		return false;
	}

	
	$.ajax({
		type:"POST",
		url:"<?php echo url('substation/edit'); ?>",
		dataType:"json",
		data:{
			id:"<?php echo $info['su_id']; ?>",
			su_g_id:su_g_id,
			title:title,
			domain:domain,
			username:username,
			password:password,
			status:status,
			enddate:enddate,
			su_dk:su_dk,
			su_dk_cd:su_dk_cd,
			su_fzonoff:su_fzonoff,
			su_content:su_content,
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
