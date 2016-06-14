<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>账号ID</td><td>省</td><td>市</td><td>县</td><td>详细地址</td><td>删除</td></tr>
	       <?php
	       if($result != ""){
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['userID'].'</td><td>'.$value['province'].'</td><td>'.$value['city'].'</td><td>'.$value['country'].'</td><td>'.$value['detailAddress'].'</td><td><a href="index.php?controller=Admin&method=deleteAnUserRecieverAddress&id='.$value['id'].'">删除</a></td></tr>';
	            }
	       }
	       
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