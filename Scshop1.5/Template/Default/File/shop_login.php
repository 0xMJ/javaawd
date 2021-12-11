<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
if(!empty($UID)){
  header('Location: '.$web_url_mt."shop/user/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Cart</title>
    <meta name="keywords" content="My Cart" />
    <meta name="description" content="My Cart" />
	<meta charset="utf-8">
  <?php echo CheckStr_d($Cf['web_meate']);?>
  <script src="<?php echo $web_url_mt;?>Core/Js/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/font-awesome-47/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Css/scshop.css">
	<script src="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Js/Ant.js"></script>
  <script src="<?php echo $web_url_mt;?>Core/Js/Ant_shop.js"></script>
</head>
<body>
<div class="Ant">
  <!--top-->
  <div class="Ant_usre_top Ant1200"><div class="Ant_user_top_left" style="text-align: center; width: 100%; padding: 10px 0;"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>" ></a></div><div class="cb"></div></div>
  <!--end-->
	<div class="cb"></div>
 
  		<div class="cb"></div>
      <div class="Ant_login A100">
        <div class="Ant_loginc">
        <form method="post" id="userform"><ul id="userlogin"></ul></form>
        </div>
      </div>
  		<script type="text/javascript">
                  htmlobj=$.ajax({url:"<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=Userlogin&lgid=<?php echo $lgid;?>&type=l",async:false}); 
                   $("#userlogin").html(htmlobj.responseText);    
  		</script>
 
	<div class="cb"></div>
    <!--bot-->
    <div class="Ant_user_bot Ant1200"><?php echo CheckStr_d($W_Cp);?></div>
    <!--end-->
</div>	
</body>
</html>