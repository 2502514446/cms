<?php
//验证码类
////////////////////////////////////////////////////
class IdentifyingCode {
	private $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';	//随机因子
	private $code;			//验证码
	private $codelength=4;	//验证码长度
	private $width=130;		//背景的宽度
	private $height=50;		//背景的高度
	private $img;			//背景的资源句柄
	private $font;			//字体
	private $fontsize=20;	//字体大小
	private $fontcolor;		//字体颜色
	
	//构造函数，初始化
	public function __construct() {
		$this->font = ROOT_PATH.'/font/elephant.ttf';
	}
	//生成随机码
	private function createCode() {
		$_length = strlen($this->charset)-1;	//随机因子的长度
		for($i=0; $i<$this->codelength; $i++) {
			$this->code .= $this->charset[mt_rand(0,$_length)];
		}
		return $this->code;		//返回验证码
	}
	//生成背景
	private function createImg() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
		imagefilledrectangle($this->img, 0,$this->height, $this->width,0, $color);
	}
	//输出图形
	private function outputImg() {
		header('Content-type:image/png');
		imagepng($this->img);
		imagedestroy($this->img);
	}
	//生成文字
	private function createFont() {
		$_x = $this->width / $this->codelength;
		for($i=0; $i<$this->codelength; $i++) {
			$this->fontcolor = imagecolorallocate($this->img, mt_rand(0,156), mt_rand(0,156), mt_rand(0,156));
			imagettftext($this->img, $this->fontsize, mt_rand(-30,30), $_x*$i+mt_rand(3,7), $this->height/1.4, $this->fontcolor, $this->font, $this->code[$i]);
		}
	}
	//生成线条，雪花
	private function createLine() {
		for($i=0; $i<6; $i++) {
			$this->color = imagecolorallocate($this->img, mt_rand(0,156), mt_rand(0,156), mt_rand(0,156));
			imageline($this->img, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $this->color);
		}
		for($i=0; $i<100; $i++) {
			$this->color = imagecolorallocate($this->img, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
			imagestring($this->img, mt_rand(1,5), mt_rand(0,$this->width), mt_rand(0,$this->height), '*', $this->color);
		}
	}
	//获取验证码
	public function getCode() {
		return strtolower($this->code);
	}
	//对外生成
	public function getCodeImg() {
		$this->createImg();
		$this->createLine();
		$this->createCode();
		$this->createFont();
		$this->outputImg();
	}

}
?>
