<?php
require "../inc/config.php";

		
if(isset($_SESSION[ref])){
session_unregister(ref);
}

if(isset($_POST[payfangshi])){//支付方式 payfangshi=1为网上支付  payfangshi=2线下转帐
$_SESSION["payfangshi"]=$_POST[payfangshi];
}



if($_SESSION["iswork"]==2){//如果为高级会员
	$payzhekou=0.88;	
	//当前折扣 网上支付不打折
    if($_SESSION["payfangshi"]==1){$payzhekou=0.88;}//网上
	if($_SESSION["payfangshi"]==2){$payzhekou=0.79;}//线下
}

if($_SESSION["iswork"]==1){//如果为非高级会员
	$payzhekou=1;	
	if($_SESSION["payfangshi"]==1){$payzhekou=1;}
	if($_SESSION["payfangshi"]==2){$payzhekou=0.9;}
}

if(!isset($_SESSION["iswork"])){//如果不存在会员等级 不是会员
	$payzhekou=1;	
	if($_SESSION["payfangshi"]==1){$payzhekou=1;}
	if($_SESSION["payfangshi"]==2){$payzhekou=0.9;}
}

$_SESSION["payzhekou"]=$payzhekou;



//生成数组,过滤重复
if(isset($_SESSION["pid"])){
  $state=explode(";",$_SESSION["pid"]);  
  $statepid = array_unique($state); 
  $sum = 0;//初始化累加变量
  foreach($statepid as $arrpid[$sum]){ $sum  = $sum+1;}
  for($i=0;$i<sizeof($arrpid);$i++){if($arrpid[$i]!=''){$allpid[]=$arrpid[$i];}}
}


if(!isset($_GET[act])){
for($i=0;$i<sizeof($allpid);$i++){
	  $_SESSION["aumont".$i]=$_POST["aumont".$i];// 记忆数量
	
}	

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
<script language="javascript">


$(document).ready(function ()
{
//
$("#wl1").click( function() {

getnum=$("#wl1").val();
if(Number(getnum)!=$("#iswl").val()){
$("#total_sumall").text(Number($("#total_sumall").text())+Number(getnum)-$("#iswl").val());
$("#iswl").val(Number(getnum))	
$("#wl_fee").text(Number(getnum))	
}

});

$("#wl2").click( function() {

getnum=$("#wl2").val();
if(Number(getnum)!=$("#iswl").val()){
$("#total_sumall").text(Number($("#total_sumall").text())+Number(getnum)-$("#iswl").val());
$("#iswl").val(Number(getnum))	
$("#wl_fee").text(Number(getnum))	
}

});
//
});


function wl(getnum){

var getnum;
if(Number(getnum)!=$(iswl).val()){
$(total_sumall).text(Number($(total_sumall).text())+Number(getnum)-$(iswl).val());
$(iswl).val(Number(getnum))	
$(wl_fee).text(getnum)	
}		
}

function CheckForm(tar){

if(tar.receive_add.value==""){
alert("收货地址不为空，请确认输入收货地址!");
tar.receive_add.focus();
return false;
}


if(tar.receive_name.value==""){
alert("收货人姓名不为空，请确认输入姓名!");
tar.receive_name.focus();
return false;
}

if(tar.receive_mobi.value==""){
alert("收货人手机不为空，请确认输入手机号码!");
tar.receive_mobi.focus();
return false;
}

return true;
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
            <td height="30" align="left" valign="middle"><p><span class="txt"> &nbsp;我的购物车</span></p></td>
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
              <td align="center" valign="top"><img src="../inc/pics/icon0022.gif" width="700" height="32" /></td>
            </tr>
            <tr>
            <td colspan="3" style="padding:0; height:10px;" ></td>
            </tr>
            <tr>
              <td height="200" align="left" valign="middle">
              <? if(!isset($_SESSION["UserName"]) && $_GET[act]!="nomem" ){?>
              <br />
              <span class="txt">如果您已经是本站会员，请登录
          ,<a href="/member/reg.php" target="_blank" class="m_03">尚未注册请单击注册会员</a></span><br />
            <div id="mem_boder_01">
          <table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
           <form action="/member/login.php?act=login&ref=cart2.php" method=post  name="reg" onSubmit="return CheckForm(this);" >
            <tr>
              <td colspan="5" style="padding:0; height:10px;" ></td>
              </tr>
            <tr>
              <td width="8%" height="20" align="center" valign="top"><em> </em></td>
              <td width="10%" align="right" valign="top">用户名：</td>
              <td colspan="3"><input name="UserName" type="text" class="input_01" id="textfield" /></td>
            </tr>
            <tr>
              <td height="20" align="center" valign="top">&nbsp;</td>
              <td height="20" align="right" valign="top">密码：</td>
              <td colspan="3"><input name="password" type="password" class="input_01" id="textfield2" /></td>
            </tr>
            <tr>
              <td height="20" align="center" valign="top">&nbsp;</td>
              <td height="20" align="right" valign="top">验证码：</td>
              <td width="11%"><input name="number" type="text" class="input_01" id="textfield3" size="10" /></td>
              <td colspan="2"><img src=../member/chnum.class.php></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td><input name="button" type="submit" id="button" value="立即登陆" /></td>
              <td width="4%">&nbsp;</td>
              <td width="67%"></td>
            </tr>
            </form>
          </table>
          </div> 
            <br />
            <br />
            <div id="mem_boder_01">
<table width="100%" border="0" cellpadding="3" cellspacing="3" class="txt">
            <tr>
              <td height="150" align="left" valign="top"><a href="cart2.php?act=nomem" class="m_03">无需注册会员，直接下订单购买商品</a></td>
              </tr>
          </table>
         </div>
         <? }
		 if( isset($_SESSION["UserName"]) || $_GET[act]=="nomem" ){?>
         <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="500" align="center" valign="top" bgcolor="#F0F0F0">
      <form action="cart3.php?act=orderin" method=post  name="reg" onSubmit="return CheckForm(this);" >
    <table width="700" border="0" cellspacing="4" cellpadding="4">
      <tr>
        <td align="left" class="txt4">填写收货人信息</td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#EBECED" bgcolor="#FFFFFF">
          <tr>
            <td height="40" align="center"><table width="99%" border="1" cellpadding="4" cellspacing="0" bordercolor="#EBECED" class="txt">
              <tr>
                <td width="16%" height="20" align="right"><em>*确认收货地址：</em></td>
                <td width="84%" align="left"><input name="receive_add" type="text" class="input_01" id="receive_add"  value="<?=$memberinfo[address];?>" size="40" /></td>
              </tr>
              <tr>
                <td height="20" align="right"><em>* 收货人姓名：</em></td>
                <td align="left"><input name="receive_name" type="text" class="input_01" id="receive_name"  value="<?=$memberinfo[name];?>" /></td>
              </tr>
              <tr>
                <td height="20" align="right"><em>* 联系手机：</em></td>
                <td align="left"><input name="receive_mobi" type="text" class="input_01" id="receive_mobi"  value="<?=$memberinfo[mobi];?>" /></td>
              </tr>
              <tr>
                <td height="20" align="right"><em>联系电话：</em></td>
                <td align="left"><input name="receive_tel" type="text" class="input_01" id="receive_tel"  value="<?=$memberinfo[tel];?>" /></td>
              </tr>
              </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" class="txt4">选择配送方</td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#EBECED" bgcolor="#FFFFFF">
          <tr>
            <td height="40" align="center"><table width="99%" border="1" cellpadding="4" cellspacing="0" bordercolor="#EBECED" class="txt">
                <tr>
                  <td width="16%" height="20" align="right"><em>
                    <input name="wl" type="radio" id="wl1" value="<?=$setinfo[incost];?>" checked="checked" />
                    国内</em></td>
                  <td width="84%" align="left">+￥<?=$setinfo[incost];?><br /></td>
                </tr>
                <tr>
                  <td height="20" align="right"><em>
                    <input type="radio" name="wl" id="wl2" value="<?=$setinfo[outcost];?>"  />
                    海外</em></td>
                  <td align="left">+￥<?=$setinfo[outcost];?></td>
                </tr>

            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" class="txt4">选择支付方式</td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#EBECED" bgcolor="#FFFFFF">
          <tr>
            <td height="40" align="center">
            <? if($_SESSION["payfangshi"]==1){?>
            <table width="99%" border="1" cellpadding="4" cellspacing="0" bordercolor="#EBECED" class="txt">
                <tr>
                  <td width="16%" height="20" align="right"><em>
                    <input name="pay_type" type="radio" id="pay_type" value="1" checked="checked" />
                    支付宝</em></td>
                  <td width="84%" align="left"><img src="../inc/pics/zfbzf.gif" width="145" height="33" /></td>
                </tr>
                </table>
            <? }elseif($_SESSION["payfangshi"]==2){?>
                        <table width="99%" border="1" cellpadding="4" cellspacing="0" bordercolor="#EBECED" class="txt">
                <tr>
                  <td height="20" colspan="2" align="left">转帐后请填写流水号，以方便我们工作人员查询 <a href="/about/about.php?pageid=2" target="_blank" class="link_navi_red">点击查询转帐银行</a> </td>
                  </tr>
                <tr>
                  <td width="18%" height="20" align="right"><em>
                    线下转帐银行流水号</em></td>
                  <td width="82%" align="left"><input name="yhlsh" type="text" class="input_01" id="yhlsh" size="40" /></td>
                </tr>
                </table>
            <? }?>            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" class="txt4">购买的商品</td>
      </tr>
      <tr>
        <td><div  id="cart_boder_02" style="background-color:#FFF"><br />

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    <td width="100%" height="1" colspan="2" align="center" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td bgcolor="#D1D1D1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#D1D1D1">
                            <tr>
                              <td width="14%" height="30" align="center" bgcolor="#FFFFFF"><strong>图片</strong></td>
                              <td width="20%" align="center" bgcolor="#FFFFFF"><strong>商品名称</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF"><strong>销售价格</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF"><strong>正式会员</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF"><strong>数量</strong></td>
                              <td width="11%" align="center" bgcolor="#FFFFFF"><strong>小计</strong></td>
                              </tr>
                       <? $total_sum=0;
					   for($i=0;$i<sizeof($allpid);$i++){
					            
	                            if($allpid[$i]!=''){				   
					          //取出产品
					          $strSQL = "select * from productinfo  where dele='1' and id_prodinfo='$allpid[$i]'  ";
					          $objDB->Execute($strSQL);
					          $sproduct=$objDB->fields();
							  if($_SESSION["aumont".$i]!=''){
							  $total_sum=$total_sum+(($sproduct[price])*$_SESSION["aumont".$i]);
							  }else{
							  $total_sum=$total_sum+($sproduct[price]);
							  }
							  
							  //取出产品图片
							  $strSQL = "select opicname as pic from productpic  where id_prodinfo ='".$allpid[$i]."' 
							             order by id_prodpic asc limit 1" ;
                              $objDB->Execute($strSQL);
                              $arronepic=$objDB->fields();
					   ?>
                            <tr>
                              <td height="70" align="center" bgcolor="#FFFFFF"><a href="pdtspage.php?id=<?=$sproduct[id_s041]?>" target="_blank"><img src="/upload/product/<?=$arronepic[pic]?>" width="50" height="50" border="0" /></a></td>
                              <td align="center" bgcolor="#FFFFFF" class="txt3"><?=$sproduct[title]?></td>
                              <td align="center" bgcolor="#FFFFFF"><div class="txt3" id="ss<?=$i;?>"><?=$sproduct[price]?></div></td>
                              <td align="center" bgcolor="#FFFFFF" class="txt3"><?=round($sproduct[price]*0.9,2);?></td>
                              <td align="center" bgcolor="#FFFFFF">
                                <table width="10" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="10"><input  name="aumont<?=$i;?>" type="text" class="input_01"  style="width:20px;" value="<? if($_SESSION["aumont".$i]!=''){echo $_SESSION["aumont".$i];}else{echo '1';}?>" maxlength="2" id="dj<?=$i;?>" readonly="readonly" /></td>
                                    </tr>
                                </table></td>
                              <td align="center" bgcolor="#FFFFFF"><div class="txt3" id="xj<?=$i;?>"><?=round($sproduct[price]*$_SESSION["aumont".$i]*$_SESSION["payzhekou"],2);?></div></td>
                              </tr>
                            <? }else{
							       continue;    
							   }
							
							}?>
                          </table></td>
                        </tr>
                      </table>
                      <br />
                      <table width="98%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td bgcolor="#D1D1D1"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#D1D1D1">
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF">
                                  <table width="220" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="176" align="right" class="txt4">商品总额：￥</td>
                                      <td width="44" align="left"><div id="sum_total"  class="txt3"><?=round($total_sum*$_SESSION["payzhekou"],2);?></div></td>
                                    </tr>
                                  </table>                                   </td>
                                </tr>
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF"> <table width="220" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="176" align="right" class="txt4">   配送费用：￥</td>
                                      <td width="44" align="left"><div id="wl_fee"  class="txt3"><?=$setinfo[incost];?></div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF"><table width="220" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="176" align="right" class="txt4">   订单总金额：￥</td>
                                      <td width="44" align="left"><div id="total_sumall"  class="txt3"><?=round($total_sum*$_SESSION["payzhekou"],2)+$setinfo[incost];?></div></td>
                                    </tr>
                                  </table></td>
                              </tr>
                              <tr>
                                <td height="30" align="right" bgcolor="#FFFFFF"><input type="submit" name="button2" id="button2" value="提交订单" /></td>
                              </tr>

                          </table></td>
                        </tr>
                      </table><br /></td>
                  </tr>
                  <input type="hidden" name="iswl"  id="iswl" value="<?=$setinfo[incost];?>">
                </table>
              </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table> </form></td>
  </tr>
</table>
         
         <? }?>           </td>
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
