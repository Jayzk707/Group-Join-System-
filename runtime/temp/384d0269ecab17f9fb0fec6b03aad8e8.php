<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"template/website/users/addauth.html";i:1674402504;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_header.html";i:1674397684;s:59:"/www/wwwroot/fufei.wtyz.cn/template/website/common_top.html";i:1674397684;s:62:"/www/wwwroot/fufei.wtyz.cn/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">账号</label>
            <div class="layui-input-block">
              <input name="title" type="text" disabled class="layui-input" id="title" value="<?php echo $info['u_phone']; ?>" readonly="readonly"   placeholder="账号">
            </div>
          </div>    

		  <!--<div class="layui-form-item">
            <label class="layui-form-label">群组权限</label>
            <div class="layui-input-block">
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <input type="checkbox" name="model" value="<?php echo $vo['id']; ?>" title="<?php echo $vo['title']; ?>" <?php if(in_array(($vo['id']), is_array($access)?$access:explode(',',$access))): ?>checked<?php endif; ?>>
             <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
          </div>-->



		  <div class="layui-form-item">
            <label class="layui-form-label">群组权限</label>
            <div class="layui-input-block">
				<div id="test2" class="demo-transfer"></div>
            </div>
          </div>


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
layui.use(['transfer', 'layer', 'util'], function(){
  var $ = layui.$
  ,transfer = layui.transfer
  ,layer = layui.layer
  ,util = layui.util;
 
  var data1 = [
	<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    {"value": "<?php echo $vo['id']; ?>", "title": "<?php echo $vo['title']; ?>"},
	<?php endforeach; endif; else: echo "" ;endif; ?>
  ]
   dataselect  = [
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(in_array(($vo['id']), is_array($access)?$access:explode(',',$access))): ?>"<?php echo $vo['id']; ?>",<?php endif; endforeach; endif; else: echo "" ;endif; ?>
	]

  //定义标题及数据源
  transfer.render({
    elem: '#test2'
    ,title: ['群组', '已选']  //自定义标题
    ,data: data1
    ,height: 310 //定义高度
	,value:dataselect
	,id: 'key123' //定义唯一索引
  })
 


	$(".sub").click(function(){
		//if(!$(".btn").hasClass("sub")){return false;}
		var groupid  = "";
		$.each($('input:checkbox'),function(){
			if(this.checked){
				groupid += $(this).val()+",";
			}
		});
		console.log("============");
		var getData = transfer.getData('key123'); //获取右侧数据
		if(getData.length > 0){
			for (var i=0;i<getData.length;i++){
				groupid += getData[i].value+",";
				
			}
		}

		$.ajax({
			type:"POST",
			url:"<?php echo url('users/addauth'); ?>",
			dataType:"json",
			data:{ 
				id:"<?php echo $info['u_id']; ?>",
				groupid:groupid,
			},
			success:function(res){
				if(res.status == 1){
					window.parent.layer.closeAll();//关闭弹窗
					window.parent.location.reload();
				}else{
					show_error(res.msg);
				}
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
		});
		
	});

});
</script>
</body>
</html>
