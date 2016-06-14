$("#waterstoreauditform").submit(function (){
	$("#formbox").hide();
	$("#doingbox").show();

    $.ajax({
    	    url:"index.php?controller=Admin&method=waterStoreAuditProc", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "200"){
		    		$("#doingbox").text("审核成功,3秒后刷新");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Admin&method=waterStoreAudit";
		    		}, 1500);
		    	}else{
		    		// $("#login_stat").text("登录");
		    		// $("#errMes").text(obj.message);
		    		$("#doingbox").text(obj.message+",3秒后刷新");
		    		setTimeout(function() {
		    			$("#doingbox").hide();
						$("#formbox").show();
		    			// window.location.href="/index.php?controller=Admin&method=waterStoreAudit";
		    		}, 1500);
		    		// alert(obj.message);
		   //  		$("#doingbox").hide();
					// $("#formbox").show();
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});