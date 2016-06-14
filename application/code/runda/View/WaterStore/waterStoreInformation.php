<!-- 顶部 -->
<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_waterstoreinformation.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<?php
	//$isLockArr = array(0=>"未锁定",1=>"已锁定");
    echo '水站编号:&nbsp;&nbsp;'.$result['id'].'<hr />水站负责人:&nbsp;&nbsp;'.$_SESSION['userName'].'<hr />水站名称:&nbsp;&nbsp;'
	    .$result['waterStoreName'].'<hr />水站电话号码:&nbsp;&nbsp;'.$result['waterStoreTellPhone'].
    '<hr />水站固定电话:&nbsp;&nbsp;'.$result['waterStoreFixedLinePhone'].'<hr />水站邮箱:&nbsp;&nbsp;'
    .$result['waterStoreEmail'].'<hr />水站状态:&nbsp;&nbsp;'
        .$waterStoreStatusArr[$result['waterStoreStatus']].'<hr />水站地址:&nbsp;&nbsp;'.$result['province'].$result['city'].$result['country'].$result['detailAddress'].'<hr /><hr />';
    
//     echo '水站编号:'.$result['id'].'<hr />水站负责人:'.$result['owner'].'<hr />水站名称:'
//         .$result['waterStoreName'].'<hr />水站电话号码:'.$result['waterStoreTellPhone'].
//         '<hr />水站固定电话:'.$result['waterStoreFixedLinePhone'].'<hr />水站邮箱:'
//             .$result['waterStoreEmail'].'<hr />水站锁定情况:'.$result['isLock'].'<hr />水站状态:'
//                 .$result['waterStoreStatus'].'<hr />水站地址:'.$result['province'].'省'.$result['city'].'市'.$result['country'].'县/区'.$result['detailAddress'].'<hr /><hr />';
?>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>