<?php include_once 'Ant_head.php';?>
<?php $table="sc_blogcat";?>
<body>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 博客目录</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){ ?>
<div class="ant">
		<div class="ant_title">博客目录添加<font class="cl">（带星*的必填）</font></div>
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
						<li><span class="aspn">目录名称:</span> <div class="sdiv"><input type="text" name="b_name" id="b_name" class="ant_input">  <br><font class="note">* 分类名称</font></div></li>
			 
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="b_sortdes"></textarea>  </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" style="width:98%;height:300px;visibility:hidden;"></textarea>  <br><font class="note"> 目录详细描述,支持图文上传,自由编辑。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" name="b_title" id="tmeta" class="ant_input" onkeyup="counum('tmeta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="tmetas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="b_key" class="ant_input">  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="b_des" onkeyup="counum('description','200');" maxlength="200"></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="b_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="b_open" id="wdshow"></i> <input type="hidden" value="1" name="b_open" id="b_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox"  id="b_tj" onclick="selects('b_tj');"> <input type="hidden" name="b_tj" id="sb_tj" value="0"> <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="b_paixu" id="b_paixu" class="ant_input" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('b_name,b_paixu','Add','blogcat','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$sortID))
?>

 <div class="ant">
		<div class="ant_title">博客目录编辑<font class="cl">（带星*的必填）</font></div>
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
						<li><span class="aspn">目录名称:</span> <div class="sdiv"><input type="text" name="b_name" id="b_name" class="ant_input" value="<?php echo $row['b_name'];?>" >  <br><font class="note">* 分类名称</font></div></li>
			 
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="b_sortdes"><?php echo $row['b_sortdes'];?></textarea>  </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo $row['contents'];?></textarea>  <br><font class="note"> 目录详细描述,支持图文上传,自由编辑。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" name="b_title" id="tmeta" class="ant_input" value="<?php echo $row['b_title'];?>" onkeyup="counum('tmeta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="tmetas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="b_key" class="ant_input"  value="<?php echo $row['b_key'];?>" >  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="b_des" onkeyup="counum('description','200');" maxlength="200"><?php echo $row['b_des'];?></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" value="<?php echo $row['b_url'];?>" name="b_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if($row['b_open']==1){echo "on";}else{echo "off";} ?>"  aria-hidden="true" dataid="b_open" id="wdshow"></i> <input type="hidden" value="<?php echo $row['b_open'];?>" name="b_open" id="b_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox" id="b_tj" onclick="selects('b_tj');" <?php if($row['b_tj']==1){echo "checked";}?> > <input type="hidden" name="b_tj" id="sb_tj" value="<?php echo $row['b_tj'];?>"> <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" value="<?php echo $row['b_paixu'];?>" name="b_paixu" id="b_paixu" class="ant_input" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('b_name,b_paixu','Edit','blogcat','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>           
		</div>

</div>


<?php }else{?>

<div class="ant">
	<div class="ant_title">博客目录管理<font class="cl">（带星*的必填）</font><span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加目录</span></div>
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID</th> <th>名称</th><th>显示 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th>推荐 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th width="70">排序<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>操作</th></tr>
<?php

	 $query=$db_conn->query("select * from $table where languageID=".$lgid." order by b_paixu, ID desc");       
	 while($row=mysqli_fetch_array($query)){
     if($row['b_tj']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
     if($row['b_open']==1){$oof="on";$open=1;}else{$oof="off";$open=0;}
?>	
		<tr>
			<td bgcolor="#fafafa"><?php echo $row['ID'];?></td>
 
			<td><?php echo $row['b_name'];?></td>

            <td bgcolor="#fafafa" ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','blogcat','b_open','<?php echo $open;?>','open');" class="fa fa-toggle-on fa-2x <?php echo $oof;?>"  aria-hidden="true" id="'open<?php echo $row["ID"];?>'" ></i></td>

			<td  ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','blogcat','b_tj','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
         	<td bgcolor="#fafafa" onclick="px('px<?php echo $row["ID"];?>');" id='px<?php echo $row["ID"];?>'><?php echo $row['b_paixu'];?></td>
		   <td>
		   	<span id='cpx<?php echo $row["ID"];?>' style='display:none'>action=Paixu&sortID=<?php echo $row["ID"];?>&sort=blogcat&f=b_paixu</span> 
 
		   	<span class="an_1 trans" onclick="location.href='?aed=e&sortID=<?php echo $row["ID"];?>&lgid=<?php echo $lgid; ?>'"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</span> <?php echo "<span class='an_1 trans' onclick=\"delCheck('Clear','".$row['ID']."','blogcat','".$FileSelf."');\"> <i class='fa fa-times' aria-hidden='true'></i> 删除 </span>" ?> </td>
		</tr>
<?php }?>

	</table>

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
    		<li id="viewImg" class="viewImg"></li><span id="imgval"></span><li>  <span class="cls">取消</span><span class="ops">确定</span><input type="hidden" name="doument" value="Image"><input type="hidden" name="save_url" value="../Images/catalog/"></li>
    	</ul>
       

    </div>
    </form>
</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>