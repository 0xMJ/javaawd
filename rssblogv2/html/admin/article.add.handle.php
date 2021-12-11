<?php
include_once('../connect.php');
include_once('../html.php');
$_POST = html($_POST);
$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

if(strlen($title) > 10 || strlen($author) > 10){
    die("<script>window.location.href='article.manage.php';window.alert('The title or author is too long')</script>");
}

if(mysql_query("insert into article(title,author,description,content,dateline)values('$title','$author','$description','$content',$dateline)")){
	echo "<script>window.location.href='article.add.php';window.alert('文章发布成功')</script>";
}else{
	echo mysql_error();
}

?>