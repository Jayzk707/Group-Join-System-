<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"template/website/substation/index.html";i:1674397840;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
          	    
          	<div class="layui-box">
          		<div class="layui-inline"><input type="text" name="scontent" id="scontent" placeholder="请输入分站名称或域名" value="<?php echo $s; ?>"  class="layui-input"></div>
          		<div class="layui-inline">
            		<button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="LAY-user-back-search" data-type="indexsearch"><i class="layui-icon layui-icon-search layuiadmin-button-btn"></i></button>
          		</div>
          		<div class="layui-inline">
                	<?php if(($__APS__['add'])): ?><button class="layui-btn layuiadmin-btn-tags" data-type="add">添加</button><?php endif; ?>
				</div>
         	</div>
         	
			
			 </div>
			<div class="layui-box layui-laypage layui-laypage-molv"><?php echo $page; ?></div>
			<div class="layui-form" lay-filter="component-form-element">
            <table class="layui-table" lay-even="" lay-skin="nob">
            <thead>
              <tr>
                <th width="35" rowspan="2">序号</th>
                <th rowspan="2">状态</th>
                <th rowspan="2">所属群组</th>
				<th rowspan="2">分站名称</th>
				<th rowspan="2">分站域名</th>
				<th rowspan="2">余点</th>
				<th rowspan="2">抽拥比</th>
                <th rowspan="2">到期时间</th>
                <th rowspan="2">分站帐号</th>
                <th height="20" colspan="5" style="text-align:center">数据统计</th>
                <th rowspan="2">备注</th>
                
				<?php if(($__APS__['del'] or $__APS__['edit'])): ?><th width="115" rowspan="2">管理</th><?php endif; ?>
              </tr>
              <tr >
                <th style="text-align:center">分销数</th>
                <th style="text-align:center"><?php if(($__APS__['show'])): ?>月抽佣<?php endif; ?></th>
                <th style="text-align:center"><?php if(($__APS__['show'])): ?>总抽佣<?php endif; ?></th>
                <th style="text-align:center">今日收款</th>
                <th style="text-align:center">总收款</th>
                
              </tr> 
            </thead>
            <tbody>
             <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr id="tr_<?php echo $vo['su_id']; ?>">
					<td class="text-center"><?php echo $vo['su_id']; ?></td>
                     <td class="text-center"><?php if($vo['su_status']==1): ?><span class="layui-badge-dot layui-bg-green"></span><?php else: ?><span class="layui-badge-dot"></span><?php endif; ?></td>
                    <td><span class="layui-badge-rim"><?php echo $vo['su_g_title']; ?></span></td>
                    <td><?php if($vo['su_s_id']!=0): ?><span class="layui-badge">分：<?php echo $vo['su_s_id']; ?></span><?php endif; ?> <?php echo $vo['su_title']; ?></td>
                    <td><span class="layui-badge layui-bg-gray"><?php echo $vo['su_domain']; ?></span></td>
                    <td><?php echo $vo['su_dk']; ?></td>
                    <td><?php echo $vo['su_dk_cd']; ?> %</td>
                    <td><?php echo $vo['su_endtime']; ?></td>
                    <td><?php echo $vo['su_name']; ?></td>
                    <td style="text-align:center"><span class="layui-badge layui-bg-cyan"><?php echo $vo['count_fx']; ?> 位</span></td>
                    <td style="text-align:center"><?php if(($__APS__['show'])): ?><span class="layui-badge"><?php echo round($vo['count_cs'],2); ?> 元</span><?php endif; ?></td>
                    <td style="text-align:center"><?php if(($__APS__['show'])): ?><span class="layui-badge"><?php echo round($vo['count_zcs'],2); ?> 元</span><?php endif; ?></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_daymoney'],2); ?> 元</span></td>
                    <td style="text-align:center"><span class="layui-badge"><?php echo round($vo['count_zmoney'],2); ?> 元</span></td>
                    <td class="text-center"><?php echo $vo['su_content']; ?></td>
					<?php if(($__APS__['del'] or $__APS__['edit'])): ?>
					<td>
							<div class="layui-btn-group">
								<?php if(($__APS__['del'])): ?><button class="layui-btn layui-btn-sm" onClick="calldel('<?php echo url('substation/del',array('id'=>$vo['su_id'])); ?>','tr_<?php echo $vo['su_id']; ?>')"><i class="layui-icon">&#xe640;</i></button><?php endif; if(($__APS__['edit'])): ?><button class="layui-btn layui-btn-sm" data-type="edit" data-id="<?php echo $vo['su_id']; ?>"><i class="layui-icon">&#xe642;</i></button><?php endif; ?>
                                <button class="layui-btn layui-btn-sm" data-type="login" data-user="<?php echo $vo['su_name']; ?>" data-pass="<?php echo $vo['su_pass']; ?>">登</button>
							</div>
					</td>
					<?php endif; ?>
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
        
        
        
        
	  indexsearch: function(){
		var scontent = $("#scontent").val();
		if(scontent==""){
		    var url = "<?php echo url('substation/index'); ?>";
		}else{
		    var url = "<?php echo url('substation/index',array('s'=>'AAAAA')); ?>";
		    url = url.replace("AAAAA", scontent);
		}
		window.location = url;
	  },
        
        
		
	  login: function(){
		  var user = $(this).data('user');
		  var pass = $(this).data('pass');
		  var url = '<?php echo url('substation.php/index/login_admin',array('username'=>'AAAAAA','password'=>'BBBBBB')); ?>';
		  url = url.replace("AAAAAA",user);
		  url = url.replace("BBBBBB",pass)
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  url = url.replace("#","[AAA]")
		  window.open(url,'_blank');
      },	
		
		
      <?php if(($__APS__['add'])): ?>
	  add: function(){
        layer.open({
          type: 2
          ,title: '添加分站'
          ,content: '<?php echo url('substation/add'); ?>'
          ,area: ['660px', '660px']
        }); 
      },
	  <?php endif; if(($__APS__['edit'])): ?>
	  edit: function(){
		var id = $(this).data('id');
		var url = '<?php echo url('substation/edit',array('id'=>'AAAAAA')); ?>';
		url = url.replace("AAAAAA",id)
        layer.open({
          type: 2
          ,title: '修改分站'
          ,content: url
          ,area: ['660px', '660px']
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