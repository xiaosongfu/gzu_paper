<?php

class UserRecieverAddress{
	private $id; // int not null auto_increment primary key,
	private $userID; //  int not null,
	private $province; //  varchar(20) not null,
	private $city; //  varchar(20) not null,
	private $country; //  varchar(20) not null,
	private $detailAddress; //  varchar(200) not null,

//------------------------用户使用-----------------------------------------------------
	/*
	 * 新增用户收货地址
	 */
	public function addUserRecieverAddress($userID,$province,$city,$country,$detailAddress){
	    $sql = "insert into userRecieverAddress(userID,province,city,country,detailAddress) values(?,?,?,?,?);";
	    try{
	        DBActive::executeNoQuery($sql,array($userID,$province,$city,$country,$detailAddress));
	        return true;
	    }catch(PDOException $e){
	        return false;
	    }
	}
	/*
	 * 获取某用户的所有收货地址
	 */
	public function getUserRecieverAddress($userID){
	    $sql = "select * from userRecieverAddress where userID=?;";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql,array($userID));
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	
//---------------------管理员使用---------------------------------------------------------------
	/*
	 * 获取所有的收货地址
	 */
	public function getUsersRecieverAddress($currentPage,$singlePageRecordCount){
	    $begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select * from userRecieverAddress order by id limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 * 删除某一个收货地址  用户也在使用
	 */
	public function deleteAnUserRecieverAddress($id){
	    $sql = "delete from userRecieverAddress where id=?;";
	    try{
	        DBActive::executeNoQuery($sql,array($id));
	        return true;
	    }catch(PDOException $e){
	        return false;
	    }
	}
}
// 	create table userRecieverAddress(

// 	ID int not null auto_increment primary key,
// 	userID int not null,
// 	province varchar(20) not null,
// 	city varchar(20) not null,
// 	country varchar(20) not null,
// 	detailAddress varchar(200) not null,
// 	foreign key(userID) references user(id) ON DELETE CASCADE