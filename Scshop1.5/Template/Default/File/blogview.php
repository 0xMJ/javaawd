<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
$v=InfoView($db_conn,$ID,$lgid)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo CheckStr_d($v['info_title']);?></title>
    <meta name="keywords" content="<?php echo CheckStr_d($v['info_key']);?>" />
    <meta name="description" content="<?php echo CheckStr_d($v['info_des']);?>" />
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
			<div class="Ant_title"><i class="fa fa-home" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>blog/"><?php echo $Lable['blog'];?></a> <?php echo CheckBlogCat($db_conn,$v['info_cat'],$lgid,$web_url); ?> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo CheckStr_d($v['info_title']);?></div>
		    <div class="cb"></div>
			<div class="Ant_bloglist A100">
				<div class="Ant_blog_left">
					<div class="Ant_blog_left_1">
						<ul>
						<li><?php echo $Lable['blog'];?></li>
						<?php echo BlogCat($db_conn,$lgid,$web_url); ?>
						</ul>
				    </div>
				    <div class="cb"></div>
				    <div class="Ant_blog_left_2">
				    	<div class="Ant_blog_left_2_t"><?php echo $Lable['newproduct']; ?></div>
				    	<div class="cb"></div>
				    	<?php echo PageNewPro($db_conn,$web_url,$web_url_mt,$lgid);?>
				    </div>
				    <div class="cb"></div>
				</div>
				<div class="Ant_blog_right">
			 		<div class="Ant_blog_right_1"><h1><?php echo CheckStr_d($v['info_title']);?></h1><br><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("Y-m-d",strtotime($v['info_time'])); ?> <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $v['info_autu'];?></div>
			 		<div class="cb"></div>
			 		<div class="Ant_blog_right_3">
			 			<?php echo CheckStr_d($v['contents']);?>
			 			<br>
			 			<?php echo CheckStr_d($Cf['web_share']);?>
			 		</div>
			 		<div class="cb"></div>
			 		<div class="Ant_blog_right_4">
			 			<ul>
			 				<?php echo NextPrev($db_conn,$v['ID'],$lgid,"sc_info","prev",$web_url,"info_flag='B'","bv");?>
			 				<?php echo NextPrev($db_conn,$v['ID'],$lgid,"sc_info","next",$web_url,"info_flag='B'","bv");?>
			 			</ul>
			 		</div>
				</div>
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