<?php 


require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");



$strSQL="select * from s212 where id_s212='$_GET[id]'";
$objDB->execute($strSQL);
$arrOrderinfo = $objDB->fields();

 
$strSQL="select s213.s213_01_01,s213.zhekou,productinfo.price,productinfo.title from s213 
         left join productinfo on productinfo.id_prodinfo=s213.id_prodinfo where id_s212='$_GET[id]'";
$objDB->execute($strSQL);
$arrOrderpdtinfo= $objDB->GetRows();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>


</head>
<body>
<?php require "../header.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="87.9%">
  <tr> 
    <td width="15%" align="left" valign="top" bgcolor="#E7F1F8">
	<?php require "../leftmenu.php"; ?>
      </td>
    <td width="75%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right">
       
        </td>
      </tr>
    </table>
	<div  style="width:98%;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">订单管理</td>
            </tr>
          </table></td>
        </tr>
        <tr>

          <td align="left"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
<form action="order.php" method="post" name="form1">
                <tr bgcolor="#FFEFD2">
                  <td bgcolor="#FFEFD2" class="txt">订单明细------订单号:<?=$arrOrderinfo[s212_01_01];?></td>
</tr>
			  <tr>
                <td height="1" bgcolor="#CCCCCC"></td>
              </tr>
              			  <tr>
                <td height="2" bgcolor="#ECEFCF"></td>
              </tr>  
        </form>
      </table>
      <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
        <tr>
          <td align="center" class="link_dele"><? if($arrOrderinfo[s212_01_07]==1){echo '支付宝';if($arrOrderinfo[s212_02_01]==1){echo '尚未支付...';}if($arrOrderinfo[s212_02_01]==2){echo '已完成支付...';}}?>
          <? if($arrOrderinfo[s212_01_07]==2){echo 'PALPAY';if($arrOrderinfo[s212_02_01]==1){echo '尚未支付...';}if($arrOrderinfo[s212_02_01]==2){echo '已完成支付...';}}?>
          <? if($arrOrderinfo[s212_01_07]==3){echo '线下现金转帐';}?>
          
</td>
        </tr>
        <tr>
          <td align="left">收货人姓名 :
          <?=$arrOrderinfo[s212_01_01];?></td>
        </tr>
        <tr>
          <td align="left">收货人地址 :
          <?=$arrOrderinfo[s212_01_02];?></td>
        </tr>
                <tr>
                  <td align="left">手机号/电话号码 :
                    <?=$arrOrderinfo[s212_01_04];?> / 
                  <?=$arrOrderinfo[s212_01_05];?></td>
                </tr>
                <tr>
                  <td align="left">支付方式 :            
                    <? if($arrOrderinfo[s212_01_07]==1){echo '支付宝';}?>
                  <? if($arrOrderinfo[s212_01_07]==2){echo 'PALPAY';}?>
                  <? if($arrOrderinfo[s212_01_07]==3){echo '线下现金转帐';}?>
                  </td>
                </tr>
                <tr>
          <td align="left">快递方式 :
            <?=$arrOrderinfo[s212_01_08];?>元快递</td>
        </tr>
                <tr>
                  <td align="left">结汇金额 :
                  <?=$arrOrderinfo[s212_01_10];?></td>
                </tr>
                <tr>
                  <td height="1" align="left" bgcolor="#CCCCCC"></td>
                </tr>
                                <tr>
                  <td align="left">购买清单:</td>
                </tr>
                                <tr>
                                  <td align="left"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                                    <tr>
                                      <td width="25%">产品名称</td>
                                      <td width="25%">产品数量</td>
                                      <td width="25%">销售价格</td>
                                      <td width="25%">折扣</td>
                                    </tr>
                                    <? for($i=0;$i<sizeof($arrOrderpdtinfo);$i++){?>
                                    <tr>
                                      <td><?=$arrOrderpdtinfo[$i][title]?></td>
                                      <td><?=$arrOrderpdtinfo[$i][s213_01_01]?></td>
                                      <td><?=$arrOrderpdtinfo[$i][price]?></td>
                                      <td><?=$arrOrderpdtinfo[$i][zhekou]?></td>
                                    </tr>
                                  <? }?>  
                                  </table></td>
                                </tr>
      </table></td>

        </tr>

        <tr>

          <td align="center">&nbsp;</td>

        </tr>

        <tr>

          <td>&nbsp;</td>

        </tr>

      </table>

	</div></td>
  </tr>

</table>
<?php require "../footer.php"; ?>
</body>
</html>
