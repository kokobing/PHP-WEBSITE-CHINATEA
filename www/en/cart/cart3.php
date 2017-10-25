<?php
require "../../inc/config.php";


		
if(isset($_GET[act]) && ($_GET[act]=='orderin' or $_GET[act]=='orderined'  or $_GET[act]=='orderin99billpayed'  or $_GET[act]=='orderinalipayed' )){

if($_GET[act]=='orderin'){

//生成数组,过滤重复
if(isset($_SESSION["pid"])){
  $state=explode(";",$_SESSION["pid"]);  
  $statepid = array_unique($state); 
  $sum = 0;//初始化累加变量
  foreach($statepid as $arrpid[$sum]){ $sum  = $sum+1;}
}

$ordercode=date("Ymd").mktime();

if(!isset($_SESSION["UserID"])){$userid=0;}else{$userid=$_SESSION["UserID"];}//会员 游客

$total_sum=0;
$pdt_name='';
 for($i=0;$i<sizeof($arrpid);$i++){
					            
	 if($arrpid[$i]!=''){	
	  //取出产品
		$strSQL = "select * from productinfo  where dele='1' and id_prodinfo='$arrpid[$i]'  ";
		$objDB->Execute($strSQL);
		$sproduct=$objDB->fields();		   
		 if($_SESSION["aumont".$i]!=''){
							  $total_sum=$total_sum+(($sproduct[price])*$_SESSION["aumont".$i]);
							  $pdt_name=$pdt_name."|".$sproduct[title];
			}else{
							  $total_sum=$total_sum+$sproduct[s041_02_05];
							   $total_sum=$total_sum+($sproduct[title]);
		 }
	}
}		//求总金额	


$total_sum=$_POST["totaldjnum"];

if(isset($_POST["yhlsh"])){$_POST["pay_type"]=3;}//支付方式为现金支付

$strSQL="INSERT INTO s212(id_member,s212_01_01,s212_01_02,s212_01_03,s212_01_04,s212_01_05,s212_01_06,s212_01_07,s212_01_08,s212_01_09,s212_01_10,s212_02_01,s212_02_02,s212_09_02,yhlsh)  
 values('".$userid."','$ordercode','".$_POST["receive_add"]."','".$_POST["receive_name"]."','".$_POST["receive_mobi"]."','".$_POST["receive_tel"]."','".$_POST["receive_fp"]."','".$_POST["pay_type"]."','".$_POST["wl"]."','1','$total_sum','1','$pdt_name',now(),'".$_POST["yhlsh"]."')";
 
$objDB->execute($strSQL);
$_SESSION["orderinedid"] = $objDB->getInsertID();

//生成订单明细
 for($i=0;$i<sizeof($arrpid);$i++){
					            
	 if($arrpid[$i]!=''){	
	  //取出产品
		$strSQL = "select * from productinfo  where dele='1' and id_prodinfo='$arrpid[$i]'  ";
		$objDB->Execute($strSQL);
		$sproduct=$objDB->fields();			   
		 if($_SESSION["aumont".$i]!=''){//存在数量
                     $strSQL="INSERT INTO s213(id_s212,id_prodinfo,s213_01_01,s213_09_02,zhekou,id_member) 
					          values('".$_SESSION["orderinedid"]."','".$sproduct[id_prodinfo]."','".$_SESSION["aumont".$i]."',now(),'".$_SESSION["payzhekou"]."','".$userid."')";
                     $objDB->execute($strSQL);
					 
					 $pnum=$_SESSION["aumont".$i];
					 //buynum+num
					 $strSQL="UPDATE productinfo SET buynum=buynum+$pnum where id_prodinfo='".$sproduct[id_prodinfo]."' ";
                     $objDB->Execute($strSQL);	
					 
			}else{//不存在数量为1
			
			         $strSQL="INSERT INTO s213(id_s212,id_prodinfo,s213_01_01,s213_09_02,zhekou,id_member) 
					          values('".$_SESSION["orderinedid"]."','".$sproduct[id_prodinfo]."','1',now(),'".$_SESSION["payzhekou"]."','".$userid."')";
                     $objDB->execute($strSQL);
					 
					 //buynum+num
					 $strSQL="UPDATE productinfo SET buynum=buynum+1 where id_prodinfo='".$sproduct[id_prodinfo]."' ";
                     $objDB->Execute($strSQL);	

		 }
	}
}//结束生成订单		

header("Location:/en/cart/cart3.php?act=orderined");

}//if($_GET[act]=='orderin')


if($_GET[act]=='orderined'){
//view order
$strSQL="select * from s212  where id_s212='".$_SESSION["orderinedid"]."' ";
$objDB->execute($strSQL);
$arrOrder = $objDB->fields();

}//if($_GET[act]=='orderined')


////orderin99billpayed
if($_GET[act]=='orderin99billpayed'){
$strSQL="UPDATE s212 SET s212_02_01='2' where id_s212='".$_SESSION["orderinedid"]."'";
$objDB->execute($strSQL);
//view order
$strSQL="select * from s212  where id_s212='".$_SESSION["orderinedid"]."' ";
$objDB->execute($strSQL);
$arrOrder = $objDB->fields();

if($arrOrder[id_member]!=0 && $arrOrder[s212_01_10]>=2000 && $_SESSION["UserID"]==$arrOrder[id_member]){
$strSQL="UPDATE member SET 	iswork=2 where id_member='".$_SESSION["UserID"]."' ";
$objDB->Execute($strSQL);	
}

}
/////orderin99billpayed


////orderinalipayed
if($_GET[act]=='orderinalipayed'){
$strSQL="UPDATE s212 SET s212_02_01='2' where id_s212='".$_SESSION["orderinedid"]."'";
$objDB->execute($strSQL);
//view order
$strSQL="select * from s212  where id_s212='".$_SESSION["orderinedid"]."' ";
$objDB->execute($strSQL);
$arrOrder = $objDB->fields();

if($arrOrder[id_member]!=0 && $arrOrder[s212_01_10]>=2000 && $_SESSION["UserID"]==$arrOrder[id_member]){
$strSQL="UPDATE member SET 	iswork=2 where id_member='".$_SESSION["UserID"]."' ";
$objDB->Execute($strSQL);	
}

}
/////orderinalipayed





}else{//if(isset($_GET[act]) && ($_GET[act]=='orderin' or $_GET[act]=='orderined' ))

header("Location:/en/cart/cart.php");

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

</head>
<body>

<? require "../header.php"; ?>

<div id="maincontent">
<div id="mainc_left">
<? require "../leftadv.php"; ?>
</div><!--end mainc_left!-->
<div id="about_content">
<div id="about_contentbox">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="90%" align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
          <tr>
            <td colspan="2" align="center" valign="top"><img src="/inc/pics/fwzc.jpg" width="721" height="166" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td  style="padding:0; height:1px;" bgcolor="#CCCCCC"></td>
          </tr>
          <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
          </tr>
          
          
        </table>
     </td>
               </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td height="200" align="left" valign="middle">
              <? if(isset($_GET[act]) && $_GET[act]=='orderined'){?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <? if($arrOrder[s212_01_07]==1){?>
            <form action="alipay/index.php" method=post  name="reg" onSubmit="return CheckForm(this);"  target="_blank">
             
              <input type="hidden" name="ordercode"  id="ordercode" value="<?=$arrOrder[s212_01_01];?>">
              <input type="hidden" name="payname"  id="payname" value="<?=$arrOrder[s212_01_03];?>">
              <input type="hidden" name="totalpaymoney"  id="totalpaymoney" value="<?=$arrOrder[s212_01_10];?>">
              <input type="hidden" name="pdtname"  id="pdtname" value="<?=$arrOrder[s212_02_02];?>">
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><div  id="cart_boder_02">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="left" class="txt">Your order has been submitted</td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt"> Number of orders：<?=$arrOrder[s212_01_01];?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">Payment：<? if($arrOrder[s212_01_07]==1){echo '支付宝';} if($arrOrder[s212_01_07]==2){echo 'Paypal';}?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">The total amount：<?=$arrOrder[s212_01_10];?></td>
                    </tr>
                  <tr>
                    <td height="1" align="center" valign="top"><input type="submit" name="button" id="button" value="Pay Now" style="width:100px; height:40px;" />
                      <br /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
              </form>
           <? }?>
         <? if($arrOrder[s212_01_07]==2){?>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><div  id="cart_boder_02">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="left" class="txt">Your order has been submitted</td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt"> Number of orders：<?=$arrOrder[s212_01_01];?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">Payment：<? if($arrOrder[s212_01_07]==1){echo '支付宝';} if($arrOrder[s212_01_07]==2){echo 'Paypal';}?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">The total amount：<?=$arrOrder[s212_01_10];?></td>
                    </tr>
                  <tr>
                    <td height="1" align="center" valign="top"><form action="https://www.paypal.com/cgi-bin/websrc" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="chinatealand@hotmail.com">
<input type="hidden" name="item_name" value="<?=$arrOrder[s212_01_01];?>">
<input type="hidden" name="amount" value="<?=$arrOrder[s212_01_10];?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="return" value="http://www.chinatealand.com/cart/cart3.php?act=orderin99billpayed">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer,easier way to pay online">
</form>
                      <br /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>

                  <? }?>
                  
                           <? if($arrOrder[s212_01_07]==3){?>
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><div  id="cart_boder_02">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="left"  class="txt">Your order has been submitted</td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt"> Number of orders：<?=$arrOrder[s212_01_01];?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">Payment: cash transfer</td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">The total amount：<?=$arrOrder[s212_01_10];?></td>
                    </tr>
                  <tr>
                    <td height="1" align="center" valign="top">
                      <br /></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>

                  <? }?>
          </table>
          <? }?>
          <? if(isset($_GET[act]) && ($_GET[act]=='orderin99billpayed' or $_GET[act]=='orderinalipayed')){?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><div  id="cart_boder_02">
                <table width="98%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="30" align="center" class="txt">Your order has been submitted</td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt"> Number of orders：<?=$arrOrder[s212_01_01];?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">Payment：<? if($arrOrder[s212_01_07]==1){echo '支付宝';} if($arrOrder[s212_01_07]==2){echo 'Paypal';}?></td>
                  </tr>
                  <tr>
                    <td height="30" align="left" class="txt">The total amount：<?=$arrOrder[s212_01_10];?></td>
                    </tr>
                  <tr>
                    <td height="1" align="center" valign="top"><br /></td></tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
                    </table>
          <? }?>
          
          
           </td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
          </table>

</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<? require "../partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
