<?php
//var_dump(gd_info());
function captchaCreate() {
	$code = '';
	$charset = 'QWERTYUIOPASDFGHJKLZXCVBNM123456789';
	$len = strlen($charset);
	for ($i = 0; $i < 5; $i++) {
		$code .= $charset[rand(0, $len - 1)];
	}
	return $code;
}
function captchaShow($code)
{
//创建空白的画布图像资源
$img = imagecreate(100, 40);
//填充颜色
imagecolorallocate($img, rand(0, 100), rand(100, 150), rand(0, 255));
$fontColor=imagecolorallocate($img,250,130,80);
$fontStyle='./font/captcha.ttf';
//干扰线
$lineColor = imagecolorallocate($img, 200, 255, 255);
for ($i = 0; $i < 10; $i++) {
	imageline($img, rand(0, 100), rand(0, 40), rand(0, 100), rand(0, 40), $lineColor);
}
//干扰点
for ($i = 0; $i < 350; $i++) {
	imagesetpixel($img, rand(0, 100), rand(0, 40), $lineColor);
}
//将字符添加到图像中
	for ($i = 0; $i < 5; $i++) {
		imagettftext($img, 22, //字符大小
		rand(15, 15) - rand(0,50), //角度
		5+$i*15,25, $fontColor, $fontStyle, $code[$i]);
	}
//设置HTTP响应的内容为GIF图片
header('Content-Type:image/gif');
//输出
imagegif($img);
}
session_start();
$code=captchaCreate();
$_SESSION['captcha']=$code;
captchaShow($code);
?>