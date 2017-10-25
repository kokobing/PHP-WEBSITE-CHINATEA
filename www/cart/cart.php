<?php
require "../inc/config.php";
require "../inc/pagenav.class.php";

if(isset($_GET[pid])){

  if(!isset($_SESSION["pid"])){
    $_SESSION["pid"]=$_GET[pid];
  }else{
    $_SESSION["pid"]=$_SESSION["pid"].";".$_GET[pid];
  }
  $_SESSION["pdir1"]=$_GET[pdir1];
  $_SESSION["page"]=$_GET[page];

header("Location:/cart/cart.php");

}

  if(isset($_GET[act]) && $_GET[act]='del'){
	  
    $_SESSION["pid"]=str_replace($_GET[dpid],"",$_SESSION["pid"]);
	
	$slone_num=explode("-",$_GET[sl]);//单个产品数量  
	unset($slone_num[$_GET[ploc]]);
	
    for($i=0;$i<sizeof($slone_num);$i++){if($slone_num[$i]!=''){$arr_num[]=$slone_num[$i];}}
	for($i=0;$i<sizeof($arr_num);$i++){
	  $_SESSION["aumont_".$i]=$arr_num[$i];// 记忆数量
    }
    
	header("Location:/cart/cart.php");
  }
  

//生成数组,过滤重复
if(isset($_SESSION["pid"])){
  $state=explode(";",$_SESSION["pid"]);  
  $statepid = array_unique($state); 
  $sum = 0;//初始化累加变量
  foreach($statepid as $arrpid[$sum]){ $sum  = $sum+1;}
  for($i=0;$i<sizeof($arrpid);$i++){if($arrpid[$i]!=''){$allpid[]=$arrpid[$i];}}
  
  }  



if($_SESSION["iswork"]==2){//如果为高级会员
	$payzhekou_on=0.88;
	$payzhekou_off=0.79;	
}

if($_SESSION["iswork"]==1){//如果为非高级会员
	$payzhekou_on=1;
	$payzhekou_off=0.9;		
}

if(!isset($_SESSION["iswork"])){//如果不存在会员等级 不是会员
	$payzhekou_on=1;
	$payzhekou_off=0.9;	
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
<script language="javascript">
function add1(getnum){
var getnum;
var ssid="#ss"+getnum;
var djid="#dj"+getnum;
var xjid="#xj"+getnum;

var djtotal=Number($(djid).val())+1;
$(djid).val(djtotal);<!--数量-->
var xjtotal=Number($(ssid).text())*<?=$payzhekou_on;?>*djtotal;<!--小计-->

var i=0;
var total=0;
for(i=0;i<<?=sizeof($allpid);?>;i++){
var total=total+(Number($("#ss"+i).text())*Number($("#dj"+i).val()));
}

var total1=Number(total)*<?=$payzhekou_on;?>;<!--在线支付总额-->
var total2=Number(total)*<?=$payzhekou_off;?>;<!--现金总额-->

$(sum_total).text(total1.toFixed(2));
$(sum_total2).text(total2.toFixed(2));
$(xjid).text(xjtotal.toFixed(2));
			
}

function add2(getnum){
var getnum;
var ssid="#ss"+getnum;
var djid="#dj"+getnum;
var xjid="#xj"+getnum;

var djtotal=Number($(djid).val())-1;
if(djtotal>=1){

$(djid).val(djtotal);<!--数量-->
var xjtotal=Number($(ssid).text())*<?=$payzhekou_on;?>*djtotal;<!--小计-->

var i=0;
var total=0;
for(i=0;i<<?=sizeof($allpid);?>;i++){
var total=total+(Number($("#ss"+i).text())*Number($("#dj"+i).val()));
}

var total1=Number(total)*<?=$payzhekou_on;?>;<!--在线支付总额-->
var total2=Number(total)*<?=$payzhekou_off;?>;<!--现金总额-->

$(sum_total).text(total1.toFixed(2));
$(sum_total2).text(total2.toFixed(2));
$(xjid).text(xjtotal.toFixed(2));

}

			
}

</script>


<script language="javascript">
function delep(pid,ploc){
	//pid 产品ID  ploc 要删除的位置
	var sl='';
	for(i=0;i<<?=sizeof($allpid);?>;i++){
       sl=sl+$("#dj"+i).val()+"-";
     }
	
	window.location = "cart.php?act=del&dpid="+pid+"&ploc="+ploc+"&sl="+sl;
	
}
</script>
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
            <td colspan="2" align="center" valign="top"><img src="../inc/pics/fwzc.jpg" width="721" height="166" /></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="30" align="left" valign="middle"><p><span class="txt4"> &nbsp;我的购物车</span></p></td>
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
            <form action="cart2.php" method=post  name="reg" onSubmit="return CheckForm(this);" >
            <tr>
              <td align="center" valign="top"><img src="../inc/pics/icon012.gif" width="700" height="32" /></td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td align="center" valign="middle"><div  id="cart_boder_02">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="5%" height="30" align="left">&nbsp;</td>
                    <td width="95%" align="left" class="txt">已放入购物车的商品:</td>
                  </tr>
                  <tr>
                    <td height="1" colspan="2" align="center" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td bgcolor="#D1D1D1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#D1D1D1">
                            <tr>
                              <td width="14%" height="30" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>图片</strong></td>
                              <td width="20%" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>商品名称</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>销售价格</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>会员价格</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>数量</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF" class="txt_black"><strong>小计</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                       <? $total_sum=0;
					   for($i=0;$i<sizeof($allpid);$i++){
					            
	                            if($allpid[$i]!=''){				   
					          //取出产品
					          $strSQL = "select * from productinfo  where dele='1' and id_prodinfo='$allpid[$i]'  ";
					          $objDB->Execute($strSQL);
					          $sproduct=$objDB->fields();
							  
							  if($_SESSION["aumont_".$i]!=''){$pshuliang=$_SESSION["aumont_".$i];}else{$pshuliang='1';}
							  $total_sum=$total_sum+($sproduct[price]*$pshuliang);
							  
							  //取出产品图片
							  $strSQL = "select opicname as pic from productpic  where id_prodinfo ='".$allpid[$i]."' 
							             order by id_prodpic asc limit 1" ;
                              $objDB->Execute($strSQL);
                              $arronepic=$objDB->fields();
					   ?>
                            <tr>
                              <td height="70" align="center" bgcolor="#FFFFFF"><a href="pdtspage.php?id=<?=$allpid[$i];?>" target="_blank"><img src="/upload/product/<?=$arronepic[pic]?>" width="50" height="50" border="0" /></a></td>
                              <td align="center" bgcolor="#FFFFFF" class="txt3"><?=$sproduct[title]?></td>
                              <td align="center" bgcolor="#FFFFFF"><div class="txt3" id="ss<?=$i;?>"><?=$sproduct[price]?></div></td>
                              <td align="center" bgcolor="#FFFFFF" class="txt3"><?=round($sproduct[price]*0.88,2);?></td>
                              <td align="center" bgcolor="#FFFFFF">
                                <table width="28" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10" rowspan="2"><input  name="aumont<?=$i;?>" type="text" class="input_01"  style="width:20px;" value="<? if($_SESSION["aumont_".$i]!=''){echo $_SESSION["aumont_".$i];}else{echo '1';}?>" maxlength="2" id="dj<?=$i;?>" readonly="readonly" /></td>
                                    <td width="18" align="center"><A href="javascript:void(0)" onclick="add1(<?=$i;?>);" style="CURSOR: pointer;"  class="m_01"><img src="../inc/pics/add01.gif" width="18" height="9" border="0" /></a></td>
                                  </tr>
                                  <tr>
                                    <td align="center"><A href="javascript:void(0)"  onclick="add2(<?=$i;?>);" style="CURSOR: pointer;"  class="m_01"><img src="../inc/pics/add02.gif" width="18" height="9" border="0" /></a></td>
                                  </tr>
                                </table></td>
                              <td align="center" bgcolor="#FFFFFF"><div class="txt3" id="xj<?=$i;?>"><?php  echo round($sproduct[price]*$payzhekou_on*$pshuliang,2)?></div></td>
                              <td align="center" bgcolor="#FFFFFF"><a href="javascript:void(0)" class="link_navi_1" onclick="delep(<?=$allpid[$i];?>,<?=$i;?>);">删除</a></td>
                            </tr>
                            <? }else{
							       continue;    
							   }
							
							}?>
                          </table></td>
                        </tr>
                      </table>
                      <br />
                      <table width="95%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td bgcolor="#D1D1D1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#D1D1D1">
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF">
                                  <table width="220" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="174" align="right"><input name="payfangshi" type="radio" value="1" checked="checked" />
                                      <span class="txt">支付宝支付总额：￥</span></td>
                                      <td width="46" align="left"><div id="sum_total"  class="txt"><?=round($total_sum*$payzhekou_on,2);?></div></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF"><table width="220" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="174" align="right"><input name="payfangshi" type="radio" value="2" />
                                      <span class="txt">现金支付( 9 折 )：￥</span></td>
                                    <td width="46" align="left"><div id="sum_total2"  class="txt">
                                      <?=round($total_sum*$payzhekou_off,2);?></div></td>
                                  </tr>
                                </table></td>
                              </tr>

                          </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
              </div></td>
            </tr>
            <tr>
              <td colspan="3" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td align="center"><table width="96%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="13%" align="center"><input type="button" name="button" id="button" onClick="location.href='/index.php?pdir1=<?=$_SESSION["id"]?>&page=<?=$_SESSION["page"]?>'" value="继续购物" /></td>
                  <td width="76%">&nbsp;</td>
                  <td width="11%" align="center"><input type="submit" name="button2" id="button2" value="结帐" /></td>
                </tr>
              </table></td>
              </tr>
              </form>
          </table>




</div><!--end about_contentbox!-->
</div><!--end mainc_right!-->
<? require "../partner.php"; ?>
<div style="clear:both;"></div> 
</div>

<? require "../footer.php"; ?>

</body>
</html>
