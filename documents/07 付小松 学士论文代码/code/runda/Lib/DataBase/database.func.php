<?php 
//
// PDO 操作数据库
//------------DBActive
//------------Region_DBActive 省市县专用
//
require_once(DOC_PATH_ROOT."/Config/database.config.php");
/*
 *
 */
class DBActive{
	//执行 查询操作
	public static function executeQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(DSN,USER,PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$stm = $pdo ->prepare($sql);
			if(count($paramArray) != 0){
				
				for($i=0;$i<count($paramArray);$i++){
					$stm -> bindParam($i+1, $paramArray[$i]);
				}
			}
			$stm ->execute();
			$stm ->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stm ->fetchAll();
			return $result;
		}catch(PDOException $e){
			throw $e;
		}
	}
	//执行 增加、删除、更新
	public static function executeNoQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(DSN,USER,PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$stm = $pdo ->prepare($sql);
			for($i=0;$i<count($paramArray);$i++){
				$stm -> bindParam($i+1, $paramArray[$i]);
			}
			$stm ->execute();
			$rowCount = $stm ->rowCount();
			return $rowCount;
		}catch(PDOException $e){
			throw $e;
		}
	}
	// //执行 查询操作 --->不带参数
	// public static function executeQueryWithoutParam($sql){
	// 	try{
	// 		$pdo = new PDO(DSN,USER,PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
	// 		$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 		return $pdo ->exec($sql);
	// 	}catch(PDOException $e){
	// 		throw $e;
	// 	}
	// }
}
/*
 *省市县专用
 */
class Region_DBActive{
	//执行 查询操作
	public static function executeQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(Region_DSN,Region_USER,Region_PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$stm = $pdo ->prepare($sql);
			for($i=0;$i<count($paramArray);$i++){
				$stm -> bindParam($i+1, $paramArray[$i]);
			}
			$stm ->execute();
			$stm ->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stm ->fetchAll();
			return $result;
		}catch(PDOException $e){
			throw $e;
		}
	}
	//执行 增加、删除、更新
	public static function executeNoQuery($sql,$paramArray = array()){
		try{
			$pdo = new PDO(Region_DSN,Region_USER,Region_PASSWORD,array(PDO::ATTR_PERSISTENT =>true));
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			throw $e;
		}
		try{
			$stm = $pdo ->prepare($sql);
			for($i=0;$i<count($paramArray);$i++){
				$stm -> bindParam($i+1, $paramArray[$i]);
			}
			$stm ->execute();
			$rowCount = $stm ->rowCount();
			return $rowCount;
		}catch(PDOException $e){
			throw $e;
		}
	}
}