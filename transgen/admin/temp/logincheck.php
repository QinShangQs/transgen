<?php

    require '../config.inc.php';
    header('Content-Type: text/html; charset=utf-8');
    $username = lib_replace_end_tag(trim($_POST['txt_UserName']));
    $password = lib_replace_end_tag(md5(trim($_POST['txt_Password'])));
    $txt_YanCode = strtolower(lib_replace_end_tag(trim($_POST['txt_YanCode'])));
    /*if ($txt_YanCode != $_SESSION['code']) {
        echo ("<script type='text/javascript'>alert('验证码输入不正确!');history.back(-1);</script>");
        exit;
    }*/
    $queryuser = mysql_query("select id,adminusername,adminpassword,role_id from `admin` where adminusername='" . $username . "' and adminpassword='" . $password . "'", $conn);
    $rowuser = mysql_fetch_array($queryuser);
    if ($rowuser && is_array($rowuser) && !empty($rowuser)) {
        if ($rowuser['adminusername'] == $username && $rowuser['adminpassword'] == $password) {
            if ($rowuser['adminpassword'] == $password) {
                session_start();
                $_SESSION['adminuser'] = $rowuser['adminusername'];
                $_SESSION['adminid'] = $rowuser['id'];
				$_SESSION['role_id'] = $rowuser['role_id'];
                echo "<script>location.href='admin_main.php';</script>";
            } else {
                echo "<script language='javascript'>alert('密码错误！');location.href='index.php';</script>";
            }
        } else {
            echo "<script language='javascript'>alert('用户名不存在！');location.href='index.php';</script>";
        }
    } else {
        echo "<script language='javascript'>alert('用户名密码错误！');location.href='index.php';</script>";
    }
?>
