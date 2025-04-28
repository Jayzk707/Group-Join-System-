<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"template/website/paylist/index.html";i:1674397834;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
          <div class="layui-card-body">
          	<div class="layui-box">
			<?php if(($__APS__['add'])): ?><button class="layui-btn layuiadmin-btn-tags" data-type="add">添加</button><?php endif; ?>
			 </div>
			<div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
				<th>名称</th>
                <th>编码</th>
				<th>图标</th>
                <th>状态</th>
                <th>备注</th>
				<?php if(($__APS__['del'] or $__APS__['edit'])): ?><th width="100">管理</th><?php endif; ?>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['pl_id']; ?>">
					<td class="text-center"><?php echo $vo['pl_id']; ?></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['pl_title']; ?></span></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['pl_code']; ?></span></td>
                    <td><img src="<?php echo $vo['pl_ico']; ?>" width="40" height="40"></td>
                    <td class="text-center"><?php if($vo['pl_status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
                    <td><?php echo $vo['pl_content']; ?></td>
					<?php if(($__APS__['del'] or $__APS__['edit'])): ?>
					<td>
							<div class="layui-btn-group">
								<?php if(($__APS__['del'])): ?><button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('paylist/del',array('id'=>$vo['pl_id'])); ?>','tr_<?php echo $vo['pl_id']; ?>')"><i class="layui-icon">&#xe640;</i></button><?php endif; if(($__APS__['edit'])): ?><button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['pl_id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; ?>
							</div>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table> 
		  </div>
		  <div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
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
	layui.use(['index','form'], function(){
		
		var form = layui.form;
		


    var $ = layui.$, active = {
      <?php if(($__APS__['add'])): ?>
	  add: function(){
        layer.open({
          type: 2
          ,title: '添加支付'
          ,content: '<?php echo url('paylist/add'); ?>'
          ,area: ['550px', '650px']
        }); 
      },
	  <?php endif; if(($__APS__['edit'])): ?>
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('paylist/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改支付'
          ,content: url
          ,area: ['550px', '650px']
        }); 
      },
	  <?php endif; ?>
	  

    } 
	
	 
    $('.layui-btn').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });

	
  });
  </script>
</body>
</html>