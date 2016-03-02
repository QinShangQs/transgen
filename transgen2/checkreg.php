<?php
    header('Content-Type:text/html;charset=utf-8');//避免输出乱码
    include('config.inc.php');//包含数据库基本配置信息
    $username = $_REQUEST["username"];

    if($username == ""){
        echo "用户名不能为空！";
        return;
    }
    $querysql="select username from `".$dbpre."member` where username='".$username."'";
    $result=mysql_query($querysql,$conn);
    $rows=mysql_num_rows($result);

    if($rows > 0){
        echo "用户名已存在，请重新填写！";
    }else{
        echo "success";
    }
?>
