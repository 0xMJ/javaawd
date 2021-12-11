<?php include_once 'Ant_Inc.php';
$Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="../Core/Js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="Css/Ant.css">
	<link rel="stylesheet" href="../Core/Css/font-awesome-47/css/font-awesome.min.css">
</head>

<body class="ant_mid">

	<div class="yesshow"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br><span></span> </div>
	<div class="ant_mid_c">
		<div class="ant_mid_c_1 ">
			<div>
			 <ul>
				<li><i class="fa fa-user-o" aria-hidden="true"></i> 最新会员 <span onclick="location.href='Ant_M_Member.php';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
 				<?php echo ListNewUser($db_conn);?>
			  </ul>
		  </div>
			<div>
			 <ul>
				<li><i class="fa fa-shopping-basket" aria-hidden="true"></i> 最新订单 <span onclick="location.href='Ant_M_Order.php';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
 				<?php echo ListNewOrder($db_conn);?>
			  </ul>
		  </div>
			<div>
			 <ul>
				<li><i class="fa fa-envelope-o" aria-hidden="true"></i> 最新订阅 <span onclick="location.href='Ant_Email.php';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
				<?php echo ListNewEail($db_conn);?>
			  </ul>
		  </div>
			<div>
			 <ul>
				<li><i class="fa fa-comments" aria-hidden="true"></i> 最新评论 <span onclick="location.href='Ant_Message.php?type=p';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
				<?php echo ListNewReviews($db_conn);?>
			  </ul>
		  </div>			  
			<div>
			 <ul>
				<li><i class="fa fa-commenting-o" aria-hidden="true"></i> 最新留言 <span onclick="location.href='Ant_Message.php?type=m';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
				<?php echo ListNewMsg($db_conn);?>
			  </ul>
		  </div>
 
			<div>
			 <ul>
				<li><i class="fa fa-volume-up" aria-hidden="true"></i> 最新消息 <span onclick="location.href='https://www.sem-cms.cn/wenda/wd-1/';"><i class="fa fa-plus" aria-hidden="true"></i></span></li>	
                 <iframe src="https://www.sem-cms.cn/sq/?flag=new"></iframe>
			  </ul>
		  </div>

		</div>

   <table  class="table" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" ><i class="fa fa-hourglass-end fa-spin" aria-hidden="true"></i> 联系我们 </td>
    </tr> 
    <tr><td>官方网址：</td><td><a href="https://www.sem-cms.cn/"/>https://www.sem-cms.cn/</a> </td> <td>官方交流平台：</td><td><a href="https://www.sem-cms.cn/"/>https://www.sem-cms.cn/</a></td></tr>
        <tr><td>联系QQ： </td><td>QQ:1181698019[黑蚂蚁.阿梁]</td> <td>联系邮件：</td><td><a href="mailto:info@sem-cms.com">info@sem-cms.com</a></td></tr>
        <tr><td>微信公众号： </td><td>sem-cms</td> <td>二维码：<br>扫一扫加关注,及时了解系统更新</td><td><img src="Image/wxgzh.jpg"></td></tr>
  </table>
 
    </div>
    <div style="clear:both"></div>
    <div class="bot"><?php echo $v[1];?> © <?php echo date("Y"); $db_conn -> close();?></div>
</body>
</html>