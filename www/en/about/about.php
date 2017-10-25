<?php
require "../../inc/config.php";

//关于我们
$strSQL = "select title,content from pageset where id_pageset='$_GET[pageid]'" ;
$objDB->Execute($strSQL);
$aboutus=$objDB->fields();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $setinfo[keywords];?>" />
<meta name="description" content="<?php echo $setinfo[description];?>" />
<title><?php echo $setinfo[title];?></title>
<link href="/inc/css/css2.css" rel="stylesheet" type="text/css">
<script src="/inc/js/jquery.min.js"></script>
<script src="/inc/js/changepic.js"></script>
</head>
<body>

<? require "../header.php"; ?>

<!--<div id="mainadv">

<? require "../mainadv.php"; ?>

</div>end mainadv!-->

<div id="maincontent">
<div id="mainc_left">
<? require "../leftadv.php"; ?>
</div><!--end mainc_left!-->
<div id="about_content">
<div id="about_contentbox">
<h1><?=$aboutus[title];?></h1>
<p><?=$aboutus[content];?></p>
</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<? require "../partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
