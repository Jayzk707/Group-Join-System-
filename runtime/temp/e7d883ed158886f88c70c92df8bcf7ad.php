<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:34:"template/website/center/index.html";i:1674397830;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
<body class="layui-layout-body">
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
              <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
          </li>
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <input type="text" placeholder="搜索..." autocomplete="off" class="layui-input layui-input-search" layadmin-event="serach" lay-action="template/search.html?keywords="> 
          </li>
        </ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
          <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen">
              <i class="layui-icon layui-icon-screen-full"></i>
            </a>
          </li>
          <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
              <cite><?php echo session("uphone"); ?></cite>
            </a>
            <dl class="layui-nav-child">
				<dd><a lay-href="<?php echo url("users/logs"); ?>">登录日志</a></dd>
              <dd><a lay-href="<?php echo url("users/password"); ?>">修改密码</a></dd>
              <hr>
              <dd style="text-align: center; position:cursor;"><a class="outlogin" href="javascript:void(0)">退出</a></dd>
            </dl>
          </li>
		 
        </ul>
      </div>
      
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="<?php echo url('center/home'); ?>">
            <span><?php echo $subweb['oaname']; ?></span>
          </div>
          
          <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
              <a href="javascript:;" lay-tips="主页" lay-direction="2">
                <i class="layui-icon layui-icon-home"></i>
                <cite>主页</cite>
              </a>
              <dl class="layui-nav-child">
                <dd data-name="console" class="layui-this">
                  <a lay-href="<?php echo url('center/home'); ?>">数据总览</a>
                </dd>
              </dl>
            </li>
			<?php if(is_array($__NAV__) || $__NAV__ instanceof \think\Collection || $__NAV__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navs): $mod = ($i % 2 );++$i;if($navs['number'] == 0): ?>
					<li data-name="<?php echo $navs['ns_title']; ?>" class="layui-nav-item">
						<a href="javascript:;" lay-href="<?php echo url($navs['ns_controller'].'/'.$navs['ns_method']); ?>" lay-tips="<?php echo $navs['ns_title']; ?>" lay-direction="2">
							<i class="layui-icon <?php if(empty($navs['ns_icon'])): ?>layui-icon-auz<?php else: ?><?php echo $navs['ns_icon']; endif; ?>"></i>
							<cite><?php echo $navs['ns_title']; ?></cite>
						</a>
					</li>
				<?php else: ?>
					<li data-name="<?php echo $navs['ns_title']; ?>" class="layui-nav-item ">
					  <a href="javascript:;" lay-tips="<?php echo $navs['ns_title']; ?>" lay-direction="2">
						<i class="layui-icon <?php if(empty($navs['ns_icon'])): ?>layui-icon-auz<?php else: ?><?php echo $navs['ns_icon']; endif; ?>"></i>
						<cite><?php echo $navs['ns_title']; ?></cite>
					  </a>
					  <dl class="layui-nav-child">
						<?php if(is_array($navs['data']) || $navs['data'] instanceof \think\Collection || $navs['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $navs['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navs_two): $mod = ($i % 2 );++$i;?>
						<dd data-name="<?php echo $navs_two['ns_title']; ?>" ><a lay-href="<?php echo url($navs_two['ns_controller'].'/'.$navs_two['ns_method']); ?>"><?php echo $navs_two['ns_title']; ?></a></dd>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					  </dl>
					</li>
				<?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
              <a href="javascript:;"></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          </ul>
        </div>
        <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="<?php echo url('center/home'); ?>" lay-attr="<?php echo url('center/home'); ?>" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
          </ul>
        </div>
      </div>

      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="<?php echo url('center/home'); ?>" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
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
	$(".outlogin").click(function(){
		$.ajax({
			type:"POST",
			url:"<?php echo url('index/outlogin'); ?>",
			dataType:"json",
			data:{},
			success:function(res){
				if(res.status == "success"){
					layer.msg(res.data, {offset: '15px',icon: 1,time: 1000}, function(){
						location.href = '<?php echo url('index/Index'); ?>';
					});
				}else{
					layer.msg(res.data, {offset: '15px',icon: 2});
				}
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
		});
		
	});
  </script>
</body>
</html>