<!-- 顶部 -->
<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <form class="form-horizontal" role="form" id="addUserRecieverAddress" method="post">
		<div class="form-group has-default">
			<label class="col-sm-2  control-label">省&nbsp;&nbsp;&nbsp;&nbsp;份</label>
			<div class="col-sm-3">
			<select id="privince" name="province" class="form-control" onchange="getCities()">
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-default">
			<label class="col-sm-2  control-label">城&nbsp;&nbsp;&nbsp;&nbsp;市</label>
			<div class="col-sm-3">
			<select id="city" name="city" class="form-control" onchange="getCountries()">
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-default">
			<label class="col-sm-2  control-label">县/区</label>
			<div class="col-sm-3">
			<select id="country" name="country" class="form-control">
			</select>
			</div>
			<div class="col-sm-3 text-danger">
				<h2>*</h2>
			</div>
		</div>
		<div class="form-group has-default">
			<label class="col-sm-2  control-label">详细地址</label>
			<div class="col-sm-3">
				<input type="text" id="detailAddress" name="detailAddress" class="form-control"
					placeholder="详细地址"/>
			</div>
		</div>
		<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button class="btn btn-default" type="submit"><span id="add_stat">确认添加</span></button>
				</div>
		</div>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<script src="/Content/javascript/js/home/register_provinces_cities_counties.js"></script>
<script src="/Content/javascript/js/home/add_userrecieveraddress_ajax.js"></script>