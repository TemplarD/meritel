<?php
$t = explode('_small.', $_SERVER['REQUEST_URI']);
$fileimg = "..".implode(".", $t);

$max = 200;
	
$size = getimagesize($fileimg);
$height = $size[1];
$width = $size[0];
$imageType = $size[2];
$imageType = image_type_to_mime_type($imageType);
switch($imageType){
	case "image/gif":
		$imgnow=imagecreatefromgif($fileimg);
	break;
	case "image/pjpeg":
	case "image/jpeg":
	case "image/jpg":
		$imgnow=imagecreatefromjpeg($fileimg); 
	break;
	case "image/png":
	case "image/x-png":
		$imgnow=imagecreatefrompng($fileimg); 
	break;
}

$k = max($height/$max, $width/$max);
$newimg2 = imagecreatetruecolor($width/$k, $height/$k);
imagecopyresampled($newimg2, $imgnow, 0, 0, 0, 0, $width/$k, $height/$k, $width, $height);
switch($imageType){
	case "image/gif":
		imagegif($newimg2, "..".$_SERVER['REQUEST_URI']);
		header("Content-type: image/gif");
		imagegif($newimg2);
	break;
	case "image/pjpeg":
	case "image/jpeg":
	case "image/jpg":
		imagejpeg($newimg2, "..".$_SERVER['REQUEST_URI'], 95);
		header("Content-type: image/jpeg");
		imagejpeg($newimg2);
	break;
	case "image/png":
	case "image/x-png":
		imagepng($newimg2, "..".$_SERVER['REQUEST_URI']);
		header("Content-type: image/png");
		imagepng($newimg2);
	break;
}
?>