<?php
	$title="查看订单详情--润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
	require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
    $barrelWaterGoods = new BarrelWaterGoods(); 
?>
<!-- 顶部结束 -->
<!-- 样式 -->
<link href="/Content/style/order/layout_vieworder.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<?php
// echo "<pre>";
// print_r($orderDetail);// --->结果如下：
// Array
// (
        // [id] => 33
        // [orderOwnerID] => 10001
        // [waterBearerID] => 
        // [waterStoreID] => 10000
        // [recieverPersonName] => 
        // [recieverPersonPhone] => 
        // [recieverTime] => 
        // [remark] => 
        // [totalPrice] => 43.34
        // [orderCategory] => 0
        // [orderStatue] => 0
        // [logisticeInformation] => 
        // [orderCancelReason] => 
        // [orderFailReason] => 
        // [orderSubmitTime] => 1431169147
        // [orderDoneTime] => 
// )
	if($_SESSION['id'] == $orderDetail['orderOwnerID']){
		echo '<div class="basicinfo_box"><span>商品</span><br />';
		echo '<table  class="table table-bordered table-hover"><tr><td>商品编号</td><td>图片</td><td>名称</td><td>数量</td><td>当前价格</td></tr>';
		foreach ($orderContainGoodsResult as $key => $value) {
			//获取每一个桶装水的信息
			$goods = $barrelWaterGoods ->getBarrelWaterGoodsDetail($value['waterGoodsID']);
			//截取图片的路径
			// $imageSrc = "/".substr($goods['waterGoodsDefaultImage'],strrpos($goods['waterGoodsDefaultImage'],"Content"));
			$imageSrc = strstr($goods['waterGoodsDefaultImage'],"/Content");
			//显示
			echo "<tr><td>{$goods['id']}</td><td>".'<a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$goods['id'].'"><img src="'.$imageSrc.'" width="80px" height="80px" /></a></td><td>'.'<a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$goods['id'].'">'.$goods['waterGoodsName']."</a></td><td>{$value['waterGoodsCount']}</td><td>{$goods['waterGoodsPrice']}</td></tr>";
			// print_r($goods);
		}
		echo '</table>';
		// <pre>';
		// print_r($orderContainGoodsResult);
		echo '</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>订单信息</span>
		<br />订单编号：&nbsp;&nbsp;'.$orderDetail['id'].'
		<br />支付方式：&nbsp;&nbsp;'.$orderDetail['settleMethod'].'
		<br />下单时间：&nbsp;&nbsp;'.date("Y-m-d H:i:s",$orderDetail['orderSubmitTime']).'
		<br />订单状态：&nbsp;&nbsp;'.$orderStatueArr[$orderDetail['orderStatue']].'
		<br />预定送水时间：&nbsp;&nbsp;'.$orderDetail['recieverTime'].'
		</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>收货人信息&nbsp;&nbsp;</span>
		<br />收货人姓名：&nbsp;&nbsp;'.$orderDetail['recieverPersonName'].'
		<br />收货人电话：&nbsp;&nbsp;'.$orderDetail['recieverPersonPhone'].'
		<br />收货人地址：&nbsp;&nbsp;'.$orderDetail['recieverAddress'].'
		</div><hr /><hr />';
		//1,'已取消'
		if($orderDetail['orderCategory'] == 1){
			echo '<div class="basicinfo_box">
			<span>订单已取消</span>
			<br />取消原因：&nbsp;&nbsp;'.$orderDetail['orderCancelReason'].'
			</div><hr /><hr />';
		}
		//2,'已失败'
		if($orderDetail['orderCategory'] == 2){
			echo '<div class="basicinfo_box">
			<span>订单失败</span>
			<br />失败原因：&nbsp;&nbsp;'.$orderDetail['orderFailReason'].'
			</div><hr /><hr />';
		}
		//3,'已完成''
		if($orderDetail['orderCategory'] == 3){
			echo '<div class="basicinfo_box">
			<span>订单已完成</span>
			<br />完成时间：&nbsp;&nbsp;'.date("Y-m-d H:i:s",$orderDetail['orderDoneTime']).'
			</div><hr /><hr />';
		}
		echo '<div class="basicinfo_box">
		<span>物流信息</span>
		<br />'.$orderDetail['logisticeInformation'].'
		</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>订单备注</span>
		<br />&nbsp;&nbsp;'.$orderDetail['remark'].'
		</div><hr /><hr />';
		echo '<div class="basicinfo_box settle_box">
		<span>结算信息</span>
		<br />订单总金额&nbsp;&nbsp;'.$orderDetail['totalPrice'];
		//现在结算 0,'订单已提交未付款'
		if($orderDetail['orderStatue'] == 0){
			echo '<br /><br /><a type="button" class="btn btn-danger btn-mid" href="index.php?controller=Order&method=orderSettle&orderid='.$orderDetail['id'].'">现在结算</a>';
		}
		if($orderDetail['orderStatue'] == 6){
			echo '<br /><br /><a type="button" class="btn btn-danger btn-mid" href="index.php?controller=Order&method=doComment&orderid='.$orderDetail['id'].'">确认收货</a>';
		}
		echo '</div>';
	}else{
		echo '<div class="error_box">没有查询到该订单的相关信息,抑或你没有权限查看</div>';
	}
?>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>