/*
不支持回调
*/
function show_toast(content,type="error",time=2000)
{
	spop({
		template: content,
		group: 'submit-satus',
		style: type,
		autoclose: time
	});
}


/*
支持回调url
*/
function show_toast_callurl(content,url,type="error",time=2000)
{
	spop({
		template: content,
		group: 'submit-satus',
		style: type,
		autoclose: time,
		onClose: function() {
			window.location = url
		}
	});
}

/*
用于跳转
*/
function callurl(url)
{
	window.location = url;
}

/*
用于删除
*/
function calldel(url,id)
{
	$modal({
           type: 'confirm', //弹框类型  'alert' or  'confirm' or 'message'   message提示(开启之前如果之前含有弹框则清除)
           icon: 'warning', // 提示图标显示 'info' or 'success' or 'warning' or 'error'  or 'question' 
           title:'提示', // 提示文字
           content: '您确定删除此数据吗!', // 提示文字
           transition: 300, //过渡动画 默认 200   单位ms
           //closable: true, // 是否显示可关闭按钮  默认为 false
           mask:true, // 是否显示遮罩层   默认为 false
           pageScroll: false, // 是否禁止页面滚动
           width:500, // 单位 px 默认显示宽度 最下默认为300
           maskClose:true, // 是否点击遮罩层可以关闭提示框 默认为false
           cancelText:'取消',// 取消按钮 默认为 取消
           confirmText:'确认',// 确认按钮 默认未 确认
		   cancel:function(close){  // 回调函数  //  函数返回关闭事件 调用-关闭弹窗
               close() // 调用返回的 关闭弹框函数 才能关闭
           },
           confirm:function(close){ // 回调函数  //  函数返回关闭事件 调用-关闭弹窗
               /*提交删除*/
			   	$.ajax({
					type:"get",
					url:url,
					dataType:"json",
					data:{},
					success:function(res){
						if(res.status == "success"){
							show_toast(res.data,"success");
							$("#"+id).remove();
						}else{
							show_toast(res.data);
						}
					},
					error:function(jqXHR){
						console.log("Error: "+jqXHR.status);
					},
				});
			   /*提交删除*/
               close() // 调用返回的 关闭弹框函数 才能关闭
           }
    })	
	

}