<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_freeship";
?>

<body>
<script language="javascript" src="Js/TimeSelect.js"></script>
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> -  运费方式设置 </span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>

<?php

$row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=1"));

?>
 
<div class="ant">
		<div class="ant_title">运费方式设置<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
 
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>
						<li><span class="aspn">运费方式选择:</span> <div class="sdiv">
							 <input name="free_flag" type="radio"  onclick="Frees(1);" value="1" <?php if($row['free_flag']=="1"){echo 'checked="checked"';};?> > 不开通免运费功能 
							 <input name="free_flag" type="radio"   onclick="Frees(2);" value="2"  <?php if($row['free_flag']=="2"){echo 'checked="checked"';};?> > 全场运费固定设置 
							 <input name="free_flag" type="radio"   onclick="Frees(3);" value="3"  <?php if($row['free_flag']=="3"){echo 'checked="checked"';};?> > 统一设置所有地区最低消费额 
							 <input name="free_flag" type="radio" onclick="Frees(4);" value="4"  <?php if($row['free_flag']=="4"){echo 'checked="checked"';};?> >  按地区设置最低消费额  <br><font class="note">* 根据情况选择设定运费方式</font>
						</div></li>
						<li <?php if($row['free_flag']=="2" || $row['free_flag']=="3"){echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?> id="freeot"><span class="aspn">设定金额:</span> <div class="sdiv"> <input type="text" onblur="value=value.replace(/[^\d\.]/g,'')" name="free_price" id="free_price" value="<?php echo $row['free_price'];?>"  class="ant_input26"> <br><font class="note">* 输入数字 </font></div></li>
						<li <?php if($row['free_flag']=="4"){echo 'style="display:block;"';}else{echo 'style="display:none;"';} ?>  id="freef"><span class="aspn">区域设定:<br><font class="note">* 输入数字,0为不限制; </font></span> <div class="sdiv">
                           
							<p id="ctys_2"> <?php echo Country("3","",$db_conn)?></p> </div></li>					  			
					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"><input type="hidden" name="ID" value="1"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('free_price','Edit','freeship','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>

 
 <div style="clear:both"></div>
<div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 