<?php 
/*
add 增加空界面 :01表示
add_s 提交入库：02表示
edit 编辑抽取：03表示
edit_s 编辑提交：04表示
del 删除：05表示
*/
require_once("../inc/config_admin.php");
require_once("../inc/config_perm.php");
require_once("../inc/navipage.php");
$action=$_SERVER["QUERY_STRING"];
if(substr($action,0,5)=='&page'){$action='';}//无动作置空

//部门选择初始值
  $strSQL="SELECT id_dept,dept FROM dept";
  $objDB->Execute($strSQL);
  $arrdept=$objDB->GetRows();

  $gselectdept='<select name="dept" class="input_01">';
  for($i=0;$i<sizeof($arrdept);$i++){
  $gselectdept.='<option value="'.$arrdept[$i][id_dept].'">'.$arrdept[$i][dept].'</option>';
  }
  $gselectdept.='</select>';
//职务选择初始值  
  $strSQL="SELECT id_post,post FROM post";
  $objDB->Execute($strSQL);
  $arrpost=$objDB->GetRows();

  $gselectpost='<select name="post" class="input_01">';
  for($i=0;$i<sizeof($arrpost);$i++){
  $gselectpost.='<option value="'.$arrpost[$i][id_post].'">'.$arrpost[$i][post].'</option>';
  }
  $gselectpost.='</select>';

//职称选择初始值  
  $strSQL="SELECT id_title,title FROM title";
  $objDB->Execute($strSQL);
  $arrtitle=$objDB->GetRows();

  $gselecttitle='<select name="title" class="input_01">';
  for($i=0;$i<sizeof($arrtitle);$i++){
  $gselecttitle.='<option value="'.$arrtitle[$i][id_title].'">'.$arrtitle[$i][title].'</option>';
  }
  $gselecttitle.='</select>';
  

   //取出所有会员信息
  
if(isset($_REQUEST["page"]) ){$intCurPage=$_REQUEST["page"];}else{$intCurPage=1;}

$intRows = 30;
$strSQLNum = "SELECT COUNT(*) as num FROM member WHERE dele='1'";   
$rs = $objDB->Execute($strSQLNum);
$arrNum = $objDB->fields();
$intTotalNum=$arrNum["num"];

$objPage = new PageNav($intCurPage,$intTotalNum,$intRows);

$objPage->setvar($arrParam);
$objPage->init_page($intRows ,$intTotalNum);
$strNavigate = $objPage->output(1);
$intStartNum=$objPage->StartNum(); 

$strSQL = "SELECT * FROM member WHERE dele='1'" ;
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrstaff=$objDB->GetRows();

 
	$user=$_POST[user];
	$password=$_POST[password];
	$name=$_POST[name];//姓名
	$sex=$_POST[sex];//1为男,0为女
	$birthday=$_POST[birthday];//生日
	
	$idcard=$_POST[idcard];//身份证号码
	$dept=$_POST[dept];  //部门
	$post=$_POST[post]; //职务
	$title=$_POST[title]; //职称
	$hrcode=$_POST[hrcode];//会员编号
	
	$iswork=$_POST[iswork];//1在职 0离职
	$ismarry=$_POST[ismarry];//1已婚 0未婚
	$nation=$_POST[nation];//民族
	$native=$_POST[native];//籍贯
	$register=$_POST[register];//户口所在地
	
	$inwork=$_POST[inwork];//进厂时间
	$education=$_POST[education];//学历
	$profession=$_POST[profession];//专业
	$school=$_POST[school];//毕业院校
	$political=$_POST[political];//政治面貌
	
	$address=$_POST[address];//家庭地址
    $hometel=$_POST[hometel];//家庭电话
    $mobi=$_POST[mobi];//手机号码
	$photo=$_POST[photo];//
    $hjqk=$_POST[hjqk];//获奖情况
	
    $cfqk=$_POST[cfqk];//惩罚情况
    $gwbd=$_POST[gwbd];//岗位变动情况
    $ldht=$_POST[ldht];//劳动合同签订情况
	$sbjn=$_POST[sbjn];//社保缴纳情况
    $remark=$_POST[remark];//备注
	
    $delstaff=$_POST[delstaff];//删除会员

    //$level=$_POST[level];//1普通会员

if(isset($action) && $action=="02" && $onuserperm_addprem=='1'){

}

if(isset($action) && substr($action,0,2)=="04" && $onuserperm_editprem=='1'){
     $onestaff=substr($action,2);
     if($delstaff=='1' && $onuserperm_deleprem=='1'){
        $strSQL="delete from member  where id_hr=$onestaff and id_hr!='1'";
		$objDB->Execute($strSQL);//删除人
		
		header('Location:hr_exam.php'); exit();
	 }
	 
     if ( is_uploaded_file( $_FILES['photo']['tmp_name'] ) ){//是否上传照片
        $image_file=upload_file("photo","hrphoto/",mktime());//上传图片
		$pic_path= "hrphoto/".$image_file;//图片路径
	    include_once( '../inc/csmallpic.php' );//缩咯图类
	    CreateThumbnail($pic_path,$pic_path,100,0);//建缩略图
		@unlink('hrphoto/'.$_POST[oldphoto]);
		}else{
		$image_file=$_POST[oldphoto];
		}

		$strSQL="UPDATE member SET     user='$user',
								   password='$password',
								   name='$name',
								   sex='$sex',
								   birthday='$birthday',
								   idcard='$idcard',
								   dept='$dept',
								   post='$post',
								   title='$title',
								   hrcode='$hrcode',
								   iswork='$iswork',
								   ismarry='$ismarry',
								   nation='$nation',
								   native='$native',
								   register='$register',
								   inwork='$inwork',
								   education='$education',
								   profession='$profession',
								   school='$school',
								   political='$political',
								   address='$address',
								   hometel='$hometel',
								   mobi='$mobi',
								   hjqk='$hjqk',
								   cfqk='$cfqk',
								   gwbd='$gwbd',
								   ldht='$ldht',
								   sbjn='$sbjn',
								   remark='$remark',
								   modate=now(),
								   photo='$image_file'
								   where id_hr=$onestaff";
		$objDB->Execute($strSQL);
    	header('Location:hr_exam.php?03'.$onestaff); exit();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $companytitle;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../inc/style_admin.css" rel="stylesheet" type="text/css">
<script src="../inc/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function onclickadd(val1) {//val1＝点击的菜单id，val2判断是一级菜单还是二级菜单
				var addclickid=val1;
					popprompt('输入名称:', '', '请输入要添加名称',addclickid, function(passmessage,onclickid) {
						  if (passmessage) {$.post('ajax_addmenu.php',{passmessage: passmessage,onclickid:onclickid},function(data)                              {
                             var myjson = '';eval('myjson=' + data + ';');
							 if(myjson.type=='txt_adddept'){$("#add_dept").html(myjson.gselectdept);};
							 if(myjson.type=='txt_addpost'){$("#add_post").html(myjson.gselectpost);};
							 if(myjson.type=='txt_addtitle'){$("#add_title").html(myjson.gselecttitle);};
                             popmessage(myjson.info, '友情提醒!'); });
                          };
					});
}

</script>
</head>
<body>
<?php require "../header.php"; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="87.9%">
  <tr> 
    <td width="15%" align="left" valign="top" bgcolor="#E7F1F8">
	<?php require "../leftmenu.php"; ?>
    </td>
    <td width="75%" align="center" valign="top">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="30" align="right"></td>
      </tr>
    </table>
    <?php if(isset($action) && $action==''){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">会员档案</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="4" class="txt">
            <tr bgcolor="#F5F5F5">
              <td align="left">用户名 / 密码 / 姓名 </td>
              <td align="left">地址 / 电话</td>
              <td align="left">当前折扣</td>
              <td align="left">会员状态</td>
              <td width="128" align="left" bgcolor="#F5F5F5">&nbsp;</td>
              </tr>
            <tr bgcolor="#CCCCCC">
              <td height="2" colspan="5"></td>
              </tr>
            <? 
			  for($i=0;$i<sizeof($arrstaff);$i++)
			  {
			  ?>
            <tr onMouseOver="setPointer(this, <?=$i;?>, 'over', '#FFFFFF', '#FAFFE8', '#FFEEDD');" onMouseOut="setPointer(this, <?=$i;?>, 'out', '#FFFFFF', '#FAFFE8', '#FFEEDD');" onMouseDown="setPointer(this, <?=$i;?>, 'click', '#FFFFFF', '#FAFFE8', '#FFEEDD');"> 
              <td width="210" align="left"><? echo $arrstaff[$i][user];?> / <? echo $arrstaff[$i][password ];?> / <? echo $arrstaff[$i][name];?></td>
              <td width="254" align="left"><? echo $arrstaff[$i][address];?> / <? echo $arrstaff[$i][mobi];?></td>
              <td width="86" align="left"><? if($arrstaff[$i][iswork]==1){echo '无';}if($arrstaff[$i][iswork]==2){echo '9折';}?></td>
              <td width="85" align="left"><? if($arrstaff[$i][iswork]==1){echo '预备会员';}if($arrstaff[$i][iswork]==2){echo '正式会员';}?></td>
              <td align="right">
                <? if($onuserperm_browse==1){?>
                <a href='hr_exam.php?03<?php echo $arrstaff[$i][id_member]?>' class="link_leftmenub">查看</a>
                <? }else{?>
                <span class="txt_3">查看</span>
                <? }?></td>
              </tr>
            <tr bgcolor="#F5F5F5">
              <td height="1" colspan="5"></td>
              </tr>	  
            <? }?>
            </table>
            
            </td>
        </tr>
        <tr>
          <td align="center"><?php echo $strNavigate;?></td>
        </tr>
      </table>
	</div>  
<?php }?>
<?php if(isset($action) && $action=='01' && $onuserperm_addprem=='1'){?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">添加新会员档案</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                <form action="hr_exam.php?02" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">姓名</td>
                    <td width="167" bgcolor="#FFFFFF"><input type="text" name="name" value="" style="width:150px" class="input_01" id="name" /></td>
                    <td width="69" valign="top" bgcolor="#FFFFFF">电话</td>
                    <td width="162" bgcolor="#FFFFFF"><input type="text" name="hrcode" value="" style="width:150px" class="input_01" id="hrcode" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">用户名</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="user" value="" style="width:150px" class="input_01" id="user" /></td>
                    <td valign="top" bgcolor="#FFFFFF">密码</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="password" value="" style="width:150px" class="input_01" id="password" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">地址</td>
                    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="idcard" value="" style="width:350px" class="input_01" id="idcard" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td colspan="3" bgcolor="#FFFFFF">
                      <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />
                      <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_exam.php'" />
                      </td>
                  </tr>
                </form>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <?php }?>
 <?php if(isset($action) && substr($action,0,2)=='03'){
   //取出某个会员
   $onestaff=substr($action,2);
   $strSQL="SELECT * FROM member WHERE id_member=$onestaff";
   $objDB->Execute($strSQL);
   $personal=$objDB->fields();
   
$strSQL="select * from s212 WHERE id_member=$onestaff  order by id_s212 desc";
$objDB->SelectLimit($strSQL,$intRows,$intStartNum);
$arrOrder = $objDB->GetRows();
$intarrOrder=sizeof($arrOrder);
   

 ?>
	<div id="lineout">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="36" align="left" background="../inc/pics/lanmubg.gif"><table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="32">&nbsp;</td>
              <td width="15"><img src="../inc/pics/lm_icon.gif" width="10" height="7"></td>
              <td width="153" class="txt_lanmu">查看/编辑会员档案</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="93%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="30" align="left" valign="bottom" class="txt_leftmenu"><table width="100%" border="0" cellpadding="4" cellspacing="0" class="txt">
                <form action="hr_exam.php?04<?php echo $personal[id_hr];?>" method="post" enctype="multipart/form-data" name="form" id="form"  onsubmit="return OnCheck(this);" >
                <input type="hidden" name="oldphoto" value="<?php echo $personal[photo];?>">
                  <tr bgcolor="#FFFFFF">
                    <td width="91" valign="top" bgcolor="#FFFFFF">姓名</td>
                    <td width="167" bgcolor="#FFFFFF"><input type="text" name="name" value="<?php echo $personal[name];?>" style="width:150px" class="input_01" id="name" /></td>
                    <td width="69" valign="top" bgcolor="#FFFFFF">电话</td>
                    <td width="162" bgcolor="#FFFFFF"><input type="text" name="hrcode" value="<?php echo $personal[hrcode];?>" style="width:150px" class="input_01" id="hrcode" /></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">用户名</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="user" value="<?php echo $personal[user];?>" style="width:150px" class="input_01" id="user" /></td>
                    <td valign="top" bgcolor="#FFFFFF">密码</td>
                    <td bgcolor="#FFFFFF"><input type="text" name="password" value="<?php echo $personal[password];?>" style="width:150px" class="input_01" id="password" /></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">当前折扣</td>
                    <td colspan="3" bgcolor="#FFFFFF">无</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">地址</td>
                    <td colspan="3" bgcolor="#FFFFFF"><input type="text" name="idcard2" value="" style="width:350px" class="input_01" id="idcard2" /></td>
                    </tr>
                  <?php if($onuserperm_deleprem=='1' and $personal[id_hr]!='1'){?>
                  <?php }?>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td valign="top" bgcolor="#FFFFFF">订单记录</td>
                    <td colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td colspan="4" valign="top" bgcolor="#CCCCCC" style="padding:0; height:1px;"></td>
                    </tr>
                  <tr bgcolor="#FFFFFF">
                    <td colspan="4" align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC" class="txt">
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
                <td align="left" valign="middle"  ><?=$arrOrder[$i][s212_01_03];?></td>
                <td align="left" valign="middle"  ><?=$arrOrder[$i][s212_01_02];?></td>
                <td align="left"  ><?=$arrOrder[$i][s212_01_04];?>/<?=$arrOrder[$i][s212_01_05];?></td>
                <td align="left"  ><? if($arrOrder[$i][s212_01_07]==1){echo '支付宝';}?><? if($arrOrder[$i][s212_01_07]==2){echo 'PALPAY';}?><? if($arrOrder[$i][s212_01_07]==3){echo '线下现金';}?></td>
                <td align="left"  ><?=$arrOrder[$i][s212_01_10];?>/<a href="/admin/product/salseinfo.php?id=<?=$arrOrder[$i][id_s212];?>" target="_blank" class="link_leftmenu">查看明细</a></td>
              </tr>
			  <tr bgcolor="#F5F5F5">
                <td colspan="6" height="1"></td>
              </tr>
              <? }?>
              <tr>
                <td colspan="7" align="right"><?=$strNavigate;?></td>
              </tr>
      </table></td>
                  </tr>
                  <tr bgcolor="#FFFFFF">
                    <td colspan="4" align="left" valign="top" bgcolor="#FFFFFF">
                      <?php if($onuserperm_editprem=='1'){?>
                      <!-- <input class="btn" type="submit" name="button_ok" id="button_ok" value="提交" />-->
                      <input class="btn" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:history.go(-1);" /><?php }else{?>
                      <input class="btn" disabled="disabled" type="submit" name="button_ok" id="button_ok" value="提交" />
                      <input class="btn" disabled="disabled" type="button" name="button_back2" id="button_back2" value="返回" onclick="javascript:location.href='hr_exam.php'" /><?php }?>                    </td>
                    </tr>
                </form>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
	</div>  
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
 <?php }?>	  
 
 </td>
  </tr>
</table>

<?php require "../footer.php"; ?>
</body>
</html>

