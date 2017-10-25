<?php 

/*
add 增加空界面 :01表示
add_s 提交入库：02表示
edit 编辑抽取：03表示
edit_s 编辑提交：04表示
del 删除：05表示
action 空动作：06表示
*/

require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
require_once("../inc/navipage.php");
require_once("../inc/function.class.php");



//发货
if(isset($_GET["act"]) && $_GET["act"]=="send"){

     $strSQL="UPDATE s212 SET  send=1 where id_s212='".$_GET["orderid"]."'";
	 $objDB->Execute($strSQL);
	
}

//未发货
if(isset($_GET["act"]) && $_GET["act"]=="nosend"){

     $strSQL="UPDATE s212 SET  send=0 where id_s212='".$_GET["orderid"]."'";
	 $objDB->Execute($strSQL);
	
}


$arrParam[0][name]="sc_n1";
$arrParam[0][value]=$sc_n1;



if(isset($_GET["act"]) && $_GET["act"]=="hidleft"){
$arrParam[1][name]="act";
$arrParam[1][value]=$_GET["act"];
}



$strWhere="";



$intRows = 20;
$strSQLNum = "SELECT COUNT(*) as num from s212 ";
$objDB->Execute($strSQLNum);
$arr = $objDB->fields();
$intTotalNum=$arr[num];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 
 
$strSQL="select * from s212  order by id_s212 desc";

$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrOrder = $objDB->GetRows();
$intarrOrder=sizeof($arrOrder);


//删除操作
if(isset($_GET["act"]) && $_GET["act"]=="del"){

	$strSQL="delete from s212  WHERE id_s212='".$_GET[id]."'";
	$objDB->Execute($strSQL);
	
    $strSQL="delete from s213  WHERE id_s212='".$_GET[id]."'";
	$objDB->Execute($strSQL);
	
}











?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript"><!--
function OnRecoDelete(id_p01) {
	if ( confirm("您确定要删除此条记录吗?") )  {
		if ( window.prompt("请输入 ID:["+id_p01+"]","")==id_p01 )  {
			window.location = "salse.php?act=del&id="+id_p01;
		}
	}
}
//-->
</SCRIPT>

</head>
<body>
<?php require "../header.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="87.9%">
  <tr> 
  <? if($_GET["act"]!="hidleft"){?>
    <td width="15%" align="left" valign="top" bgcolor="#E7F1F8">
	<?php require "../leftmenu.php"; ?>
      </td>
  <? }?> 
    <td width="75%" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right">
      <? if($_GET["act"]!="hidleft"){?>
       <a href="salse.php?act=hidleft" class="link_leftmenu">隐藏左侧</a>&nbsp;&nbsp;
       <? }else{?> 
       <a href="salse.php" class="link_leftmenu">恢复左侧</a>&nbsp;&nbsp;
       <? }?>
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

          <td align="left"><? if($_GET[act]=="del"){?>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" class="txt">
              <tr>
                <td>删除成功,
                正在返回... <meta http-equiv='refresh' content=2;url='./salse.php'>                </td>
              </tr>
            </table>
            <? }elseif($intarrOrder==""){ ?>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="4" class="txt">
               <tr>
                <td width="544">您还没有订单</td>
              </tr>
      </table>
            <? }else{ ?>

            <table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC" class="txt">
              <tr>
                <td width="22%" valign="middle" bgcolor="#F5F5F5">订单编号/是否支付</td>
                <td width="12%" valign="middle" bgcolor="#F5F5F5">收货人</td>
                <td width="15%" valign="middle" bgcolor="#F5F5F5">收货人地址</td>
                <td width="21%" align="left" bgcolor="#F5F5F5">手机号/电话号码</td>
                <td width="14%" align="left" bgcolor="#F5F5F5">支付方式</td>
                <td width="16%" align="left" bgcolor="#F5F5F5">结汇金额</td> 
              </tr>
              <? for($i=0;$i<sizeof($arrOrder);$i++){?>
              <tr onMouseOver="setPointer(this, <?=$i;?>, 'over', '#FFFFFF', '#FAFFE8', '#FFEEDD');" onMouseOut="setPointer(this, <?=$i;?>, 'out', '#FFFFFF', '#FAFFE8', '#FFEEDD');" onMouseDown="setPointer(this, <?=$i;?>, 'click', '#FFFFFF', '#FAFFE8', '#FFEEDD');">
                <td align="left" valign="middle"  ><?=$arrOrder[$i][s212_01_01];?>/
          <? if($arrOrder[$i][s212_01_07]==1){if($arrOrder[$i][s212_02_01]==1){echo '尚未支付';}if($arrOrder[$i][s212_02_01]==2){echo '完成支付';}}?>
          <? if($arrOrder[$i][s212_01_07]==2){if($arrOrder[$i][s212_02_01]==1){echo '尚未支付';}if($arrOrder[$i][s212_02_01]==2){echo '完成支付';}}?>
          <? if($arrOrder[$i][s212_01_07]==3){echo '线下现金转帐';}?>
                
                </td>
                <td align="left" valign="middle"  ><?=$arrOrder[$i][s212_01_03];?> | <? if($arrOrder[$i][send]==0){?><a href="salse.php?act=send&orderid=<?=$arrOrder[$i][id_s212];?>&page=<?=$_GET[page]?>"  class="link_leftmenu">未发货</a><? }else{?><a href="salse.php?act=nosend&orderid=<?=$arrOrder[$i][id_s212];?>&page=<?=$_GET[page]?>"  class="link_leftmenub2">已发货</a><? }?></td>
                <td align="left" valign="middle"  ><?=$arrOrder[$i][s212_01_02];?></td>
                <td align="left"  ><?=$arrOrder[$i][s212_01_04];?>/<?=$arrOrder[$i][s212_01_05];?></td>
                <td align="left"  ><? if($arrOrder[$i][s212_01_07]==1){echo '支付宝';}?><? if($arrOrder[$i][s212_01_07]==2){echo 'PALPAY';}?><? if($arrOrder[$i][s212_01_07]==3){echo '线下现金';}?></td>
                <td align="left"  ><?=$arrOrder[$i][s212_01_10];?>/<a href="salseinfo.php?id=<?=$arrOrder[$i][id_s212];?>" target="_blank" class="link_leftmenu">查看明细</a> | <span class="link_dele" style="CURSOR:pointer" onClick="OnRecoDelete(<?=$arrOrder[$i]['id_s212'];?>);">删除</span></td>
              </tr>
			  <tr bgcolor="#F5F5F5">
                <td colspan="6" height="1"></td>
              </tr>
              <? }?>
              <tr>
                <td colspan="7" align="right"><?=$strNavigate;?></td>
              </tr>
      </table>
    <? }?></td>

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
