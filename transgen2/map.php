<?php
    require 'config.inc.php';
    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=9",$conn);
    $rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $rsseo['title'];?></title>
        <meta name="keywords" content="<?php echo $rsseo['keywords'];?>" />
        <meta name="description" content="<?php echo $rsseo['description'];?>" />
        <!-- <base href="<?php echo $weburl;?>" /> -->
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
    <?php require 'head.php';?>
    <div style="margin:5px;"></div>   
    <div class="wid980 mAuto" >
                <div class="webMap">
					<div class="comMap">
                        <p class="mapTitle f18 fM">热门搜索 </p>
                        <div class="clearfix list1">
							<a href="http://www.transgen.com.cn/search/pcr_0_1.html" class="left fA">pcr</a>
							<a href="http://www.transgen.com.cn/search/qpcr_0_1.html" class="left fA">qpcr</a>
							<a href="http://www.transgen.com.cn/search/rt-pcr_0_1.html" class="left fA">rt-pcr</a>
							<a href="http://www.transgen.com.cn/search/peasy_0_1.html" class="left fA">克隆载体与表达载体</a>
							<a href="http://www.transgen.com.cn/search/marker_0_1.html" class="left fA">dna marker与蛋白marker</a>
							<a href="http://www.transgen.com.cn/search/clon_0_1.html" class="left fA">克隆试剂盒</a>
							<a href="http://www.transgen.com.cn/search/dna_0_1.html" class="left fA">dna相关生物试剂盒</a>
							<a href="http://www.transgen.com.cn/search/rna_0_1.html" class="left fA">rna相关试剂</a>
							<a href="http://www.transgen.com.cn/search/easypure_0_1.html" class="left fA">核酸纯化试剂</a>
							<a href="http://www.transgen.com.cn/search/trans_0_1.html" class="left fA">trans试剂</a>
                        </div>
                    </div>
                    <div class="comMap">
                        <p class="mapTitle f18 fM">产品分类</p>
                        <div class="clearfix list1">
                            <?php
                                $sqlmap = mysql_query("select * from `".$dbpre."product_cat` where cid=56 order by id desc",$conn);
                                while($rsmap = mysql_fetch_array($sqlmap)){
                                ?>
                                <a href="products/<?php echo $rsmap['id'];?>.html" class="left"><?php echo $rsmap['catname'];?></a>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
					<div class="comMap">
                        <p class="mapTitle f18 fM">产品列表</p>
                        <div class="clearfix list1">
                            <?php
                                $sqlmappl = mysql_query("select * from `".$dbpre."product` where sid=0 order by id desc",$conn);
                                while($rsmappl = mysql_fetch_array($sqlmappl)){
                                ?>
                                <a href="products_show/<?php echo $rsmappl['id'];?>.html" class="left"><?php echo $rsmappl['name'];?></a>
                                <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="comMap">
                        <p class="mapTitle f18 fM">服务与支持 </p>
                        <div class="clearfix list1">
                            <?php
                                $sqlmap = mysql_query("select * from `".$dbpre."catnews` order by id desc",$conn);
                                while($rsmap = mysql_fetch_array($sqlmap)){
                                ?>
                                <a href="service/<?php echo $rsmap['id'];?>.html" class="left fA"><?php echo $rsmap['catname'];?></a>
                                <?php
                                }
                            ?>
                            <a href="video.html" class="left fA">视频讲座</a>
                        </div>
                    </div>
                    <div class="comMap">
                        <p class="mapTitle f18 fM">走进全式金</p>
                        <div class="clearfix list1">
                            <?php
                                $sqlmap = mysql_query("select * from `".$dbpre."danye` order by id desc",$conn);
                                while($rsmap = mysql_fetch_array($sqlmap)){
                                ?>
                                <a href="about/<?php echo $rsmap['id'];?>.html" class="left fA"><?php echo $rsmap['name'];?></a>
                                <?php
                                }
                            ?>
                            <a href="partner.html" class="left fA">合作伙伴</a>
                            <a href="contact.html" class="left fA">联系我们</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php require 'footer.php';?>
    </body>
</html>
