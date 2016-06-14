<?php
$title="订单评价--润达送水 润你生活";
include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<link rel="stylesheet" href="/Content/javascript/jquery/jqueryui/css/smoothness/jqueryui.min.css">
<!-- 主体 -->
<div class="body" style="padding-left: 30px">
<div style="font-size:22px;padding-left:120px;"><?php echo $res?></div>
<form class="form-horizontal" role="form" method="post"><hr /><br />
<input type="hidden" name="orderid" value="<?php echo $_GET['orderid'];?>"/>
		请输入评论内容：<br /><textarea name="CommentContent" class="form-control" rows="3" col="3"></textarea><hr /><br />
		<button type="submit" class="btn btn-danger btn-mid">评论</button>
</form>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>
<script src="/Content/javascript/jquery/jqueryui/js/jqueryui.min.js"></script>