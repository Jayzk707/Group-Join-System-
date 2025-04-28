<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"template/substation/paylist/index.html";i:1674397826;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
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
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md12">
        <div class="layui-card">
          <div class="layui-card-body">
          	<div class="layui-box">
          	 <?php if(!empty($webinfo['text10'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text10']; ?>" target="_blank">功能说明</a><?php endif; ?>
			 </div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
				<th>名称</th>
                <th>状态</th>
				<th>图标</th>
                <th>备注</th>
				<th width="100">管理</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['pl_id']; ?>">
					<td class="text-center"><?php echo $vo['pl_id']; ?></td>
                    <td><span class="layui-badge-rim"><?php if($vo['pl_url'] !=""): ?><a href="<?php echo $vo['pl_url']; ?>" target="_blank"><font color="#0033FF" >[点击申请]</font></a><?php endif; ?>&nbsp;&nbsp;&nbsp;<?php echo $vo['pl_title']; ?></span></td>
                    <td><?php if($vo['su_pl_status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
                    <td><img src="<?php echo $vo['pl_ico']; ?>" width="40" height="40"></td>
                    <td><?php echo $vo['pl_content']; ?></td>
					<td>
							<div class="layui-btn-group">
								<button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['pl_id']; ?>"><i class="layui-icon">&#xe642;</i></button>
							</div>
					</td>
				</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
          </table> 
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
	layui.use(['index','form'], function(){
		
		var form = layui.form;
		


    var $ = layui.$, active = {
   
	 
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('paylist/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '配置支付'
          ,content: url
          ,area: ['660px', '660px']
        }); 
      },
	 
	  

    } 
	
	 
    $('.layui-btn').on('click', function(){
      var type = $(this).data('type');
      active[type] ? active[type].call(this) : '';
    });

	
  });
  </script>
</body>
</html>