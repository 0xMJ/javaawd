<div class="Ant_top A100">
		<div class="Ant_top_1">
			<div class="Ant1200">
				<div class="Ant_top_1_left"><?php echo CheckStr_d($SeoSet['tag_t_adv']);?></div>
				<div class="Ant_top_1_right">
					<span><i class="fa fa-user-o" aria-hidden="true"></i>
						<?php  if(!empty($UID)){ ?>
						   <a href="<?php echo $web_url;?>shop/user/" rel="nofollow"><?php echo $Lable['myaccount'];?></a>
					    <?php }else{?>
					    	<a href="<?php echo $web_url;?>shop/login/" rel="nofollow"><?php echo $Lable['login'];?></a>
					    <?php }?>
					</span>
					<?php echo CurList($db_conn,$web_url_mt,$Lable['currency']); ?> 
			     </div>
		    </div>
		</div>
		<div class="cb"></div>
		<div class="Ant_top_2 A100">
			<div class="Ant1200">
				<div class="Ant_top_logo"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>"></a> <span id="Anbutton"><i class="fa fa-bars" aria-hidden="true"></i></span> <span id="Asbutton"><i class="fa fa-search" aria-hidden="true"></i></span></div>
				<div class="Ant_top_nav"><?php echo Memu($db_conn,$lgid,$web_url_mt);?></div>
				<div class="Ant_top_right"><div><span><i class="fa fa-envelope" aria-hidden="true"></i></span>  
				<a href="mailto:<?php echo CheckStr_d($Cf['web_email']);?>" rel="nofollow"><?php echo CheckStr_d($Cf['web_email']);?></a></div></div>
		    </div>
		</div>
		<div class="cb"></div>
		<div class="Ant_top_3">
			<div class="Ant1200" style="position: relative;">
			<div class="sjl"></div>
			<div class="Ant_top_3_c">
				<div class="Ant_top_3_cat"><p><span class="list"><i class="fa fa-list" aria-hidden="true"></i></span> <?php echo $Lable['productcat'];?>  <i class="fa fa-angle-down" aria-hidden="true" id="sright"></i></p>
					<div class="Ant_Cat">
						<ul>
						<?php echo Get_Cat($lgid,$web_url,$db_conn); ?>
					    </ul>
					    <div class='cb'></div>
				    </div>
				</div>
				<div class="Ant_top_3_ser"><form method="post" action="<?php echo $web_url;?>search/"><input class="Ant_top_3_ser_ip" placeholder="<?php echo $Lable['seatext'];?>" type="text" name="search" id="search" ><input type="submit" value="<?php echo $Lable['search'];?>" id="subsearch" class="Ant_top_3_ser_sb trans"></form></div>
				<div class="Ant_top_3_cart"><span onclick="location.href='<?php echo $web_url;?>shop/user/?m=6';"><i class="fa fa-heart-o" aria-hidden="true"></i> (<font id="wishlists"><?php echo ReadCook(Ant_Cook('Cook_WhQz'));?></font>)</span><span onclick="location.href='<?php echo $web_url_mt;?>shop/cart/'"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <font id="mct"><?php echo $Lable['mycart'];?></font> (<font class="mycart"><?php echo ReadCook(Ant_Cook('Cook_Qz'));?></font>)</span></div>
			</div>
			<div class="sjr"></div>
		    </div>
		</div>
	</div>