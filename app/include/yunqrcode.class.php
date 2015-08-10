<?php
/*
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
 */
class YunQrcode {	
	static function generatePng($inputContent,$inputLogo,$outputPngPath,$size){
		require_once LIB_PATH."phpqrcode.php";
		$return = $outputPngPath;
		
		if($inputLogo == ""){
			QRcode::png($inputContent, $outputPngPath, QR_ECLEVEL_L, $size);
		}
		else{
			QRcode::png($inputContent, $outputPngPath, QR_ECLEVEL_L, $size , 2);
			
			if ($inputLogo !== FALSE) {
			$outputPngPath = imagecreatefromstring(file_get_contents($outputPngPath)); 
			$inputLogo = imagecreatefromstring(file_get_contents($inputLogo)); 
			$QR_width = imagesx($outputPngPath);
			$QR_height = imagesy($outputPngPath);
			$logo_width = imagesx($inputLogo);
			$logo_height = imagesy($inputLogo);
			$logo_qr_width = $QR_width / 5; 
			$scale = $logo_width/$logo_qr_width; 
			$logo_qr_height = $logo_height/$scale; 
			$from_width = ($QR_width - $logo_qr_width) / 2; 
			
			imagecopyresampled($outputPngPath, $inputLogo, $from_width, $from_width, 0, 0, $logo_qr_width, 
			$logo_qr_height, $logo_width, $logo_height); 
			} 
			
			imagepng($outputPngPath, $return); 
		}
	}
	
	
	static function generatePng2($inputContent,$size){
		require_once LIB_PATH."phpqrcode.php";
		return QRcode::png($inputContent, false, QR_ECLEVEL_L, $size);
	}
}
?>