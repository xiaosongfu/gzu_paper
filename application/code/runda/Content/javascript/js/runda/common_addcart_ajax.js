function addCartFun(id){
	// alert(id);
	// alert(waterGoodsName);
	// alert(waterGoodsPrice);
	$.ajax({
    	    url:"index.php?controller=Home&method=addShoppingCart&id="+id, //表单提交目标 
		    type:"get", //表单提交类型 
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	// if(obj.code == "200"){
		    	// 	// document.getElementById("errMes").style.display="none";
		    	// 	// document.getElementById("lock").style.display="block";
		    	// 	// $("#login_stat").text("登录");
		    	// 	alert("ok");
		    	// }else{
		    		alert(obj.message);
		    	// }
     		} 
    }); 
}