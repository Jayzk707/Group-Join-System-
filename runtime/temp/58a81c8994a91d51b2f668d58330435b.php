<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"template/fenxiao/distributiontixian/add.html";i:1674397797;s:66:"/www/wwwroot/jiandan.seecss.cn/template/fenxiao/common_header.html";i:1674397681;s:63:"/www/wwwroot/jiandan.seecss.cn/template/fenxiao/common_top.html";i:1674397681;s:66:"/www/wwwroot/jiandan.seecss.cn/template/fenxiao/common_footer.html";i:1674397681;}*/ ?>
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
    <div class="layui-card">
      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
        
        
        
        <div class="layui-form-item">
            <label class="layui-form-label">可提现金额</label>
            <div class="layui-input-block">
              <input name="title" type="text" disabled class="layui-input" id="title" readonly="readonly"   placeholder="可提现金额" value="<?php echo $info['du_money']; ?>">
            </div>
          </div>  
          
          <div class="layui-form-item">
            <label class="layui-form-label">提现金额</label>
            <div class="layui-input-block">
              <input name="money" type="number" class="layui-input" id="money"   placeholder="提现金额" value="0">
            </div>
          </div> 
          
          
		<div class="layui-form-item">
            <label class="layui-form-label">提现二维码</label>
			<input type="hidden" id="ico" name="ico" value="">
            <div class="layui-input-block">
 <div class="layui-upload">
  <button type="button" class="layui-btn" id="test1">上传图片</button>
  <div class="layui-upload-list">
    <img class="layui-upload-img" id="demo1" style="width:90px; height:90px;">
    <p id="demoText"></p>
  </div>
</div>  
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
layui.use(['upload', 'element', 'layer'], function(){
  var $ = layui.jquery
  ,upload = layui.upload
  ,element = layui.element
  ,layer = layui.layer;
  
  //常规使用 - 普通图片上传
  var uploadInst = upload.render({
    elem: '#test1'
    ,url: '<?php echo url('upload/uploadface'); ?>' //改成您自己的上传接口
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      //obj.preview(function(index, file, result){
      //  $('#demo1').attr('src', result); //图片链接（base64）
      //});
    }
    ,done: function(res){
      //如果上传失败
      if(res.success == "error"){
        return layer.msg('上传失败');
      }else{
		$("#ico").val(res.fileurl);
		$("#demo1").attr("src",res.fileurl);
		return layer.msg('上传完毕', {icon: 1});
	  }
	  
      //上传成功的一些操作
      //……
      $('#demoText').html(''); //置空上传失败的状态
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  });
  

});
</script>
<script>
$(".sub").click(function(){
	//if(!$(".btn").hasClass("sub")){return false;}
	var money   = $("#money").val();
    var ico     = $("#ico").val();
    
    
	if(money==""){
		show_error("提现金额不能为空!");
		return false;
	}
	
	if(money==0){
		show_error("提现金额不能为0!");
		return false;
	}
	
	if(ico==""){
		show_error("二维码不能为空！");
		return false;
	}
	
	if(money > <?php echo $info['du_money']; ?>){
		show_error("提现金额不能大于可提现金额!");
		return false;
	}

	$.ajax({
		type:"POST",
		url:"<?php echo url('distributiontixian/add'); ?>",
		dataType:"json",
		data:{
			money:money,
			dt_img:ico,
		},
		success:function(res){
			if(res.status == 1){
				window.parent.layer.closeAll();//关闭弹窗
				window.parent.location.reload();
				//show_toast_callurl(res.data,"<?php echo url('device/index'); ?>","success");
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
