<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_express";
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 物流管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">物流添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
			<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">物流名称:</span> <div class="sdiv"><input type="text" name="ex_name" id="ex_name"   class="ant_input26" > <br><font class="note">*</font>
						</div></li>
						<li><span class="aspn">物流网址:</span> <div class="sdiv"><input type="text"  name="ex_http" id="ex_http" class="ant_input26"></div></li>
						<li><span class="aspn">标识图: </span><div class="sdiv"><span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">
						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 800px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span class="aspn">物流描述:</span> <div class="sdiv"><textarea name="ex_des" class="ant_textarea" id="ex_des"></textarea><br><font class="note">*</font> </div></li>	
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="ex_flag" id="wdshow"></i> <input type="hidden" value="1" name="ex_flag" id="ex_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>																		
 						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="ex_paixu" id="ex_paixu" class="ant_input26"   onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>					

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('ex_name,ex_des,ex_paixu','Add','express','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
 
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
						<li><span class="aspn">物流名称:</span> <div class="sdiv"><input type="text" name="ex_name" id="ex_name"   class="ant_input26" value="<?php echo $row['ex_name'];?>" > <br><font class="note">*</font>
						</div></li>
						<li><span class="aspn">物流网址:</span> <div class="sdiv"><input type="text" value="<?php echo $row['ex_http'];?>"   name="ex_http" id="ex_http" class="ant_input26"></div></li>
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
						<li><span class="aspn">物流描述:</span> <div class="sdiv"><textarea name="ex_des" class="ant_textarea" id="ex_des"><?php echo $row['ex_des'];?></textarea><br><font class="note">*</font> </div></li>	
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if($row['ex_flag']==1){echo 'on';}else{echo 'off';}?>"  aria-hidden="true" dataid="ex_flag" id="wdshow"></i> <input type="hidden" value="<?php echo $row['ex_flag'];?>" name="ex_flag" id="ex_flag">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能作用于产品前台是否显示。</font></div></li>																		
 						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="ex_paixu" id="ex_paixu" class="ant_input26"   onblur="value=value.replace(/[^\d]/g,'')" value="<?php echo $row['ex_paixu'];?>" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>		

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"> <input type="submit" class="an_submit trans" value="保存" onclick="return datas('ex_name,ex_des,ex_paixu','Edit','express','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="?page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">物流管理<font class="cl">（带星*的必填）</font>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加物流</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>图片</th><th>名称</th><th>网址</th><th>状态<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>排序<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table order by ex_paixu, ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
 
	 	if($row['ex_flag']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td>
				<?php
				$ant_imag=trim($row['ant_img'],",");
				if(!empty($ant_imag)){
				echo '<img src="'.trim($row['ant_img'],",").'" height="30">';
			    }else{
				echo '';
			    }
			    ?>
			</td>
 
			<td bgcolor="#fafafa"><?php echo $row['ex_name'];?></td>
			<td ><?php echo $row['ex_http']; ?></td>
	 
			<td bgcolor="#fafafa"><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','express','ex_flag','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
		   <td  onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['ex_paixu'];?></td>
		   <td bgcolor="#fafafa">
		   	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=express&f=ex_paixu</span> 
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> <span class="an_1 trans" onclick="location.href='Ant_M_Delivery.php?sortID=<?php echo $row["ID"];?>'"><i class="fa fa-th" aria-hidden="true"></i> 配送方式管理</span></td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=express','del','<?php echo $FileSelf;?>');" /></span>
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


 