$("#sendBroadCastForm").submit(function (){
	$("#res").hide();
	$("#send_btn").text("发送中...");
    $.ajax({
    	    url:"index.php?controller=Admin&method=sendBroadCastPush", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "200"){
		    		$("#send_btn").text("发送");
		    		// $("#res").text(obj.message);
		    		$("#res").text("发送成功");
		    		$("#res").show();
		    		// setTimeout(function() {
		    		// 	$("#res").hide();
		    		// }, 4000);
		    		// window.location.reload();
		    	}else{
		    		$("#send_btn").text("发送");
		    		$("#res").text(obj.message);
		    		$("#res").show();
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});