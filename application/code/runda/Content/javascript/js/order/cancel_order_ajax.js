function cancelOrder(id){
	if(confirm("是否确认取消?")){
		$.ajax({
			url: "index.php?controller=Order&method=cancelOrderProc&orderid="+id,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					alert(result.message);
					if(result.code == 200){
						setTimeout(function() {
		    			 window.location.reload();
		    		}, 1000);
					}
				}else{
						alert("服务器错误");
				}
	  		},
	  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
	            alert("服务器错误1 请重试"); 
	        }
		});
	}
}