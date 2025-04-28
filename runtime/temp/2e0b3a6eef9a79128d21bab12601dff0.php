<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"template/substation/paylist/edit.html";i:1674397826;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">支付名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" disabled class="layui-input" id="title" value="<?php echo $info['pl_title']; ?>" readonly="readonly"   placeholder="支付名称">
            </div>
          </div>   
          
 
       
          <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $index = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($index % 2 );++$index;?>
          <div class="layui-form-item">
            <label class="layui-form-label"><?php echo $vo; ?></label>
            <div class="layui-input-block">
            	<textarea name="su_pl_content_<?php echo $index; ?>" id="su_pl_content_<?php echo $index; ?>" class="layui-input"   placeholder="输入支付<?php echo $vo; ?>开启多组帐号轮换支付插件请用-分开" rows=""><?php echo $SubPaylist['su_pl_content_'.$index]; ?></textarea>
            </div>
          </div> 
          <?php endforeach; endif; else: echo "" ;endif; ?>

          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" <?php if($SubPaylist['su_pl_status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="2" title="禁用" <?php if($SubPaylist['su_pl_status']==2): ?>checked=""<?php endif; ?>>
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
	<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $index = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($index % 2 );++$index;?>
var su_pl_content_<?php echo $index; ?> = $("#su_pl_content_<?php echo $index; ?>").val();
	<?php endforeach; endif; else: echo "" ;endif; ?>
var status  = $("input[name='status']:checked").val();
	if(typeof(status) == "undefined"){
		show_error("状态不能为空，请先选择状态!");
		return false;
	}
	
	$.ajax({
		type:"POST",
		url:"<?php echo url('paylist/edit'); ?>",
		dataType:"json",
		data:{
			id:"<?php echo $info['pl_id']; ?>",
			status:status,
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $index = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($index % 2 );++$index;?>
su_pl_content_<?php echo $index; ?>:su_pl_content_<?php echo $index; ?>,
			<?php endforeach; endif; else: echo "" ;endif; ?>
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
