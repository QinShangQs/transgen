<?php
    header('Content-Type:text/html;charset=utf-8');//避免输出乱码
    include('../config.inc.php');//包含数据库基本配置信息
    $name = $_REQUEST["name"];
    $id = $_REQUEST["id"];

    if($name == ""){
        echo "目录名不能为空！";
        return;
    }
    if($id){
        $querysql="select id,name from `".$dbpre."product` where name='".$name."' and id!='".$id."'";
    }else{
        $querysql="select name from `".$dbpre."product` where name='".$name."'";
    }
    $result=mysql_query($querysql,$conn);
    $rows=mysql_num_rows($result);

    if($rows > 0){
        echo "目录名重复，请重新填写！";
    }else{
        echo "success";
    }
?>
