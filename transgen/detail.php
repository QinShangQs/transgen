<?php
require 'config.inc.php';
$cid = getParam('id', 'GET');
$sqlcat2 = mysql_query("select id,catname from `" . $dbpre . "product_cat` where id='" . $cid . "'", $conn);
$rscat2 = mysql_fetch_array($sqlcat2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>产品详细</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <base href="<?php echo $weburl; ?>"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <style type="text/css">
        .wid380 {
            width: 650px;
            margin-top: 40px;
        }

        .name {
            background: #cfcfcf;
            height: 32px;
            line-height: 32px;
            text-indent: 26px;
        }

        .one1 {
            width: 240px;
            padding-left: 80px;
        }

        .three3 {
            width: 200px;
        }
    </style>

</head>
<body>
<div class="wid380 oH mAuto">
    <div class="name clearfix">
        <a class="left fW f14"><?php echo $rscat2['catname']; ?></a>
        <span class="right off" style="margin-right:10px;" onclick="window.parent.hide()" title="关闭"></span>
    </div>


    <div>
        <?php
        $i = 1;
        $sqllist = mysql_query("select id,name,cat,sid,sm,tedian,fanwei,baocun from `" . $dbpre . "product` where cat='" . $cid . "' and sid=0 order by id desc", $conn);
        while ($rslist = mysql_fetch_array($sqllist)){
        $i++;
        ?>
        <div class="headT fM <?php if ($i % 2) { echo "bgHui ";}?>guai">
        <a><?php echo $rslist['name']; ?></a>
    </div>

<ul class="goList dN" style="border:none;padding-bottom:1px;">

    <li class="clearfix specials">
        <a class="left one1">目录号</a>
        <a class="left three3">规 格</a>
        <a class="left four4">单 价</a>
    </li>
    <?php
    $sqlsid = mysql_query("select id,sid,name,guige,price,downloada,downloadb,downloadc,downloadd from `".$dbpre."product` where sid='".$rslist['id']."' order by id desc",$conn);
    while($rssid = mysql_fetch_array($sqlsid)){
        ?>
    <li class="clearfix hui">
        <a class="left one1"><?php echo $rssid['name'];?></a>
        <a class="left three3"><?php echo $rssid['guige'];?></a>
        <a class="left four4"><span><?php echo $rssid['price'];?></span> 元</a>
    </li>
    <?php }?>

</ul>

<?php
}
?>
</div>

</div>
<script type="text/javascript" src="js/jq.js"></script>
<script type="text/javascript" src="js/quanshijin.js"></script>
    <script>
        $(function () {
            $(".guai").click(function () {
                $(this).toggleClass("se66").next().slideToggle().siblings(".goList").slideUp();
                $(this).siblings(".guai").removeClass("se66");
                $(this).children(":first").css({color: "#ff6600"});
            });
        })
    </script>
</body>
</html>
