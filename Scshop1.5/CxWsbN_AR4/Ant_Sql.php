<?php include_once 'Ant_Inc.php'; 
   $Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);

 
		$sql = "CREATE TABLE `sc_words` (
		  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `wd_key` char(100) DEFAULT NULL,
		  `wd_mail` char(100) DEFAULT NULL,
		  `wd_ip` char(100) DEFAULT NULL,
		  `wd_time` timestamp NULL DEFAULT NULL,
		  `wd_flag` int(11) DEFAULT '0',
		  `languageID` int(11) DEFAULT NULL
	    )";


		 if ($db_conn->query($sql) === TRUE) {
		    echo  "成功创建查询分析表<br>";
		 } else {
		     echo "查询分析表已存在<br>";
		 }


		$sql = "CREATE TABLE `sc_cart` (
  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ct_pid` char(200) DEFAULT NULL,
  `ct_qty` int(11) DEFAULT NULL,
  `ct_mail` char(100) DEFAULT NULL,
  `ct_ip` char(100) DEFAULT NULL,
  `ct_time` timestamp NULL DEFAULT NULL,
  `ct_other` char(200) DEFAULT NULL
)";


		 if ($db_conn->query($sql) === TRUE) {
		    echo  "成功创建购物车分析表<br>";
		 } else {
		     echo "购物车分析表已存在<br>";
		 }


 

  //检查数据是否存！
    $Ant=new WD_Data_Process();
    //查询分析 
    if ($Ant->CheckData("sc_mulu","ml_name","查询分析",$db_conn)=="0"){

	    $sql = "INSERT INTO  sc_mulu (ml_id,ml_name,ml_link,ml_paixu,ml_open) VALUES ('6', '查询分析', 'Ant_S_Check.php','10000','1')";

	    if ($db_conn->query($sql) === TRUE){
	        
	        //查询新增ID
			$query=$db_conn->query("SELECT * FROM sc_mulu WHERE ml_name='查询分析'");
			$row=mysqli_fetch_assoc($query);
			$ID=$row['ID'].",";
			//查询用户ID
			$uadmin = $_SESSION['ScuAdmin'];
			$query=$db_conn->query("SELECT * FROM sc_user WHERE user_admin='".$uadmin."'");
			$row=mysqli_fetch_assoc($query);
			$UID=$row['ID'];
			//更新权限
			$val = 'user_qx=CONCAT(user_qx,"'.$ID.'")';
			if ($Ant->AntEdit("sc_user",$val,$UID,$db_conn)===true){

				echo "记录插入成功";

			}else{
				echo "用户权限更改失败";
			}

		} else {
		    echo "Error: " . $sql . "<br>" . $db_conn->error;
		}
	}else{
		   echo "记录已存在<br>";
	}
//购物车分析
    if ($Ant->CheckData("sc_mulu","ml_name","购物车分析",$db_conn)=="0"){

	    $sql = "INSERT INTO  sc_mulu (ml_id,ml_name,ml_link,ml_paixu,ml_open) VALUES ('6', '购物车分析', 'Ant_Cart_Check.php','10000','1')";

	    if ($db_conn->query($sql) === TRUE){
	        
	        //查询新增ID
			$query=$db_conn->query("SELECT * FROM sc_mulu WHERE ml_name='购物车分析'");
			$row=mysqli_fetch_assoc($query);
			$ID=$row['ID'].",";
			//查询用户ID
			$uadmin = $_SESSION['ScuAdmin'];
			$query=$db_conn->query("SELECT * FROM sc_user WHERE user_admin='".$uadmin."'");
			$row=mysqli_fetch_assoc($query);
			$UID=$row['ID'];
			//更新权限
			$val = 'user_qx=CONCAT(user_qx,"'.$ID.'")';
			if ($Ant->AntEdit("sc_user",$val,$UID,$db_conn)===true){

				echo "记录插入成功";

			}else{
				echo "用户权限更改失败";
			}

		} else {
		    echo "Error: " . $sql . "<br>" . $db_conn->error;
		}
	}else{
		   echo "记录已存在";
	}


echo '<br><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回 >>>></span>';