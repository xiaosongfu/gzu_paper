<?php
//水店的状态
//	0  正营业常
//	1 忙碌中
//	2 休息中

class WaterStoreStatue{
	// private $id;
	// private $name;
	
	/*
	 *获取所有的工作状态
	 */
	public static function getWaterStoreStatue(){
	    $sql = "select * from waterStoreStatue;";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *获取某个水店工作状态
	 */
	public static function getOneWaterStoreStatue($waterStoreID){
	    $sql = "select waterStoreStatus from waterStore where id=?";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($waterStoreID));
	        if($res != null){
	        	return $res[0];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 *修改某个水店工作状态
	 */
	public static function changeOneWaterStoreStatue($newStatus,$waterStoreID){
	    $sql = "update waterStore set waterStoreStatus=? where id=?;";
	    try{
	        $res = DBActive::executeNoQuery($sql,array($newStatus,$waterStoreID));
	        if($res > 0){
	        	return true;
	        }else{
	        	return false;
	        }
	    }catch(PDOException $e){
	        return false;
	        // return $e ->getMessage();
	    }
	}
}