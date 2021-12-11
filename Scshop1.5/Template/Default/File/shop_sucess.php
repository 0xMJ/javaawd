<?php
session_start();
include_once  '../../../Core/Program/Include.php';
include_once  '../../../Template/'.$webTemplate.'/File/Function.php';
$Ant=new WD_Data_Process();
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
  <div class="Ant_usre_top Ant1200"><div class="Ant_user_top_left"><a href="<?php echo $web_url_mt;?>"><img src="<?php echo $web_url_mt;?><?php echo str_replace("../", "", $Cf['web_logo']);?>" alt="<?php echo $Cf['web_name'];?>"></a></div><div class="Ant_user_top_right"></div></div>
  <!--end-->



<?php

if(isset($_SESSION['Ant_Alltotal']) && isset($_SESSION['Ant_Ordernb'])){
    
?>


    <div class="Ant_success">
        
        <ul>
                <li><i class="fa fa-check-circle fa-5x" aria-hidden="true" ></i></li>
                <li><h2><?php echo $Lable['ordersucess'];?></h2></li>
                <li><?php echo $Lable['emailadd'];?> : <?php echo $_SESSION['antuser'];?></li>
                 <li><?php echo $Lable['orderno'];?> : <?php echo $_SESSION['Ant_Ordernb'];?></li>
                 <li><?php echo $Lable['addtotal'];?> : <?php echo $_SESSION['Ant_Alltotal'];?></li>
                 <li><span class="trans returnhome" onclick="window.location.href='<?php echo $web_url_mt;?>';"><?php echo $Lable['returnhome'];?></span>  </li>
                 <li><span class="trans closewindow" onclick="window.location.href='<?php echo $web_url_mt;?>shop/user/';"><?php echo $Lable['mymember']; ?></span>  </li>

        </ul>


    </div>
<?php

if ($_SESSION['Ant_Paymd']==1){ //paypal付款 执行

   //改变付款状态
    $fh = ChangeCur($db_conn,"0","fh");
    $Tal = str_replace($fh, "", $_SESSION['Ant_Alltotal']);
    $where = " order_number='".$_SESSION['Ant_Ordernb']."' and order_prodctzj='".$Tal."'";
    $Ant->AntEditGen("sc_order","order_flag=1",$where,$db_conn);

   if($M_Open==1){ //邮件发送给自已
       $M_Title   = $_SESSION['Ant_Ordernb']."付款成功";
       $M_Content = "订单号 : ".$_SESSION['Ant_Ordernb']."<br>金额 : ".$_SESSION['Ant_Alltotal']." <br>详细信息进网站后台查看！！！";
       SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$M_Jmail,$M_Title,$M_Content); //发送给自已
    }

}
    //清空 session ;
    unset($_SESSION['Ant_Alltotal']);
    unset($_SESSION['Ant_Ordernb']);
    unset($_SESSION['Ant_Paymd']);
    
}else{
    header('Location: '.$web_url_mt);
}?>


    <div class="cb"></div>
    <!--bot-->
    <div class="Ant_user_bot Ant1200"><?php echo CheckStr_d($W_Cp);?></div>
    <!--end-->
</div>  
</body>
</html>


 