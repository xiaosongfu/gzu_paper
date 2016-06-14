<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理员首页 --润达送水 润你生活</title>
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
			<a href="index.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></button></a>
			<?php 
				if(isset($_SESSION['adminID']) && isset($_SESSION['adminName'])){
					echo '<button type="button" class="btn btn-default btn-sm">管理员:'.$_SESSION['adminName'].'已登录</button>&nbsp;';
					echo '<a href="index.php?controller=Admin&method=adminLogou" type="button" class="btn btn-default btn-sm">退出系统</a>';
				}
			?>
		</div>
		<div class="logoBar">
			<div class="logo">
				<a href="index.php"><img src="/Content/image/common/logo.png" alt="润达"></a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 主体 -->