<?php
function OnlyId(){ //唯一码

  return mt_rand(1,10000).uniqid().mt_rand(1,10000);

}

function Suxin($db_conn,$itemnb=""){ //后台属性

   $suxin="";
   $query=$db_conn->query("select * from sc_suxin where sx_flag=1 order by sx_paixu, ID desc "); 
    if (mysqli_num_rows($query)>0){    
       while($row=mysqli_fetch_array($query)){
          $suxin.='<dd><span><b>'.$row['sx_name'].'</b></span> <span class="addspan" dataID="'.$row['ID'].'" dataName="'.$row['sx_name'].'" >增加规格 <i class="fa fa-plus-square" aria-hidden="true"></i></span><br><p id="s'.$row['ID'].'"></p><script> htmlobj=$.ajax({url:"Ant_Ajax.php?suxin_id='.$row['ID'].'&itemnb='.$itemnb.'&sort=property",async:false});$("#s'.$row['ID'].'").html(htmlobj.responseText);</script></dd>';
       }
       return $suxin;
     }else{
      return "<dd><span><a href='Ant_Suxin.php'>暂无属性,先添加属性 <i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i></a></span></dd>";
     }
   
}

function Zeke($db_conn,$zkid=""){ //后台折扣list

       $query=$db_conn->query("select  * from sc_discount order by di_paixu,ID desc");
       if (mysqli_num_rows($query)>0){ 
         while($row=mysqli_fetch_array($query)){
            if ($zkid==$row['ID']){ $slect="selected";}else{$slect="";}
            echo ' <option value ="'.$row['ID'].'" '.$slect.'>'.$row['di_name'].'</option>';
         }
      }
}

function ReadCatName($db_conn,$id){ //取产品分类名称
       $str="";
       $query=$db_conn->query("select  * from sc_categories where ID in($id)");
       if (mysqli_num_rows($query)>0){ 
         while($row=mysqli_fetch_array($query)){
            $str.=$row['category_name'].",";
         }
         return trim($str,",");
      }

}

function ReadBlogCatName($db_conn,$id){ //取Blog分类名称
 
       $query=$db_conn->query("select  * from sc_blogcat where ID =$id");
       if (mysqli_num_rows($query)>0){ 
         while($row=mysqli_fetch_array($query)){
            $str=$row['b_name'];
         }
         return trim($str);
      }
}

//无限级分类目录

function get_str($id,$lgid,$types,$db,$FileSelf) { 

    global $str;
    $result=$db->query("select * from sc_categories where category_pid=$id and languageID=$lgid order by category_paixu asc,ID asc");
    //如果有子类
    if($result){
        while ($row = mysqli_fetch_array($result)) { //循环记录集 
         $js="┖";
         $retArr =explode(',',$row['category_path']);
         $countd=count($retArr)-3;
         $kg="";
          for($i=0;$i<$countd;$i++) {
              $kg=$kg."&nbsp;&nbsp;";
           }
           $ant_img=trim($row['ant_img'],",");
         if (empty($ant_img)){$mg='<i class="fa fa-file-image-o" aria-hidden="true"></i>';}else{ $mg='<img src="'.trim($row['ant_img'],",").'" width="30" title="点击可放大" id="simg'.$row['ID'].'"><div id="img'.$row['ID'].'" style="position:absolute;left:5px; display:none; z-index:10;top:2px;padding:5px;border:1px solid #efefef; background:#fff;"><img src="'.trim($row['ant_img'],",").'"" width="300"></div>';} 
         if ($row['category_open']==1){$on="on";}else{$on="off";}
         if ($row['category_tj']==1){$ons="on";}else{$ons="off";} 
               $str .= "<tr><td>".$row['ID']."</td><td onclick=\"imgzooms('img".$row['ID']."');\" onmouseleave=\"imgzoom('img".$row['ID']."');\" style='position:relative;'>".$mg."</td><td  ><span class='l1'>".$kg.$js."</span> ".CheckStr_d($row['category_name']). " </td><td><i onclick=\"OnOff('OpenOff','".$row['ID']."','cat','category_open','".$row['category_open']."','open');\" class='trans fa fa-toggle-on fa-2x ".$on."'  aria-hidden='true' id='open".$row['ID']."' ></td><td><i onclick=\"OnOff('OpenOff','".$row['ID']."','cat','category_tj','".$row['category_tj']."','tj');\" class='trans fa fa-toggle-on fa-2x ".$ons."' aria-hidden='true' id='tj".$row['ID']."'></td><td onclick=px('px".$row['ID']."'); id='px".$row['ID']."'>".$row['category_paixu']."</td><td><span id='cpx".$row['ID']."' style='display:none'>action=Paixu&sortID=".$row['ID']."&sort=cat&f=category_paixu</span><span class='an_1 trans' onclick=\"location.href='?aed=a&sortID=".$row['ID']."&lgid=".$lgid."'\"><i class='fa fa-plus' aria-hidden='true'></i> 增加子级</span><span class='an_1 trans' onclick=\"location.href='?aed=e&sortID=".$row['ID']."&lgid=".$lgid."'\"> <i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i> 编辑</a></span><span class='an_1 trans' onclick=\"delCheck('Clear','".$row['ID']."','cat','".$FileSelf."');\"> <i class='fa fa-times' aria-hidden='true'></i> 删除 </span> </td></tr>"; //构建字符串 
            $kg="";
            $js="";
            get_str($row['ID'],$lgid,$types,$db,$FileSelf); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
       
    } 
    if($str==""){

        $str="<tr><td colspan='20'>暂无分类！</td></tr>";

    }else{

      $str=$str;

    }
    return $str; 
} 


//无限级分类目录-添加产品

function get_strs($id,$lgid,$types,$db,$loadid) { 

    global $strs;
    $result=$db->query("select * from sc_categories where category_pid=$id and languageID=$lgid and category_open=1 order by category_paixu asc,ID asc");
    //如果有子类
    if($result){
        while ($row = mysqli_fetch_array($result)) { //循环记录集 
         $js="┖";
         $retArr =explode(',',$row['category_path']);
         $countd=count($retArr)-3;
         $kg="";
          for($i=0;$i<$countd;$i++) {
              $kg=$kg."&nbsp;&nbsp;";
           } 

           if($types=="list"){
              if($loadid==$row['ID']){$checkd='selected="selected"';}else{$checkd="";}
              $strs.='<option value="'.$row['ID'].'" '.$checkd.'>'.$kg.$js."&nbsp;".CheckStr_d($row['category_name']).'</option>';
           }else{

            if(strpos($loadid,','.($row['ID'].','))!==false){$checkd=" checked";}else{$checkd="";}
            $strs.="<li><span class='l1'>".$kg.$js."</span> ".CheckStr_d($row['category_name']). " <input type='checkbox' datavalue='".CheckStr_d($row['category_name']). "' value='".$row['ID']."' name='products_category[]' ".$checkd."></li>";

             }  
            $kg="";
            $js="";
            get_strs($row['ID'],$lgid,$types,$db,$loadid); //调用get_str()，将记录集中的id参数传入函数中，继续查询下级 
        } 
    } 
    if($strs==""){
        $strs="<li>暂无分类！前往商品目录中添加</li>";
    }else{
      $strs=$strs;
    }
    return $strs; 
} 


//筛选调用产品分类ID

function ProCatId($ID,$db){  

    $str="";
    $strs=""; 
    $query=$db->query("select ID from sc_categories where LOCATE(',".$ID.",', category_path)>0 and category_open=1");

    while($row=mysqli_fetch_array($query)){
        
      $str.= "LOCATE(',".$row['ID'].",', products_category)>0 or ";

    } 
      $strs ="(".rtrim($str,"or ").")";

     return $strs;
}

//调用 blog 分类

function BlogCat($ID,$db,$lgid){
    $str="";
 
    $query=$db->query("select * from sc_blogcat where b_open=1 and languageID=$lgid order by b_paixu,ID desc");

    while($row=mysqli_fetch_array($query)){
          if($ID==$row['ID']){
            $slt='selected="selected"';
          }else{
            $slt="";
          }
      $str.= "<option value='".$row['ID']."' ".$slt." >".$row['b_name']."</option>";

    } 
     return $str;
}

//读取区域
function Country($type,$id,$db,$str=""){
    $where="";
    if ($type=="1"){
      $where="and expressid not like '%,".$id.",%'";
      $checd='';

    }elseif($type=="2"){
      $id=rtrim(ltrim($id,","),",");
      $where="and ID in($id)";
      $checd='checked="checked"';

    }elseif($type=="3"){
      $where="";
    }
    $query=$db->query("select * from sc_country where country_flag=1 $where order by country_paixu,ID desc");
    while($row=mysqli_fetch_array($query)){
      if ($type=="3"){
        $str.='<span><img src="'.trim($row['ant_img'],",").'"> '.$row['country_cn_name'].' <input type="hidden" size="5" name="countyid[]" value="'.$row['ID'].'" ><input type="text" class="ant_input29" name="exprssyf[]" value="'.$row['exprssyf'].'" onblur="value=value.replace(/[^\d\.]/g,\'\')" > </span>';
      }else{
      $str.='<span><input type="checkbox" name="de_area[]" value="'.$row['ID'].'" '.$checd.' /> <img src="'.trim($row['ant_img'],",").'"> '.$row['country_cn_name'].'</span>'; 
     }

    }  
    return $str;
}

//读取物流分配方式中所关联的区域ID

function RecountryID($ID,$db){
            $ctyID="";
            $query=$db->query("select * from sc_delivery where ID in($ID)");
            while($row=mysqli_fetch_array($query)){
                $ctyID.=trim($row['de_area'],",").",";
            }
            $cty= rtrim($ctyID,",");
            return $cty;
}
//后台账户权限 
function CheckUser($db,$type,$pags=""){

    $CookeUn=@CheckStr($_SESSION["ScuAdmin"]);
    $CookeUp=@CheckStr($_SESSION["ScuPass"]);
    $query=$db->query("select * from sc_user where user_admin='$CookeUn' and user_ps='$CookeUp'");
    if (mysqli_num_rows($query)>0){
         $rows=mysqli_fetch_assoc($query);
       if($type=="checkPage"){ //检测是否有权限操作此页面
            $PageCheck=Readpage($db,ltrim(rtrim($rows['user_qx'],","),","));
            if(strpos($PageCheck,$pags) !== false || $pags=="Ant_M_Delivery.php" || $pags=="Ant_upfile.php" || $pags=="Ant_Plist.php" || $pags=="Ant_left.php" || $pags=="Ant_top.php" || $pags=="Ant_mid.php" || $pags=="Ant_Sql.php" || $pags=="Ant_Outdata.php"){

            }else{
              echo "<script language='javascript'>alert('非法操作');window.history.go(-1);</script>";
              exit;
            }
         }elseif($type=="check"){ //菜单目录权限
            return $rows['user_qx'];
         }else{ //left页面用户信息
                if (trim($rows['ant_img'],",")!=""){
                  $img=trim($rows['ant_img'],",");
                }else{
                  $img='Image/User-performance.png';
                }
            return '<img src="'.$img.'"><br><font class="fontweight">'.$rows['user_name'].'</font><br><font class="fontline">'.$rows['user_admin'].'</font>';
         }
     }else{
        echo "<script language='javascript'>alert('账号密码不正确重新登陆!');top.location.href='index.php';</script>";
        exit; 
    }
}
//读取所有权限页面
function Readpage($db,$id,$pg=""){
              $query=$db->query("select * from sc_mulu where ID in($id)");
              while($rowb=mysqli_fetch_array($query)){
                $pg.=$rowb['ml_link'].",";
              }
              return $pg;
}
//后台管理菜单
function Menulist($db,$mulu,$type){

        $Qx=CheckUser($db,$type);

        $cion=',<i class="fa fa-cog" aria-hidden="true"></i>,<i class="fa fa-product-hunt" aria-hidden="true"></i>,<i class="fa fa-info-circle" aria-hidden="true"></i>,<i class="fa fa-shopping-bag" aria-hidden="true"></i>,<i class="fa fa-bars" aria-hidden="true"></i>,<i class="fa fa-search-plus" aria-hidden="true"></i>';
        $cions=explode(",", $cion);

        $i=0;$str="";
        foreach ($mulu as $key => $value) {
        
          if ($i>0){
              $query=$db->query("select * from sc_mulu where ml_id=$value order by ml_paixu,ID asc");
              while($row=mysqli_fetch_array($query)){
                if(strpos($Qx,",".$row['ID'].",") !== false){ 
                   $str.= '<a href="'.$row['ml_link'].'" target="mainFrame"><dd><i class="fa fa-angle-right" aria-hidden="true"></i> '.$row['ml_name'].'</dd></a>';
                 }
              } 
              if($i==1){$ve='';}else{$ve='style="display: none;"';}
              echo '<li>'.$cions[$i].' '.$key.' <i style="float: right; margin-top:3px;" class="fa fa-angle-down" aria-hidden="true"></i><ol '.$ve.'>'.$str.'</ol></li>';
              $str="";

          }

        $i=$i+1;
        }
}

//付款方式
function Paymenthod($paymethod,$val){
   foreach ($paymethod as $key => $value) {
      if ($val==$value){
        return $key;
        exit;
      }
   }
}

//查询物流

function CheckExps($db_conn,$ID,$express=""){
    $query=$db_conn->query("select * from sc_express where ID=$ID");
    while($rows=mysqli_fetch_array($query)){
      $img=rtrim($rows['ant_img'],",");
      $express = "<img src='".$img."' height='30' align='absmiddle'><br> ".$rows['ex_des'];
    }
    return CheckStr_d($express);
}

//查询 email
function CheckUserinfo($db_conn,$ID){
      $query=$db_conn->query("select * from sc_member where ID=$ID");
      $rows=mysqli_fetch_array($query);
      return CheckStr_d($rows['me_email']."<br>");
}

//产品查询
function CheckProduct($db_conn,$ID,$ProSuxin,$ProPrice,$ProQty,$ProSub,$curry,$i,$j){
      $plist="";
      $query=$db_conn->query("select * from sc_products where ID=$ID");
      $rows=mysqli_fetch_array($query);
      $imgs = explode(",", str_replace("produt/", "product/small/", $rows['ant_img']));
      $img = $imgs[0];
      $pnm = $rows['products_name'];
      $j=$i+1;
      $plist .="<tr><td>".$j."</td><td><img src='".$img."' width='80'></td><td>".$pnm."<br>".$ProSuxin[$i]."</td><td>".$curry.$ProPrice[$i]." x ".$ProQty[$i]."</td><td>".$curry.$ProSub[$i]."</td><tr>";
      return CheckStr_d($plist);
}
//产品查询 评论
function Checkpro($db_conn,$ID){
      
      $query=$db_conn->query("select * from sc_products where ID=$ID");
      $rows=mysqli_fetch_array($query);
      $imgs = explode(",", str_replace("produt/", "product/small/", $rows['ant_img']));
      $img = $imgs[0];
      $pnm = $rows['products_name'];
      $plist =" <img src='".$img."' width='40' align='absmiddle'> ".$pnm;
      return CheckStr_d($plist);
}

//最新会员
function ListNewUser($db_conn){
    $str = "";
    $query=$db_conn->query("select * from sc_member Order by ID desc limit 5");
    while($rows=mysqli_fetch_array($query)){
      $str .= '<li><font>'.$rows['me_email'].'</font><font>'.$rows['me_logintime'].'</font></li>';
    }
    if (!empty($str)){
      return $str;
     }else{
      return '<li><i class="fa fa-volume-down" aria-hidden="true"></i> 暂无消息</li>';
     }
}
//最新订单
function ListNewOrder($db_conn){
    $str = "";
    $query=$db_conn->query("select * from sc_order Order by ID desc limit 5");
    while($rows=mysqli_fetch_array($query)){
      $str .= '<li><font>'.$rows['order_number'].'</font><font>'.$rows['order_curry'].$rows['order_prodctzj'].'</font></li>';
    }
    if (!empty($str)){
      return $str;
     }else{
      return '<li><i class="fa fa-volume-down" aria-hidden="true"></i> 暂无消息</li>';
     }
}
//最新订阅
function ListNewEail($db_conn){
    $str = "";
    $query=$db_conn->query("select * from sc_email Order by ID desc limit 5");
    while($rows=mysqli_fetch_array($query)){
      $str .= '<li><font>'.$rows['e_ml'].'</font><font>'.$rows['e_tm'].'</font></li>';
    }
    if (!empty($str)){
      return $str;
     }else{
      return '<li><i class="fa fa-volume-down" aria-hidden="true"></i> 暂无消息</li>';
     }
}

//最新评论
function ListNewReviews($db_conn){
    $str = "";$sat="";
    $query=$db_conn->query("select * from sc_msg where msg_flag='p' Order by ID desc limit 5");
    while($rows=mysqli_fetch_array($query)){
        for ($i=0; $i <$rows['msg_rating'] ; $i++) { 
            $sat.= '<i class="fa fa-star" aria-hidden="true"></i>';
          }
          for ($i=0; $i <(5-$rows['msg_rating']) ; $i++) { 
            $sat.= '<i class="fa fa-star-o" aria-hidden="true"></i>';
          }

      $str .= '<li><font>'.$rows['msg_email'].'</font><font>'.$sat.'</font></li>';
      $sat="";
    }
    if (!empty($str)){
      return $str;
     }else{
      return '<li><i class="fa fa-volume-down" aria-hidden="true"></i> 暂无消息</li>';
     }
}

//最新留言
function ListNewMsg($db_conn){
    $str = "";$sat="";
    $query=$db_conn->query("select * from sc_msg where msg_flag='m' Order by ID desc limit 5");
    while($rows=mysqli_fetch_array($query)){
      $str .= '<li><font>'.$rows['msg_email'].'</font><font>'.$rows['msg_ip'].'</font></li>';
    }
    if (!empty($str)){
      return $str;
     }else{
      return '<li><i class="fa fa-volume-down" aria-hidden="true"></i> 暂无消息</li>';
     }
}

//列出模版
function TemplateDir($dir,$webTemplate){ 
  $x=0;
  $directory=scandir($dir);
  for($i=0;$i<sizeof($directory);$i++){
      if (is_dir($dir.$directory[$i]."/")&& $directory[$i]!="." && $directory[$i]!=".."){
          if ($webTemplate==$directory[$i]){ //判断当前模版
              
              $current_mb='<i class="fa fa-check" aria-hidden="true"></i>';
          }else{
              
              $current_mb='<i class="fa fa-times" aria-hidden="true"></i>' ;
           }
          echo "<tr><td>".$x=$x+1 ."</td><td><img src='../Template/".$directory[$i]."/".$directory[$i].".png' width='250'></td><td>".$directory[$i]."</td><td>".$current_mb."</td><td><span onclick=ApplyTm('Ant_Inc.php?sort=Globals&action=Apply&mb=".$directory[$i]."');>应用</span></td></tr>"; 
      }
  }   
}
//查询模版文件
function CheckConfig($db_conn,$field){
     $query=$db_conn->query("select * from sc_config where ID=1");
     $rows=mysqli_fetch_array($query);
     return ($rows[$field]);
}


//生成google sitemap 2021-09-13

function ggsitemap($db_conn){

   $navlk = ""; $Pmlk=""; $Bmlk=""; $Prlk=""; $Brlk=""; $Arlk="";$Srlk="";

  //检测是否https
   $query=$db_conn->query("select * from sc_config where ID=1");
   $row = mysqli_fetch_assoc($query);
   $http=$row['web_https'];
   if ($http==0){
    $htp="http://";
   }else{
    $htp="https://";
   }

  //网站域名
    $Wbdmain =$htp.$_SERVER['SERVER_NAME']."/";

  //导航链接
   $query=$db_conn->query("select * from sc_menu where menu_open=1 and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if ($row['menu_link']=="/"){
                $mlk="";
            }else{
                 $mlk=$row['menu_link'];
            }
          $navlk.= $Wbdmain.$mlk."\n";
      }

    //产品目录
     $query=$db_conn->query("select * from sc_categories where category_open=1 and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['category_url'])){
                $mlk=$row['category_url']."/";
            }else{
                 $mlk=$row['ID']."/";
            }
          $Pmlk.= $Wbdmain.$mlk."\n";
      }
      //博客目录
     $query=$db_conn->query("select * from sc_blogcat where b_open=1 and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['b_url'])){
                $mlk="blog/".$row['b_url']."/";
            }else{
                 $mlk="blog/".$row['ID']."/";
            }
          $Bmlk.= $Wbdmain.$mlk."\n";
      }
      //产品链接
      $query=$db_conn->query("select * from sc_products where products_zt=1 and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['products_url'])){
                $mlk=$row['products_url'].".html";
            }else{
                 $mlk=$row['ID'].".html";
            }
          $Prlk.= $Wbdmain.$mlk."\n";
      }  
      //博客连接   
      $query=$db_conn->query("select * from sc_info where info_open=1 and info_flag='B' and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['info_url'])){
                $mlk="blog/".$row['info_url'].".html";
            }else{
                 $mlk="blog/".$row['ID'].".html";
            }
          $Brlk.= $Wbdmain.$mlk."\n";
      }   
      //关于我们连接   
      $query=$db_conn->query("select * from sc_info where info_open=1 and info_flag='A' and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['info_url'])){
                $mlk="about/".$row['info_url'].".html";
            }else{
                 $mlk="about/".$row['ID'].".html";
            }
          $Arlk.= $Wbdmain.$mlk."\n";
      }   
      //服务连接   
      $query=$db_conn->query("select * from sc_info where info_open=1 and info_flag='S' and languageID=1");
       while($row = mysqli_fetch_assoc($query)){
            if (!empty($row['info_url'])){
                $mlk="service/".$row['info_url'].".html";
            }else{
                 $mlk="service/".$row['ID'].".html";
            }
          $Srlk.= $Wbdmain.$mlk."\n";
      }   
      $lk=$navlk.$Pmlk.$Bmlk.$Prlk.$Brlk.$Arlk.$Srlk;
    //生成txt文件
      $myfile = fopen("../Images/sitemap.txt", "w") or die("Unable to open file!");
      fwrite($myfile,$lk);
      fclose($myfile);
      $lk="";
}

 //分页函数
function show_page($count,$page,$page_size,$type,$pfy=""){

    $url="";
    $page_count  = ceil($count/$page_size);  //计算得出总页 

    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
    $page=(empty($page)||$page<0)?1:$page;
    $url = $_SERVER['REQUEST_URI'];

    //echo $url;
 
if ($type=="back"){

    $parsedurl=parse_url($url);
    $url_query = isset($parsedurl['query']) ? $parsedurl['query']:'';
    if($url_query != ''){
        $url_query = preg_replace("/(^|&)page=$page/",'',$url_query);
        $url_query = preg_replace("/$pfy/",'',$url_query);
        $url = str_replace($parsedurl['query'],$url_query,$url);
        if($url_query != ''){
              $url .= '&';
             }
    }else{
        $url .= '?';
    }
    $page_len = ($page_len%2)?$page_len:$page_len+1;
    $pageoffset = ($page_len-1)/2;
    $navs='';
    if($pages != 0){
        if($page!=1){
          $navs.="<a href=\"".trim(trim($url,"&"),"?").$pfy."\">首页</a>";
          if($page==2){
               $navs.="<a href=\"".trim(trim($url,"&"),"?").$pfy."\"><i class='fa fa-angle-left' aria-hidden='true'></i></a>"; 
            }else{
              $navs.="<a href=\"".$url."page=".($page-1).$pfy."\"><i class='fa fa-angle-left' aria-hidden='true'></i></a>"; 
          }
        } else {
            $navs .= "";
        }
        if($pages>$page_len){
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;
            }else{
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }else{
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++){
            if($i==$page){
              $navs.="<a href='javascript:' id='active'>".$i.'</a>';
            }else{
              if ($i==1){
                   $navs.="<a href=\"".trim(trim($url,"&"),"?").$pfy."\">".$i."</a>";
                 }else{
                   $navs.="<a href=\"".$url."page=".$i.$pfy."\">".$i."</a>";
              }
            }
        }
        if($page!=$pages){
            $navs.="<a href=\"".$url."page=".($page+1).$pfy."\"><i class='fa fa-angle-right' aria-hidden='true'></i></a>";
            $navs.="<a href=\"".$url."page=".$pages.$pfy."\">末页</a>";
        } else {
            $navs .= "";
        }
        return  $navs ;
   }

}else{

 
    //echo $page;

    if ($page>1){

         $urls=explode("/",$url);    
         $urlend=$urls[sizeof($urls)-2];
         $url=str_replace("/".$urlend, "", $url);

         //echo $url;
     }
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 

    $navs='';
    if($pages != 0){
        if($page!=1){

            if($page==2){$navs.="<a href=\"".$url."\"> <i class='fa fa-angle-left' aria-hidden='true'></i> </a>"; }else{$navs.="<a href=\"".$url.($page-1)."/\"> <i class='fa fa-angle-left' aria-hidden='true'></i> </a>"; }

        } else {
            $navs .= "";
        }
        if($pages>$page_len){
            if($page<=$pageoffset){
                $init=1;
                $max_p = $page_len;

            }else{    
                if($page+$pageoffset>=$pages+1){
                    $init = $pages-$page_len+1;
                }
                else
                {
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++){

            if($i==$page){$navs.="<a href='javascript:' class='actvie'>".$i.'</a>';}

            else {

           if ($i==1){$navs.=" <a href=\"".$url."\">".$i."</a>";}else{$navs.=" <a href=\"".$url.$i."/\">".$i."</a>";}
       
          }
        
        }
        if($page!=$pages){

            $navs.="<a href=\"".$url.($page+1)."/\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a> ";

        }else{

            $navs .= "";

        }

        return  $navs ;
        $navs='';
   }
  }
}

//获取运程文件
function getFile($url, $save_dir = '', $filename = '', $type = 0)
{
  if (trim($url) == '') {
    return false;
  }
  if (trim($save_dir) == '') {
    $save_dir = './';
  }
  if (0 !== strrpos($save_dir, '/')) {
    $save_dir.= '/';
  }
  //创建保存目录
  if (!file_exists($save_dir) && !mkdir($save_dir, 0777, true)) {
    return false;
  }
  //获取远程文件所采用的方法
  if ($type) {
    $ch = curl_init();
    $timeout = 60;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING,'gzip');    
    $content = curl_exec($ch);
    curl_close($ch);
  } else {
    ob_start();
    readfile($url);
    $content = ob_get_contents();
    ob_end_clean();
  }
      $fp2 = @fopen($save_dir.$filename, 'a');
      fwrite($fp2, $content);
      fclose($fp2);
      unset($content, $url);
   if (file_exists($save_dir.$filename)){
        $size = filesize($save_dir.$filename);
        if ( $size<100){
          return false;
          exit;
        }else{
          return true;
        }

   }else{
      return false;
   }
}
//解压文件
function get_zip_originalsize($filename,$path) {
  //先判断待解压的文件是否存在
  if(!file_exists($filename)){
    die("文件 $filename 不存在！");
  }
  if(!is_dir($path)){
        mkdir($path,0777,true);
  }
  $starttime = explode(' ',microtime()); //解压开始的时间

  //将文件名和路径转成windows系统默认的gb2312编码，否则将会读取不到
  $filename = iconv("utf-8","gb2312",$filename);
  $path = iconv("utf-8","gb2312",$path);
  //打开压缩包
  $resource = zip_open($filename);
  $i = 1;
  //遍历读取压缩包里面的一个个文件
  while ($dir_resource = zip_read($resource)) {
    //如果能打开则继续
    if (zip_entry_open($resource,$dir_resource)) {
      //获取当前项目的名称,即压缩包里面当前对应的文件名
      $file_name = $path.zip_entry_name($dir_resource);
      //以最后一个“/”分割,再用字符串截取出路径部分
      $file_path = substr($file_name,0,strrpos($file_name, "/"));
      //如果路径不存在，则创建一个目录，true表示可以创建多级目录
      if(!is_dir($file_path)){
        mkdir($file_path,0777,true);
      }
      //如果不是目录，则写入文件
      if(!is_dir($file_name)){
        //读取这个文件
        $file_size = zip_entry_filesize($dir_resource);
        //最大读取6M，如果文件过大，跳过解压，继续下一个
        if($file_size<(1024*1024*30)){
          $file_content = zip_entry_read($dir_resource,$file_size);
          file_put_contents($file_name,$file_content);
        }else{
          echo "<p> ".$i++." 此文件已被跳过，原因：文件过大， -> ".iconv("gb2312","utf-8",$file_name)." </p>";
        }
      }
      //关闭当前
      zip_entry_close($dir_resource);
    }
  }
  //关闭压缩包
  zip_close($resource);
  // $endtime = explode(' ',microtime()); //解压结束的时间
  // $thistime = $endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]);
  // $thistime = round($thistime,3); //保留3为小数
  // echo "<p>解压完毕！，本次解压花费：$thistime 秒。</p>";
}

//加载最新消息
 function Curl_load($url){
    $ch = curl_init();
    $timeout = 3;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

// 删除安装文件
function delDirAndFile($dirName){
    if ($handle = opendir("$dirName" )){
    while (false !== ( $item = readdir( $handle ))) {
      if ($item != "." && $item != ".." ) {
        $Ul=str_replace("//", "/", $dirName."/".$item);
        if (is_dir($Ul)){
          delDirAndFile($Ul);
        }else{
          if( unlink($Ul) )echo "<li class='nextstep'>成功删除安装文件: ".$Ul."</li>";
        }
      }
    }
    closedir($handle);
    if(rmdir($dirName)) echo "<li class='nextstep'>成功删除安装包: $dirName</li>";
    }
}

//读取txt
function Readtxt(){
  $file_path="Version.txt";
  if(file_exists($file_path)){
    $str = file_get_contents($file_path);
    $array = explode("\n",$str);  
    return $array;
  }else{
    return  $array=array('v1.0' ,'版权所有 <a href=https://www.sem-cms.cn/>SEMCMS</a> 外贸网站商城管理系统(SCSHOP)');
  }
}
$v=Readtxt();
