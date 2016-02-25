<?php
require 'config.inc.php';
header('Content-Type: text/html; charset=utf-8');


//登录之后的提交
$username = getParam('username', 'POST');

	//查询会员基本信息
$sql = mysql_query("select * from `".$dbpre."member` where username='".$username."'",$conn);
$rsinfo = mysql_fetch_array($sql);

$info = "姓名：".$rsinfo['realname'].", 电话：".$rsinfo['mobile'].", 邮箱：".$rsinfo['email'].", 地址：".$rsinfo['address']."";

//查询购物车产品信息
$sqlpro = "select a.sp_id,a.suliang,a.price,a.dingdanhao,b.id,b.name,b.guige from `".$dbpre."cartemp` as a left join `".$dbpre."product` as b on a.sp_id=b.id where username='".$username."' and dingdanhao='".$_COOKIE['dingdanhao']."'";
$sqlquery = mysql_query($sqlpro,$conn);

$c="<li><span style='float:left; width:200px; display:block;'>目录名</span><span style='float:left; width:200px; display:block;'>数量</span><span style='float:left; width:200px; display:block;'>规格</span></li>";		
while($rspro = mysql_fetch_array($sqlquery)){
$a .= "<li><span style='float:left; width:200px; display:block;'>".$rspro['name']."</span><span style='float:left; width:200px; display:block;'>".$rspro['suliang']."</span><span style='float:left; width:200px; display:block;'>".$rspro['guige']."</span></li>";	
}
$b .= <<<EOD
$info<br><ul>$c$a</ul>
EOD;
			
//发邮件
date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
require_once('class.phpmailer.php');
require_once('class.smtp.php');
$mail = new PHPMailer();

$mail->IsSMTP();					// 启用SMTP
$mail->Host = $mailhost;			//SMTP服务器
$mail->SMTPAuth = true;					//开启SMTP认证
$mail->Username = $mailuser;			// SMTP用户名
$mail->Password = $mailpass;				// SMTP密码

$mail->From = $mailuser;			//发件人地址
$mail->FromName = "订单信息";				//发件人
$mail->AddAddress($mailuserproduct, "订单信息");	//添加收件人
$mail->AddAddress($mailuserproduct);
$mail->AddReplyTo($mailuserproduct, "Information");	//回复地址
$mail->WordWrap = 50;					//设置每行字符长度

$mail->IsHTML(true);					// 是否HTML格式邮件
$mail->Charset='UTF-8';
$mail->Subject = "订单信息";			//邮件主题
$mail->Body    = $b;		//邮件内容
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	//邮件正文不支持HTML的备用显示
if($mail->Send())
{
	$sqlor = "update `".$dbpre."cartemp` set username='".$username."', flag=1 where dingdanhao='".$_COOKIE['dingdanhao']."'";
	mysql_query($sqlor, $conn);

setcookie("dingdanhao","");
echo "1";
exit;
}else{
echo "0";
}
?>
