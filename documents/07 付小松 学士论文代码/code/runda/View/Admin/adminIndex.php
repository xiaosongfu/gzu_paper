<!-- 顶部 -->
<?php
	include DOC_PATH_ROOT.'/View/Admin/header.php';
?>
<!-- 布局样式 -->
<link href="/Content/style/admin/layout_index.css" rel="stylesheet">
<!-- 顶部结束 -->
<!-- 主体 -->
	<div class="body">
		<!-- 左边导航栏-->
		<div class="nav_left">
		        <div class="nav_box">
				<ul class="nav nav-pills nav-stacked">
	  				<li role="presentation"><a href="/index.php?controller=Admin&method=userRoleManage" target="iframepage">用户角色管理</a></li>
            		<li role="presentation"><a href="/index.php?controller=Admin&method=userManage" target="iframepage">用户管理</a></li>
	  				<li role="presentation"><a href="/index.php?controller=Admin&method=userRealNameAuthenticationAudit" target="iframepage">用户实名认证审核</a></li>
  					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">用户收货地址管理</a></li>
  					<hr />
  					<li role="presentation"><a href="/index.php?controller=Admin&method=waterStoreStatueManage" target="iframepage">水站工作状态管理</a></li>
  					<li role="presentation"><a href="/index.php?controller=Admin&method=waterStoreAudit" target="iframepage">水站审核</a></li>
  					<li role="presentation"><a href="/index.php?controller=Admin&method=waterStoreManage" target="iframepage">水站管理</a></li>
  					<hr />
  					<li role="presentation"><a href="/index.php?controller=Admin&method=waterBearStatueManage" target="iframepage">送水工工作状态管理</a></li>
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=waterBearManage" target="iframepage">送水工管理</a></li> -->
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">送水工的行车路径管理</a></li> -->
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">送水工评价管理</a></li> -->
  					<hr />
  					<li role="presentation"><a href="/index.php?controller=Admin&method=barrelWaterCategoryManage" target="iframepage">桶装水类别管理</a></li>
  					<li role="presentation"><a href="/index.php?controller=Admin&method=barrelWaterBrandManage" target="iframepage">桶装水品牌管理</a></li>
  					<li role="presentation"><a href="/index.php?controller=Admin&method=getAlllBarrelWaterGoods" target="iframepage">桶装水管理</a></li>
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">桶装水图片管理</a></li> -->
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">桶装水评价管理</a></li> -->
  					<hr />
  					<li role="presentation"><a href="/index.php?controller=Admin&method=orderCategoryManage" target="iframepage">订单类别管理</a></li>
            		<li role="presentation"><a href="/index.php?controller=Admin&method=orderStatueManage" target="iframepage">订单状态管理</a></li>
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=orderManage" target="iframepage">订单管理</a></li> -->
<!--   					<li role="presentation"><a href="/index.php?controller=Admin&method=userReciverAddressManage" target="iframepage">订单评价管理</a></li> -->
  					<hr />
  					<li role="presentation"><a href="/index.php?controller=Admin&method=imageCarousel" target="iframepage">轮播图片管理</a></li>
  					<hr />
            		<!-- <li role="presentation"><a href="/index.php?controller=Admin&method="  target="iframepage">省市县管理</a></li>
            		<hr /> -->
<!--             		<li role="presentation"><a href="/index.php?controller=Admin&method="  target="iframepage">高级功能-图片清理</a></li> -->
  					<li role="presentation"><a href="/index.php?controller=Admin&method=sendPush"  target="iframepage">高级功能-推送</a></li>
				</ul>
				</div>
		</div>
		<!-- 左边导航栏结束 -->
		
		<!-- 右边内容-->
		<div class="content_right">
    		<iframe src="/index.php?controller=Admin&method=imageCarousel" marginheight="4px" marginwidth="0px" frameborder="0" scrolling="no" width=100% height=100% name="iframepage">
    		</iframe>
		</div>
		<!-- 右边内容结束 -->
		
		<!-- 清除浮动 -->
		<div class="clearFloat"></div>
	</div>
	<!-- 主体结束 -->
	<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/Admin/footer.php';
?>