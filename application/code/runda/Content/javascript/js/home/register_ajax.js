// $("#registerForm").submit(function (){
// 	// if(checkProtocol() && checkPassWord2() && checkAddr() && checkCheckcode2()){
// 		$("#register_stat").text("注册中...");
// 	    $.ajax({
// 	    	    url:"index.php?controller=Home&method=registerProc", //表单提交目标 
// 			    type:"post", //表单提交类型 
// 			    data:$(this).serialize(), //表单数据
// 			    async : true,
// 			    success:function(msg){
// 			    	var obj = eval('(' + msg + ')');
// 			    	if(obj.code == 200){
// 			    		$("#register_stat").text("注册成功,3秒后转去登录");
// 			    		setTimeout(function() {
// 			    			window.location.href="/index.php?controller=Home&method=login";
// 			    		}, 3500);
// 			    	}else{
// 			    		$("#register_stat").text("注册");
// 			    		// $("#errMes").text(obj.message);
// 			    		alert(obj.message);
// 			    	}
// 	     		} 
// 	    });
//     // }else{
//     // 	alert("表单填写错误");
//     // 	return false;
//     // }
// 	return false; //阻止表单的默认提交事件 
// });
$("#registerForm").submit(function (){
	// if(!checkProtocol() || !checkUserNmae() || !checkPhoneNumber()){// || !checkEmail()){
	if(!checkProtocol()){// || !checkEmail()){
	}else{
		$("#register_stat").text("注册中...");
	    $.ajax({
	    	    url:"index.php?controller=Home&method=registerProc", //表单提交目标 
			    type:"post", //表单提交类型 
			    data:$(this).serialize(), //表单数据
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		$("#register_stat").text("注册成功,3秒后转去登录");
			    		setTimeout(function() {
			    			window.location.href="/index.php?controller=Home&method=login";
			    		}, 3500);
			    	}else{
			    		$("#register_stat").text("注册");
			    		// $("#errMes").text(obj.message);
			    		alert(obj.message);
			    	}
	     		} 
	    });
    } 
	return false; //阻止表单的默认提交事件 
});