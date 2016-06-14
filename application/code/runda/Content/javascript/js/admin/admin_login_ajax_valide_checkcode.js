function checkCode(){
	if(($("#checkcode").val()).length == 4){
		var checkCode = $("#checkcode").val();
			//发异步请求验证验证码
			$.ajax({
				url: "/index.php?controller=Admin&method=checkCode&checkCode="+checkCode,
				type: "GET",
				dataType:"json",
				success: function(result,textStatus){
					if(textStatus == "success"){
						if(result.code == 200){
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