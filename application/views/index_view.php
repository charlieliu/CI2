<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="title" content="{title}" />
	<meta name="description" content="{title}" />

	<title>{title}</title>
	<?php 
	/*
	// 小圖
	$this->load->helper('html');
	$link = array(
		'href'	=> "images/joba.jpg",
		'type'	=> "image/x-icon",
		'rel'	=> "shortcut icon"
	);
	echo link_tag($link);
	// CSS位置
	$link = array(
		'href'	=> "css/welcome.css?".date('YmdHis'),
		'type'	=> "text/css",
		'rel'	=> "stylesheet"
	);
	echo link_tag($link); 
	*/
	// 小圖
	$this->load->helper('test');

	$link = array(
		'type'	=> "image/x-icon",
		'rel'	=> "shortcut icon",
		'href'	=> "images/joba.jpg",
		'ver'	=> date('YmdHis')
	);
	echo load_html_file($link);
	// CSS位置
	$link = array(
		'type'	=> "text/css",
		'rel'	=> "stylesheet",
		'href'	=> "css/welcome.css",
		'ver'	=> ''
	);
	echo load_html_file($link); 
	?>
	<!--
	<link rel="shortcut icon" href="images/joba.jpg" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/welcome.css">
	-->
</head>
<body>

<div id="container">
	{content_div}
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>