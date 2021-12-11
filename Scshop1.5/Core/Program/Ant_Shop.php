<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
//汇率转换
function ChangeCur($db_conn,$price,$style=""){
	$Prices="";
	if (isset($_COOKIE['CurID'])){
		$CurID = $_COOKIE['CurID'];
		$str = ReadInfo($db_conn,"*","sc_currency","where currency_flag=1 and ID=$CurID","");
        if($style=="no"){
          $Prices=sprintf("%.2f",$price*$str[0]['currency_hl']);
        }elseif($style=="fh"){
          $Prices=$str[0]['currency_left_fh'];
        }elseif($style=="bzfh"){
          $Prices=$str[0]['currency_bz_fh'];
        }else{
      	  $Prices=$str[0]['currency_left_fh'].sprintf("%.2f",$price*$str[0]['currency_hl']);
        }
	}else{
		$str = ReadInfo($db_conn,"*","sc_currency","where currency_flag=1 and currency_default=1","");
		if(!empty($str)){
				if($style=="no"){
          $Prices=sprintf("%.2f",$price*$str[0]['currency_hl']);
        }elseif($style=="fh"){
           $Prices=$str[0]['currency_left_fh'];
        }elseif($style=="bzfh"){
          $Prices=$str[0]['currency_bz_fh'];
        }else{
          $Prices=$str[0]['currency_left_fh'].sprintf("%.2f",$price*$str[0]['currency_hl']);
        }
		}
	}
	return $Prices;
}

//查询Cookie个数
function ReadCook($str,$type="",$i=0){
  $Ck=$_COOKIE;$id="";
  foreach ($Ck as $key=>$value) {
     if(strpos($key,$str) !== false){ //查询cookie
        if($type=="wish"){
          $id.=$value.",";
        }else{
          $i=$i+1; //统计个数
        } 
      }
  }
  if($type=="wish"){
    return $id;
   }else{
     return $i;
   }
}

$payM= array('1' =>'Paypal' ,'2' =>'Western Union');


   // 弃用
   // foreach ($Ck as $key=>$value) {
   //     if(strpos($key,$str) !== false){ //查询cookie
 
   //       $keys=$key.",";
   //       echo $keys;
   //        if(strpos($key,":") !== false){
   //            $keys=explode(":", $key);
   //            for ($i=1; $i <count($keys) ; $i++) { 
   //                $sxID = explode("_", $keys[$i]);
   //                $SID .= $sxID[1]."||";
   //            }
   //            $pid .= str_replace($str, "", $keys[0]).",";
   //        }else{
   //        	  $SID.="||"; //给空值
   //            $pid .= str_replace($str, "", $key).",";
   //        }
   //        $SID=$SID.",";
   //        $val.=$value.",";
   //        $keyn.=$key.",";
   //      }
   //  }

//购物车显示
function ViewCart($str,$db_conn,$type,$web_url_mt,$words,$lgid){
  $Ck=$_COOKIE;$sx="";$plist="";$SID="";$pid="";$val="";$keyn="";$Cknames="";
   foreach ($Ck as $key=>$value) {
       if(strpos($key,$str) !== false){ //查询cookie
         	$Cknames.=$key.",";
        }
      }
       if (!empty($Cknames)){
	    $Ckname=rtrim($Cknames,","); //重组cookie 进行排序 防止不同浏览器 加数量的时候跳动产品
	    $Cknames=explode(",", $Ckname);
	    sort($Cknames); //数组排序
 		foreach ($Cknames as $value) {
          if(strpos($value,":") !== false){
              $keys=explode(":", $value);
              for ($i=1; $i <count($keys) ; $i++) { //查询属性
                  $sxID = explode("_", $keys[$i]);
                  $SID .= $sxID[1]."||";
              }
              $pid .= str_replace($str, "", $keys[0]).",";
          }else{
          	  $SID.="||"; //没有属性的给空值
              $pid .= str_replace($str, "", $value).","; 
          }
          $SID=$SID.",";
          $val.=$Ck[$value].",";
          $keyn.=$value.",";
 		}
	 	  $val = rtrim($val,",");   //购物车数量
	    $pid = rtrim($pid,",");   //产品ID
	    $SID  = rtrim($SID,",");  //属性ID
	    $keyn = rtrim($keyn,","); //Cookie名称
 	}

    if(!empty($pid)){ //是否空
    	$plist= CheckProduct($pid,$db_conn,$SID,$val,$type,$web_url_mt,$words,$keyn,$lgid);
    }else{
    	$plist= "<div class='Ant_empty_cart'><ul><li><h3>".$words['mycart']."</h3></li><li>".$words['addempty']."</li><li onclick=location.href='".$web_url_mt."'; ><span>".$words['addcontinue']." <i class='fa fa-long-arrow-right' aria-hidden='true'></i></span></li></ul></div>";
    }
    return CheckStr_d($plist);
}

//Cookie 查询属性
function CheckSuxin($db_conn,$ID,$SName="",$ptName=""){
  //属性
  $str = ReadInfo($db_conn,"*","sc_property","where ID=$ID","");
  if(!empty($str)){
    $ptName = $str[0]['pt_name'];
    $sx_ID  = $str[0]['suxin_id'];
  //属性名称
   $strs = ReadInfo($db_conn,"*","sc_suxin","where ID=$sx_ID","");
   if(!empty($strs)){
    $suName = $strs[0]['sx_name'];
   }
  }

  if ($ptName!="" && $suName!=""){
      $SName = '<i class="fa fa-genderless" aria-hidden="true"></i> '.$suName.' : '.$ptName;
  }
  return CheckStr_d($SName);
}

//Cookie 查询属性价格 (2021-07-08)
function CheckSuxinPr($db_conn,$ID,$ptPrice=""){
  //属性
  $str = ReadInfo($db_conn,"*","sc_property","where ID=$ID","");
  if(!empty($str)){
 
    $ptPrice  = $str[0]['pt_price'];
 
  }

  return CheckStr_d($ptPrice);
}


//产品列表查询一个属性
function CheckOneSxin($db_conn,$ID,$itemnub,$sx=""){
  $SXID=explode(",", $ID);
  foreach ($SXID as $value) {
      $strs = ReadInfo($db_conn,"*","sc_property","where suxin_id=$value and itemnb='$itemnub'","");
      if (!empty($strs)){
          $sx.=$value."_".$strs[0]['ID'].":";  //格式组合
      }
   }
   return rtrim($sx,":");
}
//查询产品 
function CheckProduct($ID,$db_conn,$sx,$qty,$type,$web_url_mt,$wd,$keyn,$lgid){
  $total=0;$total_Weight=0;$viewcart='';$sux="";$st="";$j=0;$allqty=0;$ProductID="";$ProductQty="";$ProductSx="";$productTotal="";$productPrice="";$suxID=""; $suxPr="";$Sprice=0;
  
  $sx = explode(",",$sx);
  $qty = explode(",",$qty);
  $ID = explode(",",$ID);
  $key = explode(",",$keyn);
foreach ($ID as $PID) {
  $str = ReadInfo($db_conn,"*","sc_products","where ID =$PID","");
  if(!empty($str)){
    	$suxin = explode("||",$sx[$j]);
    	foreach ($suxin as  $value) {
    	  	if (!empty($value)){
    	  	$sux.= CheckSuxin($db_conn,$value)."<br>"; 
          $suxPr.= CheckSuxinPr($db_conn,$value).","; //2021-07-08 //属性价格
    	  	} 
    	  }
        //2021-07-08 如果有多个属性价格，按最高一个价格进行计算
        $suxPr=rtrim($suxPr,",");
        $suxPr=explode(",", $suxPr);
        if (count($suxPr)>1){
       // rsort($suxPr);
        //  $Sprice=$suxPr[0];
        foreach ($suxPr as $value) {
           
           $Sprice = $Sprice+$value;
        }

        }else{
          $Sprice = $suxPr[0];
        }

        //2021-07-08 如果有属性价格 用属性价格，如果没有用商城价格

        if (empty($Sprice)){
          $spprice = $str[0]['products_sprice'];
        }else{
          $spprice = $Sprice;
        }
       
        $img     = explode(",", $str[0]['ant_img']);   //图片
        $pname   = $str[0]['products_name'];           //产品名称

        $pzk     = $str[0]['products_zk'];             //折扣ID
        if(!empty($pzk)){
       		 $pzeke   = $str[0]['products_zeke'];      //折扣
       		 $price   = $spprice*Zeke($pzeke,$qty[$j]);   //价格
        }else{
        	 $price   = $spprice;
        }

        $tprice  = $price*$qty[$j];                    //单个产品总价
        $pweight = $str[0]['products_weight'];         //重量
        $pdw     = $str[0]['products_dw'];             //重量单位 g,kg
        $pl      = $str[0]['products_l'];              //包装长
        $pw      = $str[0]['products_w'];              //包装宽
        $ph      = $str[0]['products_h'];              //包装高
        $bweight  = intval($pl)*intval($pw)*intval($ph)/6000;  //计算结果是 kg 长(CM) X 宽(CM) X 高(CM) /6000 =重量
        if ($pdw == "g") {
          $dweight  = $pweight/1000;                    //计算结果转换为 kg  
        }else{
          $dweight  = $pweight;
        }
        if ($bweight>$dweight){                         //重量优先
           $weight = $bweight*$qty[$j];
        }else{
           $weight = $dweight*$qty[$j];
        }
        $ProductID.= $PID.",";                          //产品ID总计
        $ProductQty.= $qty[$j].",";                     //产品数量总计
        $ProductSx.=$sux."||";                          //产品属性总计
        $productTotal.=ChangeCur($db_conn,$tprice,"no").","; //单个产品总价
        $productPrice.=ChangeCur($db_conn,$price,"no").",";  //单个产品价格     
        $allqty = $allqty+$qty[$j];                     //总数量
        $total = $total+$tprice;                        //总价格
        $total_Weight = $total_Weight+$weight;          //总重量



        if (!empty($str[0]['products_m'])){$pm=$str[0]['products_m'];}else{$pm=1;} //起订量
        if (!empty($str[0]['products_b'])){$pb=$str[0]['products_b'];}else{$pb=0;} //最大购买量
        if ($type=="cart"){
          $viewcart.= '<ul><li><img src="'.$web_url_mt.str_replace("../", "", $img[0]).'">'.$pname.'<br><p>'.$sux.'</p></li><li>'.ChangeCur($db_conn,$price).'</li><li><div class="Ant_qty"><input type="text" value="'.$qty[$j].'" id="qty'.$j.'" class="Ant_qty_qty" onblur="changeqty(\''.$pm.'\',\''.$pb.'\',\'qty'.$j.'\');"><span onclick="QtyAddCart(\'Add\',\''.$pb.'\',\''.trim($key[$j]).'\',\'qty'.$j.'\',\''.$lgid.'\',\''.$web_url_mt.'\')">+</span><span onclick="QtyAddCart(\'Red\',\''.$pm.'\',\''.trim($key[$j]).'\',\'qty'.$j.'\',\''.$lgid.'\',\''.$web_url_mt.'\')">-</span></div></li><li>'.ChangeCur($db_conn,$tprice).'</li><li onclick="ConfimShow(\''.trim($key[$j]).'\',\''.$web_url_mt.'\',\''.$wd['comfirm'].','.$wd['cancel'].'\',\''.$lgid.'\')"><i class="fa fa-trash-o" aria-hidden="true"></i></li></ul>';
          }elseif($type=="view"){
            $viewcart.= '<ul><li><img src="'.$web_url_mt.str_replace("../", "", $img[0]).'"><span>'.$pname.'<br><p>'.$sux.''.ChangeCur($db_conn,$price).' x '.$qty[$j].' <br> '.ChangeCur($db_conn,$tprice).'</p></span></li></ul>';
          }
        $sux="";
        $suxPr="";
        $Sprice="";
  }

       $j=$j+1; 
}
      if ($type=="cart"){

           $stop ="<ul><li>".$wd['product']."</li><li>".$wd['price']."</li><li>".$wd['addqty']."</li><li>".$wd['total']."</li><li></li></ul>";	
           $st = "<div class='Ant_cart_view_1'>".$stop.$viewcart."</div><div class='Ant_cart_view_2'><ul><li><span class='Ant_subtotal'>".$wd['subtotal']."</span><span class='Ant_subtotalprice'>".ChangeCur($db_conn,$total)."</span></li><li><span class='Ant_placeorder trans' onclick=\"location.href='".$web_url_mt."shop/check/'\">".$wd['placeoder']."</span></li>".$wd['sevices']."</ul></div>"; 

       }elseif($type=="view"){
            $_SESSION["Ant_Weight"] = $total_Weight; //用session存重量
            $_SESSION['Ant_Total'] = ChangeCur($db_conn,$total,"no");//订单总价不含运费
            $st = "<div class='Ant_user_content_right_0'><span>".$j." (Items)</span><span>".$allqty." (Piece)</span></div><div class='Ant_user_content_right_1'>".$viewcart."</div><div class='Ant_placeform'><form id='Antcheckout' method='post' action='".$web_url_mt."Core/Program/Ant_Rponse.php?actions=CheckOutOrder'><input type='hidden' name='ant_addressID' id='ant_addressID'><input type='hidden' name='ant_expressID' id='ant_expressID'><input type='hidden' name='ant_paymentID' id='ant_paymentID'><input type='hidden' name='couponID' id='couponID'><textarea placeholder='Message' id='ant_message' name='ant_message'></textarea></form></div><div class='discountcode'><input type='text' id='discode' class='dinput' placeholder='".$wd['discountcode']."'><span id='discodeapp' title='".$wd['nodiscountcode']."'>".$wd['apply']."</span></div><div class='Ant_user_content_right_2'><ul><li><span class='Ant_subtotal'>".$wd['subtotal']."</span><span class='Ant_subtotalprice'>".ChangeCur($db_conn,$total)."</span> </li>
            <li class='Ant_hide'><span class='Ant_subtotal'>".$wd['freight']."</span><span class='Ant_subtotalprice' id='Ant_freight'></span></li>
            <li class='Ant_hides'><span class='Ant_subtotal'>".$wd['Discount']."</span><span class='Ant_subtotalprice' id='Ant_discounpon'></span><i class='fa fa-times' aria-hidden='true' id='closediscp'></i></li>
            <li class='Ant_hide Ant_border'><span class='Ant_subtotal'>".$wd['total']."</span><span class='Ant_subtotalprice' id='Ant_totals'></span></li></ul></div><div class='Ant_user_content_right_2'><ul>
            ".$wd['sevices']."</ul></div>"; 

       }elseif($type=="order"){

            $st =array('productID'=>$ProductID,'productQty'=>$ProductQty,'productSx'=>$ProductSx,'price'=>$productPrice,'productTotal'=>$productTotal,'Total'=>$total,'productWeight'=>$total_Weight);
            $st =json_encode($st);
            //$st=$st['productID'];
       }
 

  return CheckStr_d($st);
}

//折扣计算
function Zeke($str,$sl){
    $zkj="1";$zk="";
    $zeke=explode(",", $str);
    $len=count($zeke);
    for ($x=0; $x<$len; $x++) {
        if($x%2==0){ //取奇偶数
          if ($zeke[$x]!=""){
                   if(strpos($zeke[$x],'-')!==false){ //1-20,0.9,21-30,0.8包含 -，+ 符号的折扣名
                      $zk=explode("-", $zeke[$x]);
                      if ($sl>=trim($zk[0]) && $sl<=trim($zk[1])){
                          $zkj=trim($zeke[$x+1]); // +1 是 指针下移一位
                        }
                      }elseif(strpos($zeke[$x],'+')!==false){ //带 + 号的计算比较输出折扣率
                         $zk=explode("+", $zeke[$x]);
                        if ($sl>=trim($zk[0])){
                           $zkj=trim($zeke[$x+1]); // +1 是 指针下移一位
                         }
                  }elseif(is_numeric($zeke[$x])){ //没有任何符号 单个的 如：2,0.9,3,0.8
                     if($sl>=trim($zeke[$x])){
                      $zkj=trim($zeke[$x+1]); // +1 是 指针下移一位
                     }
                  }                
             } 
          }
        }
    return  $zkj; 
}

//国家区域
function ViewCountry($db_conn,$ID,$ctr=""){
  $str = ReadInfo($db_conn,"*","sc_country","where country_flag=1","order by country_paixu,ID desc");
  if(!empty($str)){
    for ($i=0; $i <count($str) ; $i++) {
        if($ID==$str[$i]['ID']){$slt = 'selected';}else{$slt="";}
        $ctr.="<option value='".$str[$i]['ID']."' ".$slt.">".$str[$i]['country_name']."</option>";
    }
        $ctr='<select name="add_contry" id="add_contry">'.$ctr.'</select>';
  }
  return CheckStr_d($ctr);
}

//查询免运方式
function Checkfreeship($db_conn){
  $strs = ReadInfo($db_conn,"*","sc_freeship","where ID=1","");
  if (!empty($strs)){
    $free_flag = $strs[0]['free_flag'];
  }else{
    $free_flag=1;
  }
  return $free_flag;
}

//查询物流及费用计算
//ps 1:不开通免运费,2:全场运费固定,3:统一设置所有地区最低消费额,4:按地区设置最低消费额
function CheckExpress($db_conn,$ID,$counid,$Weight,$web_url_mt,$exflag,$total,$express=""){ //$total 订单金额 //$exflag 免运方式
      // echo CheckExpress($db_conn,1,12,$web_url_mt,1,120); 
 
      if ($exflag==1){
           $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
           $wgs=$strs[0]['de_jsfs'];
           if (!empty($wgs)){
              $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
              $express = ChangeCur($db_conn,eval("return $wgs;"),"no");
           }
      }elseif($exflag==2){
              $strs = ReadInfo($db_conn,"*","sc_freeship","where ID=1","");
              $express = ChangeCur($db_conn,$strs[0]['free_price'],"no");
      }elseif($exflag==3){
              $strs = ReadInfo($db_conn,"*","sc_freeship","where ID=1","");
              if ($total > $strs[0]['free_price']){
                $express = ChangeCur($db_conn,0,"no");
             }else{
               $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
               $wgs=$strs[0]['de_jsfs'];
               if (!empty($wgs)){
                  $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
                  $express = ChangeCur($db_conn,eval("return $wgs;"),"no");
               }
             }
      }elseif($exflag==4){

              $strs = ReadInfo($db_conn,"*","sc_country","where ID=$counid","");
              if ($total > $strs[0]['exprssyf'] && $strs[0]['exprssyf']!=0){ 
                $express = ChangeCur($db_conn,0,"no");
             }else{
               $strs = ReadInfo($db_conn,"*","sc_delivery","where ex_id=$ID and de_area like '%,".$counid.",%'","");
               $wgs=$strs[0]['de_jsfs'];
               if (!empty($wgs)){
                  $wgs=str_replace("W",$Weight,str_replace("R","ceil",trim($wgs)));
                  $express = ChangeCur($db_conn,eval("return $wgs;"),"no");
               }
             }
      }
 
   return CheckStr_d($express);  
 
}

//支付方式
function CheckPay($db_conn,$web_url_mt,$pay=""){
  $str = ReadInfo($db_conn,"*","sc_pay","where pay_flag=1","order by pay_paixu,ID desc");
  if(!empty($str)){
    for ($i=0; $i <count($str); $i++) { 
      $pay.='<li class="ant_paymentclick"><img src="'.$web_url_mt.str_replace("../","",rtrim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['pay_name'].'"> <span><input type="radio" name="paymethod" value="'.$str[$i]['pay_fenlei'].'_'.$str[$i]['ID'].'"></span><p>'.$str[$i]['contents'].'</p></li>';
    }
  }
  return CheckStr_d($pay);
}

//查询paypal收款账号
function CheckPayAccount($payflag,$payid,$db_conn){
  $str = ReadInfo($db_conn,"*","sc_pay","where pay_flag=1 and pay_fenlei=$payflag and ID=$payid","");
  if (!empty($str)){
    return $str[0]['pay_acount'];
  }
}

//查询用户信息
function MemberInfo($db_conn,$email,$pass,$feild){
  $feilds = "";
  $str = ReadInfo($db_conn,"*","sc_member","where me_email='$email' and me_paswd='$pass'","");
  if(!empty($str)){
    $feilds = $str[0][$feild];
  }
  return $feilds;
}

//查询用户ID
if (isset($_SESSION['antuser']) && isset($_SESSION['antpass'])){
  $UID = MemberInfo($db_conn,$_SESSION['antuser'],$_SESSION['antpass'],"ID");
  $UEM = $_SESSION['antuser'];
}else{
  $UID = "";
  $UEM = "";
}

//查询国家名称
function ConutryName($db_conn,$ID,$cty=""){
  if (!empty($ID)){
    $str = ReadInfo($db_conn,"*","sc_country","where ID=$ID","");
    if (!empty($str)){
      $cty = $str[0]['country_name'];
    }
    return $cty;
  }
}

//查询用户地址信息
function UserAddress($db_conn,$UID,$ID,$type,$address=""){
   if (!empty($ID)){
    $str = ReadInfo($db_conn,"*","sc_address","where ID=$ID and userID=$UID","");
    if (!empty($str)){
      if ($type=="all"){
       $address = $str[0]['add_firstname']." ".$str[0]['add_lastname']."<br>".$str[0]['add_dress']." , ".$str[0]['add_city']." , ".$str[0]['add_state']." , ".ConutryName($db_conn,$str[0]['add_contry'])." , ".$str[0]['add_zipcode']."<br>".$str[0]['add_tel']."<br>".$str[0]['add_company'];
      }else{
        $address = $str[0]['add_contry']; //查国家ID
      }
    }
    return $address;
  } 
}
//查询优惠码
function Checkcoupon($db_conn,$ID,$total){
    $price="";
    if(!empty($ID)){
      // $today=strtotime(date("Y-m-d"));
       $str = ReadInfo($db_conn,"*","sc_coupon","where ID=$ID and cou_flag=1 and to_days(cou_overtime)>=to_days(now())","");
       //$str = ReadInfo($db_conn,"*","sc_coupon","where ID=$ID and cou_flag=1 and cou_overtime>=$today","");
       if(!empty($str)){
          if($total > ChangeCur($db_conn,$str[0]['cou_overprice'],"no")){ //是否大于优惠金额 才可以用优惠券
             $price = $str[0]['cou_price'];
          }
        }else{
             $price = "0";
        }
        return $price;    
      }
 }

//查订单中的优惠码
function CheckcouponOrder($db_conn,$ID){
  if(!empty($ID)){
    $str = ReadInfo($db_conn,"*","sc_order","where ID=$ID","");
    $coupid = $str[0]['order_disnm'];
  }else{
    $coupid="";
  }
  return $coupid;
}

//查询订阅中的所有优惠码
function CheckAllCoupon($db_conn,$UEM,$words,$couponid=""){
  $coupon="";
  $word=explode(",", $words);
   if(!empty($UEM)){
    $str = ReadInfo($db_conn,"*","sc_email","where e_ml='".$UEM."' and e_flag=0","");
    if (!empty($str)){
        for ($i=0; $i <count($str); $i++) { 
          $couponid.= $str[$i]['e_couid'].",";
        }
          $couponid =  rtrim($couponid,",");
        //通过优惠ID查优惠券
        $strs = ReadInfo($db_conn,"*","sc_coupon","where ID in($couponid)"," order by ID desc");
        if (!empty($strs)){
           for ($i=0; $i <count($strs); $i++) { 

              $coupon.= "<div>
                <li><strong>".$strs[$i]['cou_title']."</strong></li>
                <li>".$word[0]." : ".$strs[$i]['cou_overtime']."</li>
                <li>".$word[2]." : ".$strs[$i]['cou_code']."</li>
                <li>".$word[1]." : $".$strs[$i]['cou_price']."</li>
              </div>";
          }         
        }
    }
   }
  return $coupon;
}

//查询是否订阅 获取优惠码
function Checknewsletter($db_conn,$email,$discount,$total){
     $couprice="";
     $strs = ReadInfo($db_conn,"*","sc_email","where e_ml='$email' and e_coucode='$discount' and e_flag=0","");
     if (!empty($strs)){
        $couponID = $strs[0]['e_couid'];
        $price =Checkcoupon($db_conn,$couponID,$total);

        $couprice =ChangeCur($db_conn,$price);
     }else{
        $couprice = "";
     }
     return $couprice;
}

//显示wishlist 产品
function ListWish($db_conn,$web_url_mt,$web_url,$ID,$lgid){
   $Products="";
   $str = ReadInfo($db_conn,"*","sc_products","where ID in($ID)"," order by ID desc");
   if(!empty($str)){
      for ($i=0; $i <count($str); $i++) {
        $img=explode(",", $str[$i]['ant_img']);
        if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}
        $Products.='<div class="Ant_wishlist"><ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank" ><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></li><li class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank" >'.$str[$i]['products_name'].'</a></li><li>'.ChangeCur($db_conn,$str[$i]['products_sprice']).' '.$oprice.' </li><li class="clwishlist" url="'.$web_url_mt.'" lgid="'.$lgid.'" value="'.$str[$i]['ID'].'"><i class="fa fa-times" aria-hidden="true"></i></li></ul></div>';
     }
   }
   return $Products;
}

//列出会员中心订单

function mlistorder($UID,$db_conn,$lgid,$web_url_mt,$words,$order=""){
     $j=1;
     $str = ReadInfo($db_conn,"*","sc_order","where userID=$UID and order_zt=0","order by ID desc");
     if (!empty($str)){
      for ($i=0; $i <count($str) ; $i++) {
        if(empty($str[$i]['order_exnb'])){$ship = "Not shipped";}else{$ship = '<i class="fa fa-check" aria-hidden="true"></i> Shipped';}
        if(empty($str[$i]['order_flag'])){$pay = "unPaid"; $clear='<i class="fa fa-times" aria-hidden="true"  onclick="ConfimShowod(\''.$str[$i]['ID'].'\',\''.$web_url_mt.'\',\''.$words.'\',\''.$lgid.'\')"></i>';}else{$pay = '<i class="fa fa-check" aria-hidden="true"></i> Paid';$clear='';}

        $order.='<ul><li>'.$j.'</li><li><a href="javascript:;" class="vieworder" url="'.$str[$i]['order_number'].'">'.$str[$i]['order_number'].'</a></li><li>'.$str[$i]['order_time'].'</li><li>'.$str[$i]['order_curry'].$str[$i]['order_prodctzj'].'</li><li>'.$pay.'</li><li>'.$ship.'</li><li>'.$clear.'</li></ul>';
        $j=$j+1;
      }
     }
     return CheckStr_d($order);
}

//显示不订单状态

function falgorder($db_conn,$UID,$tp){
     if($tp=="pay"){

       $str = ReadInfo($db_conn,"*","sc_order","where userID=$UID and order_zt=0 and order_flag='0'","");

     }else{

      $str = ReadInfo($db_conn,"*","sc_order","where userID=$UID and order_zt=0 and order_flag='1' and order_fh='0'","");

     }

       if (!empty($str)){
        return count($str);
       }else{
        return "0";
       }     

}

//查询物流

function CheckExp($db_conn,$ID,$express=""){
    $str = ReadInfo($db_conn,"*","sc_express","where ID=$ID","");
    if (!empty($str)){
      $img=rtrim($str[0]['ant_img'],",");
      $express = "<img src='../".$img."' width='50' align='absmiddle'> ".$str[0]['ex_des'];
    }
    return CheckStr_d($express);
}
//查询评论
function ChekReviews_user($db_conn,$UEM,$web_url,$web_url_mt){
    $vreviews=""; $sta="";
  $str = ReadInfo($db_conn,"*","sc_msg","where msg_email='$UEM' "," order by ID desc");
  if (!empty($str)){
    for ($i=0; $i <count($str) ; $i++) { 
 
          for ($j=0; $j <$str[$i]['msg_rating'] ; $j++) { 
            $sta.= '<i class="fa fa-star" aria-hidden="true"></i>';
          }
          for ($j=0; $j <5-$str[$i]['msg_rating'] ; $j++) { 
            $sta.= '<i class="fa fa-star-o" aria-hidden="true"></i>';
          }
      if(!empty($str[$i]['msg_reply'])){
          $re = '<li><i class="fa fa-comments-o" aria-hidden="true"></i> '.$str[$i]['msg_reply'].'</li>';
      }else{
          $re = "";
      }

      if ($str[$i]['msg_flag']=="p"){
         $pro = '<li>'.Checkpro_user($db_conn,$str[$i]['msg_pid'],$web_url,$web_url_mt).'</li>';
         $sta =$sta;
      }else{
         $pro ="";
         $sta ="";
      }

      $vreviews.='<ul>'.$pro.'<li><i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$str[$i]['msg_name'].'</strong> '.date("Y-m-d",strtotime($str[$i]['msg_time'])).'</li>
      <li>'.$sta.'</li>
      <li><i class="fa fa-commenting-o" aria-hidden="true"></i> '.$str[$i]['msg_content'].'</li>'.$re.'</ul>';
      $sta="";
  
    }
  } 
  return CheckStr_d($vreviews);
}

//产品查询 评论
function Checkpro_user($db_conn,$ID,$web_url,$web_url_mt){
        $plist="";
        $strs = ReadInfo($db_conn,"*","sc_products","where ID=$ID","");
        if(!empty($strs)){
            $img=explode(",", $strs[0]['ant_img']);
            $plist ='<a href="'.$web_url.UrltoHtml($strs[0]['ID'],$strs[0]['products_url'],"pv").'" target="_blank" ><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" width="40" align="absmiddle" alt="'.$strs[0]['products_name'].'"> '.$strs[0]['products_name'].'</a>';
        }
      return CheckStr_d($plist);
}

//gotopaypal

function Gotopaypal($paypalurl,$ORD_Total,$ORD_Nub,$web_url_meate,$cancel_return,$CurCode,$Payaccount,$return,$notify_url){

          echo '<!-- paypal沙盒支付测试地址 --> 
          <form id="pay_form" name="pay_form" action="'.$paypalurl.'" method="post" > 
          <!-- 支付金额--> 
          <input type="hidden" name="amount" id="amount" value="'.$ORD_Total.'"> 
          <!-- 自己的参数 商品条目--> 
          <input type="hidden" name="item_number" id="item_number" value="'.$ORD_Nub.'"> 
          <input type="hidden" name="currency_code" id="currency_code" value="'.$CurCode.'"> 
          <!-- 表示立即支付--> 
          <input type="hidden" name="cmd" id="cmd" value="_xclick"> 
          <!-- 商品名称--> 
          <input type="hidden" name="item_name" id="item_name" value="'.$ORD_Nub.'"> 
            <!--支付成功后台通知地址--> 
           <input type="hidden" name="notify_url" id="notify_url" value="'.$notify_url.'">
           <!--支付成功返回地址--> 
           <input type="hidden" name="return" id="return" value="'.$return.'"> 
           <!--支付取消返回地址 <input type="hidden" name="lc" id="lc" value="China">  --> 
           <input type="hidden" name="cancel_return" id="cancel_return" value="'.$cancel_return.'">
           <!--商户邮件--> 
           <input type="hidden" name="business" id="business" value="'.$Payaccount.'"> 
           </form> <script language="javascript">document.pay_form.submit();</script>';
}

//清空Cookies and session
function EmptyCkSesion($str){
    $ck=$_COOKIE; //获取所有 cookies
    foreach ($ck as $key=>$value) {
           if(strpos($key,$str) !==false){  //选出需要的 cookies
               setcookie($key,"", Ant_Cook('Expire')-3600*24*2, Ant_Cook('Path'),Ant_Cook('Domain'));
          }
       }
    unset($_SESSION['CountryID']);
    unset($_SESSION['CountryID']);
    unset($_SESSION['Ant_Total']);
    unset($_SESSION["Ant_Weight"]);
}



