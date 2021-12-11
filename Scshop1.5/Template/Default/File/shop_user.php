<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
if(empty($UID)){
  header('Location: '.$web_url_mt."shop/login/");
}
if (isset($_GET['m'])){$m=$_GET['m'];}else{$m="";}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Lable['mymember'];?></title>
    <meta name="keywords" content="<?php echo $Lable['mymember'];?>" />
    <meta name="description" content="<?php echo $Lable['mymember'];?>" />
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
  <input type="hidden" id="lgid" value="<?php echo $lgid;?>">
  <input type="hidden" id="murl" value="<?php echo $web_url_mt;?>">
  <span class="Ant_user_left_nav"><i class="fa fa-bars" aria-hidden="true"></i></span>
  <!--top-->
  <div class="Ant_usre_top Ant1200"><div class="Ant_user_top_left"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>"></a></div><div class="Ant_user_top_right"><?php echo $Lable['orderunpaid']; ?> <span class="slet"><?php echo falgorder($db_conn,$UID,"pay");?></span>  <?php echo $Lable['ordesundelivered'];?> <span class="slet"><?php echo falgorder($db_conn,$UID,"sp");?></span></div><div class="cb"></div></div>
  <!--end-->
	<div class="cb"></div>
  	<div class="Ant_cart Ant1200">
  		<div class="cb"></div>
      <div class="Ant_user A100">
        <div class="Ant_user_left">
          <ul>
            <li><i class="fa fa-user-circle fa-5x" aria-hidden="true"></i></li>
            <li>Hi , <?php echo $_SESSION['antfistname']." ".$_SESSION['antlastname']; ?></li>
            <li><i class="fa fa-bars" aria-hidden="true"></i> <a href='?m=1'><?php echo $Lable['myorder']; ?></a></li>
            <li><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href='?m=2'><?php echo $Lable['myaddress']; ?></a></li>
            <li><i class="fa fa-user-o" aria-hidden="true"></i> <a href='?m=3'><?php echo $Lable['myaccount']; ?></a></li>
            <li><i class="fa fa-cube" aria-hidden="true"></i> <a href='?m=4'><?php echo $Lable['mycoupon']; ?></a></li>
            <li><i class="fa fa-comment-o" aria-hidden="true"></i> <a href='?m=5'><?php echo $Lable['mycomment']; ?></a></li>
            <li><i class="fa fa-heart-o" aria-hidden="true"></i> <a href='?m=6'><?php echo $Lable['mywish']; ?></a></li>
            <li><i class="fa fa-sign-out" aria-hidden="true"></i> <a href='javascript:;' id="userout" url='<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=Userout&lgid=<?php echo $lgid;?>'><?php echo $Lable['signout']; ?></a></li>          
          </ul>
         
        </div>
        <div class="Ant_user_right">

          <?php if($m == "" || $m == 1){ // order ?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['myorder'];?></div>
              <div class="cb"></div>
              <div class="Ant_user_order">
                <ul>
                  <li>ID.</li><li><?php echo $Lable['orderno']?></li><li><?php echo $Lable['orderdate']?></li><li><?php echo $Lable['addtotal']?></li><li><?php echo $Lable['orderpaymethod']?></li><li><?php echo $Lable['ordeshipped']?></li><li><?php echo $Lable['ordeoperation']?></li>
                </ul>
                <?php 
                $words=$Lable['addconfirm'].",".$Lable['addcancel'];
                echo mlistorder($UID,$db_conn,$lgid,$web_url_mt,$words);?>
              </div>
          <?php }elseif($m == 2){ //myaddress?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['myaddress'];?></div>
              <div class="cb"></div>
              <div class="Ant_user_address">
               <span class="trans Ant_user_addressa" id="userloginR" url="<?php echo $web_url_mt;?>Core/Program/Ant_Rponse.php?actions=UserReg&lgid=<?php echo $lgid;?>"><u onclick="usersAddress('<?php echo $lgid;?>','<?php echo $web_url_mt;?>');"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $Lable['addadress'];?></u></span> 
                <form method="post" id="AddressForm"><ul id="useraddress"></ul></form>
                <p id="addresslist"></p>
                 <?php if(!empty($UID)){?>
                <script type="text/javascript">
                      usersAddresslist('<?php echo $lgid;?>','<?php echo $web_url_mt;?>');
                </script>
                <?php } ?>  
          </div>
          <?php }elseif($m == 3){ ?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['myaccount'];?></div>
              <div class="cb"></div>
              <div class="Ant_user_account">
                <form  method="post" id="useredits">
                <ul>
                  <li><?php echo $Lable['emailadd'];?></li>
                  <li><input type="text" class="Ant_input" value="<?php echo $UEM; ?>" readonly="readonly" ></li>
                  <li><?php echo $Lable['firstname'];?> *</li>
                  <li><input type="text" name="me_firstname"  id="me_firstname" value="<?php echo $_SESSION['antfistname']; ?>" autocomplete="off" class="Ant_input"></li>
                  <li><?php echo $Lable['lastname'];?> *</li>
                  <li><input type="text" name="me_lastname" id="me_lastname" value="<?php echo $_SESSION['antlastname']; ?>"  autocomplete="off" class="Ant_input"></li>
                  <li><?php echo $Lable['oldpassword'];?> *</li>
                  <li><input type="password" name="me_paswd" id="me_paswd" autocomplete="off"  class="Ant_input"></li>
                   <li><?php echo $Lable['newpassword'];?> (<?php echo $Lable['optional'];?>)</li>
                  <li><input type="text" name="ne_paswd" id="ne_paswd" autocomplete="off"  class="Ant_input"></li>                 
                  <li class="Ant_user_sub"><span class="trans" id="useredit" url="<?php echo $web_url_mt;?>Core/Program/Ant_Rponse.php?actions=UserEdit&lgid=<?php echo $lgid; ?>" data="<?php echo $Lable['passwordleght'];?>" ><?php echo $Lable['save'];?></span></li>
                </ul>
                </form>
              </div>
              <div class="cb"></div>
          <?php }elseif($m == 4){ ?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['mycoupon'];?></div>
              <div class="cb"></div>
              <div class="Ant_user_coupon">
                <?php 
                $words=$Lable["expritime"].",".$Lable["addzk"].",".$Lable['mycoupon'];
                echo CheckAllCoupon($db_conn,$UEM,$words); 
                ?>
              </div>
              <div class="cb"></div>
         <?php } elseif($m == 5){?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['mycomment'];?></div>
              <div class="cb"></div>
              <div class="Ant_user_memtes">
                <?php echo ChekReviews_user($db_conn,$UEM,$web_url,$web_url_mt); ?>
              </div>
         <?php } elseif($m == 6){ ?>
            <div class="Ant_user_right_1"><i class="fa fa-location-arrow" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>"><?php echo $Lable['home'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?php echo $web_url_mt;?>shop/user/"><?php echo $Lable['mymember'];?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $Lable['mywish'];?></div>
              <div class="cb"></div>
              <div>
                <?php
                  $ProID = ReadCook(Ant_Cook('Cook_WhQz'),"wish");
                  $ProID = rtrim($ProID,",");
                  if (!empty($ProID)){
                     echo ListWish($db_conn,$web_url_mt,$web_url,$ProID,$lgid);
                  }
                 ?>
              </div>
         <?php } ?>
        </div>
        <div class="cb"></div>
      </div>
 
  	</div>
	<div class="cb"></div>
    <!--bot-->
    <div class="Ant_user_bot Ant1200"><?php echo CheckStr_d($W_Cp);?></div>
    <!--end-->
</div>	
</body>
</html>