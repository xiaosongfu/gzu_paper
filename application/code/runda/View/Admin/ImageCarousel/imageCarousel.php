<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	<div>
	   <table class="table table-bordered table-hover">
	       <tr><td>图片描述</td><td>图片路径</td><td>图片链接</td><td>上传时间</td><td>是否展示</td><td>图片权重</td><td>取消展示</td><td>删除轮播</td></tr>
	       <?php
	       if($res != ""){
	       		$isShow = array(0 =>"X",1 =>"Y");
	       		date_default_timezone_set("PRC");
	            foreach ($res as $key=>$value){
	            	if($value['isShow'] == 1){
	            		$closeORopen = '<a href="/index.php?controller=Admin&method=showImageCarousel&action=close&id='.$value['id'].'">取消展示</a>';
	            	}else{
	            		$closeORopen = '<a href="/index.php?controller=Admin&method=showImageCarousel&action=open&id='.$value['id'].'">开启展示</a>';
	            	}
	               echo '<tr><td>'.$value['imageDescript'].'</td><td><a href="index.php?controller=Admin&method=showImage&src='.$value['imagePath'].'" target="_blank">查看</a></td><td>'.$value['imageURL'].'</td><td>'.date("Y-m-d H:i:s",$value['imageUploadTime']).'</td><td>'.$isShow[$value['isShow']].'</td><td>'.$value['imageWeight'].'</td><td>'.$closeORopen.'</td><td><a href="/index.php?controller=Admin&method=delImageCarousel&id='.$value['id'].'">删除轮播</a></td></tr>';
	            }
	       }
	       ?>
	       <tr><td colspan="6"></td><td colspan="2"><a class="btn btn-default" href="/index.php?controller=Admin&method=addImageCarousel" role="button">新增轮播图片</a></td></tr>
        </table>
	</div>
	<div>
	<?php echo $pageBar; ?>
	</div>
	
</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>