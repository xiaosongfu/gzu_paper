<?php
//引入生成验证码文件
include DOC_PATH_ROOT.'/Lib/ValidCode/validcode.func.php';
//引入Json文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入User文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/user.class.php");
//引入User角色模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/role.class.php");
//引入User收货地址模型文件
require_once(DOC_PATH_ROOT."/Model/EntityModel/userrecieveraddress.class.php");



class HomeController{
//----------------------------------------------------------------
//----------------------用户注册-----------------------------------
//----------------------------------------------------------------
	/**
	 * 用户注册界面
	 */
	function register(){
		include DOC_PATH_ROOT."/View/Home/register.php";
	}
	/**
	 * 用户注册处理
	 */
	function registerProc(){
		//正常注册
		if(isset($_POST['userName']) && isset($_POST['passWord']) && isset($_POST['phoneNumber'])){
			//手机号已注册

			//验证邮箱
			if(isset($_POST['email']) && $_POST['email'] != ""){
				if(!preg_match("/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/",$_POST['email'])){
					echo Json::makeJson("434","邮箱格式错误");
					return ;
				}else{
					$user1 = new User();
					$result = $user1 ->checkEmail($_POST['email']);
					$bool = json_decode($result,true);
					if($bool['code'] == "444"){
						echo Json::makeJson("444","邮箱已注册");
						return ;
					}
				}
			}
			if(!preg_match("/\w*/",$_POST['userName']) || !preg_match("/^1[3456789]\d{9}/",$_POST['phoneNumber'])){
				echo Json::makeJson("454","填写信息有误");
			}else{
				//验证验证码
				$checkcode = $_POST['checkCode'];
				if(strtoupper($checkcode) != $_SESSION['validcode']){
					$code = "400";
					$message = "验证码错误";
					echo Json::makeJson($code,$message);
				}else{
					//1 注册用户
					$user = new User();
					$nickName = isset($_POST['nickName']) ? $_POST['nickName'] : '';
					$realName = isset($_POST['realName']) ? $_POST['realName'] : '';
					$email = isset($_POST['email']) ? $_POST['email'] : '';
					$country = isset($_POST['country']) ? $_POST['country'] : '';
					$result = $user ->addUser($_POST['userName'],md5($_POST['passWord']),$nickName,$_POST['sex'],$realName,$_POST['phoneNumber'],$email,$_POST['province'],$_POST['city'],$country,$_POST['detailAddress']);
					//2 添加收货地址
					$res = json_decode($result,true);
					if($res['code'] == "200"){
						$userRecAddr = new UserRecieverAddress();
	        			$userRecAddr ->addUserRecieverAddress($res['data'], $_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress']);
					}
					echo $result;
				}
			}
		}else{
			$code = "400";
			$message = "请求错误";
			echo Json::makeJson($code,$message);
		}
	}
	/**
	*验证用户名是否可用
	*/
	function checkUserName(){
		if(!isset($_GET['userName'])){
			$code = "400";
			$message = "请求错误";
			$data = "";
			echo Json::makeJson($code,$message,$data);
		}else{
			$userName = $_GET['userName'];
			$user = new User();
			$result = $user ->checkUserName($userName);
			echo $result;
		}
	}
	/**
	*验证邮箱是否已经注册
	*/
	function checkEmail(){
		if(!isset($_GET['email'])){
			$code = "400";
			$message = "请求错误";
			$data = "";
			echo Json::makeJson($code,$message,$data);
		}else{
			$email = $_GET['email'];
			$user = new User();
			$result = $user ->checkEmail($email);
			echo $result;
		}
	}
	/**
	*验证手机号是否已经注册
	*/
	function checkPhoneNumber(){
		if(!isset($_GET['phoneNumber'])){
			$code = "400";
			$message = "请求错误";
			$data = "";
			echo Json::makeJson($code,$message,$data);
		}else{
			$phoneNumber = $_GET['phoneNumber'];
			$user = new User();
			$result = $user ->checkPhoneNumber($phoneNumber);
			echo $result;
		}
	}

//----------------------------------------------------------------
//----------------------用户登录-----------------------------------
//----------------------------------------------------------------
	/**
	 *用户登录界面
	 */
	function login(){
		//用户已经登录了就不能再登录了
		if(isset($_SESSION['id']) && isset($_SESSION['userName'])){
			header("Location:index.php?controller=Home&method=personPage");
		}else{
			include DOC_PATH_ROOT.'/View/Home/login.php';
		}
	}
	/**
	 * 用户登录处理 $_GET['tokenType'] 是说明用户是用户名登陆，还是电话号码登录
	 */
	function loginProc(){
// 		if( (isset($_POST['userName']) || isset($_POST['phoneNumber']))  && isset($_POST['passWord']) && isset($_GET['tokenType'])){
		if(!empty($_POST)){
			//验证验证码
			if(strtoupper($_POST['checkCode']) != strtoupper($_SESSION['validcode'])){
				$code = "400";
				$message = "验证码错误";
				$data = "";
				echo Json::makeJson($code,$message,$data);
			//验证用户名 密码
			}else{
				//-----------------------------------------
				//使用用户名登陆
				if($_GET['tokenType'] == "userName"){
					$username = $_POST['userName'];
					//写Cookie用
					$passwd = $_POST['passWord'];
					//登录用
					$password = md5($passwd);
					$user = new User();
	    			$result = $user ->ValideUserWithUserName($username, $password);
					//登录成功要保存用户名密码
					$res = json_decode($result,true);
					if($res['code']== "200"){
						//保存登录用户的信息
						$_SESSION['id'] = $res['data']['id'];
						$_SESSION['userName'] = $username;
						//根据用户的选择来决定是否保存密码  -- 这一块只有浏览器访问时才可能执行
						$autologin = isset($_POST['autologin']) ? $_POST['autologin'] : '';
						if($autologin == 'on'){
							//写Cookie
							//要加密
							require(DOC_PATH_ROOT."/Lib/EnCryptDeCrypt/encryptdecrypt.func.php");
							$username2 = EncryptDecrypt::encrypt($username,"ascs432gfgx27h653gfi9");
							$passwd2 = EncryptDecrypt::encrypt($passwd,"ascs432gfgx27h653gfi9");

							setcookie('username',$username2,time ()+ 60*60*24*7);
							setCookie('password',$passwd2,time ()+ 60*60*24*7);
						}
						$code = "200";
						$message = "登录成功";
						$data = "";
						echo Json::makeJson($code,$message,$data);
					}else{
						echo $result;
					}
				//-----------------------------------------------------
				//使用手机号登录
				}elseif($_GET['tokenType'] == "phone"){
					$phoneNumber = $_POST['phoneNumber'];
					//写Cookie用
					$passwd = $_POST['passWord'];
					//登录用
					$password = md5($passwd);
					$user = new User();
	    			$result = $user ->ValideUserWithPhone($phoneNumber, $password);
					//登录成功要保存用户名密码
					$res = json_decode($result,true);
					if($res['code']== "200"){
						//保存登录用户的信息
						$_SESSION['id'] = $res['data']['id'];
						$_SESSION['userName'] = $res['data']['userName'];
						//根据用户的选择来决定是否保存密码
						$autologin = isset($_POST['autologin']) ? $_POST['autologin'] : '';
						if($autologin == 'on'){
							//写Cookie
							//要加密
							$phoneNumber2 = EncryptDecrypt::encrypt($phoneNumber,"ascs432gfgx27h653gfi9");
							$passwd2 = EncryptDecrypt::encrypt($passwd,"ascs432gfgx27h653gfi9");

							setcookie('phonenumber',$phoneNumber2,time ()+ 60*60*24*7);
							setCookie('password',$passwd2,time ()+ 60*60*24*7);
						}
						$code = "200";
						$message = "登录成功";
						$data = "";
						echo Json::makeJson($code,$message,$data);
					}else{
						echo $result;
					}
				}else{
					//请求错误
					$code = "400";
					$message = "请求错误";
					$data = "";
					echo Json::makeJson($code,$message,$data);
				}
			}
		}else{
			//请求错误
			$code = "400";
			$message = "请求错误";
			$data = "";
			echo Json::makeJson($code,$message,$data);
		}
	}
	/**
	 * 获取验证码图片
	 */
	function getCode(){
		$code = ValidCode::getCode();
		$_SESSION['validcode'] = strtoupper($code);
		ValidCode::getImage($code);
 	}
 	/**
 	 * 获取验证码字符串
 	 */
 	function getCodeString(){
 	    $code = ValidCode::getCode();
 	    $_SESSION['validcode'] = strtoupper($code);
        echo $code;
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
			if(strtoupper($checkCode) == $_SESSION['validcode']){
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

//----------------------------------------------------------------
//----------------------登录成功后---------------------------------
//----------------------------------------------------------------
	/**
	 * 个人主页
	 */
	function personPage(){
		include DOC_PATH_ROOT.'/View/Home/personPage.php';
	}
	/**
	 * 修改个人信息 业务处理
	 */
	function updateMyInformation(){
		if(empty($_POST)){
			echo Json::makeJson("400","请求错误");
		}else{
			$user = new User();
			$result = $user ->updateUserInfo($_SESSION['id'], $_POST['realName'], $_POST['province'], $_POST['city'], $_POST['country'], $_POST['detailAddress']);
			echo $result;
		}
	}
	/**
	 * 当前登录用户的个人信息 web版
	 */
	function myInformation(){
        $user = new User();
        $userInfo = $user ->getUserInformation($_SESSION['id']);
        $role = Role::getRole();
        $roleArray = array();
        foreach($role as $key=>$value){
            $roleArray[$value['id']] = $value['roleName'];
        }
        include DOC_PATH_ROOT.'/View/Home/myInformation.php';
	}
	/**
	 * 当前登录用户的个人信息 Phone版
	 */
	function myInformationPhone(){
        $user = new User();
        $userInfo = $user ->getUserInformation($_SESSION['id']);
        if($userInfo != null){
            echo Json::makeJson("200","获取用户信息成功",$userInfo);
        }else{
            echo Json::makeJson("400","没有数据");
        }
	}

//----------------------------------------------------------------------------
//----------------------实名认证----------------------------------------------
//----------------------------------------------------------------------------
	/**
	 *实名认证界面
	 */
	function userRealNameAuthentication(){
		// $pos = isset($_GET['pos']) ? $_GET['pos'] : 'zero';
		if(isset($_GET['pos'])){
			$pos = $_GET['pos'];
		}else{
			$user = new User();
			$res = $user ->checkUserIsRealNameAuthen($_SESSION['id']);
			//已经实名认证
			if($res == 0){
			//没有实名认证
				$pos = "zero";
				// include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
			}elseif($res == 1){  //通过
				$pos = "one";
			}elseif($res == 2){  //未通过
				$pos = "two";
				// include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
			}elseif($res == 3){
				$pos = "three";
				// include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
			}
		}
		include DOC_PATH_ROOT.'/View/Home/userRealNameAuthentication.php';
	}
	/**
	 *实名认证处理--处理身份证图片
	 */
	function userRealNameAuthenIDCardImgProc(){
		require_once(DOC_PATH_ROOT."/Lib/ImageProc/imageproc.func.php");
		require_once(DOC_PATH_ROOT."/Config/imagescale.config.php");
		if(!isset($_FILES["idCardGraphImg"])){
	            echo Json::makeJson("4001",'请选择文件');
	            // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=请选择文件");
	            // return ;
	    }else{
	        //文件错误
	        if($_FILES["idCardGraphImg"]['error'] == 1 || $_FILES["idCardGraphImg"]['error'] == 2){
	            echo Json::makeJson("4002",'文件过大');
	         //    header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=文件过大");
	        	// return ;
	        //服务器错误
	        }elseif ($_FILES["idCardGraphImg"]['error'] > 2){
	            echo Json::makeJson("4003",'请求或服务器错误');
	            // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误");
	        	// return ;
	        //正常
	        }else{
	            //第二步：判断类型
	            $str = basename($_FILES["idCardGraphImg"]["name"]);
	            $arr = explode(".",$str);
	            $ext = array_pop($arr);
	            $allowExt = array("gif","png","jpeg","jpg");
	            if(!in_array($ext, $allowExt)){
	                echo Json::makeJson("4004",'不支持的文件类型');
	             //    header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=不支持的文件类型");
	            	// return ;
	            }
	            //第三步：改文件名
	            //设置时区
	            date_default_timezone_set("PRC");

	            //上传文件临时路径
	            $upfile = $_FILES["idCardGraphImg"]["tmp_name"];
	            //文件保存路径
	            $fileRute = $_SERVER["DOCUMENT_ROOT"]."/Content/image/useridcardgraph/".date("Ymd").'/';
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
	                //上传成功后要等比缩放图片的大小 缩放为：  440 X 250
	                list($width,$height) = getimagesize($fileNewName);
	                if($width != IDCARD_GRAPH_WIDTH || $height != IDCARD_GRAPH_HEIGHT){
	                    // ImageProc::scaleImageKeepRate($fileNewName , IDCARD_GRAPH_WIDTH , IDCARD_GRAPH_HEIGHT);
	                    ImageProc::scaleImage($fileNewName , IDCARD_GRAPH_WIDTH , IDCARD_GRAPH_HEIGHT);
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
	                echo Json::makeJson("4005",'服务器错误');
	                // header("location:index.php?controller=Admin&method=addImageCarousel&errorinfo=服务器错误");
	                // return ;
	            }
	        }
	    }
	}
	/**
	 *实名认证申请处理
	 */
	function userRealNameAuthenticationProc(){
		if(isset($_POST['realName']) && isset($_POST['idCardNumber']) && isset($_POST['idCardGraphFront']) && isset($_POST['idCardGraphBack'])){
			if($_POST['realName'] == "" || $_POST['idCardNumber'] == "" || $_POST['idCardGraphFront'] == "" || $_POST['idCardGraphBack'] == ""){
				echo Json::makeJson("400","请求数据不完整");
			}else{
				$user = new User();
				$res = $user ->realNameAuthenApply($_SESSION['id'],$_POST['realName'],$_POST['idCardNumber'],$_POST['idCardGraphFront'],$_POST['idCardGraphBack']);
				if($res == "ok"){
					echo Json::makeJson("200","申请成功");
				}elseif($res == "error"){
					echo Json::makeJson("400","操作异常");
				}else{
					echo Json::makeJson("400",$res);
				}
			}
		}else{
			echo Json::makeJson("400","请求错误");
		}
	}

//----------------------------------------------------------------
//----------------------修改密码 解除锁定-------------------------
//----------------------------------------------------------------
	/**
	 * 修改密码
	 */
	function changePassword(){
		$step = isset($_GET['step']) ? $_GET['step'] : 'one';
		// one 是界面
		// two 是处理
		//three 是界面
		// four 是处理
		if($step == 'one'){
			include DOC_PATH_ROOT.'/View/Home/changePassword.php';
		}elseif($step == 'two'){
			if(!isset($_SESSION['changePasswordCode'])){
				echo Json::makeJson("400","操作超时");
			}else{
				$changePasswordCode = $_POST['changePasswordCode'] ? $_POST['changePasswordCode'] : '';
				if(strtoupper($changePasswordCode) == $_SESSION['changePasswordCode']){
					echo Json::makeJson("200","验证码正确");
				}else{
					echo Json::makeJson("400","验证码错误");
				}
			}
		}elseif($step == 'three'){
			include DOC_PATH_ROOT.'/View/Home/changePassword2.php';
		}elseif($step == 'four'){
			//开始改密码了！！！
			//操作超时
			if(!isset($_SESSION['email'])){
				echo Json::makeJson("400","操作超时");
			}else{
				$email = $_SESSION['email'];
				$password = $_POST['passWord'];
				$password2 = md5($password);
				$user = new User();
				//更新密码 返回字符串 "200" "400"
				$res = $user ->changePassWordByEmail($email,$password2);
				//成功
				if($res == "200"){
					//用户修改密码后要给他发邮件
					$swiftMailer = new SwiftMailer();
					// sendMail($to,$name,$subject,$body);
					$subject = "密码修改通知";
					date_default_timezone_set("PRC");
					$body = "您好,您在".date('Y-m-d H:i:s',time())."通过验证邮箱修改了您的密码,如果不是您本人修改的,请及时登陆修改您的秘密";
					$result = $swiftMailer ->sendMail($email,"",$subject,$body);

					echo Json::makeJson("200","操作成功");
				//失败				
				}else{
					echo Json::makeJson("400","操作失败");
				}
			}
		}
	}
	/**
	 * 修改密码处理
	 */
	function changePasswordProc(){
		//1 该邮箱没有注册过
		//2 该邮箱已经注册了 就把验证码和用户名发给用户
		//    该页面是异步刷新的，要求填入验证码后 
		//    才进入修改密码界面
		if(isset($_POST['email'])){

			$email = $_POST['email'];
			$_SESSION['email'] = $email;
			$user = new User();
			//查询邮箱的情况，返回的是数组
			$arr = $user ->checkUserByEmail($email);
			if($arr['code'] == "404"){
				echo Json::makeJson("404","该邮箱还没有注册");	
			}elseif($arr['code'] == "400"){
				echo Json::makeJson("400","系统错误");	

			}else{
				require(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");
				//发送邮件
				$swiftMailer = new SwiftMailer();
				// sendMail($to,$name,$subject,$body);
				//验证码
				$code = ValidCode::getCode(16);
				$_SESSION['changePasswordCode'] = strtoupper($code);
				$subject = "修改密码确认邮件";
				$body = $arr['userName'].",您好,您正在申请修改密码,验证码是".$code.",将验证码填入验证码框内即可单击下一步。";
				$result = $swiftMailer ->sendMail($email,"",$subject,$body);
				echo $result;
			}
		}else{
			echo Json::makeJson("400",'请求错误');
		}
	}
	/**
	 * 解除锁定     还没有写
	 */
	function debLocking(){
		include DOC_PATH_ROOT.'/View/Home/debLocking.php';
	}

//----------------------------------------------------------------
//----------------------收货地址--------------------------------------
//----------------------------------------------------------------
	/**
	 * 新增收货地址界面
	 */
	function addUserRecieverAddress(){
	    include DOC_PATH_ROOT.'/View/Home/addUserRecieverAddress.php';
	}
    /**
     * 新增收货地址处理
     */
	function addUserRecieverAddressProc(){
	    if(isset($_GET['action']) && $_GET['action'] == "add"){
	        //新增收货地址业务逻辑  $_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress']
	        $userRecAddr = new UserRecieverAddress();
	        if($userRecAddr ->addUserRecieverAddress($_SESSION['id'], $_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress'])){
	            echo Json::makeJson("200","添加成功");
	        }else{
	            echo Json::makeJson("400","添加失败");
	        }
	    }else{
	            echo Json::makeJson("400","请求错误");
	    }
				// 	    $action = isset($_GET['action']) ? 'add':'webPage';
				// 	    if($action == 'add'){
				// 	        //新增收货地址业务逻辑  $_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress']
				// 	        $userRecAddr = new UserRecieverAddress();
				// 	        if($userRecAddr ->addUserRecieverAddress($_SESSION['id'], $_POST['province'],$_POST['city'],$_POST['country'],$_POST['detailAddress'])){
				// 	            print_r(Json::makeJson("200","添加成功"));
				// 	        }else{
				// 	            print_r(Json::makeJson("400","添加失败"));
				// 	        }
				// 	    }else{
				// 	        include '/View/Home/addUserRecieverAddress.php';
				// 	    }
	}
	/**
	 * 管理用户收货地址 web版
	 */
	function magageUserRecieverAddress(){
	   $userRAddr = new UserRecieverAddress();
	   $result = $userRAddr ->getUserRecieverAddress($_SESSION['id']);
	   include DOC_PATH_ROOT.'/View/Home/magageUserRecieverAddress.php';
	}
	/**
	 * 管理用户收货地址  phone版
	 */
	function magageUserRecieverAddressPhone(){
	   $userRAddr = new UserRecieverAddress();
	   $result = $userRAddr ->getUserRecieverAddress($_SESSION['id']);
	   if($result != null){
            echo Json::makeJson("200","获取用户收货地址成功",$result);
        }else{
            echo Json::makeJson("400","获取用户收货地址失败");
        }
	}
	/**
	 * 删除用户收货地址  phone版
	 */
	function deleteUserRecieverAddress(){
		if(isset($_GET['id'])){
			$userRAddr = new UserRecieverAddress();
		    $result = $userRAddr ->deleteAnUserRecieverAddress($_GET['id']);
		    if($result){
		    	echo Json::makeJson("200","删除成功");
		    }else{
		    	echo Json::makeJson("500","删除失败");
		    }
		}else{
			echo Json::makeJson("400","请求错误");
		}
	}

//----------------------------------------------------------------
//----------------------购物车管理---------------------------------------	
//----------------------------------------------------------------
	/**
	 *添加桶装水到购物车
	 */
	function addShoppingCart(){
		//引入购物车模型文件
		require(DOC_PATH_ROOT."/Model/EntityModel/shoppingcart.class.php");
		if(!isset($_GET['id'])){
			echo Json::makeJson("400","请求错误");
		}else{
			//first check this goods is already in this table or not
			$isIn = ShoppingCart::checkGoodsIsAlreadyInShoppingCart($_SESSION['id'], $_GET['id']);
			if($isIn == "yes"){
				echo Json::makeJson("400","该商品已在您的购物车中");
			//add to shopping-cart
			}elseif($isIn == "no"){
				$waterGoodsCount = isset($_GET['waterGoodsCount']) ? $_GET['waterGoodsCount'] : 1;
				$res = ShoppingCart::addToShoppingCart($_SESSION['id'], $_GET['id'],$waterGoodsCount);
				if($res){
					echo Json::makeJson("200","添加成功");
				}else{
					echo Json::makeJson("400","添加失败");
				}
			}else{
				// echo Json::makeJson("400","数据库读写异常");
				echo Json::makeJson("400","系统异常");
			}
		}
	} 
	/**
	 *管理我的购物车 web版
	 */	
	function manageMyShoppingCart(){
		//引入购物车模型文件
		require(DOC_PATH_ROOT."/Model/EntityModel/shoppingcart.class.php");
		require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");

		$barrelWaterGoods = ShoppingCart::getMyShoppingCart($_SESSION['id']);
		if($barrelWaterGoods == null){
			$barrelWaterGoodsResult = null;
		}else{
			$barrelWaterGoodsIDs = array();
			for($i =0;$i <count($barrelWaterGoods); $i++){
				$barrelWaterGoodsIDs[] = $barrelWaterGoods[$i]['waterGoodsID'];
			}
			$barrelWaterG = new BarrelWaterGoods();
			$barrelWaterGoodsResult = $barrelWaterG ->getBarrelWaterGoodsDetailForShoppingCart($barrelWaterGoodsIDs);
		}
		include DOC_PATH_ROOT.'/View/Home/manageMyShoppingCart.php';
	}
	/**
	 *将商品移出购物车
	 */
	function deleteGoodsOnMyShoppingCart(){
		if(isset($_GET['wgid'])){
			require(DOC_PATH_ROOT."/Model/EntityModel/shoppingcart.class.php");
			ShoppingCart::deleteGoodsOnMyShoppingCart($_SESSION['id'], $_GET['wgid']);
			echo Json::makeJson("200", "移出成功");
		}
	}
	/**
	 *管理我的购物车    phone版
	 */
	function manageMyShoppingCartPhone(){
		//引入购物车模型文件
		require(DOC_PATH_ROOT."/Model/EntityModel/shoppingcart.class.php");
		require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
	
		$barrelWaterGoods = ShoppingCart::getMyShoppingCartWithGoodsName($_SESSION['id']);
		if($barrelWaterGoods == null){
			echo '{"code":"300","message":"购物车中没有商品","data":[]}';
		}else{
			echo Json::makeJson("200","获取成功", $barrelWaterGoods);
		}
	}
//----------------------------------------------------------------
//----------------------添加收藏---------------------------------------
//----------------------------------------------------------------
	// function add

//----------------------------------------------------------------
//----------------------移动端使用---------------------------------------
//----------------------------------------------------------------
	/**
	 * 根据用户id获取用户信息 移动端使用
	 * 需要指定用户的id
	 */
	function getUserPartInformationByID(){
		$id = isset($_GET['id']) ? $_GET['id'] : -1;
		$user = new User();
        $userInfo = $user ->getUserPartInformation($id);
        if($userInfo != null){
	    	echo Json::makeJson("200","获取数据成功",$userInfo);
	    }else{
	    	echo Json::makeJson("400","没有数据");
	    }
	}

//----------------------------------------------------------------
//----------------------退出---------------------------------------
//----------------------------------------------------------------
	/**
	 * 退出
	 */
	function quit(){
		//清除Session
		if(isset($_SESSION['id'])){
			unset($_SESSION['id']);
		}
		if(isset($_SESSION['username'])){
			unset($_SESSION['username']);
		}
		//清除Cookie
		if(isset($_COOKIE['username'])){
			setcookie('username');
		}
		if(isset($_COOKIE['password'])){
			setCookie('password');
		}
		//返回登录
		header('Location:index.php?controller=Home&method=login');
	}
}