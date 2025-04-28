<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:41:"template/website/substationgroup/add.html";i:1674397840;s:62:"/home/www/wwwroot/demotest/template/website/common_header.html";i:1674397684;s:59:"/home/www/wwwroot/demotest/template/website/common_top.html";i:1674397684;s:62:"/home/www/wwwroot/demotest/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">群组名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title"   placeholder="分站群组名称">
            </div>
          </div>   
  
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站时长</label>
            <div class="layui-input-block">
              <input name="daycount" type="number" class="layui-input" id="daycount"   placeholder="分站时长（0为99年，按月计算）" value="0">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
              <input name="content" type="text" class="layui-input" id="content"   placeholder="备注">
            </div>
          </div> 
          
          
           <div class="layui-form-item">
            <label class="layui-form-label">支付方式</label>
            <div class="layui-input-block">
				<?php if(is_array($Paylist) || $Paylist instanceof \think\Collection || $Paylist instanceof \think\Paginator): $i = 0; $__LIST__ = $Paylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<input type="checkbox" name="paylist" value="<?php echo $vo['pl_id']; ?>" title="<?php echo $vo['pl_title']; ?>" >
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
	var title    = $("#title").val();
	var daycount = $("#daycount").val();
	var content  = $("#content").val();
	var paylist  = document.getElementsByName('paylist');
	var paylist_list='';
	for(i=0;i<paylist.length;i++){
		if(paylist[i].checked) paylist_list+=paylist[i].value+',';//如果选中，将value添加到变量s中
	}

	if(title==""){
		show_error("群组名称不能为空!");
		return false;
	}
	
	if(daycount==""){
		show_error("分站时长不能为空!");
		return false;
	}
	
	if(paylist_list == ""){
		show_error("请选择支付方式!");
		return false;
	}
	$.ajax({
		type:"POST",
		url:"<?php echo url('substationgroup/add'); ?>",
		dataType:"json",
		data:{
			title:title,
			daycount:daycount,
			content:content,
			paylist_list:paylist_list,
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
