<?php include_once 'Ant_Inc.php'; 
   $Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);

    if (isset($_GET["output"])){$output=$_GET["output"];}else{$output="";} //动作选项
	if ($output=="sk"){
     $table="sc_words";
 
     header("Content-type:application/vnd.ms-excel");  
     header("Content-Disposition:attachement;filename=".$_SERVER["SERVER_NAME"]."_".date("Y-m-d").".xls");  
    //报表数据
     $str="";
     $ReportContent = '';  
     $sql=$db_conn->query("select * from $table where languageID=$lgid order by ID desc");
     while($row=mysqli_fetch_array($sql)){
           $str.=$row['wd_key']."||".$row['wd_mail']."||".$row['wd_ip']."||".$row['wd_time']."[]";
        }  
        $st='关键词||邮箱||IP||时间[]';
        $str=$st.$str;
        $ary= explode("[]", $str);
        foreach ($ary as $value) {
            $v=explode("||", $value);
            foreach ($v as $values) {
              $ReportContent .= '"'.$values.'"'."\t";  
            }
            $ReportContent .= "\n";  
        }
        $ReportContent = mb_convert_encoding($ReportContent,"gb2312","utf-8");  
        //输出即提示下载  
        echo $ReportContent;

		 
	}



