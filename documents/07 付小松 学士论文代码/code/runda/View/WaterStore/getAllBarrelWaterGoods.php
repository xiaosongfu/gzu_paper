<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <div>
	   <table class="table table-bordered table-hover">
	       <tr><td>类别</td><td>品牌</td><td>商品名称</td><td>商品描述</td><td>商品价格</td><td>商品库存</td><td>上传时间</td><td>是否上架</td><td>当前销量</td></tr>
	       <?php
	       if($result != null){
	            foreach ($result as $key=>$value){
	                $isGroundingArr = array("0"=>"未上架","1"=>"已上架");
	               echo '<tr><td>'.$barrelWaterCategoryArray[$value['waterCate']].'</td><td>'.$barrelWaterBrandArray[$value['waterBrand']].'</td><td>'.$value['waterGoodsName'].'</td><td><a target="_blank" href="index.php?controller=WaterStore&method=showAndEditWaterGoodsDescript&id='.$value['id'].'">查看与编辑</a></td><td>'.$value['waterGoodsPrice'].'</td><td>'.$value['waterGoodsInventory'].'</td><td>'.date("Y-m-d H:i:s",$value['groundingDate']).'</td><td>'.$isGroundingArr[$value['isGrounding']].'</td><td>'.$value['salesVolume'].'</td></tr>';
	            }
	       }
	       ?>
        </table>
	</div>
	<div>
	<?php
	    //分页导航栏 
	    echo $pageBar;
    ?>
	</div>
	
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>