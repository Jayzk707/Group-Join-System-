<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/website/group/index.html";i:1674397834;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
				<th width="20"></th>
                <th width="35">序号</th>
				<th width="35">状态</th>
				<th width="60">用户数</th>
				<th>群组名称</th>
				<?php if(($__APS__['del'] or $__APS__['edit'])): ?><th width="170">管理</th><?php endif; ?>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['id']; ?>">
					<td><input type="checkbox" name="delmulti" id="checkbox" value="<?php echo $vo['id']; ?>"></td>
					<td class="text-center"><?php echo $vo['id']; ?></td>
					<td class="text-center"><?php if($vo['status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
					<td class="text-center"><?php echo $vo['count']; ?></td>
					<td><?php echo $vo['title']; ?></td>
					<?php if(($__APS__['del'] or $__APS__['edit'])): ?>
					<td>
							<div class="layui-btn-group">
								<?php if(($__APS__['del'])): ?><button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('group/del',array('id'=>$vo['id'])); ?>','tr_<?php echo $vo['id']; ?>')"><i class="layui-icon">&#xe640;</i></button><?php endif; if(($__APS__['add'])): ?><button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; if(($__APS__['addauth'])): ?><button class="layui-btn layui-btn-sm" data-type="addauth" data-id="<?php echo $vo['id']; ?>"><i class="layui-icon">&#xe624;</i></button><?php endif; if(($__APS__['addnavigat'])): ?><button class="layui-btn layui-btn-sm" data-type="addnavigat" data-id="<?php echo $vo['id']; ?>"><i class="layui-icon">&#xe632;</i></button><?php endif; ?>
							</div>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table> 
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
  layui.use(['index'], function(){
    var $ = layui.$, active = {
		<?php if(($__APS__['add'])): ?>
      add: function(){
        layer.open({
          type: 2
          ,title: '添加群组'
          ,content: '<?php echo url('group/add'); ?>'
          ,area: ['550px', '290px']
        }); 
      },
	  <?php endif; if(($__APS__['edit'])): ?>
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('group/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改群组'
          ,content: url
          ,area: ['550px', '290px']
        }); 
      },
	  <?php endif; if(($__APS__['addauth'])): ?>
	  addauth: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('group/addauth',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '群组权限设置'
          ,content: url
          ,area: ['890px', '590px']
        }); 
      },
	  <?php endif; if(($__APS__['addnavigat'])): ?>
	  addnavigat: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('group/addnavigat',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '设置群组导航'
          ,content: url
          ,area: ['890px', '590px']
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