<?php include_once 'Ant_head.php';?>
<?php 
$table="sc_user";
$FileSelf=$FileSelf."?lgid=".$lgid;

function Mulu_Fenpei($mulu,$db_conn,$id){

				$i=0;$str="";
				foreach ($mulu as $key => $value) {
				
					if ($i>0){
					    $query=$db_conn->query("select * from sc_mulu where ml_id=$value order by ml_paixu,ID asc");
					    while($row=mysqli_fetch_array($query)){

					     if (!empty($id)){
						   if(strpos($id,",".$row['ID'].",") !== false){ 
							 	$cked="checked"; 
							}else{
							 	$cked=""; 
							}
                           }else{
                           	$cked="checked";
                           }
					      $str.= '<dd><input type="checkbox" name="user_qx[]" value="'.$row['ID'].'" '.$cked.' > '.$row['ml_name'].'</dd>';
					    } 
					    echo '<ol><dd><b>'.$key.'</b></dd>'.$str.'</ol>';
					    $str="";
					}

				$i=$i+1;
				}

}
?>

<body>
 
<div class="rigtan"><span class="rft an_1 trans" onclick="javascript:history.go(-1);"><i class="fa fa-reply" aria-hidden="true"></i> 返回</span> <span class="rft an_1 trans" onclick="javascript:location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> 刷新</span></div>
<div class="ant"><div class="topdiv"><span class="lft"><i class="fa fa-home" aria-hidden="true"></i> <a href='Ant_mid.php'>首页</a> - 用户管理</span> </div>

		<div class="cb"></div>
		<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span></div>
		<div class="errshow"><i class="fa fa-window-close" aria-hidden="true"></i><br><span></span> </div>
		<div class="cb"></div>
</div>


<?php if($aed=="a"){
?> 
<div class="ant">
		<div class="ant_title">用户增加<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>

						<li><span class="aspn">账号:</span> <div class="sdiv">
		                 <input type="text" name="user_admin"  class="ant_input25" id="user_admin" ><br><font class="note">* 输入账号,用于后台登陆,账号添加后不可修改</font>
						</div></li>
						<li><span class="aspn">密码:</span> <div class="sdiv">
		                 <input type="password" name="user_ps"  class="ant_input25" id="user_ps" ><br><font class="note">* 输入密码</font>
						</div></li>
						<li><span class="aspn">姓名:</span> <div class="sdiv">
		                 <input type="text" name="user_name"  class="ant_input25" id="user_name" ><br><font class="note">* 输入姓名</font>
						</div></li>						
						<li><span class="aspn">邮箱:</span> <div class="sdiv">
		                 <input type="text" name="user_email"  class="ant_input25" id="user_email" ><br><font class="note">* 用于找回后台密码</font>
						</div></li>
						<li><span class="aspn">电话:</span> <div class="sdiv">
		                 <input type="text" name="user_tel"  class="ant_input25" id="user_tel" ><br><font class="note"> 输入手机号或电话</font>
						</div></li>
						<li><span class="aspn">头像: </span><div class="sdiv"><span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">	 
						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小根据页面需要制作,图片格式支持: jpg,gif,png,bmp</font></div></li>
 
						<li><span class="aspn">权限分配: </span><div class="sdiv"> 
							<?php Mulu_Fenpei($mulu,$db_conn,""); ?>
						 <br class="cb"><font class="note"> 选择相应的版块</font></div></li> 														
 	

					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"> <input type="hidden" name="user_time" value="<?php echo date("Y-m-d H:i:s");?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('user_name,user_admin,user_ps,user_email','Add','users','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else if($aed=="e"){
 $row = mysqli_fetch_array($db_conn->query("SELECT * FROM $table WHERE ID=".$_GET["sortID"]));
 
?>

 <div class="ant">
		<div class="ant_title">用户编辑<font class="cl">（带星*的必填）</font></div>
        <div class="cb"></div>
		<div class="ant_cat">
			<div class="antit">
				<div class="ant_cat_tab ant_cat_tab_select" >基础信息</div>
		    </div>
		    <form method="post" id="form" name="form" action="#">
		    <div class="antcon">
				<div class="ant_cat_c" style="display: block;">

					<ul>

						<li><span class="aspn">账号:</span> <div class="sdiv">
		                 <input type="text" name="user_admin" value="<?php echo $row['user_admin'] ?>" class="ant_input25" id="user_admin" readonly="readonly" ><br><font class="note">* 账号,不可修改</font>
						</div></li>
						<li><span class="aspn">密码:</span> <div class="sdiv">
		                 <input type="password" name="user_ps"  class="ant_input25" id="user_ps" ><br><font class="note">* 输入密码</font>
						</div></li>
						<li><span class="aspn">姓名:</span> <div class="sdiv">
		                 <input type="text" name="user_name" value="<?php echo $row['user_name'] ?>"  class="ant_input25" id="user_name" ><br><font class="note">* 输入姓名</font>
						</div></li>
						<li><span class="aspn">邮箱:</span> <div class="sdiv">
		                 <input type="text" name="user_email"  class="ant_input25" value="<?php echo $row['user_email'] ?>" id="user_email" ><br><font class="note">* 用于找回后台密码</font>
						</div></li>
						<li><span class="aspn">电话:</span> <div class="sdiv">
		                 <input type="text" name="user_tel" value="<?php echo $row['user_tel'] ?>" class="ant_input25" id="user_tel" ><br><font class="note"> 输入手机号或电话</font>
						</div></li>
						<li><span class="aspn">头像: </span><div class="sdiv"><span class="an_submit_up trans" dataname="CAimg"  id="imagebtn"><i class="fa fa-plus" aria-hidden="true"></i></span><div id="showimage" style="display:block;">
	 						<?php
	 						$ant_img=trim($row['ant_img'],",");
							if(!empty($ant_img)){
							$date = date("ymdhis").'_'.rand(100,9999); //
							echo '<span id="Img'.$date.'" >';
							 ?>
							<img src="<?php echo trim($row['ant_img'],",");?>" >
							<?php echo '<input type="hidden" name="ant_img[]" class="ant_input_slow" value="'.trim($row['ant_img'],",").'"><br><a href="javascript:if(confirm(\'确实要删除吗?\')) delImg(\'Img'.$date.'\');">删除</a><br>';?>
							</span>
							<?php }else{
							echo '<img src="Image/User-performance.png" width="50">';
							}?>	 

						</div> <br class="cb"><font class="note"> 图片容量<200K,图片大小根据页面需要制作,图片格式支持: jpg,gif,png,bmp</font></div></li>
 
						<li><span class="aspn">权限分配: </span><div class="sdiv"> 
							<?php Mulu_Fenpei($mulu,$db_conn,$row['user_qx']); ?>
						 <br class="cb"><font class="note"> 选择相应的版块</font></div></li>
					</ul>
				</div>

		    </div>

			<div class="cb"></div>
			<div class="an"> <input type="hidden" name="ID" value="<?php echo $sortID;?>"><input type="hidden" name="user_time" value="<?php echo date("Y-m-d H:i:s");?>"><input type="submit" class="an_submit trans" value="保存" onclick="return datas('user_name,user_admin,user_ps,user_email','Edit','users','<?php echo $lgid;?>','<?php echo $FileSelf;?>','form');"></div>
           </form>
		</div>

</div>


<?php }else{
if (isset($_GET["page"])){$page="&page=".$_GET["page"];}else{$page="";}
$FileSelf=$FileSelf.$page;
?>

<div class="ant">
	<div class="ant_title" style="position: relative;">用户管理<font class="cl">（带星*的必填）</font>
			 <span class="an_submit_up trans" onclick="location.href='?aed=a'"><i class="fa fa-plus" aria-hidden="true"></i> 增加用户</span></div>
	<form method="post" id="pform" action="#">
	<table class="table" cellpadding="1" cellspacing="0">
		<tr><th>ID号</th><th>头像</th><th>姓名</th><th>账号</th> <th>邮箱</th><th>是否停用<i class="fa fa-question-circle-o" aria-hidden="true" title="点击可改变状态"></i></th><th>时间</th><th>操作</th></tr>
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
	 	if($row['user_open']==1){$zof="on";$zt=1;}else{$zof="off";$zt=0;}
	 	 
?>	 
		<tr>
			<td bgcolor="#fafafa"><input type="checkbox" name="DID[]" value="<?php echo $row['ID'];?>" /> <br><?php echo $row['ID'];?></td>
			<td>
				<?php
				$ant_img=trim($row['ant_img'],",");
				if(!empty($ant_img)){
				echo '<img src="'.trim($row['ant_img'],",").'" height="40">';
			    }else{
				echo '<img src="Image/User-performance.png" height="40">';
			    }
			    ?>
			</td>
 
			<td bgcolor="#fafafa"><?php echo $row['user_name'];?></td>
		 
	        <td ><?php echo $row['user_admin'];?></td>
	        <td bgcolor="#fafafa"><?php echo $row['user_email'];?></td>
	        
		<td  ><i onclick="OnOff('OpenOff','<?php echo $row["ID"];?>','users','user_open','<?php echo $zt;?>','zt');" class="fa fa-toggle-on fa-2x <?php echo $zof;?>"  aria-hidden="true" id="'zt<?php echo $row["ID"];?>'" ></i></td>
		<td bgcolor="#fafafa"><?php echo $row['user_time'];?></td>
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
		<input type="submit"  id="submit" value="删除选中" class="an_submit_up trans"  onclick="return chgpro('Ant_Inc.php?action=Clear&sort=users','del','<?php echo $FileSelf;?>');" /></span>
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


 