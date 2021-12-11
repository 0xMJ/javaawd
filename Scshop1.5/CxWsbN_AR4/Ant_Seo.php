<?php include_once 'Ant_head.php';
$Ant=new WD_Data_Process();
$table="sc_tagandseo";
if ($Ant->CheckData($table,"languageID",$lgid,$db_conn)==1){
 	$ade="Edit";
}else{
  	$ade="Add";
}
$row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE languageID=".$lgid));
?>
<body>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - SEO设置</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
 
<div class="ant">
		<div class="ant_title">SEO设置<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >首页</div>
				<div class="ant_cat_tab">产品页</div>
				<div class="ant_cat_tab">信息页</div>
				<div class="ant_cat_tab">其它页设置</div>
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">首页标题:<br>title</span> <div class="sdiv"><input type="text" name="tag_h_title" id="tag_h_title" value="<?php echo $row['tag_h_title'];?>" class="ant_input25">  <br><font class="note">* 显示在标题栏上</font></div></li>
						<li><span class="aspn">首页关键词:<br>meta keywords</span> <div class="sdiv"><input type="text" name="tag_h_key" id="tag_h_key" value="<?php echo $row['tag_h_key'];?>" class="ant_input25">  <br><font class="note">* 显示在源代码中的 keywords</font></div></li>
						<li><span class="aspn">首页关描述:<br>meta description</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_h_des" id="tag_h_des"><?php echo $row['tag_h_des'];?></textarea> <br><font class="note">* 显示在源代码中的 description</font></div></li>	 
					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">产品列表标题:<br>title</span> <div class="sdiv"><input type="text" name="tag_p_title" id="tag_p_title" value="<?php echo $row['tag_p_title'];?>" class="ant_input25">  <br><font class="note">* 显示在标题栏上</font></div></li>
						<li><span class="aspn">产品列表关键词:<br>meta keywords</span> <div class="sdiv"><input type="text" name="tag_p_key" id="tag_p_key" value="<?php echo $row['tag_p_key'];?>" class="ant_input25">  <br><font class="note">* 显示在源代码中的 keywords</font></div></li>
						<li><span class="aspn">产品列表关描述:<br>meta description</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_p_des" id="tag_p_des"><?php echo $row['tag_p_des'];?></textarea> <br><font class="note">* 显示在源代码中的 description</font></div></li>	 
					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">信息列表标题:<br>title</span> <div class="sdiv"><input type="text" name="tag_n_title" id="tag_n_title" value="<?php echo $row['tag_n_title'];?>" class="ant_input25">  <br><font class="note">* 显示在标题栏上</font></div></li>
						<li><span class="aspn">信息列表关键词:<br>meta keywords</span> <div class="sdiv"><input type="text" name="tag_n_key" id="tag_n_key" value="<?php echo $row['tag_n_key'];?>" class="ant_input25">  <br><font class="note">* 显示在源代码中的 keywords</font></div></li>
						<li><span class="aspn">信息列表关描述:<br>meta description</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_n_des" id="tag_n_des"><?php echo $row['tag_n_des'];?></textarea> <br><font class="note">* 显示在源代码中的 description</font></div></li>	 
					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">头部宣传语:</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_t_adv" id="tag_t_adv"><?php echo $row['tag_t_adv'];?></textarea>  <br><font class="note">显示在页面订部位置</font></div></li>
						<li><span class="aspn">服务信息:</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_service" id="tag_service"><?php echo $row['tag_service'];?></textarea>  <br><font class="note"> 这个功能需要看模版需求,不一定每个模版都有用到</font></div></li>
 						<li><span class="aspn">首页关于我们:</span> <div class="sdiv"><textarea class="ant_textarea" name="tag_h_about" id="tag_h_about"><?php echo $row['tag_h_about'];?></textarea>  <br><font class="note"> 这个功能需要看模版需求,不一定每个模版都有用到</font></div></li>
 						<li><span class="aspn">联系我们:</span> <div class="sdiv"><textarea class="ant_textarea" name="contents" id="contents" style="width:98%;height:300px;visibility:hidden;"><?php echo $row['contents'];?></textarea>  <br><font class="note">联系我们内容设置</font></div></li> 												

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><?php if($ade=="Edit"){?><input type="hidden" name="ID" value="<?php echo $row['ID']?>"><?php }else{ echo '<input type="hidden" name="languageID" value="'.$lgid.'">';}?><input type="submit" class="an_submit trans" value="保存" onclick="return datas('tag_h_title,tag_h_key,tag_h_des','<?php echo $ade;?>','seo','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>