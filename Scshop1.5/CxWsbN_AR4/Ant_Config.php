<?php
//语种ID
if(isset($_COOKIES['AntLanguage'])){
	$lgid=$_COOKIES['AntLanguage'];
}else{
    $lgid=1;	
}
$page_nums=20;
//生成验证码
$itemnb=date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
//获取当前文件名
$FileSelf = substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/")+1);
//支付方式
$paymethod= array('请选择' =>'','Paypal' =>1 ,'Western Union' =>2);
//轮播位置
$bannerlocation= array('请选择' =>'','首页横幅' =>'1' ,'页面左侧' =>'2','首页中部' =>'3');
//邮件模板
$emailtemplate= array('请选择' =>'','注册' =>'1','订阅' =>'2','下单' =>'3','发货' =>'4','密码找回' =>'5','其它' =>'6');
//后台目录分类
$mulu=array('请选择' =>'','综合管理'=>'1','产品管理'=>'2','信息管理'=>'3','商城管理'=>'4','销售管理'=>'5','数据分析'=>'6');
