function show_error(title)
{
	 window.parent.layer.msg(title, {offset: '15px',icon: 2});
}

function show_success(title)
{
	window.parent.layer.msg(title, {offset: '15px',icon: 1});
}

function show_toast_callurl(title,url)
{
	window.parent.layer.msg(title, {offset: '15px',icon: 1,time: 1000}, function(){location.href = url;});
}

/*
状态处理
*/
function callstatus(url,statu)
{
	$.ajax({
		type:"get",
		url:url,
		dataType:"json",
		data:{status:statu},
		success:function(res){
			if(res.status == 1){
				show_success(res.msg,"success");
			}else{
				show_error(res.msg);
			}
			//layer.close(layer.index);
			//window.parent.layer.close(layer.index);
		},
		error:function(jqXHR){
			console.log("Error: "+jqXHR.status);
		},
    });
}

/*
用于跳转
*/
function callurl(url)
{
	window.location = url;
}


function calldz(url,id)
{
	layer.confirm('您确定此帐单要对帐吗!', {
	  btn: ['确定','取消'] //按钮
	}, function(){
	  //layer.msg('的确很重要', {icon: 1});
        /*提交删除*/
        $.ajax({
			type:"get",
			url:url,
			dataType:"json",
			data:{},
			success:function(res){
				if(res.status == 1){
					show_success(res.msg,"success");
				}else{
					show_error(res.msg);
				}
				layer.close(layer.index);
				//window.parent.layer.close(layer.index);
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
        });
        /*提交删除*/
	}, function(){

	});
}



function calldel(url,id)
{
	layer.confirm('您确定删除此数据吗!', {
	  btn: ['确定','取消'] //按钮
	}, function(){
	  //layer.msg('的确很重要', {icon: 1});
        /*提交删除*/
        $.ajax({
			type:"get",
			url:url,
			dataType:"json",
			data:{},
			success:function(res){
				if(res.status == 1){
					show_success(res.msg,"success");
					$("#"+id).remove();
				}else{
					show_error(res.msg);
				}
				layer.close(layer.index);
				//window.parent.layer.close(layer.index);
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
        });
        /*提交删除*/
	}, function(){

	});
}

/*
多选删除
*/
function callmultidel(url)
{
	var ids  = "";
	$.each($('input:checkbox'),function(){
		if(this.checked){
			ids += $(this).val()+",";
		}
	})	  
	if(ids==""){
		show_error("ERROR：请先选择要删除的内容！");
		return false
	}

	layer.confirm('您确定删除此数据吗，确定后无法恢复!', {
	  btn: ['确定','取消'] //按钮
	}, function(){
	  //layer.msg('的确很重要', {icon: 1});
        /*提交删除*/
        $.ajax({
			type:"get",
			url:url,
			dataType:"json",
			data:{
				id:ids,
				act:"multi",
			},
			success:function(res){
				if(res.status == 1){
					show_success(res.msg,"success");
					window.location.reload();
				}else{
					show_error(res.msg);
				}
				layer.close(layer.index);
			},
			error:function(jqXHR){
				console.log("Error: "+jqXHR.status);
			},
        });
        /*提交删除*/
	}, function(){

	});
}