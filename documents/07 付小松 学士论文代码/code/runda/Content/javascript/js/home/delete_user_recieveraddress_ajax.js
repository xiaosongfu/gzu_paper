function deleteReciAddr(id){
	if(confirm("是否确认删除?")){
		$.ajax({
			url: "index.php?controller=Home&method=deleteUserRecieverAddress&id="+id,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					if(result.code == 200){
					}else{
						alert(result.message);
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