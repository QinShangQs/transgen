<?php
session_start();
require '../config.inc.php';
require 'checkadmin.php';

header('Content-Type: text/html; charset=utf-8');

$role_id = getParam('role_id', 'GET');

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";

        //删除当前用户的所有权限
        $role_id = getParam('role_id', 'POST');

        $sql = "DELETE FROM `" . $dbpre . "root` WHERE role_id = '" . $role_id . "'";
        mysql_query($sql, $conn);
        if (!empty($_POST['quanxian'])) {
            foreach ($_POST['quanxian'] as $quanxian_id) {
                $sql = "INSERT INTO `" . $dbpre . "root` (`quanxian`, `role_id`) VALUES ('" . $quanxian_id . "', '" . $role_id . "')";
                mysql_query($sql, $conn);
                echo "<script>alert('修改成功');window.location.href='manage_role_root.php?role_id=" . $role_id . "'</script>";
            }
        } else {
            echo "<script>alert('修改成功');window.location.href='manage_role_root.php?role_id=" . $role_id . "'</script>";
        }
}

//读取数据
$sqlr = "select * from `" . $dbpre . "root` where role_id='" . $role_id . "'";

$queryr = mysql_query($sqlr, $conn);
while ($result = mysql_fetch_array($queryr)) {
    $quanxian[] = $result['quanxian'];
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
</head>
<body>
<DIV class="Listbox">
    <DIV class="ListTit">权限分配</DIV>
    <DIV class="ListfBox">
        <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
            <input type="hidden" name="role_id" value="<?php echo $role_id; ?>"/>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <?php
                $sqlmenu = mysql_query("select * from `" . $dbpre . "menu` where parent_id=0 order by id asc", $conn);
                while ($rsmenu = mysql_fetch_array($sqlmenu)) {
                    ?>
                    <tr>
                        <td width="13%" height="40" align="center"
                            class="bline"><?php echo $rsmenu['menu_name']; ?></td>
                        <td width="87%" align="left" class="bline">
                            <?php
                            $sqlmenuz = mysql_query("select * from `" . $dbpre . "menu` where parent_id='" . $rsmenu['id'] . "' order by id asc", $conn);
                            while ($rsmenuz = mysql_fetch_array($sqlmenuz)) {
                                ?>
                                <input <?php if (!empty($quanxian)) {
                                    echo in_array($rsmenuz['id'], $quanxian) ? 'checked' : '';
                                } ?> type="checkbox" name="quanxian[]" id="quanxian[]"
                                     value="<?php echo $rsmenuz['id']; ?>" /><?php echo $rsmenuz['menu_name']; ?> [<?php echo $rsmenuz['id']?>]　
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td height="60" align="center">&nbsp;</td>
                    <td align="left"><input type="submit" name="Submit" value="分配权限" class="bn2"/></td>
                </tr>
            </table>
        </form>
    </DIV>
</DIV>
</body>
</html>
