<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:32:"template/website/rule/index.html";i:1674397838;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
			 <?php if(($__APS__['addgroup'])): ?><button class="layui-btn layuiadmin-btn-tags" data-type="addgroup">添加分类</button><?php endif; if(($__APS__['add'])): ?><button class="layui-btn layuiadmin-btn-tags" data-type="add">添加权限</button><?php endif; ?>
			 </div>
		
			
			
			
			<table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
				<th width="20"></th>
                <!--<th width="35">序号</th>-->
				<th width="35">状态</th>
				<th width="230">权限名称</th>
				<th>路径</th>
				<th></th>
				<?php if(($__APS__['del'] or $__APS__['edit'] or $__APS__['delgroup']  or $__APS__['editgroup'])): ?><th width="100">管理</th><?php endif; ?>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['id']; ?>">
					<td><input type="checkbox" name="delmulti" id="checkbox" value="<?php echo $vo['id']; ?>"></td>
					<!--<td class="text-center"><?php echo $vo['id']; ?></td>-->
					<td class="text-center"><!--<?php if($vo['status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?>--></td>
					<td><strong><span class="layui-badge layui-bg-cyan"><?php echo $vo['title']; ?></span></strong></td>
					<td></td>
					<td class="text-center"><?php echo $vo['condition']; ?></td>
					<?php if(($__APS__['del'] or $__APS__['edit'] or $__APS__['delgroup']  or $__APS__['editgroup'])): ?>
					<td>
							<div class="layui-btn-group">
								<?php if(($__APS__['delgroup'])): ?><button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('rule/delgroup',array('id'=>$vo['id'])); ?>','tr_<?php echo $vo['id']; ?>')"><i class="layui-icon">&#xe640;</i></button><?php endif; if(($__APS__['editgroup'])): ?><button class="layui-btn layui-btn-sm" data-type="editgroup" data-id="<?php echo $vo['id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; ?>
							</div>
					</td>
					<?php endif; ?>
				</tr>
				<?php if(is_array($vo['data']) || $vo['data'] instanceof \think\Collection || $vo['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo1['id']; ?>">
					<td><input type="checkbox" name="delmulti" id="checkbox" value="<?php echo $vo1['id']; ?>"></td>
					<!--<td class="text-center"><?php echo $vo1['id']; ?></td>-->
					<td class="text-center"><?php if($vo1['status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|_&nbsp;<span class="layui-badge-rim"><?php echo $vo1['title']; ?></span></td>
					<td><span class="layui-badge layui-bg-gray"><?php echo $vo1['name']; ?></span></td>
					<td class="text-center"><?php echo $vo1['condition']; ?></td>
					<?php if(($__APS__['del'] or $__APS__['edit'] or $__APS__['delgroup']  or $__APS__['editgroup'])): ?>
					<td>
							<div class="layui-btn-group">
								<?php if(($__APS__['del'])): ?><button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('rule/del',array('id'=>$vo1['id'])); ?>','tr_<?php echo $vo1['id']; ?>')"><i class="layui-icon">&#xe640;</i></button><?php endif; if(($__APS__['edit'])): ?><button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo1['id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; ?>
							</div>
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table> 

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
          ,title: '添加权限模块'
          ,content: '<?php echo url('rule/add'); ?>'
          ,area: ['550px', '505px']
        }); 
      },
	  <?php endif; if(($__APS__['addgroup'])): ?>
      addgroup: function(){
        layer.open({
          type: 2
          ,title: '添加权限分类'
          ,content: '<?php echo url('rule/addgroup'); ?>'
          ,area: ['550px', '290px']
        }); 
      },
	  <?php endif; if(($__APS__['edit'])): ?>
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('rule/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改权限模块'
          ,content: url
          ,area: ['550px', '505px']
        }); 
      },
	  <?php endif; if(($__APS__['editgroup'])): ?>
	  editgroup: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('rule/editgroup',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改权限分类'
          ,content: url
          ,area: ['550px', '290px']
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