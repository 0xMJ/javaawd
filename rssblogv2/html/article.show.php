<?php
include_once("connect.php");
$id=htmlspecialchars($_GET['id'],ENT_QUOTES);
$data = mysql_query("select title,author,content,dateline from article where id='$id'");
$data = mysql_fetch_assoc($data);
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>RssblogV2.0</title>
		<link rel="stylesheet" type="text/css" href="commen.css"/>
	</head>
	<body>
		<div id="header">
			<div id="head">
				<div id="header_title">
                    RssblogV2.0
				</div>
				<ul id="menu">
					<li>
						<a href="index.php">首页</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="header_border"></div>
		
		<!--内容部分-->
		<div id="content_box">
		<div id="content">
			<div id="left_content">
				<ul>
					<li class="content_title" style="text-align: center;display: block;margin-top: 20px;"><?php echo $data['title']?></li>
                    <li class="content_more"> <a href="/Rssinfo/index.php/<?php echo $id;?>">文章信息</a>>> </li>
                    <li class="content_more"> <a href="/GetRss/index.php/<?php echo $id;?>">Rss</a>>> </li>
					<li class="content_author" style="text-align: center;margin-top: 10px;">
						<span>作者：<?php echo $data['author']?></span>&nbsp;&nbsp;
						<span>日期：<?php echo date('Y-m-d H:i:s', $data['dateline']);?></span>
					</li>
					<hr style="height: 5px;background-color: #EDEDED;"/>
					<li><?php echo $data['content']?></li>
				</ul>
			</div>
			<div id="right_find">
				<div id="sidebar">
					<span id="search_title">
						search
					</span>
					<hr style="width: 100%;height: 5px;background-color: #EDEDED;margin-bottom: 20px;" />
					<form action="article.list.php" method="post">
						<input type="text" name="search" id="search" value="" />
						<input type="submit" value="搜索"/>
					</form>
				</div>
			</div>
		</div>
		</div>
		<div id="footer"></div>
	</body>
</html>