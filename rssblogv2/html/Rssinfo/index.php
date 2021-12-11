<?php
include_once("../connect.php");
$id = htmlspecialchars(end(explode("/",$_SERVER['PHP_SELF'])),ENT_QUOTES);;
$data = mysql_query("select title,author,content,dateline from article where id='$id'");
$data = mysql_fetch_assoc($data);
?>
<script>var passage = {"author":"<?php echo $data['author'];?>","title":"<?php echo $data['title']?>"};</script>
