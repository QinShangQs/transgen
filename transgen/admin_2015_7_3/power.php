<?php
//读取权限数据
$sqlr = "select * from `" . $dbpre . "root` where role_id='" . $_SESSION['role_id'] . "'";
$queryr = mysql_query($sqlr, $conn);
while ($result = mysql_fetch_array($queryr)) {
    $quanxian[] = $result['quanxian'];
}
?>