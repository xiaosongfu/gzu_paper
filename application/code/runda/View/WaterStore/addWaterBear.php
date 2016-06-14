<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_add_waterstorebear.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
<div class="title_box"><h3>添加送水工(要求送水工已经注册)</h3></div>
    <div class="input_box">
        <form class="form-horizontal" id="addBarrelWaterForm" method="post">
    		<!-- 送水工账号ID -->
    	    <div class="form-group">
    		    <label class="col-sm-2 control-label">送水工账号ID:</label>
    		    <div class="col-sm-2">
    		        <input type="text" class="form-control" id="userId" name="userId" placeholder="送水工账号ID">
    		    </div>
    	    </div>
    	    <!-- 最大载水量 -->
    	    <div class="form-group">
    		    <label class="col-sm-2 control-label">最大载水量:</label>
    		    <div class="col-sm-2">
    			    <input type="text" class="form-control" id="maxLoadCapacityID" name="maxLoadCapacity" placeholder="最大载水量">
    		    </div>
    	  	</div>
    	  	<!-- 上传整个表单 -->
    		<div class="form-group">
    		    <div class="col-sm-offset-3 col-sm-10">
          			<button type="submit" id="add_btn" class="btn btn-default">添&nbsp;&nbsp;加&nbsp;</button>
    		    </div>
    		</div>
    	</form>
    </div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<script src="/Content/javascript/js/waterstore/add_waterbear_ajax.js"></script>