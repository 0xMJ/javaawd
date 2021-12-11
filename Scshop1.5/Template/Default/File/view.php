<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
$v=ViewInfo($db_conn,$ID,$lgid)[0];
$img= explode(",", rtrim($v['ant_img'],","));
 

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php if (!empty($v['products_meta'])){echo CheckStr_d($v['products_meta']);}else{echo CheckStr_d($v['products_name']);}?></title>
    <meta name="keywords" content="<?php echo CheckStr_d($v['products_key']);?>" />
    <meta name="description" content="<?php echo CheckStr_d($v['products_des']);?>" />
	<meta charset="utf-8">
	<?php echo CheckStr_d($Cf['web_meate']);?>
    <script src="<?php echo $web_url_mt;?>Core/Js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/font-awesome-47/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Css/scshop.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/swiper.min.css">
	<script src="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Js/Ant.js"></script>
	<script src="<?php echo $web_url_mt;?>Core/Js/Ant_shop.js"></script>			
</head>
<body>
<div class="Ant">
	<!--top-->
    <?php include_once  'head.php'; ?>
	<!--end-->
	<div class="cb"></div>
	<div class="Ant_view Ant1200">
		<div class="Ant_title"><i class="fa fa-home" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url;?>product/"><?php echo $Lable['product']; ?></a> <?php echo CheckCat($db_conn,trim($v['products_category'],","),$lgid,$web_url); ?> <font id="mbt"><i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo CheckStr_d($v['products_name']); ?></font> <?php echo PNextPrev($db_conn,$v['ID'],$lgid,"sc_products","next",$web_url,"pv")?> <?php echo PNextPrev($db_conn,$v['ID'],$lgid,"sc_products","prev",$web_url,"pv")?></div>
		<div class="cb"></div>
		<div class="Ant_view_1">
			<div class="Ant_view_1_left">
				<div class="Ant_view_1_left_bimg"><img src="<?php echo $web_url_mt.str_replace("../", "", $img[0]);?>" alt="<?php echo CheckStr_d($v['products_name']);?>"></div>
				<div class="Ant_view_1_left_simg">
                <span onclick="pre()"><i class="fa fa-chevron-up Ant_ccc" aria-hidden="true" id="leftl"></i></span><span onclick="nex('<?php echo count($img)-5;?>')"><i class="fa fa-chevron-down <?php if(count($img)<5){echo' Ant_ccc';}?>" aria-hidden="true" id="rightr"></i></span>		 
					<ul class="vimg">
					<?php
					foreach ($img as $value) {
						echo "<li><img src='".$web_url_mt.str_replace("../", "", $value)."'' alt='".CheckStr_d($v['products_name'])."'></li>";
					}
					?>
				   </ul>
			
				</div>
			</div>
			<div class="Ant_view_1_right">
				<form action="#" id="cartform" method="post">
				<ul>
					<li><h1><?php echo CheckStr_d($v['products_name']);?></h1></li>
					<li class="Ant_start"><span><?php 
					for ($i=0; $i <$v['products_start'] ; $i++) { 
						echo '<i class="fa fa-star" aria-hidden="true"></i>';
					}
					for ($i=0; $i <(5-$v['products_start']) ; $i++) { 
						echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
					}

					?> <u id="Wrevievws" url="<?php echo $web_url_mt; ?>" lgid="<?php echo $lgid; ?>" value="<?php echo $v['ID'];?>"><?php echo $Lable['wirteareviews']; ?></u> (<?php echo ChekReviews($db_conn,$v['ID'],"js"); ?>)</span> <span class="wishlist trans" value="<?php echo $v['ID'];?>" lgid="<?php echo $lgid; ?>" url="<?php echo $web_url_mt;?>"><i class="fa <?php if(isset($_COOKIE[Ant_Cook('Cook_WhQz').$v['ID']])){echo "fa-heart";}else{echo "fa-heart-o";} ?>" aria-hidden="true"></i></span></li>
					<li><?php echo CheckStr_d($v['products_guige']);?></li>

					<li><span class="sprice" id="spriced"><?php
					//2021-07-08
                   if(!empty($v['products_sx'])){ 
                   		   $sxPrice = VsuxinPrice($db_conn,$v['products_sx'],$v['Itemnb'],$web_url_mt);
		                   if (!empty($sxPrice)){
							   $wdpric = ChangeCur($db_conn,CheckStr_d($sxPrice));
							  echo $wdpric;
		                     }else{
		                   	   $wdpric = ChangeCur($db_conn,CheckStr_d($v['products_sprice']));
		                   	  echo $wdpric;
		                   }
				    }else{
				      $wdpric = ChangeCur($db_conn,CheckStr_d($v['products_sprice']));
				     echo $wdpric;
				    }
				    $wdpric=str_replace(ChangeCur($db_conn,"0","fh"),"",$wdpric); //replace price ccu fh
					?></span><span class="oprice"><?php if(!empty($v['products_oprice'])){ echo "<s>".ChangeCur($db_conn,CheckStr_d($v['products_oprice']))."</s>";}?></span></li>

					<?php 
					 if(!empty($v['products_sx'])){ 
					  	echo Vsuxin($db_conn,$v['products_sx'],$v['Itemnb'],$web_url_mt);
				      }else{
				      	echo "<li><input type='hidden' value='qty' name='canshu' id='canshu' ></li>";
				      }
				      if(!empty($v['products_zk'])){ //折扣?>
					<li id="sczk" zk="<?php echo $v['products_zeke'];?>" url="<?php echo $web_url_mt.'Core/Program/Ant_Aajx.php';?>" >
						<?php //折扣显示
                            $up="";$down="";$disos="";$ups="";
                            $zeke=explode(",", $v['products_zeke']);
                            $len=count($zeke);
                            $j=0;
                            for ($x=0; $x<$len; $x++) {
                                if ($j==1 || $x==0){
                                    $clg="tabgreen";
                                }else{
                                    $clg="";
                                }
                                if($x%2==0){ //取奇偶数
                                    if ($zeke[$x]!=""){
                                    	$ups.= $zeke[$x].",";
                                        $up.= "<td class='tab".($j+1)." ".$clg."'>".$zeke[$x]."</td>";
                                    }
                                }else{
                                    if ($zeke[$x]!=""){
                                        $down.= "<td class='tab".$j." ".$clg."'>".ChangeCur($db_conn,$wdpric*$zeke[$x])."</td>";
                                        $disos.="<td class='tab".$j." ".$clg."'>".((1-$zeke[$x])*100)."% OFF</td>";
                                    }
                                }
                                $j=$j+1;
                            }
                            ?>
                            <table cellspacing="0" class="table">
                                <tr><td width="25%" ><?php echo $Lable['addqty'];?></td><?php echo $up;?></tr>
                                <tr><td ><?php echo $Lable['addzk'];?></td><?php echo $disos;?></tr>
                                <tr><td ><?php echo $Lable['wholeprie'];?></td><?php echo $down;?></tr>
                            </table>
                            <input type="hidden" value="<?php echo rtrim($ups,",");?>" id="wholeprice">
                            
					</li>
				   <?php }
          
                    if (!empty($v['products_m'])){$pm=$v['products_m'];}else{$pm=1;} //起订量
                    if (!empty($v['products_b'])){$pb=$v['products_b'];}else{$pb=0;} //最大购买量
				    ?>
				    <input type="hidden" name="pid" value="<?php echo $v['ID'];?>">
					<li><div class="Ant_qty"><input type="text" value="<?php echo $pm;?>" name="qty" id="qty" class="Ant_qty_qty" onblur="changeqty('<?php echo $pm;?>','<?php echo $pb;?>');"><span onclick="QtyAdd('Add','<?php echo $pb;?>','qty')">+</span><span onclick="QtyAdd('Red','<?php echo $pm; ?>','qty')">-</span></div><span class="Addcartv trans" id="AddToCart" onclick="return AddToCart('<?php echo $web_url_mt;?>','<?php echo $lgid;?>');" ><i class="fa fa-cart-plus" aria-hidden="true"></i> <?php echo $Lable['addtocart'];?></span></li>
					<li><?php echo CheckStr_d($Cf['web_share']);?></li>
				</ul>
				</form>
			</div>
			
		</div>
		<div class="cb"></div>
		<div class="Ant_view_2 A100">
			<div class="Ant_Proltab A100"><span class="Ant_select"><?php echo $Lable['adescription'];?></span><span><?php echo $Lable['areviews'];?>(<?php echo ChekReviews($db_conn,$v['ID'],"js"); ?>)</span></div>
			<div class="cb"></div>
			<div class="action">
			<div class="Ant_view_2_2 A100"><?php echo CheckStr_d($v['contents']);?></div>
			<div class="Ant_view_2_2 A100" style="display: none;"><div class="Ant_reviews"><?php echo ChekReviews($db_conn,$v['ID']); ?></div></div>
		    </div>    
		</div>
		<div class="cb"></div>
	    <div class="Ant_Proltab A100"><span class="Ant_select"><?php echo $Lable['reproduct'];?></span></div>
	    <div class="cb"></div>
		<div class="Ant_view_3 A100">
	          <!-- Swiper -->
	          <div class="swiper-container">
	            <div class="swiper-wrapper">
	            <?php 
	            $catid=explode(",", $v['products_category']);
	            echo ReProducts($db_conn,$lgid,$catid[1],$v['products_similar'],$web_url_mt,$web_url);?>
	            </div>
	            <!-- Add Pagination -->
	            <!-- <div class="swiper-pagination"></div> -->
	            <!-- Add Arrows -->
	             <div class="swiper-button-next"></div> 
	             <div class="swiper-button-prev"></div> 
	          </div>				
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
 
 		 if($(window).width()<321){ 

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
        }else if($(window).width()<481){

            var swiper = new Swiper('.swiper-container', {
              slidesPerView: 2,
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
        }else{
             var swiper = new Swiper('.swiper-container', {
              slidesPerView: 4,
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
        }
      
 </script>
</body>
</html>