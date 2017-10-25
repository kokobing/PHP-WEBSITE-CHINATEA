<?php
require "../inc/config.php";

//新闻内容
$strSQL = "select * from newsinfo where id_newsinfo='".$_GET[newsid]."'  " ;
$objDB->Execute($strSQL);
$onenews=$objDB->fields();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $setinfo[keywords];?>" />
<meta name="description" content="<?php echo $setinfo[description];?>" />
<title><?php echo $setinfo[title];?></title>
<link href="../inc/css/css1.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.min.js"></script>
<script src="../inc/js/changepic.js"></script>
</head>
<body>

<? require "../header.php"; ?>



<div id="maincontent">
<div id="mainc_left">
<? require "../leftadv.php"; ?>
</div><!--end mainc_left!-->
<div id="news_content">
<div id="news_contentbox">
<?=$onenews[content];?>
</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<? require "../partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
