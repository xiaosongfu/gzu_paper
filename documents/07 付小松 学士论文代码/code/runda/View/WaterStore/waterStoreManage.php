<!-- 顶部 -->
<?php
	$title = "我的水站--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_waterstore_manage.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
	<!-- 左边 -->
	<div class="left">
		<!-- 左边导航栏 -->
		<div class="leftnav">
			<hr />
			<h4>桶装水管理</h4><br />
			<ul class="nav nav-pills nav-stacked">
  				<li role="presentation"><a href="index.php?controller=WaterStore&method=getAllBarrelWaterGoods" target="contentIframe">所有桶装水</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=groundingBarrelWaterGoods" target="contentIframe">待上架的桶装水</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=unGroundingBarrelWaterGoods" target="contentIframe">可下架的桶装水</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=uploadBarrelWater" target="contentIframe">上传桶装水</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=deleteBarrelWaterGoods" target="contentIframe">删除桶装水</a></li>
			</ul>
			<hr />
			<h4>送水工管理</h4><br />
			<ul class="nav nav-pills nav-stacked">
  				<li role="presentation"><a href="index.php?controller=WaterStore&method=getAllWaterBearers" target="contentIframe">查看所有送水工</a></li>
<!--   				<li role="presentation"><a href="#">查看送水工位置</a></li> -->
<!-- 				<li role="presentation"><a href="index.php?controller=WaterStore&method=addWaterBearer" target="contentIframe">查看送水工业绩</a></li> -->
				<li role="presentation"><a href="index.php?controller=WaterStore&method=addWaterBearer" target="contentIframe">添加送水工</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=delWaterBearer" target="contentIframe">删除送水工</a></li>
			</ul>
			<hr />
			<h4>水站业绩</h4><br />
			<ul class="nav nav-pills nav-stacked">
<!-- 				<li role="presentation"><a href="index.php?controller=WaterStore&method=achievementManage" target="contentIframe">水站业绩</a></li> -->
				<li role="presentation"><a href="index.php?controller=WaterStore&method=getAllOrder" target="contentIframe">所有订单</a></li>
			</ul>
			<hr />
			<h4>水站设置</h4><br />
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation"><a href="index.php?controller=WaterStore&method=getwaterStoreStatus" target="contentIframe">营业状态</a></li>
  				<li role="presentation"><a href="index.php?controller=WaterStore&method=waterStoreInformation" target="contentIframe">水站信息</a></li>
				<li role="presentation"><a href="index.php?controller=WaterStore&method=waterStoreBusinessLicense" target="contentIframe">营业执照</a></li>
			</ul>
			<hr />
			<h4>水站首页</h4><br />
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation"><a href="index.php?controller=WaterStore&method=myWaterStore&waterStoreID=<?php echo $_SESSION['waterStoreID']; ?>" target="_blank">水站首页</a></li>
			</ul>
			<hr />
		</div>
		<!-- 左边导航栏结束 -->
	</div>
	<!-- 左边结束 -->

	<!-- 右边 -->
	<div class="right">
		<iframe src="index.php?controller=WaterStore&method=waterStoreInformation" name="contentIframe" frameborder="0" scrolling="auto" width=100% height=100% marginheight="2px" marginwidth="2px"></iframe>
	</div>
	<!-- 右边结束 -->
	<div class="clearFloat"></div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>