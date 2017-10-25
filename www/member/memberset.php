<?php
require "../inc/config.php";

if(!isset($_SESSION[UserID])){//如果没登陆
	header('Location:/index.php');ob_end_flush();exit();
}

if(isset($_GET["act"]) && $_GET["act"]=="set"){
		  
		                     $strSQL="UPDATE member SET 
	                         name='".$_POST["name"]."',address='".$_POST["addr"]."',mobi='".$_POST["mobi"]."',
							 tel='".$_POST["tel"]."' where id_member='".$_SESSION["UserID"]."'";
	                         $objDB->Execute($strSQL);
							 $err_code="1";
}

if(isset($_SESSION["UserID"])){
  $strSQL="SELECT name,address,mobi,tel FROM member  where id_member='".$_SESSION["UserID"]."'";
  $objDB->Execute($strSQL);
  $memberinfo=$objDB->fields();
}



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
<script language=javascript>
function CheckForm(tar){

if(tar.name.value==""){
alert("姓名不能为空!");
tar.name.focus();
return false;
}

if(tar.mobi.value==""){
alert("手机号不能为空!");
tar.mobi.focus();
return false;
}

if(tar.tel.value==""){
alert("电话不能为空!");
tar.tel.focus();
return false;
}

if(tar.addr.value==""){
alert("地址不能为空!");
tar.addr.focus();
return false;
}



return true;
}
</script>
</head>
<body>

<? require "../header.php"; ?>



<div id="membercontent">
<div id="member_left">

<? require "leftmenu.php"; ?>

</div>
<!--end mainc_left!-->
<div id="member_content">
<div id="member_contentbox">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
          
          <tr>
            <td height="30" align="left" valign="middle"><img src="../inc/pics/qdhz.jpg" width="721" height="166" /></td>
          </tr>
          <tr>
            <td height="30" align="left" valign="middle"><h1>会员中心</h1></td>
          </tr>
          <tr>
            <td height="50" align="left" valign="middle">欢迎来到我们网站，在此设置您的联洛方式！</td>
          </tr>
        </table>
          <? if(!isset($_GET["act"])){?>
      <div id="mem_boder_02">
            <form action="memberset.php?act=set" method=post  name="reg" onSubmit="return CheckForm(this);" >
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
            <tr>
              <td colspan="2" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td width="12%" height="20" align="right" valign="top">姓名 
              *：</td>
              <td><input name="name" type="text" class="input_01" id="name" value="<?=$memberinfo[name];?>" size="20" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">手机 *：</td>
              <td><input name="mobi" type="text" class="input_01" id="tel2"  value="<?=$memberinfo[mobi];?>" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">电话 
              *：</td>
              <td><input name="tel" type="text" class="input_01" id="tel"  value="<?=$memberinfo[tel];?>" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">地址 *：</td>
              <td><input name="addr" type="text" class="input_01" id="addr" size="50"  value="<?=$memberinfo[address];?>" /></td>
            </tr>
            
            <tr>
              <td height="20" align="right" valign="top">&nbsp;</td>
              <td height="20" align="left" valign="top"><a href="/member/pwdset.php">密码修改</a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="button" type="submit" id="button" value="立即修改" /></td>
            </tr>
          </table>
</form>
              </div>  
           <? }elseif(isset($_GET["act"])&&$err_code=="1"){?>
           
                       <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="center" valign="middle"><span class="link_navi_red">修改成功！<meta http-equiv="refresh" content="5;url=/member/memberset.php"></span>
        </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <? }?>

</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
