<?php
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Lable['mycart'];?></title>
    <meta name="keywords" content="<?php echo $Lable['mycart'];?>" />
    <meta name="description" content="<?php echo $Lable['mycart'];?>" />
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
  <div class="Ant_usre_top Ant1200"><div class="Ant_user_top_left"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>"></a></div><div class="Ant_user_top_right"><span class="slet">1</span> <?php echo $Lable['shoppingcart']; ?> <span>2</span> <?php echo $Lable['addplaceorder']; ?> <span>3</span><?php echo $Lable['checkout']; ?>  <span>4</span><?php echo $Lable['Completed']; ?></div><div class="cb"></div></div>
  <!--end-->
	<div class="cb"></div>
  	<div class="Ant_cart Ant1200">
  		<div class="cb"></div>
  		<div class="Ant_cart_view A100"></div>
  		<div class="cb"></div>
  		<script type="text/javascript">
                 htmlobj=$.ajax({url:"<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=ViewCart&lgid=<?php echo $lgid;?>",async:false}); 
                 $(".Ant_cart_view").html(htmlobj.responseText);		
  		</script>
  	</div>
	<div class="cb"></div>
    <!--bot-->
    <div class="Ant_user_bot Ant1200"><?php echo CheckStr_d($W_Cp);?></div>
    <!--end-->
</div>	
</body>
</html>