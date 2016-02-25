<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('36',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');

$id = trim($_GET['id']);

$sql1 = "select * from `".$dbpre."faq` where id='" . $id . "'";
$query1 = mysql_query($sql1, $conn);
$rs = mysql_fetch_array($query1);

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"edit";
    
	 $id = trim($_POST['id']);
	 $name = trim($_POST['name']);
     $huida = trim($_POST['huida']);
	 $addtime = strtotime($_POST['addtime']);
		
        $sql = "update `".$dbpre."faq` set name='$name',huida='$huida',addtime='$addtime' where id='".$id."'";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('修改成功');window.location.href='faq_edit.php?id=".$id."'</script>";
		}else{
			echo "<script>alert('修改失败');window.location.href='javascript:history.go(-1)'</script>";
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
function checkform(o){
	if(o.name.value==""){
		alert("请填写问题内容");
		o.name.focus();
		return false;
	}
	if(o.huida.value==""){
		alert("请填写回答内容");
		o.huida.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">产品FAQ修改</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=edit" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" height="40" align="center" class="bline">问题内容</td>
          <td width="87%" align="left" class="bline"><input name="name" type="text" id="name" style="width:400px;" value="<?php echo $rs['name'];?>" /></td>
        </tr>
        <tr>
          <td height="100" align="center" class="bline">回答内容</td>
          <td align="left" class="bline"><textarea name="huida" id="huida" style="width:405px; height:80px;resize:none;"><?php echo $rs['huida'];?></textarea></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">发布时间</td>
          <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', $rs['addtime']);?>" /></td>
        </tr>
        <tr>
          <td height="60" align="center">&nbsp;</td>
          <td align="left">
          	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
            <input type="submit" name="Submit" value="修改内容" class="bn2" /></td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>