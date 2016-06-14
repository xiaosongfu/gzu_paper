<!-- 顶部 -->
<?php
	$title = "我的润达--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_personpage.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
		<!-- 左边 -->
		<div class="left">
			<!-- 左边导航栏 -->
			<div class="leftnav">
				<hr />
				<h4>订单中心</h4><br />
				<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation"><a href="index.php?controller=Order&method=getAllOrder" target="contentIframe">所有订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Order&method=getDoneOrder" target="contentIframe">已完成订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Order&method=getUnfinishedOrder" target="contentIframe">未完成订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Order&method=getNonPaymentOrder" target="contentIframe">待付款订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Order&method=getCanceleddOrder" target="contentIframe">已取消订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Order&method=getFaileddOrder" target="contentIframe">已失败订单</a></li>
  					<li role="presentation"><a href="index.php?controller=Home&method=manageMyShoppingCart" target="_blank">我的购物车</a></li>
				</ul>
<!-- 				<hr /> -->
<!-- 				<h4>我的收藏</h4><br /> -->
<!-- 				<ul class="nav nav-pills nav-stacked"> -->
<!-- 	  				<li role="presentation"><a href="#">收藏的水站</a></li> -->
<!--   					<li role="presentation"><a href="#">收藏的桶装水</a></li> -->
<!-- 				</ul> -->
<!-- 				<hr /> -->
<!-- 				<h4>客户服务</h4><br /> -->
<!-- 				<ul class="nav nav-pills nav-stacked"> -->
<!-- 	  				<li role="presentation"><a href="#">价格保护</a></li> -->
<!--   					<li role="presentation"><a href="#">我的投诉</a></li> -->
<!--   					<li role="presentation"><a href="#">购买咨询</a></li> -->
<!-- 				</ul> -->
				<hr />
				<h4>个人信息</h4><br />
				<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation"><a href="index.php?controller=Home&method=myInformation" target="contentIframe">个人信息</a></li>
  					<li role="presentation"><a href="index.php?controller=Home&method=userRealNameAuthentication" target="_blank">实名认证</a></li>
				</ul>
				<hr />
				<h4>收货地址</h4><br />
				<ul class="nav nav-pills nav-stacked">
  					<li role="presentation"><a href="index.php?controller=Home&method=magageUserRecieverAddress" target="contentIframe">管理收货地址</a></li>
  					<li role="presentation"><a href="index.php?controller=Home&method=addUserRecieverAddress" target="contentIframe">新增收货地址</a></li>
				</ul>
				<hr />
				<h4>水站中心</h4><br />
				<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation"><a href="index.php?controller=WaterStore&method=manageMyWaterStore" target="_blank">管理水站</a></li>
				</ul>
				<hr />
			</div>
			<!-- 左边导航栏结束 -->
		</div>
		<!-- 左边结束 -->

		<!-- 右边 -->
		<div class="right">
		      <iframe src="index.php?controller=Home&method=myInformation" name="contentIframe" frameborder="0" scrolling="yes" width=100% height=100% marginheight="2px" marginwidth="2px"></iframe>
		</div>
		<!-- 右边结束 -->
		<div class="clearFloat"></div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>