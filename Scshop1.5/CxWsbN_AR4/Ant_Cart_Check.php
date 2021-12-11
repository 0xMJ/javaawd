<?php include_once 'Ant_head.php';?>
<?php 
    $table="sc_cart";

?>
<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 购物车分析</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
<?php   
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">购物车分析<font class="cl"> </font>
			 </div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>产品</th><th>数量</th><th>E-Mail </th><th>IP</th><th>时间 </th> </tr>
<?php

 
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table order by  ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 	  
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td ><?php echo Prcheck($row['ct_pid'],$db_conn);?></td>
			<td bgcolor="#fafafa"><?php echo $row['ct_qty'];?></td>
			<td ><?php echo $row['ct_mail'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['ct_ip'];?></td>
			<td ><?php echo $row['ct_time'];?></td>
 		 
 			
		</tr>

<?php 
	}

function Prcheck($str,$db_conn){
	$st =  explode(":",$str);
	$pid = trim(str_replace("Ant_", "", $st[0]));

       $query=$db_conn->query("select  * from sc_products where ID = ".$pid);
       if (mysqli_num_rows($query)>0){ 
         while($row=mysqli_fetch_array($query)){
         	$img =explode("," , $row['ant_img']);
	 	if (!empty(trim($row['products_url']))){
	 		$ulink = "../".trim($row['products_url']).".html";
	 	}else{
	 		$ulink = "../".trim($row['ID']).".html";
	 	}

            echo "<a href='".$ulink."' target='_blank'><img src='".$img[0]."' width='50' align='absmiddle'>".$row['products_name']."<br>价格: ".$row['products_sprice']." 型号: ".$row['products_model']."</a>";
         }
      }

}

?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=carcheck','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back");?></span></td></tr>
	</table>
</form>
</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 