<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:48:"template/substation/distributiontixian/edit.html";i:1674402504;s:66:"/www/wwwroot/fjwl.seecss.cn/template/substation/common_header.html";i:1674397683;s:63:"/www/wwwroot/fjwl.seecss.cn/template/substation/common_top.html";i:1674397683;s:66:"/www/wwwroot/fjwl.seecss.cn/template/substation/common_footer.html";i:1674397683;}*/ ?>
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
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
              <input name="name" type="text" disabled class="layui-input" id="name" value="<?php echo $info['du_name']; ?>（<?php echo $info['du_smname']; ?>）" readonly="readonly"   placeholder="用户名">
            </div>
          </div>  
          

          <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-block">
              <input name="phone" type="text" disabled class="layui-input" id="phone"  value="<?php echo $info['du_phone']; ?>" readonly="readonly"   placeholder="账号">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">支付宝</label>
            <div class="layui-input-block">
              <input name="zfb" type="text" disabled class="layui-input" id="zfb"  value="<?php echo $info['du_zfb']; ?>" readonly="readonly"   placeholder="支付宝">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
              <input name="wx" type="text" disabled class="layui-input" id="wx"  value="<?php echo $info['du_wx']; ?>" readonly="readonly"   placeholder="微信号">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">提现金额</label>
            <div class="layui-input-block">
              <input name="wx" type="text" disabled class="layui-input" id="wx"  value="<?php echo $info['dt_money']; ?>" readonly="readonly"   placeholder="微信号">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">二维码</label>
            <div class="layui-input-block">
              <img src="<?php echo $info['dt_img']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">审核备注</label>
            <div class="layui-input-block">
              <input name="content" type="text" class="layui-input" id="content"  value="<?php echo $info['dt_content']; ?>"   placeholder="审核备注">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="审核中" <?php if($info['dt_status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="3" title="拒绝" <?php if($info['dt_status']==3): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="4" title="已支付" <?php if($info['dt_status']==4): ?>checked=""<?php endif; ?>>
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
	
	var content   = $("#content").val();
	var status  = $("input[name='status']:checked").val();
 
	$.ajax({
		type:"POST",
		url:"<?php echo url('distributiontixian/edit'); ?>",
		dataType:"json",
		data:{
			id:<?php echo $info['dt_id']; ?>,
			duid:<?php echo $info['du_id']; ?>,
			money:<?php echo $info['dt_money']; ?>,
			content:content,
			status:status,
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
