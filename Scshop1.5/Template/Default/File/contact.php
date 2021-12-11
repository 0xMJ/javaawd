<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Lable['contact'];?></title>
    <meta name="keywords" content="<?php echo CheckStr_d($SeoSet['tag_h_key']);?>" />
    <meta name="description" content="<?php echo CheckStr_d($SeoSet['tag_h_des']);?>" />
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
			<div class="Ant_title"><i class="fa fa-home" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['contact'];?></div>
		    <div class="cb"></div>
		    <div class="Ant_contact Ant100">
		    	<div class="Ant_contact_t Ant100"><h1><?php echo $Lable['contact'];?></h1></div>
		    	<div class="Ant_contact_left"><?php echo CheckStr_d($SeoSet['contents']);?></div>
		    	<div class="Ant_contact_right">

		    	</div>
		    	<script>
		    		data=$.ajax({url:"<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=Contacts&lgid=<?php echo $lgid;?>",async:false});
		    		$(".Ant_contact_right").html(data.responseText);
		    	</script>
		    </div>

		</div>
	</div>



	<div class="cb"></div>
    <!--bot-->
    <?php include_once  'foot.php'; ?>
    <!--end-->
</div>
</body>
</html>