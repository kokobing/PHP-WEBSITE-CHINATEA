<?php
//左侧四个广告
$strSQL = "select opicname,url from layoutpic where id_layout='18' order by id_layoutpic asc" ;
$objDB->Execute($strSQL);
$leftdownadv_QJ=$objDB->getrows();

//热销商品
$strSQL = "select opicname,url from layoutpic where id_layout='19' order by id_layoutpic asc" ;
$objDB->Execute($strSQL);
$leftdownadv2_QJ=$objDB->getrows();
?>


<div id="maincontent1pic">  
  <!--JS脚本1--开始-->
            <script type="text/javascript">
			var imag=new Array();
			var link=new Array();
			var text=new Array();
			
						imag[1]	= "/upload/layout/<?=$leftdownadv_QJ[0][opicname]?>";
						link[1]	= escape("<?=$leftdownadv_QJ[0][url]?>");
						text[1]	= "";
			
						imag[2]	= "/upload/layout/<?=$leftdownadv_QJ[1][opicname]?>";
						link[2]	= escape("<?=$leftdownadv_QJ[1][url]?>");
						text[2]	= "";
			
						imag[3]	= "/upload/layout/<?=$leftdownadv_QJ[2][opicname]?>";
						link[3]	= escape("<?=$leftdownadv_QJ[2][url]?>");
						text[3]	= "";
			
						imag[4]	= "/upload/layout/<?=$leftdownadv_QJ[3][opicname]?>";
						link[4]	= escape("<?=$leftdownadv_QJ[3][url]?>");
						text[4]	= "";


			 var focus_width=228
			 var focus_height=210
			 
			 var text_height=0
			 var swf_height = focus_height+text_height
			 
			 var pics="", links="", texts="";
			 for(var i=1; i<imag.length; i++){
				if (pics != "")
				{
					pics=pics+("|"+imag[i]);
					links=links+("|"+link[i]);
					texts=texts+("|"+text[i]);
				}
				else
				{
					pics=imag[i];
					links=link[i];
					texts=text[i];
				}
			 }
			 
			 document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">');
			 document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="focus.swf"><param name="quality" value="high"><param name="bgcolor" value="ffffff">');
			 document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
			 document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
			 document.write('</object>');
			 </script>
            <!--JS脚本1--结束-->
</div>
<div id="hot_product">  
<div id="hot_producttitle">Hot sale</div>
<div name="pic" style="float:left; position:relative;overflow:hidden; margin-left:15px; margin-top:10px;" > 
<div><a href="<?=$leftdownadv2_QJ[0][url];?>" target="_blank"><img  src="/upload/layout/<?=$leftdownadv2_QJ[0][opicname];?>" alt="1" width="228" height="214" border="0"/></a></div> 
<div><a href="<?=$leftdownadv2_QJ[1][url];?>" target="_blank"><img  src="/upload/layout/<?=$leftdownadv2_QJ[1][opicname];?>" alt="2" width="228" height="214" border="0"/></a></div> 
<div><a href="<?=$leftdownadv2_QJ[2][url];?>" target="_blank"><img  src="/upload/layout/<?=$leftdownadv2_QJ[2][opicname];?>" alt="3" width="228" height="214" border="0"/></a></div> 
</div></div>

<div id="qqmsn">  
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
  <tr>
    <td><a href="msnim:chat?contact=chiantealand@hotmail.com"><img src="/inc/pics/msn.gif" width="30" height="30" border="0" /></a></td>
    <td><a href="msnim:chat?contact=chiantealand@hotmail.com" class="link_navi_qqmsn">MSN</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><a href="tencent://message/?uin=1821200979&amp;Site=ty-sh.com&amp;Menu=yes"><img src="/inc/pics/qq.gif" width="30" height="26" border="0" /></a></td>
    <td><a href="tencent://message/?uin=1821200979&amp;Site=ty-sh.com&amp;Menu=yes" class="link_navi_qqmsn">QQ</a></td>
    <td><a href="tencent://message/?uin=2504298444&amp;Site=ty-sh.com&amp;Menu=yes"><img src="/inc/pics/qq.gif" width="30" height="26" border="0" /></a></td>
    <td><a href="tencent://message/?uin=2504298444&amp;Site=ty-sh.com&amp;Menu=yes" class="link_navi_qqmsn">QQ</a></td>
    </tr>
</table>

</div>

