<?php
include_once('../connect.php');
include_once('../html.php');
$_POST = html($_POST);
$id = $_POST['id'];
$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

if(strlen($title) > 10 || strlen($author) > 10){
    die("<script>window.location.href='article.manage.php';window.alert('The title or author is too long')</script>");
}

if(mysql_query("update article set title ='$title',author='$author',description='$description',content='$content',dateline='$dateline' where id='$id'")){
	echo "<script>window.location.href='article.manage.php';window.alert('修改文章成功')</script>";
}else{
	echo mysql_error();
}
?>