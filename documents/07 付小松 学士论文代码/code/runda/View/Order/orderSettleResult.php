<?php
	$title="结算成功--润达送水 润你生活";
	include DOC_PATH_ROOT.'/View/header.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body" style="text-align: center;font-size:18px;height:300px;padding-top:102px;">
	<?php
		if($way == 'onlinePay'){
			echo "支付成功,我们会在您预定的时间前后半小时内送达,请您悉知";
		}else if($way == 'localPay'){
			echo "您选择的方式是货到付款,请您准备好零钱,我们会在您预定的时间前后半小时内送达,请您悉知";
		}
	?>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer.php';
?>