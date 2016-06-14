<!-- 顶部 -->
<?php
	$title = "我的水站--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
	// echo "<pre>";
	// print_r($waterStoreResult);
	// print_r($hottestBWGoods);
	// print_r($newestBWGoods);
	// print_r($waterStoreStatusArr);
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_mywaterstore.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<div class="head">
	<div class="logo_box">
		<?php
			$imageSrc = strstr($waterStoreResult['waterStoreImage'],"/Content");
		 	echo '<img src="'.$imageSrc.'" width="200px" height="200" />'; 
		?>
		<div class="name_box">
		<?php
		echo "水站名称：".$waterStoreResult['waterStoreName'].'<br />';
		echo "联系电话：".$waterStoreResult['waterStoreTellPhone'].'<br />';
		echo "营业状态：".$waterStoreStatusArr[$waterStoreResult['waterStoreStatus']].'<br />';
		echo "<hr /><hr />";
		?>
		</div>
	</div>
</div>
<div class="left_box">
		<?php 
			    if($newestBWGoods != ""){
			        for($i = 0;$i<count($newestBWGoods);$i++){
			        	$imageSrc = "/".substr($newestBWGoods[$i]['waterGoodsDefaultImage'],strrpos($newestBWGoods[$i]['waterGoodsDefaultImage'],"Content"));
			        	if((($i+1) % 3) == 0 || $i == 0){
			        		echo '<div class="row">';
			        	}
			        	echo '
			        	<div class="col">
							<div class="col-sm-6 col-md-4">
					    	<div class="thumbnail">
					    		 <a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$newestBWGoods[$i]['id'].'" target="_blank">
					     		 <img src="'.$imageSrc.'" alt="'.$newestBWGoods[$i]['waterGoodsName'].'" />
					     		 </a>
					     	<div class="caption">
					        	<h4>'.substr($newestBWGoods[$i]['waterGoodsName'],0,24).'</h4>
						        <p class="text-danger goodsPrice">￥:'.$newestBWGoods[$i]['waterGoodsPrice'].'
						        </p>
						        	<p class="buyorcart">
						        	<a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$newestBWGoods[$i]['id'].'" target="_blank" class="btn btn-primary" role="button">查看详情</a>
						        	</p>
					      	</div>
					    	</div>
							</div>
 						</div>
			        	';
			        	if((($i+1) % 3 || $i == 0) == 0){
			        		echo '</div>';
			        	}
			        }
			    }
			  ?>
</div>
</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>