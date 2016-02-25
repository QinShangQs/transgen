<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$_SESSION['userid'] = "";
$_SESSION['username'] = "";
setcookie("dingdanhao","");
session_destroy();
echo "<script language='javascript'>location.href='/';</script>";
?>