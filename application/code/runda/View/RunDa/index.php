<!-- 顶部 -->
<?php
	$title = "润达智能水-网站首页 --润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<link href="/Content/style/runda/layout_index.css" rel="stylesheet">
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
		<!-- 1 图片轮播 图片的大小为：1000X360px-->
		<div class="photo">
		<div class="photocarousel">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			  <?php 
			    if($imageCarouselRes != ""){
			        for($i = 0;$i<count($imageCarouselRes);$i++){
			            if($i == 0){
				            echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>';
			            }else{
			                echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
			            }
			        }
			    }
			  ?>
			    <!-- 这里控制图片轮播的张数 -->
			  </ol>
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			  <?php 
			  if($imageCarouselRes != ""){
			      foreach($imageCarouselRes as $key => $value){
			          if($key == 0){
			              echo '<div class="item active">';
			          }else{
			              echo '<div class="item">';
			          }
			          $fileNewName = $value['imagePath'];
			          $pos = strrpos($fileNewName,"Content");
            		  $imageCarouselRes = substr($fileNewName,$pos);
            		  $imagePath = "/".$imageCarouselRes;

			          echo '<a href="'.$value['imageURL'].'"><img width="1320px" height="450px" src="'.$imagePath.'"></a>
			                <div class="carousel-caption">
        				    <h3>'.$value['imageDescript'].'</h3>
        				    </div>
        				    </div>';
			      }
			  }  
			  ?>
			  </div>
			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
		</div>
		<!-- 1 图片轮播结束 -->

		<!-- 2 导航栏 -->
		<div class="nav">
			<ul class="nav nav-pills nav-justified">
			<?php
				foreach ($barrelWaterBrand as $key => $value) {
					echo '<li role="presentation"><a href="#">'.$value['barrelWaterBrandName'].'</a></li>';
				}
			?>
			</ul>
		</div>

		<!-- 3 商品展示1 最新上架 -->
		<div class="goodsshow">
		<!-- <span class="con_bar ">最新上架<span> -->
		<span class="bg-info con_bar">最新上架<span>
			<!--  1 一行有三列 -->
			<?php 
			    if($newsestBarrelWGoods != ""){
			        for($i = 0;$i<count($newsestBarrelWGoods);$i++){
			        	$imageSrc = "/".substr($newsestBarrelWGoods[$i]['waterGoodsDefaultImage'],strrpos($newsestBarrelWGoods[$i]['waterGoodsDefaultImage'],"Content"));
			        	if((($i+1) % 3) == 0 || $i == 0){
			        		echo '<div class="row">';
			        	}
			        	echo '
			        	<div class="col">
							<div class="col-sm-6 col-md-4">
					    	<div class="thumbnail">
					    		 <a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$newsestBarrelWGoods[$i]['id'].'" target="_blank">
					     		 <img src="'.$imageSrc.'" alt="'.$newsestBarrelWGoods[$i]['waterGoodsName'].'" />
					     		 </a>
					     	<div class="caption">
					        	<h4>'.substr($newsestBarrelWGoods[$i]['waterGoodsName'],0,24).'</h4>
						        <p class="text-danger goodsPrice">￥:'.$newsestBarrelWGoods[$i]['waterGoodsPrice'].'
						        </p>
						        	<p class="buyorcart">
						        	<button class="btn btn-primary" role="button" onclick="addCartFun('.$newsestBarrelWGoods[$i]['id'].');">加购物车</button>
						        	<a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$newsestBarrelWGoods[$i]['id'].'" target="_blank" class="btn btn-primary" role="button">查看详情</a>
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
		<!-- 商品展示结束1 -->

		<!-- 3 商品展示2 最多销量 -->
		<div class="goodsshow">
		<!-- <span class="con_bar">最多销量<span> -->
		<span class="bg-info con_bar">最多销量<span>
		<!--  1 一行有三列 -->
		<?php 
		    if($hottestBarrelWGoods != ""){
		        for($i = 0;$i<count($hottestBarrelWGoods);$i++){
		        	$imageSrc = "/".substr($hottestBarrelWGoods[$i]['waterGoodsDefaultImage'],strrpos($hottestBarrelWGoods[$i]['waterGoodsDefaultImage'],"Content"));
		        	if((($i+1) % 3) == 0 || $i == 0){
		        		echo '<div class="row">';
		        	}
		        	echo '
		        	<div class="col">
						<div class="col-sm-6 col-md-4">
				    	<div class="thumbnail">
				     		 <img src="'.$imageSrc.'" alt="'.$hottestBarrelWGoods[$i]['waterGoodsName'].'">
				     	<div class="caption">
				        	<h4>'.substr($hottestBarrelWGoods[$i]['waterGoodsName'],0,24).'</h4>
					        <p class="text-danger goodsPrice">￥:'.$hottestBarrelWGoods[$i]['waterGoodsPrice'].'
					        </p>
					        	<p class="buyorcart">
					        	<button class="btn btn-primary" role="button" onclick="addCartFun('.$hottestBarrelWGoods[$i]['id'].');">加购物车</button>
					        	<a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$hottestBarrelWGoods[$i]['id'].'" target="_blank" class="btn btn-primary" role="button">查看详情</a>
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
		<!-- 商品展示结束2 -->

		<!-- 4 水站展示 -->
		<div class="waterstoreshow">
		<!-- <span class="con_bar">最多销量热榜水站<span> -->
		<span class="bg-info con_bar">最多销量热榜水站<span>
		<?php 
		    if($hottestWaterStore != ""){
		        for($i = 0;$i<count($hottestWaterStore);$i++){
		        	$imageSrc = "/".substr($hottestWaterStore[$i]['waterStoreImage'],strrpos($hottestWaterStore[$i]['waterStoreImage'],"Content"));
		        	if((($i+1) % 3) == 0 || $i == 0){
		        		echo '<div class="row">';
		        	}
		        	echo '
		        	<div class="col">
						<div class="col-sm-6 col-md-4">
				    	<div class="thumbnail">
				     		 <a href="index.php?controller=WaterStore&method=myWaterStore&waterStoreID='.$hottestWaterStore[$i]['id'].'"><img src="'.$imageSrc.'" alt="'.$hottestWaterStore[$i]['waterStoreName'].'" /></a>
				     	<div class="caption">
				        	<a href="index.php?controller=WaterStore&method=myWaterStore&waterStoreID='.$hottestWaterStore[$i]['id'].'"><h3>'.$hottestWaterStore[$i]['waterStoreName'].'</h3></a>
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
		<!-- 水站展示结束 -->
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="Content/javascript/js/runda/common_addcart_ajax.js"></script>
