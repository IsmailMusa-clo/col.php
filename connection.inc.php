<?php
	session_start();
	$con=mysqli_connect("localhost","root","","collage_exam");
	define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT']. '/php/collage_exam/');
	define('SITE_PATH', 'http://127.0.0.1/php/collage_exam/');
	define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
	define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>