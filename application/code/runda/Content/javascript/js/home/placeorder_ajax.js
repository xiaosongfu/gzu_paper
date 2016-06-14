$("#placeOrderForm").submit(function (){
    $.ajax({
    	    url:"index.php?controller=Order&method=placeOrder", //表单提交目标 
		    type:"post", //表单提交类型 
		    data:$(this).serialize(), //表单数据
		    async : true,
		    success:function(msg){
		    	var obj = eval('(' + msg + ')');
		    	// alert(obj.code + obj.message);
		    	if(obj.code == "100"){
		    		// alert(obj.data);
		    		window.location.href="index.php?controller=Order&method=orderSettle&orderid="+obj.data;
		    	}else if(obj.code == "200"){
		    		var res = obj.data;
		    		// alert(res[0]);
		    		//var strs=res.split(","); //字符分割 

		    		alert("由于您的订单内包含的桶装水分属于几个不同的水站,已被系统拆分,请您分别结算");
		    		setTimeout(
		    			function() {
		    				for (var i=0;i<res.length ;i++ ) { 
				    			// alert(res[i]);
				    			window.open("index.php?controller=Order&method=orderSettle&orderid="+res[i]);
								}
							window.location.reload();
			    		}, 1000);

		   //  		for (var i=0;i<res.length ;i++ ) { 
		   //  			// alert(res[i]);
		   //  			window.open("index.php?controller=Order&method=orderSettle&orderid="+res[i]);
					// }
		    		// window.location.href="index.php?controller=Order&method=orderSettle&orderid="+res[0];
		    	}else{
		    		alert(obj.message);
		    	}
     		} 
    }); 
	return false; //阻止表单的默认提交事件 
});