$("#changeForm").submit(function (){
	$("#change_stat").text("更改中...");
    $.ajax({
    	    url:"index.php?controller=WaterStore&method=changewaterStoreStatus", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "200"){
		    		$("#result").html("更新成功,正在刷新");
		    		$("#result").show();
		    		setTimeout(function() {
		    			window.location.reload();
		    		}, 1000);
		    	}else{
		    		$("#result").html("更新失败");
		    		$("#result").show();
		    		$("#change_stat").text("更改");
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});
