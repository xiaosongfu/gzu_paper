<?php
  include DOC_PATH_ROOT.'/View/header_inner.php';
    require(DOC_PATH_ROOT."/Model/EntityModel/barrelwatergoods.class.php");
    $barrelWaterGoods = new BarrelWaterGoods(); 
?>
<!-- 顶部结束 -->
<!-- 样式 -->
<link href="/Content/style/order/layout_get_nonpaymentorder.css" rel="stylesheet">
<!-- 主体 -->
<div class="body">
    <div>     <table class="table table-bordered  table-hover">
       <!-- <td>单价</td><td>数量</td> -->
         <tr><td>订单号</td><td>所属者</td><td>送水工</td><td>所属水站</td><td>商品</td><td>总金额</td><td>支付方式</td><td>预定送水时间</td><td>订单分类</td><td>订单状态</td><td>提交时间</td><td>订单完成时间</td><td>备注</td><td>操作</td></tr>
         <?php
         if($orderResult != null){
            // echo "<pre>";
            // print_r($orderResult);
            // echo "<hr /><hr /><hr />";
            // echo "<pre>";
            // print_r($orderContainGoodsResult);
                $countT = count($orderResult);
              for($t = 0;$t < $countT; $t++){
                 echo '<tr>
                   <td>'.$orderResult[$t]['id'].'</td>
                   <td>'.$orderResult[$t]['orderOwnerID'].'</td>
                   <td>'.$orderResult[$t]['waterBearerID'].'</td>
                   <td>'.$orderResult[$t]['waterStoreID'].'</td>
                   <td><div class="img_box">';
                    
                    foreach ($orderContainGoodsResult as $key => $value) {
                        // echo "<pre>";
                        // print_r($orderContainGoodsResult);-->结果如下：
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
                            $barrelWGs = $barrelWaterGoods ->getBarrelWaterGoodsDefaultImage($value[0]['waterGoodsID']);                   
                            $imageSrc = "/".substr($barrelWGs['waterGoodsDefaultImage'],strrpos($barrelWGs['waterGoodsDefaultImage'],"Content"));
                            echo '<div class="a_img_box"><a href="index.php?controller=RunDa&method=barrelWaterGoodsDetail&barrelWaterGoodsID='.$value[0]['waterGoodsID'].'" target="_blank"><img src="'.$imageSrc.'" /></a></div>';


                            // print_r($barrelWGs);
                        // }
                    }

                   echo '</div></td>
                   <td>'.$orderResult[$t]['totalPrice'].'</td>
                   <td>'.$orderResult[$t]['settleMethod'].'</td>
                   <td>'.date("Y-m-d H:i:s",$orderResult[$t]['recieverTime']).'</td>
                   <td>'.$orderCategoryArr[$orderResult[$t]['orderCategory']].'</td>
                   <td>'.$orderStatueArr[$orderResult[$t]['orderStatue']].'</td>
                   <td>'.date("Y-m-d H:i:s",$orderResult[$t]['orderSubmitTime']).'</td>
                   <td>'.date("Y-m-d H:i:s",$orderResult[$t]['orderDoneTime']).'</td>
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