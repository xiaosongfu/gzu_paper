$("#uploadBarrelWaterForm").submit(function (){
	$("#up_stat").text("提交中...");
	editor.sync();
    $.ajax({
    	    url:"/index.php?controller=WaterStore&method=uploadBarrelWaterProc", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    		// alert(msg);
		    	var obj = eval('(' + msg + ')');
//		    	alert(obj.code);
		    	if(obj.code == "200"){
		    		// alert(obj.message);
		    		// alert("ok");
		    		$("#up_stat").text("上传成功");
		    		setTimeout(function() {
		    			window.location.href="index.php?controller=WaterStore&method=getAllBarrelWaterGoods";
		    		}, 1500);
		    	}else{
		    		// alert("dsfds");
		    		$("#up_stat").text("点击确定上传桶装水");
		    		alert(obj.message);
		    	}
     		},
     		error: function (data, status, e){
	            $("#up_stat").text("点击确定上传桶装水");
	            alert("系统错误,请重试");
        	} 
    }); 
	return false; //阻止表单的默认提交事件 
});