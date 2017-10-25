<?php
require "../../inc/config.php";

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
<link href="/inc/css/css2.css" rel="stylesheet" type="text/css">
<script src="/inc/js/jquery.min.js"></script>
<script src="/inc/js/changepic.js"></script>
<script language=javascript>
function CheckForm(tar){

if(tar.name.value==""){
alert("Name can not be empty!");
tar.name.focus();
return false;
}

if(tar.mobi.value==""){
alert("Phone number can not be empty!");
tar.mobi.focus();
return false;
}

if(tar.tel.value==""){
alert("The phone can not be empty!");
tar.tel.focus();
return false;
}

if(tar.addr.value==""){
alert("Address can not be empty!");
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
            <form action="memberset.php?act=set" method=post  name="reg" onSubmit="return CheckForm(this);" >
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
            <tr>
              <td colspan="2" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td width="12%" height="20" align="right" valign="top">Name 
              *：</td>
              <td><input name="name" type="text" class="input_01" id="name" value="<?=$memberinfo[name];?>" size="20" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Mobi *：</td>
              <td><input name="mobi" type="text" class="input_01" id="tel2"  value="<?=$memberinfo[mobi];?>" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Tel 
              *：</td>
              <td><input name="tel" type="text" class="input_01" id="tel"  value="<?=$memberinfo[tel];?>" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Addr *：</td>
              <td><input name="addr" type="text" class="input_01" id="addr" size="50"  value="<?=$memberinfo[address];?>" /></td>
            </tr>
            
            <tr>
              <td height="20" align="right" valign="top">&nbsp;</td>
              <td height="20" align="left" valign="top"><a href="/en/member/pwdset.php">Password change</a></td>
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
                <td height="200" align="center" valign="middle"><span class="link_navi_red">Successfully modified！<meta http-equiv="refresh" content="5;url=/en/member/memberset.php"></span>
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
