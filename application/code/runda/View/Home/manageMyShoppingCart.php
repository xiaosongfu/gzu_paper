<!-- 顶部 -->
<?php
	$title = "我的购物车--润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_managemyshoppingcart.css" rel="stylesheet">
<link rel="stylesheet" href="/Content/javascript/jquery/jqueryui/css/smoothness/jqueryui.min.css">
<!-- 主体 -->
<div class="body">
	<!-- <form method="post" action="index.php?controller=Order&method=placeOrder"> -->
	<form method="post" id="placeOrderForm">
		<?php
			if($barrelWaterGoodsResult != null && $barrelWaterGoods !=null){
				//全选按钮
				echo '<div><input type="checkbox" id="checkAll" />全选</div>';
				for($i = 0;$i < count($barrelWaterGoodsResult); $i ++){
					// $imageSrc = "/".substr($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],strrpos($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],"Content"));
					$imageSrc = strstr($barrelWaterGoodsResult[$i]['waterGoodsDefaultImage'],"/Content");
					echo '<div>
					<input type="checkbox" checked="checked" name="subBox[]" values="'.$i.'" /><input type="hidden" name="waterGoodsID[]" value="'.$barrelWaterGoodsResult[$i]['id'].'" /><input type="hidden" name="waterStoreID[]" value="'.$barrelWaterGoodsResult[$i]['waterStoreID'].'" />&nbsp;
					<div class="inline_box"><a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$barrelWaterGoodsResult[$i]['id'].'"><img src="'.$imageSrc.'" width="80px" height="80px" /></a></div>'.'
					<div class="inline_box"><a target="_blank" href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$barrelWaterGoodsResult[$i]['id'].'">'.substr($barrelWaterGoodsResult[$i]['waterGoodsName'],0,24).'...</a></div>
					<div class="inline_box">单价 '.$barrelWaterGoodsResult[$i]['waterGoodsPrice'].'</div>
					<div class="inline_box">数量 <input class="spinner" name="waterGoodsCount[]" value="'.$barrelWaterGoods[$i]['waterGoodsCount'].'" /></div>
					<div class="inline_box">库存 '.$barrelWaterGoodsResult[$i]['waterGoodsInventory'].'</div>
					<div class="inline_box">加入购物车时间 '.date("Y-m-d H:m:s",$barrelWaterGoods[$i]['addCartTime']).'</div>
					<div class="inline_box"><a href="javascript:void(0)" onclick="deleteGoodsOnCart('.$barrelWaterGoodsResult[$i]['id'].');" type="button" class="btn btn-info">移除</a></div>'.
					'</div><hr /><hr />';
				}
				echo '<div class="settle">
					<!-- <div class="result">已选择<span id="total_count" class="text-danger">5</span>桶桶装水,总价:<span id="total_price" class="text-danger">¥55464.15456</span></div> -->
					<div class="settle_btn"><button type="submit" class="btn btn-danger btn-lg">去结算</button></div>
					<!-- <div class="settle_btn"><button type="button" class="btn btn-danger btn-lg">去结算</button></div> -->
					</div>';
			}else{
				echo '<div class="empty_box">
					<img src="/Content/image/common/emptycart.jpg" />
					<br /><br />您的购物车空空的,<a href="index.php">现在去采购&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></a>

					</div>';
			}
		?>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- jqueryui -->
<script src="/Content/javascript/jquery/jqueryui/js/jqueryui.min.js"></script>
<!-- 全选 -->
<script src="/Content/javascript/js/home/check_uncheck_all.js"></script>
<!-- 异步提交表单 -->
<script src="/Content/javascript/js/home/placeorder_ajax.js"></script>
<script>
  $(function() {
    $(".spinner").spinner();
  });
  function deleteGoodsOnCart(id){
	if(confirm("确认删除?")){
		$.ajax({
			url: "index.php?controller=Home&method=deleteGoodsOnMyShoppingCart&wgid="+id,
			type: "GET",
			dataType:"json",
			success: function(result,textStatus){
				if(textStatus == "success"){
					// alert(result.message);
					if(result.code == 200){
						setTimeout(function() {
		    			 window.location.reload();
		    		}, 1000);
					}
				}
				// else{
				// 		alert("服务器错误");
				// }
	  		},
	  		error: function (XMLHttpRequest, textStatus, errorThrown) { 
	            alert("服务器错误,请重试"); 
	        }
		});
	}
  }
</script>