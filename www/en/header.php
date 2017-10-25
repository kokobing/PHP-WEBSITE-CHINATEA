<?
// LOGO
$strSQL = "select opicname as pic from  layoutpic  where id_layout='17' " ;
$objDB->Execute($strSQL);
$sy_logo=$objDB->fields();
?>

<div id="header">
<div id="headerlogo"><a href="/en/"><img src="/upload/layout/<?=$sy_logo[pic];?>" border="0" /></a></div>
<div id="headermenubox">
<div id="header_rtop">

<? if(isset($_SESSION["UserName"])){?>
<a href="/en/">Home</a>&nbsp;&nbsp;Welcome <? if($_SESSION[iswork]==1){echo 'Associate Members';}if($_SESSION[iswork]==2){echo 'Full Member';}?>,<a href="/en/member/memberset.php"><?=$_SESSION["UserName"];?></a>&nbsp;&nbsp;<a href="/en/member/login.php?act=out">Exit</a>&nbsp;&nbsp;<a href="/en/cart/cart.php">Shopping cart</a>
<? }else{?>
<a href="/en/">Home</a>&nbsp;&nbsp;<a href="/en/member/reg.php">Join us</a>&nbsp;&nbsp;<a href="/en/member/login.php">Login</a>&nbsp;&nbsp;<a href="/en/cart/cart.php">Shopping cart</a>
<? }?>
&nbsp;&nbsp;<a href="/">中文</a>&nbsp;&nbsp;<a href="/en/">English</a>

</div>
<div id="headermenuen">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5" bgcolor="#9d2a0f">
  <tr>
    <td><a href="/en/about/about.php?pageid=6" class="headermenuen_01">Buyer Privacy Policy</a></td>
    <td><a href="/en/news/news.php" class="headermenuen_01">Knowledge of Tea</a></td>
    <td><a href="/en/about/about.php?pageid=7" class="headermenuen_01">Purchase Protection</a></td>
    <td><a href="/en/about/about.php?pageid=8" class="headermenuen_01">Membership Benefits</a></td>
    <td><a href="/en/about/about.php?pageid=5" class="headermenuen_01">About Us</a></td>
  </tr>
</table>
</div><!--end headermenu!-->

</div><!--end headermenubox!-->
</div><!--end header!-->