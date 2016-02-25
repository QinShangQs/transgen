<?php
     session_start();
     require 'checkadmin.php';
     $_SESSION['adminuser'];
     $_SESSION['adminid'];
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/frameset.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD 
        id=Head1><TITLE>网站后台管理中心</TITLE>
        <META content="text/html; charset=utf-8" http-equiv=Content-Type>
        <LINK rel=stylesheet type=text/css href="css/common.css">
        <LINK rel=stylesheet type=text/css href="css/default.css">
        <STYLE type=text/css>BODY {
                OVERFLOW: hidden
            }
            HTML {
                OVERFLOW: hidden
            }
        </STYLE>

    </HEAD>

    <FRAMESET frameSpacing=0 border=0 frameBorder=no rows=41,*,32 scrolling="no">
        <FRAME id=topFrame title=topFrame noResize src="header.php" name=topFrame scrolling=no>
        <FRAMESET id=lrframe frameSpacing=0 border=0 cols=215,* frameBorder=0 rows=* scrolling="no">
            <FRAME noResize marginHeight=0 src="admin_left.php" name="leftFrame" marginWidth=0 scrolling=auto>
            <FRAMESET frameSpacing=0 border=0 cols=* frameBorder=0 rows=52,* scrolling="no">
                <FRAME noResize src="admin_top.php" name=intopFrame marginWidth=0 scrolling=no>
                <FRAME id="mainFrame" src="default.php" name="mainFrame" marginWidth=0 scrolling=auto>
            </FRAMESET>
        </FRAMESET>
        <FRAME id=bottomFrame title=bottomFrame noResize src="footer.php" name=bottomFrame scrolling=no>
    </FRAMESET><noframes></noframes>

</HTML>
