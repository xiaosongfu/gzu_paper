$("#addUserRecieverAddress").submit(function (){
	if($("#detailAddress").val() == ""){
		alert("详细地址不能为空");
		return false;
	}else{
		$("#add_stat").text("添加中...");
	    $.ajax({
    	    url:"index.php?controller=Home&method=addUserRecieverAddressProc&action=add", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	if(obj.code == "200"){
		    		$("#add_stat").text("添加成功");
		    		setTimeout(function() {
		    			window.location.href="/index.php?controller=Home&method=addUserRecieverAddress";
		    		}, 1500);
		    	}else{
		    		alert("添加失败,请检查您的输入");
		    		$("#add_stat").text("确认添加");
		    	}
     		} 
   		});
   	} 
	return false; //阻止表单的默认提交事件 
});