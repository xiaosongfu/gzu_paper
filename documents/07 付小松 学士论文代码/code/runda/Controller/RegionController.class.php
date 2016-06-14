<?php
require_once(DOC_PATH_ROOT."/Model/RegionModel.class.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");
class RegionController{
	/**
	 * 返回Json格式的数据表示获取数据成功
	 * 如返回NULl 或 [] ,则表示获取失败，（移动端开发是可以提示用户稍后再试）
	 */
	function getProvincesJson(){
		$provinces = Region::getProvinces();
		if($provinces != null){
			$code = '200';
			$message = "数据获取成功";
			$data = $provinces;
			echo Json::makeJson($code,$message,$data);
		}else{
			$code = '404';
			$message = "没有找到数据";
			$data = '';
			echo Json::makeJson($code,$message,$data);
		}
	}
	/**
	 * 返回Json格式的数据表示获取数据成功
	 * 如返回NULl 或 [] ,则表示获取失败，（移动端开发是可以提示用户稍后再试）
	 */
	function getCitiesJson(){
		if(!isset($_GET["provinceID"])){
			return null;
		}
		$provinceID = $_GET["provinceID"];
		$cities = Region::getCities($provinceID);
	    if($cities != null){
			$code = '200';
			$message = "数据获取成功";
			$data = $cities;
			echo Json::makeJson($code,$message,$data);
		}else{
			$code = '404';
			$message = "没有找到数据";
			$data = '';
			echo Json::makeJson($code,$message,$data);
		}
	}
	/**
	 * 返回Json格式的数据表示获取数据成功
	 * 如返回NULl 或 [] ,则表示获取失败，（移动端开发是可以提示用户稍后再试）
	 */
	function getCountriesJson(){
		if(!isset($_GET["cityID"])){
			return null;
		}
		$cityID = $_GET["cityID"];
		$countries = Region::getCountries($cityID);
		if($countries != null){
			$code = '200';
			$message = "数据获取成功";
			$data = $countries;
			echo Json::makeJson($code,$message,$data);
		}else{
			$code = '404';
			$message = "没有找到数据";
			$data = '';
			echo Json::makeJson($code,$message,$data);
		}
	}
	/**
	 * 返回Json格式的数据表示获取数据成功
	 * 如返回NULl 或 [] ,则表示获取失败，（移动端开发是可以提示用户稍后再试）
	 */
	function getFirstCityIDJson(){
		if(!isset($_GET["provinceID"])){
			return null;
		}
		$provinceID = $_GET["provinceID"];
		$city = Region::getFirstCityID($provinceID);
	    if($city != null){
			$code = '200';
			$message = "数据获取成功";
			$data = $city;
			echo Json::makeJson($code,$message,$data);
		}else{
			$code = '404';
			$message = "没有找到数据";
			$data = '';
			echo Json::makeJson($code,$message,$data);
		}
	}
}