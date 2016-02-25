<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('3',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

header('Content-Type: text/html; charset=utf-8');
$id = trim($_GET['id']);

$sql1 = "select * from `".$dbpre."seo` where id='" . $id . "'";
$query1 = mysql_query($sql1, $conn);
$rs = mysql_fetch_array($query1);

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"edit";
    
	 $id = trim($_POST['id']);
	 $title = trim($_POST['title']);
     $keywords = trim($_POST['keywords']);
	 $description = trim($_POST['description']);
		
        $sqle = "update `".$dbpre."seo` set title='$title',keywords='$keywords',description='$description' where id='" . $id . "'";
		mysql_query($sqle, $conn);
        echo "<script>alert('修改成功');window.location.href='seo_edit.php?id=".$id."'</script>";
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
	if(o.title.value==""){
		alert("title标题不能为空!");
		o.title.focus();
		return false;
	}
	if(o.keywords.value==""){
		alert("keywords 关键字不能为空!");
		o.keywords.focus();
		return false;
	}
	if(o.description.value==""){
		alert("description 描述不能为空!");
		o.description.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">SEO修改</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=edit" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" height="40" align="center" class="bline">栏目名称</td>
          <td width="87%" align="left" class="bline"><?php echo $rs['name']; ?></td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">title</td>
          <td width="87%" align="left" class="bline"><input name="title" type="text" id="title" style="width:400px;" value="<?php echo $rs['title']; ?>" /> 仅SEO优化使用</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">keywords</td>
          <td align="left" class="bline"><input name="keywords" type="text" id="keywords" style="width:400px;" value="<?php echo $rs['keywords']; ?>" /> 仅SEO优化使用</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">description</td>
          <td align="left" class="bline">
          <input type="text" name="description" style="width:400px;" id="description" value="<?php echo $rs['description']; ?>" /> 仅SEO优化使用
          </td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">&nbsp;</td>
          <td align="left" class="bline"><input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
            <input type="submit" name="Submit" value="确定保存" class="bn2" /></td>
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