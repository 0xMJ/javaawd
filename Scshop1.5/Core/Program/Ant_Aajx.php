<?php
session_start();
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
include_once 'Include.php';
include_once 'Ant_Fc.php';
$web_url_mt=str_replace("Core/Program/", "", $web_url_mt);
if (isset($_GET['Antype'])){$Antype = $_GET['Antype'];}else{$Antype = "";}

if(!empty($Antype)){

	//设置汇率
	if($Antype == "Cur"){
		if (isset($_GET['Antvalue'])){$Antvalue = $_GET['Antvalue'];}else{$Antvalue = "";}
		if(!empty($Antvalue)){
			setcookie("CurID",$Antvalue, Ant_Cook('Expire'), Ant_Cook('Path'),Ant_Cook('Domain'));
		}
	}

	//写入Cookies
	if($Antype == "WriteCk"){
	  $str = $_POST;
	  $Ck  = ""; 
      if (!empty($str)){ //页面提交
			$sts=explode(",", $str['canshu']);
			foreach ($sts as $value) {
				if ($value!="qty"){
					$Ck.=":".$str[$value];
			     }
			}
  			$Ck_Value = $str['qty'];
  			$Ck_Name=Ant_Cook('Cook_Qz').$str['pid'].$Ck; //格式为->sc_123:7_23:8_25
            setcookie($Ck_Name,$Ck_Value, Ant_Cook('Expire'), Ant_Cook('Path'),Ant_Cook('Domain'));
            AddCart_Data($UEM,$Ck_Name,$Ck_Value,$db_conn);
  		    echo '<i class="fa fa-check" aria-hidden="true"></i> <br>'.$Lable['addcartdes'];
		}else{ //购物车提交
			if (isset($_GET['CkName']) && isset($_GET['Ckvalue'])){
				setcookie($_GET['CkName'],$_GET['Ckvalue'], Ant_Cook('Expire'), Ant_Cook('Path'),Ant_Cook('Domain'));
                AddCart_Data($UEM,$_GET['CkName'],$_GET['Ckvalue'],$db_conn);
			}
		}
	}
  //写入wishlist cookies
  if($Antype == "WriteCkWh"){
      setcookie(Ant_Cook('Cook_WhQz').$_GET['value'],$_GET['value'], Ant_Cook('Expire')+3600*24*365, Ant_Cook('Path'),Ant_Cook('Domain'));
  }
  //删除wishlist cookies
  if($Antype == "ClearCkWh"){
      setcookie(Ant_Cook('Cook_WhQz').$_GET['value'],"", Ant_Cook('Expire')-3600*24*365, Ant_Cook('Path'),Ant_Cook('Domain'));
  }
  //读取wishlist 数量
  if($Antype == "ReadCkWh"){
       echo ReadCook(Ant_Cook('Cook_WhQz'));
  }

    //读Cookie数量
    if($Antype == "ReadCk"){
       echo ReadCook(Ant_Cook('Cook_Qz'));
    }

    //购物车显示
    if($Antype == "ViewCart"){
       $words = array('product' =>$Lable['addproduct'] , 'price'=>$Lable['addprice'],'total'=>$Lable['addtotal'],'subtotal'=>$Lable['addsutotal'],'comfirm'=>$Lable['addconfirm'],'cancel'=>$Lable['addcancel'],'addqty'=>$Lable['addqty'],'addempty'=>$Lable['addempty'],'addcontinue'=>$Lable['addcontinue'],'mycart'=>$Lable['mycart'],'sevices'=>CheckStr_d($SeoSet['tag_service']),'placeoder'=>$Lable['addplaceorder']);
       echo ViewCart(Ant_Cook('Cook_Qz'),$db_conn,"cart",str_replace("Core/Program/", "", $web_url_mt),$words,$lgid);
     }

    //结算页显示购物车信息 
    if($Antype == "CheckCart"){
       $words = array('product' =>$Lable['addproduct'] , 'price'=>$Lable['addprice'],'total'=>$Lable['addtotal'],'subtotal'=>$Lable['addsutotal'],'comfirm'=>$Lable['addconfirm'],'cancel'=>$Lable['addcancel'],'addqty'=>$Lable['addqty'],'addempty'=>$Lable['addempty'],'addcontinue'=>$Lable['addcontinue'],'mycart'=>$Lable['mycart'],'sevices'=>CheckStr_d($SeoSet['tag_service']),'checkout'=>$Lable['checkout'],'freight'=>$Lable['freight'],'apply'=>$Lable['Apply'],'discountcode'=>$Lable['discountcode'],'nodiscountcode'=>$Lable['nodiscountcode'],'Discount'=>$Lable['addzk']);
       echo ViewCart(Ant_Cook('Cook_Qz'),$db_conn,"view",$web_url_mt,$words,$lgid);
     }

    //删除购物车
     if($Antype == "ClearCart"){
     	if (isset($_GET['CkName'])){
            setcookie($_GET['CkName'],"", time()-Ant_Cook('Expire'), Ant_Cook('Path'),Ant_Cook('Domain'));
        }
     }

     //用户注册登陆
     if($Antype == "Userlogin"){
     	$str="";
     	if (isset($_GET['type'])){$type=$_GET['type'];}else{$type="";}
     	if($type=="l"){
     	$str ='<li class="Ant_sing"><span class="Ant_color" onclick="rl(\'l\',\''.$lgid.'\',\''.$web_url_mt.'\')">'.$Lable['login'].'</span><span onclick="rl(\'r\',\''.$lgid.'\',\''.$web_url_mt.'\')">'.$Lable['regedit'].'</span></li>
     	    <li>'.$Lable['emailadd'].' *</li>
            <li><input type="text" class="Ant_input" name="me_email" id="me_email"></li>
            <li>'.$Lable['userpass'].' *</li>
            <li><input type="password" class="Ant_input" name="me_paswd" id="me_paswd"></li>            
            <li class="Ant_user_sub" ><span class="trans" data="'.$Lable['passwordleght'].'" id="userloginR" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=UserLogin&lgid='.$lgid.'">'.$Lable['login'].'</span></li> ';
        }elseif($type=="r"){
     	$str = '<li class="Ant_sing"><span onclick="rl(\'l\',\''.$lgid.'\',\''.$web_url_mt.'\')">'.$Lable['login'].'</span><span onclick="rl(\'r\',\''.$lgid.'\',\''.$web_url_mt.'\')" class="Ant_color">'.$Lable['regedit'].'</span></li>
            <li>'.$Lable['firstname'].' *</li>
            <li><input type="text" class="Ant_input" name="me_firstname" id="me_firstname"></li>
            <li>'.$Lable['lastname'].' *</li>
            <li><input type="text" class="Ant_input" name="me_lastname" id="me_lastname"></li>
            <li>'.$Lable['emailadd'].' *</li>
            <li><input type="text" class="Ant_input" name="me_email" id="me_email"></li>
            <li>'.$Lable['userpass'].' *</li>
            <li><input type="password" class="Ant_input" name="me_paswd" id="me_paswd"></li>            
            <li class="Ant_user_sub" ><span class="trans"  id="userloginR" data="'.$Lable['passwordleght'].'" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=UserReg&lgid='.$lgid.'">'.$Lable['regedit'].'</span></li>';
         }
         echo $str;
     }

     if($Antype == "Userinfo"){

        echo "<li>Hi, ".$_SESSION['antfistname']." ".$_SESSION['antlastname']."</li><li>".$Lable['emailadd']." : ".$_SESSION['antuser']."</li><li class='Ant_user_sub'><span class='trans' id='userout' url='".$web_url_mt."Core/Program/Ant_Aajx.php?Antype=Userout&lgid=".$lgid."'>".$Lable['signout']."</span></li>";
     }

    //用户评论
    if($Antype == "Reviews"){

      if(isset($_SESSION['antfistname'])){$yourname=$_SESSION['antfistname']." ".$_SESSION['antlastname'];$mail=$UEM;}else{$yourname="";$mail="";}
      $msg_pid=CheckStr($_GET['value']);
      echo '<div><form method="post" id="previews" ><ul>
      <li id="reshow"></li>
      <li>'.$Lable['rating'].'</li>
      <li class="rerating"><i class="fa fa-star" aria-hidden="true" id="r_1" val="1"></i><i class="fa fa-star" aria-hidden="true" id="r_2" val="2"></i><i class="fa fa-star" aria-hidden="true" id="r_3" val="3"></i><i class="fa fa-star" aria-hidden="true" id="r_4" val="4"></i><i class="fa fa-star-o" aria-hidden="true" id="r_5" val="5"></i><input type="hidden" name="msg_rating" id="msg_rating" value="4"></li>
      <li>'.$Lable['uname'].' *</li>
      <li><input type="text" class="Ant_input" name="msg_name" id="msg_name" value="'.$yourname.'"></li>
      <li>'.$Lable['emailadd'].' *</li>
      <li><input type="text" class="Ant_input" name="msg_email" id="msg_email" value="'.$mail.'"></li>
      <li>'.$Lable['areviews'].' *</li>
      <li><textarea class="Ant_inputare" name="msg_content" id="msg_content"></textarea></li>
      <li class="Ant_user_sub"><span class="trans" onclick="cancelAddress();" >'.$Lable['addcancel'].'</span><span class="trans" id="reviews" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=ReviewsAdd&lgid='.$lgid.'&type=Add">'.$Lable['save'].'</span><input type="hidden" value="'.$msg_pid.'" name="msg_pid" id="msg_pid"><input type="hidden" name="msg_flag" value="p"><input type="hidden" name="languageID" value="'.$lgid.'"></li></ul></form></div>';

    }

    //联系我们在线留言
    if($Antype == "Contacts"){

      if(isset($_SESSION['antfistname'])){$yourname=$_SESSION['antfistname']." ".$_SESSION['antlastname'];$mail=$UEM;}else{$yourname="";$mail="";}

      echo '<div class="ct"><form method="post" id="previews" ><ul>

      <li id="reshow"></li>
      <li><h2>'.$Lable['acomments'].' </h2></li>
      <li>'.$Lable['uname'].' *</li>
      <li><input type="text" class="Ant_input" name="msg_name" id="msg_name" value="'.$yourname.'"></li>
      <li>'.$Lable['emailadd'].' *</li>
      <li><input type="text" class="Ant_input" name="msg_email" id="msg_email" value="'.$mail.'"></li>
      <li>'.$Lable['acomments'].' *</li>
      <li><textarea class="Ant_inputare" name="msg_content" id="msg_content"></textarea></li>
      <li class="Ant_user_sub"> <span class="trans" id="reviews" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=ReviewsAdd&lgid='.$lgid.'&type=Add">'.$Lable['save'].'</span><input type="hidden" name="msg_flag" value="m"><input type="hidden" name="languageID" value="'.$lgid.'"></li></ul></form><div class="cb"></div></div>';

    }

     //用户地址
     if($Antype == "UserAddress"){
        if(empty($UID)){echo "<script>alert('".$Lable['resigin']."');window.location.reload();</script>";exit;}//超时控制
        if (isset($_GET['type'])){$type=$_GET['type'];}else{$type="";}
        if($type == "add"){
            $address ='<li>'.$Lable['firstname'].' *</li>
            <li><input type="text" name="add_firstname" id="add_firstname" value="'.$_SESSION['antfistname'].'" class="Ant_input"></li>
             <li>'.$Lable['lastname'].' *</li>
            <li><input type="text" name="add_lastname" id="add_lastname" value="'.$_SESSION['antlastname'].'"  id="add_dress" class="Ant_input"></li>
             <li>'.$Lable['ucompany'].'</li>
            <li><input type="text" name="add_company" id="add_company" class="Ant_input"></li>
             <li>'.$Lable['fulladdress'].' *</li>
            <li><input type="text" name="add_dress" id="add_dress" class="Ant_input"></li>
             <li>'.$Lable['city'].' *</li>
             <li><input type="text" name="add_city" id="add_city" class="Ant_input"></li> 
            <li>'.$Lable['state'].' *</li>
            <li><input type="text" name="add_state" id="add_state" class="Ant_input"></li>
             <li>'.$Lable['zip'].' *</li>
            <li><input type="text" name="add_zipcode" id="add_zipcode" class="Ant_input"></li>
            <li>'.$Lable['region'].' *</li>
            <li>'.ViewCountry($db_conn,"").'</li>
            <li>'.$Lable['phone'].' *</li>
            <li><input type="text" name="add_tel" id="add_tel" class="Ant_input"></li>
            <li class="Ant_user_sub"><span class="trans" onclick="cancelAddress();" >'.$Lable['addcancel'].'</span><span class="trans" id="adduseraddress" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=UserAddress&lgid='.$lgid.'&type=add">'.$Lable['save'].'</span><input type="hidden" value="'.$UID.'" name="userID" id="userID"></li>';
            echo CheckStr_d($address);           
        }elseif($type =="edit"){
            if(isset($_GET['id'])){
                $ID=$_GET['id'];
                $str = ReadInfo($db_conn,"*","sc_address","where userID=$UID and ID=$ID","");
                if (!empty($str)){
                    $address ='<li>'.$Lable['firstname'].' *</li>
                    <li><input type="text" name="add_firstname" value="'.$str[0]['add_firstname'].'" id="add_firstname" class="Ant_input"></li>
                     <li>'.$Lable['lastname'].' *</li>
                    <li><input type="text" name="add_lastname" value="'.$str[0]['add_lastname'].'" id="add_lastname" id="add_dress" class="Ant_input"></li>
                     <li>'.$Lable['ucompany'].'</li>
                    <li><input type="text" name="add_company" value="'.$str[0]['add_company'].'" id="add_company" class="Ant_input"></li>
                     <li>'.$Lable['fulladdress'].' *</li>
                    <li><input type="text" name="add_dress" value="'.$str[0]['add_dress'].'"  id="add_dress" class="Ant_input"></li>
                     <li>'.$Lable['city'].' *</li>
                     <li><input type="text" name="add_city" value="'.$str[0]['add_city'].'" id="add_city" class="Ant_input"></li> 
                    <li>'.$Lable['state'].' *</li>
                    <li><input type="text" name="add_state" value="'.$str[0]['add_state'].'" id="add_state" class="Ant_input"></li>
                     <li>'.$Lable['zip'].' *</li>
                    <li><input type="text" name="add_zipcode" value="'.$str[0]['add_zipcode'].'" id="add_zipcode" class="Ant_input"></li>
                    <li>'.$Lable['region'].' *</li>
                    <li>'.ViewCountry($db_conn,$str[0]['add_contry']).'</li>
                    <li>'.$Lable['phone'].' *</li>
                    <li><input type="text" name="add_tel" value="'.$str[0]['add_tel'].'" id="add_tel" class="Ant_input"></li>
                    <li class="Ant_user_sub"><span class="trans" onclick="cancelAddress();" >'.$Lable['addcancel'].'</span><span class="trans" id="adduseraddress" url="'.$web_url_mt.'Core/Program/Ant_Rponse.php?actions=UserAddress&lgid='.$lgid.'&type=edit">'.$Lable['save'].'</span><input type="hidden" value="'.$ID.'" name="ID" id="ID"></li>';
                    echo CheckStr_d($address); 
               }  
          }
       }

     }

//查询物流地址
 if($Antype == "UserAddressShow"){
    $Address="";
  if (!empty($UID)){
    $str = ReadInfo($db_conn,"*","sc_address","where userID=$UID","order by ID desc");
    if(!empty($str)){
      for ($i=0; $i <count($str) ; $i++) { 
        $Address.="<div class='Ant_member_address'><input type='radio' name='MAddress'  value='".$str[$i]['ID']."'> ".$str[$i]['add_firstname']." ".$str[$i]['add_lastname']."<span ><i class='fa fa-pencil-square-o' aria-hidden='true' onclick=\"usersAddressedit('".$lgid."','".$web_url_mt."','".$str[$i]['ID']."');\"></i> <i class='fa fa-trash-o' aria-hidden='true' onclick=\"userAddressclose('".$lgid."','".$web_url_mt."','".$str[$i]['ID']."');\"></i></span><br>
        ".$str[$i]['add_dress']." , ".$str[$i]['add_city']." , ".$str[$i]['add_state']." , ".ConutryName($db_conn,$str[$i]['add_contry'])." , ".$str[$i]['add_zipcode']."<br>
        ".$str[$i]['add_tel']."<br>
        ".$str[$i]['add_company']."
        </div>";
      } 
    }
}
  echo CheckStr_d($Address);
}

//国家ID 存Session
 if($Antype == "CountrySession"){
    if(isset($_GET['counid'])){
        $_SESSION['CountryID']=$_GET['counid'];
    }
  }

//运费+产品价格计算

 if($Antype == "totalSession"){
    if(isset($_GET['price'])){
        if(isset($_GET['discoderprice'])){
             $fh=ChangeCur($db_conn,"1","fh");
             $disprice = str_replace("-".$fh, "", $_GET['discoderprice']);
             $price=sprintf("%.2f",$_GET['price']+$_SESSION['Ant_Total']-$disprice);
        }else{
             $price=sprintf("%.2f",$_GET['price']+$_SESSION['Ant_Total']);
        }
        echo ChangeCur($db_conn,$price,"fh").$price;
    }
  }

 if($Antype == "freightSession"){
    if(isset($_GET['price'])){
        $price=$_GET['price'];
        echo ChangeCur($db_conn,$price,"fh").$price;
    }
  }

 //优惠费用 产品总价-优惠费用 

 if($Antype == "couponprice"){
    if(isset($_GET['price'])){
        $fh=ChangeCur($db_conn,"1","fh");
        $allprice  = str_replace($fh, "", $_GET['taol']);
        $disprice  = str_replace($fh, "", $_GET['price']);
        $allprices = sprintf("%.2f",$allprice-$disprice);
        echo $fh.$allprices;
    }
  }

//取消优惠

 if($Antype == "cancelcoupon"){
    if(isset($_GET['price'])){
        $fh=ChangeCur($db_conn,"1","fh");
        $allprice  = str_replace($fh, "", $_GET['taol']);
        $disprice  = str_replace("-","",str_replace($fh, "", $_GET['price']));
        $allprices = sprintf("%.2f",$allprice+$disprice);
        echo $fh.$allprices;
    }
  }

//function CheckExpress($db_conn,$counid,$Weight,$web_url_mt,$exflag,$total,$express=""){ //$total 订单金额 //$exflag 免运方式

//物流计算
    if ($Antype == "CheckExpress"){
      $wgs="";
        if(empty($UID)){echo "<script>alert('".$Lable['resigin']."');window.location.reload();</script>";exit;} //超时控制
        $express="";
        $counid = $_SESSION['CountryID'];
        $total  = $_SESSION['Ant_Total'];
        $Weight = $_SESSION["Ant_Weight"];
        $exflag = Checkfreeship($db_conn);
        $ExpID = @$_GET['ExpID'];

    // echo CheckExpress($db_conn,1,12,$web_url_mt,1,120); 
     $str = ReadInfo($db_conn,"*","sc_express","where ex_flag=1","order by ex_paixu,ID desc");
     if (!empty($str)){
       for ($i=0; $i <count($str) ; $i++) {
           $ID=$str[$i]['ID'];
           if ($ExpID==$ID){$sle=" checked";}else{$sle="";}
          if ($exflag==1){
               $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
               if (!empty($strs)){
                 $wgs=$strs[0]['de_jsfs'];
                 if (!empty($wgs)){
                    $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
                    $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,eval("return $wgs;")).'<input type="radio" name="express" price="'.ChangeCur($db_conn,eval("return $wgs;"),"no").'" '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
                 }
             }
          }elseif($exflag==2){
                  $strs = ReadInfo($db_conn,"*","sc_freeship","where ID=1","");
                  $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,$strs[0]['free_price']).'<input type="radio" name="express" price="'.ChangeCur($db_conn,$strs[0]['free_price'],"no").'"  '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
          }elseif($exflag==3){
                  $strs = ReadInfo($db_conn,"*","sc_freeship","where ID=1","");
                  if ($total > $strs[0]['free_price']){
                    $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,0).'<input type="radio" name="express" price="'.ChangeCur($db_conn,0,"no").'" '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
                 }else{
                   $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
                   if (!empty($strs)){
                   $wgs=$strs[0]['de_jsfs'];
                     if (!empty($wgs)){
                        $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
                        $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,eval("return $wgs;")).'<input type="radio" name="express"  price="'.ChangeCur($db_conn,eval("return $wgs;"),"no").'"  '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
                     }
                  }
                 }
          }elseif($exflag==4){

                  $strs = ReadInfo($db_conn,"*","sc_country","where ID=$counid","");
                  if ($total > $strs[0]['exprssyf'] && $strs[0]['exprssyf']!=0){ 
                    $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,0).'<input type="radio" name="express" price="'.ChangeCur($db_conn,0,"no").'" '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
                 }else{
                   $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
                    if (!empty($strs)){
                       $wgs=$strs[0]['de_jsfs'];
                       if (!empty($wgs)){
                          $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
                          $express.='<li class="Ant_expressli"><img src="'.$web_url_mt.str_replace("../", "", rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['ex_name'].'"> <span>'.$str[$i]['ex_des'].'</span><span>'.ChangeCur($db_conn,eval("return $wgs;")).'<input type="radio" name="express" price="'.ChangeCur($db_conn,eval("return $wgs;"),"no").'" '.$sle.' value="'.$str[$i]['ID'].'"></span></li>';
                       }
                  }
                 }
          }
       }
       echo CheckStr_d($express);  
     }
    }
 
    //优惠券查询
     if($Antype == "Counpon"){
        if(empty($UID)){echo "<script>alert('".$Lable['resigin']."');window.location.reload();</script>";exit;} //超时控制
        if(isset($_GET['discoupon'])){
            $discount = CheckStr($_GET['discoupon']);
            echo Checknewsletter($db_conn,$_SESSION['antuser'],$discount,$_SESSION['Ant_Total']);
       }
     }

     //会员中心订单显示详细

    if($Antype == "ViewOrder"){
        if(isset($_GET['orderno'])){
          $plist="";
          $orderno = $_GET['orderno'];
            $str = ReadInfo($db_conn,"*","sc_order","where order_number='$orderno' and userID=$UID","");
            if(!empty($str)){
              $ProID =explode(",",rtrim($str[0]['order_productID'],",")); //产品ID
              $ProQty =explode(",", rtrim($str[0]['order_productsl'],",")); //产品数量
              $ProPrice = explode(",", rtrim($str[0]['order_productdjg'],",")); //产品单价
              $ProSuxin = explode("||", $str[0]['order_sx']);
              $ProSub = explode(",", rtrim($str[0]['order_price'],",")); //产品小 计
              $ProTotal = $str[0]['order_prodctzj']; //总价
              $Pfeight = $str[0]['order_shipprice']; //运费
              $Pdiscou = $str[0]['order_dis'];       //折扣
              $curry   = $str[0]['order_curry'];
              if($str[0]['order_flag']==0){
                $orderflag= $Lable['orderunpaid']; 
              }else{
                $orderflag= $Lable['orderpaid'];
              }
              $Payfs=explode("_", $str[0]['order_payfs']);

              if(!empty($str[0]['order_exnb'])){ //物流单号
                $trnb="<br><b>tracking number : </b>".$str[0]['order_exnb'];
              }else{
                $trnb="";
              }

              if(!empty($str[0]['order_message'])){ //客户留言
                $mesg="<b>".$Lable['acomments']."</b><br>".$str[0]['order_message'];
              }else{
                $mesg="";
              }

              $plist_0 = "<ul><li> <span><b>".$Lable['orderno']." : </b>".$orderno."</span> <span>".$str[0]['order_time']."</span>  <span>".$payM[$Payfs[0]]."</span> <span>".$orderflag."</span></li></ul>";
              $plist_1 = "<ul><li><span>".$_SESSION['antuser']."<br>".$str[0]['order_shipadd']."</span><span>".$mesg."<br>".CheckExp($db_conn,$str[0]['order_express'])."<br>".$trnb."</span></li></ul>";
              for ($i=0; $i <count($ProID) ; $i++) {
                  $ID=$ProID[$i];
                  $strs = ReadInfo($db_conn,"*","sc_products","where ID=$ID","");
                  if(!empty($strs)){
                    $imgs = explode(",", str_replace("produt/", "product/small/", $strs[0]['ant_img']));
                    $img = $web_url_mt.str_replace("../", "", $imgs[0]);
                    $pnm = $strs[0]['products_name'];
                    $j=$i+1;
                    $plist .="<li><span>".$j."</span><span><img src='".$img."'></span><span>".$pnm."<br>".$ProSuxin[$i]."</span><span>".$curry.$ProPrice[$i]." x ".$ProQty[$i]."</span><span>".$curry.$ProSub[$i]."</span></li>";
                  }
              }
              $plist_2="<li><b>".$Lable['addsutotal']." : </b>".$curry.sprintf("%.2f",$ProTotal+$Pdiscou-$Pfeight)."</li>";
              $plist_3="<li><b>".$Lable['freight']." : </b>".$curry.$Pfeight."</li>";
              if(!empty($Pdiscou)){
                $plist_4="<li><b>".$Lable['addzk']."</b> - ".$curry.$Pdiscou."</li>";
              }else{
                $plist_4="";
              }
              $plist_5="<li><b>".$Lable['addtotal']." : </b>".$curry.$ProTotal."</li>";

              echo CheckStr_d($plist_0.$plist_1."<ul>".$plist."</ul><ul>".$plist_2.$plist_3.$plist_4.$plist_5."</ul>");
            }
        }else{
          echo 'err-err';
        }

    }


//折扣 ajax

if($Antype == "ZKAjax"){
       if(isset($_GET['zeke'])){
          $wdpric = $_GET['wdpric'];
                            $up="";$down="";$disos="";$ups="";
                            $zeke=explode(",", $_GET['zeke']);
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
                            
                         echo'<table cellspacing="0" class="table">
                                <tr><td width="25%" >'.$Lable['addqty'].'</td>'.$up.'</tr>
                                <tr><td >'.$Lable['addzk'].'</td>'.$disos.'</tr>
                                <tr><td >'.$Lable['wholeprie'].'</td>'.$down.'</tr>
                            </table>
                            <input type="hidden" value='.rtrim($ups,",").'" id="wholeprice"> ';

                        }


}


     //用户退出
    if($Antype == "Userout"){
        unset($_SESSION['antuser']);
        unset($_SESSION['antpass']);
        unset($_SESSION['antfistname']);
        unset($_SESSION['antlastname']);
     }

}

 