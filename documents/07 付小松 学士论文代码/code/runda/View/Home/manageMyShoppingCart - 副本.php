<!-- 顶部 -->
<?php
	$title = "我的购物车--润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_managemyshoppingcart.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
	<form method="post" action="index.php?controller=Order&method=placeOrder">
	<!-- <form method="post"> -->
		<div><input type="checkbox" id="checkAll" />全选</div>
		<?php
			if($barrelWaterGoodsResult != null && $barrelWaterGoods !=null){
				for($i = 0;$i < count($barrelWaterGoodsResult); $i ++){
					// $imageSrc = "/".substr($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],strrpos($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],"Content"));
					$imageSrc = strstr($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],"/Content");
					echo '<div>
					<input type="checkbox" name="subBox[]" values="'.$i.'" /><input type="hidden" name="waterGoodsID[]" value="'.$barrelWaterGoodsResult[$i]['id'].'" /><input type="hidden" name="waterStoreID[]" value="'.$barrelWaterGoodsResult[$i]['waterStoreID'].'" />&nbsp;
					<div class="inline_box"><a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$barrelWaterGoodsResult[$i]['id'].'"><img src="'.$imageSrc.'" width="80px" height="80px" /></a></div>'.
					'<div class="inline_box"><a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$barrelWaterGoodsResult[$i]['id'].'">'.$barrelWaterGoodsResult[$i]['waterGoodsName'].'</a></div>
					<div class="inline_box">单价 '.$barrelWaterGoodsResult[$i]['waterGoodsPrice'].'</div>
					<div class="inline_box">数量 <input type="text" name="waterGoodsCount[]" value="'.$barrelWaterGoods[$i]['waterGoodsCount'].'" /></div>
					<div class="inline_box">库存 '.$barrelWaterGoodsResult[$i]['waterGoodsInventory'].'</div>
					<div class="inline_box">加入购物车时间 '.date("Y-m-d H:m:s",$barrelWaterGoods[$i]['addCartTime']).'</div>'.
					'</div><hr /><hr />';
				}
			}
		?>
		<div class="settle">
			<div class="result">已选择<span id="total_count" class="text-danger">5</span>桶桶装水,总价:<span id="total_price" class="text-danger">¥55464.15456</span></div>
			<div class="settle_btn"><button type="submit" class="btn btn-danger btn-lg">去结算</button></div>
			<!-- <div class="settle_btn"><button type="button" class="btn btn-danger btn-lg">去结算</button></div> -->
		</div>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- 全选 -->
<script src="/Content/javascript/js/home/check_uncheck_all.js"></script>