<!-- 顶部 -->
<?php
	$title = "润达智能水-用户登录 --润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_login.css" rel="stylesheet">
<!-- 主体 -->
<?php 
	//获取Cookie设置用户名和密码
	//要解密ascs432gfgx27h653gfi9
	$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
	$phonenumber = isset($_COOKIE['phonenumber']) ? $_COOKIE['phonenumber'] : '';
	$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
	// if($username != "" && $password!= "" && ){
	// 	$username = EncryptDecrypt::decrypt($username,"ascs432gfgx27h653gfi9");
	// 	$password = EncryptDecrypt::decrypt($password,"ascs432gfgx27h653gfi9");
	// 	$phonenumber = EncryptDecrypt::decrypt($phonenumber,"ascs432gfgx27h653gfi9");
	// }
	if($password != ""){
		require(DOC_PATH_ROOT."/Lib/EnCryptDeCrypt/encryptdecrypt.func.php");
		$password = EncryptDecrypt::decrypt($password,"ascs432gfgx27h653gfi9");
	}
	if($username != ""){
		$username = EncryptDecrypt::decrypt($username,"ascs432gfgx27h653gfi9");
	}
	if($phonenumber != ""){
		$phonenumber = EncryptDecrypt::decrypt($phonenumber,"ascs432gfgx27h653gfi9");
	}
?>
<div class="body">
		<!-- 左边图片块 -->
		<div class="left">
		</div>
		<!-- 左边图片块结束 -->
		<!-- 右边登录块 -->
		<div class="right">
			<!-- tab形式的登录方式选择框 -->
			<div role="tabpanel">
  			<!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#userName" aria-controls="userName" role="tab" data-toggle="tab">用户名登陆</a></li>
			    <li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab">手机号登录</a></li>
			  </ul>
			  <!-- Tab panes -->
			  <div class="tab-content">
			  	<br /><br />
			    <div role="tabpanel" class="tab-pane active" id="userName">
			    <!-- 用户名登陆的登录框 -->
			    	<div class="center-block">
			 		<!-- action="index.php?controller=Home&method=loginProc"  -->
						<form class="form-horizontal" id="loginFormWithUserName" role="form" method="post">
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">用户名</label>
								<div class="col-sm-6">
									<input type="text" name="userName" class="form-control" placeholder="用户名" value="<?php echo $username;?>" />
									<div id="errMes" class="col-sm-10 text-danger">
									</div>
									<div id="lock" style="display:none" class="col-sm-10 text-danger">
									您的账号已被锁定,<a href="#">点击解锁-></a>
									</div>
								</div>
							</div>
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
								<div class="col-sm-6">
									<input type="password" name="passWord" class="form-control" placeholder="密码" value="<?php echo $password;?>" />
								</div>
								<a href="index.php?controller=Home&method=changePassword"><h5>忘记密码?</h5></a>
							</div>
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">验证码</label>
								<div class="col-sm-4">
									<input type="text" id="checkcode" name="checkCode" class="form-control" placeholder="验证码" oninput="checkC()"/>
								</div>
								<div id="checkErr" class="text-danger">
								</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<div class="col-sm-8">
							    	<img id="validcode" src="index.php?controller=Home&method=getCode" />&nbsp;&nbsp;&nbsp;
							    	<a href="javascript:void(0)" onclick="javascript:document.getElementById('validcode').src='index.php?controller=Home&method=getCode&'+Math.random()">换1张</a>
							    	</div>
							</div>
							<div class="form-group">
							        <label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<div class="col-sm-6">
								        <input type="checkbox" name="autologin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;记住密码
							        </div>
						    </div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-success" name="login" type="submit"><span id="login_stat">&nbsp;登&nbsp;录&nbsp;</span></button>
									<!-- <a class="btn btn-info" href="index.php?controller=Home&method=register">&nbsp;注&nbsp;册&nbsp;</a> -->
								</div>
							</div>
						</form>
					</div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="phone">
			    <!-- 手机号登录的登录框	 -->
			    	<div class="center-block">
			 		<!-- action="index.php?controller=Home&method=loginProc"  -->
						<form class="form-horizontal" id="loginFormWithPhone" role="form" method="post">
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">手机号</label>
								<div class="col-sm-6">
									<input type="text" name="phoneNumber" class="form-control" placeholder="手机号" value="<?php echo $phonenumber;?>" />
									<div id="errMes2" class="col-sm-10 text-danger">
									</div>
									<div id="lock2" style="display:none" class="col-sm-10 text-danger">
									您的账号已被锁定,<a href="#">点击解锁-></a>
									</div>
								</div>
							</div>
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
								<div class="col-sm-6">
									<input type="password" name="passWord" class="form-control" placeholder="密码" value="<?php echo $password;?>" />
								</div>
								<a href="index.php?controller=Home&method=changePassword"><h5>忘记密码?</h5></a>
							</div>
							<div class="form-group has-success">
								<label class="col-sm-2  control-label">验证码</label>
								<div class="col-sm-4">
									<input type="text" id="checkcode2" name="checkCode" class="form-control" placeholder="验证码" oninput="checkC2()"/>
								</div>
								<div id="checkErr2" class="text-danger">
								</div>
							</div>
							<div class="form-group">
									<label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<div class="col-sm-8">
							    	<img id="validcode2" src="index.php?controller=Home&method=getCode" />&nbsp;&nbsp;&nbsp;
							    	<a href="javascript:void(0)" onclick="javascript:document.getElementById('validcode').src='index.php?controller=Home&method=getCode&'+Math.random()">换1张</a>
							    	</div>
							</div>
							<div class="form-group">
							        <label class="col-sm-2  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
									<div class="col-sm-6">
								        <input type="checkbox" name="autologin">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;记住密码
							        </div>
						    </div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button class="btn btn-success" name="login" type="submit"><span id="login_stat2">&nbsp;登&nbsp;录&nbsp;</span></button>
									<!-- <a class="btn btn-info" href="index.php?controller=Home&method=register">&nbsp;注&nbsp;册&nbsp;</a> -->
								</div>
							</div>
						</form>
					</div>
			    </div>
			  </div>
			</div>
		</div>
		<!-- 右边登录块结束 -->
		<div class="clearFloat">
		<!-- 清除浮动 -->
		</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- 验证验证码 引用的是同管理员的，是同一个 -->
<script src="/Content/javascript/js/home/login_ajax.js"></script>