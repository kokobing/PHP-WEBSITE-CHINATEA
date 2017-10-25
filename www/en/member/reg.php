<?php
require "../../inc/config.php";

if(isset($_GET["act"]) && $_GET["act"]=="reg"){

$err_code="1";//错误码初始1

if(trim($_POST["user"])==""){
          $return_info="Your user name should not be empty!";  
		  $err_code="2";  //错误码2
   }
   
if($_POST["password"]!=$_POST["password2"]){
          $return_info="Incorrect password you submitted twice!";  
		  $err_code="4";  //错误码2
   } 
    

if($err_code=="1"){
$strSQL="select user from member where user='".$_POST["user"]."'";
$objDB->Execute($strSQL);
$isuser=$objDB->GetRows();
$isuser_num=sizeof($isuser);//用户名是否存在

    if($isuser_num > 0){
	      $return_info="You submit the user name already exists!";  
		  $err_code="3";  //错误码0
	  }
}

if($err_code=="1"){
	      $intRand=rand(100000,999999);//随机码
	      $strSQL="INSERT INTO member(user,password,name,address,mobi,indate,hrcode) 
                   values('".$_POST["user"]."','".$_POST["password"]."','".$_POST["name"]."','".$_POST["addr"]."','".$_POST["tel"]."',now(),$intRand)";
		  $objDB->execute($strSQL);
		 // $id=$objDB->getInsertID();//获取插入到数据库记录的ID号
		
		  $return_info="Members have been added successfully";
		  $err_code="1";  //错误码1,表示添加成功
  
	  }


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

if(tar.user.value==""){
alert("The user name can not be empty!");
tar.user.focus();
return false;
}

if(tar.password.value==""){
alert("The password can not be empty!");
tar.password.focus();
return false;
}

if(tar.password.value!=tar.password2.value){
alert("You twice to enter the password is incorrect");
tar.password2.focus();
return false;
}


if (tar.user.value=="" || !tar.user.value.match( /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/ ) ) {
alert("Please enter a valid Email address");
tar.user.focus();
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
            <td height="30" align="left" valign="middle"><h1 class="product_contenttitle">New Member Registration</h1></td>
          </tr>
          <tr>
            <td height="50" align="left" valign="middle" class="txt">Welcome to our website, if you are a new user, please fill out the form below to register</td>
        </tr>
        </table>
          <? if(!isset($_GET["act"])){?>
      <div id="mem_boder_02">
            <form action="reg.php?act=reg" method=post  name="reg" onSubmit="return CheckForm(this);" >
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td width="12%" height="20" align="right" valign="top">E-mail*：</td>
              <td colspan="2"><input name="user" type="text" class="input_01" id="user" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Password* ：</td>
              <td colspan="2"><input name="password" type="password" class="input_01" id="password" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Confirm Password*：</td>
              <td colspan="2"><input name="password2" type="password" class="input_01" id="password2" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Name 
              *：</td>
              <td colspan="2"><input name="name" type="text" class="input_01" id="name" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Address*：</td>
              <td colspan="2"><input name="addr" type="text" class="input_01" id="addr" /></td>
            </tr>
            <tr>
              <td height="20" align="right" valign="top">Tel 
              *：</td>
              <td colspan="2"><input name="tel" type="text" class="input_01" id="tel" /></td>
            </tr>
            
            <tr>
              <td height="20" align="right" valign="top">&nbsp;</td>
              <td width="4%" height="20" align="center" valign="top">
                  <input name="checkbox" type="checkbox" id="checkbox" checked="checked"  readonly="readonly" />             </td>
              <td width="78%">I have read and agree to <a href="/en/member/member3.php" class="m_01">Membership Registration Agreement </a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2"><input name="button" type="submit" id="button" value="Sign up now" /></td>
            </tr>
          </table>
            </form>
              </div>  
           <? }elseif(isset($_GET["act"])&&$err_code=="1"){?>
           
                       <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="left" valign="middle"><span class="link_navi_red">Member added, please login</span>
                  <meta http-equiv="refresh" content="3;url=/en/member/login.php"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
            <? }elseif(isset($_GET["act"])&&$err_code=="3"){?>
            <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="left" valign="middle"><span class="link_navi_red">You submit your user name or mailbox is already registered, please re-register!</span>
                  <meta http-equiv="refresh" content="5;url=/en/member/reg.php"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
      </table>
            <? }elseif(isset($_GET["act"])&&$err_code=="4"){?>
            <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="left" valign="middle"><span class="link_navi_red">You twice the password submitted is incorrect, please re-register!
                  </span>
                  <meta http-equiv="refresh" content="5;url=/en/member/reg.php"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
      </table>
         <? }elseif(isset($_GET["act"])&&$err_code=="2"){?>
            <table width="100%" border="0" cellpadding="2" cellspacing="2" class="txt">
              <tr>
                <td height="200" align="left" valign="middle"><span class="link_navi_red">You submit your user name should not be empty, please re-register!
                  </span>
                  <meta http-equiv="refresh" content="5;url=/en/member/reg.php"></td>
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
