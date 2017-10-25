<?php
require "../../inc/config.php";

require "../../inc/pagenaven.class.php";


//新闻动态
if(!isset($_GET[ndir]) || $_GET[ndir]==''){
$intRows = 26;
$strSQLNum = "SELECT COUNT(*) as num from newsinfo as a left join newsdir as b on a.id_newsdir=b.id_newsdir where a.dele=1 and b.lang='1'";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.*,b.fatherid,b.lang from newsinfo as a left join newsdir as b on a.id_newsdir=b.id_newsdir where a.dele=1  and b.lang='1' order by a.id_newsinfo desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrnews=$objDB->GetRows();

}elseif(isset($_GET[ndir])){

$intRows = 26;
$strSQLNum = "SELECT COUNT(*) as num from newsinfo  where id_newsdir='".$_GET[ndir]."'  and dele=1";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select * from newsinfo  where id_newsdir='".$_GET[ndir]."' and dele=1  order by id_newsinfo desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrnews=$objDB->GetRows();
}

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



<div id="maincontent">
<div id="mainc_left">
<? require "../leftadv.php"; ?>
</div><!--end mainc_left!-->
<div id="news_content">
<div id="news_contentbox">
<div id="allnews">
  <ul>
  <?php for($i=0;$i<sizeof($arrnews);$i++){?>
    <li><span><?=$arrnews[$i][newsdate];?></span><a href="newspage.php?newsid=<?=$arrnews[$i][id_newsinfo];?>" class="link_navi"><?=$arrnews[$i][title];?></a></li>
  <?php }?>
  </ul>
</div><!--end allnews!-->
<div id="allnewsnavi"><?php echo $strNavigate;?></div>
</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<? require "../partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
