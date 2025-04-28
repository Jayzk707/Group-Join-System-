<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/fenxiao/center/home.html";i:1674397796;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_header.html";i:1674397682;s:59:"/home/www/wwwroot/demotest/template/fenxiao/common_top.html";i:1674397682;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_footer.html";i:1674397682;}*/ ?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	  <meta charset="utf-8">
  <title><?php echo session("du_name"); ?> <?php echo $subweb['oaname']; ?></title>
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
					
                      <li class="layui-col-xs6">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>当天销售额</h3>
                          <p><cite><?php echo round($d_money_count,2); ?></cite></p>
                        </a>
                      </li>
					  
					  <li class="layui-col-xs6">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>当天订单量</h3>
                          <p><cite><?php echo $d_bill_count; ?></cite></p>
                        </a>
                      </li>
					  
					  
					  <li class="layui-col-xs6">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>总销售额</h3>
                          <p><cite><?php echo round($z_money_count,2); ?></cite></p>
                        </a>
                      </li>
					  
					  <li class="layui-col-xs6">
						<a href="javascript:;" onclick="#" class="layadmin-backlog-body">
                          <h3>总订单量</h3>
                          <p><cite><?php echo $z_bill_count; ?></cite></p>
                        </a>
                      </li>
					  
                      
					  
                    </ul>

                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
  
	<style>
.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}
.alert-dismissible {
    padding-right: 4rem;
}
.alert {
    position: relative;
    padding: .75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: .25rem;
}
.fade {
    transition: opacity .15s linear;
}
	
	</style>
<div class="layui-fluid">
  <div class="layui-row layui-col-space15">
	<div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-body">               
<div class="alert alert-warning alert-dismissible fade show">
<?php if($z_money_count <=99): ?>
大哥加把劲啊，隔壁老王赚了钱晚上蹦迪都开黑桃A了，咱得干倒他啊
<?php elseif($z_money_count <=300): ?>
今天晚上加个菜，烧烤也能安排上了，争取明天来个火锅
<?php elseif($z_money_count <=500): ?>
大哥！晚上找个开凯迪拉克的兄弟洗浴中心走一趟，别想歪啊，就是去泡个澡放松放松，别去二楼
<?php elseif($z_money_count <=700): ?>
大哥！今天太猛了，你已经超过了70%的兄弟们了
<?php elseif($z_money_count <=1000): ?>
大哥！今天抽华子，说啥都得安排上！
<?php else: ?>
大哥牛逼，小弟没文化，只能希望大哥以后更牛逼！
<?php endif; ?>
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

    option = {
  xAxis: {
    type: 'category',
    data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        '<?php echo $vo['date']; ?>',
        <?php endforeach; endif; else: echo "" ;endif; ?>
    ]
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [
        <?php if(is_array($timg) || $timg instanceof \think\Collection || $timg instanceof \think\Paginator): $i = 0; $__LIST__ = $timg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <?php echo round($vo['money'],2); ?>,
        <?php endforeach; endif; else: echo "" ;endif; ?>
          ],
      type: 'bar',
      label: {
        show: true,
        position: 'inside'
      },
      
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