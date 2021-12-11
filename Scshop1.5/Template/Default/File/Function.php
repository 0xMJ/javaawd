<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/

if (isset($_GET['ID'])){$ID = CheckStr($_GET['ID']);}else{$ID = "";}
if (isset($_GET['ob'])){$ob = CheckStr($_GET['ob']);}else{$ob = "";}
//导航
function Memu($db_conn,$lgid,$web_url_mt,$nav=""){
   $str = ReadInfo($db_conn,"*","sc_menu","where languageID=$lgid and menu_open=1","order by menu_paixu,ID desc");
   if(!empty($str)){
	   for ($i=0; $i <count($str) ; $i++) {
	   	 if ($str[$i]['menu_link']=="/"){
	   	 	$link = "";
	   	 }else{
	   	 	$link = $str[$i]['menu_link'];
	   	 }
	   	 $nav.="<span><a href='".$web_url_mt.$link."'>".$str[$i]['menu_name']."</a></span>";
	   }
   }
   return CheckStr_d($nav);
 }

//Banner
function Banner($db_conn,$lgid,$web_url_mt,$flag,$Bner=""){
   $str = ReadInfo($db_conn,"*","sc_banner","where languageID=$lgid and banner_fenlei='$flag'","order by banner_paixu,ID desc");
   if(!empty($str)){
	   for ($i=0; $i <count($str); $i++) {
	   	 if($flag=="1"){ //首横幅
	   		$Bner.='<div class="swiper-slide"><a href="'.$str[$i]['banner_url'].'"><img src="'.$web_url_mt.rtrim(str_replace('../','',$str[$i]['ant_img']),",").'" alt=""></a></div>';
	   	 }else if($flag=="3"){ //首中部
	   	 	$Bner.='<div class="Ant_50banner"><a href="'.$str[$i]['banner_url'].'"><img src="'.$web_url_mt.rtrim(str_replace('../','',$str[$i]['ant_img']),",").'" alt=""></a></div>';
	   	 }else{ //页面左侧
			$Bner.='<div class="Ant_50banner"><a href="'.$str[$i]['banner_url'].'"><img src="'.$web_url_mt.rtrim(str_replace('../','',$str[$i]['ant_img']),",").'" alt=""></a></div>';
	   	 }
	   }
   }
   return CheckStr_d($Bner);
}
//首页推荐分类
function CatFeauture($db_conn,$lgid,$web_url_mt,$web_url,$CatFt=""){
	$str = ReadInfo($db_conn,"category_name,ant_img,category_url,ID","sc_categories","where languageID=$lgid and category_open=1 and category_tj=1","order by category_paixu,ID desc");
	if(!empty($str)){
		for ($i=0; $i <count($str); $i++) {
		$CatFt.='<div class="Ant_fcat">
					<ul>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'"><img src="'.$web_url_mt.rtrim(str_replace('../','',$str[$i]['ant_img']),",").'" alt="'.$str[$i]['category_name'].'"></a></li>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a></li>
					</ul>
				</div>';
		}
	}
	return CheckStr_d($CatFt);
}

//首页推荐产品
function ProFeauture($db_conn,$lgid,$web_url_mt,$web_url,$filedsname,$viewqty,$addtocart,$Products=""){
    $fileds=explode(",", "products_new,products_index,products_hot,products_tejia");
    $filedsname=explode(",", $filedsname);
    $viewqty=explode(",", $viewqty);
    $j=0;$plm="";$pls="";$x=0;
    foreach ($fileds as $value){
    	 $str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 and $value=1","order by products_paixu,ID desc limit $viewqty[$j]");
    	  if(!empty($str)){
			for ($i=0; $i <count($str); $i++) {
				$img=explode(",", $str[$i]['ant_img']);
				if (!empty($str[$i]['products_sx'])){
					$sxcookie = ":".CheckOneSxin($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb']); //属性
				}else{
					$sxcookie = "";
				}
				$cookieName =Ant_Cook("Cook_Qz").$str[$i]['ID'].$sxcookie;

				//2021-07-08 调用属性价格
                   if(!empty($str[$i]['products_sx'])){ 
                   		   $sxPrice = VsuxinPrice($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb'],$web_url_mt);
		                   if (!empty($sxPrice)){
							  $sprice = ChangeCur($db_conn,CheckStr_d($sxPrice));
		                     }else{
		                   	   $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));
		                   }
				    }else{
				      $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));	
				    }

				if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}
				$Products.='<div class="Ant_prolist"><ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'"><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></li><li class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'">'.$str[$i]['products_name'].'</a></li><li>'.$sprice.' '.$oprice.' </li><li><span lgid="'.$lgid.'" url="'.$web_url_mt.'" cookiename="'.$cookieName.'" class="Addcart trans">'.$addtocart.'</span></li></ul></div>';
	         }
	         if ($x<1){$ac_1=" class='Ant_select'";$ac_2=" style='display:block;'";}else{$ac_1="";$ac_2="";}
	         $plm.="<span".$ac_1.">".$filedsname[$j]."</span>";
	         $pls.="<div class='Ant_pnr A100'".$ac_2.">".$Products."</div>";
	         $Products="";
	         $x=$x+1;
    	  } 
    	  if ($plm!=""){
    	    $indexproudct='<div class="Ant_Proltab A100">'.$plm.'</div><div class="cb"></div><div class="action">'.$pls.'</div>';
    	     }else{
    	     $indexproudct="";	
    	     }
    $j=$j+1;
    }
    return CheckStr_d($indexproudct);
}

//页面左部最新产品
function PageNewPro($db_conn,$web_url,$web_url_mt,$lgid){
	$Products="";
	$str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 ","order by products_paixu,ID desc limit 5");
	if(!empty($str)){
			for ($i=0; $i <count($str); $i++) {
				$img=explode(",", $str[$i]['ant_img']);
				if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}
				$Products.='<div class="Ant_left_pro"><ol><dt><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'"><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></dt><dd class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'">'.$str[$i]['products_name'].'</a></dd><dd>'.ChangeCur($db_conn,$str[$i]['products_sprice']).' '.$oprice.' </dd></ol></div>';
	         }		
	}
	return CheckStr_d($Products);
}

//首页推荐博客
function IndexBlog($db_conn,$lgid,$web_url_mt,$web_url,$readmore,$lastblog,$Blog=""){
   $str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and info_tj=1 and info_flag='B'","order by info_paixu,ID desc limit 3");
    	  if(!empty($str)){
    	  	for ($i=0; $i <count($str); $i++) {
				$Blog.='<div class="Ant_blog">
					<ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'"><img src="'.$web_url_mt.str_replace("../","",trim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['info_title'].'"></a></li>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'">'.$str[$i]['info_title'].'</a></li>
						<li class="Ant_4hs">'.$str[$i]['info_des'].'</li>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'">'.$readmore.'</a></li>
					</ul>
				</div>';
			}
			$Blog='<div class="Ant_bigtitle A100">'.$lastblog.'</div><div class="Ant_nr A100">'.$Blog.'</div><div class="cb"></div>';
    	  }
    	  return CheckStr_d($Blog);
}

//尾部栏目
function Foot($db_conn,$lgid,$web_url,$Lable,$type,$foot=""){
   if($type=="About"){
   	 $str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and info_flag='A'","order by info_paixu,ID desc limit 5");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $foot.='<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"av").'">'.$str[$i]['info_title'].'</a></li>';
	   	 }
	   	 $foot="<ul><li>".$Lable."</li>".$foot."</ul>";
   	  }
   }elseif($type=="Service"){
   	 $str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and info_flag='S'","order by info_paixu,ID desc limit 5");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $foot.='<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"sv").'">'.$str[$i]['info_title'].'</a></li>';
	   	 }
	   	 $foot="<ul><li>".$Lable."</li>".$foot."</ul>";
   	  }
   }elseif($type=="Catlist"){
   	 $str = ReadInfo($db_conn,"*","sc_categories","where languageID=$lgid and category_open=1 and category_pid=0","order by category_paixu,ID desc limit 5");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $foot.='<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a></li>';
	   	 }
	   	 $foot="<ul><li>".$Lable."</li>".$foot."</ul>";
   	  }
   }
   return CheckStr_d($foot);
}

//产品分类
function Get_Cat($lgid,$web_url,$db_conn,$Cats="") { //无限分类
    $str = ReadInfo($db_conn,"*","sc_categories","where languageID=$lgid and category_open=1 and category_pid=0","order by category_paixu,ID desc");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $Cats.='<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a> <i class="fa fa-angle-right sright" aria-hidden="true"></i>'.Get_Cat_next($str[$i]['ID'],$web_url,$db_conn).'</li>';
	   	 }
   	  }
      return CheckStr_d($Cats);
}
function Get_Cat_next($id,$web_url,$db_conn,$Cat="") { //无限
    $str = ReadInfo($db_conn,"*","sc_categories","where category_open=1 and category_pid=$id","order by category_paixu,ID desc");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $Cat.='<li><i class="fa fa-genderless" aria-hidden="true"></i><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a>'.Get_Cat_next($str[$i]['ID'],$web_url,$db_conn).'</li>';
	   	 }
	   	 $Cat="<ul>".$Cat."</ul>";
   	  }
      return CheckStr_d($Cat);
}

//调用产品分类
function Get_Cat_Ne($id,$idt,$web_url,$db_conn,$Cat=""){  

    if ($idt==0){$idt=$id;}
    $str = ReadInfo($db_conn,"*","sc_categories","where category_open=1 and (category_pid=$id or category_pid=$idt)","order by category_paixu,ID desc");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	  $Cat.='<span><i class="fa fa-genderless" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a></span>';
	   	 }
	   	 
   	  }
      return CheckStr_d($Cat);
}


//产品列表
function ProList($db_conn,$web_url_mt,$web_url,$lgid,$ID,$lable_pro,$addtocart,$lable_fy,$Webviewlist,$px,$sortby,$ob,$Products=""){
     
    //调用栏目信息
	if(!empty($ID)){ 
		if (is_numeric($ID)){
		 	  $str = ReadInfo($db_conn,"ID,category_name,contents,category_mtitle,category_url,category_pid","sc_categories","where ID=$ID and languageID=$lgid and category_open=1","");		
		}else{
		      $str = ReadInfo($db_conn,"ID,category_name,contents,category_mtitle,category_url,category_pid","sc_categories","where category_url='$ID' and languageID=$lgid and category_open=1","");				
		}
	   	if(!empty($str)){
		   	 for ($i=0; $i <count($str); $i++) {
	 			$CatName = $str[$i]['category_name'];
	 			$CatDest = $str[$i]['contents'];
	 			$CatID = $str[$i]['ID'];
	 			$Where = "and ".CheckCatID($lgid,$CatID,$db_conn);
	 			$sorturl = $web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl");
	 			$nexCat = Get_Cat_Ne($str[$i]['ID'],$str[$i]['category_pid'],$web_url,$db_conn);
		   	 }
		   	 
	   	}else{
	   		To404();
	   	}

	 }else{     
	 			$CatName = $lable_pro;
	 			$CatDest = "";
	 			$CatID = "";
	 			$Where = "";
	 			$sorturl = $web_url."product/";
	 			$nexCat = Get_Cat_Ne(0,0,$web_url,$db_conn);
	 }
     
     $px=explode("||", $px);
     $sortbylist="";
     $opx="ID.asc,ID.desc,price.asc,price.desc,name.asc,name.desc";
     $opx=explode(",", $opx);
     $l=0;
     foreach ($px as  $value) {
     	 $sortbylist.="<li><i class='fa fa-angle-right' aria-hidden='true'></i> <a href='".$sorturl."?ob=".$opx[$l]."'>".$value."</a></li>";
     	 $l=$l+1;
     }
     if(!empty($ob)){
     	$ob = str_replace("ID.","ID ",str_replace("name.","products_name ",str_replace("price.", "products_sprice ", $ob)));
     }else{
     	$ob = "products_paixu,ID desc";
     } 
	 if(!empty($CatDest)){$CatDest='<li>'.$CatDest.'</li>';}
	 $protop='<div class="Ant_plist_1 A100"><ul><li><h1>'.$CatName.'</h1></li><li>'.$nexCat.'</li>'.$CatDest.'</ul></div><div class="cb"></div>';
	 //读取产品信息
	 $str = ReadInfo($db_conn,"ID","sc_products","where languageID=$lgid and products_zt=1 $Where","");
 	 if (!empty($str)){
	  $all_num=count($str);
	 }else{
	  $all_num=0;	
	 }
     $page_num=$Webviewlist; //每页条数
     $page_all_num = ceil($all_num/$page_num); //总页数
     $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
     $page=(int)$page; //安全强制转换
     $limit_st = ($page-1)*$page_num; //起始数
	 $str = ReadInfo($db_conn,"ID,ant_img,products_name,products_sprice,products_oprice,products_url,products_sx,Itemnb","sc_products","where languageID=$lgid and products_zt=1 $Where","order by $ob limit $limit_st,$page_num");
	if(!empty($str)){
		  for ($i=0; $i <count($str); $i++) {
				$img=explode(",", $str[$i]['ant_img']);
				if (!empty($str[$i]['products_sx'])){
					$sxcookie = ":".CheckOneSxin($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb']); //属性
				}else{
					$sxcookie = "";
				}
				$cookieName =Ant_Cook("Cook_Qz").$str[$i]['ID'].$sxcookie;

				// 2021-07-08 属性价格调用

                   if(!empty($str[$i]['products_sx'])){ 
                   		   $sxPrice = VsuxinPrice($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb'],$web_url_mt);
		                   if (!empty($sxPrice)){
							  $sprice = ChangeCur($db_conn,CheckStr_d($sxPrice));
		                     }else{
		                   	   $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));
		                   }
				    }else{
				      $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));	
				    }



				if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}
				$Products.='<div class="Ant_prolist"><ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank"><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></li><li class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank">'.$str[$i]['products_name'].'</a></li><li>'.$sprice.' '.$oprice.' </li><li><span lgid="'.$lgid.'" url="'.$web_url_mt.'" cookiename="'.$cookieName.'" class="Addcart trans">'.$addtocart.'</span></li></ul></div>';
		  }
		  $Products='<div class="Ant_plist_3 A100">'.$Products.'</div>';
      }
      $pronub = str_replace('{TS}', $all_num, $lable_fy); 
      $propx = '<div class="Ant_plist_2 A100"><span>'.$pronub.'</span><span class="sortbys">'.$sortby.' <i class="fa fa-angle-down" aria-hidden="true" id="sright"></i><div class="Ant_sortby"><ul>'.$sortbylist.'</ul></div></span></div>';
       if($page_all_num>1){
       	  $fy = show_page($all_num,$page,$page_num);
        }else{
          $fy = "";
        }
      $profy = '<div class="Ant_plist_2 A100 Ant_fy"><span>'.$fy.'</span><span>'.$pronub.'</span></div>';
      $Products = $protop.$propx.$Products.$profy;
      return CheckStr_d($Products);
}

// 查询所有分类的ID
function CheckCatID($lgid,$ID,$db_conn,$st=""){
	$str = ReadInfo($db_conn,"*","sc_categories","where category_path like '%,".$ID.",%' and languageID=$lgid and category_open=1","");
	if(!empty($str)){
		for ($i=0; $i<count($str); $i++) { 
			$st.= "LOCATE(',".$str[$i]['ID'].",', products_category)>0 or ";
		}
		$st = "(".rtrim($st,"or ").")";
	}
    return $st;
}

//产品详细页面
function ViewInfo($db_conn,$ID,$lgid,$str=""){
	if (!empty($ID)){
		 if (is_numeric($ID)){
			$str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 and ID=$ID","");
		   }else{
            $str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 and products_url='".$ID."'","");
		   }
		if(!empty($str)){
	 		return $str;
		}else{
		  To404();
		}
    }else{
    	 To404();
    }
}

//产品属性信息
function Vsuxin($db_conn,$SID,$itemnb,$web_url_mt){
	$SxName="";$suxinlist="";$st="";$suxin="";
	$SID=explode(",", $SID);
	foreach ($SID as $value) {
		$str = ReadInfo($db_conn,"*","sc_suxin","where ID=$value","");
		$SxName.= "<font class='Ant_Sxm'>".$str[0]['sx_name']." : </font><br>"; //属性名称
		$str = ReadInfo($db_conn,"*","sc_property","where suxin_id=$value and itemnb='$itemnb' and pt_xs=1","");
		if(!empty($str)){
			for ($i=0; $i<count($str); $i++) {
				if ($i==0){//属性边框
					$slct=" class='Ant_sx_select'";
				}else{
					$slct=" class='Ant_select_border'";
				}
				if (!empty($str[$i]['ant_img'])){//属性图片
					$sximg = "<img src='".$web_url_mt.str_replace("../","",rtrim($str[$i]['ant_img'],","))."' alt='".$str[$i]['pt_name']."' align='absmiddle'>";
				}else{
					$sximg="";
				}
				$suxinlist.="<span data='sp".$value."' titles='".ChangeCur($db_conn,CheckStr_d($str[$i]['pt_price']),"no")."' id='".$value."_".$str[$i]['ID']."'".$slct.">".$sximg.$str[$i]['pt_name']."</span>";
			}
			$suxinlist.="<input type='hidden' id='sx".$value."'   value='".$value."_".$str[0]['ID']."' name='sx".$value."' >";
			$suxin.="sx".$value.","; //属性ID
		}
       $st.= "<li id='sp".$value."'>".$SxName.$suxinlist."</li>";
       $suxinlist="";$SxName="";
	}
	return $st."<input type='hidden' value='".$suxin."qty' name='canshu' id='canshu' fh='".ChangeCur($db_conn,"0","fh")."' >";
}
//产品属性信息价格 
function VsuxinPrice($db_conn,$SID,$itemnb,$web_url_mt){
	$ptPrice="";$pric=0;
	$SID=explode(",", $SID);
	foreach ($SID as $value) {
		$str = ReadInfo($db_conn,"*","sc_property","where suxin_id=$value and itemnb='$itemnb' and pt_xs=1","");
		if(!empty($str)){

			 $ptPrice .= $str[0]['pt_price'].",";

		}
	}
	$ptPrice=rtrim($ptPrice,",");
	$ptPrice=explode(",", $ptPrice);

	foreach ($ptPrice as $value) {
		 
		 $pric = $pric+$value;
	}

	//rsort($ptPrice);
	return $pric;
	 
}

// 汇率显示
function CurList($db_conn,$web_url_mt,$lable,$cur=""){
	$CurID = "";

	if (isset($_COOKIE['CurID'])){
		$CurID = $_COOKIE['CurID'];
	}else{
		$str = ReadInfo($db_conn,"*","sc_currency","where currency_flag=1 and currency_default=1","");
		if(!empty($str)){
			for ($i=0; $i <count($str) ; $i++) { 
				 $CurID = $str[$i]['ID'];
			}
		}
	}
   if (!empty($CurID)){
   	  $str = ReadInfo($db_conn,"*","sc_currency","where currency_flag=1 and ID=$CurID","");
		if(!empty($str)){
			for ($i=0; $i <count($str) ; $i++) { 
				 $NubOne = '<img src='.$web_url_mt.rtrim(str_replace("../", "", $str[$i]['ant_img']),",").' alt="'.$str[$i]['currency_bz_fh'].'"> '.$str[$i]['currency_bz_fh'].' '.$str[$i]['currency_left_fh'].' <i class="fa fa-angle-down" aria-hidden="true"></i>';
			}
		}else{
			$NubOne = "";
			echo "<script>alert('err->please setting currency');</script>";
   		    exit;
		}	  
   }else{
   		$NubOne = "";
   		echo "<script>alert('please setting currency');</script>";
   		exit;
   }
   $str = ReadInfo($db_conn,"*","sc_currency","where currency_flag=1 and ID<>$CurID","order by currency_paixu,ID desc");
   	 if(!empty($str)){
	   	 for ($i=0; $i <count($str); $i++) {
	   	 	$cur.='<li onclick="ChangeCur(\''.$str[$i]['ID'].'\',\''.$web_url_mt.'Core/Program/Ant_Aajx.php\');"><img src='.$web_url_mt.rtrim(str_replace("../", "", $str[$i]['ant_img']),",").' alt="'.$str[$i]['currency_bz_fh'].'"> '.$str[$i]['currency_bz_fh'].' '.$str[$i]['currency_left_fh'].'</li>';
	   	 }
	   	// $cur='<span class="curres"><i class="fa fa-usd" aria-hidden="true"></i> '.$lable.' '.$NubOne.'<div class="curre"><ul>'.$cur.'</ul></div></span>';
	   	 $cur=' <span class="curres">'.$NubOne.'<div class="curre"><ul>'.$cur.'</ul></div></span>';
	   }
	   return CheckStr_d($cur);
}

//产品分类Meta信息

function CatMeta($db_conn,$ID,$lgid){
	if(!empty($ID)){ 
		if (is_numeric($ID)){
		 	  $str = ReadInfo($db_conn,"ID,category_mtitle,category_name,category_key,category_des","sc_categories","where ID=$ID and languageID=$lgid and category_open=1","");
		}else{
		      $str = ReadInfo($db_conn,"ID,category_mtitle,category_name,category_key,category_des","sc_categories","where category_url='$ID' and languageID=$lgid and category_open=1","");		
		}
		for ($i=0; $i <count($str); $i++) {
			if(!empty($str[$i]['category_mtitle'])){
				$meat_t = $str[$i]['category_mtitle'];
			}else{
				$meat_t = $str[$i]['category_name'];
			}
			    $meat_k = $str[$i]['category_key'];
			    $meat_d = $str[$i]['category_des'];
			    $meat_id = $str[$i]['ID'];
		}
	 }else{
		    $str = ReadInfo($db_conn,"tag_p_title,tag_p_key,tag_p_des","sc_tagandseo","where languageID=$lgid","");
		    for ($i=0; $i <count($str); $i++) {
		    	$meat_t = $str[$i]['tag_p_title'];
		    	$meat_k = $str[$i]['tag_p_key'];
		    	$meat_d = $str[$i]['tag_p_des'];
		    	$meat_id = "0";
		     }	 	
	 }
	 $Meat=array('mt'=>CheckStr_d($meat_t),'mk'=>CheckStr_d($meat_k),'md'=>CheckStr_d($meat_d),'mid'=>CheckStr_d($meat_id));
	 return $Meat;
}

//blog分类Meta信息

function BlogMeta($db_conn,$ID,$lgid){
	if(!empty($ID)){ 
		if (is_numeric($ID)){
		 	  $str = ReadInfo($db_conn,"*","sc_blogcat","where ID=$ID and languageID=$lgid and b_open=1","");
		}else{
		      $str = ReadInfo($db_conn,"*","sc_blogcat","where b_url='$ID' and languageID=$lgid and b_open=1","");		
		}
		for ($i=0; $i <count($str); $i++) {
			if(!empty($str[$i]['b_title'])){
				$meat_t = $str[$i]['b_title'];
			}else{
				$meat_t = $str[$i]['b_name'];
			}
			    $meat_k = $str[$i]['b_key'];
			    $meat_d = $str[$i]['b_des'];
			    $meat_id = $str[$i]['ID'];
		}
	 }else{
		    $str = ReadInfo($db_conn,"tag_n_title,tag_n_key,tag_n_des","sc_tagandseo","where languageID=$lgid","");
		    for ($i=0; $i <count($str); $i++) {
		    	$meat_t = $str[$i]['tag_n_title'];
		    	$meat_k = $str[$i]['tag_n_key'];
		    	$meat_d = $str[$i]['tag_n_des'];
		    	$meat_id="0";
		     }	 	
	 }
	 $Meat=array('mt'=>CheckStr_d($meat_t),'mk'=>CheckStr_d($meat_k),'md'=>CheckStr_d($meat_d),'mid'=>CheckStr_d($meat_id));
	 return $Meat;
}

//查询最新优惠码
function CheckCouncode($db_conn,$type){
 
  $str = ReadInfo($db_conn,"*","sc_coupon","where cou_flag=1 and to_days(cou_overtime)>=to_days(now())","order by ID desc limit 1");
  if (!empty($str)){

      if ($type=="bot"){ //底部订阅
          $couponID = $str[0]['ID'];
          $couponcode = $str[0]['cou_code'];
          $coupon = '<input type="hidden" name="e_couid" value="'.$couponID.'"><input type="hidden" name="e_coucode" value="'.$couponcode.'">';
      }elseif($type=="sub"){ //弹出窗订阅

      }

  }else{
          $coupon = '<input type="hidden" name="e_couid" value=""><input type="hidden" name="e_coucode" value="">';
  }
  return $coupon;

}

//Blog 列表页面

function Bloglist($db_conn,$ID,$readmore,$web_url_mt,$web_url,$lgid,$Webviewlist,$lable_fy,$wblog){
   $Blog="";$info="";
	if(!empty($ID)){ 
		if (is_numeric($ID)){
		 	  $str = ReadInfo($db_conn,"*","sc_blogcat","where ID=$ID and languageID=$lgid and b_open=1","");		
		}else{
		      $str = ReadInfo($db_conn,"*","sc_blogcat","where b_url='$ID' and languageID=$lgid and b_open=1","");				
		}
	   	if(!empty($str)){
	 		  $CatName = $str[0]['b_name'];
	 		  $CatDest = $str[0]['contents'];
	 		  $CatID = $str[0]['ID'];
	 		  $Where = " and info_cat=".$CatID;
	   	}else{
	   		To404();
	   	}
	 }else{     
	 		 $CatName = $wblog;
	 		 $CatDest = "";
	 		 $Where = "";
	 }
     $blogtop='<div class="Ant_blog_right_1"><h1>'.$CatName.'</h1></div><div class="cb"></div>';
	 $str = ReadInfo($db_conn,"ID","sc_info","where languageID=$lgid and info_open=1 and info_flag='B' $Where","");
	 if(!empty($str)){
	    $all_num=count($str);
	 }else{
		$all_num=0;
	 }
     $page_num=$Webviewlist; //每页条数
     $page_all_num = ceil($all_num/$page_num); //总页数
     $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
     $page=(int)$page; //安全强制转换
     $limit_st = ($page-1)*$page_num; //起始数
	 $str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and info_flag='B' $Where","order by info_paixu,ID desc limit $limit_st,$page_num");
	if(!empty($str)){
		  for ($i=0; $i <count($str); $i++) {
				$Blog.='<div class="Ant_blog">
					<ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'"><img src="'.$web_url_mt.str_replace("../","",trim($str[$i]['ant_img'],",")).'" alt="'.$str[$i]['info_title'].'"></a></li>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'">'.$str[$i]['info_title'].'</a></li>
						<li class="Ant_4hs">'.$str[$i]['info_des'].'</li>
						<li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['info_url'],"bv").'">'.$readmore.'</a></li>
					</ul>
				</div>';
		  }
		  $info='<div class="Ant_blog_right_2">'.$Blog.'</div>';
      }
         $pronub = str_replace('{TS}', $all_num, $lable_fy); 
       if($page_all_num>1){
       	  $fy = show_page($all_num,$page,$page_num);
        }else{
          $fy = "";
        }
        $info = $blogtop.$info.'<div class="Ant_plist_2 A100 Ant_fy"><span>'.$fy.'</span><span>'.$pronub.'</span></div>';
        return $info;
}

//blog 分类显示
function BlogCat($db_conn,$lgid,$web_url){
	 $bloglist = "";
	 $str = ReadInfo($db_conn,"*","sc_blogcat","where languageID=$lgid and b_open=1 ","order by b_paixu,ID desc");
	 if (!empty($str)){
	 	for ($i=0; $i <count($str) ; $i++) { 
	 		 $bloglist.='<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['b_url'],"bl").'">'.$str[$i]['b_name'].'</a></li>';
	 	}
	 }
	 return $bloglist;
}

//信息显示
function InfoView($db_conn,$ID,$lgid,$str=""){
	if (!empty($ID)){
		 if (is_numeric($ID)){
			$str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and ID=$ID","");
		   }else{
            $str = ReadInfo($db_conn,"*","sc_info","where languageID=$lgid and info_open=1 and info_url='".$ID."'","");
		   }
		if(!empty($str)){
	 		return $str;
		}else{
		  To404();
		}
    }else{
    	 To404();
    }
}

//上一条下一条(博客与信息)
function NextPrev($db_conn,$ID,$lgid,$table,$type,$web_url,$where,$bv,$np=""){
	if (!empty($ID)){
		if ($type=="next"){
	        $str = ReadInfo($db_conn,"*",$table,"where languageID=$lgid and info_open=1 and ID>$ID and $where ","limit 1");
	        $arr = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
	    }else{
	    	$str = ReadInfo($db_conn,"*",$table,"where languageID=$lgid and info_open=1 and ID<$ID and $where ","limit 1");
	    	$arr = '<i class="fa fa-angle-left" aria-hidden="true"></i>';
	    }
	    if(!empty($str)){
	    	$np = '<li>'.$arr.' <a href="'.$web_url.UrltoHtml($str[0]['ID'],$str[0]['info_url'],$bv).'">'.$str[0]['info_title'].'</a></li>';
	    }
    }
    return $np;
}
//上一条下一条(产品)
function PNextPrev($db_conn,$ID,$lgid,$table,$type,$web_url,$bv,$np=""){
	if (!empty($ID)){
		if ($type=="next"){
	        $str = ReadInfo($db_conn,"*",$table,"where languageID=$lgid and products_zt=1 and ID>$ID  ","limit 1");
	        $arr = '<i class="fa fa-chevron-right" aria-hidden="true"></i>';
	    }else{
	    	$str = ReadInfo($db_conn,"*",$table,"where languageID=$lgid and products_zt=1 and ID<$ID  ","limit 1");
	    	$arr = '<i class="fa fa-chevron-left" aria-hidden="true"></i>';
	    }
	    if(!empty($str)){
	    	$np = '<span><a href="'.$web_url.UrltoHtml($str[0]['ID'],$str[0]['products_url'],$bv).'" title="'.$str[0]['products_name'].'">'.$arr.'</a></span>';
	    }
    }
    return $np;
}

//查询Blog分类
function CheckBlogCat($db_conn,$ID,$lgid,$web_url){
    $blogcat = "";
	$str = ReadInfo($db_conn,"*","sc_blogcat","where languageID=$lgid and b_open=1 and ID=$ID","");
	if(!empty($str)){
		$blogcat = '<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[0]['ID'],$str[0]['b_url'],"bl").'">'.$str[0]['b_name'].'</a>';
	}
	return CheckStr_d($blogcat);
}

//查询产品分类
function CheckCat($db_conn,$ID,$lgid,$web_url){
	$catmulu="";
	$str = ReadInfo($db_conn,"*","sc_categories","where languageID=$lgid and ID in($ID)","");
	if(!empty($str)){
	for ($i=0; $i <count($str) ; $i++) { 
		$catmulu.= '<i class="fa fa-angle-right" aria-hidden="true"></i> <a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['category_url'],"pl").'">'.$str[$i]['category_name'].'</a>';
		}
	}
	return CheckStr_d($catmulu);
}

//相关产品
function ReProducts($db_conn,$lgid,$catid,$reprid,$web_url_mt,$web_url){
	$Products = "";
	if (!empty($reprid)){
	    $str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 and ID in($reprid)","");
    }else{
    	$str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 and products_category like '%,".$catid.",%' ","limit 10");
    }
    if(!empty($str)){
			for ($i=0; $i <count($str); $i++) {
				$img=explode(",", $str[$i]['ant_img']);
				if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}
				//2021-07-08 调用属性价格
                   if(!empty($str[$i]['products_sx'])){ 
                   		   $sxPrice = VsuxinPrice($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb'],$web_url_mt);
		                   if (!empty($sxPrice)){
							  $sprice = ChangeCur($db_conn,CheckStr_d($sxPrice));
		                     }else{
		                   	   $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));
		                   }
				    }else{
				      $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));	
				    }


				$Products.='<div class="swiper-slide"><ul class="Ant_Repro"><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'"><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></li><li class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'">'.$str[$i]['products_name'].'</a></li><li>'.$sprice.' '.$oprice.' </li></ul></div>';
	         }
    }
    return CheckStr_d($Products);
}

//查询评论
function ChekReviews($db_conn,$ID,$type=""){
    $vreviews=""; $sta="";
	$str = ReadInfo($db_conn,"*","sc_msg","where msg_pid=$ID and msg_type=1 "," order by ID desc");
	if (!empty($str)){
		for ($i=0; $i <count($str) ; $i++) { 
			if ($type==""){
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
		 	$vreviews.='<ul><li><i class="fa fa-user-circle-o" aria-hidden="true"></i> <strong>'.$str[$i]['msg_name'].'</strong> '.date("Y-m-d",strtotime($str[$i]['msg_time'])).'</li>
		 	<li>'.$sta.'</li>
		 	<li><i class="fa fa-commenting-o" aria-hidden="true"></i> '.$str[$i]['msg_content'].'</li>'.$re.'</ul>';
		 	$sta="";
		 }else{
		 	$ij=$i+1;
		 	$vreviews=$ij;
		 }
		}
	}else{
		if($type=="js"){$vreviews=0;}
	}
	return CheckStr_d($vreviews);
}

//查询产品
function CheckSearchProduct($db_conn,$addtocart,$lgid,$web_url_mt,$web_url,$where,$resutsearh){
  $Products = "";
  $str = ReadInfo($db_conn,"*","sc_products","where languageID=$lgid and products_zt=1 $where ","order by products_paixu,ID desc limit 50");
  if(!empty($str)){
			for ($i=0; $i <count($str); $i++) {
				$img=explode(",", $str[$i]['ant_img']);
				if (!empty($str[$i]['products_sx'])){
					$sxcookie = ":".CheckOneSxin($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb']); //属性
				}else{
					$sxcookie = "";
				}
				$cookieName =Ant_Cook("Cook_Qz").$str[$i]['ID'].$sxcookie;
				if(!empty($str[$i]['products_oprice'])){$oprice='<s>'.ChangeCur($db_conn,$str[$i]['products_oprice']).'</s>';}else{$oprice="";}

				//2021-07-08 调用属性价格
                   if(!empty($str[$i]['products_sx'])){ 
                   		   $sxPrice = VsuxinPrice($db_conn,$str[$i]['products_sx'],$str[$i]['Itemnb'],$web_url_mt);
		                   if (!empty($sxPrice)){
							  $sprice = ChangeCur($db_conn,CheckStr_d($sxPrice));
		                     }else{
		                   	   $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));
		                   }
				    }else{
				      $sprice = ChangeCur($db_conn,CheckStr_d($str[$i]['products_sprice']));	
				    }

				
				$Products.='<div class="Ant_prolist"><ul><li><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank" ><img src="'.$web_url_mt.str_replace("../Images/product/", "Images/product/small/", $img[0]).'" alt="'.$str[$i]['products_name'].'"></a></li><li class="Ant_2hs"><a href="'.$web_url.UrltoHtml($str[$i]['ID'],$str[$i]['products_url'],"pv").'" target="_blank">'.$str[$i]['products_name'].'</a></li><li>'.$sprice.' '.$oprice.' </li><li><span lgid="'.$lgid.'" url="'.$web_url_mt.'" cookiename="'.$cookieName.'" class="Addcart trans">'.$addtocart.'</span></li></ul></div>';
	         }
  }else{
  	$Products = '<div class="Ant_search_reuslut"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> '.$resutsearh.'</div>';
  }
  return CheckStr_d($Products);
}


