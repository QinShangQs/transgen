<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $_SESSION['adminuser']="";
    $_SESSION['adminid']="";
    echo "<script language='javascript'>alert('您已安全退出！');location.href='../';</script>";
    //注销登录
?>