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
        echo "<script>alert('注册成功');parent.location.href='index.html'</script>";
        exit();
    }
    else {
        echo "<script>alert('注册失败');parent.location.href='index.html'</script>";
        exit();
    }
}


//会员 登录
if ($action == 'login') {
	
	$username = getParam('text_username', 'POST');
	$password = md5(getParam('text_password', 'POST'));
	$checks =strtolower(getParam('checks', 'POST'));
	
    if ($username == '' || $password == '' || $checks == '') {
       echo "<script>alert('信息填写不完整，请重新填写');parent.location='index.html'</script>";
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
			
			 echo "<script>parent.location.href='index.html'</script>";
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



//无条件返回
else {
    header("location:index.html");
    exit();
}
?>