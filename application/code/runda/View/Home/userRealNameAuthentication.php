<!-- 顶部 -->
<?php
	$title = "用户实名认证--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/home/layout_user_realname_authen.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<?php
	if($pos == "zero"){
?>
	<div class="zero">
	 <!-- action="index.php?controller=Home&method=userRealNameAuthenticationProc" -->
		<form class="form-horizontal" role="form" id="userRealNameAuthen" method="post">
			<div class="form-group">
				<label class="col-sm-5 control-label">真实性名</label>
				<div class="col-sm-2">
					<input type="text" id="realNameID" name="realName" class="form-control" placeholder="真实性名" onblur="checkRealName()" />
				</div>
				<div id="rn" class="col-sm-1 text-danger">
					<h2>*</h2>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">身份证号码</label>
				<div class="col-sm-2">
					<input type="text" id="idCardNumberID" name="idCardNumber" class="form-control" placeholder="身份证号码" onblur="checkidCardNumber()" />
				</div>
				<div id="idc" class="col-sm-1 text-danger">
					<h2>*</h2>
				</div>
			</div>

			<!-- 身份证 图片路径 -->
			<div class="form-group">
				<label class="col-sm-5  control-label"></label>
				<div class="col-sm-2">
					<!-- 身份证正面 图片路径 -->
					<input type="hidden" id="idCardGraphFrontID" name="idCardGraphFront" class="form-control"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5  control-label"></label>
				<div class="col-sm-2">
					<!-- 身份证反面 图片路径 -->
					<input type="hidden" id="idCardGraphBackID" name="idCardGraphBack" class="form-control"/>
				</div>
			</div>

			<div id="upload_box1">
			<div class="form-group">
				<label class="col-sm-5  control-label">身份证正面</label>
				<div class="col-sm-2">
		        	<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
		        	<input type="file" id="idCardGraphFrontImgID" name="idCardGraphImg" />
				</div>
				<div id="checkErr" class="col-sm-3 text-danger">
			          <h4> * 图片建议大小 : 440px X 250px</h4>
		        </div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-5">
					<a class="btn btn-default" type="button" onclick="return ajaxFileUpload1();"><span id="upBtn1">上传</span></a>
				</div>
			</div>
			</div>

			<!-- 用来显示上传的图片1 -->
			<div class="image_box">
				<h3>身份证正面</h3><br />
				<!-- <img src="" id="idFront" width="440px" height="250" /> -->
				<img src="" id="idFront" />
			</div>


			<div id="upload_box2">
			<div class="form-group">
				<label class="col-sm-5  control-label">身份证反面</label>
				<div class="col-sm-2">
		        	<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
		        	<input type="file" id="idCardGraphBackImgID" name="idCardGraphImg" />
				</div>
				<div id="checkErr" class="col-sm-3 text-danger">
			          <h4> * 图片建议大小 : 440px X 250px</h4>
		        </div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-5">
					<a class="btn btn-default" type="button" onclick="return ajaxFileUpload2();"><span id="upBtn2">上传</span></a>
				</div>
			</div>
			</div>

			<!-- 用来显示上传的图片2 -->
			<div class="image_box">
				<h3>身份证反面</h3><br />
				<!-- <img src="" id="idBack" width="440px" height="250" /> -->
				<img src="" id="idBack" />
			</div>
			<br />
			<br />



			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-5">
					<button class="btn btn-default" id="okBtn" type="submit">确定申请</button>
				</div>
			</div>
		</form>
	</div>
<?php
	}elseif($pos == "one"){
?>
	<div class="one">
	您已经认证完成
	</div>
<?php
	}elseif($pos == "two"){
?>
	<div class="two">
		实名认证失败，原因可能是：
		<br />
		1.身份证号码不存在或错误<br />
		2身份证照片不清晰<br />
		请您<a href="index.php?controller=Home&method=userRealNameAuthentication&pos=zero" target="_blank">重新申请认证!</a>
	</div>
<?php
	}elseif($pos == "three"){
?>
	<div class="three">
	您的实名认证申请已经提交,请您耐心等待。
	</div>
<?php
	}
?>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- 异步上传图片 -->
<script type="text/javascript" language="javascript" src="/Content/javascript/ajaxfileupload/ajaxfileupload.js"></script>
<script src="/Content/javascript/js/home/user_realname_authen_ajaxfileupload.js"></script>
<!-- 异步提交表单 -->
<script src="/Content/javascript/js/home/user_realname_authen_ajax.js"></script>
