<?php

if (isset($_GET["aed"])){$aed=$_GET["aed"];}else{$aed="";} //动作选项
if (isset($_GET["action"])){$action=$_GET["action"];}else{$action="";} //动作选项
if (isset($_GET["sort"])){$sort=$_GET["sort"];}else{$sort="";}//分类类别
if (isset($_GET["sortID"])){$sortID=CheckStr($_GET["sortID"]);}else{$sortID="0";}//获取分类类别ID
if (isset($_POST["DID"])){$DID=$_POST["DID"];}else{$DID="";}//产品删除的ID

if ($action=="Add" || $action=="Edit"){//post请求数据
	$post=$_POST;//var_dump($post);//  exit;
    $field="";$val="";
   }
if ($action=="Add" || $action=="Edit" || $action=="Clear" || $action=="OpenOff" || $action=="Paixu" || $action=="Copy"  || $action=="Apply"){ //表选择
	$table=CheckDatabase($sort);
	$Ant=new WD_Data_Process();
 }
//增加
if($action=="Add"){

		if (CheckEmpty($post,$sort)!=""){//判断是否有空字段提交
				echo CheckEmpty($post,$sort);
				exit;
			}else{

			 if ($sort=="property"){ //产品属性

			    $ql="";$qls="";$ke="";
				for ($i=0; $i < count($post['pt_name']); $i++) {
					$ke="";

					foreach ($post as $key => $value) {

							 if ($key!="suxin_id" && $key !="itemnb") {
							 			$ke.=$key.",";
										$ql.="'".@$post[$key][$i]."',";  //此处？？？(2021-02-22)
							 }
						 }
		 	        $qls.="(".$ql."'".$post['suxin_id']."','".$post['itemnb']."'),";
		            $ql="";
		           // echo $ke;
		           // exit;
					}
					$field= $ke."suxin_id,itemnb";
					$val = substr($qls, 0, -1);
  
			 }elseif($sort=="lable"){ //文字
			 	    $ql="";
					foreach ($post as $key => $value){
							if($key!="languageID"){
								$ql.='"'.$key.'":"'.$value.'",';
						    }
						 }
						 $qls="('{".CheckStr(substr($ql, 0, -1))."}','".$post['languageID']."')";
						 $field="tag_content,languageID";
						 $val = $qls;

			 }else{ //其它
						foreach ($post as $key => $value) {

								//$value=BackVerifyStr($value);//检测特别字符

								if ($key=="products_category" || $key=="ant_img" || $key=="user_qx" || $key=="de_area" ){ //数组重新组合==>产品信息
									if($key=="products_category" || $key=="user_qx" || $key=="de_area"){
									   $value=",".implode(",", $value).",";
								    }else{
								       $value=implode(",", $value).",";	
								    }
								}

								if ($key=="di_qty" || $key=="di_price" || $key=="products_zeke" || $key=="products_sx" ){ //数组重新组合==>折扣
								      $value=implode(",", $value);	
								}

								if ($key=="user_ps"){ //密码加密
									$field.=$key.",";
									$val.="'".md5(md5(CheckStr($value)))."',";		
								}else{
									$field.=$key.",";
									$val.="'".CheckStr($value)."',";
							    }
						}
				        $field= substr($field, 0, -1);
				        $val="(".substr($val, 0, -1).")";
		        }
		        //判断后台账号 
		        if ($sort=="users" && $Ant->CheckData($table,"user_admin",$post['user_admin'],$db_conn)==1){
		        	echo '有相同账号存在,请重新输入账号';
		        	exit;
		        }
		        if (($Ant->AntAdd($table,$field,$val,$db_conn))===true){

		        	 if ($table=="sc_categories") { //处理产品分类表信息
   						if ($post['category_pid']=="0"){
			        	 	$catid=CheckInfo($table,"onlyid",$post['onlyid'],"str","ID",$db_conn); //读取分类ID
			        	    //$catpath=CheckInfo($table,"onlyid",$_POST['onlyid'],"str","category_path",$db_conn); //读取分类路径
			        	    $path="0,".$catid.",";
		        	    }else{
			        	 	$catid=CheckInfo($table,"onlyid",$post['onlyid'],"str","ID",$db_conn); //读取分类ID
			        	    $catpath=CheckInfo($table,"ID",$post['category_pid'],"id","category_path",$db_conn); //读取分类路径
			        	    $path=$catpath.$catid.",";
		        	    }
		        	    $val="category_path='".$path."'";
		        	    $Ant->AntEdit($table,$val,$catid,$db_conn);
		        	 }
                    if($table=="sc_delivery"){ //配送方式,修改区域物流ID
                       $exid=$post['ex_id'].",";
                       $de_area=implode(",", $post['de_area']);
                       $db_conn->query("UPDATE sc_country SET expressid=concat(expressid,'$exid') where ID in($de_area) and expressid not like '%,".$exid."%'");
                     }

		        	echo "添加成功";
		        }else{
		        	echo "添加失败";
		        }
            }

}elseif ($action=="Edit"){//修改

		$strs="";
		if (CheckEmpty($post,$sort)!=""){//判断是否有空字段提交
				echo CheckEmpty($post,$sort);
				exit;
			}else{

			if($sort=="freeship"){ //处理免运费方式

	             $strs="free_flag='".CheckStr($post['free_flag'])."',free_price='".CheckStr($post['free_price'])."',";
	             $id=$post['ID'];
	             if ($post['free_flag']=="4"){ // 4->是常量
					$CountryID=$post['countyid'];
					$CountryIDPrice=$post['exprssyf'];
	              }

			}elseif($sort=="lable"){ //文字
			 	    $ql="";
					foreach ($post as $key => $value){
							if($key!="ID"){
								$ql.='"'.$key.'":"'.$value.'",';
						    }
						 }
						 $strs="tag_content='{".CheckStr(substr($ql, 0, -1))."}'.";
						 $id=$post['ID'];
						 //$val = $strs.",";

			 }else{
						foreach ($post as $key => $value) {

							  // if(isset($value)){BackVerifyStr(implode(",",$value));}//检测特别字符
								if ($key=="products_category" || $key=="ant_img" || $key=="user_qx" || $key=="de_area"){ //数组重新组合==>产品信息
									if($key=="products_category" || $key=="user_qx" || $key=="de_area"){
									   $value=",".implode(",", $value).",";
								    }else{
								       $value=implode(",", $value).",";	
								    }
								}

								if ($key=="di_qty" || $key=="di_price" || $key=="products_zeke" || $key=="products_sx" ){ //数组重新组合==>折扣
								       	 $value=implode(",", $value);	
								}


							    if ($key!="ID"){
							    	if ($key=="user_ps"){
							    		$strs.=$key."='".md5(md5(CheckStr($value)))."',"; //会台密码修改
							    	}elseif ($key=="me_paswd") {
							           if (!empty($post['me_paswd'])) { //会员密码修改
							           	 $strs.=$key."='".md5(md5(CheckStr($value)))."',";
							           }
							    	}else{
							    		$strs.=$key."='".CheckStr($value)."',";
							    	}
								
							    }else{
							    	$id=$post['ID'];
							    }
						}
                }
				// echo $strs; echo $id;
		        $val=substr($strs, 0, -1);
		        if (($Ant->AntEdit($table,$val,$id,$db_conn))===true){

			        	// if($table=="order" && $post['order_fh']=="1"){ //发货 邮件发 送给客户
			        	//     $M_Open=CheckConfig($db_conn,"web_mailopen");
			         //   	    if($M_Open==1){
				        //    	    	$M_Title   = "@来自".$SERVER_NAME."的客户留言";
				        //    	    	$M_Content = "邮箱 : ".$post['msg_email']."<br>内容 : ".$post['msg_content']."<br>时间 : ".$time."<br>IP : ".$ip."<br>详细信息进网站后台查看！！！";
				        //    	    	   SendMail($M_Smail,$M_Umail,$M_Pmail,$M_Tmail,$M_Dmail,$M_Jmail,$M_Title,$M_Content); //发送给自已
		          //  	          }      	
	           //           }
	                     

	                    if($table=="sc_delivery"){ //配送方式,修改区域物流ID
	                       $exid=$post['ex_id'].",";
	                       $de_area=implode(",", $post['de_area']);
	                       $db_conn->query("UPDATE sc_country SET expressid=replace(expressid,'$exid','') where ID not in($de_area)");	

	                       $db_conn->query("UPDATE sc_country SET expressid=concat(expressid,'$exid') where ID in($de_area) and expressid not like '%,".$exid."%'");

	                     }

						if($table=="sc_freeship"){ //单独设置区域的最低消费的免费金额
							if ($post['free_flag']=="4"){ // 4->是常量	
	 							$i=0;
								foreach ($CountryIDPrice as $value) {
									   $val=CheckStr($value);
									$db_conn->query("UPDATE sc_country SET exprssyf='$val' where ID=$CountryID[$i]");
								 $i=$i+1;	
								}
							}
						}

	                   echo "修改成功";
                   }else{
                       echo "修改失败";
                   }
	      }

}elseif($action=="Clear"){//删除

	if ($table=="sc_categories") { // 产品分类

	    if (($Ant->AntDelCat($table,$sortID,$db_conn))===true){ //分类通过路径删除所有相关的目录
			echo "删除成功";
	    }else{
	    	echo "删除失败";
	    }
	    #code.... 相关产品也要进行操作

	}elseif($table=="sc_products" || $table=="sc_info" || $table=="sc_country" || $table=="sc_express" || $table=="sc_delivery" || $table=="sc_currency" || $table=="sc_pay"  || $table=="sc_coupon" || $table=="sc_banner" || $table=="sc_menu" || $table=="sc_link" || $table=="sc_download" || $table=="sc_email" || $table=="sc_mailtemplate" || $table=="sc_mulu" || $table=="sc_user" || $table=="sc_language" || $table=="sc_order"|| $table=="sc_member" ||  $table=="sc_address" || $table=="sc_msg" || $table=="sc_words" || $table=="sc_cart"){ //产品删除

 	    if(empty($DID)){

 	    	echo 'err';

 	    }else{
 	    	$sortID=implode(",",$DID);

		    	if ($table=="sc_delivery"){ //删除国家区域对应的配送方式ID
			    	$exid=@$_GET['exid'];
			    	$CountryID=RecountryID($sortID,$db_conn);
			    	$db_conn->query("UPDATE sc_country SET expressid=replace(expressid,',$exid,',',') where ID in($CountryID)"); 
		    	}

		    if (($Ant->AntDel($table,$sortID,$db_conn))===true){
				echo "删除成功";
		    }else{
		    	echo "删除失败";
		    }			
      }
	}else{
		 
	    if (($Ant->AntDelother($table,$sortID,$db_conn))===true){
			echo "删除成功";
	    }else{
	    	echo "删除失败";
	    }		
	}

}elseif($action=="OpenOff"){ //显示与推荐	

		if (CheckStr($_GET['v'])==1){
			$vl=0;
		}else{
			$vl=1;
		}
		$val=CheckStr($_GET['f'])."='".$vl."'";
		if (($Ant->AntEdit($table,$val,$sortID,$db_conn))===true){
	           echo $vl;
           }else{
               echo "修改失败";
           }
}elseif($action=="Paixu"){ //排序

		$val=CheckStr($_GET['f'])."='".$_GET['v']."'";
		if (($Ant->AntEdit($table,$val,$sortID,$db_conn))===true){
	           echo "1";
           }else{
               echo "修改失败";
           }
}elseif($action=="Copy"){ //复制一条数据(产品)
	      $db_conn->query("insert into $table(products_name,products_category,products_key,products_des,products_guige,contents,products_sprice,products_oprice,products_zk,products_parner,products_l,products_w,products_h,products_zeke,products_similar,products_kucun,products_weight,products_dw,products_m,languageID,products_paixu,ant_img,Itemnb) SELECT products_name,products_category,products_key,products_des,products_guige,contents,products_sprice,products_oprice,products_zk,products_parner,products_l,products_w,products_h,products_zeke,products_similar,products_kucun,products_weight,products_dw,products_m,languageID,products_paixu,ant_img,$itemnb FROM $table where ID=$sortID");
	      header("Location: Ant_Pro.php?lgid=".$lgid);  

}elseif ($action=="Apply") { //模版应用

       if (isset($_GET['mb'])){
          $mb=CheckStr($_GET['mb']);
		  $val=" web_Template='".$mb."'";
		  $sortID=1;
		if (($Ant->AntEdit($table,$val,$sortID,$db_conn))===true){
	           echo "应用成功";
           }else{
               echo "应用失败";
           }
       }else{
       	   echo "操作错误";
       }
	 
}



//===//

function CheckEmpty($post,$sort){ //判断必填信息

	$str='';

	if($sort=="cat"){
		if ($post['category_name']=="" || $post['category_paixu']==""){
			$str='提示:分类名称与排序不能为空!';
		}else{
			$str="";
		}
	}
	return $str;
}

function CheckDatabase($sort,$tb=""){ //选择表

	if($sort=="cat"){
	   $tb="sc_categories";
	}elseif($sort=="pro"){
	   $tb="sc_products";
	}elseif($sort=="suxin"){
	   $tb="sc_suxin";
	}elseif($sort=="zeke"){
      $tb="sc_discount";
	}elseif($sort=="property"){
	  $tb="sc_property";
	}elseif($sort=="blogcat"){
	  $tb="sc_blogcat";
	}elseif($sort=="info"){
	  $tb="sc_info";
	}elseif($sort=="country"){
	  $tb="sc_country";
	}elseif($sort=="express"){
	  $tb="sc_express";
	}elseif($sort=="delivery"){
	  $tb="sc_delivery";
	}elseif($sort=="currency"){
	  $tb="sc_currency";
	}elseif($sort=="pay"){
	  $tb="sc_pay";
	}elseif($sort=="coupon"){
	  $tb="sc_coupon";
	}elseif($sort=="freeship"){
	  $tb="sc_freeship";
	}elseif($sort=="banner"){
	  $tb="sc_banner";
	}elseif($sort=="menu"){
	  $tb="sc_menu";
	}elseif($sort=="link"){
	  $tb="sc_link";
	}elseif($sort=="download"){
	  $tb="sc_download";
	}elseif($sort=="dyemail"){
	  $tb="sc_email";
	}elseif($sort=="mailtemplate"){
	  $tb="sc_mailtemplate";
	}elseif($sort=="Globals"){
	  $tb="sc_config";
	}elseif($sort=="mulu"){
	  $tb="sc_mulu";
	}elseif($sort=="users" || $sort=="Login"){
	  $tb="sc_user";
	}elseif($sort=="language"){
	  $tb="sc_language";
	}elseif($sort=="seo"){
	  $tb="sc_tagandseo";
	}elseif($sort=="lable"){
	  $tb="sc_lable";
	}elseif($sort=="order"){
		$tb="sc_order";
	}elseif($sort=="member"){
		$tb="sc_member";
	}elseif($sort=="address"){
		$tb="sc_address";
	}elseif($sort=="Message"){
		$tb="sc_msg";
	}elseif($sort=="sheck"){
		$tb="sc_words";
	}elseif($sort=="carcheck"){
		$tb="sc_cart";
	}

	return $tb;
}

function CheckInfo($sheet,$field,$str,$type,$fields,$db_conn){ //检查信息
    if ($type=="id") {
    	$query=$db_conn->query("SELECT * FROM $sheet WHERE $field=".$str."");
    }else{
    	$query=$db_conn->query("SELECT * FROM $sheet WHERE $field='".$str."'");
    }
    	$row=mysqli_fetch_assoc($query);
    	return $row[$fields];
}
