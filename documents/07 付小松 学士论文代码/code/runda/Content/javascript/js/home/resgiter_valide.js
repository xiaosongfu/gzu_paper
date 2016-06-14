//验证用户名
function checkUserNmae(){
	var userName = $("#userName").val();
	if(userName == ""){
		$("#userNameErr").text("用户名不能为空");
		return ; 
	}
	var rej= /^[0-9a-zA-Z_]+$/;
	if(!rej.test(userName)){
		$("#userNameErr").text("用户名只能包含字母或数字或_");
		return ; 
	}
	if(userName.length > 40){
		$("#userNameErr").text("用户名过长");
		return ; 
	}
	//发异步请求验证用户名是否可用
	$.ajax({
		url: "/index.php?controller=Home&method=checkUserName&userName="+userName,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					$("#userNameErr").text(result.message);
				}else{
					$("#userNameErr").text(result.message);
				}
			}else{
					$("#userNameErr").text("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            $("#userNameErr").text("服务器错误 请重试"); 
        }
	});
}
//验证密码
function checkPassWord(){
	if(($("#password").val()).length < 6){
		$("#pwdErr").text("密码过短");
	}else if(($("#password").val()).length > 13){
		$("#pwdErr").text("密码过长");
	}else{
		$("#pwdErr").text("ok");
	}
}
function checkPassWord2(){
	if($("#password2").val() == $("#password").val()){
			$("#pwdErr2").text("ok");
			return true;
		}else{
			$("#pwdErr2").text("两次输入的密码不一致");
			return false;
		}
}
//验证电话号码
function checkPhoneNumber(){
	var rej= /^[1][3-8]\d{9}$/;
	var phoneNum = $("#phoneNumber").val();
	if(rej.test(phoneNum)){
		//发异步请求验证手机号是否已经被注册过
		$.ajax({
			url: "/index.php?controller=Home&method=checkPhoneNumber&phoneNumber="+phoneNum,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					if(result.code == 200){
						$("#phoneErr").text(result.message);
					}else{
						$("#phoneErr").text(result.message);
					}
				}else{
						$("#phoneErr").text("服务器错误 请重试");
				}
	  		},
	  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
	            $("#phoneErr").text("服务器错误 请重试"); 
	        }
		});
		// $("#phoneErr").text("ok");
		return true;
	}else{
		$("#phoneErr").text("格式不正确");
		return false;
	}
}
//验证邮箱
function checkEmail(){
	var email = $("#email").val();
	if(email != ""){
		var rej= /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
		document.getElementById("emailErr2").style.display = "none";
		if(rej.test(email)){
			//发异步请求验证邮箱是否已经注册
			$.ajax({
				url: "/index.php?controller=Home&method=checkEmail&email="+email,
				type: "GET",
				dataType:"json",
				success: function(result,textStatus){
					if(textStatus == "success"){
						if(result.code == 200){
							$("#emailErr").text("ok");
						}else if(result.code == 444){
							// $("#emailErr").text("444");
							// // $("#emailErr2").text(result.message);
							document.getElementById("emailErr2").style.display = "block";
						}else{
							$("#emailErr").text(result.message);
							document.getElementById("emailErr2").style.display = "none";
						}
					}else{
							$("#emailErr").text("服务器错误 请重试");
							document.getElementById("emailErr2").style.display = "none";
					}
		  		},
		  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
		            $("#emailErr").text("服务器错误 请重试"); 
		            document.getElementById("emailErr2").style.display = "none";
		        }
			});
			// $("#emailErr").text("ok");
			// return true;
		}else{
			document.getElementById("emailErr2").style.display = "none";
			$("#emailErr").text("格式不正确");
			return false;
		}
	}else{
		return false;
	}
}
//验证地址
function checkAddr(){
	if($("#detailAddress").val() == ""){
		$("#addErr").text("详细地址不能为空");
	}else{
		$("#addErr").text("ok");
	}
}
//验证验证码
function checkCheckcode(){
	if($("#checkCode").val() == ""){
		$("#checkErr").text("验证验不能为空");
	}else{
		if(($("#checkCode").val()).length == 4){
			var checkCode = $("#checkCode").val();
			//发异步请求验证验证码
			$.ajax({
				url: "/index.php?controller=Home&method=checkCode&checkCode="+checkCode,
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
		}else{
			$("#checkErr").text("验证验不正确");
		}
	}
}
function checkCheckcode2(){
	if($("#checkCode").val() == ""){
		return false;
	}else{
		return true;
	}
}
function checkProtocol(){
	if(document.getElementById("agreeProtocol").checked){
		return true;
	}else{
		alert("您必须要同意注册协议");
		return false;
	}
}