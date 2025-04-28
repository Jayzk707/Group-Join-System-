<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:35:"template/group/index/share_img.html";i:1680113132;}*/ ?>
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
	</head>
	<body>
	    
<style>
.idjshow{width:94%; height:30px; background:#000;opacity:0.8; border-radius: 15px; line-height:30px; color:#FFF; text-align:center; margin-left:auto; margin-right:auto; z-index:99999; position:fixed; top:20px; left:3%}
</style>
<div id="idjshow"></div>



	<div style="width:100%;">
	    <img src="<?php echo $info['wxg_img']; ?>" style="width:100%;">
	</div>

	<button class="qunbtn" onClick="btnfun()" id="qunbtn"><?php echo $info['wxg_buttitle']; ?></button>
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