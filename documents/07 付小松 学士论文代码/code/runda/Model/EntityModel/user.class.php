<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
//引入发邮件文件
// require_once(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");
//引入发短信文件
// require_once(DOC_PATH_ROOT."/Lib/SendSMS/sendsms.juhe.func.php");
//用户
// ID、用户名、密码、昵称、性别、真实姓名、头像、手机号码、邮箱、
// 身份证扫描图片、身份证号、用户角色ID、锁定情况、
// 省份ID、市ID、县/区ID、详细地址
//
//   是否被锁定：0、1。
//			0表示为未被锁定，可以自由操作，
//			1表示被锁定，只能申请解除锁定操作，其他操作全部封住。

class User {
	//成员属性
	private $id; //ID  int  not null
	private $userName; //用户名  string  not null
	private $passWord; //密码  string  not null
	private $nickName; //昵称  string 可空
	private $sex; //性别  string  not null
	private $realName; //真实姓名 string  可空
	private $photo; //头像 string (是url)  有默认值
	private $phoneNumber; //手机号码 string  not null
	private $email; //邮箱 string 可空
	private $idCardGraph; //身份证扫描图片 string (是url) 可空
	private $idCardNumber; //身份证号 string 可空
	private $role;  //用户角色    外键ID  int  not null
	private $isLock; //锁定情况  int  not null
	private $province; //省份   外键ID int     not null
	private $city; //市   外键ID int   not null
	private $country; //县/区  外键ID int   not null
	private $detailAddress; //详细地址 string   not null
	
//-----------------------------------------------------------------------------
//--------------用户注册-------------------------------------------------------
//-----------------------------------------------------------------------------
    /**
     * 用户注册 即时添加用户
     */
    public function addUser($userName,$password,$nickName,$sex,$realName,$phoneNumber,$email,$province,$city,$country,$detailAddress){
		$sql = "insert into user(userName,password,nickName,sex,realName,phoneNumber,email,province,city,country,detailAddress) values(?,?,?,?,?,?,?,?,?,?,?);";
        $sql2 = "select LAST_INSERT_ID() last_id;";
        try{
            $rowCount = DBActive::executeNoQuery($sql, array($userName,$password,$nickName,$sex,$realName,$phoneNumber,$email,$province,$city,$country,$detailAddress));
            //获取最新插入纪录的id
            $lastID = DBActive::executeQuery($sql2);

			if($rowCount > 0){
				//----------- the CentOS is Error---------------------------
				//----用户注册成功后，邮箱不为空就给他发邮件发送邮件
				
// 			    if($email != ''){
//                     require(DOC_PATH_ROOT."/Lib/SwiftMailer/sendemail.swiftmailer.func.php");
//     				$swiftMailer = new SwiftMailer();
//     				$subject = "恭喜您,注册成功";
//     				$body = "您好,恭喜您注册成功,您的用户名是:".$userName.",您可以点击网站上的'联系我们'向我们提出您的宝贵意见。感谢您的注册，您的支持将是我们进步的最大的动力!";
//     				$swiftMailer ->sendMail($email,"",$subject,$body);
// 			    }
			    
                //----发短信------------------------------------------------------------------------------------			    
			    //----用户注册成功后，给他发短信 Date:20150425 23:17

                //---------------------------------------------------------------------
                //---------调试使用-------------------------------------------------
                //---------------------------------------------------------------------
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
                //---------------------------------------------------------------------
                //---------上线使用-------------------------------------------------
                //---------------------------------------------------------------------
                
			    
			    
			    
//                 require(DOC_PATH_ROOT."/Lib/SendSMS/sendsms.juhe.func.php");
//                 $sender = new SendSMSByJuHe();
//                 $value = urlencode("#app#=润达智能送水&#username#=".$userName);
//                 // 2428 是注册模板
//                 $sender ->sendSMS($phoneNumber,"2428",$value);

			    
			    
                // if($res == "404"){
                //  return Json::makeJson("400","phone number error");
                // }
                // if($res == "600"){
                //  return Json::makeJson("400","remote service error");
                // }
                // if($res == "500"){
                //  return Json::makeJson("400","local service error");
                // }
			    //-----------------------------
    //----------------------------------------------------------------------------------------			    
				//注册成功
				return Json::makeJson("200","注册成功",$lastID[0]['last_id']);
			}else{
				$code = "400";
				$message = "注册失败,请检查你输入的信息后重试";
				return Json::makeJson($code,$message);
			}
		}catch(PDOException $e){
			//注册失败
			$code = "400";
			$message = $e->getMessage();
			return Json::makeJson($code,$message);
		}
    }
    /**
     *验证用户名是否可用
     */
    public function checkUserName($userName){
    	$sql = "select count(*) number from user where userName=?;";
    	try{
    		$res = DBActive::executeQuery($sql,array($userName));
    		if($res[0]["number"] != 0){
    			return Json::makeJson("400","用户名不可用","");
    			// return Json::makeJson(400,$res,"");
    		}else{
    			return Json::makeJson("200","用户名可用","");
    			// return Json::makeJson(200,"4","");
    		}
    	}catch (Exception $e){
    		return Json::makeJson("400","系统错误","");
    		// return Json::makeJson(400,"2","");
    	}
    }
    /**
     *验证邮箱是否已经注册
     */
    public function checkEmail($email){
    	$sql = "select count(*) number from user where email=?;";
    	try{
    		$res = DBActive::executeQuery($sql,array($email));
    		if($res[0]["number"] != 0){
    			return Json::makeJson("444","邮箱已注册","");
    			// return Json::makeJson(400,$res,"");
    		}else{
    			return Json::makeJson("200","邮箱未注册","");
    			// return Json::makeJson(200,"4","");
    		}
    	}catch (Exception $e){
    		return Json::makeJson("400","系统错误","");
    		// return Json::makeJson(400,"2","");
    	}
    }
    /**
     *验证手机号是否已经注册
     */
    public function checkPhoneNumber($phoneNumber){
    	$sql = "select count(*) number from user where phoneNumber=?;";
    	try{
    		$res = DBActive::executeQuery($sql,array($phoneNumber));
    		if($res[0]["number"] != 0){
    			return Json::makeJson("444","手机号已注册","");
    			// return Json::makeJson(400,$res,"");
    		}else{
    			return Json::makeJson("200","手机号未注册","");
    			// return Json::makeJson(200,"4","");
    		}
    	}catch (Exception $e){
    		return Json::makeJson("400","系统错误","");
    		// return Json::makeJson(400,"2","");
    	}
    }
//-----------------------------------------------------------------------------
//--------------管理员登录-----------------------------------------------------
//-----------------------------------------------------------------------------
	//通过用户名 密码 查询用户 用于管理员登录
	public function ValideAdmin($userName,$passWord){
		//用户名或密码不能为空
		if($userName == "" || $passWord == ""){
			return Json::makeJson("400","用户名或密码不能为空");
		}else{
		//用户名密码不为空
            $sql = "select id from user where userName=? and passWord=?  and role=?";
            try{
                $res = DBActive::executeQuery($sql,array($userName,$passWord,3));
			}catch (Exception $e){
                return Json::makeJson("400",'系统错误,请重试');
			}
			if($res == null){
                return Json::makeJson("400",'用户名或密码错误(请使用管理员账号登陆)');
			}else{
			    $id = $res[0]["id"];
			    return Json::makeJson("200",'登录成功',array('id' =>$id));
			}
		}
	}
//-----------------------------------------------------------------------------
//--------------用户登录-----用户名||手机号------------------------------------
//-----------------------------------------------------------------------------
	//1  通过用户名 密码 查询用户 用于用户登录
	public function ValideUserWithUserName($userName,$passWord){
		//用户名或密码不能为空
		if($userName == "" || $passWord == ""){
			return Json::makeJson("400","用户名或密码不能为空");
		}else{
			//用户名密码不为空
		    //$sql = "select id,isLock from user where userName=? and passWord=?;";
            $sql = "select id from user where userName=? and passWord=?;";
			try{
		    	$res = DBActive::executeQuery($sql,array($userName,$passWord));
			}catch (Exception $e){
			    return Json::makeJson("400",'系统错误');
			}
			if($res == null){
			    return Json::makeJson("400",'用户名或密码错误');
			}else{
				//if($res[0]['isLock'] == 1){
				//	$id = $res[0]['id'];
				//	return Json::makeJson("444",'你已被锁定',array('id' =>$id));
				//}else{
				    $id = $res[0]['id'];
				    return Json::makeJson("200",'登录成功',array('id' =>$id));
				//}
			}
		}
	}
	//2  通过手机号 密码 查询用户 用于用户登录
	public function ValideUserWithPhone($phoneNumber, $passWord){
		//用户名或密码不能为空
		if($phoneNumber == "" || $passWord == ""){
			return Json::makeJson("400","手机号或密码不能为空");
		}else{
			//用户名密码不为空
		    //$sql = "select id,userName,isLock from user where phoneNumber=? and passWord=?;";
            $sql = "select id,userName from user where phoneNumber=? and passWord=?;";
			try{
		    	$res = DBActive::executeQuery($sql,array($phoneNumber,$passWord));
			}catch (Exception $e){
			    return Json::makeJson("400",'系统错误');
			}
			if($res == null){
			    return Json::makeJson("400",'手机或密码错误');
			}else{
				//if($res[0]['isLock'] == 1){
				//	$id = $res[0]['id'];
				//	return Json::makeJson("444",'你已被锁定',array('id' =>$id));
				//}else{
				    $id = $res[0]['id'];
				    $userName = $res[0]['userName'];
				    return Json::makeJson("200",'登录成功',array('id' =>$id,'userName'=>$userName));
				//}
			}
		}
	}
//-----------------------------------------------------------------------------
//--------------送水工登录------------------------------------
//-----------------------------------------------------------------------------
	public function valideWaterBearer($phoneNumber,$passWord){
		//用户名或密码不能为空
		if($phoneNumber == "" || $passWord == ""){
			return Json::makeJson("400","手机号或密码不能为空");
		}else{
			//用户名密码不为空
			$sql = "select id,userName from user where phoneNumber=? and passWord=? and role=1;";
			try{
				$res = DBActive::executeQuery($sql,array($phoneNumber,$passWord));
			}catch (Exception $e){
				return Json::makeJson("400",'系统错误');
			}
			if($res == null){
				return Json::makeJson("400",'手机号或密码错误');
			}else{
				$id = $res[0]['id'];
				$userName = $res[0]['userName'];
				return Json::makeJsonIncludeJson("200",'登录成功',array('id' =>$id,'userName'=>$userName));
			}
		}
	}
//-------------------------------------------------------------------------
//--------------获取个人信息-----------------------------------------------
//-------------------------------------------------------------------------
    /**
     * 获取个人信息
     * Home控制器调用， web版和 Phone版都使用了该函数，该函数是查询当前登录用户的信息
     */
    public function getUserInformation($userID){
        $sql = "select * from user where id=?;";
        try{
        	DBActive::executeNoQuery("set character_set_results=utf8");
            $result = DBActive::executeQuery($sql,array($userID));
            if($result != null){
            	return $result[0];
            }else{
            	return null;
            }
        }catch(PDOException $e){
            return null;
        }
    }
    /**
     * 根据用户id获取用户部分信息 移动端Phone使用，且是指定id
     */
    public function getUserPartInformation($userID){
    	$sql = "select id,userName,nickName,sex,realName,phoneNumber,email,province,city,country,detailAddress from user where id=?";
    	try{
    		DBActive::executeNoQuery("set character_set_results=utf8");
    		$result = DBActive::executeQuery($sql,array($userID));
    		if($result != null){
    			return $result[0];
    		}else{
    			return null;
    		}
    	}catch(PDOException $e){
    		return null;
    	}
    }
    /**
     *获取个人的 真实姓名和手机号
     */
    public function getUserRealNameAndPhone($userID){
    	$sql = "select realName,phoneNumber from user where id=?;";
    	try{
    		DBActive::executeNoQuery("set character_set_results=utf8");
    		$result = DBActive::executeQuery($sql,array($userID));
    		if($result != null){
    			return $result[0];
    		}else{
    			return null;
    		}
    	}catch(PDOException $e){
    		return null;
    	}
    }
//-------------------------------------------------------------------------
//--------------更新用户信息-----------------------------------------------
//-------------------------------------------------------------------------
    public function updateUserInfo($userID, $realName, $province, $city, $country, $detailAddress){
    	$sql2 = "update user set realName=?,province=?,city=?,country=?,detailAddress=? where id=?";
    	try{
    		$result = DBActive::executeNoQuery($sql2,array($realName, $province, $city, $country, $detailAddress,$userID));
    		return Json::makeJson("200","更新成功","");
    	}catch(PDOException $e){
    		return Json::makeJson("400","系统错误","");
// return $e->getMessage(); 
    	}
    }
    
//-------------------------------------------------------------------------
//--------------实名认证---------------------------------------------------
//-------------------------------------------------------------------------
    /**
     *查询用户实名认证状态 
     * param int id
     * return boolean 
     */
    public function checkUserIsRealNameAuthen($userID){
        $sql = "select isRealNameAuthen from user where id=?;";
        try{
            $result = DBActive::executeQuery($sql,array($userID));
            // if($result[0]['count'] > 0){
            // 	return true;
            // }else{
            // 	return false;
            // }
            if($result != null){
            	return $result[0]['isRealNameAuthen'];
            }else{
            	return -1;
            }
        }catch(PDOException $e){
            return -1;
        }
    }
    /**
     *用户申请实名认证 
     */
    public function realNameAuthenApply($id,$realName,$idCardNumber,$idCardGraphFront,$idCardGraphBack){
    	$sql = "update user set realName=?,idCardNumber=?,idCardGraphFront=?,idCardGraphBack=?,isRealNameAuthen=3 where id=?";
    	try{
    		$rowCount = DBActive::executeNoQuery($sql,array($realName,$idCardNumber,$idCardGraphFront,$idCardGraphBack,$id));
    		if($rowCount == 1){
    			return "ok";
    		}else{
    			return "error";
    		}
    	}catch(PDOException $e){
    		return $e ->getMessage();
    	}
    }
    /**
     *处理用户实名认证  管理员使用
     */
    public function realNameAuthenProc($userID,$isRealNameAuthen){
    	$sql = "update user set isRealNameAuthen=? where id=?";
    	try{
    		$rowCount = DBActive::executeNoQuery($sql,array($isRealNameAuthen,$userID));
    		if($rowCount == 1){
    			return true;
    		}else{
    			return false;
    		}
    	}catch(PDOException $e){
    		return false;
    	}
    }

//-------------------------------------------------------------------------
//--------------根据邮箱修改密码-------------------------------------------
//-------------------------------------------------------------------------
    /**
     * 验证邮箱是否注册过，如果注册过就查询出用户名
     */
    public function checkUserByEmail($email){
    	$sql = "select userName from user where email=?;";
        try{
            $res = DBActive::executeQuery($sql,array($email));
	        if($res == null){
	        	return array("code" =>"404","userName" => "");
	            // return Json::makeJson(400,"该邮箱还没有注册");
	        }else{
	        	// $data = array("userName"=>$res[0]['userName']);
	        	return array("code" =>"200","userName" => $res[0]['userName']);
	            // return Json::makeJson(200,"该邮箱已注册",$data);
	        }
        }catch (Exception $e){
        	return array("code" =>"400","userName" => "");
            // return Json::makeJson(400,"系统错误","");
        }
    }
    /**
     * 根据验证邮箱修改密码
     */
    public function changePassWordByEmail($email,$passWord){
    	$sql = "update user set passWord=? where email=?;";
        try{
            $res = DBActive::executeNoQuery($sql,array($passWord,$email));
	        return "200";
        }catch (Exception $e){
        	return "400";
        }
    }

//-------------------------------------------------------------------------
//--------------根据手机号修改密码-----------------------------------------
//-------------------------------------------------------------------------
    		//未写
//-------------------------------------------------------------------------
//--------------解除用户锁定-----------------------------------------------
//-------------------------------------------------------------------------
    		//未写
//-------------------------------------------------------------------------
//--------------管理员管理用户---------------------------------------------
//-------------------------------------------------------------------------
    /**
     * 获取所有用户
     */
    public function getAllUsers($currentPage,$singlePageRecordCount){
        $begin = ($currentPage - 1) * $singlePageRecordCount;
        $sql = "select * from user order by id limit ".$begin.",".$singlePageRecordCount.";";
        try{
        	DBActive::executeNoQuery("set character_set_results=utf8");
            $users = DBActive::executeQuery($sql);
            return $users;
        }catch(PDOException $e){
            return null;
                //return $e->getMessage();
        }
    }
    /**
     * 获取所有申请了实名认证待审核的用户
     */
    public function getWithoutRealNameAuthenUsers($currentPage,$singlePageRecordCount){
        $begin = ($currentPage - 1) * $singlePageRecordCount;
        $sql = "select * from user where isRealNameAuthen=3 order by id limit ".$begin.",".$singlePageRecordCount.";";
        try{
        	DBActive::executeNoQuery("set character_set_results=utf8");
            $users = DBActive::executeQuery($sql);
            return $users;
        }catch(PDOException $e){
            return null;
                //return $e->getMessage();
        }
    }
    /**
     * 删除某一个用户
     * param $id  用户的id
     */
    public function deleteAnUser($id){
        $sql = "delete from user where id=?";
        try{
            DBActive::executeNoQuery($sql,array($id));
            return true;
        }catch(PDOException $e){
            //return $e ->getMessage();
            return false;
        }
    }

//------------------------------------------------------------------------
//--------------移动端使用------------------------------------------------
//------------------------------------------------------------------------
    
}