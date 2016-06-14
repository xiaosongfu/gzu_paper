<?php
//引入数据库操作文件
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
//引入json操作文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入发邮件文件
// require_once(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");
//引入发短信文件
// require_once(DOC_PATH_ROOT."/Lib/SendSMS/sendsms.juhe.func.php");
// 水店
//   ID、负责人ID、水店名字
//   水店电话、水店固定电话、水店邮箱、是否被锁定、状态
//   省份ID、市ID、县ID、详细地址、营业执照图片url

class WaterStore {

	private $id; //ID  int  not null
	private $owner; //负责人ID  int not null
	private $waterStoreName; //水店名字  string not null
	private $waterStoreTellPhone; //水店电话 not null
	private $waterStoreFixedLinePhone; //水店固定电话
	private $waterStoreEmail; //水店邮箱
	//-------------水站邮箱有就给水站邮箱发邮件，不然就给负责人发
	private $isLock; //锁定情况  int  not null 有默认值
	private $waterStoreStatus; //状态  tinyint  not null 有默认值
	private $auditStatus;// tinyint not null default 0,
	private $auditDetail;// varchar(100),
	private $province; //省份   外键ID int     not null
	private $city; //市   外键ID int   not null
	private $country; //县/区  外键ID int   not null
	private $detailAddress; //详细地址 string   not null
	private $waterStoreLongitude; // varchar(20),-- 经度
	private $waterStoreLatitude; // varchar(20), -- 纬度
	private $businessLicense; //营业执照图片 url string   not null
	
//--------------------------------------------------------------------
//-------------水站入驻-------------------------------------------
	/*
	 *检查水站名称是否可用
	 */
	public function checkWaterStoreName($waterStoreName){
		$sql = "select count(*) count from waterStore where waterStoreName=?";
		try{
			$res = DBActive::executeQuery($sql,array($waterStoreName));
			if($res[0]["count"] != 0){
	            return Json::makeJson("400","水站名称不可用","");
	            // return Json::makeJson(400,$res,"");
	        }else{
	            return Json::makeJson("200","水站名称可用","");
	            // return Json::makeJson(200,"4","");
	        }
		}catch(PDOException $e){
			return Json::makeJson("400","系统错误","");
		}
	}

	/*
	 *水站入驻  
	 * param owner 负责人ID  int
	 */
	public function waterStoreEnter($owner,$waterStoreName,$waterStoreTellPhone,$waterStoreFixedLinePhone,$waterStoreEmail,$province,$city,$country,$detailAddress,$businessLicense){
		$sql = "insert into waterStore(owner,waterStoreName,waterStoreTellPhone,waterStoreFixedLinePhone,waterStoreEmail,province,city,country,detailAddress,businessLicense) values(?,?,?,?,?,?,?,?,?,?);";
		try{
	    	$rowCount = DBActive::executeNoQuery($sql,array($owner,$waterStoreName,$waterStoreTellPhone,$waterStoreFixedLinePhone,$waterStoreEmail,$province,$city,$country,$detailAddress,$businessLicense));
	    	if($rowCount > 0){
	    	    //----水站入驻 提交申请后后，水站邮箱不为空就给他发邮件发送邮件
	    	    if($waterStoreEmail != ''){
	    	    	require(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");
	    	        $swiftMailer = new SwiftMailer();
	    	        $subject = "水站入驻";
	    	        $body = "您好,您的水站入驻申请已经成功提交,我们将在3个工作日内审核,请您耐心等候,您可以点击网站上的'联系我们'向我们提出您的宝贵意见,您的支持将是我们进步的最大的动力!";
	    	        $swiftMailer ->sendMail($waterStoreEmail,"",$subject,$body);
	    	    }
	    		//成功
	    		return Json::makeJson("200",'申请入驻成功');
	    	}else{
	    		//失败
	    		return Json::makeJson("400",'水站信息错误导致申请入驻失败');
	    	}
		}catch(Exception $e){
			    // return Json::makeJson("400",'系统错误导致申请入驻失败');
			    return Json::makeJson("400",$e->getMessage());
		}
	}

//-------------------------------------------------------------
//-------------水站使用->管理水站信息----------------------------------
	/*
	 *根据用户id查询用户的水站
	 * param owner 负责人ID  int
	 */
	public function queryMyWaterStore($owner){
		$sql ="select * from waterStore where owner=?";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$res = DBActive::executeQuery($sql,array($owner));
			return $res;
		}catch(PDOException $e){
			return "";
		}
	}
	/*
	 * 获取水站信息
	 * param $waterStoreID 水站ID
	 */
	public function getwaterStoreInformation($waterStoreID){
	    $sql = "select * from waterStore where id=?";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterStoreID));
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
    /*
     * 获取水站营业执照
     * param $waterStoreID 水站ID
     */
	public function getwaterStoreBusinessLicense($waterStoreID){
	    $sql = "select businessLicense from waterStore where id=?";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterStoreID));
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//-------------------------------------------------------------
//-------------水站使用->水站业绩----------------------------------
	/*
	 *获取某一水站的所有桶装水
	 */
	public function getAllOrder($waterStoreID,$currentPage,$singlePageRecordCount){
		require(DOC_PATH_ROOT."/Model/EntityModel/orderdetail.class.php");
		$order = new OrderDetail();
		$orderResult = $order ->getAllOrderOfOneWaterStore($waterStoreID,$currentPage,$singlePageRecordCount);
		return $orderResult;
	}

//---------------------------------------------------------------------------
//-------------管理员使用->管理水站------------------------------------
	/*
	 *获取未审核水站
	 */
	public function getWaterStoreWithoutAudit(){
	    $sql = "select * from waterStore where auditStatus=0";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
     *审核水站 通过
     */
	public function auditWaterStorePass($waterStoreID,$waterStoreLongitude,$waterStoreLatitude){
		$sql = "update waterStore set auditStatus=1,waterStoreLongitude=?,waterStoreLatitude=? where id=?";
	    try{
	        $rowCount = DBActive::executeNoQuery($sql,array($waterStoreLongitude,$waterStoreLatitude,$waterStoreID));
	        if($rowCount > 0){

	        	//----------- the CentOS is Error---------------------------
				//----水站审核通过后，水站邮箱不为空就给他发邮件发送邮件
			    // if($email != ''){
			    // 	// try{
	    		// 		$swiftMailer = new SwiftMailer();
	    		// 		// sendMail($to,$name,$subject,$body);
	    		// 		// $email = $_POST['email'];
	    		// 		$subject = "恭喜您,注册成功";
	    		// 		$body = "您好,恭喜您注册成功,您的用户名是:".$userName.",您可以点击网站上的'联系我们'向我们提出您的宝贵意见。感谢您的注册，您的支持将是我们进步的最大的动力!";
	    		// 		$swiftMailer ->sendMail($email,"",$subject,$body);
	    		// 		//--------------------------------------
    			// 	// }catch(PDOException $e){}
			    // }
	//----发短信------------------------------------------------------------------------------------			    
			    //----水站审核通过后，给负责人发短信 Date:20150425 23:17
				// require(DOC_PATH_ROOT."/Lib/SendSMS/sendsms.juhe.func.php");
				// $sender = new SendSMSByJuHe();
				// $val = "#app#=润达智能送水&#username#=".$userName;
				// $value = urlencode($val);
			 //    // $sender = new SendSMSByJuHe();
			 //    // $value = urlencode("#app#=润达智能送水&#username#=".$userName);
			 //    $res = $sender ->sendSMS($phoneNumber,"2428",$value);
			 //    if($res == "404"){
			 //    	return Json::makeJson("400","phone number error");
			 //    }
			 //    if($res == "600"){
			 //    	return Json::makeJson("400","remote service error");
			 //    }
			 //    if($res == "500"){
			 //    	return Json::makeJson("400","local service error");
			 //    }
			    //-----------------------------
	        	return true;
	        }else{
	        	return false;
	        }
	    }catch(PDOException $e){
	        return false;
	    }
	}
	/*
     *审核水站 不通过
     */
	public function auditWaterStoreFail($waterStoreID,$auditDetail){
		$sql = "update waterStore set auditStatus=2,auditDetail=? where id=?";
	    try{
	        $rowCount = DBActive::executeNoQuery($sql,array($auditDetail,$waterStoreID));
	        if($rowCount > 0){
	        	return true;
	        }else{
	        	return false;
	        }
	    }catch(PDOException $e){
	        return false;
	    }
	}
	/*
	 * 获取所有的水站
	 */
	public function getAllWaterStore(){
	    $sql = "select * from waterStore";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//-------------网站首页使用->获取热榜水站----------------------------
//------------------------------------------------------------------
	/*
	 *获取热榜水站
	 */
	public function getHottestWaterStore($count = 6){
	    $sql = "select * from waterStore order by id desc limit 0,".$count.";";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//-------------------------------------------------------------------------------
//-------------我的水站首页使用--------------------------------------------
	/*
	 *通过水站id获取水站
	 */
	public function getMyWaterStore($waterSID){
		$sql = "select * from waterStore where id=?";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterSID));
	        if($res != null){
	        	return $res[0];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	        return null;
	    }
	}

	
	
	
	
//-------------------------------------------------------------------------------
//-------------移动端使用-------------------------------------------
	/*
	 *获取附近的水站 移动端使用
	 */
	public function getNearbyWaterStore($count){
		$sql = "select * from waterStore order by id desc limit 0,".$count.";";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$res = DBActive::executeQuery($sql);
			return $res;
		}catch(PDOException $e){
			return null;
		}
	}
	
}