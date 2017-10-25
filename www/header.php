<?
// LOGO
$strSQL = "select opicname as pic from  layoutpic  where id_layout='8' " ;
$objDB->Execute($strSQL);
$sy_logo=$objDB->fields();
?>

<div id="header">
<div id="headerlogo"><a href="/"><img src="/upload/layout/<?=$sy_logo[pic];?>" border="0" /></a></div>
<div id="headermenubox">
<div id="header_rtop">

<? if(isset($_SESSION["UserName"])){?>
<a href="/">首页</a>&nbsp;&nbsp;欢迎您<? if($_SESSION[iswork]==1){echo '预备会员';}if($_SESSION[iswork]==2){echo '正式会员';}?>,<a href="/member/memberset.php"><?=$_SESSION["UserName"];?></a>&nbsp;&nbsp;<a href="/member/login.php?act=out">退出登陆</a>&nbsp;&nbsp;<a href="/cart/cart.php">购物车</a>
<? }else{?>
<a href="/">首页</a>&nbsp;&nbsp;<a href="/member/reg.php">加入我们</a>&nbsp;&nbsp;<a href="/member/login.php">登陆网站</a>&nbsp;&nbsp;<a href="/cart/cart.php">购物车</a>
<? }?>
&nbsp;&nbsp;<a href="/">中文</a>&nbsp;&nbsp;<a href="/en/">English</a>

</div>
<div id="headermenu">
<ul>
<li><a href="/">网站首页</a></li>
<li><a href="/about/about.php?pageid=2">买家必读</a></li>
<li><a href="/news/news.php">茶叶知识</a></li>
<li><a href="/about/about.php?pageid=3">购物保障</a></li>
<li><a href="/about/about.php?pageid=4">会员优惠</a></li>
<li><a href="/about/about.php?pageid=1">关于我们</a></li>
</ul>
</div><!--end headermenu!-->

</div><!--end headermenubox!-->
</div><!--end header!-->