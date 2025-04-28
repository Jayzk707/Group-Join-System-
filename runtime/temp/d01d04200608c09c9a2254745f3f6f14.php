<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:37:"template/fenxiao/wxgrouptmp/edit.html";i:1674397802;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_header.html";i:1674397682;s:59:"/home/www/wwwroot/demotest/template/fenxiao/common_top.html";i:1674397682;s:62:"/home/www/wwwroot/demotest/template/fenxiao/common_footer.html";i:1674397682;}*/ ?>
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
	<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>

  <div class="layui-fluid">
    <div class="layui-card">
      <div class="layui-card-body" style="padding: 15px;">
        <form class="layui-form" action="" lay-filter="component-form-group">
        
        
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
  <ul class="layui-tab-title">
    <li class="layui-this">基础设置</li>
    <li>内容设置</li>
    <li>展示广告</li>
  </ul>
  <div class="layui-tab-content" >
    <div class="layui-tab-item layui-show">  
        
        
        <div class="layui-form-item">
            <label class="layui-form-label">头像库选择</label>
            <div class="layui-input-block">
				<select name="headimg" id="headimg">
                    <option value="qq" <?php if($info['wxgt_headfile']=="qq"): ?>selected<?php endif; ?>>扩列，交友，吃瓜</option>
                    <option value="za" <?php if($info['wxgt_headfile']=="za"): ?>selected<?php endif; ?>>综合随机</option>
				</select>
            </div>
          </div> 
        
        
        
		<div class="layui-form-item">
            <label class="layui-form-label">群组头像</label>
			<input type="hidden" id="wxgt_headimg" name="wxgt_headimg" value="<?php echo $info['wxgt_img']; ?>">
            <div class="layui-input-block">
 <div class="layui-upload">
  <button type="button" class="layui-btn" id="test1">上传图片</button>
  <div class="layui-upload-list">
    <img class="layui-upload-img" src="<?php echo $info['wxgt_img']; ?>" id="demo1" style="width:60px; height:60px;">
    <p id="demoText"></p>
  </div>
</div>  
            </div>
          </div> 
          
          <div class="layui-form-item">
            <label class="layui-form-label">入群费用</label>
            <div class="layui-input-block">
              <input name="money" type="number"  class="layui-input" id="money" placeholder="入群费用" value="<?php echo $info['wxgt_money']; ?>">
            </div>
          </div> 
             
        
        <div class="layui-form-item">
            <label class="layui-form-label">群名称</label>
            <div class="layui-input-block">
              <input name="title" type="text"  class="layui-input" id="title" placeholder="群名称" value="<?php echo $info['wxgt_title']; ?>">
            </div>
          </div>  
          

          
          <div class="layui-form-item">
            <label class="layui-form-label">副标题</label>
            <div class="layui-input-block">
              <input name="subtitle" type="text"  class="layui-input" id="subtitle" placeholder="副标题" value="<?php echo $info['wxgt_subtitle']; ?>">
            </div>
          </div> 
          

          
          <div class="layui-form-item">
            <label class="layui-form-label">阅读数</label>
            <div class="layui-input-block">
              <input name="redcount" type="text"  class="layui-input" id="redcount" placeholder="阅读数" value="<?php echo $info['wxgt_redcount']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">点赞数</label>
            <div class="layui-input-block">
              <input name="dzcount" type="number"  class="layui-input" id="dzcount" placeholder="点赞数" value="<?php echo $info['wxgt_dzcount']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">想看数</label>
            <div class="layui-input-block">
              <input name="xxcount" type="number"  class="layui-input" id="xxcount" placeholder="点赞数" value="<?php echo $info['wxgt_xxcount']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">按键名称</label>
            <div class="layui-input-block">
              <input name="buttitle" type="text"  class="layui-input" id="buttitle" placeholder="按键名称" value="<?php echo $info['wxgt_buttitle']; ?>">
            </div>
          </div>
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" value="1" title="启用" <?php if($info['wxgt_status']==1): ?>checked=""<?php endif; ?>>
              <input type="radio" name="status" value="2" title="禁用" <?php if($info['wxgt_status']==2): ?>checked=""<?php endif; ?>>
            </div>
          </div>
          
          
          
 	</div>
    <div class="layui-tab-item">  
          
          
          
         <div class="layui-form-item">
            <label class="layui-form-label">区块一标题</label>
            <div class="layui-input-block">
              <input name="qjj_title" type="text"  class="layui-input" id="qjj_title" placeholder="区块一标题" value="<?php echo $info['wxgt_qjj_title']; ?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">区块一内容</label>
            <div class="layui-input-block">
              <input name="qjj_content" type="text"  class="layui-input" id="qjj_content" placeholder="区块一内容" value="<?php echo $info['wxgt_qjj_content']; ?>">
            </div>
          </div>
          
          
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">区块二标题</label>
            <div class="layui-input-block">
              <input name="kuai_title" type="text"  class="layui-input" id="kuai_title" placeholder="区块二标题" value="<?php echo $info['wxgt_kuai_title']; ?>">
            </div>
          </div>
          
          
          
          <div class="layui-form-item">
            <label class="layui-form-label">区块二内容</label>
            <div class="layui-input-block">
              <textarea class="layui-input" name="kuai_content" id="kuai_content" style="height:180px;"><?php echo $info['wxgt_kuai_content']; ?></textarea>
            </div>
          </div>       
              
              
              
           <div class="layui-form-item">
            <label class="layui-form-label">区块三标题</label>
            <div class="layui-input-block">
              <input name="kuai_title1" type="text"  class="layui-input" id="kuai_title1" placeholder="区块三标题" value="<?php echo $info['wxgt_kuai_title1']; ?>">
            </div>
          </div>
          
          
		<div class="layui-form-item">
            <label class="layui-form-label">区块三图片</label>

            <div class="layui-input-block">
	<script id="editor" type="text/plain" style="width:100%;height:250px;"></script>

            </div>
          </div>   
              
              
              
          <div class="layui-form-item">
            <label class="layui-form-label">群友评论</label>
            <div class="layui-input-block">
              <textarea class="layui-input" name="qunyou_content" id="qunyou_content" style="height:180px;"><?php echo $info['wxgt_qunyou_content']; ?></textarea>
            </div>
          </div> 
          
          
 	</div>
    <div class="layui-tab-item">      
    


		<div class="layui-form-item">
            <label class="layui-form-label">客服二维码</label>
			<input type="hidden" id="wxgt_kefu" name="wxgt_kefu" value="<?php echo $info['wxgt_kefu']; ?>">
            <div class="layui-input-block">
 <div class="layui-upload">
  <button type="button" class="layui-btn" id="test3">上传图片</button>
  <div class="layui-upload-list">
    <img class="layui-upload-img" src="<?php echo $info['wxgt_kefu']; ?>" id="demo3" style="width:200px; height:200px;">
    <p id="demoText"></p>
  </div>
</div>  
            </div>
          </div> 


    
          
		<div class="layui-form-item">
            <label class="layui-form-label">广告二维码</label>
			<input type="hidden" id="wxgt_adurl" name="wxgt_adurl" value="<?php echo $info['wxgt_adurl']; ?>">
            <div class="layui-input-block">
 <div class="layui-upload">
  <button type="button" class="layui-btn" id="test2">上传图片</button>
  <div class="layui-upload-list">
    <img class="layui-upload-img" src="<?php echo $info['wxgt_adurl']; ?>" id="demo2" style="width:200px; height:200px;">
    <p id="demoText"></p>
  </div>
</div>  
            </div>
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

var ue = UE.getEditor('editor');
$(document).ready(function () {
    ue.ready(function () {
        ue.setContent('<?php echo $info['wxgt_kuai_imgs1']; ?>');
    });
});



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
		$("#wxgt_headimg").val(res.fileurl);
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
  
  
  //常规使用 - 普通图片上传
  var uploadInst = upload.render({
    elem: '#test2'
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
		$("#wxgt_adurl").val(res.fileurl);
		$("#demo2").attr("src",res.fileurl);
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
  
  
  
  
  //常规使用 - 普通图片上传
  var uploadInst = upload.render({
    elem: '#test3'
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
		$("#wxgt_kefu").val(res.fileurl);
		$("#demo3").attr("src",res.fileurl);
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
	
	$.ajax({
		type:"POST",
		url:"<?php echo url('wxgrouptmp/edit'); ?>",
		dataType:"json",
		data:{
			id:<?php echo $info['wxgt_id']; ?>,
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
