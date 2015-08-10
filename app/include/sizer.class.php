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
class Sizer {
	
	
	private $_path;

	private $_picdelete;
	
	
	private $_count;
	
	
	private $_paramsArr;
	
	private $_oriImg;
	
	private $_resultImgArr;
	
	
	function Sizer($path){
		
		$this->_path=$path;
		$thi->_picdelete = $picdelete;
		$this->_paramsArr=array();
		$this->_count=0;
	}
	
	
	function sizeIt($picdelete='1'){
		
		
		if(isset($_POST['count'])){
			$this->_count=intval($_POST['count']);
		}
		
		
		for($i=1;$i<=$this->_count;$i++){
			$this->_paramsArr[$i-1]=array('width'=>$_POST['width'.$i],
									'height'=>$_POST['height'.$i],
									'x'=>$_POST['x'.$i],
									'y'=>$_POST['y'.$i],
									'scale'=> $_POST['scale'.$i],
									'img'=>$_POST['img'.$i]); 
		}
		
		
		
		if(!file_exists($this->_path)){
			@mkdir($this->_path,0777,true);
		}
		$idx=0;
		foreach($this->_paramsArr as $key=>$value){
			$idx++;
			$parts=explode('.',$value['img']);
			
			$t_name[$idx] = $this->resizeThumbnailImage(
										$this->_path.(time().rand(100,999)).'_'.$idx.'.'.end($parts),
										$value['img'],
										$value['width'],
										$value['height'],
										$value['x'],
										$value['y'],
										$value['scale']);
		}

		
		if($picdelete=='1')
		{
			$pictype=getimagesize($_POST['img1']);
			if($pictype[2]=='1' || $pictype[2]=='2' || $pictype[2]=='3')
			{
				@unlink($_POST['img1']);
			}
		}elseif($picdelete=='2' && $idx=='1'){
			$t_name[2] = $_POST['img1'];
		}
		
		return $t_name;
	}
	
	
	
	function resizeThumbnailImage(	$thumb_image_name,  
									$image, 			
									$width, 			
									$height, 			
									$start_width, 		
									$start_height, 		
									$scale				
									)
	{
		
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
			case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$thumb_image_name); 
				break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
		}
		
		chmod($thumb_image_name, 0666);
		return $thumb_image_name;
	}
	
}

?>