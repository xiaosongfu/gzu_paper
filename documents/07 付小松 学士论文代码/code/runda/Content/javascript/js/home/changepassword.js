$("#formCode").submit(function (){
	//邮箱格式不对
	var rej= /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
	var email = $("#email").val();
	if(!rej.test(email)){
		alert("邮箱格式不对");
		return false;
	}
	$("#getCode").text("获取中...");
	document.getElementById("res_box").style.display = "none";
	
    $.ajax({
    	    url:"index.php?controller=Home&method=changePasswordProc", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code != 200){
		    		$("#res_box").text(obj.message);
		    	}else{
		    		$("#getCode").text("获取验证码");
		    		document.getElementById("next_box").style.display = "block";
		    	}
		    	// 	document.getElementById("errMes").style.display="none";
		    	// 	document.getElementById("lock").style.display="block";
		    	// 	$("#login_stat").text("登录");
		    	// }else if(obj.code == 200){
		    	// 	$("#login_stat").text("登录成功");
		    	// 	setTimeout(function() {
		    	// 		window.location.href="/index.php?controller=Home&method=personPage";
		    	// 	}, 1500);
		    	// }else{
		    	// 	$("#login_stat").text("登录");
		    	// 	$("#errMes").text(obj.message);
		    	// }
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});



$("#nextForm").submit(function (){
	//验证码不能为空
	var changePasswordCode = $("#changePasswordCode").val();
	if(changePasswordCode == ""){
		alert("验证码不能为空");
		return false;
	}
	$("#nextBut").text("验证中...");
    $.ajax({
    	    url:"index.php?controller=Home&method=changePassword&step=two", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code != 200){
		    		$("#next_res_box").text(obj.message);
		    		$("#nextBut").text("下一步");
		    	}else{
		    		$("#nextBut").text("验证成功");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Home&method=changePassword&step=three";
		    		}, 1500);
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});

$("#fourForm").submit(function (){
	//密码不能为空
	var password = $("#password").val();
	if(password == ""){
		alert("密码不能为空");
		return false;
	}
	$("#fourBtn").text("修改中...");
    $.ajax({
    	    url:"index.php?controller=Home&method=changePassword&step=four", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code != 200){
		    		$("#four_res_box").text(obj.message);
		    		$("#fourBtn").text("确认修改");
		    	}else{
		    		$("#fourBtn").text("修改成功,3秒后自动转到登录");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Home&method=login";
		    		}, 1500);
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});