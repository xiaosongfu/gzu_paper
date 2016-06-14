<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
class Pages{
	//获取总的纪录数
	//$sql 获取总纪录数的sql语句 形如：select count(*) count from imageCarousel; ！！
	public static function getTotalRecordCount($sql){
		try{
			$count = DBActive::executeQuery($sql);
			return $count[0]['count'];
		}catch(PDOException $e){
			return 0;
		}
	}
	//分页导航栏 返回不带div的字符串
	//$currentPage 当前页
	//$pageCount 总的页数
	//$url url 形如：/index.php?controller=Admin&method=imageCarousel  ！！注意格式
	public static function createPagesBar($currentPage,$pageCount,$url){
		$one = '<nav><ul class="pagination">';
		//<<
		if($currentPage == 1){
			$two = '<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		}else{
			$two = '<li><a href="'.$url."&currentPage=".($currentPage - 1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		}
		//1--n
		$three = "";
		for($i = 1;$i <= $pageCount;$i++){
			if($i == $currentPage){
		    	$three = $three.'<li class="active"><a href="#">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}else{
		    	$three = $three.'<li><a href="'.$url."&currentPage=".$i.'">'.$i.'</a></li>';
			}
		}
		//>>
		if($currentPage == $pageCount){
			$four = '<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
		}else{
			$four = '<li><a href="'.$url."&currentPage=".($currentPage + 1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
		}
		//
		$five = '</ul></nav>';
		return $one.$two.$three.$four.$five;
	}



		// //当前页
		// $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
		// //每一页的纪录条数
		// $singlePageRecordCount = 2.0;
	 //    //总的纪录数
	 //    $sql = "select count(*) count from imageCarousel;";
	 //    $totalRecordCount = Pages::getTotalRecordCount($sql);
		// //总的页数
		// $pageCount = ceil($totalRecordCount / $singlePageRecordCount);

	 //    $imageCarousel = new ImageCarousel('','','','','','');
	 //    $res = $imageCarousel ->getImageCarousel($currentPage,$singlePageRecordCount);
	 //    //分页导航栏 不带div的字符串
	 //    $pageBar = Pages::createPagesBar($currentPage,$pageCount,"/index.php?controller=Admin&method=imageCarousel");



//-----------------------------------------------
	// public function getImageCarousel($currentPage,$singlePageRecordCount){
 //    	//  设 $singlePageRecordCount = 10
 //    	//1页：0--9
 //    	//2页：10--19
 //    	//3页：20--$singlePageRecordCount*3   ====>21-30
 //    	//n页：(n-1)*10  -- 10
 //    	$begin = ($currentPage - 1) * $singlePageRecordCount;
 //    	// $end = $singlePageRecordCount;
 //    	$sql = "select * from imageCarousel order by imageUploadTime desc limit ".$begin.",".$singlePageRecordCount.";";
 //    	try{
	//        $res = DBActive::executeQuery($sql);
	//     }catch (Exception $e){


}