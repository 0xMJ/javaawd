<?php
include_once 'Ant_Inc.php';
if(!empty($sort) && $sort!="Lgot" && $sort!="Sitemap"){
	$table=CheckDatabase($sort);
}
if (isset($_GET["suxin_id"])){$suxin_id=$_GET["suxin_id"];}else{$suxin_id="";}//属性ID
if (isset($_GET["itemnb"])){$itemnb=$_GET["itemnb"];}else{$itemnb="";}//编号

if ($sort=="property"){ //属性 list
  
  if (!empty($suxin_id) && !empty($itemnb))	{
  	 $i=1;$str='';
	 $query=$db_conn->query("select * from $table where suxin_id=$suxin_id and itemnb='$itemnb' order by pt_paixu,ID desc");
   	 if (mysqli_num_rows($query)>0){ 
			 while($row=mysqli_fetch_array($query)){

			 	if(!empty($row['ant_img'])){
			 		$im='<img src="'.$row['ant_img'].'" width="30" />';
			 	}else{
			 		$im='<i class="fa fa-file-image-o" aria-hidden="true"></i>';
			 	}
			 	if($row['pt_xs']==1){$on="on";}else{$on="off";}
			 	$str.='<tr><td>'.$i.'</td><td>'.$im.'</td><td onclick="px(\'pn'.$row['ID'].'\',\''.$row['suxin_id'].'\');" id="pn'.$row['ID'].'">'.$row['pt_name'].'</td><td onclick="px(\'pr'.$row['ID'].'\',\''.$row['suxin_id'].'\');" id="pr'.$row['ID'].'">'.$row['pt_price'].'</td><td onclick="px(\'pkc'.$row['ID'].'\',\''.$row['suxin_id'].'\');" id="pkc'.$row['ID'].'">'.$row['pt_kc'].'</td><td> <i onclick="OnOff(\'OpenOff\',\''.$row['ID'].'\',\'property\',\'pt_xs\',\''.$row['pt_xs'].'\',\'open\',\''.$row['suxin_id'].'\');" class="trans fa fa-toggle-on fa-2x '.$on.'" aria-hidden="true" id="open'.$row['ID'].'"></i></td><td onclick="px(\'px'.$row['ID'].'\',\''.$row['suxin_id'].'\');" id="px'.$row['ID'].'">'.$row['pt_paixu'].'</td><td><span class="an_1 trans"  onclick="delCheck(\'Clear\',\''.$row["ID"].'\',\'property\',\''.$FileSelf.'\',\''.$row['suxin_id'].'\',\''.$row['itemnb'].'\');"> <i class="fa fa-times" aria-hidden="true"></i> 删除 </span><span id="cpx'.$row['ID'].'" style="display:none">action=Paixu&sortID='.$row['ID'].'&sort=property&f=pt_paixu</span><span id="cpn'.$row['ID'].'" style="display:none">action=Paixu&sortID='.$row['ID'].'&sort=property&f=pt_name</span><span id="cpr'.$row['ID'].'" style="display:none">action=Paixu&sortID='.$row['ID'].'&sort=property&f=pt_price</span><span id="cpkc'.$row['ID'].'" style="display:none">action=Paixu&sortID='.$row['ID'].'&sort=property&f=pt_kc</span></td></tr>';
			 	  $strid='<input type="hidden" name="products_sx[]" value="'.$row['suxin_id'].'">';

			 $i=$i+1;
			 }

			 $st='<br><table class="table" cellpadding="1" cellspacing="0"><tr><th>序号</th><th>标识图<i class="fa fa-question-circle-o" aria-hidden="true" title="如果更改图片删除此条,新增一条"></i></th><th>名称<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可更改"></i></th><th>价格<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>库存<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>是否显示<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可更改"></i></th><th>排序<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>操作</th></tr>'.$str.$strid.'</table>'; 

			 echo $st;
       } 
	}

}
 
if ($sort=="zeke"){ //折扣 list
	$i=0;
    $query=$db_conn->query("select  * from  $table where ID=".$sortID);
    while($row=mysqli_fetch_array($query)){
    	$qty=explode(",", $row['di_qty']);
    	$prc=explode(",", $row['di_price']);
    	foreach ($qty as $v) {
    		echo '<input type="text" name="products_zeke[]" value="'.$v.'" class="ant_input26"> <input type="text" name="products_zeke[]" value="'.$prc[$i].'" class="ant_input26" > <br><br>';
    		$i=$i+1;
    	}
    }

}
if ($sort=="Login"){ //Login 
	if (isset($_POST["username"])){$username=CheckStr($_POST["username"]);}else{$username="";}
	if (isset($_POST["userpas"])){$userpas=CheckStr($_POST["userpas"]);}else{$userpas="";}

		if($username=="" || $userpas==""){
			echo $username."账号密码不能为空"; //账号密码不能为空
		}else{
			$userpas=md5(md5($userpas));
		    $query=$db_conn->query("select  * from  $table where user_admin='".$username."' and user_ps='".$userpas."'");
		    if (mysqli_num_rows($query)>0){ 
		    	$row=mysqli_fetch_array($query);
	             	start_session(Ant_Cook("Expires"));
	             	$_SESSION['ScuName'] = $row['user_name'];
	             	$_SESSION['ScuAdmin'] = $row['user_admin'];
	             	$_SESSION['ScuPass'] = $row['user_ps'];
		        echo '3';//成功
		    }else{

		    	echo '账号或密码不对'; //账号或密码不对
		    }
		}
}

if ($sort=="Lgot"){
	     unset($_SESSION['ScuName']);
	     unset($_SESSION['ScuAdmin']);
	     unset($_SESSION['ScuPass']);
}

if ($sort=="Sitemap"){
	 ggsitemap($db_conn);
}

?>
