<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
if (ReadCook(Ant_Cook('Cook_Qz'))<1){
  header('Location: '.$web_url_mt); 
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $Lable['checkout'];?></title>
	<meta charset="utf-8">
  <?php echo CheckStr_d($Cf['web_meate']);?>
  <script src="<?php echo $web_url_mt;?>Core/Js/jquery-3.5.1.min.js"></script>
  <script src="<?php echo $web_url_mt;?>Core/Js/Ant_shop.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Core/Css/font-awesome-47/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Css/scshop.css">
	<script src="<?php echo $web_url_mt;?>Template/<?php echo $webTemplate;?>/Js/Ant.js"></script>
</head>
<body>
<div class="Ant">
  <input type="hidden" id="lgid" value="<?php echo $lgid;?>">
  <input type="hidden" id="murl" value="<?php echo $web_url_mt;?>">
 	<!--top-->
  <div class="Ant_usre_top Ant1200"><div class="Ant_user_top_left"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>"></a></div><div class="Ant_user_top_right"><span>1</span> <?php echo $Lable['shoppingcart']; ?> <span class="slet">2</span> <?php echo $Lable['addplaceorder']; ?> <span id="splcorde">3</span><?php echo $Lable['checkout']; ?>  <span>4</span><?php echo $Lable['Completed']; ?></div><div class="cb"></div></div>
	<!--end-->
	<div class="cb"></div>
  <div class="Ant_user_content Ant1200">
    <div class="Ant_user_content_right">
 
    </div>
      <script type="text/javascript">
        ViewCart('<?php echo $web_url_mt;?>','<?php echo $lgid;?>');   
      </script>
    
    <div class="Ant_user_content_left">
      <div class="Ant_user_1">
        <div class="Ant_user_1_title" onclick="checkhideshow('login','ant_contacts','login','mem_1','');" id="mem_1"><span class="Ant_user_1_title_span trans ">1</span> <?php echo $Lable['contactinfo']?> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
        <div class="Ant_user_div A100" id="ant_contacts">
          <form method="post" id="userform"><ul id="userlogin"></ul></form>
         <script type="text/javascript">
             <?php if(empty($UID)){?>
                   htmlobj=$.ajax({url:"<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=Userlogin&lgid=<?php echo $lgid;?>&type=r",async:false}); 
                   $("#userlogin").html(htmlobj.responseText);    
             <?php }else{?>
                   htmlobj=$.ajax({url:"<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=Userinfo&lgid=<?php echo $lgid;?>",async:false}); 
                   $("#userlogin").html(htmlobj.responseText); 
              <?php }?>
         </script>
         <input type="hidden" value="<?php echo $UID; ?>" name="ant_userID" id="ant_userID">
        </div>
        <div class="Ant_user_1_title" onclick="checkhideshow('ant_userID','ant_address','<?php echo $Lable['loginoregedit'];?>','mem_2','mem_1');" id="mem_2" ><span class="Ant_user_1_title_s trans">2</span> <?php echo $Lable['shippingadress']?><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
         <div class="Ant_user_div A100" id="ant_address">
          <?php 
            echo '<li><span class="trans" id="userloginR" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=UserReg&lgid='.$lgid.'"><u onclick="usersAddress(\''.$lgid.'\',\''.$web_url_mt.'\');"><i class="fa fa-plus" aria-hidden="true"></i> '.$Lable['addadress'].'</u></span></li>';
          ?>
          <form method="post" id="AddressForm"><ul id="useraddress"></ul></form>
          <p id="addresslist"></p>
           <?php if(!empty($UID)){?>
          <script type="text/javascript">
                usersAddresslist('<?php echo $lgid;?>','<?php echo $web_url_mt;?>');
          </script>
          <?php } ?>          
        
        </div>     
        <div class="Ant_user_1_title" onclick="checkhideshow('ant_addressID','ant_express','<?php echo $Lable['selectaddress'];?>','mem_3','mem_2');" id="mem_3" ><span class="Ant_user_1_title_s trans">3</span> <?php echo $Lable['shippingmethod']?> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
         <div class="Ant_user_div A100 Ant_express" id="ant_express">
            <ul id="expressloding"></ul>
         </div>
         <div class="Ant_user_1_title" onclick="checkhideshow('ant_expressID','ant_payment','<?php echo $Lable['selectexpress'];?>','mem_4','mem_3');" id="mem_4" ><span class="Ant_user_1_title_s trans">4</span> <?php echo $Lable['paymethod']?> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>  
         <div class="Ant_user_div A100" id="ant_payment"><ul><?php echo CheckPay($db_conn,$web_url_mt);?></ul>
         <span class='Ant_placeorder trans' url="<?php echo $web_url_mt;?>Core/Program/Ant_Aajx.php?Antype=CheckOutOrder&lgid=<?php echo $lgid;?>" id="CkeckOutPayment" lable="<?php echo $Lable['selectpayment'];?>"><?php echo $Lable['checkout'];?></span> 

         </div>          
      </div>
    </div>


  </div>
	<div class="cb"></div>
    <!--bot-->
    <div class="Ant_user_bot Ant1200"><?php echo CheckStr_d($W_Cp);?></div>
    <!--end-->
</div>	
</body>
</html>