<?php

require(DOC_PATH_ROOT."/Model/EntityModel/imagecarousel.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodscomments.class.php");
require(DOC_PATH_ROOT."/Model/EntityModel/waterstore.class.php");
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwaterbrand.class.php");

class RunDaController{
//-------------------------------------------------------------------
//-------------------网站首页----------------------------------------
//-------------------------------------------------------------------
	/**
	 *网站首页
	 */
	function index(){
		//获取轮播图片
	    $imageCarousel = new ImageCarousel('','','','','','');
	    $imageCarouselRes = $imageCarousel ->getShowImageCarousel();
	    //获取桶装水品牌
	    $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
	    $barrelWaterGoods = new BarrelWaterGoods();
	    //获取最新上架桶装水
	    $newsestBarrelWGoods = $barrelWaterGoods ->getNewestBarrelWaterGoods(6);
	    //获取最多销量桶装水
	    $hottestBarrelWGoods = $barrelWaterGoods ->getHottesetBarrelWaterGoods(6);

	    //获取热榜水站
	    $waterStore = new WaterStore();
	    $hottestWaterStore = $waterStore ->getHottestWaterStore();

		include DOC_PATH_ROOT.'/View/RunDa/index.php';
	}
//-------------------------------------------------------------------
//------------------商品详情页---------------------------------------
//-------------------------------------------------------------------
	/**
	 *商品详情页 web版
	 */
	function barrelWaterGoodsDetail(){
		include DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodsphotos.class.php";
		$id = isset($_GET['barrelWaterGoodsID']) ? $_GET['barrelWaterGoodsID'] : (-1);

		//获取桶装水信息
		$barrelWaterGoods = new BarrelWaterGoods();
		$barrelWaterGoodsResult = $barrelWaterGoods ->getBarrelWaterGoodsDetail($id);
		// 获取桶装水的图片
		$barrelWatetGoodsPhotos = new BarrelWaterGoodsPhotos();
		$barrelWatetGoodsPhotosResult = $barrelWatetGoodsPhotos ->getBarrelWaterGoodsPhotos($id);
		// 获取桶装水评价
		$barrelWaterGoodsCommentsResult = BarrelWaterGoodsComments::getBarrelWaterGoodsComments($id);

		include DOC_PATH_ROOT.'/View/RunDa/barrelWaterGoodsDetail.php';
	}
//-------------------------------------------------------------------
//-----------------移动端使用----------------------------------------
    /**
	 *获取附近的水站 移动端使用
	 */
	function getNearbyWaterStore(){
		$count = isset($_GET['count']) ? $_GET['count'] : 6;
	    //获取热榜水站
	    $waterStore = new WaterStore();
	    $nearbytWaterStore = $waterStore ->getNearbyWaterStore($count);
	    if($nearbytWaterStore != null){
	    	echo Json::makeJson("200","获取数据成功",$nearbytWaterStore);
	    }else{
	    	echo Json::makeJson("400","没有数据");
	    }
	}
	/**
	 *根据桶装水id获取桶装水详情(含描述)
	 */
	function getBarrelWaterGoodsDetailByID(){
		include DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodsphotos.class.php";
		$id = isset($_GET['barrelWaterGoodsID']) ? $_GET['barrelWaterGoodsID'] : (-1);

		//获取桶装水信息
		$barrelWaterGoods = new BarrelWaterGoods();
		$result = $barrelWaterGoods ->getBarrelWaterGoodsDetail($id);
		// 获取桶装水的图片
		// $barrelWatetGoodsPhotos = new BarrelWaterGoodsPhotos();
		// $barrelWatetGoodsPhotosResult = $barrelWatetGoodsPhotos ->getBarrelWaterGoodsPhotos($id);
		// 获取桶装水评价
		// $barrelWaterGoodsCommentsResult = BarrelWaterGoodsComments::getBarrelWaterGoodsComments($id);
		if($result != null){
			echo Json::makeJson("200","获取数据成功",$result);
		}else{
			echo Json::makeJson("400","获取数据异常,请重试");
		}
	}
	/**
	 *根据桶装水id获取桶装水图片
	 */
	function getBarrelWaterGoodsPhotoByID(){
		include DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodsphotos.class.php";
		$id = isset($_GET['barrelWaterGoodsID']) ? $_GET['barrelWaterGoodsID'] : (-1);

		// //获取桶装水信息
		// $barrelWaterGoods = new BarrelWaterGoods();
		// $result = $barrelWaterGoods ->getBarrelWaterGoodsDetail($id);
		// 获取桶装水的图片
		$barrelWatetGoodsPhotos = new BarrelWaterGoodsPhotos();
		$result = $barrelWatetGoodsPhotos ->getBarrelWaterGoodsPhotos($id);
		// 获取桶装水评价
		// $barrelWaterGoodsCommentsResult = BarrelWaterGoodsComments::getBarrelWaterGoodsComments($id);
		if($result != null){
			echo Json::makeJson("200","获取数据成功",$result);
		}else{
			echo Json::makeJson("400","没有图片");
		}
	}
	/**
	 *根据桶装水id获取桶装水评价
	 */
	function getBarrelWaterGoodsCommentByID(){
		include DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodsphotos.class.php";
		$id = isset($_GET['barrelWaterGoodsID']) ? $_GET['barrelWaterGoodsID'] : (-1);

		//获取桶装水信息
		// $barrelWaterGoods = new BarrelWaterGoods();
		// $result = $barrelWaterGoods ->getBarrelWaterGoodsDetail($id);
		// 获取桶装水的图片
		// $barrelWatetGoodsPhotos = new BarrelWaterGoodsPhotos();
		// $barrelWatetGoodsPhotosResult = $barrelWatetGoodsPhotos ->getBarrelWaterGoodsPhotos($id);
		// 获取桶装水评价
		$result = BarrelWaterGoodsComments::getBarrelWaterGoodsComments($id);
		if($result != null){
			echo Json::makeJson("200","获取数据成功",$result);
		}else{
			echo Json::makeJson("400","没有评论");
		}
	}
//-------------------------------------------------------------------
//----------------其他---------------------------------------------
	/**
	 *用户注册协议
	 */
	function rundaUserRigisterProtoclol(){
		include DOC_PATH_ROOT.'/View/RunDa/rundaUserRigisterProtoclol.php';
	}
	/**
	 *关于润达
	 */
	function aboutRunDa(){
		include DOC_PATH_ROOT.'/View/RunDa/aboutRunDa.php';
	}
	/**
	 *联系润达
	 */
	function connectToRunDa(){
		include DOC_PATH_ROOT.'/View/RunDa/connectToRunDa.php';
	}
}
