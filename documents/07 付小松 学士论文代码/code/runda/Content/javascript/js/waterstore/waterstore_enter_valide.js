//验证水站名称
function checkWaterStoreName(){
	var val = $("#waterStoreName").val();
	if(val.length == 0 || val.length > 50 ){
		$("#wsn").text("请输入正确的水站名称");
	}else{
		$("#wsn").text("ok");
	}
}
//验证电话号码
function checkWaterStoreTellPhone(){
	var rej= /^[1][3-8]\d{9}$/;
	var phoneNum = $("#waterStoreTellPhone").val();
	if(rej.test(phoneNum)){
		$("#tel").text("ok");
		return true;
	}else{
		$("#tel").text("格式不正确");
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
//验证协议
function checkProtocol(){
	if(document.getElementById("agreeProtocol").checked){
		return true;
	}else{
		alert("您必须要同意注册协议");
		return false;
	}
}

// function checkFormData(){
// 	//checkCheckcode2()
// 	alert("您必须要同意注册协议");
// 	return true;
// }