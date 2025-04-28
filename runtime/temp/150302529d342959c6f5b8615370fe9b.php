<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/website/navigat/add.html";i:1674397834;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_header.html";i:1674397684;s:59:"/www/wwwroot/fufei.wtyz.cn/template/website/common_top.html";i:1674397684;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">上级导航</label>
            <div class="layui-input-block">
				<select name="snsid" id="snsid">
					<option value="0"> === 顶级导航 === </option>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo $vo['ns_id']; ?>"><?php echo $vo['ns_title']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
          </div> 
		
		
        <div class="layui-form-item">
            <label class="layui-form-label">导航名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title"   placeholder="导航名称">
            </div>
          </div>
		  
		  <div class="layui-form-item">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-block">
              <input name="icon" type="text" class="layui-input" id="icon"   placeholder="图标">
            </div>
          </div> 
		  
		  <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
              <input name="sort" type="number" class="layui-input" id="sort"   placeholder="排序,默认999">
            </div>
          </div>
		  
		  <div class="layui-form-item">
            <label class="layui-form-label">控制器</label>
            <div class="layui-input-block">
              <input name="controller" type="text" class="layui-input" id="controller"   placeholder="控制器">
            </div>
          </div> 
		  
		  <div class="layui-form-item">
            <label class="layui-form-label">方法</label>
            <div class="layui-input-block">
              <input name="method" type="text" class="layui-input" id="method"   placeholder="方法">
            </div>
          </div> 
		  
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" checked="">
              <input type="radio" name="status" value="2" title="禁用">
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
	var snsid      = $("#snsid").val();
	var title      = $("#title").val();
	var icon       = $("#icon").val();
	var _sort       = $("#sort").val();
	var controller = $("#controller").val();
	var method     = $("#method").val();
	var status     = $("input[name='status']:checked").val();
	
	if(title==""){
		show_error("导航名称不能为空!");
		return false;
	}

	if(controller==""){
		show_error("控制器不能为空!");
		return false;
	}

	if(method==""){
		show_error("方法不能为空!");
		return false;
	}

	$.ajax({
		type:"POST",
		url:"<?php echo url('navigat/add'); ?>",
		dataType:"json",
		data:{
			snsid:snsid,
			title:title,
			icon:icon,
			_sort:_sort,
			controller:controller,
			method:method,
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
