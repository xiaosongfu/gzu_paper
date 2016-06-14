<?php 
    include DOC_PATH_ROOT.'/View/Admin/header_inner.php';
?>
<!-- 主体 -->
<div class="body">
	   <div class="form_box">
        <?php
            if($step == "one"){
                echo '<div><img src="/Content/image/carousel/step/imageCarouselStepOne.png" /></div>';
                echo '<div>第一步：先选择要上传的图片  * 建议图片大小:1320px X 420px<form id="imageForm" name="imageForm" action="/index.php?controller=Admin&method=addImageCarousel" method="post" enctype="multipart/form-data">
                               <input type="hidden" name="MAX-FILE-SIZE" value="22097152" />
                        轮播图片： <input type="file" name="image" />
                               <a class="btn btn-default" href="/index.php?controller=Admin&method=imageCarousel">返回</a>
                               <input type="submit" class="btn btn-default" name="addImage" value="上传图片" />
                        </form><div>'.$errorinfo.'</div></div>';
            }elseif($step == "two"){
                echo '<div><img src="/Content/image/carousel/step/imageCarouselStepTwo.png" /></div>';
                echo '<div><form  class="form-horizontal" role="form" id="loginForm" action="/index.php?controller=Admin&method=addImageCarousel" method="post">
                   图片描述：<input type="text" name="imageDescript" class="form-control" /><br />
                   图片URL：<input type="text" name="imageURL"  class="form-control" />*形如：/index.php?controller=Admin&method=imageCarousel&...<br />
                   图片权重：
                              <select name="imageWeight">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                              </select><br />
                   是否展示：<input type="checkbox" name="isShow" /><br />
                    <input type="hidden" name="imagePath" value="'.$imagePath.'" /><br />
                    <a class="btn btn-default" href="/index.php?controller=Admin&method=imageCarousel">返回</a>
                    <input class="btn btn-default" type="submit" name="addImageC" value="确认添加" />
                    </form></div>';
            }elseif($step == "three"){
                echo '<div><img src="/Content/image/carousel/step/imageCarouselStepThree.png" /></div>';
                echo '<div><a class="btn btn-default" href="/index.php?controller=Admin&method=imageCarousel">不再添加</a>
                    <a class="btn btn-default" href="/index.php?controller=Admin&method=addImageCarousel">还要添加</a></div>';
            }
        ?>
	   </div>
</div>
<!-- 主体结束 -->
<?php 
    include DOC_PATH_ROOT.'/View/Admin/footer_inner.php';
?>