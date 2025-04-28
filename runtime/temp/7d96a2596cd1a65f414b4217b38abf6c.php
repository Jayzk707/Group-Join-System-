<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:43:"template/substation/distribution/index.html";i:1674402504;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
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
			<button class="layui-btn layuiadmin-btn-tags" data-type="add">添加</button>
			<?php if(!empty($webinfo['text3'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text3']; ?>" target="_blank">功能说明</a><?php endif; ?>
		    </div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35" rowspan="2">序号</th>
                <th rowspan="2">状态</th>
				<th rowspan="2">用户名（实名）</th>
                <th rowspan="2">所属群组</th>
                <th rowspan="2">分销比例</th>
                <th rowspan="2">账号</th>
                <th rowspan="2">支付宝</th>
                <th rowspan="2">微信</th>
                <th rowspan="2">余额</th>
                <th colspan="6" style="text-align:center">数据统计</th>
                <th width="120" rowspan="2">管理</th>
              </tr>
              <tr>
                <th style="text-align:center">群数</th>
                <th style="text-align:center">总收</th>
                <th style="text-align:center">本月</th>
                <th style="text-align:center">收益</th>
                <th style="text-align:center">利润</th>
                <th style="text-align:center">今日收款</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['du_id']; ?>">
					<td class="text-center"><?php echo $vo['du_id']; ?></td>
                    <td><?php if($vo['du_status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['du_name']; ?>(<?php echo $vo['du_smname']; ?>)</span></td>
                    <td><?php echo $vo['dg_title']; ?></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['dg_count']; ?> %</span></td>
                    <td><?php echo $vo['du_phone']; ?></td>
                    <td><?php echo $vo['du_zfb']; ?></td>
                    <td><?php echo $vo['du_wx']; ?></td>
                    <td><?php echo $vo['du_money']; ?></td>
                    <td style="text-align:center"><span class="layui-badge layui-bg-cyan"><?php echo $vo['count_group']; ?></span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_z_money'],2); ?> 元</span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_cs'],2); ?> 元</span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_s_money'],2); ?> 元</span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_p_money'],2); ?> 元</span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_daymoney'],2); ?> 元</span></td>
					<td>
							<div class="layui-btn-group">
								<button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('distribution/del',array('id'=>$vo['du_id'])); ?>','tr_<?php echo $vo['du_id']; ?>')"><i class="layui-icon">&#xe640;</i></button>
								<button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['du_id']; ?>"><i class="layui-icon">&#xe642;</i></button>
								<button class="layui-btn layui-btn-sm" data-type="login" data-user="<?php echo $vo['du_name']; ?>" data-pass="<?php echo $vo['du_pass']; ?>">登</button>
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
   
   
	  login: function(){
		  var user = $(this).data('user');
		  var pass = $(this).data('pass');
		  var url = '<?php echo url('/fenxiao.php/index/login_admin',array('username'=>'AAAAAA','password'=>'BBBBBB')); ?>';
		 
		  url = url.replace("/substation.php","");
		  url = url.replace("AAAAAA",user);
		  url = url.replace("BBBBBB",pass)
		  window.open(url,'_blank');
      },
   
	 
	  add: function(){
        layer.open({
          type: 2
          ,title: '添加分销信息'
          ,content: '<?php echo url('distribution/add'); ?>'
          ,area: ['650px', '710px']
        }); 
      },
	 
	 
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('distribution/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改分销信息'
          ,content: url
          ,area: ['650px', '710px']
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