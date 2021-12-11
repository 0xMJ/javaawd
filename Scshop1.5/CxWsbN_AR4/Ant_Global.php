<?php include_once 'Ant_head.php';
$table="sc_config";
$row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=1"));
?>
<body>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 全局设置</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>
 
<div class="ant">
		<div class="ant_title">全局设置<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基本参数</div>
				<div class="ant_cat_tab">联系方式</div>
				<div class="ant_cat_tab">邮件参数</div>
				<div class="ant_cat_tab">代码设置</div>
				<div class="ant_cat_tab">其它参数</div>
				<div class="ant_cat_tab">生成地图</div>
		    </div>
		    <form method="post" id="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
					<ul>
						<li><span class="aspn">网站网址:</span> <div class="sdiv"><input type="text" name="web_url" id="web_url" value="<?php echo $row['web_url'];?>" class="ant_input25">  <br><font class="note">* 网站网址</font></div></li>
						<li><span class="aspn">网站名称:</span> <div class="sdiv"><input type="text" name="web_name" id="web_name" value="<?php echo $row['web_name'];?>" class="ant_input25">  <br><font class="note">* 网站名称</font></div></li>


						<li><span class="aspn">LOGO: </span><div class="sdiv"><div id="web_logo"><input type="text" class="ant_input25" value="<?php echo $row['web_logo']?>" name="web_logo"></div> <span class="an_submit_up trans imagebtn" dataname="web_logo" ><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片格式支持: jpg,gif,png,bmp</font></div></li>

						<li><span class="aspn">icon图标: </span><div class="sdiv"><div id="web_ico"><input type="text" class="ant_input25" value="<?php echo $row['web_ico']?>" name="web_ico"></div> <span class="an_submit_up trans imagebtn" dataname="web_ico" ><i class="fa fa-plus" aria-hidden="true"></i></span> <br class="cb"><font class="note"> 图片容量<200K,图片格式支持:ico</font></div></li>
						<li><span class="aspn">网站版权:</span> <div class="sdiv"><textarea class="ant_textarea" name="web_copy" id="web_copy"><?php echo $row['web_copy'];?></textarea> <br><font class="note">* 除填版权外,此处还可以加入网站统计代码</font></div></li>	 

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">网站邮箱:</span> <div class="sdiv"><input type="text" name="web_email" id="web_email" value="<?php echo $row['web_email'];?>" class="ant_input25">  <br><font class="note">如:service@sem-cms.com</font> </div></li>
			 
						<li><span class="aspn">网站电话:</span> <div class="sdiv"><input type="text" name="web_tel" id="web_tel" value="<?php echo $row['web_tel'];?>" class="ant_input25">  <br><font class="note">如:+86 88880000</font> </div></li>
						<li><span class="aspn">商店地址:</span> <div class="sdiv"><input type="text" name="web_add" id="web_add" value="<?php echo $row['web_add'];?>" class="ant_input">  <br><font class="note">如:+86 88880000</font> </div></li>						
						<li><span class="aspn">其它联系:</span> <div class="sdiv"><textarea class="ant_textarea" name="web_otherct" id="web_otherct"><?php echo $row['web_otherct'];?></textarea> <br><font class="note">适用于页面浮动显示联系方式</font> </div></li>						
			 
					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">邮箱账号:</span> <div class="sdiv"> <input type="text" value="<?php echo $row['web_umail'];?>" name="web_umail" id="web_umail" class="ant_input25">  <br><font class="note"> 填入邮箱账号</font></div></li>
 
						<li><span class="aspn">邮箱密码:</span> <div class="sdiv"> <input type="password" value="<?php echo $row['web_pmail'];?>" name="web_pmail" id="web_pmail" class="ant_input25">  <br><font class="note"> 一般是授权码,主要看邮箱运营商的要求</font></div></li>
						<li><span class="aspn">邮箱端口号:</span> <div class="sdiv"> <input type="text" value="<?php echo $row['web_dmail'];?>" name="web_dmail" id="web_dmail" class="ant_input25">  <br><font class="note"> 一般是25,465</font></div></li>
						<li><span class="aspn">邮箱smtp:</span> <div class="sdiv"> <input type="text" value="<?php echo $row['web_smail'];?>" name="web_smail" id="web_smail" class="ant_input25">  <br><font class="note"> 如：smtp.xxx.com</font></div></li>
				        <li><span class="aspn">邮箱地址:</span> <div class="sdiv"> <input type="text" value="<?php echo $row['web_tmail'];?>" name="web_tmail" id="web_tmail" class="ant_input25">  <br><font class="note"> 如:service@sem-cms.com</font></div></li>														<li><span class="aspn">接收地址:</span> <div class="sdiv"> <input type="text" value="<?php echo $row['web_jmail'];?>" name="web_jmail" id="web_jmail" class="ant_input25">  <br><font class="note"> 用于接收询盘的地址,最好跟主邮件不同</font></div></li>	
                        <li><span class="aspn">是否开启:</span> <div class="sdiv"> <i class="fa fa-toggle-on fa-2x <?php if($row['web_mailopen']==1){echo 'on';}else{echo 'off';}?>"  aria-hidden="true" dataid="web_mailopen" id="wdshow"></i> <input type="hidden" value="<?php echo $row['web_mailopen'];?>" name="web_mailopen" id="web_mailopen">   <br><font class="note"> 用于接收询盘的地址,最好跟主邮件不同</font></div></li>						        				

					</ul>
				</div>

				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">google代码:</span> <div class="sdiv"><textarea class="ant_textarea" name="web_google" id="web_google"><?php echo $row['web_google'];?></textarea>  <br><font class="note"> google追踪代码</font></div></li>
 						<li><span class="aspn">社交代码:</span> <div class="sdiv"><textarea class="ant_textarea" name="web_shejiao" id="web_shejiao"><?php echo $row['web_shejiao'];?></textarea>  <br><font class="note"> 自有社交平台代码,可写多个</font></div></li>
						<li><span class="aspn">分享代码:</span> <div class="sdiv"><textarea class="ant_textarea" name="web_share" id="web_share"><?php echo $row['web_share'];?></textarea>  <br><font class="note"> 社交分享代码</font></div></li>

					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
 						<li><span class="aspn">验证标签(meate):</span> <div class="sdiv"><textarea class="ant_textarea" name="web_meate" id="web_meate"><?php echo $row['web_meate'];?></textarea>  <br><font class="note"> 用于外网标签验证</font></div></li> 						
						<li><span class="aspn">是否https:</span> <div class="sdiv">
						<input type="checkbox" onclick="selects('web_https');" id="web_https" <?php if($row['web_https']==1){echo "checked";}?> > <input type="hidden" name="web_https" id="sweb_https" value="<?php echo $row['web_https'];?>" >
						 <br><font class="note"> 绿色代表显示,灰色代表不显示</font></div></li>
 						<li><span class="aspn">区间价格:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_prices'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_prices" class="ant_input26" id="web_prices">  <br><font class="note"> 一般默认 5 就可以,设为 0 前台不显示</font></div></li>
  						<li><span class="aspn">产品列表数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_plist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_plist" class="ant_input26" id="web_plist">  <br><font class="note"> 前台列表页,一页显示个数控制</font></div></li>
 						<li><span class="aspn">信息列表数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_nlist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_nlist" class="ant_input26" id="web_nlist">  <br><font class="note"> 前台列表页,一页显示个数控制</font></div></li>
 						<li><span class="aspn">推荐产品数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_iflist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_iflist" class="ant_input26" id="web_iflist">  <br><font class="note"> 前台页面个数控制</font></div></li>
 						<li><span class="aspn">新产品数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_inlist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_inlist" class="ant_input26" id="web_inlist">  <br><font class="note"> 前台页面个数控制</font></div></li>

  						<li><span class="aspn">折扣产品数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_itlist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_itlist" class="ant_input26" id="web_itlist">  <br><font class="note"> 前台页面个数控制</font></div></li>	 <li><span class="aspn">人气产品数量:</span> <div class="sdiv"><input type="text" value="<?php echo $row['web_irlist'];?>" onblur="value=value.replace(/[^\d.]/g,'')" name="web_irlist" class="ant_input26" id="web_irlist">  <br><font class="note"> 前台页面个数控制</font></div></li>


					</ul>
				</div>
				<div class="ant_cat_c" >
					<ul>
						<li><span class="aspn">生成地图:</span> <div class="sdiv"><br><span onclick="Gsitemap();" class="an_submit trans">点击生成Google SiteMap</span><br><font class="note">生成存放路径为 当前域名下的 /Images/sitemap.txt</font><br></div></li>
 			 
					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="1"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('web_url','Edit','Globals','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>

 
<div class="antask"></div>
<div class="antess">
	<div class="antitle">文件 <span class="cls"><i class="fa fa-times" aria-hidden="true"></i></span></div>
	<form id="UpFile" onsubmit="return false"  action="#" method="post" enctype="multipart/form-data">
    <div class="imgcontent" >
    	
    	<ul>
    		<li><label class="labal">自定文件名：</label><input type="text" name="imgname" id="imgname" class="imginput" onblur="value=value.replace(/[^\d\w-]/g,'')"><br></li>
    		<li class="cl">可不填,填写格式 a-b-c-d 词之间用-链接,不能有空格,不能有重名,只能数字与字母</li>
    		<li><label class="labal">上传文件：</label><input type="text" name="imgurl" id="imgurl" class="imginput" readonly><span class="uploads">浏览..<input type="file" id="file"> </span></li>
    		<li id="viewImg" class="viewImg"></li><span id="imgval"></span><li>  <span class="cls">取消</span><span class="ops">确定</span><input type="hidden" name="doument" value="Globals"><input type="hidden" name="save_url" value="../Images/other/"></li>
    	</ul>
       

    </div>
    </form>
</div>
<div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div> 
</body>
</html>