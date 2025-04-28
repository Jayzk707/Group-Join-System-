<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:31:"template/group/index/share.html";i:1697026246;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width,height=device-height, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="format-detection" content="telephone=no" />
		<title><?php echo $info['wxg_title']; ?></title>
		<link type="text/css" rel="stylesheet" href="/template/group/index/css.css"/>
		<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
        <style>
            .svvv table{width: 100%;}
            .svvv table img{width: 100%;}
        </style>
	</head>
	<body>
	    
<style>
.idjshow{width:94%; height:30px; background:#000;opacity:0.8; border-radius: 15px; line-height:30px; color:#FFF; text-align:center; margin-left:auto; margin-right:auto; z-index:99999; position:fixed; top:20px; left:3%}
</style>
<div id="idjshow"></div>  
		<div class="qun"><img src="<?php echo $info['wxg_img']; ?>"/>
		<p class="quntit" id="quntit"><?php echo $info['wxg_title']; ?></p>
		<p class="num"><?php echo $info['wxg_subtitle']; ?></p>
		</div>
		
		<script>
		var titles = "<?php echo $info['wxg_title']; ?>";  /*获取后台设置群昵称*/
		var xhr = new XMLHttpRequest();
		console.log(titles);
        xhr.open("GET", "https://ipa.amenm.cn/", true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.code === 200) {
                var city = response.city;
                console.log(city);
                document.getElementById("quntit").innerText = city+titles; /*修改ID为quntit的参数 内容为后台设置变量以及定位合并*/
                document.title = city+titles;  /*同理 如果获取到定位则修改标题*/
              } else {
                console.log("无数值");
              }
            } else {
              console.log("请求失败");
            }
          }
        };
        xhr.send();
        </script>
		
		<div class="qunz">
		
		<div class="qunpeople">
			<div class="title2">群成员</div>
			<div class="peoplez">
            	<?php if(is_array($qccontent) || $qccontent instanceof \think\Collection || $qccontent instanceof \think\Paginator): $i = 0; $__LIST__ = $qccontent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="peoplef"><img src="/face/<?php echo $info['wxg_headfile']; ?>/<?php echo $vo['headimg']; ?>"/><p><?php echo $vo['nickname']; ?></p></div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="peoplef">
					<img src="/template/group/index/images/photoadd.jpg"/>
					<p></p>
				</div>

			</div>
		</div>
		

		
		<div class="qunstate"><div class="title"><?php echo $info['wxg_qjj_title']; ?></div><div class="qs"><a href=""><p><?php echo $info['wxg_qjj_content']; ?></p></a></div></div>

		<div class="qunstate">
			<div class="title"><?php echo $info['wxg_kuai_title']; ?></div>
            <?php if(is_array($content) || $content instanceof \think\Collection || $content instanceof \think\Paginator): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<div class="question">
				<p class="ad"><?php echo $vo['title']; ?></p>
				<p class="aw"><?php echo $vo['content']; ?></p>
			</div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		
		
		<?php if($info['wxg_kuai_title1'] !="" and $info['wxg_kuai_imgs1'] !=""): ?>
		<div class="qunfuli">
			<div class="title"><?php echo $info['wxg_kuai_title1']; ?></div>
			<div class="fuli svvv">
				<?php echo $info['wxg_kuai_imgs1']; ?>
			</div>
		</div>
		<?php endif; ?>
		
		
		<div class="yuedu">阅读<?php echo $info['wxg_redcount']; ?></div>
		<div class="qunicon">
		  <div class="qunicon1">
			<div class="icon1"><img src="/template/group/index/images/icon1.png"/><span>分享</span></div>
			<div class="icon1"><img src="/template/group/index/images/icon2.png"/><span>收藏</span></div>
		  </div>
		  <div class="qunicon1">
			<div class="icon1"><img src="/template/group/index/images/icon3.jpg"/><span><?php echo $info['wxg_dzcount']; ?></span></div>
			<div class="icon1"><img src="/template/group/index/images/icon4.jpg"/><span><?php echo $info['wxg_xxcount']; ?></span></div>
		  </div>
		</div>
		
	</div>
		<div class="qunliuyan">

			<div class="liuyantit">
				<p class="lyo">群友评论（精选）</p>
			</div>
			<?php if(is_array($qcontent) || $qcontent instanceof \think\Collection || $qcontent instanceof \think\Paginator): $i = 0; $__LIST__ = $qcontent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<div class="liuyanz">
				<img class="qleft" src="/face/<?php echo $info['wxg_headfile']; ?>/<?php echo $vo['headimg']; ?>"/>
				<div class="qcenter"><p class="nichen"><?php echo $vo['nickname']; ?></p><div class="liuyan"><?php echo $vo['title']; ?></div></div>
				<div class="qright"><img src="/template/group/index/images/icon3.png"/><p>赞：<?php echo $vo['count']; ?></p></div>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	
	<style>
	.qunbtn {
    position: fixed;
    width: 90%;
    margin-left: 5%;
    font-size: 1.2rem;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
    border-radius: 0.5rem;
    background-color: #ff9800;
    bottom: 0.4rem;
}

</style>
	<!--<button class="qunbtn" onClick="btnfun()" id="qunbtn"><?php echo $info['wxg_buttitle']; ?></button>
	
	<button class="qunbtnss" id="qunbtn" onclick="location='这里填跳转链接'">招收代理</button>-->
	
	<p class="qunbtn" onClick="btnfun()" id="qunbtn"><?php echo $info['wxg_buttitle']; ?></p>
	
	<p class="qunbtnss" id="qunbtn" onclick="location='http://723376795/h5/banmidiaocha/#/pages/banmidiaocha/c_find?id=14'">招收代理</p>
	
	
	
	
	<div id="tzurlcontent"></div>
		<div class="xuanfu">
			<a href="<?php echo url('index/kefu',array('id'=>$info['wxg_id'])); ?>"><img class="kefu2" src="/template/group/index/images/service.gif"/></a>
		</div>
		
<script>
 var names = ["弘毅","李涛","豪哥","海阔天空","博文"];
 var names_count = names.length;
 var names_i = 0;

 setInterval(function(){
	
	if($("#idjjshow").is(':visible')){
		$("#idjshow").html("");
	}else{
		if(names_i == names_count-1){
			names_i = 0;
		}else{
			names_i = names_i + 1;
		}
		
		tmp_name = names[names_i];
		tmp_str  = '<div class="idjshow" id="idjjshow">'+tmp_name+'*** 刚刚支付了<?php echo $info['wxg_money']; ?>元</div>';
		$("#idjshow").html(tmp_str);
		
	}
	console.log(tmp_str);
 },1300); 
 
</script>
    <script>
        
        var qunbtn = "<?php echo $info['wxg_buttitle']; ?>";
        qunbtn = qunbtn.replace("[加粗]","<strong>")
        qunbtn = qunbtn.replace("[/加粗]","</strong>")
        qunbtn = qunbtn.replace("[加大+1]","<font size='+1'>")
        qunbtn = qunbtn.replace("[加大+2]","<font size='+2'>")
        qunbtn = qunbtn.replace("[加大+3]","<font size='+3'>")
        qunbtn = qunbtn.replace("[加大+4]","<font size='+4'>")
        qunbtn = qunbtn.replace("[加大+5]","<font size='+5'>")
        qunbtn = qunbtn.replace("[/加大]","</font>")
        $("#qunbtn").html(qunbtn);
        
        
        var titles = "<?php echo $info['wxg_title']; ?>";
        var citycode =returnCitySN.cname;
        titles = titles.replace("【本地】",citycode)
        $("#quntit").html(titles);
        $("title").html(titles);
    </script>
	<script>
	function btnfun(){
		$(".qunbtn").attr('disabled','disabled');
		$.ajax({
			type:"POST",
			url:"<?php echo url('index/paylist'); ?>",
			dataType:"json",
			data:{
				id:<?php echo $id; ?>,
			},
			success:function(res){
				if(res.status == 1){
					window.location.href = res.msg;
				}else if(res.status == 2){
				    $("#tzurlcontent").html(res.msg);
				    //alert();
				}else{
					show_error(res.msg);
				}
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
		});
	}						
	</script>
	</body>
</html>