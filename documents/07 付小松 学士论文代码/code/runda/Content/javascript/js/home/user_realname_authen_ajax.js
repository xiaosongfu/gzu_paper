function checkidCardNumber(){
	var idcard = $("#idCardNumberID").val();
	var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;  
   if(reg.test(idcard) === false){  
   	   $("#idc").text("身份证输入不合法");
       return  false;  
   }else{
   	   $("#idc").text("ok");
   	   return true;
   }

	// var rej= /^[0-9a-zA-Z_]+$/;
	// if(!rej.test(userName)){
	// 	$("#userNameErr").text("用户名只能包含字母或数字或_");
	// 	return ; 
	// }
	// alert(waterStoreName);
	// index.php?controller=Admin&method=checkWaterStoreName
	// alert("ok");
}
function checkRealName(){
	var realName = $("#realNameID").val();
    if(realName == "" || realName.length < 2){  
   	   $("#rn").text("真实性名不合法");
       return  false;  
    }else{
   	   $("#rn").text("ok");
   	   return true;
   }

	// var rej= /^[0-9a-zA-Z_]+$/;
	// if(!rej.test(userName)){
	// 	$("#userNameErr").text("用户名只能包含字母或数字或_");
	// 	return ; 
	// }
	// alert(waterStoreName);
	// index.php?controller=Admin&method=checkWaterStoreName
	// alert("ok");
}

$("#userRealNameAuthen").submit(function (){
	if(checkidCardNumber() && checkRealName()){
		$("#okBtn").text("提交中...");
	    $.ajax({
	    	    url:"index.php?controller=Home&method=userRealNameAuthenticationProc", //表单提交目标 
			    type:"post", //表单提交类型 
			    data:$(this).serialize(), //表单数据
			    async : true,
			    success:function(msg){
			    	var obj = eval('(' + msg + ')');
			    	if(obj.code == "200"){
			    		$("#okBtn").text("提交成功,3秒后跳转");
			    		setTimeout(function() {
			    			window.location.href="/index.php?controller=Home&method=userRealNameAuthentication&pos=three";
			    		}, 1500);
			    	}else{
		            	$("#okBtn").text("确定申请");
			    		alert(obj.message);
			    	}
	     		},
	     		error: function (data, status, e){
		            $("#okBtn").text("确定申请");
		            alert("系统错误,请重试");
	        	} 
	    });
	} 
	return false; //阻止表单的默认提交事件 
});