<?php
	include_once('config.php');
	define("HOST_NAME", "localhost");	
	define("USER", "ctf");
	define("PASSWORD", "98vwqld912!@823c@#");
	//链接数据库
	$con = mysql_connect(HOST_NAME,USER,PASSWORD);
	//打开数据库
	mysql_query('use article');	
	//设置编码
	mysql_query('set names utf8');
?>