<?php
session_start();
require '../config.inc.php';
require 'checkadmin.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
    <TITLE>网站后台管理中心</TITLE>
    <META content="text/html; charset=utf-8" http-equiv=Content-Type>
    <LINK rel=stylesheet type=text/css href="css/common.css">
    <LINK rel=stylesheet type=text/css href="css/default.css">
    <STYLE type=text/css>
        BODY {
            BACKGROUND: url(include/images/default/lrigDot.gif) repeat-y 214px top
        }
    </STYLE>
    <SCRIPT type=text/javascript src="js/jquery-1.7.1.min.js"></SCRIPT>
    <SCRIPT language=javascript>
        jQuery(document).ready(function ($) {
            $(".adLeft li>a").toggle(function () {
                $(this).parent().addClass("current");
                $(this).attr("class", "m_down");
                $(this).next("dl").slideDown();
                $(this).blur();
            }, function () {
                $(this).parent().removeClass("current");
                $(this).next("dl").slideUp();
                $(this).attr("class", "m_up");
                $(this).blur();
            });

        });
        $(function () {
            $(".exit_a").click(function () {
                top.location.href = $(this).attr("href");
                return false;
            });
        });
    </SCRIPT>
</HEAD>
<BODY>
<DIV class=adLeft>
    <DIV class=alTop>
        <P class=weln><?php echo $_SESSION['adminuser']; ?>&nbsp;&nbsp;您好！</P>

        <P>
            <?php
            $date = date('Y-m-d H:i:s', time());
            function showdate($date)
            {
                $date_arr = explode(" ", $date);
                $date_part = explode("-", $date_arr[0]);
                $day = date("w", strtotime($date));
                switch ($day) {
                    case '1':
                        $day = '星期一';
                        break;
                    case '2':
                        $day = '星期二';
                        break;
                    case '3':
                        $day = '星期三';
                        break;
                    case '4':
                        $day = '星期四';
                        break;
                    case '5':
                        $day = '星期五';
                        break;
                    case '6':
                        $day = '星期六';
                        break;
                    case '0':
                        $day = '星期日';
                        break;
                }
                echo $date_part[0] . '年' . intval($date_part[1]) . '月' . intval($date_part[2]) . '日&nbsp;&nbsp;&nbsp;&nbsp;' . $day;
            }

            showdate($date);
            ?>
        </P>

        <P class=albtns><A href="ChangePassword.php" target=mainFrame>修改密码</A><A class=exit_a href="LogOut.php"
                                                                                 target=mainFrame>安全退出</A></P>
    </DIV>
    <UL>
    <?php	
	//取大类ID，有几个菜单
    $sqldl = "SELECT a.*,b.* FROM `".$dbpre."menu` AS a left join `".$dbpre."root` AS b on a.id = b.quanxian where b.role_id='".$_SESSION['role_id']."' group by a.parent_id asc";
	$sqldl = mysql_query($sqldl,$conn);
	while ($rsdl = mysql_fetch_array($sqldl)) {
	?>   
    	
        <?php
		$sqlmenu = "SELECT a.id,a.menu_name,a.parent_id,b.id bid,b.quanxian,b.role_id FROM `".$dbpre."menu` AS a left join `".$dbpre."root` AS b on a.id = b.quanxian where a.id='".$rsdl['parent_id']."'";
		$sqlmenu = mysql_query($sqlmenu,$conn);
		$countxiaolei = mysql_num_rows($sqlmenu);
		while($rsmenu = mysql_fetch_array($sqlmenu)){
		?>
        <LI><A class=m_up href="javascript:void(0);" target=mainFrame><?php echo $rsmenu['menu_name'];?></A>
            <DL class=ldl>
            	<?php
                $sqlsl = mysql_query("SELECT a.id,a.parent_id,a.menu_name,a.url,a.px,b.id bid,b.role_id,b.quanxian FROM `".$dbpre."menu` AS a left join `".$dbpre."root` AS b on a.id = b.quanxian where b.role_id='".$_SESSION['role_id']."' and parent_id='".$rsmenu['id']."' ",$conn);
				while($rsxl = mysql_fetch_array($sqlsl)){
				?>
                <DD><A href="<?php echo $rsxl['url'];?>" target=mainFrame><?php echo $rsxl['menu_name'];?></A></DD>
                <?php
                }
				?>
            </DL>
        </LI>
        <?php
        }
		?>
        <?php
        }
		?>
    </UL>
</DIV>
</BODY>
</HTML>
