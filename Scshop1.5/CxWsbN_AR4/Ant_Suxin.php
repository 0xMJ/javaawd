<?php include_once 'Ant_head.php';?>
<body>
<?php $table="sc_suxin";?>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 商品管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">属性添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
	 
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">属性名称:</span> <div class="sdiv"><input type="text" id="sx_name" name="sx_name"  class="ant_input"> <br><font class="note">* 如颜色,尺寸</font>
						</div></li>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="sx_flag" id="wdshow"></i> <input type="hidden" value="1" name="sx_flag" id="sx_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>
						 
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="sx_paixu" id="sx_paixu" class="ant_input" value="1000" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>	 

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"> <input type="submit" class="an_submit trans" value="保存" onclick="return datas('sx_name,sx_paixu','Add','suxin','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]))
?>

 <div class="ant">
		<div class="ant_title">属性编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">属性名称:</span> <div class="sdiv"><input type="text" id="sx_name" name="sx_name" value="<?php echo $row['sx_name'];?>"  class="ant_input"> <br><font class="note">* 如颜色,尺寸</font>
						</div></li>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if($row['sx_flag']==1){echo "on";}else{echo "off";}?>"  aria-hidden="true" dataid="sx_flag" id="wdshow"></i> <input type="hidden" value="<?php echo $row['sx_flag'];?>" name="sx_flag" id="sx_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>
						 
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="sx_paixu" id="sx_paixu" class="ant_input" value="<?php echo $row['sx_paixu'];?>" onblur="value=value.replace(/[^\d]/g,'')"  maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>	 

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"> <input type="submit" class="an_submit trans" value="保存" onclick="return datas('sx_name,sx_paixu','Edit','suxin','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>		    
           </form>
		</div>

</div>


<?php }else{?>

<div class="ant">
	<div class="ant_title">属性管理<font class="cl">（带星*的必填）</font><span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加属性</span></div>
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>序号</th><th>名称</th><th>排序 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可修改"></th><th>显示<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>时间</th><th>操作</th></tr>
<?php

	 $js=1;
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table order by sx_paixu, ID desc limit $limit_st,$page_num");       
	 while($row=mysqli_fetch_array($query)){

  	 if($row['sx_flag']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
?>	 


		<tr>
			<td bgcolor="#fafafa"><?php echo $js;?></td>
  
			<td><?php echo $row['sx_name'];?></td>
			
	 
		   <td bgcolor="#fafafa" onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['sx_paixu'];?></td>
		   <td><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','suxin','sx_flag','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
		   <td bgcolor="#fafafa"><?php echo $row['sx_time'];?></td>
		   <td bgcolor="#fafafa">
		 	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=suxin&f=sx_paixu</span> 
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid;?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> <span class="an_1 trans" onclick="delCheck('Clear','<?php echo $row["ID"];?>','suxin','<?php echo $FileSelf;?>');"> <i class="fa fa-times" aria-hidden="true"></i> 删除 </span></td>
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
