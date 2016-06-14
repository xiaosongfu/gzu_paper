<?php
	$title = "我的水站--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_query_mywaterstore.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<?php
	//用户还不是水站负责人
	//展示邀请用户入驻的页面
	// $statue = "not";
if($statue == "not"){ ?>
	<div class="not">
	您还不是水站负责人,<a href="index.php?controller=WaterStore&method=waterStoreEnter" target="_blank">申请入驻?&nbsp;&nbsp;</a>
	<br />
	<img src="/Content/image/common/no.png" />
	</div>
<?php
	//待审核
	// $statue = "wait";
}elseif($statue == "wait"){ ?>
	<div class="wait">
	<img src="/Content/image/common/waiting.gif" />
	<br />
	您的入驻申请已提交,正在审核中......
	</div>
<?php
	//审核失败
	// $statue = "fail";
}elseif ($statue == "fail") { ?>
	<div class="fail">
	您的入驻申请审核失败,原因是：
	<?php echo $auditDetail;?>
	<br /><br />
	<img src="/Content/image/common/error.jpg" />
	</div>
<?php
	//系统错误
	// $statue = "error";
}else{ ?>

<div class="error">
系统错误,请稍后再试
</div>

<?php
}?>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>