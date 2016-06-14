<?php
//引入配置文件
require_once(DOC_PATH_ROOT."/Config/sendsms.juhe.config.php");

/*
	***聚合数据（JUHE.CN）数据接口调用通用DEMO SDK
	***DATE:2014-04-14
*/
class SendSMSByJuHe{

	private $appkey =APPKEY; // 通过聚合申请到数据的appkey

	private $url =URL; // 请求的数据接口URL


	public function sendSMS($phoneNumber,$tpID,$value){
		// ?mobile=手机号码&tpl_id=短信模板ID&tpl_value=%23code%23%3D654654&key=
		$key = "key=".$this->appkey;
	    // $params ='mobile='.$phoneNumber.'&tpl_id='.$tpID.'&dtype=json&tpl_value='.$value.'&key=971865ab33edf77d679056fef50bfce1';//.$this->appkey;
		$params = $key.'&mobile='.$phoneNumber.'&tpl_id='.$tpID.'&tpl_value='.$value;//.'&key=971865ab33edf77d679056fef50bfce1';//.$this->appkey;

		$content = $this->juhecurl($this->url,$params);
		if($content){
		    $result =json_decode($content,true);
			#错误码判断
			$error_code = $result['error_code'];
			//success
			if($error_code ==0){
				return "200";
			//fail
			}elseif($error_code == 205401){
				return "404";
			}else{
				return "600";
				// echo $error_code.':'.$result['reason'];
			}
		}else{
			return "500";
		}
	}
	/*
	    ***请求接口，返回JSON数据
	    ***@url:接口地址
	    ***@params:传递的参数
	    ***@ispost:是否以POST提交，默认GET
	*/
	public function juhecurl($url,$params){
	    $httpInfo = array();
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_0 );
		curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
		curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
		// if( $ispost ){
		// 	curl_setopt( $ch , CURLOPT_POST , true );
		// 	curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
		// 	curl_setopt( $ch , CURLOPT_URL , $url );
		// }
		// else{
		// 	if($params){
				curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
		// 	}else{
				// curl_setopt( $ch , CURLOPT_URL , $url);
		// 	}
		// }
		$response = curl_exec( $ch );
		if ($response === FALSE) {
			#echo "cURL Error: " . curl_error($ch);
			return false;
		}
		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
		curl_close( $ch );
		return $response;
	}
}