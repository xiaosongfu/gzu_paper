<?php

class OrderStatue{
	/*
	 *获取订单状态
	 */
	public static function getOrderStatue(){
	    $sql = "select * from orderStatue;";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
}
// create table orderStatues(
// 	id int not null primary key,
// 	orderStatueName varchar(20)
// );