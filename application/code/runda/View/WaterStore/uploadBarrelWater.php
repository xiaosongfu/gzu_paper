<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<link href="/Content/style/waterstore/layout_uploadbarrelwater.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
	<form class="form-horizontal" id="uploadBarrelWaterForm" method="post">
		<!-- 商品类别 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水类别:</label>
		    <div class="col-sm-2">
			    <select name="waterCate" id="waterCateID" class="form-control">
				</select>
		    </div>
	    </div>
	    <!-- 商品品牌 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水品牌:</label>
		    <div class="col-sm-2">
			    <select name="waterBrand" id="waterBrandID" class="form-control">
				</select>
		    </div>
	  	</div>
	  	<!-- 桶装水名称 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水名称:</label>
		    <div class="col-sm-4">
		    	<textarea  name="waterGoodsName" class="form-control" rows="3" id="waterGoodsNameID"></textarea>
		    </div>
	  	</div>
	  	<!-- 桶装水价格 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水价格:</label>
		    <div class="col-sm-2">
		      <input type="text" class="form-control" id="waterGoodsPriceID" name="waterGoodsPrice" placeholder="格式:66.88">
		    </div>
	  	</div>
	  	<!-- 桶装水库存 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水库存:</label>
		    <div class="col-sm-2">
		      <input type="text" class="form-control" id="waterGoodsInventoryID" name="waterGoodsInventory" placeholder="格式:666">
		    </div>
	  	</div>
		<!-- 是否上架 -->
		<div class="form-group">
		    <label class="col-sm-2 control-label">是否上架:</label>
		    <div class="col-sm-10">
		      <div class="radio">
				<label class="radio-inline">
				  <input type="radio" name="isGrounding" value="1" checked>是
				</label>
				<label class="radio-inline">
				  <input type="radio" name="isGrounding" value="0">否
				</label>
		      </div>
		    </div>
		</div>
		<!-- 为了布局好看,而放到了这里 -->
		<div class="form-group">
	    <label class="col-sm-2 control-label">请选择商品图片:</label>
	    <div class="col-sm-4 text-danger">
				<h5> * 桶装水图片建议大小:360px X 300px</h5>
		</div>
  		</div>
	  	<div class="uploadimage">
	  	<!-- 上传桶装水图片 -->
	  		<!-- <form> -->
	  			<!-- 图片 -->
	  			<div class="form-group">
				    <label for="inputFile">最多6张</label><br />
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile1" />
				</div>
				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn1" class="btn btn-default" onclick="return ajaxFileUpload1();">上传图片1</button>
				    </div>
				</div>

				<div class="form-group">
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile2" />
				</div>

				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn2" class="btn btn-default" onclick="return ajaxFileUpload2();">上传图片2</button>
				    </div>
				</div>

				<div class="form-group">
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile3" />
				</div>

				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn3" class="btn btn-default" onclick="return ajaxFileUpload3();">上传图片3</button>
				    </div>
				</div>

				<div class="form-group">
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile4" />
				</div>

				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn4" class="btn btn-default" onclick="return ajaxFileUpload4();">上传图片4</button>
				    </div>
				</div>

				<div class="form-group">
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile5" />
				</div>

				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn5" class="btn btn-default" onclick="return ajaxFileUpload5();">上传图片5</button>
				    </div>
				</div>

				<div class="form-group">
					<input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
				    <input type="file" name="goodsphoto" id="inputFile6" />
				</div>
				<!-- 提交按钮 -->
				<div class="form-group">
				    <div class="col-sm-4">
		      			<button type="submit" id="uploadPhotoBtn6" class="btn btn-default" onclick="return ajaxFileUpload6();">上传图片6</button>
				    </div>
				</div>
			<!-- </form> -->
		<!-- 上传桶装水图片 -->
		</div>
		<!-- 上传桶装水图片 隐藏域-->
		<div class="form-group">
			<input type="hidden" id="photoPath1" name="photoImg1" value="" />
		</div>
		<div class="form-group">
			<input type="hidden" id="photoPath2" name="photoImg2" value="" />
		</div>
		<div class="form-group">
			<input type="hidden" id="photoPath3" name="photoImg3" value="" />
		</div>
		<div class="form-group">
			<input type="hidden" id="photoPath4" name="photoImg4" value="" />
		</div>
		<div class="form-group">
			<input type="hidden" id="photoPath5" name="photoImg5" value="" />
		</div>
		<div class="form-group">
			<input type="hidden" id="photoPath6" name="photoImg6" value="" />
		</div>
		<!-- 上传桶装水图片 -->
		<!-- 桶装水描述 -->
	    <div class="form-group">
		    <label class="col-sm-2 control-label">桶装水描述:</label>
		    <div class="col-sm-4">
		    	<!-- <textarea class="form-control" rows="4" id="waterGoodsDescriptID" name="waterGoodsDescript"></textarea> -->
		    	<!-- <textarea class="form-control" rows="4" id="waterGoodsDescriptID" name="waterGoodsDescript"></textarea> -->
		    	<textarea id="waterGoodsDescriptID" name="waterGoodsDescript" style="width:700px;height:300px;"></textarea>
		    </div>
	  	</div>
		<!-- 上传整个表单 -->
		<div class="form-group">
		    <div class="col-sm-offset-4 col-sm-10">
      			<button type="submit" id="up_stat" class="btn btn-default">点击确定上传桶装水</button>
		    </div>
		</div>
	</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>
<!-- 异步上传桶装水图片 -->
<script type="text/javascript" language="javascript" src="/Content/javascript/ajaxfileupload/ajaxfileupload.js"></script>
<script src="/Content/javascript/js/waterstore/upload_barrelwater_ajaxfileupload.js"></script>
<!-- 异步提交表单 -->
<script src="/Content/javascript/js/waterstore/upload_barrelwater_ajax.js"></script>
<!-- 表单验证 -->
<script src="/Content/javascript/js/waterstore/upload_barrelwater_valide.js"></script>
<!-- 异步拉取桶装水类别和品牌 -->
<script src="/Content/javascript/js/waterstore/get_watercate_and_waterbrand_ajax.js"></script>
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