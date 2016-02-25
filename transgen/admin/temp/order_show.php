<?php
    session_start();
    require '../config.inc.php';
    require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('38',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


    $username = trim($_GET['username']);
    $dingdanhao = trim($_GET['dingdanhao']);


    $sqlp = mysql_query("select * from `".$dbpre."member` where username='".$username."'",$conn);
    $rsu = mysql_fetch_array($sqlp);

    $sqld = mysql_query("select * from `".$dbpre."cartemp` where dingdanhao='".$dingdanhao."'",$conn);
    $rsd = mysql_fetch_array($sqld);

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
            <DIV class="ListTit">订单详情</DIV>
            <DIV class="ListfBox">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="30" colspan="6" align="left" class="bline">
                            <div style="line-height:22px; margin:10px 0 10px 20px;">
                                <table>
                                    <tr>
                                        <td width="200">订单号：<?php echo $rsd['dingdanhao']; ?></td>
                                        <td>订单时间：<?php echo date('Y-m-d H:i:s',$rsd['dingdanhao']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>会员名：<?php echo $rsd['username']; ?></td>
                                        <td>手机号号：<?php echo $rsu['mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>收件人：<?php echo $rsu['realname']; ?></td>
                                        <td>电子邮箱：<?php echo $rsu['email']; ?></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2">收货地址：<?php echo $rsu['address']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="5%" height="30" align="center" class="bline">ID</td>
                        <td width="13%" align="left" class="bline">目录号</td>
                        <td width="38%" align="center" class="bline">产品名</td>
                        <td width="22%" align="center" class="bline">规格</td>
                        <td width="11%" align="center" class="bline">数量</td>
                        <td width="11%" align="center" class="bline">单价</td>
                    </tr>
                    <?php
                        $sun_jiage = 0;
                        $sqlzt = "select * from `".$dbpre."cartemp` where dingdanhao='".$dingdanhao."'";
                        $queryzt = mysql_query($sqlzt, $conn);
                        while ($rslist = mysql_fetch_array($queryzt))
                        {
                            $sqlrrr = "select * from `".$dbpre."product` where id='".$rslist['sp_id']."'";
                            $sqlpro = mysql_query($sqlrrr,$conn);
                            $rscp = mysql_fetch_array($sqlpro);

                            $sun_jiage2 = ($rslist['suliang']) * ($rslist['price']);
                            $sun_jiage = $sun_jiage2 + $sun_jiage;

                        ?>					
                        <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
                            <td height="30" align="center" class="bline"><?php echo $rslist['id']; ?></td>
                            <td align="center" class="bline"><?php echo $rscp['name']; ?></td>
                            <td align="center" class="bline"><?php echo $rscp['name_pro']; ?></td>
                            <td align="center" class="bline"><?php echo $rscp['guige']; ?></td>
                            <td align="center" class="bline"><?php echo $rslist['suliang']; ?></td>
                            <td align="center" class="bline"><?php echo $rslist['price']; ?></td>
                        </tr>
                        <?php
                        }
                    ?>
                    <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
                        <td height="30" colspan="6" align="right" class="bline"><span style="font-size:16px; color:#f60; font-weight:bold; padding-right:10px">总计：<?php echo $sun_jiage;?></span></td>
                    </tr>	

                </table>
            </DIV>
        </DIV>
    </body>
</html>