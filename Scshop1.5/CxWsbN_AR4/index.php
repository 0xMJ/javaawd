<!DOCTYPE html>
<html>
<head>
	<title>SEMCMS©外贸商城管理系统</title>
	<meta charset="utf-8">
	<script src="../Core/Js/jquery-1.7.2.min.js"></script>
	<script language="javascript" src="Js/Ant.js"></script>
	<script language="javascript" src="Js/jquery-ui.js"></script>
	<link rel="stylesheet" href="Css/Ant.css">
	<link rel="stylesheet" href="../Core/Css/font-awesome-47/css/font-awesome.min.css">	
</head>
<body class="intent">
 		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
 
		<div class="incentet">
			<div class="intop"><img src="Image/logo.png" alt="SEMCMS外贸商城管理系统"><br><h2>SEMCMS外贸网站商城管理系统</h2></div>
			<div class="cb"></div>
			<div class="inmid">
				<form method="post" id="form" name="form" action="#">
					<ul><li>账号:<br><br> <input type="text" name="username" id="username" class="ant_inputs"></li>
						<li>密码:<br><br> <input type="password" name="userpas" id="userpas" class="ant_inputs"></li>
						<li><input type="checkbox" checked="checked"> 记住这个身份</li>
						<li> <input type="submit" onclick="return login('username,userpas','Login','form','Ant.php');" class="an_submitlogin trans" value="登陆"></li>
					</ul>
				</form>
			</div>
		</div>
 
 
</body>
</html>