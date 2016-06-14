<!-- 顶部 -->
<?php
	$title = "润达智能水-找回密码 --润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<link href="/Content/style/home/layout_changepassword.css" rel="stylesheet">
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
	<form class="form-horizontal" role="form" id="fourForm" method="post">
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">新&nbsp;&nbsp;密&nbsp;&nbsp;码</label>
			<div class="col-sm-3">
				<input type="password" id="password" name="passWord" class="form-control" placeholder="密码" onblur="checkPassWord()" />
			</div>
			<div id="pwdErr" class="col-sm-3 text-danger">
				<h2>*</h2>(字母或数字或_组成,长度至少12位)
			</div>
		</div>
		<div class="form-group has-success">
			<label class="col-sm-2  control-label">确认密码</label>
			<div class="col-sm-3">
				<input type="password" id="password2" name="password2" class="form-control" placeholder="确认密码" onblur="checkPassWord2()" />
			</div>
			<div id="pwdErr2" class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn" type="submit"><span id="fourBtn">确认修改</span></button>
			</div>
		</div>
	</form>
	<div id="four_res_box">
	</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- 表单验证 使用的是注册的那个 有部分验证函数用不到 -->
<script src="/Content/javascript/js/home/resgiter_valide.js"></script>
<script src="/Content/javascript/js/home/changepassword.js"></script>