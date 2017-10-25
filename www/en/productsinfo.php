<?php
require "../inc/config.php";
require "../inc/function.class.php";


// 产品信息
$strSQL = "select title,content,id_prodinfo from productinfo where id_prodinfo='".$_GET[pid]."' and dele='1'" ;
$objDB->Execute($strSQL);
$pdts_info=$objDB->fields();



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

<? require "header.php"; ?>

<!--<div id="mainadv">

<? require "mainadv.php"; ?>

</div>end mainadv!-->

<div id="maincontent">
<div id="mainc_left">
<? require "leftadv.php"; ?>
</div><!--end mainc_left!-->
<div id="mainc_right">

<div id="mainc_right_title"><?=$pdts_info[title];?></div>
<div id="mainc_right_content"><?=$pdts_info[content];?></div>
<div id="mainc_rightboxbuy"><a href="/en/cart/cart.php?pid=<?=$_GET[pid];?>&pdir1=<?=$_GET[pdir1];?>"><img src="/inc/pics/buyen2.jpg" /></a></div>
</div><!--end mainc_right!-->
<? require "partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "footer.php"; ?>

</body>
</html>
