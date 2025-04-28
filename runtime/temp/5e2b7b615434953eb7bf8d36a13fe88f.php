<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"template/website/substation/add.html";i:1674397838;s:62:"/home/www/wwwroot/demotest/template/website/common_header.html";i:1674397684;s:59:"/home/www/wwwroot/demotest/template/website/common_top.html";i:1674397684;s:62:"/home/www/wwwroot/demotest/template/website/common_footer.html";i:1674397684;}*/ ?>
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
						<option value="<?php echo $vo['su_g_id']; ?>"><?php echo $vo['su_g_title']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
          </div> 
          
          
          
          
           <div class="layui-form-item">
            <label class="layui-form-label">分站备注</label>
            <div class="layui-input-block">
              <input name="su_content" type="text" class="layui-input" id="su_content"   placeholder="分站备注" >
            </div>
          </div>
        
        <div class="layui-form-item">
            <label class="layui-form-label">分站名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title"   placeholder="分站名称">
            </div>
          </div>   
  
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站域名</label>
            <div class="layui-input-block">
              <input name="domain" type="text" class="layui-input" id="domain"   placeholder="分站域名">
            </div>
          </div> 
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站帐号</label>
            <div class="layui-input-block">
              <input name="username" type="text" class="layui-input" id="username"   placeholder="分站帐号">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站密码</label>
            <div class="layui-input-block">
              <input name="password" type="text" class="layui-input" id="password"   placeholder="分站密码">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">点卡数</label>
            <div class="layui-input-block">
              <input name="su_dk" type="number" class="layui-input" id="su_dk"   placeholder="点卡数" value="0">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">抽拥比</label>
            <div class="layui-input-block">
              <input name="su_dk_cd" type="number" class="layui-input" id="su_dk_cd"   placeholder="抽拥比" value="20">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站权限</label>
            <div class="layui-input-block">
              <input type="radio" name="su_fzonoff" value="1" title="关闭" checked="">
              <input type="radio" name="su_fzonoff" value="2" title="开启">
            </div>
          </div>
          
          
           <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" checked="">
              <input type="radio" name="status" value="2" title="禁用">
              <input type="radio" name="status" value="3" title="到期">
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
	
	if(password == ""){
		show_error("分站密码不能为空");
		return false;
	}
	
	
	$.ajax({
		type:"POST",
		url:"<?php echo url('substation/add'); ?>",
		dataType:"json",
		data:{
			su_g_id:su_g_id,
			title:title,
			domain:domain,
			username:username,
			password:password,
			status:status,
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
