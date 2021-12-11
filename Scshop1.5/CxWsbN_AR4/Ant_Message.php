<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_msg";
?>
<?php
 
if (isset($_GET["type"])){$type=$_GET["type"];}else{$type="";}
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
 
if ($type=="p"){
	$infoName="产品评论";
	$where = "where msg_flag ='p' and languageID=$lgid";
}elseif($type=="m"){
	$infoName="留言管理";
	$where = "where msg_flag ='m' and languageID=$lgid";
	 
} 
$FileSelf=$FileSelf."?type=".$type.$page;
?>
<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - <?php echo $infoName;?></span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
 


<?php }else if($aed=="e"){

 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));

?>

 <div class="ant">
		<div class="ant_title">详细信息</div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab " >回复</div>
 
		    </div>
		  
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<?php if($type=="p"){?>
						<li><span class="aspn">评分:</span> <div class="sdiv"> 
						<?php 
							for ($i=0; $i <$row['msg_rating'] ; $i++) { 
								echo '<i class="fa fa-star" aria-hidden="true"></i> ';
							}
							for ($i=0; $i <(5-$row['msg_rating']) ; $i++) { 
								echo '<i class="fa fa-star-o" aria-hidden="true"></i> ';
							}	
					     ?>
						</div></li>	
						<li><span class="aspn">产品信息:</span> <div class="sdiv"> <?php echo  Checkpro($db_conn,$row['msg_pid']);?>
						</div></li>
						<?php } ?>
						<li><span class="aspn">留言内容:</span> <div class="sdiv"><?php echo $row['msg_content'];?> </div></li>

						<li><span class="aspn">邮箱:</span> <div class="sdiv"> <?php echo $row['msg_email'];?></div></li>
						<li><span class="aspn">姓名:</span> <div class="sdiv"> <?php echo $row['msg_name'];?></div></li>
						<li><span class="aspn">IP:</span> <div class="sdiv"> <?php echo $row['msg_ip'];?></div></li>
						<li><span class="aspn">时间:</span> <div class="sdiv"><?php echo $row['msg_time'];?> </div></li>
					</ul>	
	 
				</div>

 
				<div class="ant_cat_c"  >
<form method="post" id="form" name="form" action="#">
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><input type="checkbox" id="msg_type" onclick="selects('msg_type');" <?php if($row['msg_type']=="1"){echo "checked";} ?>  ><input type="hidden" name="msg_type" id="smsg_type" value="<?php echo $row['msg_type'];?>">  <br><font class="note">* 显示请勾选</font>
						</div></li>
						<li><span class="aspn">回复信息:</span> <div class="sdiv"><textarea  name="msg_reply" class="ant_textarea"  id="msg_reply" ><?php echo $row['msg_reply']; ?></textarea><br><font class="note">* 填写回复内容</font> </div></li>
					</ul>
					<div class="an"><input type="hidden" name="ID" value="<?php echo $row['ID']; ?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('msg_type','Edit','Message','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
				</form>
				</div>
 

		    </div>
			<div class="cb"></div>
	 
       
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="?page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;"><?php echo $infoName;?></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>邮箱</th><th>IP</th><?php if($type=="p"){?><th>显示</th><?php } ?><th>时间</th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table $where order by ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 if($row['msg_type']==1){$of="on";$op=1;}else{$of="off";$op=0;}
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td ><?php echo $row['msg_email'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['msg_ip']; ?></td>
            <?php if($type=="p"){?><td><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','Message','msg_type','<?php echo $op;?>','op');" class="fa fa-toggle-on fa-2x <?php echo $of;?>"  aria-hidden="true" id="'op<?php echo $row["ID"];?>'" ></i></td><?php } ?>
	        <td ><?php echo $row['msg_time']?></td>
		    <td bgcolor="#fafafa">
		   	 <span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&type=<?php echo $type;?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 查看详细</span> </td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=Message','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back");?></span></td></tr>
	</table>
</form>
</div>

<?php }?>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 