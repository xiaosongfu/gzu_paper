$("#loginFormWithUserName").submit(function (){
	$("#login_stat").text("登录中...");
    $.ajax({
    	    url:"index.php?controller=Home&method=loginProc&tokenType=userName", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "444"){
		    		document.getElementById("errMes").style.display="none";
		    		document.getElementById("lock").style.display="block";
		    		$("#login_stat").text("登录");
		    	}else if(obj.code == "200"){
		    		$("#login_stat").text("登录成功");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Home&method=personPage";
		    		}, 1500);
		    	}else{
		    		$("#login_stat").text("登录");
		    		$("#errMes").text(obj.message);
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});

//
function checkC(){
	if(($("#checkcode").val()).length == 4){
		var checkCode = $("#checkcode").val();
			//发异步请求验证验证码
		$.ajax({
			url: "/index.php?controller=Home&method=checkCode&checkCode="+checkCode,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					if(result.code == "200"){
						$("#checkErr").text("ok");
					}else{
						$("#checkErr").text(result.message);
					}
				}else{
						$("#checkErr").text("请求失败");
				}
	  		},
	  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
	            $("#checkErr").text("服务器错误 请重试"); 
	        }
		});
	}
}
//
$("#loginFormWithPhone").submit(function (){
	$("#login_stat2").text("登录中...");
    $.ajax({
    	    url:"index.php?controller=Home&method=loginProc&tokenType=phone", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "444"){
		    		document.getElementById("errMes2").style.display="none";
		    		document.getElementById("lock2").style.display="block";
		    		$("#login_stat2").text("登录");
		    	}else if(obj.code == "200"){
		    		$("#login_stat2").text("登录成功");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Home&method=personPage";
		    		}, 1500);
		    	}else{
		    		$("#login_stat2").text("登录");
		    		$("#errMes2").text(obj.message);
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});

function checkC2(){
	if(($("#checkcode2").val()).length == 4){
		var checkCode = $("#checkcode2").val();
			//发异步请求验证验证码
		$.ajax({
			url: "/index.php?controller=Home&method=checkCode&checkCode="+checkCode,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					if(result.code == 200){
						$("#checkErr2").text("ok");
					}else{
						$("#checkErr2").text(result.message);
					}
				}else{
						$("#checkErr2").text("请求失败");
				}
	  		},
	  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
	            $("#checkErr2").text("服务器错误 请重试"); 
	        }
		});
	}
}
