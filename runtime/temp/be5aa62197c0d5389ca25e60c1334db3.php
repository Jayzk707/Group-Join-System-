<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"template/substation/wxgroup/index.html";i:1674397828;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_header.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/substation/common_top.html";i:1674397684;s:64:"/www/wwwroot/www.521daima.com/template/substation/common_footer.html";i:1674397684;}*/ ?>
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
			<div class="layui-form" lay-filter="component-form-element">
			    
          	<div class="layui-box">
          		<div class="layui-inline"><input type="text" name="scontent" id="scontent" placeholder="请输入群组名称" value="<?php echo $s; ?>" class="layui-input"></div>
          		<div class="layui-inline">
            		<button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search" data-type="indexsearch"><i class="layui-icon layui-icon-search layuiadmin-button-btn"></i></button>
          		</div>
          		<?php if(!empty($webinfo['text1'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text1']; ?>" target="_blank">功能说明</a><?php endif; ?>


         	</div>
         	
            <div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
                <th>状态</th>
                <th>所属分销</th>
                <th>群名称</th>
                <th>订单数</th>
                <th>曝光量</th>
                <th>转化率</th>
                <th>入群金额</th>
                <th>总收款</th>
                <th>总赢利</th>
                <th>备注</th>
                <th>管理</th>
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['wxg_id']; ?>">
					<td class="text-center"><?php echo $vo['wxg_id']; ?></td>
                    <td>
                    <?php if($vo['wxg_status']==1): ?><span class="layui-badge layui-bg-blue">启用</span>
                    <?php elseif($vo['wxg_status']==2): ?><span class="layui-badge layui-bg-black">禁用</span><?php endif; ?>
                    </td>
                    <td><span class="layui-badge-rim"><?php echo $vo['du_name']; ?>（<?php echo $vo['du_smname']; ?>）</span></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['wxg_title']; ?></span></td>
                    <td><?php echo $vo['count_ddx']; ?></td>
                    <td><?php echo $vo['wxg_readcount']; ?> 次</td>
                    <td><?php echo round($vo['count_ddx']/ $vo['wxg_readcount'] * 100,2); ?>%</td>
                    <td><?php echo $vo['wxg_money']; ?> 元</td>
                    <td><?php echo round($vo['count_z_money'],2); ?> 元</td>
                    <td><?php echo round($vo['count_p_money'],2); ?> 元</td>
                    <td><?php echo $vo['wxg_content']; ?></td>
                    <td>
							<div class="layui-btn-group">
								<button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('wxgroup/del',array('id'=>$vo['wxg_id'])); ?>','tr_<?php echo $vo['wxg_id']; ?>')"><i class="layui-icon">&#xe640;</i></button>
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



	  indexsearch: function(){
		var scontent = $("#scontent").val();
		if(scontent==""){
		    var url = "<?php echo url('wxgroup/index'); ?>";
		}else{
		    var url = "<?php echo url('wxgroup/index',array('s'=>'AAAAA')); ?>";
		    url = url.replace("AAAAA", scontent);
		}
		window.location = url;
	  },

	 
	  add: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('wxgroup/add'); ?>';
        layer.open({
          type: 2
          ,title: '添加群组'
          ,content: url
          ,area: ['550px', '290px']
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