<?php include_once 'Ant_Inc.php';
?>
<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="Css/Ant.css">
	<link rel="stylesheet" href="../Core/Css/font-awesome-47/css/font-awesome.min.css">
	<script src="../Core/Js/jquery-1.7.2.min.js"></script>
	<script language="javascript" src="Js/Ant.js"></script>	
</head>
<body class="ant_left">
	<div class="ant_content">
		<div class="ant_left_heard"><?php echo CheckUser($db_conn,"info"); ?></div>
		<div class="cb"></div>
		<div class="ant_left_c">

			<ul>
				<?php Menulist($db_conn,$mulu,"check");?>
				<li><i class="fa fa-angellist" aria-hidden="true"></i> <a href="Ant_Sql.php" target="mainFrame">SQL执行</a></li>
			</ul>

		</div>

 
	</div>

</body>
</html>