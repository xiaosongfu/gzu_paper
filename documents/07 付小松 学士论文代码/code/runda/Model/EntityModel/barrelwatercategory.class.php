<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
//桶装水类别
	// 纯净水
	// 矿泉水
	// 蒸馏水
	// 山泉水
	// 其他

class BarrelWaterCategory{
//	private $id;
//	private $barrelWaterCateName;
	/*
	 * 获取类别
	 */
	public static function getBarrelWaterCategory(){
		$sql = "select * from barrelWaterCategory;";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$result = DBActive::executeQuery($sql);
			return $result;
		}catch(PDOException $e){
			return "";
		}
	}
}