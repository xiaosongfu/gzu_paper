<?php
//引入分页功能模块
require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
//引入水站model
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterstore.class.php");
//引入json操作文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入桶装水类别文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwatercategory.class.php");
//引入桶装水品牌
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwaterbrand.class.php");
//引入桶装水商品文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
//引入送水工模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearer.class.php");
//引入送水工状态模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearerstatue.class.php");
//引入桶装水商品图片文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoodsphotos.class.php");
//引入图片处理文件
require_once(DOC_PATH_ROOT."/Lib/ImageProc/imageproc.func.php");
//引入图片大小配置文件
require_once(DOC_PATH_ROOT."/Config/imagescale.config.php");

class WaterStoreController{
//-------------------------------------------------------------------
//----------水站入驻-------------------------------------------------
//-------------------------------------------------------------------
	/*
	 *水站入驻
	 * 1 ->要求用户先登录  2 ->填写水站基本信息  3 ->上传营业执照
	 * 4 ->完成，等待审核  5 ->审核完成>>>>>>成功||失败
	 */
	function waterStoreEnter(){
		//先判断用户是否已经实名认证
		if(isset($_SESSION['id'])){
			//引入用户模型文件
			require(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
			$user = new User();
			$res = $user ->checkUserIsRealNameAuthen($_SESSION['id']);
			//已经实名认证
			if($res == 0){
			//没有实名认证
				$pos = "zero";
				include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
				exit(0);
			}elseif($res == 1){  //通过

			}elseif($res == 2){  //未通过
				$pos = "two";
				include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
				exit(0);
			}elseif($res == 3){
				$pos = "three";
				include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
				exit(0);
			}
		}

		$step = isset($_GET['step']) ? $_GET['step'] : 'second';
		if(!isset($_SESSION['id'])){
			$step = 'first';
			// }else{
			// 	//先判断用户是否已经实名认证
			// 	//引入用户模型文件
			// 	require(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
			// 	$user = new User();
			// 	$res = $user ->checkUserIsRealNameAuthen($_SESSION['id']);
			// 	//已经实名认证
			// 	if($res){


			// 	//没有实名认证
			// 	}else{
		}
		include DOC_PATH_ROOT.'/View/WaterStore/waterStoreEnter.php';
	}
	/*
	 *水站名称检测，查看水站名称是否被注册了
	 */
	function checkWaterStoreName(){
		$waterStoreName = isset($_GET['waterStoreName']) ? $_GET['waterStoreName'] : '';
		if(!isset($_GET['waterStoreName'])){
			$code = "400";
			$message = "请求错误";
			$data = "";
			echo Json::makeJson($code,$message,$data);
		}else{
			$phoneNumber = $_GET['waterStoreName'];
			$waterStore = new WaterStore();
			$result = $waterStore ->checkWaterStoreName($waterStoreName);
			echo $result;
		}
	}
	//水站入驻处理
	function waterStoreEnterProc(){
		//请求错误
		if($_POST['waterStoreName'] =="" || $_POST['waterStoreTellPhone'] =="" || $_POST['businessLicensePath'] ==""){
			// header("Location:index.php?controller=WaterStore&method=login")
			echo Json::makeJson("400",'请求错误,您提交的数据可能不完整');
		//有数据 请求正确
		}else{
			//判断验证码
			$checkCode = isset($_POST['checkCode']) ? $_POST['checkCode'] : '';
			//验证码不正确
			if(strtoupper($checkCode) != $_SESSION['validcode']){
				echo Json::makeJson("400",'验证码错误');
			}else{
				//固定电话
				// $waterStoreFixedLinePhone = isset($_POST['waterStoreFixedLinePhone']) ? $_POST['waterStoreFixedLinePhone'] : '';
				//水站邮箱
				// $waterStoreEmail = isset($_POST['waterStoreEmail']) ? $_POST['waterStoreEmail'] : '';

				//负责人
				// $owner = $_SESSION['id'];

				// $waterStoreName = isset($_POST['waterStoreName']);
				// $waterStoreTellPhone = isset($_POST['waterStoreTellPhone']);
				// $province = isset($_POST['province']);
				// $city = isset($_POST['city']);
				// $country = isset($_POST['country']);
				// $detailAddress = isset($_POST['detailAddress']);
				// $businessLicense = isset($_POST['businessLicensePath']);
				
				$waterStore = new WaterStore();
				// $result = $waterStore ->waterStoreEnter($owner,$waterStoreName,$waterStoreTellPhone,$waterStoreFixedLinePhone,$waterStoreEmail,$province,$city,$country,$detailAddress,$businessLicense);
				$result = $waterStore ->waterStoreEnter($_SESSION['id'],$_POST['waterStoreName'],$_POST['waterStoreTellPhone'],$_POST['waterStoreFixedLinePhone'],$_POST['waterStoreEmail'],$_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress'],$_POST['businessLicensePath']);
				echo $result;
			}
		}
	}
	//上传营业执照
	function upLoadBusinessLicense(){
		if(!isset($_FILES["License"])){
	            echo Json::makeJson("400",'请选择文件');
	            // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=请选择文件");
	            // return ;
	    }else{
	        //文件错误
	        if($_FILES["License"]['error'] == 1 || $_FILES["License"]['error'] == 2){
	            echo Json::makeJson("400",'文件过大');
	         //    header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=文件过大");
	        	// return ;
	        //服务器错误
	        }elseif ($_FILES["License"]['error'] > 2){
	            echo Json::makeJson("400",'请求或服务器错误');
	            // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误");
	        	// return ;
	        //正常
	        }else{
	            //第二步：判断类型
	            $str = basename($_FILES["License"]["name"]);
	            $arr = explode(".",$str);
	            $ext = array_pop($arr);
	            $allowExt = array("gif","png","jpeg","jpg");
	            if(!in_array($ext, $allowExt)){
	                echo Json::makeJson("400",'不支持的文件类型');
	             //    header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=不支持的文件类型");
	            	// return ;
	            }
	            //第三步：改文件名
	            //设置时区
	            date_default_timezone_set("PRC");

	            //上传文件临时路径
	            $upfile = $_FILES["License"]["tmp_name"];
	            //文件保存路径
	            $fileRute = $_SERVER["DOCUMENT_ROOT"]."/Content/image/businesslicense/".date("Ymd").'/';
	            //不存在就创建
	            if(!is_dir($fileRute)){
		            mkdir($fileRute);
	            }
	            //新的文件名
	            $fileName = date("YmdHis").rand(100,999).".".$ext;
	            //完整文件名
	            $fileNewName = $fileRute.$fileName;
	            //第四步：保存文件
	            if(move_uploaded_file($upfile, $fileNewName)){
	                //上传成功后要等比缩放图片的大小 缩放为： 1100 X 560
	                list($width,$height) = getimagesize($fileNewName);
	                if($width != BUSINESS_LICENSE_WIDTH || $height != BUSINESS_LICENSE_HEIGHT){
	                    // ImageProc::scaleImageKeepRate($fileNewName , BUSINESS_LICENSE_WIDTH , BUSINESS_LICENSE_HEIGHT);
	                    ImageProc::scaleImage($fileNewName , BUSINESS_LICENSE_WIDTH , BUSINESS_LICENSE_HEIGHT);
	                }
	                //------------------------
	            	//要处理成 /Content/image/businesslicense/...的格式
	            	$pos = strrpos($fileNewName,"Content");
	            	$res = substr($fileNewName,$pos);
	            	$imagePath = "/".$res;
	                echo Json::makeJson("200",'上传成功',array("imagePath" =>$imagePath,"fullImagePath" =>$fileNewName));
	                // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=上传成功&imagePath=".$fileNewName);
	                // return ;
	            }else{
	                echo Json::makeJson("400",'服务器错误');
	                // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误");
	                // return ;
	            }
	        }
	    }
	}

//-------------------------------------------------------------------
//----------管理我的水站---------------------------------------------
//-------------------------------------------------------------------
	/*
	 *管理我的水站  web版
	 * 能正常管理水站是会把水站ID保持在session中：$_SESSION['waterStoreID']
	 */
	function manageMyWaterStore(){
		//先查询用户是否是水站所有人
		$waterStore = new WaterStore();
		$result = $waterStore ->queryMyWaterStore($_SESSION['id']);
		//用户还不是水站负责人
		if($result == array()){
			// print_r(Json::makeJson("404","用户还不是水站负责人"));
			//展示邀请用户入驻的页面
			$statue = "not";
			include DOC_PATH_ROOT.'/View/WaterStore/queryMyWaterStore.php';
			return ;
		//用户是水站负责人
		}elseif(isset($result[0]['id']) && isset($result[0]['waterStoreName'])){
		// }else{
			//待审核
			if($result[0]['auditStatus'] == "0"){
				$statue = "wait";
				include DOC_PATH_ROOT.'/View/WaterStore/queryMyWaterStore.php';
				return ;
				// print_r(Json::makeJson("420","待审核"));
			//审核通过
			}elseif($result[0]['auditStatus'] == "1"){
				// print_r(Json::makeJson("200","用户是水站负责人"));
				$_SESSION['waterStoreID'] = $result[0]['id'];
				include DOC_PATH_ROOT.'/View/WaterStore/waterStoreManage.php';
				return ;
			//审核失败
			}else{
				$statue = "fail";
				$auditDetail = $result[0]['auditDetail'];
				include DOC_PATH_ROOT.'/View/WaterStore/queryMyWaterStore.php';
				return ;
				// print_r(Json::makeJson("440","审核失败",$result['auditDetail']));
			}
		}else{
			// print_r(Json::makeJson("400","系统错误"));
			$statue = "error";
			include DOC_PATH_ROOT.'/View/WaterStore/queryMyWaterStore.php';
			return ;
		}
	}
	/*
	 *管理我的水站 Phone版    ------>>>已弃用  2015年9月9日00:41:41
	 */
// 	function manageMyWaterStorePhone(){
// 		//先查询用户是否是水站所有人
// 		$waterStore = new WaterStore();
// 		$result = $waterStore ->queryMyWaterStore($_SESSION['id']);
// 		//用户还不是水站负责人
// 		if($result == array()){
// 			echo Json::makeJson("404","用户还不是水站负责人");
// 		//用户是水站负责人
// 		}elseif(isset($result['id']) && isset($result['waterStoreName'])){
// 			//待审核
// 			if($result['auditStatus'] == 0){
// 				echo Json::makeJson("420","待审核");
// 			//审核通过
// 			}elseif($result['auditStatus'] == 1){
// 				$_SESSION['waterStoreID'] = $result[0]['id'];
// 				echo Json::makeJson("200","用户是水站负责人",$result);
// 			//审核失败
// 			}else{
// 				echo Json::makeJson("440","审核失败",$result['auditDetail']);
// 			}
// 		}else{
// 			echo Json::makeJson("400","系统错误");
// 		}
// 	}

//-------------------------------------------------------------------
//----------水站业绩管理---------------------------------------------
//-------------------------------------------------------------------
	/*
	 *业绩管理
	 */
	function achievementManage(){
	}
	/*
	 *获取所有本水站的订单
	 */
	function getAllOrder(){
		 //------------翻页-----------------
	    //当前页
	    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
	    //每一页的纪录条数
	    $singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from orderDetail where waterStoreID=".$_SESSION['waterStoreID'];
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
	    //总的页数
	    $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
	    
		$waterStore = new WaterStore();
		$orderResult = $waterStore ->getAllOrder($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
	    
		//引入订单包含桶装水模型文件
		require(DOC_PATH_ROOT."/Model/EntityModel/ordercontaingoods.class.php");
		
// 		//获取订单所含的桶装水
// 		$orderContainGoods = new OrderContainGoods();
// 		$orderContainGoodsResult = array();
// 		if($orderResult != null){
// 			$orderCount = count($orderResult);
// 			for($i =0 ;$i < $orderCount; $i++){
// 				$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
// 			}
// 		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		
		
	    //分页条
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=getAllOrder");
		include DOC_PATH_ROOT.'/View/WaterStore/getAllOrder.php';
	}

//-------------------------------------------------------------------
//----------水站营业状态管理---------------------------------------------
//-------------------------------------------------------------------
	/*
	 *获取水店工作状态
	 */
	function getwaterStoreStatus(){
		require(DOC_PATH_ROOT."/Model/EntityModel/waterstorestatue.class.php");
		$waterStoreStatusRawArr = WaterStoreStatue::getWaterStoreStatue();
		$waterStoreStatusArr = array();
		foreach ($waterStoreStatusRawArr as $key => $value) {
			$waterStoreStatusArr[] = $value['waterStoreStat'];
		}
		$waterStoreStatus = WaterStoreStatue::getOneWaterStoreStatue($_SESSION['waterStoreID']);
		include DOC_PATH_ROOT.'/View/WaterStore/getwaterStoreStatus.php';;
	}
	/*
	 *更新水店工作状态
	 */	
	function changewaterStoreStatus(){
		if(isset($_POST['waterss'])){
			require_once(DOC_PATH_ROOT."/Model/EntityModel/waterstorestatue.class.php");
			$newStatus = $_POST['waterss'];
			$res = WaterStoreStatue::changeOneWaterStoreStatue($newStatus,$_SESSION['waterStoreID']);
			if($res){
				echo Json::makeJson("200");
			}else{
				echo Json::makeJson("400");
			}
		}else{
			echo Json::makeJson("400");
		}
	}

//-------------------------------------------------------------------
//----------我的水站首页---------------------------------------------
//-------------------------------------------------------------------
	/*
	 *我的水站首页 web版
	 */
	function myWaterStore(){
		if(isset($_GET['waterStoreID'])){
			$waterStoreID = $_GET['waterStoreID'];
			//1 先获取水站信息
			$waterStore = new WaterStore();
			$waterStoreResult = $waterStore ->getMyWaterStore($waterStoreID);
			//2 获取热销桶装水
			$barrelWGoods = new BarrelWaterGoods();
			$hottestBWGoods = $barrelWGoods ->getHottestBarrelWaterGoodsForMyWS($waterStoreID);
			//3 获取最新上架桶装水
			$newestBWGoods = $barrelWGoods ->getNewestBarrelWaterGoodsForMyWS($waterStoreID);
			//4 获取状态
			require(DOC_PATH_ROOT."/Model/EntityModel/waterstorestatue.class.php");
			$waterStoreStatusRawArr = WaterStoreStatue::getWaterStoreStatue();
			$waterStoreStatusArr = array();
			foreach ($waterStoreStatusRawArr as $key => $value) {
				$waterStoreStatusArr[] = $value['waterStoreStat'];
			}
		include DOC_PATH_ROOT.'/View/WaterStore/myWaterStore.php';
		}
		// else{

		// }
	}
//-------------------------------------------------------------------	
//----------添加桶装水-----------------------------------------------	
//-------------------------------------------------------------------
	/*
	 * 添加桶装水界面
	 */
	function uploadBarrelWater(){
		include DOC_PATH_ROOT.'/View/WaterStore/uploadBarrelWater.php';
	}
	/*
	 * 添加桶装水处理
	 */
	function uploadBarrelWaterProc(){
		if($_POST['waterGoodsName'] == "" || $_POST['waterGoodsPrice'] == "" || $_POST['waterGoodsInventory'] == ""){
			echo Json::makeJson("400","请求错误");
		}else{
			//1 获取水站ID
			$waterStoreID = $_SESSION['waterStoreID'];
			$waterCate = $_POST['waterCate'];
			$waterBrand = $_POST['waterBrand'];
			$waterGoodsName = $_POST['waterGoodsName'];
			$waterGoodsDescript = $_POST['waterGoodsDescript'];
			$waterGoodsPrice = $_POST['waterGoodsPrice'];
			$waterGoodsInventory = $_POST['waterGoodsInventory'];
			$isGrounding = $_POST['isGrounding'];

			//------------
				$photoImg = array();
				for($i=1;$i<=6;$i++){
					$key = "photoImg".$i;
					$photoImg[] = $_POST[$key];
				}
		// 			$photoImg1 = $_POST['photoImg1'];
		// 			$photoImg2 = $_POST['photoImg2'];
		// 			$photoImg3 = $_POST['photoImg3'];
		// 			$photoImg4 = $_POST['photoImg4'];
		// 			$photoImg5 = $_POST['photoImg5'];
		// 			$photoImg6 = $_POST['photoImg6'];
			$barrelWaterGood = new BarrelWaterGoods();
			date_default_timezone_set("PRC");
			$groundingDate = time();
			$res = $barrelWaterGood ->uploadBarrelWaterGoods($waterStoreID,$waterCate,$waterBrand,$waterGoodsName,$waterGoodsDescript,$waterGoodsPrice,$photoImg[0],$waterGoodsInventory,$groundingDate,$isGrounding);
			if($res['code'] == "200"){
				$goodsID = $res['id'][0]['last_id'];
				//将桶装水图片存入数据库
				$barrelWaterGoodsPhoto = new BarrelWaterGoodsPhotos();
				for($i=0;$i<6;$i++){
					if($photoImg[$i] != ""){
						$res = $barrelWaterGoodsPhoto ->addGoodsPhotos($goodsID,$photoImg[$i]);
						if($res == "0"){
						echo Json::makeJson("400","保存桶装水图片失败");
						return ;
						}
					}
				}
			// 				if($photoImg1 != ""){
			// 						$res = $barrelWaterGoodsPhoto ->addGoodsPhotos($goodsID,$photoImg1);
			// 						if($res == 0){
			// 						print_r(Json::makeJson("400","保存桶装水图片失败"));
			// 						return ;
			// 						}
			// 				}
				echo Json::makeJson("200","添加桶装水成功");
			}else{
				echo Json::makeJson("400","添加桶装水失败");
				// print_r(Json::makeJson("400",$res['code']));
			}
		}
	}
	/*
	 * 添加桶装水图片处理
	 */
	function uploadBarrelWaterGoodsPhotos(){
		if($_FILES == array()){
            echo Json::makeJson("400",'请求错误');
		}else{
			//文件错误
	        if($_FILES["goodsphoto"]['error'] == 1 || $_FILES["goodsphoto"]['error'] == 2){
	            echo Json::makeJson("400",'文件过大');
	        //服务器错误
	        }elseif ($_FILES["goodsphoto"]['error'] > 2){
	            echo Json::makeJson("400",'请求或服务器错误');
	        //正常
	        }else{
	            //第二步：判断类型
	            $str = basename($_FILES["goodsphoto"]["name"]);
	            $arr = explode(".",$str);
	            $ext = array_pop($arr);
	            $allowExt = array("gif","png","jpeg","jpg");
	            if(!in_array($ext, $allowExt)){
	                echo Json::makeJson(400,'不支持的文件类型');
	            }
	            //第三步：改文件名
	            //设置时区
	            date_default_timezone_set("PRC");

	            //上传文件临时路径
	            $upfile = $_FILES["goodsphoto"]["tmp_name"];
	            //文件保存路径
	            $fileRute = $_SERVER["DOCUMENT_ROOT"]."/Content/image/goodspicture/".date("Ymd").'/';
	            //不存在就创建
	            if(!is_dir($fileRute)){
		            mkdir($fileRute);
	            }
	            //新的文件名
	            $fileName = date("YmdHis").rand(100,999).".".$ext;
	            //完整文件名
	            $fileNewName = $fileRute.$fileName;
	            //第四步：保存文件
	            if(move_uploaded_file($upfile, $fileNewName)){
	                //重置桶装水商品图片大小为 360 X 300
	                //上传成功后要等比缩放图片的大小 缩放为： 360 X 300
	                list($width,$height) = getimagesize($fileNewName);
	                if($width != GOODS_PHOTO_WIDTH || $height != GOODS_PHOTO_HEIGHT){
	                    // ImageProc::scaleImageKeepRate($fileNewName , GOODS_PHOTO_WIDTH , GOODS_PHOTO_HEIGHT);
	                    ImageProc::scaleImage($fileNewName , GOODS_PHOTO_WIDTH , GOODS_PHOTO_HEIGHT);
	                }
	                
	            	//向服务器回传是要处理成 /Content/image/businesslicense/...的格式
	            	$pos = strrpos($fileNewName,"Content");
	            	$res = substr($fileNewName,$pos);
	            	$imagePath = "/".$res;
	                echo Json::makeJson("200",'上传成功',array("photoPath"=>$fileNewName));
	            }else{
	                echo Json::makeJson("400",'服务器错误');
	            }
	        }
        }
	}

//-------------------------------------------------------------------
//----------下架,上架,获取所有,删除-桶装水--------------------------
//-------------------------------------------------------------------
	/*
	 * 下架桶装水 界面和业务逻辑
	 */
	function unGroundingBarrelWaterGoods(){
	    if(isset($_POST['ungroundingbarrelWaterGoods'])){
	        $barrelWGoods = new BarrelWaterGoods();
	        if($barrelWGoods ->ungroundingBarrelWaterGoodsHandle($_POST['ungroundingbarrelWaterGoods'])){
	            echo Json::makeJson("200","下架成功");
	        }else{
	            echo Json::makeJson("400","下架失败");
	        }
	    }else{
    	    //------------翻页-----------------
    	    //当前页
    	    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
    	    //每一页的纪录条数
    	    $singlePageRecordCount = 2.0;
    	    //总的纪录数
    	    $sql = "select count(*) count from barrelWaterGoods where waterStoreID=".$_SESSION['waterStoreID']." and isGrounding=1;";
    	    $totalRecordCount = Pages::getTotalRecordCount($sql);
    	    //总的页数
    	    $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
    	
    	    $barrelWaterGoods = new BarrelWaterGoods();
    	    $result = $barrelWaterGoods ->unGroundingBarrelWaterGoods($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
    	    //获取类别和品牌
    	    $barrelWaterCategory = BarrelWaterCategory::getBarrelWaterCategory();
    	    $barrelWaterCategoryArray = array();
    	    foreach ($barrelWaterCategory as $key=>$value){
    	        $barrelWaterCategoryArray[$value['id']] = $value['barrelWaterCateName'];
    	    }
    	    $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
    	    $barrelWaterBrandArray = array();
    	    foreach ($barrelWaterBrand as $key=>$value){
    	        $barrelWaterBrandArray[$value['id']] = $value['barrelWaterBrandName'];
    	    }
    	    
    	    
    	    //分页导航栏 不带div的字符串
    	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=unGroundingBarrelWaterGoods");
    	
    	    include DOC_PATH_ROOT.'/View/waterStore/unGroundingBarrelWaterGoods.php';
	    }
	}
    /*
     * 上架桶装水 界面和业务逻辑
     */
    function groundingBarrelWaterGoods(){
        if(isset($_POST['groundingbarrelWaterGoods'])){
            //             $count =  count($_POST['barrelWaterGoods']);
            //             print_r($_POST['barrelWaterGoods']);
            $barrelWGoods = new BarrelWaterGoods();
            if($barrelWGoods ->groundingBarrelWaterGoodsHandle($_POST['groundingbarrelWaterGoods'])){
                echo Json::makeJson("200","上架成功");
            }else{
                echo Json::makeJson("400","上架失败");
            }
        }else{
            //------------翻页-----------------
            //当前页
            $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
            //每一页的纪录条数
            $singlePageRecordCount = 2.0;
            //总的纪录数
            $sql = "select count(*) count from barrelWaterGoods where waterStoreID=".$_SESSION['waterStoreID']." and isGrounding=0;";
            $totalRecordCount = Pages::getTotalRecordCount($sql);
            //总的页数
            $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
            
            $barrelWaterGoods = new BarrelWaterGoods();
            $result = $barrelWaterGoods ->groundingBarrelWaterGoods($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
            //获取类别和品牌
            $barrelWaterCategory = BarrelWaterCategory::getBarrelWaterCategory();
            $barrelWaterCategoryArray = array();
            foreach ($barrelWaterCategory as $key=>$value){
                $barrelWaterCategoryArray[$value['id']] = $value['barrelWaterCateName'];
            }
            $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
            $barrelWaterBrandArray = array();
            foreach ($barrelWaterBrand as $key=>$value){
                $barrelWaterBrandArray[$value['id']] = $value['barrelWaterBrandName'];
            }
            
            //分页导航栏 不带div的字符串
            $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=groundingBarrelWaterGoods");
            
            include DOC_PATH_ROOT.'/View/waterStore/groundingBarrelWaterGoods.php';
        }
    }
    /*
     * 获取某一水站的所有桶装水 web版
     */
    function getAllBarrelWaterGoods(){
        //------------翻页-----------------
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from barrelWaterGoods where waterStoreID=".$_SESSION['waterStoreID'].";";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
        $barrelWaterGoods = new BarrelWaterGoods();
        $result = $barrelWaterGoods ->getAllBarrelWaterGoods($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
        //获取类别和品牌
        $barrelWaterCategory = BarrelWaterCategory::getBarrelWaterCategory();
        $barrelWaterCategoryArray = array();
        foreach ($barrelWaterCategory as $key=>$value){
            $barrelWaterCategoryArray[$value['id']] = $value['barrelWaterCateName'];
        }
        $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
        $barrelWaterBrandArray = array();
        foreach ($barrelWaterBrand as $key=>$value){
            $barrelWaterBrandArray[$value['id']] = $value['barrelWaterBrandName'];
        }
        //分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=getAllBarrelWaterGoods");
        
        include DOC_PATH_ROOT.'/View/waterStore/getAllBarrelWaterGoods.php';
    }
    /*
     * 删除桶装水
     */
    function deleteBarrelWaterGoods(){
        if(isset($_POST['barrelWaterGoods'])){
            $barrelWGoods = new BarrelWaterGoods();
            if($barrelWGoods ->deleteBarrelWaterGoods($_POST['barrelWaterGoods'])){
                echo Json::makeJson("200","删除成功");
            }else{
                echo Json::makeJson("400","删除失败");
            }
        }else{
            //------------翻页-----------------
            //当前页
            $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
            //每一页的纪录条数
            $singlePageRecordCount = 2.0;
            //总的纪录数
            $sql = "select count(*) count from barrelWaterGoods where waterStoreID=".$_SESSION['waterStoreID'].";";
            $totalRecordCount = Pages::getTotalRecordCount($sql);
            //总的页数
            $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
            $barrelWaterGoods = new BarrelWaterGoods();
            $result = $barrelWaterGoods ->getAllBarrelWaterGoods($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
            //获取类别和品牌
            $barrelWaterCategory = BarrelWaterCategory::getBarrelWaterCategory();
            $barrelWaterCategoryArray = array();
            foreach ($barrelWaterCategory as $key=>$value){
                $barrelWaterCategoryArray[$value['id']] = $value['barrelWaterCateName'];
            }
            $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
            $barrelWaterBrandArray = array();
            foreach ($barrelWaterBrand as $key=>$value){
                $barrelWaterBrandArray[$value['id']] = $value['barrelWaterBrandName'];
            }
            //分页导航栏 不带div的字符串
            $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=deleteBarrelWaterGoods");
            
            include DOC_PATH_ROOT.'/View/WaterStore/deleteBarrelWaterGoods.php';
        }
    }

//-------------------------------------------------------------------
//----------查看与编辑桶装水详细描述------------------------------
//-------------------------------------------------------------------
    function showAndEditWaterGoodsDescript(){
    	if(isset($_GET['id'])){
    		$barrelWaterGoods = new BarrelWaterGoods();
    		$result = $barrelWaterGoods ->getBarrelWaterGoodsDescript($_GET['id']);
    	}else{
    		$result = null;
    	}
    	include DOC_PATH_ROOT.'/View/WaterStore/showAndEditWaterGoodsDescript.php';
    }

//-------------------------------------------------------------------
//----------获取桶装水类别  品牌-------------------------------
//-------------------------------------------------------------------
	/*
	 * 获取桶装水类别
	 */
	function getBarrelWaterCategory(){
		$result = BarrelWaterCategory::getBarrelWaterCategory();
		if($result == null){
			echo Json::makeJson("400","没有获取到数据");
		}elseif($result == ""){
			echo Json::makeJson("400","系统错误,请重试");
		}else{
			echo Json::makeJson("200","获取数据成功",$result);
		}
	}
	/*
	 * 获取桶装水品牌
	 */
	function getBarrelWaterBrand(){
		$result = BarrelWaterBrand::getBarrelWaterBrand();
		if($result == null){
			echo Json::makeJson("400","没有获取到数据");
		}elseif($result == ""){
			echo Json::makeJson("400","系统错误,请重试");
		}else{
			echo Json::makeJson("200","获取数据成功",$result);
		}
	}

//-------------------------------------------------------------------
//----------送水工管理-----------------------------------------------
//-------------------------------------------------------------------
    /*
     * 添加送水工
     */
	function addWaterBearer(){
	    $action = isset($_GET['action']) ? "add" : 'webPage';
	    if($action == 'add'){
	        //获取参数
	        $userId = $_POST['userId'];
	        $maxLoadCapacity = $_POST['maxLoadCapacity'];
	        $waterStoreId = $_SESSION['waterStoreID'];
	        $waterBearer = new WaterBearer();
	        $res = $waterBearer ->addWaterBearer($userId,$waterStoreId,$maxLoadCapacity);
	        if($res){
	            echo Json::makeJson("200","添加成功");
	        }else{
	            echo Json::makeJson("400","添加失败");
	            //print_r(Json::makeJson("400",$res));
	        }
	    }else{
	        include DOC_PATH_ROOT.'/View/WaterStore/addWaterBear.php';
	    }
	}
	/*
	 * 查看所有送水工
	 */
	function getAllWaterBearers(){
	    //------------翻页-----------------
	    //当前页
	    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
	    //每一页的纪录条数
	    $singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from waterBearer where waterStoreID=".$_SESSION['waterStoreID'].";";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
	    //总的页数
	    $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
	    
	    $waterBearer = new WaterBearer();
	    $waterbearers = $waterBearer ->getAllWaterBearers($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
	    
	    //获取送水工状态
	    $waterBearerStatue = WaterBearerStatue::getWaterBearerStatue();
	    $waterBearerStatueArray = array();
	    foreach ($waterBearerStatue as $key=>$value){
	        $waterBearerStatueArray[$value['id']] = $value['waterBearerStat'];
	    }

	    //为每个送水工查询最新位置
	    require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearerdriverroute.class.php");
	    $bearRoute = new WaterBearerDriverRoute();
	    for($i = 0  ; $i < count($waterbearers) ; $i++){

			$result = $bearRoute ->selectRTLocation($waterbearers[$i]['userId']);
	    	$waterbearers[$i]['waterBearerPositionLongitude'] = $result[0]['waterBearerPositionLongitude'];
	    	$waterbearers[$i]['waterBearerPositionLatitude'] = $result[0]['waterBearerPositionLatitude'];
	    }

	    
	    //分页条
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=getAllWaterbearers");
        include DOC_PATH_ROOT.'/View/WaterStore/getAllWaterBearers.php';
	}
	/*
	 * 删除送水工
	 */
	function delWaterBearer(){
	    //------------翻页-----------------
	    //当前页
	    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
	    //每一页的纪录条数
	    $singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from waterBearer where waterStoreID=".$_SESSION['waterStoreID'].";";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
	    //总的页数
	    $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
	     
	    $waterBearer = new WaterBearer();
	    $waterbearers = $waterBearer ->getAllWaterbearers($_SESSION['waterStoreID'],$currentPage,$singlePageRecordCount);
	    
	    //获取送水工状态
	    $waterBearerStatue = WaterBearerStatue::getWaterBearerStatue();
	    $waterBearerStatueArray = array();
	    foreach ($waterBearerStatue as $key=>$value){
	        $waterBearerStatueArray[$value['id']] = $value['waterBearerStat'];
	    }
	    
	    //分页条
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=WaterStore&method=delWaterBearer");
	    include DOC_PATH_ROOT.'/View/WaterStore/delWaterBearer.php';
	}
	
//-------------------------------------------------------------------
//---------根据水站id查询水站的所有上架的桶装水-移动端使用---------------------
//-------------------------------------------------------------------
	/*
     * 根据水站id获取某一水站的所有桶装水 phone版
     */
    function getAllBarrelWaterGoodsOfOneWaterStore(){
    	$id = isset($_GET['id']) ? $_GET['id'] : -1;
        $barrelWaterGoods = new BarrelWaterGoods();
        $result = $barrelWaterGoods ->getAllBarrelWaterGoodsOfOneWaterStore($id);
        if($result != null){
        	//获取类别和品牌
        	// $barrelWaterCategory = BarrelWaterCategory::getBarrelWaterCategory();
        	// $barrelWaterBrand = BarrelWaterBrand::getBarrelWaterBrand();
        	// $data = array("barrelWaterGoods"=>$result,"barrelWaterCategory"=>$barrelWaterCategory,"barrelWaterBrand"=>$barrelWaterBrand);
        	// echo Json::makeJson("200","获取数据成功",$data);
        	echo Json::makeJson("200","获取数据成功",$result);
        }else{
        	echo Json::makeJson("400","数据获取异常,请重试");
        }
    }
	
//--------------------------------------------------------------------
//---------其他-->水站信息-营业执照-水站入驻协议-----------------------------------------------------
//-------------------------------------------------------------------
	/*
	 *水站信息
	 */
	function waterStoreInformation(){
	    $waterStore = new WaterStore();
	    $res = $waterStore ->getwaterStoreInformation($_SESSION['waterStoreID']);
	    //只要是数据库查询出来的都是多维数组!!!!!!!!!!!!!!!!
	    $result = $res[0];
	    //水站工作状态
	    require(DOC_PATH_ROOT."/Model/EntityModel/waterstorestatue.class.php");
		$waterStoreStatusRawArr = WaterStoreStatue::getWaterStoreStatue();
		$waterStoreStatusArr = array();
		foreach ($waterStoreStatusRawArr as $key => $value) {
			$waterStoreStatusArr[] = $value['waterStoreStat'];
		}
		include DOC_PATH_ROOT.'/View/WaterStore/waterStoreInformation.php';
	}
	/*
	 *水站营业执照
	 */
	function waterStoreBusinessLicense(){
	    $waterStore = new WaterStore();
	    $result = $waterStore ->getwaterStoreBusinessLicense($_SESSION['waterStoreID']);
	    $businessLicensePath = $result[0]['businessLicense'];
	    $pos = strrpos($businessLicensePath,"Content");
	    $res = substr($businessLicensePath,$pos);
	    $businessLicenseURL = "/".$res;
	    include DOC_PATH_ROOT.'/View/WaterStore/waterStoreBusinessLicense.php';
	}
	/*
	 *水站入驻协议
	 */
	function rundaWaterStoreEnterProtoclol(){
		include DOC_PATH_ROOT.'/View/WaterStore/rundaWaterStoreEnterProtoclol.php';
	}
}