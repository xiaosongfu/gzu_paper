<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_waterstore_status.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
	<div class="show_box">
		<?php
		echo '<button type="button" class="btn btn-danger btn-lg">'.$waterStoreStatusArr[$waterStoreStatus['waterStoreStatus']].'...</button>';
		// echo $waterStoreStatusArr[$waterStoreStatus['waterStoreStatus']];
		// echo "<pre>";
		// print_r($waterStoreStatusArr);
		// print_r($waterStoreStatus);
		?>
		<!-- <button type="button" id="changebtn" class="btn btn-danger btn-sm">更改营业状态</button> -->
	</div>
	<br />
	<div class="change_box">
	<form class="form-horizontal" id="changeForm" role="form" method="post">
		<div class="form-group has-danger">
			<div class="col-sm-5">
				<select name="waterss" class="form-control">
					<?php
						foreach ($waterStoreStatusRawArr as $key => $value) {
							echo '<option value="'.$value['id'].'">'.$value['waterStoreStat'].'</option>';
						}
					?>
				<select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-success" type="submit"><span id="change_stat">&nbsp;&nbsp;更&nbsp;&nbsp;改&nbsp;&nbsp;</span></button>
			</div>
		</div>
	</form>
	<div id="result">
	</div>
	</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<script src="/Content/javascript/js/waterstore/change_waterstore_status_ajax.js"></script>