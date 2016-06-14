<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>水站编号</td><td>水站负责人</td><td>水站名称</td><td>水站电话</td><td>水站固定电话</td><td>水站邮箱</td><td>水站详细地址</td><td>水站营业执照</td><td>审核</td></tr>
	       <?php
	       if($result != ""){
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['id'].'</td><td>'.$value['owner'].'</td><td>'.$value['waterStoreName'].'</td><td>'.$value['waterStoreTellPhone'].'</td><td>'.$value['waterStoreFixedLinePhone'].'</td><td>'.$value['waterStoreEmail'].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['businessLicense'].'" target="_blank">查看</a></td><td>
	               <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#audit'.$value['id'].'">现在审核</button>
	               </td></tr>';
	            }
	       }
	       ?>
        </table>
	</div>

<?php
   if($result != ""){
        foreach ($result as $key=>$value){
           echo '<div class="modal fade" id="audit'.$value['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
<form class="form-horizontal" id="waterstoreauditform">
      <div class="modal-body" id="auditbox">

      <div id="doingbox" style="display:none;">
      <img src="/Content/image/common/loading.gif" />
      </div>

      <div id="formbox">

									<div class="form-group">
										<div class="col-sm-3 col-sm-offset-4">
											<select id="audit" name="auditResult" class="form-control" onchange="to_next()">
												<option value="pass" checked>审核通过</option>
												<option value="fail">审核不通过</option>
											</select>
										</div>
									</div>

									<div id="aduitfailbox" class="form-group" style="display:none;">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="text" name="auditDetail" class="form-control" placeholder="审核不通过原因">
										</div>
									</div>

									<div id="longitude" class="form-group">
										<label for="longitudeinput">请录入水站的地理位置(经纬度)</label>
										<div class="col-sm-3 col-sm-offset-4">
											<input id="longitudeinput" type="text" name="waterStoreLongitude" class="form-control" placeholder="水站经度">
										</div>
									</div>
									<div id="latitude" class="form-group">
										<label for="pick"><a href="http://lbs.amap.com/console/show/picker" target="_blank">点击拾取经纬度</a></label>
										<div class="col-sm-3 col-sm-offset-4">
											<input id="pick" type="text" name="waterStoreLatitude" class="form-control" placeholder="水站纬度">
										</div>
									</div>
		</div>
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        <button type="submit" class="btn btn-primary">确定</button>
	      </div>
<input type="hidden" name="id" value="'.$value['id'].'">
</form>
</div>
</div>
</div>';
        }
   }
?>





</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>
<script src="/Content/javascript/js/admin/waterstore/waterstore_audit.js"></script>
<script src="/Content/javascript/js/admin/waterstore/waterstore_audit_ajax.js"></script>