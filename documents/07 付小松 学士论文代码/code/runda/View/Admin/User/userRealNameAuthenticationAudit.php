<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>账号ID</td><td>用户名</td><td>昵称</td><td>性别</td><td>真实性名</td><td>头像</td><td>电话号码</td><td>邮箱</td><td>身份证正面</td><td>身份证反面</td><td>身份证号码</td><td>角色</td><td>是否锁定</td><td>详细地址</td><td>现在审核</td></tr>
	       <?php
	       if($result != ""){
	           $isLockArray = array(0=>"未锁定",1=>"已锁定");
	            foreach ($result as $key=>$value){
	               echo '<tr><td>'.$value['id'].'</td><td>'.$value['userName'].'</td><td>'.$value['nickName'].'</td><td>'.$value['sex'].'</td><td>'.$value['realName'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['photo'].'" target="_blank">查看头像</a></td><td>'.$value['phoneNumber'].'</td><td>'.$value['email'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['idCardGraphFront'].'" target="_blank">查看</a></td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['idCardGraphBack'].'" target="_blank">查看</a></td><td>'.$value['idCardNumber'].'</td><td>'.$roleArray[$value['role']].'</td><td>'.$isLockArray[$value['isLock']].'</td><td>'.$value['province'].$value['city'].$value['country'].$value['detailAddress'].'</td><td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#audit'.$value['id'].'">现在审核</button></td></tr>';
	            }
	       }
	       
	       ?>
        </table>
	</div>
	<div>
	<?php echo $pageBar; ?>
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
<form class="form-horizontal" id="realNameAuthen">
      <div class="modal-body" id="auditbox">

      <div id="doingbox" style="display:none;">
      <img src="/Content/image/common/loading.gif" />
      </div>

      <div id="formbox">

      		<div class="radio">
			  <label>
			    <input type="radio" name="isRealNameAuthen" value="pass" checked>
			  通过
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="isRealNameAuthen" value="fail">
			   不通过
			  </label>
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
<!-- <script src="/Content/javascript/js/admin/user/user_realname_authen.js"></script> -->
<script src="/Content/javascript/js/admin/user/user_realname_authen_ajax.js"></script>