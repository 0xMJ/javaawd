<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_order";
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 订单管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
 


<?php }else if($aed=="e"){

 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
              $ProID =explode(",",rtrim($row['order_productID'],",")); //产品ID
              $ProQty =explode(",", rtrim($row['order_productsl'],",")); //产品数量
              $ProPrice = explode(",", rtrim($row['order_productdjg'],",")); //产品单价
              $ProSuxin = explode("||", $row['order_sx']);
              $ProSub = explode(",", rtrim($row['order_price'],",")); //产品小 计
              $ProTotal = $row['order_prodctzj']; //总价
              $Pfeight = $row['order_shipprice']; //运费
              $Pdiscou = $row['order_dis'];       //折扣
              $curry   = $row['order_curry'];
?>

 <div class="ant">
		<div class="ant_title">订单明细</div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab " >发货</div>
 
		    </div>
		  
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<table class="odtable" cellpadding="0" cellspacing="0">
						<tr><td><strong>订单号</strong></td><td><strong>下单日期</strong></td></tr>
						<tr><td><?php echo $row['order_number'] ?></td><td><?php echo $row['order_time'];?></td></tr>
						<tr><td><strong>买家信息</strong></td><td><strong>货运方式</strong></td></tr>
						<tr><td><?php echo CheckUserinfo($db_conn,$row['userID']);echo CheckStr_d($row['order_shipadd']); ?></td><td valign="top"><?php echo CheckExps($db_conn,$row['order_express']);?></td></tr>
						<tr><td><strong>买家留言</strong></td><td><strong>付款方式</strong></td></tr>
						<tr><td><?php if (empty($row['order_message'])){echo"未指定";}else{echo $row['order_message'];} ?></td><td><?php $pay=explode("_", $row['order_payfs']);echo Paymenthod($paymethod,$pay[0]);
			              if($row['order_flag']==0){
			               echo " <font color='red'>未付款</font>";
			              }else{
			               echo " <font color='green'>已付款</font>";
			              }?></td></tr>
					</table>
					<table class="odtables" cellpadding="0" cellspacing="1">
						<tr><th>序号</th><th>图片</th><th>产品</th><th>单价与 x 数量</th><th>金额</th></tr>
					<?php

		              for ($i=0; $i <count($ProID) ; $i++) {
		                  $ID=$ProID[$i];
		                  $j=$i+1;
		                  echo CheckProduct($db_conn,$ID,$ProSuxin,$ProPrice,$ProQty,$ProSub,$curry,$i,$j);
		              }

					?>
					<tr><td colspan="10"  align="right"><?php 

              echo "<strong>产品价格:</strong> ".$curry.sprintf("%.2f",$ProTotal+$Pdiscou-$Pfeight)." ";
              echo "<strong>物流费用:</strong> ".$curry.$Pfeight." ";
              if(!empty($Pdiscou)){
               echo "<strong>折扣:</strong> - ".$curry.$Pdiscou." (优惠码:".$row['order_disnm'].")";
              }else{
               echo "";
              }
              echo "<strong>合计:</strong> ".$curry.$ProTotal." ";

					?></td></tr>
					</table>

	 
				</div>

 
				<div class="ant_cat_c"  >
<form method="post" id="form" name="form" action="#">
					<ul>
						<li><span class="aspn">是否发货:</span> <div class="sdiv"><input type="checkbox" id="order_fh" onclick="selects('order_fh');" <?php if($row['order_fh']=="1"){echo "checked";} ?>  ><input type="hidden" name="order_fh" id="sorder_fh" value="<?php echo $row['order_fh'];?>">  <br><font class="note">* 已发货请勾选</font>
						</div></li>
						<li><span class="aspn">物流单号:</span> <div class="sdiv"><input type="text" name="order_exnb" id="order_exnb"   class="ant_input" value="<?php echo $row['order_exnb']; ?>" > <br><font class="note">* 物流单号及说明,用英文填写,会显示在前台会员中心给客户查看。</font>
						</div></li>						
						<li><span class="aspn">是否付款:</span> <div class="sdiv"><input type="checkbox" id="order_flag" onclick="selects('order_flag');"  <?php if($row['order_flag']=="1"){echo "checked";} ?>  ><input type="hidden" name="order_flag" id="sorder_flag" value="<?php echo $row['order_flag']; ?>"> <br><font class="note">* 如果线下付款请勾选</font></div></li>
	 
						<li><span class="aspn">付款说明:</span> <div class="sdiv"><textarea  name="order_paynote" class="ant_textarea"  id="order_paynote" ><?php echo $row['order_paynote']; ?></textarea><br><font class="note">* 填写详细详明,或备注</font> </div></li>
 	

					</ul>
					<div class="an"><input type="hidden" name="ID" value="<?php echo $row['ID']; ?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('order_flag','Edit','order','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
				</form>
				</div>
 

		    </div>
			<div class="cb"></div>
	 
       
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="?page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
if (isset($_REQUEST["skey"])){$skey=$_REQUEST["skey"];}else{$skey="";} 
if ($skey!=""){
		$pfy="&skey=".$skey."";
	    $where=" where order_number like '%".$skey."%'";
	}else{
        $pfy="";
	    $where="";
	}
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">订单管理		<div style="width: 60%; position: absolute; left: 28%; top: 15%;">
		<form name="sform" method="post" action="?lgid=<?php echo $lgid;?>">
			<input type="text" name="skey" class="ant_input25" placeholder="输入订单号查询" value="<?php echo $skey;?>"> 
			<input type="submit" class="an_submit_up trans" value="搜索">
	    </form>
	  </div></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>订单号</th><th>产品总价</th><th>是否付款</th><th>付款方式</th><th>是否发货</th> <th>下单时间</th> <th>下单IP</th><th>操作</th></tr>
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
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td ><?php echo $row['order_number'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['order_curry'].$row['order_prodctzj']; ?></td>
	        <td ><?php if($row['order_flag']==1){echo"<font color='green'><i class='fa fa-check' aria-hidden='true'></i> 完成</font>";}else{echo "<font color='red'>未付款</font>";}?></td>
	        <td bgcolor="#fafafa"><?php $pay=explode("_", $row['order_payfs']);echo Paymenthod($paymethod,$pay[0])?></td>
			<td ><?php if($row['order_fh']=="1"){echo "<font color='green'><i class='fa fa-check' aria-hidden='true'></i> 已发货</font>";}else{echo "<font color='red'>未发货</font>";}?></td>
			<td bgcolor="#fafafa"><?php echo $row['order_time']?></td>
	        <td ><?php echo $row['order_ip']?></td>
		    <td bgcolor="#fafafa">
		   	 <span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 查看详细</span> <?php if($row['order_zt']=="1"){echo '<font color="red" style="font-size:9px;">客户删除</font>';}?></td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=order','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back",$pfy);?></span></td></tr>
	</table>
</form>
</div>

<?php }?>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 