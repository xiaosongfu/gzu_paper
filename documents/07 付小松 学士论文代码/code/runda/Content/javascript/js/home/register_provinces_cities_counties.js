/**
 * 1  网页加载完成后就拉取省份！！
 * 
 * 2  第一个是北京，则市、县的id都是1 ！！！
 * 
 * 3  省份改变了，就调用 getCities() ，同步设置市、县 !!!
 * 
 * 4  市改变了， 就调用 getCountries()  !!!
 */
//获取省
$(document).ready(function(){
	$.ajax({
		url: "index.php?controller=Region&method=getProvincesJson",
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == "200"){
					var provinces = document.getElementById ("privince");
					for(var key in result.data){
						    var opt = document.createElement ("option");
						    opt.value = result.data[key]["name"];
						    opt.innerText = result.data[key]["name"];
						    opt.id = result.data[key]["id"];
						    provinces.appendChild (opt);
					}
					//同时设置市和县 id 都是1
					commonGetCities(1);
					commonGetCountries(1);
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
});
//获取市
function getCities(){
	$("#city").empty(); 
	$("#country").empty(); 
	var provinceID = $("#privince option:selected").attr("id");
	//----------获取市--------------
	$.ajax({
		url: "index.php?controller=Region&method=getCitiesJson&provinceID="+provinceID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == "200"){
					var cityID = result.data[0]["id"];
					//------------获取县----------------
					$.ajax({
						url: "index.php?controller=Region&method=getCountriesJson&cityID="+cityID,
						type: "GET",
						dataType:"json",
						success: function(result,textStatus){
							if(textStatus == "success"){
								if(result.code == "200"){
									var countries = document.getElementById ("country");
									for(var key in result.data){
									    var opt = document.createElement ("option");
									    opt.value = result.data[key]["name"];
									    opt.innerText = result.data[key]["name"];
									    countries.appendChild (opt);
									}
								}else{
									alert(result.message);
								}
							}else{
									alert("服务器错误 请重试");
							}
				  		},
				  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
				            alert("服务器错误 请重试"); 
				        }
					});

					var cities = document.getElementById ("city");
					for(var key in result.data){
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    opt.id = result.data[key]["id"];
					    cities.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
}
//获取县
function getCountries(){
	$("#country").empty(); 
	var cityID = $("#city option:selected").attr("id");
	commonGetCountries(cityID);
}

//-----------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------
/**
 * 根据省id拿市
 */
function commonGetCities(provinceID){
	$.ajax({
		url: "index.php?controller=Region&method=getCitiesJson&provinceID="+provinceID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					var cities = document.getElementById ("city");
					for(var key in result.data){
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    opt.id = result.data[key]["id"];
					    cities.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
}
/**
 * 根据市id拿县
 */
function commonGetCountries(cityID){
	$.ajax({
		url: "/index.php?controller=Region&method=getCountriesJson&cityID="+cityID,
		type: "GET",
		dataType:"json",
		success: function(result,textStatus){
			if(textStatus == "success"){
				if(result.code == 200){
					var countries = document.getElementById ("country");
					for(var key in result.data){
					    var opt = document.createElement ("option");
					    opt.value = result.data[key]["name"];
					    opt.innerText = result.data[key]["name"];
					    countries.appendChild (opt);
					}
				}else{
					alert(result.message);
				}
			}else{
					alert("服务器错误 请重试");
			}
  		},
  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
            alert("服务器错误 请重试"); 
        }
	});
}