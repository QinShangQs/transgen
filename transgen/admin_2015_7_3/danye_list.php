<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('9',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //删除记录
    case"del";
        $id = lib_replace_end_tag($_GET['id']);

        $sql = "delete from `".$dbpre."danye` where id='".$id."'";		
        if(mysql_query($sql, $conn)){
        	echo "<script>location.href='danye_list.php';</script>";
		}else{
			echo "<script>alert('修改失败');window.location.href='javascript:history.go(-1)'</script>";
		}
        break;
}
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
  <DIV class="ListTit">单页管理</DIV>
  <DIV class="ListfBox">   
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td width="6%" height="30" align="center" class="bline">ID</td>
              <td width="82%" align="left" class="bline">栏目名称</td>
              <td width="12%" align="center" class="bline">相关操作</td>
          </tr>
          <?php
          $queryd = mysql_query("SELECT * from `".$dbpre."danye` order by id asc", $conn);
          while ($rss = mysql_fetch_array($queryd)){
              ?>					
              <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
                  <td height="30" align="center" class="bline"><?php echo $rss['id']; ?></td>
                  <td align="left" class="bline"><?php echo $rss['name']; ?></td>
                  <td align="center" class="bline"><a href="danye_edit.php?id=<?php echo $rss['id']; ?>">编辑</a>  |  <a href="?action=del&id=<?php echo $rss['id']; ?>" onclick="return confirm('确定删除?')">删除</a></td>
              </tr>					
              
              <?php
              }
          ?>
    </table>
  </DIV>
</DIV>
</body>
</html>