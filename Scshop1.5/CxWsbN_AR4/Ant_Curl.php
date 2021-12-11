<?php include_once 'Ant_Inc.php';

if (isset($_GET['url'])){
	$dname=explode("/", $_GET['url']);
 	if(strpos($dname[2],'sem-cms.cn') !== false){ 
	   $url=$_GET['url'];
	}else{
		echo("<script language='javascript'>alert('非法操作');window.history.back(-1);</script>");
	    exit;
	}
}else{
	$url="";
}

if (!empty($url)){
	  $fn = explode("/", $url);
    $filename =end($fn);
    $fndir = str_replace(".zip", "", $filename);
    //下载目录
	  $save_dir = "../Soft/Zip/";
	  //解压目录
	  $open_dir = "../Soft/Uzip/";
	  //备份目录
	  $bak_dir = "../Soft/Bak/"; 
	  //下载文件
    $result =getFile($url, $save_dir, $filename,1);

    if ($result===false){
    	echo("<script language='javascript'>alert('文件下载失败,重新下载:可能不支持cURL,或服务器原因');window.history.back(-1);</script>");
    	exit;
    }
    //解压文件
    $size = get_zip_originalsize($save_dir.$filename,$open_dir);
     //备份目录
     if(!is_dir($bak_dir)){
        mkdir($bak_dir,0777,true);
      }

	 $file = fopen($open_dir.$fndir."/install.txt","r");
	 while(!feof($file)){
		$url=explode("=",fgets($file));
        //备份文件
        $bak_file = explode("/", trim($url[1]));
        if(file_exists(trim($url[1]))){ //原文件存在的备份 
        	if(rename(trim($url[1]),$bak_dir.end($bak_file))===false){
            echo "备份失败";
          }
        }
        //安装文件		
		   if(rename(trim($url[0]),trim($url[1]))===false){
        //echo "安装失败";
        echo "<script language='javascript'>alert('安装失败,请重新安装');window.history.back(-1);</script>";
        exit;    
       }
	  }
	 fclose($file);

      //删除解压文件及压缩包
	    delDirAndFile($save_dir);
      delDirAndFile($open_dir);
      echo("<script language='javascript'>alert('安装成功');window.history.back(-1);</script>");
}

 
?>