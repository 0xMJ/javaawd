<?php include_once 'Ant_Inc.php';
  $Qanxian=CheckUser($db_conn,"checkPage",$FileSelf);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../Core/Js/jquery-1.7.2.min.js"></script>
	<script language="javascript" src="Js/Ant.js"></script>
	<script language="javascript" src="Js/jquery-ui.js"></script>
	<link rel="stylesheet" href="Css/Ant.css">
	<link rel="stylesheet" href="../Core/Css/font-awesome-47/css/font-awesome.min.css">
	<link rel="stylesheet" href="../Core/Edit/themes/default/default.css" />
  	<link rel="stylesheet" href="../Core/Edit/plugins/code/prettify.css" />
  	<script charset="utf-8" src="../Core/Edit/kindeditor.js"></script>
  	<script charset="utf-8" src="../Core/Edit/lang/zh_CN.js"></script>
  	<script charset="utf-8" src="../Core/Edit/plugins/code/prettify.js"></script>
	<script>
    KindEditor.options.filterMode = false;
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="contents"]', {
				uploadJson : '../Core/Edit/php/upload_json.php',
				fileManagerJson : '../Core/Edit/php/file_manager_json.php?immenu=catalog',
				allowFileManager : true,
				afterBlur:function () { this.sync();}
			});
			prettyPrint();
		});
	    $(function() {
	    $( "#showimage" ).sortable();
	    $( "#showimage" ).disableSelection();
	    });

 
	</script>
</head>