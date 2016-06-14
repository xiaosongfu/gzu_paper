<?php
	$title="订单结算--润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
	require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
    $barrelWaterGoods = new BarrelWaterGoods();
    $totalPriceExp = array();
    $totalPrice = array(); 
?>
<!-- 顶部结束 -->
<link rel="stylesheet" href="/Content/javascript/jquery/jqueryui/css/smoothness/jqueryui.min.css">
<!-- 样式 -->
<link href="/Content/style/order/layout_vieworder.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<form class="form-horizontal" id="settleOrderForm" role="form" method="post">
<!-- <form class="form-horizontal" id="settleOrderForm" role="form" action="index.php?controller=Order&method=orderSettleLocalProc" method="post"> -->
<!-- <form class="form-horizontal" role="form" action="index.php?controller=Order&method=orderSettleOnlineProc" method="post"> -->
<?php
	if($_SESSION['id'] == $orderDetail['orderOwnerID']){
		echo '<div class="basicinfo_box"><span>商品</span><br />';
		echo '<table  class="table table-bordered table-hover"><tr><td>商品编号</td><td>图片</td><td>名称</td><td>单价</td><td>数量</td><td>总金额</td></tr>';
		$i = 0;
		foreach ($orderContainGoodsResult as $key => $value) {
			//获取每一个桶装水的信息
			$goods = $barrelWaterGoods ->getBarrelWaterGoodsDetail($value['waterGoodsID']);
			//截取图片的路径
			// $imageSrc = "/".substr($goods['waterGoodsDefaultImage'],strrpos($goods['waterGoodsDefaultImage'],"Content"));
			$imageSrc = strstr($goods['waterGoodsDefaultImage'],"/Content");
			//计算总金额
			$totalPrice[$i] = $goods['waterGoodsPrice'] * $value['waterGoodsCount'];
			// $totalPriceExp[$i] = "{$goods['waterGoodsPrice']} X {$value['waterGoodsCount']}={$totalPrice[$i]}";
			$totalPriceExp[$i] = "{$goods['waterGoodsPrice']} X {$value['waterGoodsCount']}";
			//显示
			echo "<tr><td>{$goods['id']}</td><td>".'<a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$goods['id'].'"><img src="'.$imageSrc.'" width="80px" height="80px" /></a></td><td><a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$goods['id'].'">'.$goods['waterGoodsName']."</a></td><td>{$goods['waterGoodsPrice']}</td><td>{$value['waterGoodsCount']}</td><td>{$totalPriceExp[$i]}={$totalPrice[$i]}</td></tr>";
			$i++;
		}
		//订单id
		echo '<input type="hidden" name="orderID" value="'.$orderDetail['id'].'" />';
		echo '</table>';
		echo '</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>订单信息</span>
		<br />订单编号&nbsp;&nbsp;'.$orderDetail['id'].'
		<br />下单时间&nbsp;&nbsp;'.date("Y-m-d H:i:s",$orderDetail['orderSubmitTime']).'
		</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>收货人信息</span>
		<br /><div class="col-sm-2">收货人姓名<input  class="form-control"  type="text" name="recieverPersonName" value="'.$userRealNameAndPhone['realName'].'" /></div>
		<div class="col-sm-2">收货人电话<input  class="form-control"  type="text" name="recieverPersonPhone" value="'.$userRealNameAndPhone['phoneNumber'].'" /></div>
		<br /><br />&nbsp;&nbsp;&nbsp;收货人地址&nbsp;&nbsp;';
		foreach ($userRAddrResult as $key => $value) {
			echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="recieverAddress" id="'.$value['id'].'" value="'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'" /><label for="'.$value['id'].'">'.$value['province'].'--'.$value['city'].'--'.$value['country'].'--'.$value['detailAddress'].'</label>';
		}
		echo '</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>预定送水时间</span>
		<br />
		<div class="col-sm-2">
		选择日期&nbsp;&nbsp
		<input name="date" class="form-control" type="text" id="datepicker">
		</div>
		<div class="col-sm-2">
		选择小时(24小时制)&nbsp;&nbsp
		<select name="hour" value="12" class="form-control">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		  <option value="6">6</option>
		  <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
		  <option value="10">10</option>
		  <option value="11">11</option>
		  <option value="12">12</option>
		  <option value="13">13</option>
		  <option value="14">14</option>
		  <option value="15">15</option>
		  <option value="16">16</option>
		  <option value="17">17</option>
		  <option value="18">18</option>
		  <option value="19">19</option>
		  <option value="20">20</option>
		  <option value="21">21</option>
		  <option value="22">22</option>
		  <option value="23">23</option>
		  <option value="24">24</option>
		</select>
		</div>
		<div class="col-sm-1">
		输入分钟&nbsp;&nbsp
		<input name="minute" class="form-control" value="00" type="text">
		</div>
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;我们会在您预定的时间前后半小时内送达,请您悉知
		</div><hr /><hr />';
		echo '<div class="basicinfo_box">
		<span>订单备注</span>
		<br />&nbsp;&nbsp;
		<textarea name="remark" class="form-control" rows="3" col="3"></textarea>
		</div><hr /><hr />';
		echo '<div class="basicinfo_box settle_box">
		<span>结算信息</span>
		<br />订单总金额&nbsp;&nbsp;';
		$c = count($totalPrice);
		$tprice = 0;
		$totalPriceExpr = "";
		for($i =0 ;$i < $c ;$i++){
			$tprice = $tprice + $totalPrice[$i];
			if($i == ($c-1)){
				$totalPriceExpr = $totalPriceExpr.$totalPriceExp[$i]."=";
			}else{
				$totalPriceExpr = $totalPriceExpr.$totalPriceExp[$i]."+";
			}
		}
		echo $totalPriceExpr.$tprice;
		echo '<br /><br />
			  <button type="button" id="localBtn" class="btn btn-danger btn-mid" onclick="orderSettleLocal()">货到付款</button>
			  <button type="button" class="btn btn-danger btn-mid" onclick="orderSettleOnline()">在线支付</button>
			  </div>';
	}else{
		echo '<div class="error_box">没有查询到该订单的相关信息,抑或你没有权限查看</div>';
	}
?>
</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="/Content/javascript/jquery/jqueryui/js/jqueryui.min.js"></script>
<script src="/Content/javascript/js/order/settle_order_ajax.js"></script>