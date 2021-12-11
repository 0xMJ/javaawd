<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
//全局设置
$Cf=ReadInfo($db_conn,"*","sc_config","where ID=1","")[0];
$http=$Cf['web_https']==0 ? "http" : "https";
$webTemplate=$Cf['web_Template'];
$M_Open  = $Cf['web_mailopen'];
$M_Umail = $Cf['web_umail'];
$M_Pmail = $Cf['web_pmail'];
$M_Dmail = $Cf['web_dmail'];
$M_Smail = $Cf['web_smail'];
$M_Tmail = $Cf['web_tmail'];
$M_Jmail = $Cf['web_jmail']; 
$W_Cp = $Cf['web_copy'].unlock($Cf['web_cp'],'cp');
//获取域名及网站目录处理
$SERVER_NAME=$_SERVER["HTTP_HOST"];
$webmu = str_replace("\\","/",$_SERVER['DOCUMENT_ROOT']);
$lastchar = substr($webmu, -1);
if ($lastchar=="/"){$webmu=rtrim($webmu,"/");}
$weballmu = str_replace("\\","/",getcwd()); //处理 windows下的路径
$webmue  = explode("/", $webmu);
$weballmue = explode("/", $weballmu);
$webmu = str_replace("/".$webmue[1]."/", "/".$weballmue[1]."/", $webmu); //替换第一个目录 aliyun 目录
$weburldir = str_replace($webmu, "", $weballmu);
$weburldir = str_replace("/Template/".$webTemplate."/File","", $weburldir)."/";
ShowCP($W_Cp,$Cf['web_sc'],$Cf['web_zg']);
if ($weburldir==""){$weburldir="/";}
$web_urlm = $http."://".$SERVER_NAME.$weburldir; 
$web_urls = $_SERVER["REQUEST_URI"];  //获取 url 路径
$web_urls = explode("/", $web_urls);
$urlml = web_language_ml($web_urls[1],$web_urls[2],$db_conn);  // 大写的问号。
$clearsession=trim($urlml['url_link']);
if (trim($urlml['url_link'])==""){
      $web_url=$web_urlm.$urlml['url_link'];
      $web_url_mt=$web_urlm;
      $lgid=$urlml['ID'];
}else{
   if (strpos($web_urlm,"/".$urlml['url_link']."/") !== false){ //用于首页的路径
       $web_url=$web_urlm;
       $lgid=$urlml['ID']; 
       $_SESSION['language']=$urlml['ID']; 
     }else{
      $web_url=$web_urlm.$urlml['url_link']."/";
      $lgid=$urlml['ID'];
      $_SESSION['language']=$urlml['ID'];
     }
     $web_url_mt=str_replace("/".$urlml['url_link']."/", "/", $web_urlm); //不带目录路径
}

//语种ID
if (isset($_GET["lgid"])){$lgid = CheckStr($_GET["lgid"]);}else{$lgid = $lgid;}
if (!empty($lgid)){
  
     //文字
      $Lable = ReadInfo($db_conn,"tag_content","sc_lable","where languageID=$lgid","")[0]['tag_content'];
      $Lable = json_decode(CheckStr_d($Lable),true);

     //Seo设置
     $SeoSet = ReadInfo($db_conn,"*","sc_tagandseo","where languageID=$lgid","")[0];
}else{
  exit;
}




