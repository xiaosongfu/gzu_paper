<?php
require_once(DOC_PATH_ROOT."/Lib/DataBase/database.func.php");
require_once(DOC_PATH_ROOT."/Lib/JSON/json.func.php");

class ImageCarousel{
	private $id;
	private $imagePath;
	private $imageURL;
	private $imageDescript;
	private $imageUploadTime;
	private $isShow;
	private $imageWeight;
	
	//构造方法 不带ID
	public function __construct($imagePath,$imageURL,$imageDescript,$imageUploadTime,$isShow,$imageWeight){
	    $this ->imagePath = $imagePath;
	    $this ->imageURL = $imageURL;
	    $this ->imageDescript = $imageDescript;
	    $this ->imageUploadTime = $imageUploadTime;
	    $this ->isShow = $isShow;
	    $this ->imageWeight = $imageWeight;
	}
	//构造方法  带ID

	/*
     *添加轮播图片
	 */
	public function addImageCarousel($imageCarousel){
	    $sql = "insert into imageCarousel(imagePath,imageURL,imageDescript,imageUploadTime,isShow,imageWeight) values(?,?,?,?,?,?)";
	    try{
	    	DBActive::executeNoQuery("set character_set_results=utf8");
	       $rowCount = DBActive::executeNoQuery($sql,array($imageCarousel->imagePath,$imageCarousel->imageURL,$imageCarousel->imageDescript,$imageCarousel->imageUploadTime,$imageCarousel->isShow,$imageCarousel->imageWeight));
	    }catch (Exception $e){
	       return false;
	    }
	    if($rowCount >0){
	       return true;
	    }else{
	       return false;
	    }
    }
    /*
     *获取轮播图片 按添加时间降序  ->用于后台管理
	 */
    public function getImageCarousel($currentPage,$singlePageRecordCount){
    	//  设 $singlePageRecordCount = 10
    	//		1页：0--9
    	//		2页：10--19
    	//		3页：20--$singlePageRecordCount*3   ====>21-30
    	//		n页：(n-1)*10  -- 10
    	$begin = ($currentPage - 1) * $singlePageRecordCount;
    	$sql = "select * from imageCarousel order by imageUploadTime desc limit ".$begin.",".$singlePageRecordCount.";";
    	try{
	       $res = DBActive::executeQuery($sql);
	    }catch (Exception $e){
	        return "";
	    }
	    if($res != null || $res != ""){
	        return $res;
	    }else{
	        return "";
	    }
    }
    /*
     *获取在展示的轮播图片 按权重降序   ->用于前台展示
	 */
    public function getShowImageCarousel(){
    	$sql = "select * from imageCarousel where isShow=1 order by imageWeight desc;";
    	try{
	       $res = DBActive::executeQuery($sql);
	    }catch (Exception $e){
	        return "";
	    }
	    if($res != null || $res != ""){
	        return $res;
	    }else{
	        return "";
	    }
    }
    /*
     *取消展示
	 */
    public function closeShowImageCarousel($id){
    	$sql = "update imageCarousel set isShow=0 where id=?;";
    	try{
	       $rowCount = DBActive::executeNoQuery($sql,array($id));
	    }catch (Exception $e){
	        return false;
	    }
	    if($rowCount > 0){
	        return true;
	    }else{
	        return false;
	    }
    }
    /*
     *开启展示
	 */
    public function openShowImageCarousel($id){
    	$sql = "update imageCarousel set isShow=1 where id=?;";
    	try{
	       $rowCount = DBActive::executeNoQuery($sql,array($id));
	    }catch (Exception $e){
	        return false;
	    }
	    if($rowCount > 0){
	        return true;
	    }else{
	        return false;
	    }
    }
    /*
     *删除轮播
	 */    
    public function delImageCarousel($id){
    	$sql = "delete from imageCarousel where id=?;";
    	try{
	       $rowCount = DBActive::executeNoQuery($sql,array($id));
	    }catch (Exception $e){
	        return false;
	    }
	    if($rowCount > 0){
	        return true;
	    }else{
	        return false;
	    }
    }
}