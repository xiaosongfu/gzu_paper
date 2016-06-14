<?php
class ValidCode{
	static $code = "";
	public static function getCode($num = 4){
		//先将旧的验证码置空
		self::$code = "";
		
		//再生成新的验证码
        $str = "1425367980";
		for($i = 0; $i <$num; $i++){
			self::$code .= $str{rand(0,9)};
		}
		//返回验证码
		return self::$code;
	}
	public static function getImage($validCode, $width=90, $height=30){
		//创建资源
		$img = imagecreatetruecolor($width,$height);
		//背景色
		$bgcolor = imagecolorallocate($img,rand(225,255),rand(225,255),rand(225,255));
		//填充图片
		imagefill($img,0,0,$bgcolor);
		//画矩形边框
		$black = imagecolorallocate($img,0,0,0);
		imagerectangle($img, 0, 0, $width-1, $height-1, $black);
		//画字符
		for($i=0;$i<strlen($validCode);$i++){
			$color = rand(1, 125);
			$x = 5+($width/strlen($validCode))*$i;
			$y = 1 + rand(5,$height-imagefontheight(5));
			imagechar($img, 15, $x, $y, $validCode{$i}, $color);
		}
		//画干扰点
		for($i=0;$i<100;$i++){
			$color = rand(145,245); 
			$x = rand(2,$width-2);
			$y = rand(1,$height-1);
			imagesetpixel($img, $x, $y, $color);
		}
		//画干扰线
// 		for($i=0;$i<10;$i++){
// 			$color = rand(125,255);
// 			$x1 = rand(1,$width-1);
// 			$y1 = rand(1,$height-1);
// 			$x2 = rand(1,$width-1);
// 			$y2 = rand(1,$height-1);
// 			imageline($img, $x1, $y1, $x2, $y2, $color);
// 		}
		
		header("Content-Type:image/png");
		imagepng($img);
		imagedestroy($img);
	}
}