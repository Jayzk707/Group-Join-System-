<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:46:"template/fenxiao/distributiontixian/index.html";i:1674397798;s:62:"/www/wwwroot/fufei.wtyz.cn/template/fenxiao/common_header.html";i:1674397682;s:59:"/www/wwwroot/fufei.wtyz.cn/template/fenxiao/common_top.html";i:1674397682;s:62:"/www/wwwroot/fufei.wtyz.cn/template/fenxiao/common_footer.html";i:1674397682;}*/ ?>
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
             
          	<div class="layui-box">
			<button class="layui-btn layuiadmin-btn-tags" data-type="add">提现申请</button>
			<?php if(!empty($webinfo['text14'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text14']; ?>" target="_blank">功能说明</a><?php endif; ?>
			 </div>
			<div class="layui-form" lay-filter="component-form-element">
            <div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
                <th>状态</th>
                <th>提现金额</th>
                <th>提现时间</th>
                <th>审核时间</th>
                <th>审核备注</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['dt_id']; ?>">
					<td class="text-center"><?php echo $vo['dt_id']; ?></td>
                    <td>
                    <?php if($vo['dt_status']==1): ?><span class="layui-badge layui-bg-blue">审核中</span>
                    <?php elseif($vo['dt_status']==3): ?><span class="layui-badge layui-bg-black">拒绝</span>
                    <?php elseif($vo['dt_status']==4): ?><span class="layui-badge layui-bg-green">已支付</span><?php endif; ?>
                    </td>
                    <td><?php echo $vo['dt_money']; ?></td>
                    <td><?php echo $vo['dt_addtime']; ?></td>
                    <td><?php echo $vo['dt_shtime']; ?></td>
                    <td><?php echo $vo['dt_content']; ?></td>
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

	 
	  add: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('distributiontixian/add'); ?>';
        layer.open({
          type: 2
          ,title: '提现申请'
          ,content: url
          ,area: ['550px', '450px']
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