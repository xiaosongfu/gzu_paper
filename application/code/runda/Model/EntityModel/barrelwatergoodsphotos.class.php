<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class BarrelWaterGoodsPhotos{
	// -- 4、商品图片表
	private $id; // int not null auto_increment primary key,
	private $waterGoodsID; // int not null,
	private $waterGoodsPhotoPath; // varchar(400),

	/*
	 * 添加桶装水商品图片
	 */
	public function addGoodsPhotos($waterGoodsID,$waterGoodsPhotoPath){
		$sql = "insert into barrelWaterGoodsPhotos(waterGoodsID,waterGoodsPhotoPath) values(?,?);";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($waterGoodsID,$waterGoodsPhotoPath));
			return "1";
		}catch(PDOException $e){
			return "0";
		}
	}

	/*
	 * 查询桶装水的所有图片
	 *  根据桶装水的ID查询
	 */
	public function getBarrelWaterGoodsPhotos($id){
		$sql = "select * from barrelWaterGoodsPhotos where waterGoodsID=?;";
		try{
			DBActive::executeNoQuery("set character_set_results=utf8");
			$result = DBActive::executeQuery($sql,array($id));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}
}