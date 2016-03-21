<?php
include_once("config.php");
$OrderId=$_REQUEST["P_OrderId"];
$CardId=$_REQUEST["P_CardId"];
$CardPass=$_REQUEST["P_CardPass"];
$FaceValue=$_REQUEST["P_FaceValue"];
$ChannelId=$_REQUEST["P_ChannelId"];

$subject=$_REQUEST["P_Subject"];
$description=$_REQUEST["P_Description"]; 
$price=$_REQUEST["P_Price"];
$quantity=$_REQUEST["P_Quantity"];
$notic=$_REQUEST["P_Notic"];
$ErrCode=$_REQUEST["P_ErrCode"];
$PostKey=$_REQUEST["P_PostKey"];
$payMoney=$_REQUEST["P_PayMoney"];

$preEncodeStr=$UserId."|".$OrderId."|".$CardId."|".$CardPass."|".$FaceValue."|".$ChannelId."|".$SalfStr;

$encodeStr=md5($preEncodeStr);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>返回支付结果页面</title>
<link rel="stylesheet" href="images/app_style.css"  type="text/css" />
</head>
<body>
<div id="wrap">
<table width="100%" height="34" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px">
  <tr>
    <td width="33%"><img src="images/logo-pay.jpg" /></td>
	<td width="68%" valign="bottom"><span class="logotxt">支付结果</span></td>
  </tr>
</table>

<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" class="mytable">
  <tr>
    <td width="100%" height="88" bgcolor="#FFFFFF"><br />
	
      	<table width="500" border="0" align="center" cellpadding="1" cellspacing="1" class="table_main">
           <tr>
            <td height="25" align="right" class="STYLE1">订单号：</td>
            <td><span class="STYLE2"><?=$OrderId?></span></td>
          </tr>
          <tr>
            <td height="25" align="right" class="STYLE1">提交金额：</td>
            <td><span class="STYLE2"><?=$FaceValue?></span></td>
          </tr>
          <tr>
            <td height="25" align="right" class="STYLE1">实际充值金额：</td>
            <td><span class="STYLE2"><?=$payMoney?></span></td>
          </tr>
          <tr>
            <td height="25" align="right" class="STYLE1">状态：</td>
            <td height="25"><? if($PostKey==$encodeStr)
{
	if($ErrCode=="0") //支付成功
	{
		echo "支付成功";
		//设置为成功订单,主意订单的重复处理
	}
	else
	{
		//支付失败
		echo "支付失败";
	}
}
else
{
	echo "数据被传改";
}
?></td>
          </tr>
      </table>
      <br /></td>
  </tr>
</table>
</div>
</body>
</html>

