<?php
    header('Content-Type: text/html; charset=utf-8');
    //检测是否登录
    if ($_SESSION['adminuser']=="" || $_SESSION['adminid']=="")
    {
        echo '<script type="text/javascript">window.top.location.href="/";</script>';
        exit();
    }
?>