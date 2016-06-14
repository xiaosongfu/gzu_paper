$(document).ready(function(){
	//获取桶装水类别
	$.ajax({
		url: "index.php?controller=WaterStore&method=getBarrelWaterCategory",
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == "200"){
					var provinces = document.getElementById ("waterCateID");
					for(var key in result.data){
				// 		// alert(result.data[key]["name"]);
						    var opt = document.createElement ("option");
						    opt.value = result.data[key]["id"];
						    opt.innerText = result.data[key]["barrelWaterCateName"];
						    // opt.id = result.data[key]["id"];
						    provinces.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
				// alert(textStatus);
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("请求无法发送 请重试"); 
        }
	});
	//-------------------------------------------------------------------
	//获取桶装水品牌
	$.ajax({
		url: "index.php?controller=WaterStore&method=getBarrelWaterBrand",
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == "200"){
					var provinces = document.getElementById ("waterBrandID");
					for(var key in result.data){
						// alert(result.data[key]["name"]);
						    var opt = document.createElement ("option");
						    opt.value = result.data[key]["id"];
						    opt.innerText = result.data[key]["barrelWaterBrandName"];
						    // opt.id = result.data[key]["id"];
						    provinces.appendChild (opt);
					}
				}else{
					// alert("textStatus");
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("请求无法发送 请重试"); 
        }
	});
});