<?php
require "../inc/config.php";
require "../inc/function.class.php";
require "../inc/pagenaven.class.php";


//公司产品
if(!isset($_GET[pdir1]) || $_GET[pdir1]==''){

  $arrParam[0][name]="pdir1";
  $arrParam[0][value]=$_GET[pdir1];

$intRows = 6;
$strSQLNum = "SELECT COUNT(*) as num from productinfo as a 
		  left join productdir as c on a.id_proddir=c.id_proddir
		  where a.dele='1' and c.lang='1' ";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.title,a.intro,a.content,a.id_prodinfo,a.price,a.buynum,a.id_proddir,a.ordernum,c.fatherid from productinfo as a 
		  left join productdir as c on a.id_proddir=c.id_proddir
		  where a.dele='1' and c.lang='1' order by a.ordernum desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrprods=$objDB->GetRows();

}elseif(isset($_GET[pdir1]) && !isset($_GET[pdir2])){
  $arrParam[0][name]="pdir1";
  $arrParam[0][value]=$_GET[pdir1];
$intRows = 6;
$strSQLNum = "SELECT COUNT(*) as num from productinfo as a 
		   left join productdir as c on a.id_proddir=c.id_proddir
		   where c.fatherid='".$_GET[pdir1]."' and a.dele=1 and c.lang='1'";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "select a.title,a.intro,a.content,a.id_prodinfo,a.price,a.buynum,a.id_proddir,a.ordernum,c.fatherid from productinfo as a 
		   left join productdir as c on a.id_proddir=c.id_proddir
		   where c.fatherid='".$_GET[pdir1]."' and a.dele=1 and c.lang='1' order by a.ordernum desc" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrprods=$objDB->GetRows();

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

<? require "header.php"; ?>
<!--
<div id="mainadv">
<? // require "mainadv.php"; ?>
</div><!--end mainadv!-->

<div id="maincontent">
<div id="mainc_left">
<? require "leftadv.php"; ?>

<? if(!isset($_SESSION["UserID"])){?>
<div style="position: relative; margin-top:20px;margin-left:15px;width:209px;height:178px;border: 10px solid #D9D9D9; text-align:left ">
<div id="picmenu"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <form method=post  name="reg" action="/en/member/login.php?act=login">
                          <tr>
                            <td height="30" colspan="3" align="left" valign="middle" class="txt">&nbsp;&nbsp;ChinaTealand Centre</td>
                          </tr>
                          <tr>
                            <td height="1" colspan="3" style="padding:0; height:1px;"  bgcolor="#CCCCCC" class="txt"></td>
                          </tr>
                          
                          <tr>
                            <td width="61" height="60" rowspan="4" align="center" valign="top"><img src="/inc/pics/user_bg.gif" width="49" height="50" style="margin-top:5px;" /></td>
                            <td width="62" height="28" align="right" class="txt2">Email：</td>
                            <td width="93" height="28" align="left"><input name="UserName" type="text" id="UserName" style="width:82px;" /></td>
                          </tr>
                          <tr>
                            <td height="28" align="right" class="txt2">PW：</td>
                            <td height="28" colspan="2" align="left"><input name="password" type="password" id="password" style="width:82px;" /></td>
                          </tr>
                          <tr>
                            <td height="28" align="right" class="txt2">PIN：</td>
                            <td height="28" colspan="2" align="left"><table width="100%" border="0">
                            <tr>
                                  <td align="left"><input name="number" type="password" id="number" style="width:30px;" /></td>
                                  <td><img src=member/chnum.class.php /></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="30" align="left">&nbsp;</td>
                            <td height="30" align="left"><input type="image" name="imageField2" src="/inc/pics/btn_loginen.jpg" style="border:0px none; background:none;" /></td>
                            <td height="30" align="left">&nbsp;</td>
                          </tr>
                          
                        </form>
                    </table>
</div>
<div id="txtmenu" style="position: absolute; z-index:2;top:150px;width:100%;height:28px; line-height:28px; background-color:#000; text-align:right;filter:alpha(opacity=60); opacity:0.6; color:#FFFFFF;font-size: 12px;"><a href="/member/reg.php">● Registration</a>&nbsp;&nbsp;<a href="/member/login.php">● Log in</a>&nbsp;&nbsp;</div>
</div>
<? }?>

<? require "leftadvdown.php"; ?>
</div><!--end mainc_left!-->
<div id="mainc_right">

<?php for($i=0;$i<sizeof($arrprods);$i++){
  $strSQL = "select opicname as pic from productpic  where id_prodinfo ='".$arrprods[$i][id_prodinfo]."' order by id_prodpic asc limit 1" ;
  $objDB->Execute($strSQL);
  $arronepic=$objDB->fields();
?>
<div id="mainc_rightbox">
<div id="mainc_rightboxl"><img src="/upload/product/<?=$arronepic[pic];?>" width="210" height="196" /></div>
<div id="mainc_rightboxr">
<div id="mainc_rightboxrtop">
<div id="mainc_rightboxrtoptitle">
<h1><?=$arrprods[$i][title];?></h1>
<p><?=cutstr($arrprods[$i][intro],300,1);?></p>
</div>
<div id="mainc_rightboxrtopmore" style="margin-top:10px;"><a href="productsinfo.php?pid=<?=$arrprods[$i][id_prodinfo];?>&pdir1=<?=$arrprods[$i][fatherid];?>"><img src="/inc/pics/detailen.jpg" /></a></div>
</div>
<div id="mainc_rightboxrend">
<div id="mainc_rightboxrendtitle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%"><img src="/inc/pics/priceen.jpg" /></td>
    <td width="28%" align="left" class="txt_black2">$ <?=$arrprods[$i][price];?></td>
    <td width="27%"><img src="/inc/pics/buyrecen.jpg" /></td>
    <td width="18%" align="left" class="txt_black2"><?=$arrprods[$i][buynum];?></td>
  </tr>
</table>

</div>
<div id="mainc_rightboxrendmore"><a href="/en/cart/cart.php?pid=<?=$arrprods[$i][id_prodinfo];?>&pdir1=<?=$arrprods[$i][fatherid];?>"><img src="/inc/pics/buyen.jpg" /></a></div>
</div>
</div><!--end mainc_rightboxr!-->
</div><!--end mainc_rightbox!-->
<?php }?>
<div style="text-align:center;"><?php echo $strNavigate;?></div>
</div><!--end mainc_right!-->

<? require "partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "footer.php"; ?>

</body>
</html>
