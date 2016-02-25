<?php
    require 'config.inc.php';
    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=8",$conn);
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
                <div class="dN">
                    <img src="images/rencai.jpg" width="980" height="150" />
                </div>
                <div id="textList">
                    <div class="wid720" style="width:980px;">
                        <div class="clearfix comTitle">
                            <div class="left f18 fM">人才招聘</div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>人才招聘</span></div>
                        </div>
                        <div class="renList">
                            <ul>
                                <li class="clearfix special">
                                    <a class="left one">职位</a>
                                    <a class="left two">人数</a>
                                    <a class="left three">地区</a>
                                    <a class="left four">发布日期</a>
                                </li>
                                <?php
                                    $sqljob = mysql_query("select * from `".$dbpre."job` order by addtime desc",$conn);
                                    while($rsjob = mysql_fetch_array($sqljob)){
                                    ?>
                                    <li class="clearfix">
                                        <a class="left one" href="job_show/<?php echo $rsjob['id'];?>.html"><?php echo $rsjob['name'];?></a>
                                        <a class="left two"><?php echo $rsjob['renshu'];?> 人</a>
                                        <a class="left three"><?php echo $rsjob['area'];?></a>
                                        <a class="left four"><?php echo date('Y/m/d',$rsjob['addtime']);?></a>
                                    </li>
                                    <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php
            require 'footer.php';
        ?>
    </body>
</html>
