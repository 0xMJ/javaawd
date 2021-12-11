<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_member";
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 会员管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
 


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".CheckStr($_GET["sortID"])));
 
?>

 <div class="ant">
		<div class="ant_title">会员信息</div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >详细信息</div>
				<div class="ant_cat_tab " >账户设置</div>
				<div class="ant_cat_tab " >物流地址</div>
 
		    </div>
	 
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">E-mail:</span> <div class="sdiv"><span class="aspn"><?php echo $row['me_email'];?></span></div></li>
						<li><span class="aspn">姓名:</span> <div class="sdiv"><span class="aspn"><?php echo $row['me_firstname']." ".$row['me_lastname'];?></span></div></li>
						<li><span class="aspn">注册IP: </span><div class="sdiv"><span class="aspn"><?php echo $row['me_ip']; ?></span>
						</div></li>
						<li><span class="aspn">登陆IP:</span> <div class="sdiv"><span class="aspn"><?php echo $row['me_loginip'];?></span></div></li>
						<li><span class="aspn">注册时间:</span> <div class="sdiv"><span class="aspn"><?php echo $row['me_logintime'];?></span></div></li>
						<li><span class="aspn">登陆时间:</span> <div class="sdiv"><span class="aspn"><?php echo $row['me_dltime'];?></span></div></li>
					</ul>
				</div>

				<div class="ant_cat_c">
				<form method="post" id="form" name="form" action="#">
					<ul>
						<li><span class="aspn">修改密码:</span> <div class="sdiv"><input type="password" name="me_paswd" id="me_paswd" class="ant_input26"> <br><font class="note">* 不填不修改</font></div></li>
						<li><span class="aspn">锁定账号:</span> <div class="sdiv"><input type="checkbox" id="me_flag" onclick="selects('me_flag');" <?php if($row['me_flag']=="1"){echo "checked";} ?>  ><input type="hidden" name="me_flag" id="sme_flag" value="<?php echo $row['me_flag'];?>">  <br><font class="note">* 选中代表锁定</font></li>
					</ul>
				
				<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"> <input type="submit" class="an_submit trans" value="保存" onclick="return datas('me_flag','Edit','member','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>			</form>	
				</div>

				<div class="ant_cat_c">
<form method="post" id="pform" action="#">
 	<?php

	 $q=$db_conn->query("select * from sc_address where userID=".CheckStr($_GET["sortID"])." order by ID desc ");       
	 while($rows=mysqli_fetch_array($q)){

	 	echo "<div class='usraddr'>";
	 	echo "<input type='checkbox' name='DID[]' value='".$rows['ID']."'> ".$rows['add_firstname']." ".$rows['add_lastname']."<br>";
	 	echo $rows['add_dress']." , ".$rows['add_city']." , ".$rows['add_state']." , ".$rows['add_contry']." , ".$rows['add_zipcode']."<br>";
	 	echo $rows['add_tel']."<br>";
	 	echo $rows['add_company'];
	 	echo "</div>";
	 	

	 }
 	?>
 	<div class="usrdel">
 		<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=address','del','<?php echo $FileSelf;?>');" /></span>
	 </div>
	</form>
				</div>			


		    </div>

		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="?page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
if (isset($_REQUEST["skey"])){$skey=$_REQUEST["skey"];}else{$skey="";} 
if ($skey!=""){
		$pfy="&skey=".$skey."";
	    $where=" where me_email like '%".$skey."%' ";
	}else{
        $pfy="";
	    $where="";
	}
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">会员管理

		<div style="width: 60%; position: absolute; left: 28%; top: 15%;">
		<form name="sform" method="post" action="?lgid=<?php echo $lgid;?>">
			<input type="text" name="skey" class="ant_input25" placeholder="输入E-mail查询" value="<?php echo $skey;?>"> 
			<input type="submit" class="an_submit_up trans" value="搜索">
	    </form>
	  </div>

	</div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>邮箱地址</th><th>姓名</th><th>注册时间 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></i></th><th>注册IP</th><th>锁定 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th> <th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table $where");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table $where order by ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
 
 
	 	if($row['me_flag']==1){$jof="on";$jt=1;}else{$jof="off";$jt=0;}
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
 
 
			<td ><?php echo $row['me_email'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['me_firstname']." ".$row['me_lastname']; ?></td>
	      
	        <td ><?php echo $row['me_logintime']; ?></td>
	        <td bgcolor="#fafafa"><?php echo $row['me_ip']?></td>
			<td ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','member','me_flag','<?php echo $jt;?>','jt');" class="fa fa-toggle-on fa-2x <?php echo $jof;?>"  aria-hidden="true" id="'jt<?php echo $row["ID"];?>'" ></i></td>
	  
		   <td bgcolor="#fafafa">
 
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 查看详细</span>   </td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=member','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back",$pfy);?></span></td></tr>
	</table>
</form>
</div>

<?php }?>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 