<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/website/center/home.html";i:1674397830;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta charset="utf-8">
  <title><?php echo $subweb['oaname']; ?></title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/template/layuiadmin/layui/css/layui.css" media="all">
<link rel="stylesheet" href="/template/layuiadmin/style/admin.css" media="all">
<link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.15.1/css/all.css" rel="stylesheet">
<script src="https://cdn.bootcdn.net/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
	<style>
	.action{border:1px solid #090; color:#090; font-weight:bolder;}
	</style>
</head>
<body>


<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
	
	<div class="layui-col-md12">

            <div class="layui-card">
              <div class="layui-card-body">               
				<div class="layui-carousel layadmin-carousel layadmin-backlog">
                    <ul class="layui-row layui-col-space10">
					
                      <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>当天销售额</h3>
                          <p><cite><?php echo round($d_money_count,2); ?></cite></p>
                        </a>
                      </li>
					  
					  <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>当天订单量</h3>
                          <p><cite><?php echo $d_bill_count; ?></cite></p>
                        </a>
                      </li>
					  
					  
					  <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>当天新用户数</h3>
                          <p><cite><?php echo $d_user_count; ?></cite></p>
                        </a>
                      </li>
					  
					  <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>总销售额</h3>
                          <p><cite><?php echo round($z_money_count,2); ?></cite></p>
                        </a>
                      </li>
                      
					  <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>总订单量</h3>
                          <p><cite><?php echo $z_bill_count; ?></cite></p>
                        </a>
                      </li>
                      
					  <li class="layui-col-xs4">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>总用户数</h3>
                          <p><cite><?php echo $z_user_count; ?></cite></p>
                        </a>
                      </li>
					  
                    </ul>

                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
  
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
	<div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-body">               
			

<div id="container" style="height: 460px"></div>


              
              </div>
            </div>
      </div>
    </div>
  </div>
  
  
  
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">

	
    <div class="layui-col-md3">
        <!-- 1 -->
        <div class="layui-card">
            <div class="layui-card-header">日排行</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <thead>
                        <tr>
                            <th>分站名称</th>
                            <th>今日收款</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php if(is_array($bill_day) || $bill_day instanceof \think\Collection || $bill_day instanceof \think\Paginator): $i = 0; $__LIST__ = $bill_day;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['su_title']; ?></td>
                            <td><?php echo round($vo['zj'],2); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table> 
            </div>
        </div>
        <!-- 1 -->
    </div>


    <div class="layui-col-md3">
        <!-- 1 -->
        <div class="layui-card">
            <div class="layui-card-header">近7天排行</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <thead>
                        <tr>
                            <th>分站名称</th>
                            <th>周收款</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php if(is_array($bill_week) || $bill_week instanceof \think\Collection || $bill_week instanceof \think\Paginator): $i = 0; $__LIST__ = $bill_week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['su_title']; ?></td>
                            <td><?php echo round($vo['zj'],2); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table> 
            </div>
        </div>
        <!-- 1 -->
    </div>
    
    
    
    <div class="layui-col-md3">
        <!-- 1 -->
        <div class="layui-card">
            <div class="layui-card-header">本月排行</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <thead>
                        <tr>
                            <th>分站名称</th>
                            <th>月收款</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php if(is_array($bill_moon) || $bill_moon instanceof \think\Collection || $bill_moon instanceof \think\Paginator): $i = 0; $__LIST__ = $bill_moon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['su_title']; ?></td>
                            <td><?php echo round($vo['zj'],2); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table> 
            </div>
        </div>
        <!-- 1 -->
    </div>
    
    
    
    <div class="layui-col-md3">
        <!-- 1 -->
        <div class="layui-card">
            <div class="layui-card-header">总排行</div>
            <div class="layui-card-body">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <thead>
                        <tr>
                            <th>分站名称</th>
                            <th>总收款</th>
                        </tr> 
                    </thead>
                    <tbody>
                        <?php if(is_array($bill_z) || $bill_z instanceof \think\Collection || $bill_z instanceof \think\Paginator): $i = 0; $__LIST__ = $bill_z;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['su_title']; ?></td>
                            <td><?php echo round($vo['zj'],2); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table> 
            </div>
        </div>
        <!-- 1 -->
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
  <script type="text/javascript" src="/echarts.min.js"></script>
  <script type="text/javascript">
    var dom = document.getElementById('container');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    const colors = ['#5470C6', '#EE6666'];
option = {
  color: colors,
  tooltip: {
    trigger: 'none',
    axisPointer: {
      type: 'cross'
    }
  },
  legend: {},
  grid: {
    top: 70,
    bottom: 50
  },
  xAxis: [
    {
      type: 'category',
      axisTick: {
        alignWithLabel: true
      },
      axisLine: {
        onZero: false,
        lineStyle: {
          color: colors[1]
        }
      },
      axisPointer: {
        label: {
          formatter: function (params) {
            return (
              '订单量  ' +
              params.value +
              (params.seriesData.length ? '：' + params.seriesData[0].data : '')
            );
          }
        }
      },
    data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        '<?php echo $vo['date']; ?>',
        <?php endforeach; endif; else: echo "" ;endif; ?>
    ]
    },
    {
      type: 'category',
      axisTick: {
        alignWithLabel: true
      },
      axisLine: {
        onZero: false,
        lineStyle: {
          color: colors[0]
        }
      },
      axisPointer: {
        label: {
          formatter: function (params) {
            return (
             '销售额  ' +
              params.value +
              (params.seriesData.length ? '：' + params.seriesData[0].data : '')
            );
          }
        }
      },
    data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        '<?php echo $vo['date']; ?>',
        <?php endforeach; endif; else: echo "" ;endif; ?>
    ]
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    {
      name: '销售额',
      type: 'line',
      xAxisIndex: 1,
      smooth: true,
      emphasis: {
        focus: 'series'
      },
      data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <?php echo round($vo['money'],2); ?>,
        <?php endforeach; endif; else: echo "" ;endif; ?>
          ]
    },
    {
      name: '订单量',
      type: 'line',
      smooth: true,
      emphasis: {
        focus: 'series'
      },
      data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <?php echo round($vo['usercount'],2); ?>,
        <?php endforeach; endif; else: echo "" ;endif; ?>
      ]
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>
</body>
</html>