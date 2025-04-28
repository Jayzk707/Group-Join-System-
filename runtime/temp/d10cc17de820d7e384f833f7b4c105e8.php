<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:33:"template/website/paylist/add.html";i:1674397836;s:62:"/home/www/wwwroot/demotest/template/website/common_header.html";i:1674397684;s:59:"/home/www/wwwroot/demotest/template/website/common_top.html";i:1674397684;s:62:"/home/www/wwwroot/demotest/template/website/common_footer.html";i:1674397684;}*/ ?>
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
            <label class="layui-form-label">支付名称</label>
            <div class="layui-input-block">
              <input name="title" type="text" class="layui-input" id="title"   placeholder="支付名称">
            </div>
          </div>  
          
          <div class="layui-form-item">
            <label class="layui-form-label">支付编码</label>
            <div class="layui-input-block">
              <input name="code" type="text" class="layui-input" id="code"   placeholder="支付编码" >
            </div>
          </div> 
          
		<div class="layui-form-item">
            <label class="layui-form-label">支付图标</label>
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
          
          <div class="layui-form-item">
            <label class="layui-form-label">支付网址</label>
            <div class="layui-input-block">
              <input name="url" type="text" class="layui-input" id="url"   placeholder="支付网址">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
              <input name="content" type="text" class="layui-input" id="content"   placeholder="备注">
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">参数说明</label>
            <div class="layui-input-block">
            <textarea name="actname" id="actname" class="layui-input"  cols="" rows=""></textarea>
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" checked="">
              <input type="radio" name="status" value="2" title="禁用">
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
    ,url: '<?php echo url('upload/uploadpayico'); ?>' //改成您自己的上传接口
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
	var title   = $("#title").val();
	var ico     = $("#ico").val();
	var url     = $("#url").val();
	var content = $("#content").val();
	var code    = $("#code").val();
	var actname = $("#actname").val();
	var status  = $("input[name='status']:checked").val();

	
	if(title==""){
		show_error("支付名称不能为空!");
		return false;
	}
	
	if(code==""){
		show_error("支付编码不能为空!");
		return false;
	}
	
	if(actname==""){
		show_error("参数说明不能为空!");
		return false;
	}	
	
	$.ajax({
		type:"POST",
		url:"<?php echo url('paylist/add'); ?>",
		dataType:"json",
		data:{
			title:title,
			ico:ico,
			url:url,
			content:content,
			status:status,
			code:code,
			actname:actname,
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
