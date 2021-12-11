	<div class="Ant_top_3">
			<div class="Ant1200" style="position: relative;">
			<div class="sjl"></div>
			<div class="Ant_top_3_c">
 				<div class="Ant_Subscribe A100"><div class="Ant_Subscribe_left"><i class="fa fa-envelope-open-o fa-2x" aria-hidden="true"></i> <span><b><?php echo $Lable['subscribetitle'];?></b>
<?php echo $Lable['subscribedes'];?></span></div><div class="Ant_Subscribe_right"><form method="post" id="neleter" ><input type="text" name="e_ml" id="e_ml" placeholder="<?php echo $Lable['subscribetxt'];?>" class="Ant_Subscribe_ip"><input type="submit" id="nelsub" value="<?php echo $Lable['subscribe'];?>" class="Ant_Subscribe_sb trans" url="<?php echo $web_url_mt;?>Core/Program/Ant_Rponse.php?actions=SubNewsletter&lgid=<?php echo $lgid;?>" ><?php echo CheckCouncode($db_conn,"bot"); ?></form></div></div>
			</div>
			<div class="sjr"></div>
		    </div>
	</div>
    <div class="cb"></div>
    <div class="Ant_bot">
    	<div class="Ant1200">
            <?php echo Foot($db_conn,$lgid,$web_url,$Lable['infomation'],"About");?>
            <?php echo Foot($db_conn,$lgid,$web_url,$Lable['customerservicce'],"Service");?>
            <?php echo Foot($db_conn,$lgid,$web_url,$Lable['product'],"Catlist");?>
 
     		<ul>
    			<li><?php echo $Lable['contact']?></li>
    			<li><i class="fa fa fa-envelope-o"></i> <a href="mailto:<?php echo CheckStr_d($Cf['web_email']);?>" rel="nofollow"><?php echo CheckStr_d($Cf['web_email']);?></a></li>
    			<li><i class="fa fa-phone fa-lg"></i> <?php echo CheckStr_d($Cf['web_tel']);?></li>
    			<li><i class="fa fa-location-arrow" aria-hidden="true"></i> <?php echo CheckStr_d($Cf['web_add']);?></li>
    			<li><?php echo CheckStr_d($Cf['web_shejiao']);?></li>
    		</ul>   		   		

    	</div>
    	
    </div>
    <div class="cb"></div>
 	<div class="Ant_copyright A100">
 		<div class="Ant1200"><span><?php echo CheckStr_d($W_Cp);?></span><span><img src="<?php echo $web_url_mt;?>Template/Default/Image/master.png"><img src="<?php echo $web_url_mt;?>Template/Default/Image/maestro.png"><img src="<?php echo $web_url_mt;?>Template/Default/Image/discover.png"><img src="<?php echo $web_url_mt;?>Template/Default/Image/mastercard.png"><img src="<?php echo $web_url_mt;?>Template/Default/Image/paypal.png"><img src="<?php echo $web_url_mt;?>Template/Default/Image/visa.png"></span></div>
 	</div>
 	<div id="rightTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
	<div class="rightcotact">
		<ul>
            <?php echo CheckStr_d($Cf['web_otherct']);?>
		</ul>
	</div>
 <div class="cartright" onclick="location.href='<?php echo $web_url_mt;?>shop/cart/'">
 <i class="fa fa-shopping-bag"></i> <?php echo $Lable['mycart'];?> (<span class="mycart"><?php echo ReadCook(Ant_Cook('Cook_Qz'));?></span>)
 </div>

<?php $db_conn -> close();?>