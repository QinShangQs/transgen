<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('41',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";

        $adminusername = getParam('adminusername','POST');
        $adminpassword = md5(getParam('pwd','POST'));
        $role_id = getParam('role_id','POST');

       $sql = "insert into `admin` (`adminusername`,adminpassword,role_id) values ('$adminusername','$adminpassword','$role_id')";
        if (mysql_query($sql, $conn)) {
            echo "<script>alert('添加成功');window.location.href='manage_add.php'</script>";
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
            if (o.adminusername.value == "") {
                alert("请填写用户名");
                o.adminusername.focus();
                return false;
            }
            if (o.pwd.value == "") {
                alert("请填写密码");
                o.pwd.focus();
                return false;
            }
            if (o.oldpwd.value == "") {
                alert("请确认密码");
                o.oldpwd.focus();
                return false;
            }
            if (o.pwd.value != o.oldpwd.value) {
                alert("两次密码不一样");
                o.oldpwd.focus();
                return false;
            }
            if (o.role_id.value == "") {
                alert("请选择角色");
                o.role_id.focus();
                return false;
            }
            return true;
        }
    </SCRIPT>
</head>
<body>
<DIV class="Listbox">
    <DIV class="ListTit">管理员添加</DIV>
    <DIV class="ListfBox">
        <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="13%" height="40" align="center" class="bline">用户名</td>
                    <td width="87%" align="left" class="bline"><input name="adminusername" type="text"
                                                                      id="adminusername" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td height="30" align="center" class="bline">设置密码</td>
                    <td align="left" class="bline"><input name="pwd" type="password" id="pwd" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td height="40" align="center" class="bline">确认密码</td>
                    <td align="left" class="bline"><input name="oldpwd" type="password" id="oldpwd" style="width:200px;"/>
                    </td>
                </tr>
                <tr>
                    <td height="40" align="center" class="bline">角色选择</td>
                    <td align="left" class="bline"><select name="role_id" id="role_id">
                            <option value="">请选择</option>
                            <?php
                            $sqlrole = mysql_query("select id,role_name from `" . $dbpre . "role` order by id desc", $conn);
                            while ($row = mysql_fetch_array($sqlrole)) {
                                ?>
                                <option value="<?php echo $row['id'];?>"><?php echo $row['role_name'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td height="60" align="center">&nbsp;</td>
                    <td align="left">
                        <input type="submit" name="Submit" value="添加管理员" class="bn2"/></td>
                </tr>
            </table>
        </form>
    </DIV>
</DIV>
</body>
</html>