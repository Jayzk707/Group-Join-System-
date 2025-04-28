<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:35:"template/fenxiao/wxgroup/index.html";i:1690365396;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_header.html";i:1674397682;s:59:"/home/www/wwwroot/demotest/template/fenxiao/common_top.html";i:1674397682;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_footer.html";i:1674397682;}*/ ?>
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
          	    <?php if($d_info['du_tmp']==1): ?>
			<button class="layui-btn layuiadmin-btn-tags" data-type="add">添加群组</button>
			<button class="layui-btn layuiadmin-btn-tags" data-type="addimg">添加单图群组</button>
			<?php endif; if(!empty($webinfo['text11'])): ?><a class="layui-btn layuiadmin-btn-tags" href="<?php echo $webinfo['text11']; ?>" target="_blank">功能说明</a><?php endif; ?>
			 </div>
			<div class="layui-form" lay-filter="component-form-element">
            <div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35">序号</th>
                <th>状态</th>
                <th>群名称</th>
                <th>订单数</th>
                <th>曝光量</th>
                <th>转化率</th>
                <th>入群金额</th>
                <th>总收款</th>
                <th>总赢利</th>
                <th>管理</th>
                <th width="130">管理</th>
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
								<?php if($d_info['du_tmp']==1): if($vo['wxg_type']==1): ?>
                                <button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['wxg_id']; ?>"><i class="layui-icon">&#xe642;</i></button>
                                <?php else: ?>
                                
                                <button class="layui-btn layui-btn-sm" data-type="editimg" data-id="<?php echo $vo['wxg_id']; ?>"><i class="layui-icon">&#xe642;</i></button>
                                <?php endif; endif; ?>
                                <button class="layui-btn layui-btn-sm" data-type="turl" data-id="<?php echo $vo['wxg_id']; ?>">提链</button>
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

	  add: function(){
        layer.open({
          type: 2
          ,title: '添加群组'
          ,content: '<?php echo url('wxgroup/add'); ?>'
          ,area: ['800px', '750px']
        }); 
      },
      
      
	  addimg: function(){
        layer.open({
          type: 2
          ,title: '添加单图群组'
          ,content: '<?php echo url('wxgroup/addimg'); ?>'
          ,area: ['800px', '750px']
        }); 
      },
      
	  
	 
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('wxgroup/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改群组'
          ,content: url
          ,area: ['800px', '750px']
        }); 
      },
      
      
	  editimg: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('wxgroup/editimg',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改单图群组'
          ,content: url
          ,area: ['800px', '750px']
        }); 
      },
      
	 
	 
	  turl: function(){
	  
		var id = $(this).data('id');
		var url1 = '<?php echo url('group.php/index/index',array('id'=>'AAAAAA')); ?>';
		url1 = url1.replace("AAAAAA",id)
		url1 = url1.replace("/fenxiao.php","")
		url1 = "http://<?php echo session("su_domain"); ?>"+url1
		
		//var url = '<?php echo url('wxgroup/turl',array('url'=>'AAAAAA')); ?>';
		//url = url.replace("AAAAAA",url1)
		/*url = "https://api.qrserver.com/v1/create-qr-code/?size=290x290&data="+url1*/
		url = "/qrcode.php?size=290x290&data="+url1
        layer.open({
          type: 2
          ,title: '提链'
          ,content: url
          ,area: ['290px', '336px']
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