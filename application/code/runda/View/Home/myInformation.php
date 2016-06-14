<!-- 顶部 -->
<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
	$fileNewName = $userInfo['photo'];
	$pos = strrpos($fileNewName,"Content");
	$res = substr($fileNewName,$pos);
	$photoPath = "/".$res;
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_myinformation.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
    <div class="left_info">
                         账号ID:<?php echo $userInfo['id'];?>
                        <hr />
                        用户名:<?php echo $userInfo['userName'];?>
                        <hr />
                        昵称:<?php echo $userInfo['nickName'];?>
                        <hr />
                        性别:<?php echo $userInfo['sex'];?>
                        <hr />
                        真实性名:<?php echo $userInfo['realName'];?>
                        <hr />
                        电话号码:<?php echo $userInfo['phoneNumber'];?>
                        <hr />
                        邮箱:<?php echo $userInfo['email'];?>
                        <hr />
                        角色:<?php echo $roleArray[$userInfo['role']];?>
                        <hr />
                        详细地址:<?php echo $userInfo['province'].$userInfo['city'].$userInfo['country'].$userInfo['detailAddress'];?>
                        <hr />
    </div>
    <div class="right_photo">
        <img src="<?php echo $photoPath;?>" />
    </div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>