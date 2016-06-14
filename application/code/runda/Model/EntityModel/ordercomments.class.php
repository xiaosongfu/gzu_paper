<?php

class OrderComments{
	/*
	 *添加订单评论
	 */
	public static function commentOrder($orderID,$userID,$CommentContent){
		$CommentTime = time();
		$sql = "insert into orderComments (orderID,userID,CommentContent,CommentTime) values(?,?,?,?)";
		$sql2 = "update orderDetail set orderStatue=8,orderCategory=3 where id=?";
		try{
			$rowCount = DBActive::executeNoQuery($sql,array($orderID,$userID,$CommentContent,$CommentTime));
			DBActive::executeNoQuery($sql2,array($orderID));
			if($rowCount > 0){
					return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			return false;
// 			return $e->getMessage();;
		}
	}
}