<!-- 顶部 -->
<?php
	$title = "润达智能水-找回密码 --润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<link href="/Content/style/home/layout_changepassword.css" rel="stylesheet">
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
 <!-- action="index.php?controller=Home&method=changePasswordProc"  -->
		<form class="form-horizontal" id="formCode" role="form" method="post">
			<div class="form-group has-success">
				<label class="col-sm-3  control-label">填写您注册时留的邮箱</label>
				<div class="col-sm-3">
					<input type="text" id="email" name="email" class="form-control" placeholder="请输入邮箱" />
				</div>
			</div>
			<div class="form-group has-success">
				<div class="col-sm-3 col-sm-offset-4">
					<button class="btn" type="submit"><span id="getCode">获取验证码</span></button>
				</div>
			</div>
		</form>
		<div id="res_box">
		</div>
		<div id="next_box">
		 <!-- action="index.php?controller=Home&method=changePassword&step=two"  -->
			<form  class="form-horizontal" id="nextForm" role="form" method="post">
			<div class="form-group has-success">
				<label class="col-sm-3  control-label">填写您邮箱收到的验证码</label>
				<div class="col-sm-3">
					<input type="text" id="changePasswordCode" name="changePasswordCode" class="form-control" placeholder="请输入验证码"  />
				</div>
			</div>
			<div class="form-group has-success">
				<div class="col-sm-3 col-sm-offset-4">
					<button class="btn" type="submit"><span id="nextBut">下一步</span></button>
				</div>
			</div>
			</form>
		</div>
		<div id="next_res_box">
		</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="/Content/javascript/js/home/changepassword.js"></script>