<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
	<table class="table table-bordered table-hover">
	<tr><td>省市县</td><td>详细地址</td><td>操作</td></tr>
    <?php 
    foreach ($result as $key=>$value){
        echo '<tr><td>'.$value['province'].'---'.$value['city'].'---'.$value['country'].'</td><td>'.$value['detailAddress'].'</td><td><a href="javascript:void(0)" onclick="deleteReciAddr('.$value['id'].');">删除</a></td></tr>';
    }
    ?>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<script src="/Content/javascript/js/home/delete_user_recieveraddress_ajax.js"></script>