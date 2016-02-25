<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('45',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";

        $menu_name = getParam('menu_name','POST');
        $parent_id = getParam('parent_id','POST',0);
        $url = getParam('url','POST');
		$px = getParam('px','POST',0);

        $sql = "insert into `".$dbpre."menu` (`menu_name`,parent_id,url,px) values ('$menu_name','$parent_id','$url','$px')";
        if (mysql_query($sql, $conn)) {
            echo "<script>alert('添加成功');window.location.href='menu_add.php'</script>";
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
            if (o.menu_name.value == "") {
                alert("请填写菜单名称");
                o.menu_name.focus();
                return false;
            }
            return true;
        }
    </SCRIPT>
</head>
<body>
<DIV class="Listbox">
    <DIV class="ListTit">菜单添加</DIV>
    <DIV class="ListfBox">
        <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="13%" height="40" align="center" class="bline">菜单名称</td>
                    <td width="87%" align="left" class="bline"><input name="menu_name" type="text"
                                                                      id="menu_name" style="width:200px;"/></td>
                </tr>
                <tr>
                    <td height="30" align="center" class="bline">菜单分类</td>
                    <td align="left" class="bline">
                    <select name="parent_id" id="parent_id">
                      <option value="0">顶级菜单</option>
                      <?php
                            $sqlrole = mysql_query("select id,menu_name from `" . $dbpre . "menu` where parent_id=0 order by id desc", $conn);
                            while ($row = mysql_fetch_array($sqlrole)) {
                                ?>
                      <option value="<?php echo $row['id'];?>"><?php echo $row['menu_name'];?></option>
                      <?php
                            }
                            ?>
                      </select></td>
              </tr>
                <tr>
                    <td height="40" align="center" class="bline">菜单链接</td>
                    <td align="left" class="bline"><input name="url" type="type" id="url" style="width:200px;"/>
                    </td>
                </tr>
                <tr>
                    <td height="40" align="center" class="bline">菜单排序</td>
                  <td align="left" class="bline"><input name="px" type="type" id="px" style="width:50px;" value="0"/></td>
              </tr>
                <tr>
                    <td height="60" align="center">&nbsp;</td>
                    <td align="left">
                        <input type="submit" name="Submit" value="添加菜单" class="bn2"/></td>
                </tr>
            </table>
        </form>
    </DIV>
</DIV>
</body>
</html>