<?php include_once 'Ant_head.php';?>
<?php $table="sc_info";?>
<?php
 
if (isset($_GET["type"])){$type=$_GET["type"];}else{$type="";}
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
    $infoName="";
    $infocat="";
if ($type=="B"){
	$infoName="博客";
}elseif($type=="A"){
	$infoName="关于我们";
	$infocat='<select name=""><option value="">'.$infoName.'</option></select>';
}elseif($type=="S"){
	$infoName="会员服务";
	$infocat='<select name=""><option value="">'.$infoName.'</option></select>';
}else{
	echo '没有相关信息';
}
$FileSelf=$FileSelf."?type=".$type.$page;
?>
<body>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - <?php echo $infoName;?></span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
 
<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title"><?php echo $infoName;?>添加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab">SEO功能</div>
				<div class="ant_cat_tab">功能显示</div>
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">分类选择:</span> <div class="sdiv"><?php if($type=="B"){?><select name="info_cat"><?php echo BlogCat("0",$db_conn,$lgid);?></select><?php }else{echo $infocat;}?><br><font class="note">* 分类名称</font></div></li>						
						<li><span class="aspn">信息名称:</span> <div class="sdiv"><input type="text" name="info_title" id="info_title" class="ant_input">  <br><font class="note">* 标题名称</font></div></li>
						<?php if($type=="B"){?><li><span class="aspn">标识图: </span><div class="sdiv"><div id="showimage"></div> <span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 500px,图片格式支持: jpg,gif,png,bmp</font></div></li><?php } ?>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"></textarea>  <br><font class="note"> 商品目录详细描述,支持图文上传,自由编辑。</font></div></li>
					    <?php if($type=="B"){?><li><span class="aspn">发布人:</span> <div class="sdiv"><input type="text" name="info_autu" id="info_autu" class="ant_input29" value="Admin">  </div></li><?php } ?>						

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="info_key" class="ant_input">  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="info_des" onkeyup="counum('description','200');" maxlength="200"></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="info_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="info_open" id="wdshow"></i> <input type="hidden" value="1" name="info_open" id="info_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox" id="info_tj" onclick="selects('info_tj');" > <input type="hidden" id="sinfo_tj" name="info_tj" value="0">  <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="info_paixu" id="info_paixu" class="ant_input29" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="info_flag" value="<?php echo $type;?>"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('info_title,contents,info_paixu','Add','info','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]))
?>

 <div class="ant">
		<div class="ant_title"><?php echo $infoName;?>编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
				<div class="ant_cat_tab">SEO功能</div>
				<div class="ant_cat_tab">功能显示</div>
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">分类选择:</span> <div class="sdiv"><?php if($type=="B"){?><select name="info_cat"><?php echo BlogCat($row['info_cat'],$db_conn,$lgid);?></select><?php }else{echo $infocat;}?><br><font class="note">* 分类名称</font></div></li>						
						<li><span class="aspn">信息名称:</span> <div class="sdiv"><input type="text" name="info_title" id="info_title" value="<?php echo $row['info_title'];?>" class="ant_input">  <br><font class="note">* 标题名称</font></div></li>
						<?php if($type=="B"){?><li><span class="aspn">标识图: </span><div class="sdiv">
							<div id="showimage" style="display: block;"> 
							<?php
							$ant_img=trim($row['ant_img'],",");
							if(!empty($ant_img)){
							$date = date("ymdhis").'_'.rand(100,9999); //
							echo '<span id="Img'.$date.'">';
								?>

						<img src="<?php echo trim($row['ant_img'],",");?>"><?php echo '<input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.trim($row['ant_img'],",").'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br>';?>
						</span>
						<?php }?>

					   </div> 

						 <span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 500px,图片格式支持: jpg,gif,png,bmp</font></div></li><?php } ?>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo $row['contents'];?></textarea>  <br><font class="note"> 商品目录详细描述,支持图文上传,自由编辑。</font></div></li>
					    <?php if($type=="B"){?><li><span class="aspn">发布人:</span> <div class="sdiv"><input type="text" name="info_autu" id="info_autu" class="ant_input29" value="<?php echo $row['info_autu'];?>">  </div></li><?php } ?>						

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="info_key" class="ant_input" value="<?php echo $row['info_key'];?>" >  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="info_des" onkeyup="counum('description','200');" maxlength="200"><?php echo $row['info_des'];?></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="info_url" class="ant_input" value="<?php echo $row['info_url'];?>" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if ($row['info_open']==1){echo 'on';}else{echo 'off';} ?>"  aria-hidden="true" dataid="info_open" id="wdshow"></i> <input type="hidden" value="<?php echo $row['info_open'];?>" name="info_open" id="info_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox" id="info_tj" onclick="selects('info_tj');" <?php if ($row['info_tj']==1){echo 'checked="checked"';} ?> > <input type="hidden" id="sinfo_tj" name="info_tj" value="<?php echo $row['info_tj'];?>">  <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="info_paixu" id="info_paixu" class="ant_input29" onblur="value=value.replace(/[^\d]/g,'')" value="<?php echo $row['info_paixu'];?>" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="hidden" name="info_flag" value="<?php echo $type;?>"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('info_title,contents,info_paixu','Edit','info','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>

		</div>

</div>


<?php }else{

if (isset($_REQUEST["info_cat"])){$scat=$_REQUEST["info_cat"];}else{$scat="";} 
if (isset($_REQUEST["skey"])){$skey=$_REQUEST["skey"];}else{$skey="";} 

if ($scat!="" && $skey!=""){
		$pfy="&scat=".$scat."&skey=".$skey."";
	    $where=" and info_cat=".$scat." and (info_title like '%".$skey."%' or info_key like '%".$skey."%' or contents like '%".$skey."%' ) and info_flag='".$type."'";
}elseif($scat=="" && $skey!=""){
        $pfy="&skey=".$skey."";
		$where=" and (info_title like '%".$skey."%' or info_key like '%".$skey."%' or contents like '%".$skey."%' ) and info_flag='".$type."'";
}elseif ($scat!="" && $skey=="") {
        $pfy="&scat=".$scat."";
	    $where=" and info_cat=".$scat." and info_flag='".$type."'";
}else{
        $pfy="";
	    $where=" and info_flag='".$type."'";
}



	?>

<div class="ant">
	<div class="ant_title" style="position: relative;"><?php echo $infoName;?>管理<font class="cl">（带星*的必填）</font>
		<div style="width: 60%; position: absolute; left: 28%; top: 23%;">
		<form name="sform" method="post" action="?type=<?php echo $type;?>&lgid=<?php echo $lgid;?>">
			<?php if($type=="B"){?><select name="info_cat"><option value="">请选择</option><?php echo BlogCat($scat,$db_conn,$lgid);?></select><?php }else{echo $infocat;}?>
			<input type="text" name="skey" class="ant_input29" placeholder="输入关键词查询" value="<?php echo $skey;?>">
			<input type="submit" class="an_submit_up trans" value="搜索">
	    </form>
	  </div>

		<span class="an_submit_up trans" onclick="location.href='?aed=a&type=<?php echo $type;?>'"><i class="fa fa-plus" aria-hidden="true"></i> 发布信息</span></div>
<form method="post" id="pform" action="#">	
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID</th><?php if ($type=="B"){?><th>标识图 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击图片放大"></i></th><th>所属分类</th><?php } ?><th>名称</th><th>显示 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th>推荐 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th>时间</th><th width="70">排序<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>操作</th></tr>
<?php

 	 
	 $sql=$db_conn->query("select * from $table where languageID=".$lgid.$where."");  
	 $all_num=mysqli_num_rows($sql); //总条数
	 $page_num=$page_nums; //每页条数
	 $page_all_num = ceil($all_num/$page_num); //总页数
	 $page=empty($_GET['page'])?1:$_GET['page']; //当前页数
	 $page=(int)$page; //安全强制转换
	 $limit_st = ($page-1)*$page_num; //起始数
	 $query=$db_conn->query("select * from $table where languageID=".$lgid.$where." order by info_paixu, ID desc limit $limit_st,$page_num ");       
	 while($row=mysqli_fetch_array($query)){
	 	$Image=explode(",", $row['ant_img']);
	 	$Image=$Image[0];
	 	if (empty($Image)){$mg='<i class="fa fa-file-image-o" aria-hidden="true"></i>';}else{ $mg='<img src="'.$Image.'" width="60" title="点击可放大" id="simg'.$row['ID'].'"><div id="img'.$row['ID'].'" style="position:absolute;left:5px; display:none; z-index:10;top:2px;padding:5px;border:1px solid #efefef; background:#fff;"><img src="'.$Image.'"" width="300"></div>';} 
	 	if($row['info_open']==1){$of="on";$op=1;}else{$of="off";$op=0;}
	 	if($row['info_tj']==1){$tof="on";$tj=1;}else{$tof="off";$tj=0;}
  
?>	 
		<tr>
			<td ><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<?php if ($type=="B"){?><td bgcolor="#fafafa" onclick="imgzooms('img<?php echo $row['ID'];?>');" onmouseleave="imgzoom('img<?php echo $row['ID'];?>');" style='position:relative;'><?php echo $mg;?></td><td><?php echo ReadBlogCatName($db_conn,$row['info_cat']);?></td><?php } ?>
			<td width="30%" bgcolor="#fafafa"><?php echo $row['info_title'];?> <a> </td>
			<td><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','info','info_open','<?php echo $op;?>','op');" class="fa fa-toggle-on fa-2x <?php echo $of;?>"  aria-hidden="true" id="'op<?php echo $row["ID"];?>'" ></i></td>
			<td ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','info','info_tj','<?php echo $tj;?>','tj');" class="fa fa-toggle-on fa-2x <?php echo $tof;?>"  aria-hidden="true" id="'tj<?php echo $row["ID"];?>'" ></i></td>
           <td bgcolor="#fafafa"><?php echo $row['info_time'];?></td>
		   <td  onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['info_paixu'];?></td>
		  
		   <td >
		   	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=info&f=info_paixu</span> 
 			
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid; ?>&type=<?php echo $type;?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> </td>
		</tr>

<?php 
	}
?>	 
<tr><td colspan="20" class="fy">
	<span class="sleft">
		<input type="button" id="button" value="选择所有" class="an_submit_up trans" onclick="checkAll('DID[]')" /> 
		<input type="button" value="清空选中"  id="button" class="an_submit_up trans" onclick="clearAll('DID[]')" />
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=info&lgid=<?php echo $lgid;?>','del','<?php echo $FileSelf;?>');" /></span>
	<span class="sright">共 <?php echo $all_num;?> 记录 <?php echo show_page($all_num,$page,$page_num,"back",$pfy);?></span></td></tr>
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
    		<li id="viewImg" class="viewImg"></li><span id="imgval"></span><li>  <span class="cls">取消</span><span class="ops">确定</span><input type="hidden" name="doument" value="Image"><input type="hidden" name="save_url" value="../Images/blog/"></li>
    	</ul>
       

    </div>
    </form>
</div>
<div style="clear:both"></div>
 <div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>