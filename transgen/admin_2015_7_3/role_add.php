<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('43',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";

        $role_name = getParam('role_name','POST');

         $sql = "insert into `".$dbpre."role` (role_name) values ('$role_name')";
        if (mysql_query($sql, $conn)) {
            echo "<script>alert('添加成功');window.location.href='role_add.php'</script>";
        } else {
            echo "<script>alert('添加失败');window.location.href='javascript:history.go(-1)'</script>";
        }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CPWEB</title>
    <LINK rel=stylesheet type=text/css href="css/common.css">
    <LINK rel=stylesheet type=text/css href="css/default.css">
    <SCRIPT language="JavaScript">
        function checkform(o) {
            if (o.role_name.value == "") {
                alert("请填写角色名称");
                o.role_name.focus();
                return false;
            }
            return true;
        }
    </SCRIPT>
</head>
<body>
<DIV class="Listbox">
    <DIV class="ListTit">角色添加</DIV>
    <DIV class="ListfBox">
        <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="13%" height="40" align="center" class="bline">角色名称</td>
                    <td width="87%" align="left" class="bline"><input name="role_name" type="text"
                                                                      id="role_name" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td height="60" align="center">&nbsp;</td>
                    <td align="left">
                        <input type="submit" name="Submit" value="添加角色" class="bn2"/></td>
                </tr>
            </table>
      </form>
    </DIV>
</DIV>
</body>
</html>