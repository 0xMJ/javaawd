<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_delivery";
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 配送方式管理 </span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ 
$FileSelf=$FileSelf."?sortID=".$sortID

	?>
<div class="ant">
		<div class="ant_title">配送方式添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
			<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">名称:</span> <div class="sdiv"><input type="text" name="de_name" id="de_name"   class="ant_input26" > <br><font class="note">*</font>
						</div></li>
						<li><span class="aspn">计算公式:</span> <div class="sdiv"><input type="text"  name="de_jsfs" id="de_jsfs" class="ant_input26"> <br><font class="note">*</font></div></li>
		 
						<li><span class="aspn">物流描述:</span> <div class="sdiv">
							<font class="note">FW+(R(W*2-1))*9 对应以下文字说明,其中 R 是取整<br>
                            首重运费+(重量（公斤）*2－1)×续重运费　<br>
                            例如：7KG货品按首重20元、续重9元计算，则运费总额为： 20+(7*2-1)*9=137 (元)</font> </div></li>	
	 																	
 						<li><span class="aspn">选择区域: <br></span><div class="sdiv">
                            <p id="ctys"><span><input type="checkbox" onClick="check(this.form)"> 全选 <br><font class="note">* 至少选一个</font></span></p>
 							<p id="ctys">
 							<?php echo Country("1",$sortID,$db_conn);?>
 						</p>
 						</div></li>					

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ex_id" id="ex_id"  value="<?php echo $sortID;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('de_name,de_jsfs,ex_id','Add','delivery','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){

 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["eID"]));
 $FileSelf=$FileSelf."?sortID=".$row["ex_id"]
?>

 <div class="ant">
		<div class="ant_title">物流编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
			<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">名称:</span> <div class="sdiv"><input type="text" name="de_name" id="de_name"   class="ant_input26" value="<?php echo $row['de_name'];?>" > <br><font class="note">*</font>
						</div></li>
						<li><span class="aspn">计算公式:</span> <div class="sdiv"><input type="text"  name="de_jsfs" id="de_jsfs" class="ant_input26" value="<?php echo $row['de_jsfs'];?>"> <br><font class="note">*</font></div></li>
		 
						<li><span class="aspn">物流描述:</span> <div class="sdiv">
							<font class="note">FW+(R(W*2-1))*9 对应以下文字说明,其中 R 是取整<br>
                            首重运费+(重量（公斤）*2－1)×续重运费　<br>
                            例如：7KG货品按首重20元、续重9元计算，则运费总额为： 20+(7*2-1)*9=137 (元)</font> </div></li>	
	 																	
 						<li><span class="aspn">选择区域: <br></span><div class="sdiv">
                            <p id="ctys"><span><input type="checkbox" onClick="check(this.form)"> 全选 <br><font class="note">* 至少选一个</font></span></p>
 							<p id="ctys">
 							
 							 <?php echo Country("2",$row["de_area"],$db_conn);?>
 							<?php echo Country("1",$row["ex_id"],$db_conn);?>
 						</p>
 						</div></li>					

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $_GET["eID"];?>"><input type="hidden" name="ex_id" id="ex_id"  value="<?php echo $row["ex_id"];?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('de_name,de_jsfs,ex_id','Edit','delivery','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf."?sortID=".$sortID.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">配送方式管理<font class="cl">（带星*的必填）</font>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a&sortID=<?php echo $sortID;?>'"><i class="fa fa-plus" aria-hidden="true"></i> 增加配送方式</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>名称</th><th>费用公式</th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table where ex_id=".$sortID);  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table where ex_id=".$sortID." order by ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
 

?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
 
 
			<td bgcolor="#fafafa"><?php echo $row['de_name'];?></td>
			<td ><?php echo $row['de_jsfs']; ?></td>
	 
  
		  
		   <td bgcolor="#fafafa">
  
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row['ex_id'];?>&eID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span></td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=delivery&exid=<?php echo $sortID;?>','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back");?></span></td></tr>
	</table>
</form>
</div>

<?php }?>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 