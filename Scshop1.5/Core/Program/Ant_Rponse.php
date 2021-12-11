<?php
session_start();
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
include_once 'Include.php';
$web_url_mt=str_replace("Core/Program/", "", $web_url_mt);
//get
if(isset($_GET['actions'])){
	$actions = $_GET['actions'];
	$post=$_POST;
	$Ant=new WD_Data_Process();
}else{
	$actions = "";
}
$field = ""; $val = "";  

//用户注册
if ($actions == "UserReg"){
	$table="sc_member";
	if(!empty($post)){
		if(CheckEmail($post['me_email'])==true){
			if($Ant->CheckData($table,"me_email",$post['me_email'],$db_conn)==1){//验证是否有相同邮箱存在
				echo $Lable['sameemail'];
				exit;
			}else{	
				foreach ($post as $key => $value) {
					if (empty($value)){ //判断空值
					  echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
					  exit;
					 }
				  $field.=$key.",";
				  if ($key=="me_paswd"){
				  	$val.="'".md5(md5($value))."',"; //双 md5
				  }else{
				    $val.="'".CheckStr($value)."',";
				  }
				}

				$me_logintime = date("Y-m-d H:i:s");
				$me_loginip = GetIp();
				$field = $field."me_logintime,me_ip";
				$val = "(".$val."'".$me_logintime."',"."'".$me_loginip."')";			
	            //$field= substr($field, 0, -1);
			     //$val="(".$val.")";
	           if (($Ant->AntAdd($table,$field,$val,$db_conn))===true){
	             	start_session(Ant_Cook("Expires"));
	             	$_SESSION['antuser'] = $post['me_email'];
	             	$_SESSION['antpass'] = md5(md5($post['me_paswd']));
	             	$_SESSION['antfistname'] = $post['me_firstname'];
	             	$_SESSION['antlastname'] = $post['me_lastname'];
	           	    echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['loginsucess']; //注册成功
	           	    if($M_Open==1){
	           	    	$M_Title   = "@来自".$SERVER_NAME."会员注册";
	           	    	$M_Content = "邮箱 : ".$post['me_email']."<br>时间 : ".$me_logintime."<br>IP : ".$me_loginip."<br>详细信息进网站后台查看！！！";
	           	    	   SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$M_Jmail,$M_Title,$M_Content); //发送给自已
	           	    	$MT = CheMailTemplate($db_conn,1); 
	           	    	if(!empty($MT)){ //发送给客户
	           	    		SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$post['me_email'],$MT['Mtitle'],$MT['Mtent']); 
	           	        }
	           	     }
	           }else{
	           	   echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['loginfailed']; //注册失败
	           }
	         }  
		}else{
           echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['correctemail']; 
		}
	}else{
	     echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
	}
}

//用户修改
if ($actions == "UserEdit"){
	if(!empty($post)){
		$table="sc_member";
		$umail = $UEM;
		$upas  = md5(md5($post['me_paswd']));
		$me_firstname = CheckStr($post['me_firstname']);
		$me_lastname = CheckStr($post['me_lastname']);
		$ne_paswd = CheckStr($post['ne_paswd']);

		$str = ReadInfo($db_conn,"*",$table,"where me_email='$umail' and me_paswd='$upas' and me_flag=0",""); //判断会员状态是否锁定
		if (!empty($str)){
			if(!empty($ne_paswd)){
				$val="me_firstname='".$me_firstname."',me_lastname='".$me_lastname."',me_paswd='".md5(md5($ne_paswd))."'";
		     }else{
                $val="me_firstname='".$me_firstname."',me_lastname='".$me_lastname."'";
		     }
			  if (($Ant->AntEdit($table,$val,$UID,$db_conn)==true)){
			  	$_SESSION['antuser'] = $UEM;
				$_SESSION['antpass'] = md5(md5($ne_paswd));
	         	$_SESSION['antfistname'] = $me_firstname;
	         	$_SESSION['antlastname'] = $me_lastname;
	         	echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
			  }else{
			  	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile'];
			  }
		}else{
			echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile'];
		}

	}else{
		echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile'];
	}
}

//用户登陆
if ($actions == "UserLogin"){
	if(!empty($post)){
		$table="sc_member";
		$umail = CheckStr($post['me_email']);
		$upas  = md5(md5($post['me_paswd']));
		$str = ReadInfo($db_conn,"*",$table,"where me_email='$umail' and me_paswd='$upas' and me_flag=0",""); //判断会员状态是否锁定
		if (!empty($str)){

			//修改登陆IP 与时间
			$time=date('Y-m-d H:i:s');
			$ip = GetIp();
			$val="me_dltime='".$time."',me_loginip='".$ip."'";
			$Ant->AntEdit($table,$val,$str[0]['ID'],$db_conn);

			 echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['loginsucess'];
	         start_session(Ant_Cook("Expires"));
	         $_SESSION['antuser'] = $post['me_email'];
	         $_SESSION['antpass'] = md5(md5($post['me_paswd']));
	         $_SESSION['antfistname'] = $str[0]['me_firstname'];
	         $_SESSION['antlastname'] = $str[0]['me_lastname'];

		}else{
			echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['accounterr'];
		}
   }
}

//用户地址管理
if ($actions == "UserAddress"){
	$table="sc_address";
	if(isset($_GET['type'])){$type = $_GET['type'];}else{$type = "";}
	if($type == "add"){ //add address
		if(!empty($post)){
			foreach ($post as $key => $value) {
				if (empty($value) && $key!="add_company"){ //判断空值
				   echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
				   exit;
				 }
				  $field.=$key.",";
				  $val.="'".CheckStr($value)."',";
			}			
	        $field= substr($field, 0, -1);
		    $val="(".substr($val, 0, -1).")";
	        if (($Ant->AntAdd($table,$field,$val,$db_conn))===true){
	       	    echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
	        }else{
	       	    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
	        }
	     }else{
		     echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
		}
	}elseif($type == "edit"){ //edit address
		if(!empty($post)){
			$strs="";
			foreach ($post as $key => $value) {
				if (empty($value) && $key!="add_company"){ //判断空值
				   echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
				   exit;
				 }
			    if ($key!="ID"){
			    	$strs.=$key."='".CheckStr($value)."',";
			    }else{
			    	$id=$post['ID'];
			    }
			}
		        $val=substr($strs, 0, -1);
		   if (($Ant->AntEditAddress($table,$val,$id,$UID,$db_conn))===true){
	       	    echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
	       }else{
	       	    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
	       }
	     }else{
		     echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
		}
	}elseif($type == "close"){
		if(isset($_GET['id'])){$ID = $_GET['id'];}else{$ID = "";}
		if(!empty($ID) &&(!empty($UID))){
		    if (($Ant->AntDelAddress($table,$ID,$UID,$db_conn))===true){ //del address
				echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
		    }else{
		    	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
		    }
	   }else{
	   	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
	   }
	}
}

//用户删除订单

if($actions == "ClearOrder"){
	if(isset($_GET['id'])){$ID = $_GET['id'];}else{$ID = "";}
	if (!empty($ID) && !empty($UID)){
		$val=" order_zt='1'";
		$table="sc_order";
		if (($Ant->AntEditAddress($table,$val,$ID,$UID,$db_conn))===true){

			//更改优惠码状态
			$couponID = CheckcouponOrder($db_conn,$ID); //查询订单中的优惠码
			$cupid = CheckStr($couponID);
        	if (!empty($cupid)){
        		$where = "e_coucode='".$couponID."' and e_ml='".$UEM."'";
        		$val = "e_flag='0'";
        		$Ant->AntEditGen("sc_email",$val,$where,$db_conn);
        	}

            echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
		}else{
			echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
		}
	}
}

//订阅提交
if($actions == "SubNewsletter"){

	if(!empty($post)){
	      if(CheckEmail($post['e_ml'])==true){ //验证邮箱格式
	      	if(!empty($post['e_coucode']) && !empty($post['e_couid'])){ //判断是否有优惠码
	 			 if($Ant->CheckDatas("sc_email","e_ml='".$post['e_ml']."' and e_coucode='".$post['e_coucode']."' and e_couid='".$post['e_couid']."' ",$db_conn)==1){ //验证是否双重订阅
	 			    echo $Lable['sameemail'];
					exit;
	 			 }
 			}else{
	  			 if($Ant->CheckData("sc_email","e_ml",$post['e_ml'],$db_conn)==1){ //验证是否双重订阅
	 			    echo $Lable['sameemail'];
					exit;
	 			 }
 			}
			    $time = date("Y-m-d H:i:s");
			    $ip = GetIp(); //IP
			    //写入数据库
				$field ="e_ml,e_ip,e_tm,e_couid,e_coucode";
				$val = "('".CheckStr($post['e_ml'])."','".$ip."','".$time."','".CheckStr($post['e_couid'])."','".CheckStr($post['e_coucode'])."')";			
			    if (($Ant->AntAdd("sc_email",$field,$val,$db_conn))===true){
			    	echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
			    	 if($M_Open==1){
	           	    	$MT = CheMailTemplate($db_conn,2); //下单模版
	           	    	if(!empty($MT)){ //发送给客户
	           	    		$title = $MT['Mtitle'];
	           	    		$tent  = str_replace("{XXXXXX}", $post['e_coucode'], CheckStr_d($MT['Mtent']));
	           	    		SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$post['e_ml'],$title,$tent); 
	           	        }
	           	     }


			    }
	     }else{
	     	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['correctemail']; 
	     }
	}else{
	 	 echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
	}

}

//评论提交
if($actions == "ReviewsAdd"){
        $table = "sc_msg";
        $time = date("Y-m-d H:i:s");
		$ip = GetIp(); //IP
		if(!empty($post)){
		 if(CheckEmail($post['msg_email'])==true){
			foreach ($post as $key => $value) {
				if (empty($value)){ //判断空值
				   echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
				   exit;
				 }
				  $field.=$key.",";
				  $val.="'".CheckStr($value)."',";
			}
			$field = $field."msg_time,msg_ip,";
			$val = $val."'".$time."',"."'".$ip."',";
	        $field= substr($field, 0, -1);
		    $val="(".substr($val, 0, -1).")";
	        if (($Ant->AntAdd($table,$field,$val,$db_conn))===true){
	       	    echo '<i class="fa fa-check-circle-o" aria-hidden="true"></i><br>'.$Lable['submitsuf']; //提交成功
 
	           	    if($M_Open==1){

	           	    	$M_Title   = "@来自".$SERVER_NAME."的客户留言";
	           	    	$M_Content = "邮箱 : ".$post['msg_email']."<br>内容 : ".$post['msg_content']."<br>时间 : ".$time."<br>IP : ".$ip."<br>详细信息进网站后台查看！！！";
	           	    	   SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$M_Jmail,$M_Title,$M_Content); //发送给自已
	           	     }

	        }else{
	       	    echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['submitfaile']; //提交失败
	        }
	       }else{
               echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['correctemail']; 
	       }
	     }else{
		     echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><br>'.$Lable['Required']; 
		}	
}

//结算页面提交
if($actions == "CheckOutOrder"){

	if(empty($UID)){echo "<script>alert('".$Lable['resigin']."');window.history.back(-1);</script>";exit;} //超时控制
         if(!empty($_POST)){
			        $post = $_POST;
			        $ant_addressID  =  CheckStr($post['ant_addressID']);  //地址ID 查询所有地址，国家
			        $ant_expressID  =  CheckStr($post['ant_expressID']);  //物流ID 查询物流 公式,需调用 地址国家ID
			        $ant_paymentID  =  CheckStr($post['ant_paymentID']);   //支付方式 用于支付去向
			        $couponID       =  CheckStr($post['couponID']);       //优惠编码 查优惠金额 计算总价
			        $message        =  CheckStr($post['ant_message']);    //留言内容

		        if (!empty($ant_addressID) && !empty($ant_expressID) && !empty($ant_paymentID)){
			        //订单编号
			        $FistCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			        $OrderNub = $FistCode[rand(0,9)].strtoupper(dechex(date('m'))).date('d').substr(time(), -5).substr(microtime(), 2, 5).sprintf('%02d',rand(0, 99));
			        $Productinfo = ViewCart(Ant_Cook('Cook_Qz'),$db_conn,"order",str_replace("Core/Program/", "", $web_url_mt),"",$lgid);
			        $Productinfo = json_decode($Productinfo, true);
			        $Address          = UserAddress($db_conn,$UID,$ant_addressID,"all"); //物流地址
			        $AddressCountryID = UserAddress($db_conn,$UID,$ant_addressID,""); //国家ID
			        $dtotal           = $Productinfo['productTotal']; //产品单个总价
			        $total            = ChangeCur($db_conn,$Productinfo['Total'],"no"); //产品总价转换汇率
			        $weight           = $Productinfo['productWeight']; //重量
			        $exflag           = Checkfreeship($db_conn); //免运费方式
			        $freight = CheckExpress($db_conn,$ant_expressID,$AddressCountryID,$weight,$web_url_mt,$exflag,$total); //运费已转换汇率
			        $discoupon = Checknewsletter($db_conn,$_SESSION['antuser'],$couponID,$total);
			        $fh=ChangeCur($db_conn,"1","fh"); //汇率符号
			        $discoupon  = str_replace("-","",str_replace($fh, "", $discoupon)); //折扣费用
			        $AllTotal = $total+$freight-$discoupon; //订单总价
			        $ordertime = date("Y-m-d H:i:s");
			        $orderip = GetIp(); //IP
			        //写入数据库
					$field ="userID,order_productID,order_productsl,order_productdjg,order_number,order_shipadd,order_curry,order_price,order_prodctzj,order_time,order_payfs,order_weight,order_shipprice,order_message,order_ip,order_express,order_sx,order_dis,order_disnm";

					$val = "('".$UID."','".CheckStr($Productinfo['productID'])."','".CheckStr($Productinfo['productQty'])."','".CheckStr($Productinfo['price'])."','".$OrderNub."','".CheckStr($Address)."','".CheckStr($fh)."','".CheckStr($dtotal)."','".CheckStr($AllTotal)."','".$ordertime."','".$ant_paymentID."','".$weight."','".$freight."','".CheckStr($message)."','".$orderip."','".$ant_expressID."','".CheckStr($Productinfo['productSx'])."','".CheckStr($discoupon)."','".$couponID."')";			
			        if (($Ant->AntAdd("sc_order",$field,$val,$db_conn))===true){

							//更改优惠码状态
                            $cupid = CheckStr($couponID);
				        	if (!empty($cupid)){
				        		$where = "e_coucode='".$couponID."' and e_ml='".$UEM."'";
				        		$val = "e_flag='1'";
				        		$Ant->AntEditGen("sc_email",$val,$where,$db_conn);
				        	}
                             //清空Cookie与Session;

				        	 EmptyCkSesion(Ant_Cook('Cook_Qz')); 

				        	 //简易邮件发送

			           	    if($M_Open==1){

			           	    	$M_Title   = "@来自".$SERVER_NAME."的订单#:".$OrderNub;
			           	    	$M_Content = "订单号 : ".$OrderNub."<br>金额 : ".$fh.$AllTotal." <br>邮箱 : ".$UEM."<br>时间 : ".$ordertime."<br>IP : ".$orderip."<br>详细订单进网站后台查看！！！";
			           	    	   SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$M_Jmail,$M_Title,$M_Content); //发送给自已

			           	    	$MT = CheMailTemplate($db_conn,3); //下单模版
			           	    	if(!empty($MT)){ //发送给客户
			           	    		$title = str_replace("{website}", $SERVER_NAME, CheckStr_d($MT['Mtitle']));
			           	    		$tent  = str_replace("{Total}",$AllTotal,str_replace("{OrderNub}", $OrderNub, CheckStr_d($MT['Mtent'])));
			           	    		SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$UEM,$title,$tent); 
			           	        }

			           	     }

				        	//订单提交到支付平台

				        	 $ant_paymentID=explode("_", $ant_paymentID);
				        	 $_SESSION['Ant_Alltotal'] = ChangeCur($db_conn,"0","fh").$AllTotal;
				        	 $_SESSION['Ant_Ordernb'] =  $OrderNub;
				        	 $_SESSION['Ant_Paymd'] = $ant_paymentID[0];

			        	   if ($ant_paymentID[0]==1){ //paypal
			        	   	  //$paypalurl="https://www.sandbox.paypal.com/cgi-bin/webscr"; //paypal url
                              $paypalurl = "https://www.paypal.com/cgi-bin/webscr"; //paypal url
                              $ReturnUrl = $web_url_mt."shop/sucess/"; //成功返回
                              $CancelUrl = $web_url_mt; //取消返回
                              $notify_url = $web_url_mt."Core/Program/IPN/IPN.php";        //后台异步调用数据
                              $CurCode   = ChangeCur($db_conn,"0","bzfh");
                              $PayAccount = CheckPayAccount($ant_paymentID[0],$ant_paymentID[1],$db_conn);

                              if (!empty($PayAccount)){
                                 Gotopaypal($paypalurl,$AllTotal,$OrderNub,$web_url_mt,$CancelUrl,$CurCode,$PayAccount,$ReturnUrl,$notify_url);
                               }else{
                               	  echo "err->account";
                               }

			        	   }elseif($ant_paymentID[0]==2){ //西联

			        	   	 header('Location: '.$web_url_mt.'shop/sucess/');
			        	   }


			        }else{
			        	echo 'err->failed';
			        }
		     }else{
		     	echo 'err->empty';
		     	exit;
		     }
    
         }else{
            echo "err";
            exit;
         }
    }

