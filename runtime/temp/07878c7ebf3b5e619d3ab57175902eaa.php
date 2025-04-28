<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"template/substation/distributiontixian/index.html";i:1674397824;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
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
			 </div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
                <th>状态</th>
				<th>分销员(余额)</th>
                <th>提现金额</th>
                <th>添加时间</th>
                <th>审核时间</th>
                <th>审核备注</th>
				<th width="100">管理</th>
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
                    <td><span class="layui-badge-rim"><?php echo $vo['du_name']; ?>(<?php echo $vo['du_money']; ?>)</span></td>
                    <td><?php echo $vo['dt_money']; ?></td>
                    <td><?php echo $vo['dt_addtime']; ?></td>
                    <td><?php echo $vo['dt_shtime']; ?></td>
                    <td><?php echo $vo['dt_content']; ?></td>
					<td>
							<div class="layui-btn-group">
                            	
								<button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('distributiontixian/del',array('id'=>$vo['dt_id'])); ?>','tr_<?php echo $vo['dt_id']; ?>')"><i class="layui-icon">&#xe640;</i></button>
                                <?php if($vo['dt_status']==1): ?><button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['dt_id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; ?>
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
		var url = '<?php echo url('distributiontixian/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '审核提现信息'
          ,content: url
          ,area: ['550px', '555px']
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