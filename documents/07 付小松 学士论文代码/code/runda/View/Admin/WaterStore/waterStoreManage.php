<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	   		<tr><td>水站编号</td><td>水站负责人</td><td>水站名称</td><td>水站电话</td><td>水站固定电话</td><td>水站邮箱</td><td>水站状态</td><td>水站审核状态</td><td>水站详细地址</td><td>水站经度</td><td>水站纬度</td><td>水站营业执照</td></tr>
	        <?php
	        if($result != ""){
	       		//$isLock = array(0 =>"未锁定" , 1 =>"已锁定");
	       		$waterStoreStatus = array(0 =>"正常营业", 1 =>"忙碌中", 2 =>"休息中");
	       		$waterStoreAudit = array(0 =>"待审核",1 =>"审核通过",2 =>"审核失败");
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['id'].'</td><td>'.$value['owner'].'</td><td>'.$value['waterStoreName'].'</td><td>'.$value['waterStoreTellPhone'].'</td><td>'.
	               $value['waterStoreFixedLinePhone'].'</td><td>'.$value['waterStoreEmail'].'</td><td>'.$waterStoreStatus[$value['waterStoreStatus']].'</td><td>'.$waterStoreAudit[$value['auditStatus']].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td>'.$value['waterStoreLongitude'].'</td><td>'.$value['waterStoreLatitude'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['businessLicense'].'" target="_blank">查看</a></td></tr>';
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