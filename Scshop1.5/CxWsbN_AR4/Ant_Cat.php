<?php include_once 'Ant_head.php';?>
<body>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 商品目录</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
 
<?php if($aed=="a"){ ?> 
<div class="ant">
		<div class="ant_title">商品目录添加<font class="cl">（带星*的必填）</font></div>
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
						<li><span class="aspn">目录名称:</span> <div class="sdiv"><input type="text" name="category_name" id="category_name" class="ant_input">  <br><font class="note">* 商品分类名称</font></div></li>
						<li><span class="aspn">标识图: </span><div class="sdiv"><div id="showimage"></div> <span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 500px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="category_sortdes"></textarea>  </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" style="width:98%;height:300px;visibility:hidden;"></textarea>  <br><font class="note"> 商品目录详细描述,支持图文上传,自由编辑。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" name="category_mtitle" id="tmeta" class="ant_input" onkeyup="counum('tmeta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="tmetas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="category_key" class="ant_input">  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="category_des" onkeyup="counum('description','200');" maxlength="200"></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="category_url" class="ant_input" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x on"  aria-hidden="true" dataid="category_open" id="wdshow"></i> <input type="hidden" value="1" name="category_open" id="category_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox" id="category_tj" onclick="selects('category_tj');" > <input type="hidden" id="scategory_tj" name="category_tj" value="0">  <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="category_paixu" id="category_paixu" class="ant_input" onblur="value=value.replace(/[^\d]/g,'')" value="10000" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="category_pid" value="<?php echo $sortID;?>"><input type="hidden" name="onlyid" value="<?php echo OnlyId();?>"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('category_name,category_paixu','Add','cat','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM sc_categories WHERE ID=".$_GET["sortID"]))
?>

 <div class="ant">
		<div class="ant_title">商品目录编辑<font class="cl">（带星*的必填）</font></div>
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
						<li><span class="aspn">目录名称:</span> <div class="sdiv"><input type="text" name="category_name" id="category_name" value="<?php echo CheckStr_d($row['category_name']);?>" class="ant_input">  <br><font class="note">* 商品分类名称</font></div></li>
						<li><span class="aspn">标识图: </span><div class="sdiv"><div id="showimage" style="display: block;"> 
							<?php
							$ant_img=trim($row['ant_img'],",");
							if(!empty($ant_img)){
							$date = date("ymdhis").'_'.rand(100,9999); //
							echo '<span id="Img'.$date.'">';
								?>

<img src="<?php echo trim($row['ant_img'],",");?>"><?php echo '<input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.trim($row['ant_img'],",").'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br>';?>
</span>
<?php }?>

					</div> <span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片大小保持 500px,图片格式支持: jpg,gif,png,bmp</font></div></li>
						<li><span  class="aspn">概括描述: </span><div class="sdiv"><textarea class="ant_textarea"  name="category_sortdes"><?php echo CheckStr_d($row['category_sortdes']);?></textarea>  </div></li>
						<li><span class="aspn">详细描述: </span><div class="sdiv" ><textarea name="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo CheckStr_d($row['contents']);?></textarea>  <br><font class="note"> 商品目录详细描述,支持图文上传,自由编辑。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">标题(meta):</span> <div class="sdiv"><input type="text" name="category_mtitle" id="tmeta" value="<?php echo CheckStr_d($row['category_mtitle']);?>" class="ant_input" onkeyup="counum('tmeta','70');" maxlength="70">  <br><font class="note">长度：最多70个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="tmetas">0</span> / 70</font> </div></li>
						<li><span class="aspn">关键词(keywords): </span><div class="sdiv"><input type="text" name="category_key" class="ant_input" value="<?php echo CheckStr_d($row['category_key']);?>" >  <br><font class="note">词组之间用英文逗号隔开。如: hello world,hello china</font></div></li>	
						<li><span  class="aspn">简要描述(description): </span><div class="sdiv"><textarea class="ant_textarea" id="description" name="category_des" onkeyup="counum('description','200');" maxlength="200"><?php echo CheckStr_d($row['category_des']);?></textarea>   <br><font class="note">长度：最多200个字符 &nbsp;&nbsp;&nbsp; 当前: <span id="descriptions">0</span> / 200</font></div></li>
						<li><span class="aspn">链接地址(URL): </span><div class="sdiv"><input type="text" name="category_url" class="ant_input" value="<?php echo CheckStr_d($row['category_url']);?>" onblur="value=value.replace(/[^\d\w-]/g,'')" >  <br><font class="note">必须按如下规则如:a-b-c-d 词与词之间用 - 链接,链接地址只能出现 数字与英文。一般链接地址可用核心关键词作url,利于优化,url地址不宜太长、适中。</font></div></li>

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">是否显示:</span> <div class="sdiv"><i class="fa fa-toggle-on fa-2x <?php if ($row['category_open']==1){echo 'on';}else{echo 'off';} ?>"  aria-hidden="true" dataid="category_open" id="wdshow"></i> <input type="hidden" value="<?php echo $row['category_open'];?>" name="category_open" id="category_open">  <br><font class="note"> 绿色代表显示,灰色代表不显示。此功能关系到网页前台是否显示。</font></div></li>
						<li><span class="aspn">是否推荐: </span><div class="sdiv"><input type="checkbox" id="category_tj" <?php if ($row['category_tj']==1){echo 'checked="checked"';} ?> onclick="selects('category_tj');"  > <input type="hidden" id="scategory_tj" name="category_tj" value="<?php echo $row['category_tj'];?>"> <br><font class="note">此功能在相应的模版中显示此栏目。并不是所有模版上都体现此功能。</font></div></li>
						<li><span class="aspn">排序: </span><div class="sdiv"><input type="text" name="category_paixu" id="category_paixu" class="ant_input" onblur="value=value.replace(/[^\d]/g,'')" value="<?php echo $row['category_paixu'];?>" maxlength="6">  <br><font class="note">* 从小大到排列,数字越小越靠前 如：0,1,2,3,4...此项只能填整数。默认值:10000</font></div></li>

					</ul>
				</div>
		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="hidden" name="languageID" value="<?php echo $lgid;?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('category_name,category_paixu','Edit','cat','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{?>

<div class="ant">
	<div class="ant_title">商品目录管理<font class="cl">（带星*的必填）</font><span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加一级目录</span></div>
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID</th><th>标识图 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击图片放大"></i></th><th>名称</th><th>显示 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th>推荐 <i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></th><th width="70">排序<i class="fa fa-question-circle-o" aria-hidden="true" title="点击数字可更改"></i></th><th>操作</th></tr>
		<?php echo get_str("0",$lgid,"p",$db_conn,$FileSelf); ?>

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