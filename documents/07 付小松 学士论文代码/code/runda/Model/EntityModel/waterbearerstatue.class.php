<?php
//  5、送水工
//    ID、用户ID、水店ID、最大载水量、状态
//
//		状态：
//			0 工作中
//			1忙碌中
//			2休息中

class WaterBearerStatue{
	private $id;
	private $waterBearerStat;
	
	/*
	 * 获取送水工状态
	 */
	public static function getWaterBearerStatue(){
	    $sql = "select * from waterBearerStatue";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $result = DBActive::executeQuery($sql);
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
}