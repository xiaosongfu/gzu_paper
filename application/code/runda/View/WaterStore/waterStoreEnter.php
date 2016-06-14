<!-- 顶部 -->
<?php
	$title = "水站入驻--润达智能送水 润达送水-润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_waterstore_enter.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">

<?php
//----------------
if($step == 'first'){?>
<!-- ----------------- -->
<!-- step == first 用户登录 -->

		<div class="no_login">
			<h3><a href="index.php?controller=Home&method=login">你还没有登录,现在登录?</a></h3>
		</div>

<!-- ----------------- -->
<?php }elseif ($step == 'second') {?>
<!-- ----------------- -->
<!-- step == second 填写信息 -->

		<!-- step == one 填写水站基本信息 -->
		<div class="step_box">
			<h4>第一步:填写水站信息</h4>
			<br />
			<br />
		</div>
		<div class="input_box">
			<!-- index.php?controller=WaterStore&method=waterStoreEnterProc   waterStoreEnterForm-->
			<!-- <form class="form-horizontal" role="form" id="waterStoreEnterForm" method="post"> -->
			<form class="form-horizontal" role="form" id="waterStoreEnterForm" method="post">
				<div class="form-group">
					<label class="col-sm-5 control-label">水站负责人</label>
					<div class="col-sm-2">
						<input type="text" id="userName" name="userName" class="form-control" placeholder="<?php echo $_SESSION['userName'] ?>" readonly />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5 control-label">水站名称</label>
					<div class="col-sm-2">
						<input type="text" id="waterStoreName" name="waterStoreName" class="form-control" placeholder="水站名称" onblur="checkWaterStoreName()" />
					</div>
					<div id="wsn" class="col-sm-1 text-danger">
						<h2>*</h2>(50字内)
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5 control-label">水站电话</label>
					<div class="col-sm-2">
						<input type="text" id="waterStoreTellPhone" name="waterStoreTellPhone" class="form-control" placeholder="水站电话" onblur="checkWaterStoreTellPhone()" />
					</div>
					<div id="tel" class="col-sm-1 text-danger">
						<h2>*</h2>(11位)
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5 control-label">水站座机</label>
					<div class="col-sm-2">
						<input type="text" id="waterStoreFixedLinePhone" name="waterStoreFixedLinePhone" class="form-control" placeholder="水站座机" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5 control-label">水站邮箱</label>
					<div class="col-sm-2">
						<input type="text" id="waterStoreEmail" name="waterStoreEmail" class="form-control" placeholder="水站邮箱" />
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5  control-label">省&nbsp;&nbsp;&nbsp;&nbsp;份</label>
					<div class="col-sm-2">
						<select id="privince" name="province" class="form-control" onchange="getCities()">
						</select>
					</div>
					<div class="col-sm-1 text-danger">
						<h2>*</h2>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5  control-label">城&nbsp;&nbsp;&nbsp;&nbsp;市</label>
					<div class="col-sm-2">
						<select id="city" name="city" class="form-control" onchange="getCountries()">
						</select>
					</div>
					<div class="col-sm-1 text-danger">
						<h2>*</h2>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5  control-label">县/区</label>
					<div class="col-sm-2">
						<select id="country" name="country" class="form-control">
						</select>
					</div>
					<div class="col-sm-1 text-danger">
						<h2>*</h2>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5  control-label">详细地址</label>
					<div class="col-sm-2">
						<input type="text" id="detailAddress" name="detailAddress" class="form-control"
							placeholder="详细地址" onblur="checkAddr()" />
					</div>
					<div id="addErr" class="col-sm-1 text-danger">
						<h2>*</h2>
					</div>
				</div>

				<!-- 营业执照 图片路径 -->
				<div class="form-group">
					<label class="col-sm-5  control-label"></label>
					<div class="col-sm-2">
						<!-- 营业执照 图片路径 -->
						<input type="hidden" id="businessLicenseImg" name="businessLicensePath" class="form-control"/>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-5 control-label">验证码</label>
					<div class="col-sm-2">
						<input type="text" id="checkCode" name="checkCode" class="form-control" placeholder="验证码" onblur="checkCheckcode()" />
					</div>
					<div id="checkErr" class="col-sm-1 text-danger">
						<h2>*</h2>
					</div>
				</div>

				<div class="form-group">
				     <label class="col-sm-5  control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					 <div class="col-sm-2">
					 <img id="validcode" src="index.php?controller=Home&method=getCode" />&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="javascript:document.getElementById('validcode').src='index.php?controller=Home&method=getCode&'+Math.random()">换1张</a>
					 </div>
				</div>

				<!-- step == two 上传营业执照-->
				<div>
					<br />
					<h4>第二步:上传营业执照</h4>
					<br />
					<br />
				</div>
				<div id="upload_box">
					<!-- <form class="form-horizontal" role="form" id="upLoadLicenseForm" method="post"> -->
						<div class="form-group">
							<label class="col-sm-5  control-label">营业执照</label>
							<div class="col-sm-2">
					        	<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
					        	<input type="file" id="businessLicense" name="License" />
							</div>
							<div id="checkErr" class="col-sm-3 text-danger">
						          <h4> * 图片建议大小 : 1100px X 560px</h4>
					        </div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-5">
								<a class="btn btn-default" type="button" name="upLoadLicense" onclick="return ajaxFileUpload();"><span id="upBtn">上传执照图片</span></a>
							</div>
						</div>
					<!-- </form> -->
				</div>
				<!-- 用来显示上传的图片 -->
				<div>
					<img src="" id="licenseImg" />
				</div>
				<br />
				<br />

				<div class="form-group">
					<div class="checkbox">
					    <label  class="col-sm-2 col-sm-offset-5  control-label">
					      <input type="checkbox" id="agreeProtocol" name="agreeProtocol">同意<a href="/index.php?controller=WaterStore&method=rundaWaterStoreEnterProtoclol" target="_blank">《润达智能送水水站入驻协议》</a>
					    </label>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-4">
						<button class="btn btn-default" id="enterBtn" type="submit">确定入驻</button>
					</div>
				</div>

			</form>
		</div>

<!-- ----------------- -->
<?php }else{?>
<!-- ----------------- -->
<!-- step == thrid 完成 -->

		<!-- step == three 完成,等待审核 -->
		<div class="step_box">
			<h4>第三步:完成申请,等待审核</h4>
		</div>
		<div class="wait_box">
			申请时间:<?php echo date("Y-m-d H:m:s"); ?><br .>
			申请用户:<?php echo $_SESSION['userName']; ?><br .>
			审核时间:3个工作日内<br .>
			审核通过后我们会发邮件给您,请您注意查收。<br />
			<br /><br />
			<img src="/Content/image/common/ok.jpg" />
		</div>

<!-- ----------------- -->
<?php }?>
<!-- ----------------- -->

<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<!-- 省市联动 -->
<script src="/Content/javascript/js/home/register_provinces_cities_counties.js"></script>
<!-- 表单验证 -->
<script src="/Content/javascript/js/waterstore/waterstore_enter_valide.js"></script>
<!-- 异步上传图片 -->
<script type="text/javascript" language="javascript" src="/Content/javascript/ajaxfileupload/ajaxfileupload.js"></script>
<script src="/Content/javascript/js/waterstore/waterstore_enter_ajaxfileupload.js"></script>
<!-- 异步提交表单 -->
<script src="/Content/javascript/js/waterstore/waterstore_enter_ajax.js"></script>
