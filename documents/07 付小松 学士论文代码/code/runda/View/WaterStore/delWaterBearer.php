<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <div>
	   <table class="table table-bordered table-hover">
	       <tr><td><input type="checkbox" id="checkAll"/>全选</td><td>送水工账号ID</td><td>最大载重量</td><td>状态</td></tr>
	       <?php
	       if($waterbearers != null){
	            foreach ($waterbearers as $key=>$value){
	               echo '<tr><td><input type="checkbox" name="waterBearers[]" value="'.$value['id'].'"/></td><td>'.$value['userId'].'</td><td>'.$value['maxLoadCapacity'].'</td><td>'.$waterBearerStatueArray[$value['statue']].'</td></tr>';
	            }
	       }
	       ?>
        </table>
	</div>
	<div>
	<button class="btn btn-info"  type="button" onclick="btnClickYes()">全选</button>
    <button class="btn btn-info"  type="button" onclick="btnClickNo()">全不选</button>
	<button class="btn btn-danger">删除所选</button>
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
<!-- 全选 -->
<script src="/Content/javascript/js/waterstore/check_uncheck_waterbear_delete.js"></script>