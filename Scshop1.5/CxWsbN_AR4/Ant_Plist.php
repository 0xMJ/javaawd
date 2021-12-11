<?php include_once 'Ant_head.php';?>
<?php $table="sc_products";?>
<body>


<?php
if (isset($_REQUEST["scat"])){$scat=$_REQUEST["scat"];}else{$scat="";} 
if (isset($_REQUEST["skey"])){$skey=$_REQUEST["skey"];}else{$skey="";} 

if ($scat!="" && $skey!=""){
		$pfy="&scat=".$scat."&skey=".$skey."";
	    $where=" and ".ProCatId($scat,$db_conn)." and (products_name like '%".$skey."%' or products_key like '%".$skey."%' or products_model like '%".$skey."%' or contents like '%".$skey."%' )";
}elseif($scat=="" && $skey!=""){
        $pfy="&skey=".$skey."";
		$where=" and (products_name like '%".$skey."%' or products_key like '%".$skey."%' or products_model like '%".$skey."%' or contents like '%".$skey."%' )";
}elseif ($scat!="" && $skey=="") {
        $pfy="&scat=".$scat."";
	    $where=" and ".ProCatId($scat,$db_conn);
}else{
        $pfy="";
	    $where="";
}

	?>

<div class="ant">
	<div class="ant_title" style="position: relative;">商品管理 
		<div style="width: 80%; position: absolute; left: 18%; top: 2px;">
		<form name="sform" method="post" action="?lgid=<?php echo $lgid;?>">
			<select name="scat" ><option value="">请选择</option><?php echo get_strs("0",$lgid,"list",$db_conn,$scat);?></select> 
			<input type="text" name="skey" class="ant_input29" placeholder="输入产品名称,型号,关键词查询" value="<?php echo $skey;?>">
			<input type="submit" class="an_submit_up trans" value="搜索">
	    </form>
	  </div>
 </div>
	<form method="post" id="pform" action="?plist=sub">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><td colspan="20" >	<span class="sright">
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="确定" class="an_submit_up trans"/></span></td></tr>
		<tr><th>标识图</th><th>型号</th><th width="30%">名称</th><th>价格  </th><th>排序  </th><th>选择相关产品ID号</th> </tr>
<?php

 
	 $sql=$db_conn->query("select * from $table where languageID=".$lgid.$where."");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=50; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table where languageID=".$lgid.$where." order by products_paixu, ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 	$Image=explode(",", $row['ant_img']);
	 	$Image=$Image[0];
	 	if (empty($Image)){$mg='<i class="fa fa-file-image-o" aria-hidden="true"></i>';}else{ $mg='<img src="'.$Image.'" width="60" title="点击可放大" id="simg'.$row['ID'].'"><div id="img'.$row['ID'].'" style="position:absolute;left:5px; display:none; z-index:10;top:2px;padding:5px;border:1px solid #efefef; background:#fff;"><img src="'.$Image.'"" width="300"></div>';} 
 
?>	 
		<tr>
			
			<td bgcolor="#fafafa" onclick="imgzooms('img<?php echo $row['ID'];?>');" onmouseleave="imgzoom('img<?php echo $row['ID'];?>');" style='position:relative;'><?php echo $mg;?></td>
			<td><?php echo $row['products_model'] ;?></td>
			<td bgcolor="#fafafa"><?php echo $row['products_name'];?> <a> </td>
			<td ><?php echo $row['products_sprice']; ?></td>
  
		   <td bgcolor="#fafafa"><?php echo $row['products_paixu'];?></td>
            <td ><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">

<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back",$pfy);?></span></td></tr>
	</table>
</form>
</div>

 <?php  
if (isset($_GET['plist'])){$plist=$_GET['plist'];}else{$plist="";} 
if ($plist=="sub"){ 
    
 if (!empty($DID)){
    $RealID = implode(",",$DID); 
    echo "<script>window.opener.document.form.products_similar.value='".$RealID."'</script>";
    echo "<script language='javascript'>window.close();</script>";
 }else{
 	echo "<script language='javascript'>alert('请选择相关产品ID号');</script>";
 }
}
   ?> 
    

</body>
</html>