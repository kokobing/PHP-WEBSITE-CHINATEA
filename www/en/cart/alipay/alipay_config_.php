<?php

$mainname="上海钱币礼品网";    //网站名称

$seller_email = "xiaoge8859@hotmail.com";//卖家邮箱
$security_code = "yy62vgl50fnwyp4bzv1v5xt26hm4nmzi";//安全检验码
$partner = "2088002070198142";//合作伙伴ID

$_input_charset = "utf-8"; //字符编码格式  目前支持 GBK 或 utf-8
$sign_type = "MD5"; //加密方式  系统默认(不要修改)
$transport= "https";//访问模式,你可以根据自己的服务器是否支持ssl访问而选择http以及https访问模式(系统默认,不要修改)
$return_url     = "http://#/cart/cart3.php?act=orderinalipayed"; //付完款后跳转的页面 要用 http://格式的完整路径

/** 提示：如何获取安全校验码和合作ID
' 登陆到www.alipay.com 后,点商家服务,进去后可以看到 key 和partner
*/
?>