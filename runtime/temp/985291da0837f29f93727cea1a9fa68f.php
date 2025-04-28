<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"template/website/users/password.html";i:1674397844;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_header.html";i:1674397684;s:59:"/www/wwwroot/fufei.wtyz.cn/template/website/common_top.html";i:1674397684;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_footer.html";i:1674397684;}*/ ?>
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
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-header">修改密码</div>
          <div class="layui-card-body">
            
            <div class="layui-form" lay-filter="">
              <div class="layui-form-item">
                <label class="layui-form-label">当前密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="oldpassword" id="oldpassword" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="password" id="password"  class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">确认新密码</label>
                <div class="layui-input-inline">
                  <input type="password" name="endpassword" id="endpassword"  class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn sub" lay-filter="setmypass">确认修改</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
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
		var oldpassword = $("#oldpassword").val();
		var password    = $("#password").val();
		var endpassword = $("#endpassword").val();

		if(oldpassword == ""){
			show_error("旧密码不能为空!");
			return false
		}
		
		if(password == ""){
			show_error("新密码不能为空!");
			return false
		}
		
		if(endpassword == ""){
		show_error("确认密码不能为空!");
			return false
		}
		
		if(oldpassword == password){
			show_error("新密码不能和旧密码一致!");
			return false
		}

		if(password != endpassword){
			show_error("确认密码须与新密码一致!");
			return false
		}

		
		$.ajax({
			type:"POST",
			url:"<?php echo url('users/password'); ?>",
			dataType:"json",
			data:{
				oldpassword:oldpassword,
				password:password,
				endpassword:endpassword,
			},
			success:function(res){
				if(res.status == 1){
					show_toast_callurl(res.msg,"<?php echo url('users/password'); ?>");
				}else{
					show_error(res.msg);
				}
			},
			error:function(jqXHR){
				//console.log("Error: "+jqXHR.status);
			},
		});
		
	});
	

  </script>
</body>
</html>