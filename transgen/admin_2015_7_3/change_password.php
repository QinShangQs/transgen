<?php
session_start();
require '../config.inc.php';
require 'checkadmin.php';

header('Content-Type: text/html; charset=utf-8');
$username = $_SESSION['adminuser'];
$sql = "select * from `admin` where adminusername='$username'";
//echo $sql;
$query = mysql_query($sql, $conn);
$rs = mysql_fetch_array($query);

@$action = $_GET['action'];
switch ($action) {
    //修改记录
    case"edit";
        $adminusername = $_SESSION['adminuser'];
        $adminpassword = md5(trim($_POST['ConPassword']));

       $sql = "update `admin` set adminpassword='$adminpassword' where adminusername='$adminusername'";
	   if(mysql_query($sql, $conn))
		{
			print"<script>alert('密码修改成功!');location.href='default.php';</script>";
		}else{
			print"<script>alert('密码修改失败!');location.href='default.php';</script>";
		}
        
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CPWEB</title>
<LINK rel=stylesheet type=text/css href="css/common.css">
<LINK rel=stylesheet type=text/css href="css/default.css">
<SCRIPT language="JavaScript">
  function CheckForm()
  {
	  if (document.form1.newPassword.value.length == 0) {
		  alert("请输入您的新密码");
		  document.form1.newPassword.focus();
		  return false;
	  }
	  if(document.form1.newPassword.value.length<5){
		  alert("密码不能低于5位");
		  document.form1.newPassword.focus();
		  return false;
	  }
	  if (document.form1.ConPassword.value.length == 0) {
		  alert("请确认您的新密码");
		  document.form1.ConPassword.focus();
		  return false;
	  }
	  if (document.form1.newPassword.value != document.form1.ConPassword.value) {
		  alert("您两次输入的密码不一致！请重新输入");
		  document.form1.ConPassword.focus();
		  return false;
	  }
	  return true;
  }
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">修改密码</DIV>
  <DIV class="ListfBox">   
      <form name="form1" id="form1" method="post" action="?action=edit&adminusername=<?php echo $_SESSION['adminuser'];?>" onSubmit="return CheckForm()">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="40" align="center" class="bline">管理员</td>
                            <td align="left" class="bline"><?php echo $_SESSION['adminuser']; ?></td>
                        </tr>
                        <tr>
                            <td width="13%" height="40" align="center" class="bline">新密码</td>
                            <td width="87%" align="left" class="bline">
                                <input name="newPassword" type="password" class="inp" id="newPassword" style="width:200px;" />
                                *</td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">确认密码</td>
                            <td align="left" class="bline">
                                <input name="ConPassword" type="password" class="inp" id="ConPassword" style="width:200px;" />
                                *        </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">&nbsp;</td>
                            <td align="left" class="bline">
                                <input type="submit" name="Submit" value="修改密码" class="bn2" />        </td>
                        </tr>
                        <tr>
                            <td height="40" align="center">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                        </tr>
                    </table>
                </form>
  </DIV>
</DIV>
</body>
</html>