<?php
//BANNER图
$strSQL = "select opicname as pic from layoutpic  where id_layout='10' order by id_layoutpic asc" ;
$objDB->Execute($strSQL);
$Banner_QJ=$objDB->GetRows();
?>
<div name="pic" style="position:relative;overflow:hidden;" > 
<? for($i=0;$i<sizeof($Banner_QJ);$i++){?>
<div ><img  src="/upload/layout/<?=$Banner_QJ[$i][pic];?>" /></div> 
<? }?>
</div> 