<?php

// 用户的角色
//	0 管理员 
//	1普通用户
//	2水店店长
//	3送水工人
class Role{
	private $id;
	private $roleName;
	
	/* 
	 *获取所有角色 
	 */
	public static function getRole(){
	    $sql = "select * from role;";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	        $res = DBActive::executeQuery($sql);
	        return $res;
	    }catch(PDOException $e){
	        return null;
	    }
	}
}