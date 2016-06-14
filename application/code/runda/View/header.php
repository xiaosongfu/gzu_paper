<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<link href="/Content/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Content/style/layout_reset.css" rel="stylesheet">
<link href="/Content/style/layout_basic.css" rel="stylesheet">
	<!--[if lt IE 9]>
       <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!-- 顶部 -->
	<div class="header">
		<div class="topBar">
			<a href="index.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></button></a>&nbsp;&nbsp;
			
			<?php 
				if(isset($_SESSION['id']) && isset($_SESSION['userName'])){
					echo '
			<div class="btn-group">
			  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">我的润达 <span class="caret"></span></button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="index.php?controller=Home&method=personPage">个人中心</a></li>
				    <li><a href="index.php?controller=Home&method=manageMyShoppingCart"  target="_blank">查看购物车</a></li>
				    <li><a href="index.php?controller=Home&method=quit">退出</a></li>
				  </ul>
			</div>';
				}else{
					echo '
					<a href="index.php?controller=Home&method=login"><button type="button" class="btn btn-default btn-sm">登录</button></a>
					<a href="index.php?controller=Home&method=register"><button type="button" class="btn btn-default btn-sm">免费注册</button></a>';
				}
			?>

			<a href="index.php?controller=RunDa&method=aboutRunDa" target="_blank"><button type="button" class="btn btn-default btn-sm">关于润达</button></a>
			<a href="index.php?controller=RunDa&method=connectToRunDa" target="_blank"><button type="button" class="btn btn-default btn-sm">联系我们</button></a>
		</div>
		<div class="logoBar">
			<div class="logo">
				<a href="index.php"><img src="/Content/image/common/logo.png" alt="润达"></a>
			</div>
		</div>
	</div>
<!-- 顶部结束 -->
<!-- 主体 -->