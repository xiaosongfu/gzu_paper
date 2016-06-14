<?php
	include DOC_PATH_ROOT.'/View/header_inner.php';
?>
<!-- 顶部结束 -->
<!-- 主体 -->
<div class="body">
    <div>
	       <?php
// 	       // if($waterbearers != null){
// 	       //      foreach ($waterbearers as $key=>$value){
// 	       //         echo '<tr><td>'.$value['userId'].'</td><td>'.$value['maxLoadCapacity'].'</td><td>'.$waterBearerStatueArray[$value['statue']].'</td><td><a href="">查看</a></td><td><a href="">修改信息</a></td></tr>';
// 	       //      }
// 	       // }
// 	       echo "<pre>";
// 	       print_r($orderResult);
// 	       ?>
<!--         </table> -->
<table class="table table-bordered">
       <!-- <td>单价</td><td>数量</td> -->
         <tr><td>订单号</td><td>总金额</td><td>支付方式</td><td>预定送水时间</td><td>订单状态</td><td>提交时间</td><td>备注</td><td>操作</td></tr>
         <?php
         if($orderResult != null){
            $countT = count($orderResult);
            for($t = 0;$t < $countT; $t++){
               echo '<tr>
               <td>'.$orderResult[$t]['id'].'</td>';
                //<td><div class="img_box">';
//                foreach ($orderContainGoodsResult[$t] as $key => $value) {
                    // echo "<pre>";
                    // print_r($orderContainGoodsResult[$t]);//-->结果如下：
                    // print_r($value);//-->结果如下：
                    // Array
                    //     (
                    //         [0] => Array
                    //             (
                    //                 [0] => Array
                    //                     (
                    //                         [waterGoodsID] => 4
                    //                         [waterGoodsCount] => 1
                    //                     )
                    //             )
                    //         [1] => Array
                    //             (
                    //                 [0] => Array
                    //                     (
                    //                         [waterGoodsID] => 5
                    //                         [waterGoodsCount] => 1
                    //                     )
                    //             )
                    //     )

                    // foreach ($orderContainGoodsResult as $key => $value){
//                   $barrelWGs = $barrelWaterGoods ->getBarrelWaterGoodsDefaultImage($value['waterGoodsID']);                   
//                   $imageSrc = "/".substr($barrelWGs['waterGoodsDefaultImage'],strrpos($barrelWGs['waterGoodsDefaultImage'],"Content"));
//                   echo '<div class="a_img_box"><a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$value['waterGoodsID'].'" target="_blank"><img src="'.$imageSrc.'" /></a></div>';


                        // print_r($barrelWGs);
                    // }
//                 }
//                echo '</div></td>
               echo '
               <td>'.$orderResult[$t]['totalPrice'].'</td>
               <td>'.$orderResult[$t]['settleMethod'].'</td>
               <td>'.$orderResult[$t]['recieverTime'].'</td>
               <td>'.$orderStatueArr[$orderResult[$t]['orderStatue']].'</td>
               <td>'.date("Y-m-d H:i:s",$orderResult[$t]['orderSubmitTime']).'</td>
               <td>'.$orderResult[$t]['remark'].'</td>
               <td>
               <a href="index.php?controller=Order&method=viewOrder&orderid='.$orderResult[$t]['id'].'" target="_blank">查看</a>
               </td>
               </tr>';
          }
         }
         ?>
        </table>
	</div>
	<div>
	<?php
	    //分页导航栏 
	    echo $pageBar;
    ?>
	</div>
</div>
<!-- 主体结束 -->
<!-- 底部 -->
<?php
	include DOC_PATH_ROOT.'/View/footer_inner.php';
?>