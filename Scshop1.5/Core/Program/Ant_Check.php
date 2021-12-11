<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
// 防sql入注
if (isset($_GET)){$GetArray=$_GET;}else{$GetArray='';} //get
foreach ($GetArray as $value){ //get 
    VerifyStr($value);
}
function VerifyStr($str) { 
   if(CheckSql($str)) {
       exit('Wrong!Wrong!Wrong!'.$str);
    } 
    return $str; 
}
function BackVerifyStr($str) { 
   if(CheckSql($str)) {
       exit('操作失败,敏感字符为:'.$str);
    } 
    return $str; 
}
function CheckSql($str) {
     return preg_match('/select|=|%|<|between|update|\'|\*|union|into|load_file|outfile/i',$str); 
}
//格式化字符
function CheckStr($data) { 
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data,ENT_QUOTES);
      return $data;
   }
//把预定义的 HTML 实体转换为字符
function CheckStr_d($data){
  $data = trim($data);
	$data = htmlspecialchars_decode($data, ENT_QUOTES);
	return $data;
}

//设置session
function start_session($expire = 0) { 
 if ($expire == 0) { 
 $expire = ini_get('session.gc_maxlifetime'); 
 } else { 
  ini_set('session.gc_maxlifetime', $expire); 
 }
 $sename=session_name();
 if (empty($sename)) { 
     session_set_cookie_params($expire); 
     session_start(); 
 } else { 
     //session_start(); 
     setcookie($sename, session_id(), $expire,Ant_Cook('Path'),Ant_Cook('Domain')); 
 } 
}

// Cookie固定参数
function Ant_Cook($str){
  if(!empty($str)){
    //Expire cookie time 
    //Expires session time
    $CookConfig = array('Cook_Qz' =>'Ant_','Domain'=>$_SERVER['SERVER_NAME'],'Expire'=>time()+3600*24*365,'Path'=>'/','Cook_WhQz'=>'Awhishlist_','Expires'=>time()+3600*24);
    return $CookConfig[$str];
   }
}
