<?php
    session_start();
    require '../config.inc.php';
    require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('25',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


    $id = trim($_GET['id']);

    $sqlp = mysql_query("select * from `".$dbpre."member` where id='".$id."'",$conn);
    $rsu = mysql_fetch_array($sqlp);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CPWEB</title>
        <LINK rel=stylesheet type=text/css href="css/common.css">
        <LINK rel=stylesheet type=text/css href="css/default.css">
    </head>
    <body>
        <DIV class="Listbox">
            <DIV class="ListTit">会员详情</DIV>
            <DIV class="ListfBox">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr align="left">
                        <td height="30" align="left" class="bline">会员名：<?php echo $rsu['username']; ?></td>
                    </tr>
                    <tr align="left">
                        <td height="30" align="left" class="bline">手机号码：<?php echo $rsu['mobile']; ?></td>
                    </tr>
                    <tr align="left">
                        <td height="30" align="left" class="bline">电子邮箱：<?php echo $rsu['email']; ?></td>
                    </tr>
                    <tr align="left">
                        <td height="30" align="left" class="bline">收件人：<?php echo $rsu['realname']; ?></td>
                    </tr>
                    <tr align="left">
                        <td height="30" align="left" class="bline">收货地址：<?php echo $rsu['address']; ?></td>
                    </tr>
                    <tr align="left">
                      <td height="30" align="left"><input type="button" name="button" value="返回列表" onClick="location.href='member_list.php'" class="bn2" /></td>
                    </tr>       
                </table>
            </DIV>
        </DIV>
    </body>
</html>