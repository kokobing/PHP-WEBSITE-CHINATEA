<?php
//页脚
$strSQL = "select content from layout  where id_layout='16'" ;
$objDB->Execute($strSQL);
$partner_qj=$objDB->fields();
?>
<div id="partner_qj_box">
<div id="partner_qj">
<?=$partner_qj[content];?>
</div>
</div>