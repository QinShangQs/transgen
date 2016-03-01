<?php
    require 'config.inc.php';
    $cat = getParam('cat', 'GET');
    if($cat){
        $sqlcat = mysql_query("select * from `".$dbpre."catnews` where id='".$cat."'",$conn);
        $rscat = mysql_fetch_array($sqlcat);
    }else{
        echo "<script>alert('参数错误');window.location.href='javascript:history.go(-1)'</script>";
        exit();
    }
    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=10",$conn);
    $rsseo = mysql_fetch_array($sqlseo);
	//判断当前页码 
        if (empty($_GET['page']) || $_GET['page'] < 0)
            {
                $page = 1;
                                }
        else
            {
                $page = $_GET['page'];
            }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $rscat['catname'];?>列表第<?php echo $page;?>页--北京全式金生物(TransGen Biotech)</title>
        <meta name="description" content="<?php echo $rsseo['description'];?>" />
        <base href="<?php echo $weburl;?>" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
    </head>
    <body>
    <?php require 'head.php';?>   
     <div class="wid980 mAuto"> 
                <div class="dN">
                    <img src="images/new.jpg" width="980" height="150" />
                </div>
                <div id="textList">
                    <div class="wid720" style="width:980px;">
                        <div class="clearfix comTitle">
                            <div class="left f18 fM"><?php echo $rscat['catname'];?></div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span><?php echo $rscat['catname'];?></span></div>
                        </div>
                        <ul class="newsList">
                            <?php
                                $Page_size =12;
                                $sqld = "SELECT id,cat FROM `".$dbpre."news` where cat='".$cat."'";
                                $resultd = mysql_query($sqld,$conn);
                                $count = mysql_num_rows($resultd);
                                $page_count = ceil($count / $Page_size);

                                $init = 1;
                                $page_len = 5;
                                $max_p = $page_count;
                                $pages = $page_count;

                                
                                $offset = $Page_size * ($page - 1);

                                $sqlzt = "select id,cat,name,addtime from `".$dbpre."news` where cat='".$cat."' order by addtime desc limit $offset,$Page_size";
                                $queryzt = mysql_query($sqlzt, $conn);
                                while ($rslist = mysql_fetch_array($queryzt))
                                {
                                ?>
                                <li class="clearfix">
                                    <a class="left" href="news_show/<?php echo $rslist['id'];?>.html" title="<?php echo $rslist['name'];?>"><?php echo $rslist['name'];?></a>
                                    <span class="right"><?php echo date('Y/m/d',$rslist['addtime']);?></span>
                                </li>
                                <?php
                                }
                                $page_len   = ($page_len % 2) ? $page_len : $pagelen + 1; //页码个数
                                $pageoffset = ($page_len - 1) / 2; //页码个数左右偏移量

                                //判断URL地址参数
                                $url        = '';
                                if ($cat) {
                                    $url .= "/".$cat;
                                }

                                $key = "<div class=\"page\">";
                                if ($page != 1) {
                                    $key .= "<a href=\"news".$url."/1.html\">First</a>"; //首页
                                    $key .= "<a href=\"news".$url."/".($page-1).".html\">Prev</a>";//上一页	
                                }
                                else {
                                    $key .= "<a>First</a>"; //首页
                                    $key .= "<a>Prev</a>"; //第一页
                                }
                                if ($pages > $page_len) {
                                    //如果当前页小于等于左偏移
                                    if ($page <= $pageoffset) {
                                        $init = 1;
                                        $max_p= $page_len;
                                    }
                                    else {
                                        //如果当前页大于左偏移
                                        //如果当前页码右偏移超出最大分页数
                                        if ($page + $pageoffset >= $pages + 1) {
                                            $init = $pages - $page_len + 1;
                                        }
                                        else {
                                            //左右偏移都存在时的计算
                                            $init = $page - $pageoffset;
                                            $max_p= $page + $pageoffset;
                                        }
                                    }
                                }
                                for ($i = $init; $i <= $max_p; $i++) {
                                    if ($i == $page) {
                                        $key .= "<a href=\"news".$url."/" . $i . ".html\" class=\"page_a\">" . $i . "</a>";
                                    }
                                    else {
                                        $key .= "<a href=\"news".$url."/" . $i . ".html\">" . $i . "</a>";
                                    }

                                }
                                if ($page != $pages) {
                                    $key .= "<a href=\"news".$url."/".($page+1).".html\">Next</a>";//下一页
                                    $key .= "<a href=\"news".$url."/{$pages}.html\">Last</a>"; //最后一页
                                }
                                else {
                                    $key .= "<a>Next</a>";//下一页
                                    $key .= "<a>Last</a>"; //最后一页
                                }
                                $key .= "</div>";
                            ?>           
                        </ul>
                        <div class="clearfix">
                            <?php if($count >0){ echo $key;}else{echo "暂无内容";}?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php require 'footer.php';?>
    </body>
</html>
