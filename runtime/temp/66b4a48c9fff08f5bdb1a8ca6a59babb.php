<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:31:"template/website/rule/edit.html";i:1674397836;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">权限分类</label>
            <div class="layui-input-block">
				<select name="said" id="said">
					<option value="0"> === 请选择权限分类 === </option>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<option value="<?php echo $vo['id']; ?>"  <?php if($vo['id']==$info['said']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
            </div>
          </div>
		
          <div class="layui-form-item">
            <label class="layui-form-label">权限名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title" value="<?php echo $info['title']; ?>"   placeholder="权限名称">
            </div>
          </div>    
          <div class="layui-form-item">
            <label class="layui-form-label">路径</label>
            <div class="layui-input-block">
              <input name="name" type="text" class="layui-input" id="name" value="<?php echo $info['name']; ?>"   placeholder="路径">
            </div>
          </div> 

			<div class="layui-form-item">
            <label class="layui-form-label">规则</label>
            <div class="layui-input-block">
              <input name="condition" type="text" class="layui-input" id="condition"   placeholder="规则" value="<?php echo $info['condition']; ?>">
            </div>
          </div>
		  
		  <div class="layui-form-item">
            <label class="layui-form-label">分类排序</label>
            <div class="layui-input-block">
              <input name="sort" type="number" class="layui-input" id="sort"   placeholder="默认999" value="<?php echo $info['sort']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" <?php if($info['status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="2" title="禁用" <?php if($info['status']==2): ?>checked=""<?php endif; ?>>
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
	var title     = $("#title").val();
	var name      = $("#name").val();
	var condition = $("#condition").val();
	var status    = $("input[name='status']:checked").val();
	var said      = $("#said").val();
	var _sort  = $("#sort").val();
	
	
	if(said==0){
		show_error("权限分类不能为空!");
		return false;
	}
	
	if(_sort==""){
		_sort = 999;
	}
	
	if(title==""){
		show_error("权限名称不能为空!");
		return false;
	}
	
	if(name==""){
		show_error("路径不能为空!");
		return false;
	}
	$.ajax({
		type:"POST",
		url:"<?php echo url('rule/edit'); ?>",
		dataType:"json",
		data:{
			id:"<?php echo $info['id']; ?>",
			title:title,
			name:name,
			condition:condition,
			status:status,
			said:said,
			sort:_sort,
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
