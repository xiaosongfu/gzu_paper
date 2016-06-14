<!-- 顶部 -->
<?php
	$title = '桶装水详情  '.$barrelWaterGoodsResult['waterGoodsName'].' --润达送水 润你生活';
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/runda/layout_barrelwatergoodsdetail.css" rel="stylesheet">

<!-- 主体 -->
<div class="body">
<!-- 桶装水图片展示，价格，销量的属性框 -->
	<div class="photo_params">
		<!-- 左边图片 -->
		<div class="photo">
				<div class="v_out v_out_p">
					<div class="v_show">
						<div class="v_cont">
						<ul>
							<?php
								if($barrelWatetGoodsPhotosResult != null){
									for($i = 0;$i < count($barrelWatetGoodsPhotosResult);$i++) {
										$imageSrc = "/".substr($barrelWatetGoodsPhotosResult[$i]['waterGoodsPhotoPath'],strrpos($barrelWatetGoodsPhotosResult[$i]['waterGoodsPhotoPath'],"Content"));
										echo '<li index="'.$i.'"><img src="'.$imageSrc.'" /></li>';
									}
								}
							?>
						<!-- 	<li index="0"></li>
							<li index="1"></li>
							<li index="2" style="background:#f0f"></li>
							<li index="3" style="background:#999"></li>
							<li index="4" style="background:#666"></li> -->
						</ul>
						</div>
					</div>
						<ul class="circle">
							<?php
								if($barrelWatetGoodsPhotosResult != null){
									for($i = 0;$i < count($barrelWatetGoodsPhotosResult);$i++) {
										if($i == 0){
											echo '<li class="circle-cur"></li>';
										}else{
											echo '<li></li>';
										}
										if(($i+1) % 3 == 0){
											echo '<br />';
										}
									}
								}
							?>
							<!-- <li class="circle-cur"></li>
							<li></li>
							<li></li>
							<br />
							<br />
							<li></li>
							<li></li> -->
						</ul>
					</div>
		</div>
		
		<!-- 右边参数 -->
		<div class="params">
			<br />
			桶装水名称:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsName']; ?><br /><hr />
			上架时间:&nbsp;&nbsp;&nbsp;<?php echo date("Y-m-d H:i:s",$barrelWaterGoodsResult['groundingDate']); ?><br /><hr />
			库存:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsInventory']; ?><br /><hr />
			销量:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['salesVolume']; ?><br /><hr />
			桶装水价格:&nbsp;&nbsp;&nbsp;<?php echo $barrelWaterGoodsResult['waterGoodsPrice']; ?><br /><hr />
			<br />
			<br />
			<p>
	        	<button class="btn btn-danger" role="button" onclick="addCartFun(<?php echo $barrelWaterGoodsResult['id']; ?>);">加购物车</button>
<!-- 	        	<button class="btn btn-danger" role="button">加收藏&nbsp;&nbsp;<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></button> -->
	        	<!-- <button class="btn btn-danger" role="button">已收藏&nbsp;&nbsp;<span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button> -->
        	</p>
		</div>
	</di>
<!-- 桶装水图片展示，价格，销量的属性框 结束-->
<!-- 中下部的选项卡 -->
	<div class="descript_comments_afterSS">
		<div role="tabpanel">

		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#waterGoodsDescript" aria-controls="waterGoodsDescript" role="tab" data-toggle="tab">桶装水介绍</a></li>
		    <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">桶装水评价(<?php echo count($barrelWaterGoodsCommentsResult); ?>)</a></li>
<!-- 		    <li role="presentation"><a href="#afterSaleService" aria-controls="afterSaleService" role="tab" data-toggle="tab">售货保障</a></li> -->
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content" style="padding-left:64px">
		  	<br /><br />
			<!--桶装水简介  -->
		    <div role="tabpanel" class="tab-pane active" id="waterGoodsDescript">
		    		<?php
		    			echo $barrelWaterGoodsResult['waterGoodsDescript']; 
		    		?>
		    </div>
			<!--评论 -->
		    <div role="tabpanel" class="tab-pane" id="comments" style="font-size:14px">
		    	<?php
		    		if($barrelWaterGoodsCommentsResult != null){
		    			foreach ($barrelWaterGoodsCommentsResult as $key => $value) {
		    				echo '评价用户：'.$value['userName'].'<br />评价内容：'.$value['CommentContent'].'<br />评价时间：'.date("Y-m-d H:i:s",$value['CommentTime']).'<hr />';
		    			}
		    		}else{
		    			echo "暂无评价";
		    		}
		    	?>
		    </div>
			<!--售后 -->
<!-- 		    <div role="tabpanel" class="tab-pane" id="afterSaleService"> -->
<!-- 				在线订购与您亲临水站选购的商品享受相同的质量保证。还为您提供具有竞争力的商品价格和运费政策，请您放心购买！  -->
<!-- 		    </div> -->
		  </div>
		</div>
	</div>
<!-- 中下部的选项卡结束 -->
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="/Content/javascript/js/runda/barrelwatergoodsdetail_photo_scale.js"></script>
<script src="Content/javascript/js/runda/common_addcart_ajax.js"></script>
