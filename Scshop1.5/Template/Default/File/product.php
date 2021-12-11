<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
$Meta=CatMeta($db_conn,$ID,$lgid);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Meta['mt'];?></title>
    <meta name="keywords" content="<?php echo $Meta['mk'];?>" />
    <meta name="description" content="<?php echo $Meta['md'];?>" />
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
    <?php include_once  'head.php'; ?>
	<!--end-->
	<div class="cb"></div>
	<div class="A100">
		<div class="Ant1200">
		<div class="Ant_title"><i class="fa fa-home" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url;?>product/"><?php echo $Lable['product']; ?></a> <?php echo CheckCat($db_conn,$Meta['mid'],$lgid,$web_url); ?> </div>			
			<div class="Ant_plist A100">
           <?php
           $px = $Lable['idl']."||".$Lable['idh']."||".$Lable['pricel']."||".$Lable['priceh']."||".$Lable['namea']."||".$Lable['namez'];
           echo ProList($db_conn,$web_url_mt,$web_url,$lgid,$ID,$Lable['product'],$Lable['addtocart'],$Lable['showre'],$Cf['web_plist'],$px,$Lable['sortby'],$ob);?>
           <div class="cb"></div>
			</div>
			<div class="cb"></div>
		</div>
	</div>



	<div class="cb"></div>
    <!--bot-->
    <?php include_once  'foot.php'; ?>
    <!--end-->
</div>
</body>
</html>