<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_coupon";
?>

<body>
<script language="javascript" src="Js/TimeSelect.js"></script>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> -  优惠券管理 </span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">优惠券添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">优惠券标题:</span> <div class="sdiv">
							 <input type="text"  name="cou_title" id="cou_title" class="ant_input"><br><font class="note">* 一句描述的话语</font>
						</div></li>
						<li><span class="aspn">优惠券描述:</span> <div class="sdiv"><textarea class="ant_textarea" name="cou_tent" id="cou_tent"></textarea> <br><font class="note">* 一段描述的话语 </font></div></li>
						<li><span class="aspn">标识图: </span><div class="sdiv"><span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">
	 
						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 800px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span class="aspn">优惠码:</span> <div class="sdiv"><input type="text" name="cou_code"  class="ant_input26" id="cou_code" ><br><font class="note">* 数字字母组成的代码 如:hello2020888</font> </div></li>
						<li><span class="aspn">优惠金额:</span> <div class="sdiv"><input type="text" name="cou_price"  class="ant_input26" onblur="value=value.replace(/[^\d.]/g,'')" id="cou_price" ><br><font class="note">* 以美元为基准，输入格式 如：10 即可</font> </div></li>
						<li><span class="aspn">优惠起始金额:</span> <div class="sdiv"><input type="text" name="cou_overprice"  class="ant_input26" onblur="value=value.replace(/[^\d.]/g,'')" id="cou_overprice" ><br><font class="note">* 以美元为基准,超过输入的金额才可以用优惠券,输入格式 如：100 即可</font> </div></li>
			 			 			 
						<li><span class="aspn">优惠有效时间:</span> <div class="sdiv">起如时间 : <input type="text" name="cou_startime"  class="ant_input26" id="cou_startime" onclick="SelectDate(this,'yyyy\-MM\-dd',0,-150)" readonly="readOnly" > 结束时间 :<input type="text" name="cou_overtime"  class="ant_input26" id="cou_overtime" onclick="SelectDate(this,'yyyy\-MM\-dd',0,-150)" readonly="readOnly" ><br> <font class="note">* 以美元为基准,超过输入的金额才可以用优惠券</font> </div></li>
			 			 			 			 
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="cou_flag" id="wdshow"></i> <input type="hidden" value="1" name="cou_flag" id="cou_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>				
					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('cou_title,cou_tent,cou_code,cou_price,cou_overprice,cou_startime,cou_overtime','Add','coupon','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
 
?>

 <div class="ant">
		<div class="ant_title">优惠券编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">

				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">优惠券标题:</span> <div class="sdiv">
							 <input type="text"  name="cou_title" id="cou_title" value="<?php echo $row['cou_title'];?>" class="ant_input"><br><font class="note">* 一句描述的话语</font>
						</div></li>
						<li><span class="aspn">优惠券描述:</span> <div class="sdiv"><textarea class="ant_textarea" name="cou_tent" id="cou_tent"><?php echo $row['cou_tent'];?></textarea> <br><font class="note">* 一段描述的话语 </font></div></li>
						<li><span class="aspn">标识图: </span><div class="sdiv"><span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">
	 					  <?php
	 					    $ant_img=trim($row['ant_img'],",");
							if(!empty($ant_img)){
							$date = date("ymdhis").'_'.rand(100,9999); //
							echo '<span id="Img'.$date.'" >';
							 ?>
							<img src="<?php echo trim($row['ant_img'],",");?>" style="height:40px;">
							<?php echo '<input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.trim($row['ant_img'],",").'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br>';?>
							</span>
							<?php }else{
							echo "";
							}?>	 
						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 800px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span class="aspn">优惠码:</span> <div class="sdiv"><input type="text" name="cou_code" value="<?php echo $row['cou_code'];?>"   class="ant_input26" id="cou_code" ><br><font class="note">* 数字字母组成的代码 如:hello2020888</font> </div></li>
						<li><span class="aspn">优惠金额:</span> <div class="sdiv"><input type="text" name="cou_price" value="<?php echo $row['cou_price'];?>"  class="ant_input26" onblur="value=value.replace(/[^\d.]/g,'')" id="cou_price" ><br><font class="note">* 以美元为基准，输入格式 如：10 即可</font> </div></li>
						<li><span class="aspn">优惠起始金额:</span> <div class="sdiv"><input type="text" name="cou_overprice" value="<?php echo $row['cou_overprice'];?>"  class="ant_input26" onblur="value=value.replace(/[^\d.]/g,'')" id="cou_overprice" ><br><font class="note">* 以美元为基准,超过输入的金额才可以用优惠券,输入格式 如：100 即可</font> </div></li>
			 			 			 
						<li><span class="aspn">优惠有效时间:</span> <div class="sdiv">起如时间 : <input type="text" name="cou_startime"  class="ant_input26" value="<?php echo $row['cou_startime'];?>"  id="cou_startime" onclick="SelectDate(this,'yyyy\-MM\-dd',0,-150)" readonly="readOnly" > 结束时间 :<input type="text" name="cou_overtime"  class="ant_input26" value="<?php echo $row['cou_overtime'];?>" id="cou_overtime" onclick="SelectDate(this,'yyyy\-MM\-dd',0,-150)" readonly="readOnly" ><br> <font class="note">* 以美元为基准,超过输入的金额才可以用优惠券</font> </div></li>
			 			 			 			 
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if($row['cou_flag']==1){echo 'on';}else{echo 'off';} ?>"  aria-hidden="true" dataid="cou_flag" id="wdshow"></i> <input type="hidden" value="<?php echo $row['cou_flag'];?>" name="cou_flag" id="cou_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>				
					</ul>
				</div>
  
		    </div>

			<div class="cb"></div>
			<div class="an"> <input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('cou_title,cou_tent,cou_code,cou_price,cou_overprice,cou_startime,cou_overtime','Edit','coupon','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="?page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">优惠券管理<font class="cl">（带星*的必填）</font>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加优惠券</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>优惠码</th><th>优惠金额</th><th>起如时间</th><th>结束时间</th> <th>显示 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table order by ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
 
	 	if($row['cou_flag']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
	 	 
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>

 
			<td ><?php echo $row['cou_code'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['cou_price'];?></td>
			<td ><?php echo $row['cou_startime'];?></td>
			<td bgcolor="#fafafa"><?php echo $row['cou_overtime'];?></td>
		 
	        <td ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','coupon','cou_flag','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
		   <td bgcolor="#fafafa">
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> </td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=coupon','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back");?></span></td></tr>
	</table>
</form>
</div>

<?php }?>

<div class="antask"></div>
<div class="antess">
	<div class="antitle">文件 <span class="cls"><i class="fa fa-times" aria-hidden="true"></i></span></div>
	<form id="UpFile" onsubmit="return false"  action="#" method="post" enctype="multipart/form-data">
    <div class="imgcontent" >
    	
    	<ul>
    		<li><label class="labal">自定文件名：</label><input type="text" name="imgname" id="imgname" class="imginput" onblur="value=value.replace(/[^\d\w-]/g,'')"><br></li>
    		<li class="cl">可不填,填写格式 a-b-c-d 词之间用-链接,不能有空格,不能有重名,只能数字与字母</li>
    		<li><label class="labal">上传文件：</label><input type="text" name="imgurl" id="imgurl" class="imginput" readonly><span class="uploads">浏览..<input type="file" id="file"> </span></li>
    		<li id="viewImg" class="viewImg"></li><span id="imgval"></span><li>  <span class="cls">取消</span><span class="ops">确定</span><input type="hidden" name="doument" value="Image"><input type="hidden" name="save_url" value="../Images/other/"></li>
    	</ul>
       

    </div>
    </form>
</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 