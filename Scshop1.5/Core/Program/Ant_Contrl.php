<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
 //读取信息
  function ReadInfo($db,$field,$table,$where,$order,$str=""){
    $str=array();
    $Query=$db->query("select $field from $table $where $order");
    if (mysqli_num_rows($Query)>0){
       while($row = mysqli_fetch_assoc($Query)){
         $str[] = $row;
      }
      mysqli_free_result($Query);
    }
    return $str;
 }

//目录及路径判断
function web_language_ml($web_urls1,$web_urls2,$db){
    $Query=$db->query("select * from sc_language where language_url='$web_urls1' or language_url='$web_urls2' and  language_open=1");
    if (mysqli_num_rows($Query)>0){
          $row=mysqli_fetch_assoc($Query);
          $Urlink=array('url_link'=>$row['language_url'],'url_ml'=>"../",'ID'=>$row['ID']);
    }else{
          $Query=$db->query("select * from sc_language where language_mulu=1 and language_open=1");
          $row=mysqli_fetch_assoc($Query);
          $Urlink=array('url_link'=>"",'url_ml'=>"./",'ID'=>$row['ID']);
    }
    mysqli_free_result($Query);
    return $Urlink;
}

//页面路径转换
function UrltoHtml($urlo,$urlt,$type){
  if($type=="pl"){//产品列表
     $url=$urlt==""? $urlo."/" : $urlt."/";
  }elseif($type=="pv"){//产品详细
     $url=$urlt==""? $urlo.".html" : $urlt.".html";
  }elseif($type=="bv"){//博客详细
     $url=$urlt==""? "blog/".$urlo.".html" : "blog/".$urlt.".html";
  }elseif ($type=="bl") {
     $url=$urlt==""? "blog/".$urlo."/" : "blog/".$urlt."/";
  }elseif($type=="av"){//关于我们
     $url=$urlt==""? "about/".$urlo.".html" : "about/".$urlt.".html";
  }elseif($type=="sv"){//会员服务
     $url=$urlt==""? "service/".$urlo.".html" : "service/".$urlt.".html";
  }
  return $url;
}
//跳转404
function To404(){
  header("Location: 404.htm");
  exit;
}

//邮箱验证
 function CheckEmail($email){
    $checkmail="/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/";     
    if(preg_match($checkmail,$email)){ 
         return true;
    }else{
         return false;
    }
 }

//IP获取 
 function GetIp(){
  
    $ip=FALSE;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match ("/^(10│172.16│192.168)./i", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

 
function lock_str($txt,$key=''){ 
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+"; 
    $nh = rand(0,64); 
    $ch = $chars[$nh]; 
    $mdKey = md5($key.$ch); 
    $mdKey = substr($mdKey,$nh%8, $nh%8+7); 
    $txt = base64_encode($txt); 
    $tmp = ''; 
    $i=0;$j=0;$k = 0; 
    for ($i=0; $i<strlen($txt); $i++) { 
        $k = $k == strlen($mdKey) ? 0 : $k; 
        $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64; 
        $tmp .= $chars[$j]; 
    } 
    return urlencode($ch.$tmp); 
} 
 
function unlock_str($txt,$key=''){ 
    $txt = urldecode($txt); 
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+"; 
    $ch = $txt[0]; 
    $nh = strpos($chars,$ch); 
    $mdKey = md5($key.$ch); 
    $mdKey = substr($mdKey,$nh%8, $nh%8+7); 
    $txt = substr($txt,1); 
    $tmp = ''; 
    $i=0;$j=0; $k = 0; 
    for ($i=0; $i<strlen($txt); $i++) { 
        $k = $k == strlen($mdKey) ? 0 : $k; 
        $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]); 
        while ($j<0) $j+=64; 
        $tmp .= $chars[$j]; 
    } 
    return base64_decode($tmp); 
}

 
//分页函数
function show_page($count,$page,$page_size,$url=""){

    $page_count  = ceil($count/$page_size);  //计算得出总页 
    $init=1;
    $page_len=7;
    $max_p=$page_count;
    $pages=$page_count;
    $page=(empty($page)||$page<0)?1:$page;
    $url = $_SERVER['REQUEST_URI'];
     if(strpos($url,'?ob=') !==false){
        $urlo=explode("?ob=", $url);
        //var_dump($url);
        $url=$urlo[0];
        $ob="?ob=".$urlo[1];
        
     }else{
        $ob="";
     }
 
    if ($page>1){
         $urls=explode("/",$url);    
         $urlend=$urls[sizeof($urls)-2];
         $url=substr($url,0,strlen($url)-strlen($urlend)-1); 
     }
     //echo $url;
    $page_len = ($page_len%2)?$page_len:$page_len+1;  //页码个数
    $pageoffset = ($page_len-1)/2;  //页码个数左右偏移 
    $navs='';
    if($pages != 0){
        if($page!=1){
            if($page==2){$navs.=" <a href=\"".$url."\"> <i class='fa fa-angle-left' aria-hidden='true'></i> </a>"; }else{$navs.=" <a href=\"".$url.($page-1)."/".$ob."\"> <i class='fa fa-angle-left' aria-hidden='true'></i> </a>"; }
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
                else{
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                }
            }
        }
        for($i=$init;$i<=$max_p;$i++){
            if($i==$page){
              $navs.=" <a href='javascript:' class='actvie'>".$i.'</a>';
            }else {
           if ($i==1){
              $navs.=" <a href=\"".$url."\">".$i."</a>";
            }else{
              $navs.=" <a href=\"".$url.$i."/".$ob."\">".$i."</a>";
            }
          }
        }
        if($page!=$pages){
            $navs.=" <a href=\"".$url.($page+1)."/".$ob."\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></a> ";
        }else{
            $navs .= "";
        }
        return  $navs ;
        $navs='';
   }
  }

//邮件发送方法
function SendMail($smtpserver,$smtpuser,$smtppass,$smtpusermail,$smtpserverport,$smtptoemail,$mailtitle,$mailcontent){
    $mail = new PHPMailer(); //建立邮件发送类
    $mail->IsSMTP();                // 使用SMTP方式发送
    $mail->CharSet = "utf-8"; 
    $mail->Host = $smtpserver;     // 您的企业邮局域名
    $mail->SMTPAuth = true; // 启用SMTP验证功能
    if ($smtpserverport<>25){ //除25端口外启用ssl
        $mail->SMTPSecure = "ssl";// SMTP 安全协议      
    }
    $mail->Username = $smtpuser;   // 邮局用户名(请填写完整的email地址)
    $mail->Password = $smtppass;   // 邮局密码
    $mail->Port=$smtpserverport;   // 邮件端口
    $mail->From = $smtpusermail;   // 邮件发送者email地址
    $mail->FromName = $_SERVER['SERVER_NAME'];//以当前域名为名称
    $mail->AddAddress($smtptoemail,"");
    $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
    $mail->Subject = $mailtitle; //邮件标题
    $mail->Body = $mailcontent; //邮件内容
    $mail->AltBody = ""; //附加信息，可以省略           
    if(!$mail->Send()){
      // echo "warning:".$mail->ErrorInfo;
       echo "<script>alert('".$mail->ErrorInfo."');</script>";
       exit;
     } 
}

function unlock($txt,$key=''){ 
    $txt = urldecode($txt); 
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+"; 
    $ch = $txt[0]; 
    $nh = strpos($chars,$ch); 
    $mdKey = md5($key.$ch); 
    $mdKey = substr($mdKey,$nh%8, $nh%8+7); 
    $txt = substr($txt,1); 
    $tmp = ''; 
    $i=0;$j=0; $k = 0; 
    for ($i=0; $i<strlen($txt); $i++) { 
        $k = $k == strlen($mdKey) ? 0 : $k; 
        $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]); 
        while ($j<0) $j+=64; 
        $tmp .= $chars[$j]; 
    } 
    return base64_decode($tmp); 
}

function ShowCP($str1,$str2,$str3){
  $st1=$str1;
  $st2=unlock($str2,"sc");
  $st3=unlock($str3,"zg");
  if(strpos($st1,$st2) !== false){ 
 
  }else{
     echo $st3;
  }
}

//邮件模版调用
function CheMailTemplate($db_conn,$mfl){
    $MailStr = "";
    $str = ReadInfo($db_conn,"*","sc_mailtemplate","where mt_flag=1 and mt_fl=$mfl","");
    if(!empty($str)){
      $MailStr = array('Mtitle' =>CheckStr_d($str[0]['mt_title']),'Mtent'=>CheckStr_d($str[0]['contents']));
    }
    return $MailStr;
}


