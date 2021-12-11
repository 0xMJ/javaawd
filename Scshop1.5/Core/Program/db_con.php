<?php
//公元 2020-02-22 下午:5:35 星期六 CopyRight © semcms (QQ:1181698019【黑蚂蚁.阿梁】)
// website:https://www.sem-cms.cn/
ob_start();
ini_set('display_errors','off');
header("Content-type: text/html; charset=utf-8");
$url = "127.0.0.1";//连接数据库的地址
$user = "root"; //账号
$password = "root";//密码
$dbdata="semcms15";//数据库名称
$db_conn = new mysqli();
$db_conn -> connect($url, $user, $password, $dbdata);
$db_conn -> set_charset('utf8');
if ($db_conn -> connect_errno){
    printf("Connect failed: %s\n", $db_conn->connect_error);
    exit();
}

  