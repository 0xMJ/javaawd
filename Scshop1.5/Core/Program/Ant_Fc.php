<?php
// CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/

//search page
function Search_Data($em,$key,$db_conn,$lgid){
    $Ant=new WD_Data_Process();
    $wd_time = date("Y-m-d H:i:s");
    $wd_ip = GetIp();	
	$table = 'sc_words';
	$field = "wd_key,wd_mail,wd_ip,wd_time,languageID";
	$val = "('".$key."','".$em."','".$wd_ip."','".$wd_time."','".$lgid."')";
	$Ant->AntAdd($table,$field,$val,$db_conn);
}


//add cart

function AddCart_Data($em,$key,$qty,$db_conn){
    $Ant=new WD_Data_Process();
    $wd_time = date("Y-m-d H:i:s");
    $wd_ip = GetIp();	
	$table = 'sc_cart';
	$field = "ct_pid,ct_qty,ct_mail,ct_ip,ct_time";
	$val = "('".$key."','".$qty."','".$em."','".$wd_ip."','".$wd_time."')";
	$str = "ct_pid='".$key."' and ct_ip='".$wd_ip."'";
    if ($Ant->CheckDatas($table,$str,$db_conn)==1){
      $Ant->AntEditGen($table,"ct_qty='".$qty."' , ct_mail='".$em."'",$str,$db_conn);
    }else{
    	$Ant->AntAdd($table,$field,$val,$db_conn);
    }


  
}