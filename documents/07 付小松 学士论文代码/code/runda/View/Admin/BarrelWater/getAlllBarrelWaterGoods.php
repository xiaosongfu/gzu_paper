<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>编号</td><td>所属水站</td><td>分类</td><td>品牌</td><td>名称</td><td>价格</td></tr>
	       <?php
	       if($barrelWaterGoodsResult != ""){
	            foreach ($barrelWaterGoodsResult as $key=>$value){
	               echo "<tr>
	               <td>{$value['id']}</td>
	               <td>{$value['waterStoreID']}</td>
	               <td>{$value['waterCate']}</td>
	               <td>{$value['waterBrand']}</td>
	               <td>{$value['waterGoodsName']}</td>
	               <td>{$value['waterGoodsPrice']}</td>
	               </tr>";
	            }
	       }
	       // echo "<pre>";
	       // print_r($barrelWaterGoodsResult); //-->
	       // Array
			// (
			//     [0] => Array
			//         (
			//             [id] => 8
			//             [waterStoreID] => 10000
			//             [waterCate] => 0
			//             [waterBrand] => 3
			//             [waterGoodsName] => 吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田吉田
			//             [waterGoodsDescript] => 
	       
	       ?>
        </table>
	</div>
	<div>
	<?php echo $pageBar; ?>
	</div>
</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>