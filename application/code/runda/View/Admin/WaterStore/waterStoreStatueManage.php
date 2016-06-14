<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>水店状态编号</td><td>水店状态</td></tr>
	       <?php
	       if($result != ""){
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['id'].'</td><td>'.$value['waterStoreStat'].'</td></tr>';
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