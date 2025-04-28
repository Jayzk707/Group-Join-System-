<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/website/setup/index.html";i:1690564954;s:61:"/www/wwwroot/www.521daima.com/template/website/common_header.html";i:1674397684;s:58:"/www/wwwroot/www.521daima.com/template/website/common_top.html";i:1674397684;s:61:"/www/wwwroot/www.521daima.com/template/website/common_footer.html";i:1674397684;}*/ ?>
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
    <div class="layui-card">
      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
        

        
        
        
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-内容管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text1" name="text1"  value="<?php echo $info['text1']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-内容模板</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text2" name="text2"  value="<?php echo $info['text2']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-分销会员</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text3" name="text3"  value="<?php echo $info['text3']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-分销群组</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text4" name="text4"  value="<?php echo $info['text4']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-帐单记录</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text5" name="text5"  value="<?php echo $info['text5']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-点卡记录</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text6" name="text6"  value="<?php echo $info['text6']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-扣点记录</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text7" name="text7"  value="<?php echo $info['text7']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-对帐管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text8" name="text8"  value="<?php echo $info['text8']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-提现管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text9" name="text9"  value="<?php echo $info['text9']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-支付设置</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text10" name="text10"  value="<?php echo $info['text10']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-分站管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text15" name="text15"  value="<?php echo $info['text15']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-抽佣记录</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text16" name="text16"  value="<?php echo $info['text16']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分站-佣金提现</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text17" name="text17"  value="<?php echo $info['text17']; ?>">
            </div>
          </div>
          
          
          
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分销-内容管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text11" name="text11"  value="<?php echo $info['text11']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">分销-内容模板</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text12" name="text12"  value="<?php echo $info['text12']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分销-帐单记录</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text13" name="text13"  value="<?php echo $info['text13']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">分销-提现管理</label>
            <div class="layui-input-block">
                <input  type="text" class="layui-input" id="text14" name="text14"  value="<?php echo $info['text14']; ?>">
            </div>
          </div>

		  
         <div class="layui-form-item layui-layout-admin">
              <div class="layui-footer" style="left: 0;">
                <div class="layui-btn sub">立即提交</div>
                <button type="reset" class="layui-btn layui-btn-primary ">重置</button>
              </div>
          </div>
        </form>
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
$(".sub").click(function(){
	//if(!$(".btn").hasClass("sub")){return false;}
	var appid     = $("#appid").val();
	var appsecret = $("#appsecret").val();
	var mchid     = $("#mchid").val();
	var apikey    = $("#apikey").val();

    var zfbappid    = $("#zfbappid").val();
    var zfbskey    = $("#zfbskey").val();
    var zfbgkey    = $("#zfbgkey").val();

    var text1    = $("#text1").val();
    var text2    = $("#text2").val();
    var text3    = $("#text3").val();
    var text4    = $("#text4").val();
    var text5    = $("#text5").val();
    var text6    = $("#text6").val();
    var text7    = $("#text7").val();
    var text8    = $("#text8").val();
    var text9    = $("#text9").val();
    var text10    = $("#text10").val();
    var text11    = $("#text11").val();
    var text12    = $("#text12").val();
    var text13    = $("#text13").val();
    var text14    = $("#text14").val();
    
    var text15    = $("#text15").val();
    var text16    = $("#text16").val();
    var text17    = $("#text17").val();
    
    var dkgg_content    = $("#dkgg_content").val();
    var zfbopen  = $("input[name='zfbopen']:checked").val();
 var wxopen  = $("input[name='wxopen']:checked").val();
    
	if(appid==0){
		show_error("appid不能为空!");
		return false;
	}
	
	if(appsecret==""){
		show_error("appsecret不能为空!");
		return false;
	}
	
	if(mchid == ""){
		show_error("商户号不能为空");
		return false;
	}
	
	
	if(apikey == ""){
		show_error("商户秘钥不能为空");
		return false;
	}

	
	$.ajax({
		type:"POST",
		url:"<?php echo url('setup/edit'); ?>",
		dataType:"json",
		data:{
			appid:appid,
			appsecret:appsecret,
			mchid:mchid,
			apikey:apikey,
			zfbappid:zfbappid,
			zfbskey:zfbskey,
			zfbgkey:zfbgkey,
			
			text1:text1,
			text2:text2,
			text3:text3,
			text4:text4,
			text5:text5,
			text6:text6,
			text7:text7,
			text8:text8,
			text9:text9,
			text10:text10,
			text11:text11,
			text12:text12,
			text13:text13,
			text14:text14,
			text15:text15,
			text16:text16,
			text17:text17,
			dkgg_content:dkgg_content,
			zfbopen:zfbopen,
			wxopen:wxopen,
		},
		success:function(res){
			if(res.status == 1){
				show_toast_callurl(res.data,"<?php echo url('setup/index'); ?>","success");
			}else{
				show_error(res.msg);
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
