<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>账号ID</td><td>用户名</td><td>昵称</td><td>性别</td><td>真实性名</td><td>头像</td><td>电话号码</td><td>邮箱</td><td>身份证正面</td><td>身份证反面</td><td>身份证号码</td><td>是否实名认证</td><td>角色</td><td>详细地址</td><td>删除用户</td></tr>
	       <?php
	       if($result != ""){
	           //$isLockArray = array(0=>"未锁定",1=>"已锁定");
	           $isRealNameAuthen = array(0=>"未认证",1=>"已认证",2=>"认证失败",3=>"待审核");
	            foreach ($result as $key=>$value){
	               // echo '<tr><td>'.$value['id'].'</td><td>'.$value['userName'].'</td><td>'.$value['nickName'].'</td><td>'.$value['sex'].'</td><td>'.$value['realName'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['photo'].'" target="_blank">查看头像</a></td><td>'.$value['phoneNumber'].'</td><td>'.$value['email'].'</td><td>'.$value['idCardGraphFront'].'</td><td>'.$value['idCardGraphBack'].'</td><td>'.$value['idCardNumber'].'</td><td>'.$isRealNameAuthen[$value['isRealNameAuthen']].'</td><td>'.$roleArray[$value['role']].'</td><td>'.$isLockArray[$value['isLock']].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td><a href="index.php?controller=Admin&method=deleteAnUser&id='.$value['id'].'">删除改用户</a></td></tr>';
	               if($value['idCardGraphFront'] == ''){
	               		echo '<tr><td>'.$value['id'].'</td><td>'.$value['userName'].'</td><td>'.$value['nickName'].'</td><td>'.$value['sex'].'</td><td>'.$value['realName'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['photo'].'" target="_blank">查看</a></td><td>'.$value['phoneNumber'].'</td><td>'.$value['email'].'</td><td>未上传</td><td>未上传</td><td>'.$value['idCardNumber'].'</td><td>'.$isRealNameAuthen[$value['isRealNameAuthen']].'</td><td>'.$roleArray[$value['role']].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td><a href="index.php?controller=Admin&method=deleteAnUser&id='.$value['id'].'">删除</a></td></tr>';
	               }else{
	               		echo '<tr><td>'.$value['id'].'</td><td>'.$value['userName'].'</td><td>'.$value['nickName'].'</td><td>'.$value['sex'].'</td><td>'.$value['realName'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['photo'].'" target="_blank">查看</a></td><td>'.$value['phoneNumber'].'</td><td>'.$value['email'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['idCardGraphFront'].'" target="_blank">查看</a></td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['idCardGraphBack'].'" target="_blank">查看</a></td><td>'.$value['idCardNumber'].'</td><td>'.$isRealNameAuthen[$value['isRealNameAuthen']].'</td><td>'.$roleArray[$value['role']].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td><a href="index.php?controller=Admin&method=deleteAnUser&id='.$value['id'].'">删除</a></td></tr>';
	               }
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