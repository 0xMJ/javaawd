<?php
include_once('../connect.php');
$id = htmlspecialchars($_GET['id'],ENT_QUOTES);
if(mysql_query("delete from article where id='$id'")){
	echo "<script>window.location.href=\"article.manage.php\";window.alert(\"删除文章成功\")</script>";
}else{
	echo mysql_error();
}
?>