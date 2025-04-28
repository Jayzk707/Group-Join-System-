<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"template/fenxiao/wxgrouptmp/index.html";i:1674397804;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_header.html";i:1674397682;s:59:"/home/www/wwwroot/demotest/template/fenxiao/common_top.html";i:1674397682;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_footer.html";i:1674397682;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
  <title><?php echo session("du_name"); ?> <?php echo $subweb['oaname']; ?></title>
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
			<div class="layui-form" lay-filter="component-form-element">
			    <div class="layui-box">
			<?php if(!empty($webinfo['text12'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text12']; ?>" target="_blank">功能说明</a><?php endif; ?>
			 </div>
            <div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
                <th>状态</th>
                <th>群名称</th>
                <th>副标题</th>
                <th>群费用</th>
                <th width="120">管理</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['wxgt_id']; ?>">
					<td class="text-center"><?php echo $vo['wxgt_id']; ?></td>
                    <td>
                    <?php if($vo['wxgt_status']==1): ?><span class="layui-badge layui-bg-blue">启用</span>
                    <?php elseif($vo['wxgt_status']==2): ?><span class="layui-badge layui-bg-black">禁用</span><?php endif; ?>
                    </td>
                    <td><span class="layui-badge-rim"><?php echo $vo['wxgt_title']; ?></span></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['wxgt_subtitle']; ?></span></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['wxgt_money']; ?> 元</span></td>
                    <td>
							<div class="layui-btn-group">
								<button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['wxgt_id']; ?>"><i class="layui-icon">使用模板</i></button>
							</div>
                    </td>
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
		var url = '<?php echo url('wxgrouptmp/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '使用模板'
          ,content: url
          ,area: ['800px', '750px']
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