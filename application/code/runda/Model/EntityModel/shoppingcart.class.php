<?php
//引入数据库操作文件
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");

// create table shoppingCart(
// 	id int not null primary key,
// 	cartOwnerID int not null,  -- 所有者ID
// 	waterGoodsID int not null, -- 该条记录的商品ID 
// 	waterGoodsName varchar(140) not null,
// 	waterGoodsPrice decimal(6,2) not null,
// 	waterGoodsCount tinyint not null default 1, -- 该条记录的商品的数量
// 	addCartTime int, -- 加入购物车时间
// 	foreign key(cartOwnerID) references user(id) ON DELETE CASCADE,
// 	foreign key(waterGoodsID) references barrelWaterGoods(id) ON DELETE CASCADE
// );

class ShoppingCart{

	/*
	 * 判断某用户的某一个桶装水是否已经在购物车表中
	 */
	public static function checkGoodsIsAlreadyInShoppingCart($cartOwnerID,$waterGoodsID){
		$sql = "select count(*) count from shoppingCart where cartOwnerID=? and waterGoodsID=?";
		try{
			$res = DBActive::executeQuery($sql,array($cartOwnerID,$waterGoodsID));
			if($res[0]['count'] == 0){
				return "no";
			}else{
				$sqlUp = "update shoppingCart set waterGoodsCount=waterGoodsCount+1 where cartOwnerID=? and waterGoodsID=?";
				DBActive::executeNoQuery($sqlUp,array($cartOwnerID,$waterGoodsID));
				return "yes";
			}
		}catch(PDOException $e){
			return "error";
		}
	}
	/*
	 *向购物车中添加桶装水
	 */
	public static function addToShoppingCart($cartOwnerID,$waterGoodsID,$waterGoodsCount){
		$sql = "insert into shoppingCart(cartOwnerID,waterGoodsID,waterGoodsCount,addCartTime) values(?,?,?,?);";
		try{
				$addCartTime = time();
				DBActive::executeNoQuery($sql,array($cartOwnerID,$waterGoodsID,$waterGoodsCount,$addCartTime));
				return true;
			}catch(PDOException $e){
				return false;
			}
	}
	/*
	 *查询购物车里的桶装水
	 */	
	public static function getMyShoppingCart($id){
		// $sql = "select * from shoppingCart where cartOwnerID=?;";
		$sql = "select waterGoodsID,waterGoodsCount,addCartTime from shoppingCart where cartOwnerID=?;";
		try{
			$result = DBActive::executeQuery($sql,array($id));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}
	/*
	 *  但用户下单以后要
	 *  删除购物车里已经被下单的桶装水的桶装水
	 *  用户手动移除商品
	 */	
	public static function deleteGoodsOnMyShoppingCart($cartOwnerID, $waterGoodsID){
		// $sql = "select * from shoppingCart where cartOwnerID=?;";
		$sql = "delete from shoppingCart where cartOwnerID=? and waterGoodsID=?;";
		try{
			$result = DBActive::executeNoQuery($sql,array($cartOwnerID,$waterGoodsID));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}


	/**
	 * 查询购物车里的桶装水 Phone使用，结果中有桶装水的名称、
	 */
	public static function getMyShoppingCartWithGoodsName($id){
		$sql = "select barrelWaterGoods.waterGoodsName,barrelWaterGoods.waterGoodsPrice,barrelWaterGoods.waterGoodsDefaultImage,shoppingCart.waterGoodsID,shoppingCart.waterGoodsCount,shoppingCart.addCartTime from shoppingCart inner join barrelWaterGoods on shoppingCart.waterGoodsID=barrelWaterGoods.id  where cartOwnerID=?;";
		try{
			$result = DBActive::executeQuery($sql,array($id));
			return $result;
		}catch(PDOException $e){
			return null;
		}
	}
}