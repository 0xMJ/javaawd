<?php include_once 'Ant_head.php';?>
 
<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 模版管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>

 
<div class="ant">
		<div class="ant_title">模版管理</div>
        <div class="cb"></div>
		<div class="ant_cat">
 
		 
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">
				   <table class="table" cellpadding="0" cellspacing="0">
			  		<tr><th>序号</th><th>图片</th><th>模版名称</th><th>是否当前模版</th><th>操作</th></tr>
						 <?php
						 TemplateDir("../Template/",CheckConfig($db_conn,"web_Template"));
						 ?>
			      </table>
				</div>

		    </div>

 
		</div>

</div>

 <div style="clear:both"></div>
 <div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>


 