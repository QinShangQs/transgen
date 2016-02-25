<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('40',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

$action = $_GET['action'];
switch ($action) {
    //删除记录
    case"del";

        if (empty($_POST['id'])) {
            echo "<script>alert('必须选择一条信息,才可以删除!');history.back(-1);</script>";
            exit;
        } else {
            /*如果要获取全部数值则使用下面代码*/

            $id = implode(",", $_POST['id']);
            $page = trim($_POST['page']) != "" ? trim($_POST['page']) : 1;

            $str = "delete from `admin` where id in ($id)";
            mysql_query($str);
            echo "<script>alert('删除成功！');window.location.href='manage_list.php?page=$page';</script>";
        }
        break;
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
    <script type="text/javascript" language="javascript">
        function selectBox(selectType) {
            var checkboxis = document.getElementsByName("id[]");
            if (selectType == "reverse") {
                for (var i = 0; i < checkboxis.length; i++) {
//alert(checkboxis[i].checked);
                    checkboxis[i].checked = !checkboxis[i].checked;
                }
            }
            else if (selectType == "all") {
                for (var i = 0; i < checkboxis.length; i++) {
//alert(checkboxis[i].checked);
                    checkboxis[i].checked = true;
                }
            }
        }
    </script>
    <script language="javascript">
        function checkkey() {
            if (formsearch.key.value == "请输入用户名") {
                alert("请输入用户名!");
                formsearch.key.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<DIV class="Listbox">
    <DIV class="ListTit">管理员列表</DIV>
    <DIV class="ListfBox">
        <form id="formsearch" name="formsearch" method="get" onsubmit="return checkkey()">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="3%" height="45" align="center" style="border-bottom:1px #ccc solid;">搜索</td>
                    <td width="26%" style="border-bottom:1px #ccc solid;"><input type="text" name="key" id="key"
                                                                                 onfocus="if(this.value=='请输入用户名') {this.value='';}"
                                                                                 onblur="if(this.value=='') {this.value='请输入用户名';}"
                                                                                 value="请输入用户名" style="width:250px;"/>
                  </td>
                  <td width="71%" style="border-bottom:1px #ccc solid;"><input type="submit" name="submit" id="submit"
                                                                                 value=" 立即查询 "/></td>
                </tr>
            </table>
        </form>

        <form id="form2" name="form2" method="post" action="?action=del">
            <input type="hidden" id="page" name="page" value="<?php echo $_GET['page']; ?>"/>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="4%" height="30" align="center" class="bline">ID</td>
                    <td width="5%" align="left" class="bline">&nbsp;</td>
                    <td width="66%" align="left" class="bline">管理员用户名</td>
                    <td width="17%" align="center" class="bline">角色</td>
                    <td width="8%" align="center" class="bline">相关操作</td>
                </tr>
                <?php
                $key = $_GET['key'];

                $Page_size = 12;
                if ($key) {
                    $sqld = "SELECT a.id,a.role_id,a.adminusername,b.id js_id,b.role_name FROM `admin` as a, `".$dbpre."role` as b where b.adminusername like '%$key%' order by a.id desc";
                } else {
                    $sqld = "SELECT a.id,a.role_id,a.adminusername,b.id js_id,b.role_name FROM `admin` as a, `".$dbpre."role` as b where a.role_id=b.id order by a.id desc";
                }
                $resultd = mysql_query($sqld, $conn);
                $count = mysql_num_rows($resultd);
                $page_count = ceil($count / $Page_size);

                $init = 1;
                $page_len = 5;
                $max_p = $page_count;
                $pages = $page_count;

                //判断当前页码
                if (empty($_GET['page']) || $_GET['page'] < 0) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $offset = $Page_size * ($page - 1);
                if ($key) {
                    $sqlzt = "select a.id,a.role_id,a.adminusername,b.id js_id,b.role_name from `admin` as a, `".$dbpre."role` as b where b.adminusername like '%$key%' order by a.id desc limit $offset,$Page_size";
                } else {
                    $sqlzt = "select a.id,a.role_id,a.adminusername,b.id js_id,b.role_name from `admin` as a, `".$dbpre."role` as b where a.role_id=b.id order by a.id desc limit $offset,$Page_size";
                }
                $queryzt = mysql_query($sqlzt, $conn);
                while ($rslist = mysql_fetch_array($queryzt)) {
                    ?>
                    <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; "
                        onmouseout="this.style.background='#ffffff'; this.style.bordercolor=''">
                        <td height="30" align="center" class="bline">
                            <label>
                                <input type="checkbox" name="id[]" value="<?php echo $rslist['id']; ?>"
                                       style="background:none; border:none;"/>
                            </label>
                        </td>
                        <td align="left" class="bline"><?php echo $rslist['id']; ?></td>
                        <td align="left" class="bline"><?php echo $rslist['adminusername']; ?></td>
                        <td align="center" class="bline"><?php echo $rslist['role_name']; ?></td>
                        <td align="center" class="bline"><a href="manage_edit.php?id=<?php echo $rslist['id']; ?>">编辑</a>
                        </td>
                    </tr>
                <?php
                }
                $page_len = ($page_len % 2) ? $page_len : $pagelen + 1; //页码个数
                $pageoffset = ($page_len - 1) / 2; //页码个数左右偏移量

                //判断URL地址参数
                $url = '';
                if ($key) {
                    $url .= "key=" . $key . "&";
                }

                $key = "<div class=\"page\">";
                if ($page != 1) {
                    $key .= "<a href=\"?" . $url . "page=1\">首页</a>"; //第一页
                    $key .= "<a href=\"?" . $url . "page=" . ($page - 1) . "\">上一页</a>"; //上一页
                } else {
                    $key .= "<a>首页</a>"; //第一页
                    $key .= "<a>上一页</a>"; //上一页
                }
                if ($pages > $page_len) {
                    //如果当前页小于等于左偏移
                    if ($page <= $pageoffset) {
                        $init = 1;
                        $max_p = $page_len;
                    } else { //如果当前页大于左偏移
                        //如果当前页码右偏移超出最大分页数
                        if ($page + $pageoffset >= $pages + 1) {
                            $init = $pages - $page_len + 1;
                        } else {
                            //左右偏移都存在时的计算
                            $init = $page - $pageoffset;
                            $max_p = $page + $pageoffset;
                        }
                    }
                }
                for ($i = $init; $i <= $max_p; $i++) {
                    if ($i == $page) {
                        $key .= "<a href=\"?" . $url . "page=" . $i . "\" class=\"curr\">" . $i . "</a>";
                    } else {
                        $key .= "<a href=\"?" . $url . "page=" . $i . "\">" . $i . "</a>";
                    }

                }
                if ($page != $pages) {
                    $key .= "<a href=\"?" . $url . "page=" . ($page + 1) . "\">下一页</a>"; //下一页
                    $key .= "<a href=\"?" . $url . "page={$pages}\">尾页</a>"; //最后一页
                } else {
                    $key .= "<a>下一页</a>"; //下一页
                    $key .= "<a>尾页</a>"; //最后一页
                }
                $key .= "</div>";
                ?>
                <tr bgcolor="#ffffff">
                    <td height="40" colspan="5" align="left">
                        <div style="padding-left:10px;"><input type="button" value="全选" class="btbg"
                                                               onClick="selectBox('all')"/>
                            <input type="button" value="反选" onClick="selectBox('reverse')"/>
                            <input type="submit" name="btnSave" value="删除"/></div>
                    </td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td height="30" colspan="5" align="center"><?php if ($count > 0) {
                            echo $key;
                        } else {
                            echo "暂无内容";
                        } ?></td>
                </tr>
            </table>
        </form>
    </DIV>
</DIV>
</body>
</html>