<?php

//引入模型文件
require(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/waterbearer.class.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class WaterBearerController{
//-----------------------------------------------------------------
//------------登录---------------------------------------------
//-----------------------------------------------------------------
	/**
	 * 登录
	 */
	function login(){
		if(empty($_POST)){
			//请求错误
			echo '{"code":"400","msg":"请求错误","data":""}';
		}else{
			
			//引入User文件
			require_once(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
			
			$phoneNumber = $_POST['phoneNumber'];
			$passwd = $_POST['passWord'];
			$password = md5($passwd);
			$user = new User();
			$result = $user ->valideWaterBearer($phoneNumber, $password);
			echo $result;
		}
	}
	/**
	 * 退出
	 */
	function logout(){
		//清除Session
		if(isset($_SESSION['id'])){
			unset($_SESSION['id']);
		}
		if(isset($_SESSION['username'])){
			unset($_SESSION['username']);
		}
		echo '{"code":"200","msg":"退出登录成功","data":""}';
	}
//-----------------------------------------------------------------
//------------订单相关---------------------------------------------
//-----------------------------------------------------------------
	/*
	 *--1--送水工出发
	 *			orderStatue = 4	订单配送中
	 *			waterBearer.statue = 1	更改送水工的工作状态为忙碌中
	 */
	public function waterBearerStart(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != '' && isset($_GET['waterbearerid']) && $_GET['waterbearerid'] != ''){
			OrderDetail::waterBearerStart($_GET['orderid']);
			$res = WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
			//if($res){
				echo Json::makeJson("200","操作成功");
			//}else{
			//	echo Json::makeJson("500","操作失败");
			//}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
	}
	/*
	 *--2--更新物流信息
	 *			orderStatue = 4	订单配送中
	 *          logisticeInformation
	 */
	public function refreshTheLogisticeInformation(){
		if(isset($_GET['logisticeinfo']) && $_GET['logisticeinfo'] != '' && isset($_GET['orderid']) && $_GET['orderid'] != ''){
			// $logisticeInformation = $_GET['logisticeinfo'];
			$res = OrderDetail::refreshTheLogisticeInformation($_GET['orderid'],$_GET['logisticeinfo']);
			if($res){
				echo Json::makeJson("200","更新成功");
			}else{
				echo Json::makeJson("500","更新失败");
			}
		}else{
			echo Json::makeJson("400","请求错误");
			//请求错误
		}
	}
	/*
	 *--3--订单配送完成 
	 *	由送水工触发
	 */
	public function orderDoneDispatching(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != ''){
			$res = OrderDetail::orderDoneDispatching($_GET['orderid']);
			if($res){
				echo Json::makeJson("200","操作成功");
			}else{
				echo Json::makeJson("500","操作失败");
			}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
		// 待定：WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
	}
	/*
	 *--4--订单配送失败
	 *   要求送水工说明原因
	 *    orderFailReason orderCategory,orderStatue
	 */
	public function orderDispatchingFailed(){
		if(isset($_GET['orderid']) && $_GET['orderid'] != '' && isset($_GET['failreason'])){
			$res = OrderDetail::orderDispatchingFailed($_GET['orderid'],$_GET['failreason']);
			if($res){
				echo Json::makeJson("200","操作成功");
			}else{
				echo Json::makeJson("500","操作失败");
			}
		}else{
			//请求错误
			echo Json::makeJson("400","请求错误");
		}
		// 待定：WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],1);
	}

//-----------------------------------------------------------------
//------------送水工位置-------------------------------------------
//-----------------------------------------------------------------
	/**
	 * 送水工实时上传地理位置
	 */
	public function uploadWaterBearerRealTimeLocation(){
		if(empty($_POST)){
			echo Json::makeJson("400","请求错误");
		}else{
			
			require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearerdriverroute.class.php");
			
			$bearRoute = new WaterBearerDriverRoute();
			echo $bearRoute ->updateRTLocation($_POST['waterBearerId'], $_POST['longitude'], $_POST['latitude']);
		}
	}

	/**
	 * 获取送水工实时地理位置
	 */
	public function fetchWaterBearerRealTimeLocation(){
		if(empty($_GET)){
			echo Json::makeJson("400","请求错误");
		}else{
			
			require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearerdriverroute.class.php");
			
			$bearRoute = new WaterBearerDriverRoute();
			$result = $bearRoute ->selectRTLocation($_GET['waterBearerId']);
			if($result == null){
				echo Json::makeJson("400","没有获取到数据");
			}elseif($result == ""){
				echo Json::makeJson("400","系统错误,请重试");
			}else{
				echo Json::makeJson("200","获取数据成功",$result);
			}
		}
	}
//-----------------------------------------------------------------
//------------送水工工作状态-------------------------------------------
//-----------------------------------------------------------------
	// 0	正常工作---待分配订单，待出发
	// 1	忙碌中-----已分配订单，并且正在送水过程中
	// 2	休息中-----下班了
	public function refreshWaterBearerStatue(){
		if(isset($_GET['waterbearerid']) && $_GET['waterbearerid'] != '' && isset($_GET['statue'])){
			$res = WaterBearer::refreshWaterBearerStatue($_GET['waterbearerid'],$_GET['statue']);
			if($res){
				echo Json::makeJson("200","更新失败");
			}else{
				echo Json::makeJson("500","更新失败");
			}
		}else{
			echo Json::makeJson("400","操作失败");
		}
	}
}