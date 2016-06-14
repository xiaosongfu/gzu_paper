<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>管理员登录 --润达送水</title>
<!-- 样式表 -->
<link href="/Content/style/admin/layout_login.css" rel="stylesheet">
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
		</div>
		<div class="logoBar">
			<div class="logo">
				<a href="index.php"><img src="/Content/image/common/logo.png" alt="润达"></a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 主体 -->
	<div class="body">
			<div class="center-block">
			<h3>后台管理员登录</h3><hr /><hr />
				<form class="form-horizontal" role="form" action="index.php?controller=Admin&method=adminLogin" method="post">
					<div class="form-group has-success">
						<div class="col-sm-4">
							<input type="text" name="username" class="form-control" placeholder="管理员账号" />
						</div>
					</div>
					<div class="form-group has-success">
						<div class="col-sm-4">
							<input type="password" name="password" class="form-control" placeholder="管理员密码" />
						</div>
					</div>
					<div class="form-group has-success">
						<div class="col-sm-4">
							<input type="text" id="checkcode" name="checkcode" class="form-control" placeholder="验证码" oninput="checkCode()" />
						</div>
						<div id="checkErr" class="col-sm-4 text-danger"></div>
					</div>
					<div class="form-group">
							<div class="col-sm-8">
					    	<img id="validcode" src="index.php?controller=Admin&method=getCode" />&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript:document.getElementById('validcode').src='index.php?controller=Admin&method=getCode&'+Math.random()">换1张</a>
					    	</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-4">
							<button class="btn btn-success" name="adminLogin" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
							<?php echo $errmes;?>
						</div>
					</div>
				</form>
			</div>
	</div>
<script src="/Content/javascript/js/admin/admin_login_ajax_valide_checkcode.js"></script>
<script src="/Content/javascript/jquery/jquery.min.js"></script>
<script src="/Content/javascript/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>