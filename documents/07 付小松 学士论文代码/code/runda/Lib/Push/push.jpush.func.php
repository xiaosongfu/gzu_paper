<?php

//jpush库文件
require_once(DOC_PATH_ROOT."/Lib/Push/vendor/autoload.php");
//jpush配置文件
// require_once(DOC_PATH_ROOT."/Config/push.jpush.config.php");
//json文件
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

use JPush\Model as M;
use JPush\JPushClient;
use JPush\JPushLog;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;

//----------------------------使用说明-------------------------------------------
//		http://www.cnblogs.com/jiqing9006/p/3945095.html

// setPlatform  设置平台
// setPlatform(M\all) //设置所有平台
// setPlatform(M\platform('ios', 'android'))//设置android和ios

// setAudience  设置受众
// setAudience(M\all)设置所有受众
// setAudience(M\audience(M\tag(array('tag1','tag2'))))//设置tag为tag1或tag2的受众，群发
// setAudience(M\audience(M\alias(array('123')))) //设置别名alias为123的受众，单发
// setAudience(M\audience(M\alias(array('1','123')),M\tag(array('tag1','tag2'))))
			//取交集，也就是别名为1，且其tag值为tag1或tag2的用户才能收到推送

// setNotification   设置通知
// setNotification(M\notification('Hi, JPush')) //设置通用通知
// setNotification(M\notification('Hi, JPush', M\android('Hi, android'))) 
			//为安卓单独设置信息，ios则是显示第一个内容，也就是除了android之外的都是Hi,JPush
// setNotification(M\notification('Hi, JPush', M\ios('Hi, ios','happy',1,true)))
			//为ios单独设置信息
// setNotification(M\notification('Hi, JPush', M\android('Hi, android'), M\ios('Hi, ios', 'happy', 1, true))) //两个都设置

 // setMessage  设置消息
// 设置message，本方法接受4个参数msg_content(string,必填), title(string),content_type(string), extras(Array)
// setMessage(M\message('这个是推送消息', '这是标题', '', array('url'=>'www.msg.com'))) //设置内容，标题，以及附加值
 // 这里的数据，不是客户端来调用的，是系统调用的。可以不用设置。

//--------------------------------------------------------------------
class PushWithJpush{
	/*
	 *发推送
	 * $type(string) 推送类型 0:广播 1:tags 2:alias
	 * $content(string) 推送内容
	 * $data(array) tags或者alias
	 */
	public static function sendNotification($type,$content,$data = array()){
		JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
		date_default_timezone_set("PRC");
		// $client = new JPushClient(APPKEY, MASTERSECRET);
		$client = new JPushClient("9b89bd0e39491ffb67ab59c3", "dd558bb5727b9d76e1f80c08");
		try {
			//广播
			if($type == 0){
				$result = $client->push()
		        ->setPlatform(M\all)
		        ->setAudience(M\all)
		        ->setNotification(M\notification($content))
		        ->send();
		    //tags
			}elseif($type == 1){
				$result = $client->push()
		        ->setPlatform(M\all)
		        ->setAudience(M\audience(M\tag($data)))
		        ->setNotification(M\notification($content))
		        ->send();
			//alias
			}elseif($type == 2){
				$result = $client->push()
		        ->setPlatform(M\all)
		        ->setAudience(M\audience(M\alias($data)))
		        ->setNotification(M\notification($content))
		        ->send();
			}else{
				return Json::makeJson("400","本地调用错误");
			}
		    return Json::makeJson("200","发送成功");
		} catch (APIRequestException $e) {
		    return Json::makeJson("300","API调用错误");
		} catch (APIConnectionException $e) {
		    return Json::makeJson("500","服务商服务器错误");
		}
	}
}


// //jpush库文件
// require_once(DOC_PATH_ROOT."/Lib/Push/vendor/autoload.php");
// //jpush配置文件
// require_once(DOC_PATH_ROOT."/Config/push.jpush.config.php");
// //json危机
// require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

// use JPush\Model as M;
// use JPush\JPushClient;
// use JPush\JPushLog;
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// use JPush\Exception\APIConnectionException;
// use JPush\Exception\APIRequestException;

// //----------------------------使用说明-------------------------------------------
// //		http://www.cnblogs.com/jiqing9006/p/3945095.html

// // setPlatform  设置平台
// // setPlatform(M\all) //设置所有平台
// // setPlatform(M\platform('ios', 'android'))//设置android和ios

// // setAudience  设置受众
// // setAudience(M\all)设置所有受众
// // setAudience(M\audience(M\tag(array('tag1','tag2'))))//设置tag为tag1或tag2的受众，群发
// // setAudience(M\audience(M\alias(array('123')))) //设置别名alias为123的受众，单发
// // setAudience(M\audience(M\alias(array('1','123')),M\tag(array('tag1','tag2'))))
// // //取交集，也就是别名为1，且其tag值为tag1或tag2的用户才能收到推送

// // setNotification   设置通知
// // setNotification(M\notification('Hi, JPush')) //设置通用通知
// // setNotification(M\notification('Hi, JPush', M\android('Hi, android'))) 
// // //为安卓单独设置信息，ios则是显示第一个内容，也就是除了android之外的都是Hi,JPush
// // setNotification(M\notification('Hi, JPush', M\ios('Hi, ios','happy',1,true)))
// // //为ios单独设置信息
// // setNotification(M\notification('Hi, JPush', 
// //M\android('Hi, android'), M\ios('Hi, ios', 'happy', 1, true))) //两个都设置

//  // setMessage  设置消息
// // 设置message，本方法接受4个参数msg_content(string,必填), title(string),content_type(string), extras(Array)
// // setMessage(M\message('这个是推送消息', '这是标题', '', array('url'=>'www.msg.com'))) //设置内容，标题，以及附加值
//  // 这里的数据，不是客户端来调用的，是系统调用的。可以不用设置。

// //--------------------------------------------------------------------
// class PushWithJpush{
// 	/*
// 	 *发广播推送 广播
// 	 */
// 	public static function sendBroadcastNotification($content){
// 		JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
// 		date_default_timezone_set("PRC");
// 		$client = new JPushClient(APPKEY, MASTERSECRET);
// 		try {
//     		$result = $client->push()
// 		        ->setPlatform(M\all)
// 		        ->setAudience(M\all)
// 		        ->setNotification(M\notification($content))
// 		        ->send();
// 		    return Json::makeJson("200","发送成功");
// 		} catch (APIRequestException $e) {
// 		    return Json::makeJson("300","API调用错误");
// 		} catch (APIConnectionException $e) {
// 		    return Json::makeJson("500","服务商服务器错误");
// 		}
// 	}
// 	/*
// 	 *向指定的Tag发送推送 群发
// 	 */
// 	public static function sendNotificationWithTag($content,$tags = array()){
// 		JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
// 		date_default_timezone_set("PRC");
// 		$client = new JPushClient(APPKEY, MASTERSECRET);
// 		try {
//     		$result = $client->push()
// 		        ->setPlatform(M\all)
// 		        ->setAudience(M\audience(M\tag($tags)))
// 		        ->setNotification(M\notification($content))
// 		        ->send();
// 		    return Json::makeJson("200","发送成功");
// 		} catch (APIRequestException $e) {
// 		    return Json::makeJson("300","API调用错误");
// 		} catch (APIConnectionException $e) {
// 		    return Json::makeJson("500","服务商服务器错误");
// 		}
// 	}
// 	/*
// 	 *向指定的Alias发送推送 单发
// 	 */
// 	public static function sendNotificationWithAlias($content,$alias = array()){
// 		JPushLog::setLogHandlers(array(new StreamHandler('jpush.log', Logger::DEBUG)));
// 		date_default_timezone_set("PRC");
// 		$client = new JPushClient(APPKEY, MASTERSECRET);
// 		try {
//     		$result = $client->push()
// 		        ->setPlatform(M\all)
// 		        ->setAudience(M\audience(M\alias($alias)))
// 		        ->setNotification(M\notification($content))
// 		        ->send();
// 		    return Json::makeJson("200","发送成功");
// 		} catch (APIRequestException $e) {
// 		    return Json::makeJson("300","API调用错误");
// 		} catch (APIConnectionException $e) {
// 		    return Json::makeJson("500","服务商服务器错误");
// 		}
// 	}
// }
