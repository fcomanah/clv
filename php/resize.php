<?php
// *** Include the class
include('resize-class.php');

// list of available image sizes
// insert more sizes for finer grain control but probably not needed
$image_sizes = array(
	'100', // smallest
	'200',
	'320',
	'480',
	'768',
	'1024',
	'1360',
	'1900' // largest
);

// get base path
$base_path = str_replace(basename(__FILE__),"",__FILE__);

// get window width
$browser_width = (int) $_POST['width'];

// build image path
$image = $base_path.str_replace("/",DIRECTORY_SEPARATOR,$_POST['image']);

// get original image size
$size = getimagesize($image);

// set original width & height
$width = $size[0];
$height = $size[1];

// get the optimum width
foreach($image_sizes as $k=>$v) {
	if((int) $v < $browser_width) {
		$width = (int)$v;
	}
}

// check we're not over re-sizing
if($width > $size[0]) {
	$width = $size[0];
}

// check if the original image can fit on screen
if($size[0] < $browser_width) {
	$width = $size[0];
}

// check against largest image size
$reverse = array_reverse($image_sizes);
if($size[0] > $reverse[0] && $browser_width > $reverse[0]) {
	$width = $reverse[0];
}

// build new filename
$new_image_name = 'cache/'.$width.'_'.basename($image);

// re-sized image already exists
if(file_exists($base_path.str_replace("/",DIRECTORY_SEPARATOR,$new_image_name))) {
	echo $new_image_name;
	exit;
}

// *** 1) Initialise / load image
$resizeObj = new resize($image);
// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
$resizeObj->resizeImage($width, $height);
// *** 3) Save image
$resizeObj->saveImage($new_image_name, 80);

echo $new_image_name;
