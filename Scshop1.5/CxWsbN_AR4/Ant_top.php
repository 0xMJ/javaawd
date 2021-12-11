<?php
$http="http";
include_once 'Ant_Inc.php';
$Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="../Core/Js/jquery-1.7.2.min.js"></script>
	<script language="javascript" src="Js/Ant.js"></script>
	<link rel="stylesheet" href="Css/Ant.css">
	<link rel="stylesheet" href="../Core/Css/font-awesome-47/css/font-awesome.min.css">
</head>
 <?php
function curPageURL($pageURL= "") {
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
  }else{
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}
$rurls=curPageURL()."&hp=".$http=CheckConfig($db_conn,"web_https");
$rurl=str_replace("Ant_top.php", "", $rurls);
?>
<body class="ant_top">

	<?php $ul= 'https://www.sem-cms.cn/';//https://www.sem-cms.cn/?>
	<div class="ant_top_left"><div class="fontlogo"><font class="fontgreen">SEM</font>CMS </div><div class="authsq"><iframe id="authorization" src="<?php echo $ul;?>sq/?flag=sq&rurl=<?php echo $rurl;?>"></iframe></div></div>
	<div class="ant_top_right"><span><a href="<?php echo $ul;?>soft/?rurl=<?php echo $rurl;?>" target="mainFrame">插件与更新 <i class="fa fa-sun-o" aria-hidden="true"></i></a></span><span><a href="<?php echo $ul;?>wenda/wd-8/" target="mainFrame">视频教程 <i class="fa fa-file-video-o" aria-hidden="true"></i></a></span> <span onclick="delCookie();">退出 <i class="fa fa-sign-out" aria-hidden="true"></i></span> <span title="SCSHOP版本号:更新版本,查看官网最新消息" onclick="window.top.location.href='<?php echo $ul; ?>';"><?php echo $v[0];?> <i class="fa fa-info-circle" aria-hidden="true"></i></span> </div>

	

</body>
</html>