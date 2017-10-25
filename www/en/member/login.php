<?php
require "../../inc/config.php";

if(isset($_GET[ref])){$_SESSION["ref"]=$_GET[ref];}

if(isset($_GET[act]) && $_GET[act]=="login"){
$number=$_POST["number"];
$login_check_num=$_SESSION[login_check_num];
$username=$_POST["UserName"];
$password=$_POST["password"];
if ($username=="")
{
    
   $str_msg="The user name can not be empty!<meta http-equiv='refresh' content='4;url=./login.php'>";
   if(isset($_SESSION["ref"])){$str_msg="The user name can not be empty!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
}
else {
        if ($password=="")
       {
       $str_msg="The password can not be empty!<meta http-equiv='refresh' content='4;url=./login.php'>";
	    if(isset($_SESSION["ref"])){$str_msg="The password can not be empty!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
        }
        else {
		     if ($number=="")
                {
                $str_msg="Verification code can not be empty!<meta http-equiv='refresh' content='4;url=./login.php'>";
				if(isset($_SESSION["ref"])){$str_msg="Verification code can not be empty!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
                }
                else {
				      if($number != $login_check_num || $number == "")
                        {
                        $str_msg="Incorrect verification code!<meta http-equiv='refresh' content='4;url=./login.php'>";
						if(isset($_SESSION["ref"])){$str_msg="Incorrect verification code!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
                        } 
                        else{
    $strSQL="select id_member,name,hrcode as onlyid,iswork from member where user='".$_POST["UserName"]."' and password='".$_POST["password"]."'";
	$objDB->Execute($strSQL);
	$arrMember=$objDB->fields();
	if(count($arrMember)!='1' && $arrMember["user"]=='admin'){
		$str_msg="Member under review, please be patient!<meta http-equiv='refresh' content='2;url=./login.php'>";	
	}else{//会员名不为admin时
	
		if(count($arrMember)!='1'){
			$_SESSION["UserID"]=$arrMember["id_member"];
			$_SESSION["UserName"]=$arrMember["name"];
			$_SESSION["onlyid"]=$arrMember["onlyid"];
			$_SESSION["iswork"]=$arrMember["iswork"];//会员等级 1普通 2高级
			
			$strSQL="update member set logindate=now() where id_member='".$arrMember["id_member"]."'";
			$objDB->Execute($strSQL);
	
			
	        $str_msg="Login is successful, Welcome!'".$_SESSION["UserName"]."'!<meta http-equiv='refresh' content='1;url=../index.php'>";
			if(isset($_SESSION["ref"])){$str_msg="Login is successful, Welcome!".$_SESSION["UserName"]."'!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
	    
		  
		}else{
			$str_msg="User name or password error, please re-login!<meta http-equiv='refresh' content='4;url=./login.php'>";
			if(isset($_SESSION["ref"])){$str_msg="User name or password error, please re-login!<meta http-equiv='refresh' content='4;url=/en/cart/".$_SESSION["ref"]."'>";}
		}
		
		
	}
	}
	}
	}
	}
}




if(isset($_GET[act]) && $_GET[act]=="out"){
	session_unregister(UserID);
	session_unregister(UserName);
	session_unregister(onlyid);
	session_unregister(iswork);
	if(isset($_SESSION["payzhekou"])){session_unregister(payzhekou);}
	$str_msg="You have successfully quit the management system...<meta http-equiv='refresh' content='1;url=/en/'>";
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
            <td height="50" align="left" valign="middle" class="txt">If you are already a member, please Login</td>
        </tr>
        </table>
         <? if($_GET[act]==""){ ?> 
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
           <form action="login.php?act=login" method=post  name="reg" onSubmit="return CheckForm(this);" >
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td width="17%" height="20" align="right" valign="top">Email：</td>
              <td colspan="2"><input name="UserName" type="text" class="input_01" id="textfield" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Password：</td>
              <td colspan="2"><input name="password" type="password" class="input_01" id="textfield2" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">PIN：</td>
              <td width="10%"><input name="number" type="text" class="input_01" id="textfield3" size="10" /></td>
              <td width="73%"><img src=chnum.class.php></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><input name="button" type="submit" id="button" value="Sign in now" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"> If you forget your password, registered mailbox to send mail to chinataeland@hotmail.com, we will receive a message back to you, thank you! </td>
            </tr>
            </form>
          </table>
          <?	}else{?>
             <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td height="150" align="left" valign="middle"><span  class="link_navi_red"><? echo $str_msg; ?></span></td>
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
