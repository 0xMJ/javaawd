<?php include_once 'Ant_head.php';?>
<body>
<?php $table="sc_discount";?>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 折扣管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
 

<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">折扣添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
	 
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">折扣名称:</span> <div class="sdiv"><input type="text" id="di_name" name="di_name"  class="ant_input"> <br><font class="note">* 产品编辑时方便识别</font>
						</div></li>
						<li><span class="aspn">折扣信息:</span> 
							<div class="sdiv" id="addzk"> 
							<dd><font class="note">* 多个阶级点击 + 新增；— 是清除; 最小起订量项: 输入数字 1 OR 1-2 OR 10+ 类似; 折扣项: 输入0.几的小数</font></dd>
							<dd class="zeke" ><span>最小起订量</span><span>折扣</span><span><i title="点击新增" class="fa fa-plus-square" aria-hidden="true" onclick="javascript:Addzk();"></i></span></dd>
							<dd class="zeke" id="zk1"><span><input type="text" class="ant_input27" value="1-2" name="di_qty[]" id="di_qty"></span><span><input type="text" value="0.95"  class="ant_input27" name="di_price[]" id="di_price"> </span><span><i class="fa fa-minus-square" aria-hidden="true" onclick="javascript:delImg('zk1');"></i></span></dd>
						    </div>


						</li>
						 
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="di_paixu" id="di_paixu" class="ant_input26" value="1000" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>	 

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"> <input type="submit" class="an_submit trans" value="保存" onclick="return datas('di_name,di_paixu,di_qty,di_price','Add','zeke','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));

 $qty=explode(",", $row['di_qty']);
 $qpr=explode(",", $row['di_price']);
 $i=0;
 $zk="";

 foreach ($qty as $val) {
 	if (trim($val)!=""){
 	 $zk.='<dd class="zeke" id="zks'.$i.'"><span><input type="text" class="ant_input27"  name="di_qty[]" id="di_qty" value="'.$val.'"></span><span><input type="text" value="'.$qpr[$i].'"  class="ant_input27" name="di_price[]" id="di_price"> </span><span><i class="fa fa-minus-square" aria-hidden="true" onclick="javascript:delImg(\'zks'.$i.'\');"></i></span></dd>';
 	 $i=$i+1;
 	}
 	 
 }
?>

 <div class="ant">
		<div class="ant_title">折扣编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">折扣名称:</span> <div class="sdiv"><input type="text" id="di_name" name="di_name" value="<?php echo $row['di_name']; ?>"  class="ant_input"> <br><font class="note">* 产品编辑时方便识别</font>
						</div></li>
						<li><span class="aspn">折扣信息:</span> 
							<div class="sdiv" id="addzk"> 
							<dd><font class="note">* 多个阶级点击 + 新增；— 是清除; 最小起订量项: 输入数字 1 OR 1-2 OR 10+ 类似; 折扣项: 输入0.几的小数</font></dd>
							<dd class="zeke" ><span>最小起订量</span><span>折扣</span><span><i title="点击新增" class="fa fa-plus-square" aria-hidden="true" onclick="javascript:Addzk();"></i></span></dd>
 							<?php echo $zk;?>
						    </div>


						</li>
						 
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="di_paixu" id="di_paixu" class="ant_input26" value="1000" onblur="value=value.replace(/[^\d]/g,'')" value="<?php echo $row['di_paixu']; ?>" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>	 

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"> 
				<input type="submit" class="an_submit trans" value="保存" onclick="return datas('di_name,di_paixu,di_qty,di_price','Edit','zeke','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>		    
           </form>
		</div>

</div>


<?php }else{?>

<div class="ant">
	<div class="ant_title">折扣管理<font class="cl">（带星*的必填）</font><span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加折扣</span></div>
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>序号</th><th>名称</th><th>排序 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></th> <th>时间</th><th>操作</th></tr>
<?php

	 $js=1;
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table order by di_paixu, ID desc limit $limit_st,$page_num");       
	 while($row=mysqli_fetch_array($query)){

  	 
?>	 


		<tr>
			<td bgcolor="#fafafa"><?php echo $js;?></td>
  
			<td><?php echo $row['di_name'];?></td>
			
	 
		   <td bgcolor="#fafafa" onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['di_paixu'];?></td>
 
		   <td><?php echo $row['di_time'];?></td>
		   <td bgcolor="#fafafa">
		 	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=zeke&f=di_paixu</span> 
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid;?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> <span class="an_1 trans" onclick="delCheck('Clear','<?php echo $row["ID"];?>','zeke','<?php echo $FileSelf;?>');"> <i class="fa fa-times" aria-hidden="true"></i> 删除 </span></td>
		</tr>

<?php 
   $js=$js+1;
   }

?>
<tr><td colspan="20" class="fy"><span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back");?></span></td></tr>
	</table>
</div>

<?php }?>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>
