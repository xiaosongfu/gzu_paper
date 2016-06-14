<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- <link href="/Content/style/waterstore/layout_uploadbarrelwater.css" rel="stylesheet"> -->
<!-- 主体 -->
<div class="body">
	<form class="form-horizontal" id="uploadBarrelWaterForm" method="post">
		<!-- 桶装水描述 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水描述:</label>
		    <div class="col-sm-4">
		    	<textarea id="waterGoodsDescriptID" name="waterGoodsDescript" style="width:700px;height:300px;">
		    		<?php
		    		echo $result;
		    		?>
		    	</textarea>
		    </div>
	  	</div>
		<!-- 上传整个表单 -->
		<div class="form-group">
		    <div class="col-sm-offset-4 col-sm-10">
      			<button type="submit" id="up_stat" class="btn btn-default">顺丰速递</button>
		    </div>
		</div>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<!-- 异步提交表单 -->
<!-- <script src="/Content/javascript/js/waterstore/upload_barrelwater_ajax.js"></script> -->
<!-- 编辑框 -->
<script charset="utf-8" src="/Content/javascript/kindeditor4/kindeditor.js"></script>
<script charset="utf-8" src="/Content/javascript/kindeditor4/lang/zh_CN.js"></script>
<script type="text/javascript">
    // KindEditor.ready(function(K) {
    //         window.editor = K.create('#waterGoodsDescriptID');
    // });
    KindEditor.ready(function(K) {
            window.editor = K.create('#waterGoodsDescriptID', {
                afterBlur: function () { this.sync(); }
            });
    });
</script>