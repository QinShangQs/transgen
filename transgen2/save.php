<?php
require 'config.inc.php';
header('Content-Type: text/html; charset=utf-8');

$action = $_GET['action'];

//客户留言
if ($action == 'addreg') {
    $username = getParam('username', 'POST');
	$password = md5(getParam('password', 'POST'));
    $mobile   = getParam('mobile', 'POST');
    $email    = getParam('email', 'POST');
    $realname    = getParam('realname', 'POST');
    $address    = getParam('address', 'POST');
	$checks =strtolower(getParam('checks', 'POST'));

    if ($username == '' || $password == '' || $mobile == '' || $email == '') {
        echo "<script>alert('信息填写不完整，请重新填写');parent.location.href='index.html'</script>";
        exit();
    }
	
	//判断验证码是否正确
        if ($_SESSION ['code'] != $checks) {
            echo "<script language='javascript'>alert('验证码不对！');parent.location.href='index.html'</script>";
            exit();
        }

    $sql = "INSERT INTO `".$dbpre."member` (username, password, mobile, email, realname, address, addtime) VALUES ('$username', '$password', '$mobile', '$email', '$realname', '$address', '".time()."')";
	if (mysql_query($sql, $conn)) {
	
			session_start ();			
			$_SESSION['username'] = $username;
		
		$sqlor = "update `".$dbpre."cartemp` set username='".$username."', flag=1 where dingdanhao='".$_COOKIE['dingdanhao']."'";
		mysql_query($sqlor, $conn);
		
		
		//会员基本信息
$info = "姓名：".$realname.", 电话：".$mobile.", 邮箱：".$email.", 地址：".$address."";

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
			$mail->Username = $mailuserorder;			// SMTP用户名
			$mail->Password = $mailpass;				// SMTP密码
			
			$mail->From = $mailuserorder;			//发件人地址
			$mail->FromName = "全式金官网的订单信息";				//发件人
			$mail->AddAddress($mailuserproduct, "全式金官网的订单信息");	//添加收件人
			$mail->AddAddress($mailuserproduct);
			$mail->AddReplyTo($email, "Information");	//回复地址
			$mail->WordWrap = 50;					//设置每行字符长度
			/** 附件设置
			$mail->AddAttachment("/var/tmp/file.tar.gz");		// 添加附件
			$mail->AddAttachment("/tmp/image.jpg", "new.jpg");	// 添加附件,并指定名称
			*/
			$mail->IsHTML(true);					// 是否HTML格式邮件
			$mail->Charset='UTF-8';
			$mail->Subject = "订单信息+".$realname."+".$mobile;			//邮件主题
			$mail->Body    = $b;		//邮件内容
			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	//邮件正文不支持HTML的备用显示
			$mail->Send();
			setcookie("dingdanhao","");
		
		
		
        echo "<script>alert('订单提交成功，我们会尽快联系您');parent.location.href='index.html'</script>";
        exit();
    }
    else {
        echo "<script>alert('订单提交失败,请重新提交');parent.location.href='shop.html'</script>";
        exit();
    }
}


//会员 登录
if ($action == 'login') {
	
	$username = getParam('text_username', 'POST');
	$password = md5(getParam('text_password', 'POST'));
	$checks =strtolower(getParam('checks', 'POST'));
	
    if ($username == '' || $password == '' || $checks == '') {
       echo "<script>alert('信息填写不完整，请重新填写');parent.location.href='index.html'</script>";
        exit();
    }
	
	//判断验证码是否正确
        if ($_SESSION ['code'] != $checks) {
            echo "<script language='javascript'>alert('验证码不对！');parent.location.href='index.html'</script>";
            exit();
    }
	
	
	$queryuser = mysql_query ("select id,username,password from `".$dbpre."member` where username='" . $username . "' and password='" . $password . "'");
$rowuser = mysql_fetch_array ( $queryuser );
if ($rowuser && is_array ( $rowuser ) && ! empty ( $rowuser )) {
	if ($rowuser ['username'] == $username && $rowuser ['password'] == $password) {
		if ($rowuser ['password'] == $password) {
			
			session_start ();			
			$_SESSION['userid'] = $rowuser['id'];
			$_SESSION['username'] = $rowuser['username'];
			
						
			$sqlor = "update `".$dbpre."cartemp` set username='".$username."', flag=1 where dingdanhao='".$_COOKIE['dingdanhao']."'";
			mysql_query($sqlor, $conn);	
			
//查询会员基本信息
$sql = mysql_query("select * from `".$dbpre."member` where id='".$rowuser['id']."'",$conn);
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
			$mail->Username = $mailuserorder;			// SMTP用户名
			$mail->Password = $mailpass;				// SMTP密码
			
			$mail->From = $mailuserorder;			//发件人地址
			$mail->FromName = "全式金官网的订单信息";				//发件人
			$mail->AddAddress($mailuserproduct, "全式金官网的订单信息");	//添加收件人
			$mail->AddAddress($mailuserproduct);
			$mail->AddReplyTo($rsinfo['email'], "Information");	//回复地址
			$mail->WordWrap = 50;					//设置每行字符长度
			/** 附件设置
			$mail->AddAttachment("/var/tmp/file.tar.gz");		// 添加附件
			$mail->AddAttachment("/tmp/image.jpg", "new.jpg");	// 添加附件,并指定名称
			*/
			$mail->IsHTML(true);					// 是否HTML格式邮件
			$mail->Charset='UTF-8';
			$mail->Subject = "订单信息+".$rsinfo['realname']."+".$rsinfo['mobile'];			//邮件主题
			$mail->Body    = $b;		//邮件内容
			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	//邮件正文不支持HTML的备用显示
			$mail->Send();
			setcookie("dingdanhao","");
			
			
			 echo "<script>alert('订单提交成功，我们会尽快联系您');parent.location.href='index.html'</script>";
			exit;
			
		} else {
			echo "<script language='javascript'>alert('密码错误！');parent.location.href='index.html'</script>";
		}
	} else {
		echo "<script language='javascript'>alert('用户名不存在！');parent.location.href='index.html'</script>";
	}
} else {
	echo "<script language='javascript'>alert('用户名密码错误！');parent.location.href='index.html'</script>";
}
	
    
}

//登录之后的提交
if ($action == 'oklogin') {
	
	$username = getParam('username', 'POST');
	$sqlor = "update `".$dbpre."cartemp` set username='".$username."', flag=1 where dingdanhao='".$_COOKIE['dingdanhao']."'";
	mysql_query($sqlor, $conn);
	
	
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
			$mail->Username = $mailuserorder;			// SMTP用户名
			$mail->Password = $mailpass;				// SMTP密码
			
			$mail->From = $mailuserorder;			//发件人地址
			$mail->FromName = "全式金官网的订单信息";				//发件人
			$mail->AddAddress($mailuserproduct, "全式金官网的订单信息");	//添加收件人
			$mail->AddAddress($mailuserproduct);
			$mail->AddReplyTo($rsinfo['email'], "Information");	//回复地址
			$mail->WordWrap = 50;					//设置每行字符长度
			/** 附件设置
			$mail->AddAttachment("/var/tmp/file.tar.gz");		// 添加附件
			$mail->AddAttachment("/tmp/image.jpg", "new.jpg");	// 添加附件,并指定名称
			*/
			$mail->IsHTML(true);					// 是否HTML格式邮件
			$mail->Charset='UTF-8';
			$mail->Subject = "订单信息+".$rsinfo['realname']."+".$rsinfo['mobile'];			//邮件主题
			$mail->Body    = $b;		//邮件内容
			$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	//邮件正文不支持HTML的备用显示
			$mail->Send();
			setcookie("dingdanhao","");
	
	echo "1";
	
}


//人才招聘
if ($action == 'jobadd') {
	
	$ypgz = getParam('ypgz', 'POST');
	$realname = getParam('realname', 'POST');
	$sex = getParam('sex', 'POST');
	$zhiwei = getParam('zhiwei', 'POST');
	$xuelei = getParam('xuelei', 'POST');
	$nianxian = getParam('nianxian', 'POST');
	$tel = getParam('tel', 'POST');
	$email = getParam('email', 'POST');
	$checks =strtolower(getParam('checks', 'POST'));
	$zip = $_FILES["down"];

    //判断上传文件格式
            $pass_type = array(
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
				'application/msword',
				'application/kswps'
            );

            if(!in_array($zip["type"],$pass_type))
            {
                echo "<script>alert('只能上传docx, doc格式的文件');history.go(-1);</script>";
                exit;
            }

            //上传保存的路径
            if (!is_dir("attached/down"))
            {
                mkdir("attached/down");
            }

            $filename = $zip['name'];
            $fileEx = strtolower(substr(strrchr($filename,"."),1));

            $path = "attached/down/" . md5(time()) . "." . $fileEx;
            move_uploaded_file($zip["tmp_name"], $path);
	
    if ($realname == '' || $zhiwei == '' || $tel == '' || $email == '') {
        echo "<script>alert('信息填写不完整，请重新填写');history.go(-1);</script>";
        exit();
    }
	
	//判断验证码是否正确
	if ($_SESSION ['code'] != $checks) {
		echo "<script language='javascript'>alert('验证码不对！');history.go(-1);</script>";
		exit();
	}

    $sql = "INSERT INTO `".$dbpre."jobjianli` (realname, sex, zhiwei, xuelei, nianxian, tel, email, down, addtime) VALUES ('$realname', '$sex', '$zhiwei', '$xuelei', '$nianxian', '$tel', '$email', '$path', '".time()."')";
	
	$b = "姓名：".$realname."<br>性别：".$sex."<br>申请职位：".$zhiwei."<br>学历：".$xuelei."<br>工作年限：".$nianxian."<br>手机号码：".$tel."<br>邮箱：".$email."";
	
	if (mysql_query($sql, $conn)) {
	
	//发邮件
	date_default_timezone_set('Asia/Shanghai');//'Asia/Shanghai' 亚洲/上海
	require_once('class.phpmailer.php');
	require_once('class.smtp.php');
	$mail = new PHPMailer();
	
	$mail->IsSMTP();					// 启用SMTP
	$mail->Host = $mailhost;			//SMTP服务器
	$mail->SMTPAuth = true;					//开启SMTP认证
	$mail->Username = $mailuserbjhr;			// SMTP用户名
	$mail->Password = $mailpass;				// SMTP密码
	
	$mail->From = $mailuserbjhr;			//发件人地址
	$mail->FromName = "全式金官网投的简历";				//发件人
	$mail->AddAddress($mailbjhr, "人事经理");	//添加收件人
	$mail->AddAddress($mailbjhr);
	$mail->AddReplyTo($email, $realname);	//回复地址
	$mail->WordWrap = 50;					//设置每行字符长度
	//附件设置
	$mail->AddAttachment($path, $realname.".".$fileEx);	// 添加附件,并指定名称
	
	$mail->IsHTML(true);					// 是否HTML格式邮件
	$mail->Charset='UTF-8';
	$mail->Subject = $realname."+".$sex."+申请：".$zhiwei."+".$xuelei;			//邮件主题
	$mail->Body    = $b;		//邮件内容
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	//邮件正文不支持HTML的备用显示
	$mail->Send();
	
	echo "<script>alert('简历提交成功，请等待人事经理通知面试！');window.location.href='index.html'</script>";
    exit();
	
	}else{
		echo "<script>alert('简历提交失败，请重新提交!');window.location.href='javascript:history.go(-1)'</script>";
        exit();
	}
	
}

//无条件返回
else {
    header("location:index.html");
    exit();
}
?>