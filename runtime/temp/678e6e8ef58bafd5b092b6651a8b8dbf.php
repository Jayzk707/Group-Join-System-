<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"template/substation/dianka/index.html";i:1674397819;s:61:"/www/wwwroot/8.8x89.cn/template/substation/common_header.html";i:1674397683;s:58:"/www/wwwroot/8.8x89.cn/template/substation/common_top.html";i:1674397683;s:61:"/www/wwwroot/8.8x89.cn/template/substation/common_footer.html";i:1674397683;}*/ ?>
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
			<button class="layui-btn layuiadmin-btn-tags" data-type="add">充值点卡</button>
			<button class="layui-btn layuiadmin-btn-tags" data-type="add1">余额：<?php echo round($info['su_dk'],2); ?></button>
			<?php if(!empty($webinfo['text6'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text6']; ?>" target="_blank">功能说明</a><?php endif; ?>

			 </div>
			<div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
				<th>状态</th>
				<th>网关</th>
                <th>金额</th>
				<th>添加时间</th>
                <th>支付时间</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['dk_id']; ?>">
					<td class="text-center"><?php echo $vo['dk_id']; ?></td>
                    <td class="text-center"><?php if($vo['dk_status']==1): ?>未支付<?php else: ?>已支付<?php endif; ?></td>
                    <td class="text-center"><?php if($vo['dk_type']==2): ?>支付宝<?php elseif($vo['dk_type']==3): ?>后台<?php else: ?>微信<?php endif; ?></td>
                    <td><?php echo $vo['dk_money']; ?></td>
                    <td><?php echo $vo['dk_addtime']; ?></td>
                    <td><?php echo $vo['dk_pay_time']; ?></td>
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
   

	  add: function(){
        layer.open({
          type: 2
          ,title: '充值点卡'
          ,content: '<?php echo url('dianka/add'); ?>'
          ,area: ['600px', '650px']
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