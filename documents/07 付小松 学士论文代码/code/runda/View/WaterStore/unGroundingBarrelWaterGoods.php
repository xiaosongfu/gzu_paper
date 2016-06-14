<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <div>
    <form class="form-horizontal" id="ungroundingBarrelWaterGoods" role="form" method="post">
	   <table class="table table-bordered table-hover">
	       <tr><td><input type="checkbox" id="checkAll"/>全选</td><td>类别</td><td>品牌</td><td>商品名称</td><td>商品描述</td><td>商品价格</td><td>商品库存</td><td>上传时间</td><td>当前销量</td><td>下架</td></tr>
	       <?php
	       if($result != null){
	            foreach ($result as $key=>$value){
	                $isGroundingArr = array("0"=>"未上架","1"=>"已上架");
	               echo '<tr><td><input type="checkbox" name="ungroundingbarrelWaterGoods[]" value="'.$value['id'].'"/></td><td>'.$barrelWaterCategoryArray[$value['waterCate']].'</td><td>'.$barrelWaterBrandArray[$value['waterBrand']].'</td><td>'.$value['waterGoodsName'].'</td><td><a target="_blank" href="index.php?controller=WaterStore&method=showAndEditWaterGoodsDescript&id='.$value['id'].'">查看与编辑</a></td><td>'.$value['waterGoodsPrice'].'</td><td>'.$value['waterGoodsInventory'].'</td><td>'.date("Y-m-d H:i:s",$value['groundingDate']).'</td><td>'.$value['salesVolume'].'</td><td>下架</td></tr>';
	            }
	       }
	       ?>
        </table>
        <div>
    	       <button class="btn btn-info"  type="button" onclick="btnClickYes()">全选</button>
    	       <button class="btn btn-info"  type="button" onclick="btnClickNo()">全不选</button>
    	       <button class="btn btn-danger" id="ungrounding_btn" type="submit">下架所选</button>
    	</div>
    </form>
	</div>

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
<script src="/Content/javascript/js/waterstore/ungrounding_barrelwatergoods_ajax.js"></script>
<!-- 全选 -->
<script src="/Content/javascript/js/waterstore/check_uncheck_all_ungrounding.js"></script>