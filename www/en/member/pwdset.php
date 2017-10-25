<?php
require "../../inc/config.php";

if(!isset($_SESSION[UserID])){//如果没登陆
	header('Location:/index.php');ob_end_flush();exit();
}

if(isset($_GET["act"]) && $_GET["act"]=="set"){

	
	
$strSQL="UPDATE member SET 	password='".$_POST["newpass"]."' where id_member='".$_SESSION["UserID"]."' and password='".$_POST["oldpass"]."'";
$objDB->Execute($strSQL);
$err_code="1";



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
<script language=javascript>
function CheckForm(tar){

if(tar.oldpass.value==""){
alert("The old password can not be empty!");
tar.oldpass.focus();
return false;
}

if(tar.newpass.value==""){
alert("The new password can not be empty!");
tar.newpass.focus();
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
            <td height="30" align="left" valign="middle"><img src="/inc/pics/qdhz.jpg" width="721" height="166" /></td>
          </tr>
          <tr>
            <td height="30" align="left" valign="middle"><h1>Member Center</h1></td>
          </tr>
          <tr>
            <td height="50" align="left" valign="middle">Welcome to our website, your contact Los way in this setting.</td>
          </tr>
        </table>
          <? if(!isset($_GET["act"])){?>
      <div id="mem_boder_02">
            <form action="pwdset.php?act=set" method=post  name="reg" onSubmit="return CheckForm(this);" >
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
            <tr>
              <td colspan="2" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td width="12%" height="20" align="right" valign="top">Old Password 
              *：</td>
              <td><input name="oldpass" type="text" class="input_01" id="name"  size="20" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">New password *：</td>
              <td><input name="newpass" type="text" class="input_01" id="tel2"  size="20"  /></td>
            </tr>
            
            <tr>
              <td height="20" align="right" valign="top">&nbsp;</td>
              <td height="20" align="left" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="button" type="submit" id="button" value="Done" /></td>
            </tr>
          </table>
</form>
              </div>  
           <? }elseif(isset($_GET["act"])&&$err_code=="1"){?>
           
                       <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="center" valign="middle"><span class="link_navi_red">Your changes have been submitted!<meta http-equiv="refresh" content="5;url=/en/member/pwdset.php"></span>
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
