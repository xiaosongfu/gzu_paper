<?php

//引入数据库操作文件
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");

class WaterBearerDriverRoute{
    private $id; // int not null auto_increment primary key,
    private $waterBearerId; // int not null,
    private $waterBearerPositionLongitude; // varchar(200) not null,
    private $waterBearerPositionLatitude; // varchar(200) not null, -- 纬度
    private $date; // char(6) not null, -- 20150412
    private $time; // int not null,
    private $remainCapacity; // tinyint not null,
    
    
    
    
    
    /**
     * 送水工实时上传地理位置
     */
    public function updateRTLocation($waterBearerId, $longitude, $latitude){
    	$sql = "insert into waterBearerDriverRoute (waterBearerId,waterBearerPositionLongitude,waterBearerPositionLatitude,date,time) values(?,?,?,?,?)";
    	try{
    		$date = date("Ymd");
    		$time = date("H:i:s");
    		$res = DBActive::executeNoQuery($sql,array($waterBearerId, $longitude, $latitude, $date, $time));
    		if($res){
    			return '{"code":"200","msg":"上传成功","data":""}';
    		}else{
    			return '{"code":"400","msg":"上传失败","data":""}';
    		}
    	}catch(PDOException $e){
    		return '{"code":"400","msg":"上传失败","data":""}';
    	}
    }


    /**
     * 获取送水工实时地理位置
     */
    public function selectRTLocation($waterBearerId){
        $sql = "select waterBearerPositionLongitude,waterBearerPositionLatitude from waterBearerDriverRoute where waterBearerId=? order by id desc limit 1";
        try{
            $result = DBActive::executeQuery($sql,array($waterBearerId));
            return $result;
        }catch(PDOException $e){
            return "";
        }
    }
    
    
}
// create table  waterBearerDriverRoute(
// id int not null auto_increment primary key,
// waterBearerId int not null,
// waterBearerPositionLongitude varchar(200) not null,
// waterBearerPositionLatitude varchar(200) not null, -- 纬度
// date char(6) not null, -- 20150412
// time int not null,
// remainCapacity tinyint,
// foreign key(waterBearerId) references user(id) ON DELETE CASCADE
// );