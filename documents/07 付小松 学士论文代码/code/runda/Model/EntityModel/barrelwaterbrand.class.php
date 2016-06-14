<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
//桶装水品牌
	// 农夫山泉 
	// 怡宝
	// 乐百氏
	// 景田
	// 娃哈哈
	// 雀巢
	// 屈臣氏
	// 哇哈哈
	// 其他
class BarrelWaterBrand{
	private $id;
	private $barrelWaterBrandName;

	public static function getBarrelWaterBrand(){
		$sql = "select * from barrelWaterBrand";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$result = DBActive::executeQuery($sql);
			return $result;
		}catch(PDOException $e){
			return "";
		}
	}
}