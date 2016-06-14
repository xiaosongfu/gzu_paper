<?php
class ImageProc{
	
	/*
	 *给图片加水印
	 */
	public static function tradeMark($imageName,$str){
		list($width,$height,$type) = getimagesize($imageName);
		$typeArr = array(1 => 'gif',2 => 'jpep',3 => 'png');
		$fun = 'imagecreatefrom'.$typeArr[$type];
		$img = $fun($imageName);
		
		$color = imagecolorallocate($img,255,0,0);
		imagestring($img, 5, 0, $height-10, $str,$color);
		
		$fun2 = 'image'.$typeArr[$type];
		$fun2($img,$imageName);
		
		imagedestroy($img);
	}
	/*
	 *图片缩放
	 */
	public static function scaleImage($imageName,$width=200,$height=180){
		list($widthSrc,$heightSrc,$type) = getimagesize($imageName);
		$typeArr = array(1 => 'gif',2 => 'jpeg',3 => 'png');
		$fun = 'imagecreatefrom'.$typeArr[$type];
		$imgSrc = $fun($imageName);
		$imgDest = imagecreatetruecolor($width,$height);
		imagecopyresampled($imgDest, $imgSrc, 0, 0, 0, 0, $width, $height, $widthSrc, $heightSrc);
		
		$fun = 'image'.$typeArr[$type];
		$fun($imgDest,$imageName);
		
		imagedestroy($imgSrc);
		imagedestroy($imgDest);
	}
	/*
	 *图片等比缩放
	 */
	public static function scaleImageKeepRate($imageName,$width=200,$height=180){
		list($widthSrc,$heightSrc,$type) = getimagesize($imageName);
		$typeArr = array(1 => 'gif',2 => 'jpeg',3 => 'png');
		$fun = 'imagecreatefrom'.$typeArr[$type];
		$imgSrc = $fun($imageName);
		$imgDest = imagecreatetruecolor($width,$height);
		
		$ratio_orig  =  $widthSrc / $heightSrc;
		if ( $width / $height  >  $ratio_orig ) {
			$width  =  $height * $ratio_orig ;
		} else {
			$height  =  $width / $ratio_orig ;
		}
		imagecopyresampled($imgDest, $imgSrc, 0, 0, 0, 0, $width, $height, $widthSrc, $heightSrc);
		$fun = 'image'.$typeArr[$type];
		$fun($imgDest,$imageName);
		imagedestroy($imgSrc);
		imagedestroy($imgDest);
	}
	/*
	 * 裁剪
	 */
	public static function cutImage($imageName,$startX,$startY,$width=20,$height=18){
		list($widthSrc,$heightSrc,$type) = getimagesize($imageName);
		$typeArr = array(1 => 'GIF',2 => 'JPG',3 => 'PNG');
		$fun = 'imagecreatefrom'.$typeArr[$type];
		$imgSrc = $fun($imageName);
		$imgDest = imagecreatetruecolor($width,$height);
	
		$ratio_orig  =  $widthSrc / $heightSrc;
		if ( $width / $height  >  $ratio_orig ) {
			$width  =  $height * $ratio_orig ;
		} else {
			$height  =  $width / $ratio_orig ;
		}
		
		imagecopyresampled($imgDest, $imgSrc, 0, 0, $startX, $startY, $width, $height, $width, $height);
		
		$fun = 'image'.$typeArr[$type];
		$fun($imgDest,$imageName);
		
		imagedestroy($imgSrc);
		imagedestroy($imgDest);
	}
}
