$("#ungroundingBarrelWaterGoods").submit(function (){
//	if($("#del_btn").val() == ""){
//		alert("用户id不能为空!");
//		return false;
//	}else{
		$("#ungrounding_btn").text("下架中...");
	    $.ajax({
	    	    url:"index.php?controller=WaterStore&method=unGroundingBarrelWaterGoods", //表单提交目标 
			    type:"post", //表单提交类型 
			    data:$(this).serialize(), //表单数据
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		alert(obj.message);
			    		setTimeout(function() {
			    			window.location.href="/index.php?controller=WaterStore&method=unGroundingBarrelWaterGoods";
			    		}, 1500);
			    	}else{
			    		alert(obj.message);
			    		$("#ungrounding_btn").text("下架所选");
			    	}
	     		},
	     		error: function (data, status, e){
	     			$("#ungrounding_btn").text("下架所选");
		            alert("系统错误,请重试");
	        	} 
	    });
//	} 
	return false; //阻止表单的默认提交事件 
});