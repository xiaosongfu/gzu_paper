<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>订单类别编号</td><td>订单类别</td></tr>
	       <?php
	       if($result != ""){
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['id'].'</td><td>'.$value['orderCategoryName'].'</td></tr>';
	            }
	       }
	       
	       ?>
        </table>
	</div>
</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>