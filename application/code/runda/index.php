<?php

//开启会话
session_start();
//设置时区
date_default_timezone_set("PRC");
//获取文档路径，在整个应用中使用绝对路径
define("DOC_PATH_ROOT",$_SERVER['DOCUMENT_ROOT']);

//-- windows，LINUX都支持'/'
//引入简单调用函数
require(DOC_PATH_ROOT."/Common/callFunction.func.php");
//引入字符串处理函数
require(DOC_PATH_ROOT."/Lib/JSON/json.func.php");


//先获取controller和method
$controller = isset($_GET["controller"]) ? $_GET["controller"] : "RunDa";
$method = isset($_GET["method"]) ? $_GET["method"] : "index";
//RunDa 润达
if($controller == "RunDa"){
	//不需要登陆
	$allowRunDaMethods = array("index","barrelWaterGoodsDetail","getNearbyWaterStore","getBarrelWaterGoodsDetailByID","getBarrelWaterGoodsPhotoByID","getBarrelWaterGoodsCommentByID","rundaUserRigisterProtoclol","aboutRunDa","connectToRunDa");
	//需要登陆
	if(!in_array($method,$allowRunDaMethods)){
		$method = "index";
	}
//Home 用户
}elseif($controller == "Home"){
	// 不需要登录的：login loginProc getCode getCodeString checkCode register checkUserName checkEmail checkPhoneNumber registerProc debLocking changePassword changePasswordProc getUserPartInformationByID
	$allowHomeMethodsNoSession = array("login","loginProc","getCode","getCodeString","checkCode","register","checkUserName","checkEmail","checkPhoneNumber","registerProc","debLocking","changePassword","changePasswordProc","getUserPartInformationByID");
	//需要登录的： personPage  switchTog myInformation userRealNameAuthentication userRealNameAuthenIDCardImgProc userRealNameAuthenticationProc myInformationPhone addUserRecieverAddress addUserRecieverAddressProc magageUserRecieverAddress magageUserRecieverAddressPhone addShoppingCart quit
	$allowHomeMethodsSession = array("personPage","switchTog","myInformation","updateMyInformation","userRealNameAuthentication","userRealNameAuthenIDCardImgProc","userRealNameAuthenticationProc","myInformationPhone","addUserRecieverAddress","addUserRecieverAddressProc","magageUserRecieverAddress","magageUserRecieverAddressPhone","addShoppingCart","manageMyShoppingCart","deleteGoodsOnMyShoppingCart","manageMyShoppingCartPhone","quit");
    if(in_array($method,$allowHomeMethodsNoSession)){
    }else if(in_array($method,$allowHomeMethodsSession)){
    	if(!isset($_SESSION['userName'])|| !isset($_SESSION['id'])){
    	   //返回Json
    	   $returnJSONArray = array("myInformationPhone","userRealNameAuthenIDCardImgProc","userRealNameAuthenticationProc","magageUserRecieverAddressPhone","addUserRecieverAddressProc","addShoppingCart");
    	   if(in_array($method,$returnJSONArray)){
    	       echo JSON::makeJson("600","用户还没有登录");
    	       return ;
    	   }
    	    //重定向
    		$method = "login";
    	}
    }else{
    	$method = "login";
    }
//Order 订单
}elseif($controller == "Order"){
	//----->>>>> $allowRunDaMethods = array("placeOrder","orderSettle","getAllOrder","getDoneOrder","getUnfinishedOrder","getNonPaymentOrder","getCanceleddOrder","getFaileddOrder",
	// "viewOrder","settleOrderProc","orderSettleResult");

	// 	//需要登陆
	// if(in_array($method,$allowRunDaMethods)){
		//所有的都需要登录
		if(!isset($_SESSION['userName']) || !isset($_SESSION['id'])){
		// 	//waterStoreEnter upLoadBusinessLicense manageMyWaterStorePhone myWaterStorePhone uploadBarrelWaterProc uploadBarrelWaterGoodsPhotos addWaterBearer getAllWaterBearers
		// 	// $returnJSONArray = array("waterStoreEnter","upLoadBusinessLicense","manageMyWaterStorePhone","myWaterStorePhone","uploadBarrelWaterProc","uploadBarrelWaterGoodsPhotos","addWaterBearer","getAllWaterBearers");
		//  //    if(in_array($method,$returnJSONArray)){
	 //       print_r(JSON::makeJson("600","用户还没有登录"));
	 //       return ;
		//     // }
		// }else{
			$returnJSONArray = array(
					"placeOrder","orderSettleLocalProc","orderSettleOnlineProc",
					"placeOrderPhone","settleOrderPhone",
					"getAllOrderPhone","getDoneOrderPhone","getUnfinishedOrderPhone","getNonPaymentOrderPhone",
					"getCanceleddOrderPhone","getFaileddOrderPhone",
					"done"
			);
			if(in_array($method,$returnJSONArray)){
				echo JSON::makeJson("600","用户还没有登录");
	       		return ;
			}
		}
	// }else{
	// 	echo JSON::makeJson("700","找不到你要请求的页面");
	// }
//WaterBearer 送水工
}elseif($controller == "WaterBearer"){
// 	// 不需要登录的：
// 	$allowHomeMethodsNoSession = array();
// 	//需要登录的：
// 	$allowHomeMethodsSession = array();
//     if(in_array($method,$allowHomeMethodsNoSession)){
//     }else if(in_array($method,$allowHomeMethodsSession)){
    	// if(!isset($_SESSION['userName'])|| !isset($_SESSION['id'])){
    	// //返回Json
    	//    $returnJSONArray = array("myInformationPhone","userRealNameAuthenIDCardImgProc","userRealNameAuthenticationProc","magageUserRecieverAddressPhone","addUserRecieverAddressProc","addShoppingCart");
    	//    if(in_array($method,$returnJSONArray)){
    	//        echo JSON::makeJson("600","用户还没有登录");
    	//        return ;
    	//    }
    	// //重定向
    	// 	$method = "login";
    	// }
//     }
//OrderAllocate 订单分配
}elseif($controller == "OrderAllocate"){
// 	$allowHomeMethodsNoSession = array("allocateWaterBearer");
// 	//需要登录的：
// 	$allowHomeMethodsSession = array();
//     if(in_array($method,$allowHomeMethodsNoSession)){
//     }else if(in_array($method,$allowHomeMethodsSession)){
//     }
//Region 地区
}elseif($controller == "Region"){
		// Region->getProvincesJson getCitiesJson getCountriesJson getFirstCityIDJson
		//都不需要登录
//WaterStore 水站	
}elseif($controller == "WaterStore"){
	//不需要登录的
	//waterStoreEnter  waterStoreEnterProc rundaWaterStoreEnterProtoclol getBarrelWaterCategory getBarrelWaterBrand showAndEditWaterGoodsDescript(查看和编辑桶装水描述) getAllBarrelWaterGoodsOfOneWaterStore
	$allowWaterStoreMethodNoSession = array("waterStoreEnter","checkWaterStoreName","rundaWaterStoreEnterProtoclol","getBarrelWaterCategory","getBarrelWaterBrand","showAndEditWaterGoodsDescript","getAllBarrelWaterGoodsOfOneWaterStore");
	//需要登录的 
	//upLoadBusinessLicense manageMyWaterStore manageMyWaterStorePhone myWaterStore myWaterStorePhone waterStoreInformation uploadBarrelWater uploadBarrelWaterGoodsPhotos uploadBarrelWaterProc getAllBarrelWaterGoods groundingBarrelWaterGoods unGroundingBarrelWaterGoods deleteBarrelWaterGoods waterStoreBusinessLicense addWaterBearer getAllWaterBearers delWaterBearer getwaterStoreStatus changewaterStoreStatus achievementManage getAllOrder
	$allowWaterStoreMethodSession = array("waterStoreEnterProc","upLoadBusinessLicense","manageMyWaterStore","manageMyWaterStorePhone","myWaterStore","myWaterStorePhone","waterStoreInformation","uploadBarrelWater","uploadBarrelWaterGoodsPhotos","uploadBarrelWaterProc","getAllBarrelWaterGoods","groundingBarrelWaterGoods","unGroundingBarrelWaterGoods","deleteBarrelWaterGoods","waterStoreBusinessLicense","addWaterBearer","getAllWaterBearers","delWaterBearer","getwaterStoreStatus","changewaterStoreStatus","achievementManage","getAllOrder");
	if(in_array($method,$allowWaterStoreMethodNoSession)){
	}elseif(in_array($method,$allowWaterStoreMethodSession)){
// 		if(!isset($_SESSION['userName']) || !isset($_SESSION['id']) || !isset($_SESSION['waterStoreID'])){
		if(!isset($_SESSION['userName']) || !isset($_SESSION['id'])){
			//waterStoreEnter upLoadBusinessLicense manageMyWaterStorePhone myWaterStorePhone uploadBarrelWaterProc uploadBarrelWaterGoodsPhotos addWaterBearer getAllWaterBearers
			$returnJSONArray = array("waterStoreEnter","upLoadBusinessLicense","manageMyWaterStorePhone","myWaterStorePhone","uploadBarrelWaterProc","uploadBarrelWaterGoodsPhotos","addWaterBearer","getAllWaterBearers");
    	    if(in_array($method,$returnJSONArray)){
    	       echo JSON::makeJson("600","用户还没有登录");
    	       return ;
    	    }
    	}
	}else{
		$method = "waterStoreEnter";
	}
//Admin 管理员
}elseif($controller == "Admin"){
	//不需要登录的
	//adminLogin getCode checkCode
	//需要登录的
	//adminIndex adminLogou imageCarousel addImageCarousel showImageCarousel delImageCarousel userRoleManage userManage deleteAnUser userReciverAddressManage deleteAnUserRecieverAddress waterStoreStatueManage waterStoreAudit waterStoreAuditProc waterStoreManage waterBearStatueManage barrelWaterCategoryManage barrelWaterBrandManage userRealNameAuthenticationAuditProc

	$allowAdminMethodsSession = array("adminIndex","adminLogou","imageCarousel","addImageCarousel","showImageCarousel","delImageCarousel","userRoleManage","userManage","userRealNameAuthenticationAudit","deleteAnUser","userReciverAddressManage","deleteAnUserRecieverAddress","waterStoreStatueManage","waterStoreAudit","waterStoreAuditProc","waterStoreManage","waterBearStatueManage","barrelWaterCategoryManage","barrelWaterBrandManage","orderCategoryManage","orderStatueManage","userRealNameAuthenticationAuditProc","sendPush","sendBroadCastPush");
	if(in_array($method,$allowAdminMethodsSession)){
		if(!isset($_SESSION['adminID']) || !isset($_SESSION['adminName'])){
			$method = "adminLogin";
		}
	}
	// elseif($method == "adminLogin"){

	// }else{
	// 	$method = "adminLogin";
	// }
}else{
	//如果是别的控制器要换成RunDa
	$controller = "RunDa";
	$method = "index";
}
//调用控制器的相应action
C($controller,$method);