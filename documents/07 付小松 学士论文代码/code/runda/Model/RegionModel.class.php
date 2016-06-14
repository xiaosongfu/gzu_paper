<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
class Region{
	/**
	 * 从数据库获取省份
	 * 返回一个二维数组
	 * 形如：
	 * Array
	 *		(
	 *		    [0] => Array
	 *		        (
	 *		            [id] => 1
	 *		            [name] => 鍖椾含甯�
	 *		        )
	 *		    [1] => Array
	 *		        (
	 *		            [id] => 2
	 *		            [name] => 澶╂触甯�
	 *		        )
	 *		    [2] => Array
	 *		        (
	 *		            [id] => 3
	 *		            [name] => 娌冲寳鐪�
	 *		        )
	 *		)
	 */
	public static function getProvinces(){
// 		DBActive::executeNoQuery("set character_set_results=utf8");
// 		Region_DBActive::executeNoQuery("set character_set_results=utf8");
		$sql = "select * from provinces;";
		try{
// 			$result = DBActive::executeQuery($sql, array());
			$result = Region_DBActive::executeQuery($sql, array());
		}catch(PDOException $e){
			return null;
		}
		return $result;
	}
	/**
	 * 从数据库获取市
	 */
	public static function getCities($provinceID){
// 		DBActive::executeNoQuery("set character_set_results=utf8");
// 		Region_DBActive::executeNoQuery("set character_set_results=utf8");
		$sql = "select * from cities where provinceID = ?;";
		try{
// 			$result = DBActive::executeQuery($sql, array($provinceID));
			$result = Region_DBActive::executeQuery($sql, array($provinceID));
		}catch(PDOException $e){
			return null;
		}
		return $result;
	}
	/**
	 * 从数据库获取县
	 */
	public static function getCountries($cityID){
// 		DBActive::executeNoQuery("set character_set_results=utf8");
// 		Region_DBActive::executeNoQuery("set character_set_results=utf8");
		$sql = "select * from countries where cityID = ?;";
		try{
// 			$result = DBActive::executeQuery($sql, array($cityID));
			$result = Region_DBActive::executeQuery($sql, array($cityID));
		}catch(PDOException $e){
			return null;
		}
		return $result;
	}
	/**
	 *
	 */
	public static function getFirstCityID($provinceID){
// 		DBActive::executeNoQuery("set character_set_results=utf8");
// 		Region_DBActive::executeNoQuery("set character_set_results=utf8");
		$sql = "select * from cities where provinceID = ? limit 0,1;";
		try{
// 			$result = DBActive::executeQuery($sql, array($provinceID));
			$result = Region_DBActive::executeQuery($sql, array($provinceID));
		}catch(PDOException $e){
			return null;
		}
		return $result;	
	}
}