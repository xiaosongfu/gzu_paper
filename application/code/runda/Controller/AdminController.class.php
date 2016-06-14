<?php
//引入生成验证码文件
include DOC_PATH_ROOT.'/Lib/ValidCode/validcode.func.php';
//-----------------------------
//引入用户model
require_once(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
//引入用户角色模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/role.class.php");
//引入用户收货地址模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/userrecieveraddress.class.php");
//-----------------------------
//引入水店状态模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterstorestatue.class.php");
//引入水店模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterstore.class.php");
//------------------------------
//引入送水工状态模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/waterbearerstatue.class.php");
//------------------------------
//引入桶装水类别模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwatercategory.class.php");
//引入桶装水品牌模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwaterbrand.class.php");
//------------------------------
//引入图片轮播model
require_once(DOC_PATH_ROOT."/Model/EntityModel/imagecarousel.class.php");
//------------------------------
//引入数据库操作文件
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
//引入分页功能文件
require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
//引入json操作文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入图片处理文件
require_once(DOC_PATH_ROOT."/Lib/ImageProc/imageproc.func.php");
//引入图片大小配置文件
require_once(DOC_PATH_ROOT."/Config/imagescale.config.php");




class AdminController {
//----------------------------------------------------------------------------------------
//--------验证码--------------------------------------------------------------------
//----------------------------------------------------------------------------------------
    /**
     * 获取验证码图片
     * 管理员使用自己的验证码生成和验证系统，目的是同一个浏览器可以登录管理员和其他用户
     */
    function getCode(){
        $code = ValidCode::getCode();
        $_SESSION['adminValidcode'] = strtoupper($code);
        ValidCode::getImage($code);
    }
    /**
     * (网页异步) 验证验证码
     */
    function checkCode(){
        if(!isset($_GET['checkCode'])){
            $code = "400";
            $message = "请求错误";
            $data = "";
            echo Json::makeJson($code,$message,$data);
        }else{
            $checkCode = $_GET['checkCode'];
            if(strtoupper($checkCode) == $_SESSION['adminValidcode']){
                $code = "200";
                $message = "验证码正确";
                $data = "";
                echo Json::makeJson($code,$message,$data);
            }else{
                $code = "400";
                $message = "验证码错误";
                $data = "";
                echo Json::makeJson($code,$message,$data);
            }
        }
    }

//-------------------------------------------------------------
//--------管理员登录、退出--------------------------------------
//-------------------------------------------------------------
    /**
     *管理员登录 含界面和处理 
     */
    function adminLogin(){
    	//已经登录
        if(isset($_SESSION['adminID']) && isset($_SESSION['adminName'])){
            header("location:index.php?controller=Admin&method=adminIndex");
            return ;
        }
        
        //处理登录
    	if(isset($_POST["adminLogin"])){
    		//验证验证码
    		$checkCode = $_POST["checkcode"];
    		if($checkCode == "" || strtoupper($checkCode) != $_SESSION['adminValidcode']){
    			header("location:index.php?controller=Admin&method=adminLogin&errmes=验证码错误!");
    			return ;
    		}
    		//验证用户名 密码
    		$userName = $_POST["username"];
    		$passWord = md5($_POST["password"]);
    		$user = new User();
    		$result = $user ->ValideAdmin($userName, $passWord);
    		$result = json_decode($result,ture);
    		//异常
    		if($result['code'] == "400"){
    			header("location:index.php?controller=Admin&method=adminLogin&errmes=".$result['message']);
                return ; 
    		}else{
    		//正常
    		    $_SESSION['adminID'] = $result['data']['id'];
    		    $_SESSION['adminName'] = $userName;
    		    header("location:index.php?controller=Admin&method=adminIndex");
    		    return ;
    		}
    	//显示界面 
    	}else{
    	    $errmes = isset($_GET['errmes']) ? $_GET['errmes'] : "";
	        include DOC_PATH_ROOT.'/View/Admin/adminLogin.php';
    	}
    }
    /**
    *管理员退出
    */
    function adminLogou(){
        //清除SESSION
        $_SESSION['adminID'] =array();
        unset($_SESSION['adminID']);
        $_SESSION['adminName'] = array();
        unset($_SESSION['adminName']);
	    header("location:index.php?controller=Admin&method=adminLogin");
    }

//-------------------------------------------------------------
//--------管理员首页-------------------------------------------
//-------------------------------------------------------------
    /**
     * 管理员首页
     */
	function adminIndex(){
		include DOC_PATH_ROOT.'/View/Admin/adminIndex.php';
	}

//-------------------------------------------------------------
//--------用户管理---------------------------------------------
//-------------------------------------------------------------
	/**
	 * 用户角色管理
	 */
	function userRoleManage(){
	    $result = Role::getRole();
	    include DOC_PATH_ROOT.'/View/Admin/User/userRoleManage.php';
	}
	/**
	 * 用户管理
	 */
	function userManage(){
	    //获取所有的用户
	    //当前页
		$currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
		//每一页的纪录条数
		$singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from user;";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
		//总的页数
		$pageCount = ceil($totalRecordCount / $singlePageRecordCount);

		$user = new User();
        $result = $user ->getAllUsers($currentPage,$singlePageRecordCount);
        //用户角色
        $role = Role::getRole();
        $roleArray = array();
        foreach($role as $key=>$value){
            $roleArray[$value['id']] = $value['roleName'];
        }
        
	    //分页导航栏 不带div的字符串
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=userManage");
	    include DOC_PATH_ROOT.'/View/Admin/User/userManage.php';
	}
	/**
	 * 删除某一个用户
	 */
	function deleteAnUser(){
	    if(isset($_GET['id'])){
	        $user = new User();
	        $user ->deleteAnUser($_GET['id']);
	    }
	    header("location:index.php?controller=Admin&method=userManage");
	}
	/**
	 *获取已申请待审核的实名认证 
	 */
	function userRealNameAuthenticationAudit(){
		//获取所有待审核认证的用户
	    //当前页
		$currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
		//每一页的纪录条数
		$singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from user where isRealNameAuthen=0;";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
		//总的页数
		$pageCount = ceil($totalRecordCount / $singlePageRecordCount);

		$user = new User();
        $result = $user ->getWithoutRealNameAuthenUsers($currentPage,$singlePageRecordCount);
        //用户角色
        $role = Role::getRole();
        $roleArray = array();
        foreach($role as $key=>$value){
            $roleArray[$value['id']] = $value['roleName'];
        }
        
	    //分页导航栏 不带div的字符串
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=userRealNameAuthenticationAudit");
	    include DOC_PATH_ROOT.'/View/Admin/User/userRealNameAuthenticationAudit.php';
	}
	/**
	 *用户实名认证审核处理
	 */
	function userRealNameAuthenticationAuditProc(){
		if(isset($_POST['id']) && isset($_POST['isRealNameAuthen'])){
			$user = new User();
			if($_POST['isRealNameAuthen'] == "pass"){
				$isRealNameAuthen = 1;
			}elseif($_POST['isRealNameAuthen'] == "fail"){
				$isRealNameAuthen = 2;
			}else{
				echo Json::makeJson("400","请求错误");
				exit(0);
			}

			$res = $user ->realNameAuthenProc($_POST['id'],$isRealNameAuthen);
			
			if($res){
				echo Json::makeJson("200");
			}else{
				echo Json::makeJson("400","数据库操作异常,请稍后再试");
			}

		}else{
	    	echo Json::makeJson("400","请求错误");
		}
	}
	/**
	 * 用户收货地址管理(仅能执行删除操作)
	 */
	function userReciverAddressManage(){
	    //获取所有的用户
	    //当前页
	    $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
	    //每一页的纪录条数
	    $singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from userRecieverAddress;";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
	    //总的页数
	    $pageCount = ceil($totalRecordCount / $singlePageRecordCount);
	    
        $userRecAddr = new UserRecieverAddress();
        $result = $userRecAddr ->getUsersRecieverAddress($currentPage,$singlePageRecordCount);
	    
	    //分页导航栏 不带div的字符串
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=userReciverAddressManage");
	    include DOC_PATH_ROOT.'/View/Admin/User/userReciverAddressManage.php';
	}
	/**
	 * 删除某一个收货地址
	 */
	function deleteAnUserRecieverAddress(){
	    if(isset($_GET['id'])){
	        $userRecAddr = new UserRecieverAddress();
	        $userRecAddr ->deleteAnUserRecieverAddress($_GET['id']);
	    }
	    header("location:index.php?controller=Admin&method=userReciverAddressManage");
	}

//---------------------------------------------------------------------
//--------水站管理-----------------------------------------------------
//---------------------------------------------------------------------
	/**
	 * 水站工作状态管理
	 */
	function waterStoreStatueManage(){
	    $result = WaterStoreStatue::getWaterStoreStatue();
	    include DOC_PATH_ROOT.'/View/Admin/WaterStore/waterStoreStatueManage.php';
	}
	/**
	 * 获取已申请未审核的水站
	 */
	function waterStoreAudit(){
	    //获取已申请未审核的水站
	    $waterStore = new WaterStore();
	    $result = $waterStore ->getWaterStoreWithoutAudit();
	    include DOC_PATH_ROOT.'/View/Admin/WaterStore/waterStoreAudit.php';
	}
	/**
	 * 审核水站操作
	 */
	function waterStoreAuditProc(){
		if(isset($_POST['id']) && $_POST['auditResult'] != ""){
			$waterStore = new WaterStore();
			if($_POST['auditResult'] == "pass"){
				$res = $waterStore ->auditWaterStorePass($_POST['id'],$_POST['waterStoreLongitude'],$_POST['waterStoreLatitude']);
				if($res){
					echo Json::makeJson("200");
				}else{
					echo Json::makeJson("400","数据库操作异常,请稍后再试");
				}
			}elseif($_POST['auditResult'] == "fail"){
				$res = $waterStore ->auditWaterStoreFail($_POST['id'],$_POST['auditDetail']);
				if($res){
					echo Json::makeJson("200");
				}else{
					echo Json::makeJson("400","数据库操作异常,请稍后再试");
				}
			}else{
	    		echo Json::makeJson("400","请求参数错误");
			}
		}else{
	    	echo Json::makeJson("400","请求错误");
		}
	}
	/**
	 * 水站管理 （查看所有水站）
	 */
	function waterStoreManage(){
	    $waterStore = new WaterStore();
	    $result = $waterStore ->getAllWaterStore();
	    include DOC_PATH_ROOT.'/View/Admin/WaterStore/waterStoreManage.php';
	}
	
//-------------------------------------------------------------
	/**
	 *展示图片，如：营业执照。。。。
	 */
	function showImage(){
		$src = isset($_GET['src']) ? $_GET['src'] : "";
		$pos = strrpos($src,"Content");
	    $imageRes = substr($src,$pos);
	    $imageSrc = "/".$imageRes;
	    // $imageSrc = "/".substr($src,strrpos($src,"Content"));
		include DOC_PATH_ROOT.'/View/Admin/WaterStore/showImage.php';
	}
//-------------------------------------------------------------

	
//-------------------------------------------------------------
//--------送水工管理-------------------------------------------
//-------------------------------------------------------------
	/**
	 * 送水工工作状态管理
	 */
	function waterBearStatueManage(){
	    $result = WaterBearerStatue::getWaterBearerStatue();
	    include DOC_PATH_ROOT.'/View/Admin/WaterBearer/waterBearStatueManage.php';
	}
// 	/*
// 	 * 送水工管理
// 	 */
// 	function  waterBearManage(){
// 	}
// 	/*
// 	 * 送水工的行车路径管理
// 	 */
//    ---------------------------------》》》》这些都迁移到水站管理里面去

//-----------------------------------------------------------------------
//---------桶装水管理-----------------------------------------------------
//-----------------------------------------------------------------------
	/**
	 * 桶装水类别
	 */
	function barrelWaterCategoryManage(){
	    $result = BarrelWaterCategory::getBarrelWaterCategory();
	    include DOC_PATH_ROOT.'/View/Admin/BarrelWater/barrelWaterCategoryManage.php';
	}
	/**
	 * 桶装水品牌
	 */
	function barrelWaterBrandManage(){
	    $result = BarrelWaterBrand::getBarrelWaterBrand();
	    include DOC_PATH_ROOT.'/View/Admin/BarrelWater/barrelWaterBrandManage.php';
	}
	/**
	 * 获取所有桶装水
	 */
	function getAlllBarrelWaterGoods(){
		//------------翻页-----------------
		// require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
		require_once(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from barrelWaterGoods";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        $barrelWaterGoods = new BarrelWaterGoods();
        $barrelWaterGoodsResult = $barrelWaterGoods ->getAlllBarrelWaterGoods($currentPage,$singlePageRecordCount);

		//分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=getAlllBarrelWaterGoods");
        
	    include DOC_PATH_ROOT.'/View/Admin/BarrelWater/getAlllBarrelWaterGoods.php';
	}
	
//-------------------------------------------------------------
//----------订单管理-------------------------------------------
//-------------------------------------------------------------
	/**
	 *订单类别管理
	 */
	function orderCategoryManage(){
		require DOC_PATH_ROOT.'/Model/EntityModel/ordercategory.class.php';
		$result = OrderCategory::getOrderCategory();
		include DOC_PATH_ROOT.'/View/Admin/Order/orderCategoryManage.php';
	}
	/**
	 *订单状态管理
	 */
	function orderStatueManage(){
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		$result = OrderStatue::getOrderStatue();
		include DOC_PATH_ROOT.'/View/Admin/Order/orderStatueManage.php';
	}
	/**
	 *订单管理--所有订单
	 */
	function orderManage(){
		//------------翻页-----------------
		// require_once(DOC_PATH_ROOT."/Lib/Pages/pages.func.php");
		require_once(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
		require_once(DOC_PATH_ROOT."/Model/EntityModel/ordercontaingoods.class.php");
        //当前页
        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        //每一页的纪录条数
        $singlePageRecordCount = 2.0;
        //总的纪录数
        $sql = "select count(*) count from orderDetail";
        $totalRecordCount = Pages::getTotalRecordCount($sql);
        //总的页数
        $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

        //获取订单信息
        $order = new OrderDetail();
        $orderResult = $order ->getTheAllOrders($currentPage,$singlePageRecordCount);

        //获取订单所含的桶装水
        $orderContainGoods = new OrderContainGoods();
        $orderContainGoodsResult = array();
        if($orderResult != null){
        	$orderCount = count($orderResult); 
        	for($i =0 ;$i < $orderCount; $i++){
        		$orderContainGoodsResult[] = $orderContainGoods ->getGoodsByOrderID($orderResult[$i]['id']);
        	}
		}
		require DOC_PATH_ROOT.'/Model/EntityModel/orderstatue.class.php';
		require DOC_PATH_ROOT.'/Model/EntityModel/ordercategory.class.php';
		//获取订单状态
		$orderStatueArrRaw = OrderStatue::getOrderStatue();
		$orderStatueArr = array();
		foreach ($orderStatueArrRaw as $key => $value) {
			$orderStatueArr[] = $value['orderStatueName'];
		}
		//获取订单分类
		$orderCategoryArrRaw = OrderCategory::getOrderCategory();
		$orderCategoryArr = array();
		foreach ($orderCategoryArrRaw as $key => $value) {
			$orderCategoryArr[] = $value['orderCategoryName'];
		}
		//分页导航栏 不带div的字符串
        $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Order&method=orderManage");
        
        include DOC_PATH_ROOT.'/View/Admin/Order/orderManage.php';
	}
//-------------------------------------------------------------
//------------推送功能------------------------------------------
//-------------------------------------------------------------
	/**
	 *发推送界面
	 */
	function sendPush(){
	    include DOC_PATH_ROOT.'/View/Admin/Push/sendPush.php';
	}
	/**
	 *发广播推送
	 */
	function sendBroadCastPush(){
		if(isset($_POST['broadcastText'])){
			require(DOC_PATH_ROOT."/Lib/Push/push.jpush.func.php");
			$broadcastText = $_POST['broadcastText'];
			$resStr = PushWithJpush::sendNotification(0,$broadcastText);
			echo $resStr;

			// echo Json::makeJson("200",$broadcastText);
		}else{
			echo Json::makeJson("400","请求错误");
		}
	}
//-------------------------------------------------------------
//------------管理图片轮播管理----------------------------------------
//-------------------------------------------------------------
	/**
	 * 管理图片轮播
	 */
	public function imageCarousel(){
		//当前页
		$currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
		//每一页的纪录条数
		$singlePageRecordCount = 2.0;
	    //总的纪录数
	    $sql = "select count(*) count from imageCarousel;";
	    $totalRecordCount = Pages::getTotalRecordCount($sql);
		//总的页数
		$pageCount = ceil($totalRecordCount / $singlePageRecordCount);

	    $imageCarousel = new ImageCarousel('','','','','','');
	    $res = $imageCarousel ->getImageCarousel($currentPage,$singlePageRecordCount);

	    //分页导航栏 不带div的字符串
	    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=imageCarousel");
	    include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/imageCarousel.php';
	}
	/**
	 * 新增轮播图片
	 */
	public function addImageCarousel(){
	    //异步上传图片
	    if(isset($_POST["addImage"])){
	        if($_FILES["image"] == array()){
	            // return Json::makeJson(400,'请选择文件');
	            header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=请选择文件");
	            return ;
	        }
	        //文件错误
	        if($_FILES["image"]['error'] == 1 || $_FILES["image"]['error'] == 2){
	            // return Json::makeJson(400,'文件过大');
	            header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=文件过大");
	        	return ;
	        //服务器错误
	        }elseif ($_FILES["image"]['error'] > 2){
	            // return Json::makeJson(400,'服务器错误1');
	            header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误1");
            	return ;
            //正常
	        }else{
	            //第二部：判断类型
	            $str = basename($_FILES["image"]["name"]);
	            $arr = explode(".",$str);
	            $ext = array_pop($arr);
	            $allowExt = array("gif","png","jpeg","jpg");
	            if(!in_array($ext, $allowExt)){
	                // return Json::makeJson(400,'不支持的文件类型');
	                header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=不支持的文件类型");
	            	return ;
	            }
	            //第三部：改文件名
	            date_default_timezone_set("PRC");
	            $upfile = $_FILES["image"]["tmp_name"];
	            $fileRute = $_SERVER["DOCUMENT_ROOT"]."/Content/image/carousel/".date("Ymd").'/';
	            if(!is_dir($fileRute)){
    	            mkdir($fileRute);
	            }
	            $fileName = date("YmdHis").rand(100,999).".".$ext;
	            $newfile = $fileRute.$fileName;
	            //第四部：保存文件
	            if(move_uploaded_file($upfile, $newfile)){
	            	//--------------------------
	            	//   上传成功后要等比缩放图片的大小 缩放为：1320 X 450
	                list($width,$height) = getimagesize($newfile);
	                if($width != CAROUSEL_IMAGE_WIDTH || $height != CAROUSEL_IMAGE_HEIGHT){
    	            	// ImageProc::scaleImageKeepRate($newfile , CAROUSEL_IMAGE_WIDTH , CAROUSEL_IMAGE_HEIGHT);
    	            	ImageProc::scaleImage($newfile , CAROUSEL_IMAGE_WIDTH , CAROUSEL_IMAGE_HEIGHT);
	                }
	            	
	                // return Json::makeJson(200,'上传成功',array("imagePath" =>$newfile));
	                header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=上传成功&imagePath=".$newfile);
	                return ;
	            }else{
	                // return Json::makeJson(400,'服务器错误2');
	                header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误2");
	                return ;
	            }
	        }
        //异步提交表单
	    }elseif(isset($_POST["addImageC"])){
	        $imageDescript = $_POST['imageDescript'];
	        $imageURL = $_POST['imageURL'];
	        $imagePath = $_POST['imagePath'];
	        $imageWeight = $_POST['imageWeight'];
	        if(isset($_POST['isShow']) && $_POST['isShow'] == "on"){
	            $isShow = 1;
	        }else{
	        	$isShow = 0;
	        }
	        $imageUploadTime = time();
	        $imageCarousel = new ImageCarousel($imagePath, $imageURL, $imageDescript, $imageUploadTime, $isShow, $imageWeight);
	        $res = $imageCarousel ->addImageCarousel($imageCarousel);
	        if($res){
	            $step = "three";
	            include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/addImageCarousel.php';
	        }else{
	            $step = "one";
	            $errorinfo = '很抱歉,添加失败';
	            include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/addImageCarousel.php';
	        }
	    //
	    }else{
	    	if(isset($_GET['errorinfo'])){
	    		if(isset($_GET['imagePath'])){
	    			$step = "two";
	    			$imagePath = $_GET['imagePath'];
	    			include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/addImageCarousel.php';
	    		}else{
	    			$step = "one";
		    		$errorinfo = $_GET['errorinfo'];
			    	include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/addImageCarousel.php';
	    		}
	    	}else{
	    		$step = "one";
	    		$errorinfo = "";
	    		include DOC_PATH_ROOT.'/View/Admin/ImageCarousel/addImageCarousel.php';
	    	}
	    }
	}
	/**
	 * 展示与否 轮播图片
	 */
	function showImageCarousel(){
	    if(isset($_GET['action'])){
    		$action = $_GET['action'];
    		$id = isset($_GET['id']) ? $_GET['id'] : 0;
    		$imageCarousel = new ImageCarousel('','','','','','');
    		if($action == 'close'){
    	    	$res = $imageCarousel ->closeShowImageCarousel($id);
    		}elseif($action == 'open'){
    	    	$res = $imageCarousel ->openShowImageCarousel($id);
    		}else{
    			header("location:index.php?controller=Admin&method=imageCarousel");
    		}
    			header("location:index.php?controller=Admin&method=imageCarousel");
	    }
// 		$action = isset($_GET['action']) ? $_GET['action'] : 'open';
// 		$id = isset($_GET['id']) ? $_GET['id'] : 0;
// 		$imageCarousel = new ImageCarousel('','','','','','');
// 		if($action == 'close'){
// 	    	$res = $imageCarousel ->closeShowImageCarousel($id);
// 		}elseif($action == 'open'){
// 	    	$res = $imageCarousel ->openShowImageCarousel($id);
// 		}else{
// 			header("location:index.php?controller=Admin&method=imageCarousel");
// 		}

	 //    //取消成功
		// if($res){
		// 	header("location:index.php?controller=Admin&method=imageCarousel");
		// //取消失败
	 //    }else{
		// 	header("location:index.php?controller=Admin&method=imageCarousel");
	 //    }
	}
	/**
	 *删除轮播
	 */
	function delImageCarousel(){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$imageCarousel = new ImageCarousel('','','','','','');
	    $res = $imageCarousel ->delImageCarousel($id);
	 //    //取消成功
		// if($res){
		// 	header("location:index.php?controller=Admin&method=imageCarousel");
		// //取消失败
	 //    }else{
			header("location:index.php?controller=Admin&method=imageCarousel");
	 //    }
	}
}
