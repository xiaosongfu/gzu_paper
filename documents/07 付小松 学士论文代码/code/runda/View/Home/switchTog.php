<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>润达智能送水 --润你生活</title>
<link href="/Content/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/Content/style/reset.css" rel="stylesheet">
<link href="/Content/style/main.css" rel="stylesheet">
<link href="/Content/style/runda/layout.css" rel="stylesheet">
	<!--[if lt IE 9]>
       <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!-- 顶部 -->
	<div class="header">
		<div class="topBar">
			<a href="index.php"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon glyphicon-home" aria-hidden="true"></span></button></a>&nbsp;&nbsp;
			
			<?php 
				if(isset($_SESSION['id']) && isset($_SESSION['username'])){
					echo '
			<div class="btn-group">
			  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">我的润达 <span class="caret"></span></button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="#">我的订单</a></li>
				    <li><a href="#">测试A</a></li>
				    <li><a href="index.php?controller=Home&method=quit">退出</a></li>
				  </ul>
			</div>';
				}else{
					echo '
					<a href="index.php?controller=Home&method=login"><button type="button" class="btn btn-info btn-sm">登录</button></a>
					<a href="index.php?controller=Home&method=register"><button type="button" class="btn btn-info btn-sm">免费注册</button></a>';
				}
			?>

			<a href="index.php?controller=RunDa&method=aboutRunda"><button type="button" class="btn btn-info btn-sm">关于润达</button></a>
			<a href="index.php?controller=RunDa&method=connectoToRunda"><button type="button" class="btn btn-info btn-sm">联系我们</button></a>
		</div>
		<div class="logoBar">
			<div class="logo">
				<a href="index.php"><img src="/Content/image/logo.png" alt="润达"></a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	
	<!-- 主体 -->
	<div class="main">
	<a href="#">继续浏览</a><br />
	<a href="index.php?controller=Home&method=personPage">前往个人主页</a>
	<br />
	<br />
	<br />

	</div>
	<!-- 主体结束 -->
	
	<!-- 底部 -->
	<div class="footer">
		<p>
			<a href="index.php?controller=RunDa&method=aboutRunda" type="button" class="btn btn-info btn-sm">润达简介</a><span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
			<a href="#" type="button" class="btn btn-info btn-sm">水站入驻</a><span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
			<a href="#" type="button" class="btn btn-info btn-sm">意见反馈</a><span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
			<a href="index.php?controller=RunDa&method=connectoToRunda" type="button" class="btn btn-info btn-sm">联系我们</a><span class="glyphicon glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
			<button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>&nbsp;客服热线：400-567-1234</button>
		</p>
		<p>
		技术支持&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
		<a href="http://v3.bootcss.com/">bootstrap</a>
		<a href="http://easyicon.net/">easyicon</a>
		</p>
		<p>Copyright &copy; 2013 - 2014 润达版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
		<div class="web">
			<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
			<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
			<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
			<a href="#"><img src="/Content/image/webLogo.jpg" alt="logo"></a>
		</div>
	</div>
	<script src="/Content/javascript/jquery/jquery.min.js"></script>
	<script src="/Content/javascript/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>