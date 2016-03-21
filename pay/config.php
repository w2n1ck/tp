<?php
header( "content-type:text/html; charset=gbk" );
date_default_timezone_set('PRC');
$UserId="1000718";
$SalfStr="3d5229d8eef94c24bb233fbb253009cc";
$gateWary="http://Api.Duqee.Com/pay/Bank.aspx";
$result_url="http://".$_SERVER["HTTP_HOST"]."/pay/result_url.php";
$notify_url="http://".$_SERVER["HTTP_HOST"]."/pay/notify_Url.php";
?>