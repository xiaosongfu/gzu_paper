<?php

class OrderCategory{
	/*
	 *获取订单类别
	 */
	public static function getOrderCategory(){
	    $sql = "select * from orderCategory;";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
}

// create table orderCategorys(
// 	id int not null primary key,
// 	orderCategoryName varchar(20)
// );