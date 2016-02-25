<?php
    require 'config.inc.php';
    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=6",$conn);
    $rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $rsseo['title'];?></title>
        <meta name="keywords" content="<?php echo $rsseo['keywords'];?>" />
        <meta name="description" content="<?php echo $rsseo['description'];?>" />
        <base href="<?php echo $weburl;?>" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
        <div id="main" class="mAuto">
            <div class="wid980 mAuto">
                <?php require 'head1.php';?>      
                <div  class="dN">
                    <img src="images/join1.jpg" width="980" height="150" />
                </div>
                <div id="textList" class="clearfix">
                    <div class="left widt220">
                        <div class="join_title">
                            <h1 class="tC f24">COMPANY</h1>
                            <h2 class="tC f24 fM">走进全式金</h2>
                        </div>
                        <ul class="join_list">
                            <?php
                                $sqlfl = mysql_query("select id,name from `".$dbpre."danye` order by id desc",$conn);
                                while($rsload = mysql_fetch_array($sqlfl)){
                                ?>
                                <li><a href="about/<?php echo $rsload['id'];?>.html"><?php echo $rsload['name'];?></a></li>
                                <?php
                                }
                            ?>
                            <li class="se4 bg1"><a href="partner.html">合作伙伴</a></li>
                            <li><a href="contact.html">联系我们</a></li>
                        </ul>
                    </div>
                    <div class="right wid720 marBot">
                        <div class="clearfix comTitle">
                            <div class="left f18 fM">合作伙伴</div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <a href="about.html">走进全式金</a> > <span>合作伙伴</span></div>
                        </div>
                        <div class="clearfix heZuo">
                            <?php
                                $sql = mysql_query("select id,name,weburl,pic from `".$dbpre."partner` order by id desc limit 0,50",$conn);
                                while($rs = mysql_fetch_array($sql)){
                                ?>
                                <dl class="left">
                                    <dt><a href="<?php echo $rs['weburl'];?>" target="_blank" rel="nofollow"><img src="<?php echo $rs['pic'];?>" alt="<?php echo $rs['name'];?>" width="135" height="77" /></a></dt>
                                    <dd class="tC"><?php echo $rs['name'];?></dd>
                                </dl>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php require 'footer.php';?>
		<script type="text/javascript">  
            $(document).ready(function(){  
                $('.nav li').eq(3).addClass('se1');  
            });  
        </script>
    </body>
</html>
