// function submitForm(){
// 	if(!checkProtocol()){
// 	}else{
// 		document.getElementById('waterStoreEnterForm').submit();
// 	}
// }

function checkWaterStoreName(){
	var waterStoreName = $("#waterStoreName").val();
	// alert(waterStoreName);
	// index.php?controller=Admin&method=checkWaterStoreName
	$.ajax({
	    	    url:"index.php?controller=WaterStore&method=checkWaterStoreName&waterStoreName="+waterStoreName, //表单提交目标 
			    type:"get", //表单提交类型 
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		$("#wsn").text("ok");
			    		// setTimeout(function() {
			    		// 	window.location.href="/index.php?controller=WaterStore&method=waterStoreEnter&step=three";
			    		// }, 1500);
			    	}else{
		            	$("#wsn").text(obj.message);
			    		// alert(obj.message);
			    	}
	     		},
	     		error: function (data, status, e){
		            $("#wsn").text("*");
		            alert("系统错误,请重试");
	        	} 
	    });
}


$("#waterStoreEnterForm").submit(function (){
	if(checkProtocol()){
		$("#enterBtn").text("提交中...");
	    $.ajax({
	    	    url:"index.php?controller=WaterStore&method=waterStoreEnterProc", //表单提交目标 
			    type:"post", //表单提交类型 
			    data:$(this).serialize(), //表单数据
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		$("#enterBtn").text("提交成功,3秒后跳转");
			    		setTimeout(function() {
			    			window.location.href="/index.php?controller=WaterStore&method=waterStoreEnter&step=three";
			    		}, 1500);
			    	}else{
		            	$("#enterBtn").text("确定入驻");
			    		alert(obj.message);
			    	}
	     		},
	     		error: function (data, status, e){
		            $("#enterBtn").text("确定入驻");
		            alert("系统错误,请重试");
	        	} 
	    });
	} 
	return false; //阻止表单的默认提交事件 
});