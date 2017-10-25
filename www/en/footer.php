<?php
//页脚
$strSQL = "select content from layout  where id_layout='14'" ;
$objDB->Execute($strSQL);
$footer_BQ=$objDB->fields();

//流量统计
$strSQL = "select content from layout  where id_layout='15'" ;
$objDB->Execute($strSQL);
$fangwentongji=$objDB->fields();
?>
<div id="footer"><?=$footer_BQ[content];?></div>
<div id="count"><img src="/inc/pics/lzlogo2.gif" /> <?=$fangwentongji[content];?></div>