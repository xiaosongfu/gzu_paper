<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class BarrelWaterGoods{
	private $id;// int not null auto_increment primary key,
	private $waterStoreID;  // int not null,
	private $waterCate;  // int not null,
	private $waterBrand;  // int not null,
	private $waterGoodsName;  // varchar(140) not null,
	private $waterGoodsDescript;  // text not null,
	private $waterGoodsPrice;  // decimal(6,2) not null,
	private $waterGoodsInventory;  // int not null default 0,-- 库存
	private $isGrounding;  // tinyint not null default 0, -- 是否上架
	private $salesVolume;  // int not null default 0, -- 销量
 
//---------------------------------------------------------------------------------  
//--------------桶装水管理 上传 删除 上架 下架------------------------------------- 
//---------------------------------------------------------------------------------  
    /*
     *  上传桶装水
     *  返回数组
     */
	public function uploadBarrelWaterGoods($waterStoreID,$waterCate,$waterBrand,$waterGoodsName,$waterGoodsDescript,$waterGoodsPrice,$waterGoodsDefaultImage,$waterGoodsInventory,$groundingDate,$isGrounding){
		$sql = "insert into barrelWaterGoods(waterStoreID,waterCate,waterBrand,waterGoodsName,waterGoodsDescript,waterGoodsPrice,waterGoodsDefaultImage,waterGoodsInventory,groundingDate,isGrounding) values(?,?,?,?,?,?,?,?,?,?);";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($waterStoreID,$waterCate,$waterBrand,$waterGoodsName,$waterGoodsDescript,$waterGoodsPrice,$waterGoodsDefaultImage,$waterGoodsInventory,$groundingDate,$isGrounding));
			$sql2 = "select LAST_INSERT_ID() last_id;";
			$res = DBActive::executeQuery($sql2);
			return array("code"=>"200","id"=>$res);
		}catch(PDOException $e){
			return array("code"=>"400");
		}
	}
					// /*
					//  * 	获取某一个水站所有桶装水
					//  * param
					//  *     $waterStoreID  水站ID
					//  *     $currentPage  当前页
					//  *     $singlePageRecordCount 每一页显示的纪录的条数
					//  */
					// public function getAllBarrelWaterGoods($waterStoreID,$currentPage,$singlePageRecordCount){
					//     $begin = ($currentPage - 1) * $singlePageRecordCount;
					//     $sql = "select * from barrelWaterGoods where waterStoreID=? order by id limit ".$begin.",".$singlePageRecordCount.";";
					//     try{
				 //            $result = DBActive::executeQuery($sql,array($waterStoreID));
				 //            return $result;
					//     }catch(PDOException $e){
					//         return null;
					//     }
					// }
	/*
	 * 获取某一个水站所有的待上架桶装水
	 *  param
	 *     $waterStoreID  水站ID
	 *     $currentPage  当前页
	 *     $singlePageRecordCount 每一页显示的纪录的条数
	 */
	public function groundingBarrelWaterGoods($waterStoreID,$currentPage,$singlePageRecordCount){
	    $begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select * from barrelWaterGoods where waterStoreID=? and isGrounding=0 order by id limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($waterStoreID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 * 上架桶装水处理业务逻辑
	 * 参数形如：Array ( [0] => 2 [1] => 3 ) 值是桶装水的id
	 */
	public function groundingBarrelWaterGoodsHandle($groundingbarrelWaterGoodsArray){
	    $count = count($groundingbarrelWaterGoodsArray);
	    $sql = "update barrelWaterGoods set isGrounding=1 where id=?;";
	    for($i=0;$i<$count;$i++){
	        try{
	            $row = DBActive::executeNoQuery($sql,array($groundingbarrelWaterGoodsArray[$i]));
	        }catch(PDOException $e){
	            return false;
	        }
	    }
	    return true;
	}
	/*
	 * 获取某一个水站所有的可下架桶装水
     * param
	 *     $waterStoreID  水站ID
	 *     $currentPage  当前页
	 *     $singlePageRecordCount 每一页显示的纪录的条数
	 */
	public function unGroundingBarrelWaterGoods($waterStoreID,$currentPage,$singlePageRecordCount){
	    $begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select * from barrelWaterGoods where waterStoreID=? and isGrounding=1 order by id limit ".$begin.",".$singlePageRecordCount.";";
	    try{
	        $result = DBActive::executeQuery($sql,array($waterStoreID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }    
	}
	/*
	 * 下架桶装水处理业务逻辑
	 * 参数形如：Array ( [0] => 2 [1] => 3 ) 值是桶装水的id
	 */
	public function ungroundingBarrelWaterGoodsHandle($ungroundingbarrelWaterGoodsArray){
	    $count = count($ungroundingbarrelWaterGoodsArray);
	    $sql = "update barrelWaterGoods set isGrounding=0 where id=?;";
	    for($i=0;$i<$count;$i++){
	        try{
	            $row = DBActive::executeNoQuery($sql,array($ungroundingbarrelWaterGoodsArray[$i]));
	        }catch(PDOException $e){
	            return false;
	        }
	    }
	    return true;
	}
	/*
     * 删除桶装水
     * 参数形如：Array ( [0] => 2 [1] => 3 ) 值是桶装水的id
     */
	public function deleteBarrelWaterGoods($barrelWaterGoodsArray){
	    $count = count($barrelWaterGoodsArray);
	    $sql = "delete from barrelWaterGoods where id=?;";
	    for($i=0;$i<$count;$i++){
	        try{
	            $row = DBActive::executeNoQuery($sql,array($barrelWaterGoodsArray[$i]));
	        }catch(PDOException $e){
	            return false;
	        }
	    }
	    return true;
	}

//----------------------------------------------------------------------------
//--------------获取水站的桶装水-------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 * 	获取某一个水站所有桶装水 web版 -----带翻页功能
	 *  param
	 *     $waterStoreID  水站ID
	 *     $currentPage  当前页
	 *     $singlePageRecordCount 每一页显示的纪录的条数
	 */
	public function getAllBarrelWaterGoods($waterStoreID,$currentPage,$singlePageRecordCount){
	    $begin = ($currentPage - 1) * $singlePageRecordCount;
	    $sql = "select * from barrelWaterGoods where waterStoreID=? order by id limit ".$begin.",".$singlePageRecordCount.";";
	    try{
            $result = DBActive::executeQuery($sql,array($waterStoreID));
            return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}
	/*
	 * 	获取某一个水站所有上架桶装水,只有部分信息 phone版
	 *  param
	 *     $waterStoreID  水站ID
	 */
	public function getAllBarrelWaterGoodsOfOneWaterStore($waterStoreID){
	    $sql = "select id,waterCate,waterBrand,waterGoodsName,waterGoodsPrice,waterGoodsDefaultImage,waterGoodsInventory,groundingDate,salesVolume from barrelWaterGoods where isGrounding=1 and waterStoreID=?";
	    try{
            $result = DBActive::executeQuery($sql,array($waterStoreID));
            return $result;
	    }catch(PDOException $e){
	        return null;
	    }
	}

//----------------------------------------------------------------------------
//--------------网站首页展示使用-------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 *获取最新上传的桶装水
	 */
	public function getNewestBarrelWaterGoods($count = 6){
		$sql = "select * from barrelWaterGoods where isGrounding=1 order by groundingDate desc limit 0,".$count.";";
	    try{
	        $result = DBActive::executeQuery($sql);
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    } 
	}
	/*
	 *获取销量最多的桶装水
	 */
	public function getHottesetBarrelWaterGoods($count = 6){
		$sql = "select * from barrelWaterGoods where isGrounding=1 order by salesVolume desc limit 0,".$count.";";
	    try{
	        $result = DBActive::executeQuery($sql);
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    } 
	}

//----------------------------------------------------------------------------
//--------------我的水站首页展示使用-------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 * 获取热销桶装水
	 */
	public function getHottestBarrelWaterGoodsForMyWS($waterStoreID){
		$sql = "select * from barrelWaterGoods where waterStoreID=? order by salesVolume desc";
	    try{
	        $result = DBActive::executeQuery($sql,array($waterStoreID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    } 
	}
	/*
	 * 获取最新上架桶装水
	 */
	public function getNewestBarrelWaterGoodsForMyWS($waterStoreID){
		$sql = "select * from barrelWaterGoods where waterStoreID=? order by groundingDate desc";
	    try{
	        $result = DBActive::executeQuery($sql,array($waterStoreID));
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    }  
	}

//----------------------------------------------------------------------------
//-------------桶装水详情展示使用------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 * 根据桶装水的ID查询桶装水的详细信息
	 *  返回一个桶装水  return $result[0];
	 */
	public function getBarrelWaterGoodsDetail($barrelWaterGoodsID){
		$sql = "select * from barrelWaterGoods where id=?;";
	    try{
	        $result = DBActive::executeQuery($sql,array($barrelWaterGoodsID));
	        if($result != null){
	        	return $result[0];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	    	return null;
	    } 
	}

//----------------------------------------------------------------------------
//-------------购物车展示桶装水详情使用------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 * 根据桶装水的ID查询桶装水的详细信息
	 *  返回桶装水数组
	 *  param $barrelWaterGoodsIDs array 购物车里所有桶装水的ID
	 */
	public function getBarrelWaterGoodsDetailForShoppingCart($barrelWaterGoodsIDs){
		// $sql = "select * from barrelWaterGoods where ";
		$sql = "select id,waterStoreID,waterGoodsName,waterGoodsPrice,waterGoodsDefaultImage,waterGoodsInventory from barrelWaterGoods where ";
		$count = count($barrelWaterGoodsIDs);
		for($i =0;$i <$count; $i++){
			if($i == ($count-1)){
				$sql = $sql."id=?;";
			}else{
				$sql = $sql."id=? or ";
			}
		}
	    try{
	        $result = DBActive::executeQuery($sql,$barrelWaterGoodsIDs);
	        // if($result != null){
	        	return $result;
	        // }else{
	        // }
	    }catch(PDOException $e){
			return null;
			// echo $e ->getMessage();
	    } 
	}

//----------------------------------------------------------------------------
//-------------订单使用------------------------------------------------
//----------------------------------------------------------------------------
	/* 生成订单时
	 * 根据桶装水的ID查询单个桶装水的价格
	 */
	public static function getBarrelWaterGoodsPrice($barrelWaterGoodsID){
		$sql = "select waterGoodsPrice from barrelWaterGoods where id=?;";
	    try{
	        $result = DBActive::executeQuery($sql,array($barrelWaterGoodsID));
	        if($result != null){
	        	return $result[0]['waterGoodsPrice'];
	        }else{
	        	return -1;
	        }
	    }catch(PDOException $e){
	    	return -1;
	    }
	}
	/*
	 * 根据桶装水的ID查询桶装水的默认图片 订单显示时使用
	 */
	public function getBarrelWaterGoodsDefaultImage($barrelWaterGoodsID){
		$sql = "select waterGoodsDefaultImage from barrelWaterGoods where id=?;";
	    try{
	        $result = DBActive::executeQuery($sql,array($barrelWaterGoodsID));
	        if($result != null){
	        	return $result[0];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	    	return null;
	    } 
	}

//----------------------------------------------------------------------------
//-------------获取桶装水详细描述  查看和编辑桶装水描述------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 * 根据桶装水的ID查询桶装水的详细描述 
	 *  返回桶装水描述 
	 *  param $barrelWaterGoodsID int
	 */
	public function getBarrelWaterGoodsDescript($barrelWaterGoodsID){
		$sql = "select waterGoodsDescript from barrelWaterGoods where id=?;";
	    try{
	        $result = DBActive::executeQuery($sql,array($barrelWaterGoodsID));
	        if($result != null){
	        	return $result[0]['waterGoodsDescript'];
	        }else{
	        	return null;
	        }
	    }catch(PDOException $e){
	    	return null;
	    }
	}

//----------------------------------------------------------------------------
//-------------管理员使用------------------------------------------------
//----------------------------------------------------------------------------
	/*
	 *获取所有桶装水
	 */
	public function getAlllBarrelWaterGoods($currentPage,$singlePageRecordCount){
		$begin = ($currentPage - 1) * $singlePageRecordCount;
		$sql = "select * from barrelWaterGoods order by id desc limit ".$begin.",".$singlePageRecordCount;
	    try{
	        $result = DBActive::executeQuery($sql);
	        return $result;
	    }catch(PDOException $e){
	        return null;
	    } 
	}
}