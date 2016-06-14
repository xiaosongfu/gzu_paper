$("#addBarrelWaterForm").submit(function (){
	if($("#userId").val() == ""){
		alert("用户id不能为空!");
		return false;
	}else{
		$("#add_btn").text("提交中...");
	    $.ajax({
	    	    url:"index.php?controller=WaterStore&method=addWaterBearer&action=add", //表单提交目标 
			    type:"post", //表单提交类型 
			    data:$(this).serialize(), //表单数据
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		$("#add_btn").text("添加成功");
			    		setTimeout(function() {
			    			window.location.href="/index.php?controller=WaterStore&method=addWaterBearer";
			    		}, 1500);
			    	}else{
		            	$("#add_btn").text("确定添加");
			    		alert(obj.message);
			    	}
	     		},
	     		error: function (data, status, e){
		            $("#add_btn").text("确定添加");
		            alert("系统错误,请重试");
	        	} 
	    });
	} 
	return false; //阻止表单的默认提交事件 
});