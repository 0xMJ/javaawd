<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_mailtemplate";
 
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 邮件模版管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){
?>
<div class="ant">
		<div class="ant_title">邮件模版添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">模版类型:</span> <div class="sdiv">
							<select name="mt_fl" id="mt_fl">
							<?php

								foreach ($emailtemplate as $key => $value) {
									echo '<option value="'.$value.'">'.$key.'</option>';
								}
						     ?>
							
						</select><br><font class="note">* 选择模版类型</font>
						</div></li>
	 
 
						<li><span class="aspn">邮件标题:</span> <div class="sdiv"><input type="text" name="mt_title"  class="ant_input" id="mt_title" ><br><font class="note">* 邮件标题 (PS:{} 及 {}之间的内容不可改变)</font> </div></li>
	 														
						<li><span class="aspn">邮件内容:</span> <div class="sdiv"><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"></textarea>  <br><font class="note"> * 商品详细描述,支持图文上传,自由编辑。(PS:{} 及 {}之间的内容不可改变,其它内容可自由增减)</font> </div></li>

					</ul>
				</div>

		    </div>
 
			<div class="cb"></div>
			<div class="an"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('mt_fl,mt_title,contents','Add','mailtemplate','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
?>

 <div class="ant">
		<div class="ant_title">邮件模版编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">模版类型:</span> <div class="sdiv">
							<select name="mt_fl" id="mt_fl">
							 <?php

								foreach ($emailtemplate as $key => $value) {
									if($row['mt_fl']==$value){$slect='selected = "selected"';}else{$slect='';}
									 echo '<option value="'.$value.'" '.$slect.'>'.$key.'</option>';
								}
						     ?>
						</select><br><font class="note">* 选择模版类型</font>
						</div></li>
	 
 
						<li><span class="aspn">邮件标题:</span> <div class="sdiv"><input type="text" name="mt_title"  class="ant_input" value="<?php echo $row['mt_title'];?>" id="mt_title" ><br><font class="note">* 邮件标题 (PS:{} 及 {}之间的内容不可改变)</font> </div></li>
	 														
						<li><span class="aspn">邮件内容:</span> <div class="sdiv"><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo $row['contents'];?></textarea>  <br><font class="note"> * 商品详细描述,支持图文上传,自由编辑。(PS:{} 及 {}之间的内容不可改变,其它内容可自由增减)</font> </div></li>

					</ul>
				</div>

		    </div>
 
			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('mt_fl,mt_title,contents','Edit','mailtemplate','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">邮件模版管理<font class="cl">（带星*的必填）</font>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加邮件模版</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>类别</th><th>邮件标题</th> <th>显示 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>操作</th></tr>
<?php

 
	 $sql=$db_conn->query("select * from $table");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table  order by ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 	 if($row['mt_flag']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
 
			<td ><?php echo array_keys($emailtemplate,$row['mt_fl'],true)[0];?></td>
		 
	        <td bgcolor="#fafafa"><?php echo $row['mt_title'];?></td>
 
 
	       <td bgcolor="#fafafa"><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','mailtemplate','mt_flag','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td> 
	       <td>
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> </td>
		</tr>

<?php 
	}
?>
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=mailtemplate','del','<?php echo $FileSelf;?>');" /></span>
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
    		<li id="viewImg" class="viewImg"></li><span id="imgval"></span><li>  <span class="cls">取消</span><span class="ops">确定</span><input type="hidden" name="doument" value="Image"><input type="hidden" name="save_url" value="../Images/banner/"></li>
    	</ul>
       

    </div>
    </form>
</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 