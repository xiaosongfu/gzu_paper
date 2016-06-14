<?php

require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");

//  5、送水工
//    ID、用户ID、水店ID、最大载水量、状态
//	
//		状态：
//			0 工作中
//			1忙碌中
//			2休息中

class WaterBearer{
	private $id; //ID  int  not null
	private $userId; // 用户ID 外键  not null
	private $waterStoreId; // 水店ID 外键  not null
	private $maxLoadCapacity; // 最大载水量 tinyint not null
	private $statue; //状态 int not null 有默认值
//-------------------------------------------------------------------------------
//---------------水站使用------------------------------------------------------------
	/*
	 * 水站添加自己送水工
	 */
	public function addWaterBearer($userId,$waterStoreId,$maxLoadCapacity){
	       $sql = "insert into waterBearer(userId,waterStoreId,maxLoadCapacity) values(?,?,?);";
	       $sql2 = "update user set role=1 where id=?;";
	       try{
	           DBActive::executeNoQuery($sql,array($userId,$waterStoreId,$maxLoadCapacity));
	           DBActive::executeNoQuery($sql2,array($userId));
	           return true;
	       }catch(PDOException $e){
	           return false;
               //return $e->getMessage();
	       }
	}
	/*
	 * 水站获取自己的送水工
	 */
	public function getAllWaterBearers($waterStoreID,$currentPage,$singlePageRecordCount){
	    $begin = ($currentPage - 1) * $singlePageRecordCount;
	    //$sql = "select waterBearer.userId,waterBearer.maxLoadCapacity,waterBearer.statue,waterBearerDriverRoute.waterBearerPositionLongitude,waterBearerDriverRoute.waterBearerPositionLatitude from waterBearer join (select waterBearerPositionLongitude,waterBearerPositionLatitude from waterBearerDriverRoute where waterBearerId=? order by id desc limit 1) on waterBearer.userId=waterBearerDriverRoute.waterBearerId  where waterBearer.waterStoreId=? limit ".$begin.",".$singlePageRecordCount." group by waterBearer.userId;";

	    //select * from waterBearer where waterStoreId=?
	    $sql = "select * from waterBearer where waterStoreId=? limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterStoreID)) ;
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//-------------------------------------------------------------------------------
//---------------订单分配时使用 查询水站的送水工------------------------------------------------------------
	/*
	 * 查询水站的正常工作(待分配订单，待出发)的送水工
	 */
	public static function getFreeWaterBearerByWaterStoreID($waterStoreID){
	    $sql = "select id,userId,maxLoadCapacity from waterBearer where statue=0 and waterStoreId=?";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterStoreID)) ;
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//-------------------------------------------------------------------------------
//---------------送水工使用 更改送水工的工作状态------------------------------------------------------------
	/*
	 * 更改送水工的工作状态
	 *
	 *	// 0	正常工作---待分配订单，待出发
	 *	// 1	忙碌中-----已分配订单，并且正在送水过程中
	 *	// 2	休息中-----下班了
	 */
	public static function refreshWaterBearerStatue($userId,$statue){
	       $sql = "update waterBearer set statue=? where userId=?;";
	       try{
	           $rowCount = DBActive::executeNoQuery($sql,array($statue,$userId));
	           if($rowCount > 0){
		           return true;
	           }else{
		           return false;
	           }
	       }catch(PDOException $e){
	           return false;
               //return $e->getMessage();
	       }
	}
}