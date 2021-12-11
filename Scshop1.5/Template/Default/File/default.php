<!DOCTYPE html>
<html>
<head>
	<title><?php if(!empty($SeoSet['tag_h_title'])){echo CheckStr_d($SeoSet['tag_h_title']);}else{echo CheckStr_d($Cf['web_name']);}?></title>
    <meta name="keywords" content="<?php echo CheckStr_d($SeoSet['tag_h_key']);?>" />
    <meta name="description" content="<?php echo CheckStr_d($SeoSet['tag_h_des']);?>" />
	  <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo  $web_url_mt.str_replace("../","",CheckStr_d($Cf['web_ico']));?>" />
    <?php echo CheckStr_d($Cf['web_meate']);?>
    <script src="<?php echo $web_url_mt;?>Core/Js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/font-awesome-47/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/swiper.min.css">
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
	<div class="Ant_banner A100">
          <!-- Swiper -->
          <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php echo Banner($db_conn,$lgid,$web_url_mt,"1");?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
<!--         <div class="swiper-button-next"></div> 
             <div class="swiper-button-prev"></div>  -->
          </div>		
	</div>
	<div class="cb"></div>
	<div class="Ant1200">
		<div class="Ant_cat">
			<div class="Ant_bigtitle A100"><?php echo $Lable['featurecat'];?></div>
			<div class="cb"></div>
			<div class="Ant_nr A100">
             <?php echo CatFeauture($db_conn,$lgid,$web_url_mt,$web_url);?> 	
			</div>
	 </div>
	    <div class="cb"></div>
	 <div class="midbanner A100">
			<?php echo Banner($db_conn,$lgid,$web_url_mt,"3");?>
	 </div>
	    <div class="cb"></div>
	 <div class="Aproduct">
			<?php
			$filedsname=$Lable['newproduct'].",".$Lable['featureproduct'].",".$Lable['rqproduct'].",".$Lable['zkproduct'];
			$viewqty=$Cf['web_inlist'].",".$Cf['web_iflist'].",".$Cf['web_irlist'].",".$Cf['web_itlist'];
             echo ProFeauture($db_conn,$lgid,$web_url_mt,$web_url,$filedsname,$viewqty,$Lable['addtocart']);
			?>
	  </div>
	    <div class="cb"></div>
	  <div class="lastblog">
			<?php echo IndexBlog($db_conn,$lgid,$web_url_mt,$web_url,$Lable['readmore'],$Lable['lastblog']) ?>	
       <div class="cb"></div>
	  </div>
	    <div class="cb"></div>

	</div>
	<div class="cb"></div>
    <!--bot-->
    <?php include_once  'foot.php'; ?>
    <!--end-->
</div>
 <!-- Swiper JS -->
<script src="<?php echo $web_url_mt;?>Core/Js/swiper.min.js"></script>
<!-- Initialize Swiper -->
 <script>
            var swiper = new Swiper('.swiper-container', {
              slidesPerView: 1,
              spaceBetween: 30,
              loop: true,
              autoplay: true, 
              autoplayDisableOnInteraction: false, 
              pagination: {
                el: '.swiper-pagination',
                clickable: true,
              },
              navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            });
 </script>
</body>
</html>