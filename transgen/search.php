<?php
    require 'config.inc.php';
	header("Content-type:text/html;charset=utf-8");
    //echo $key2 = urlencode(mb_convert_encoding($_GET['key'], 'utf-8', 'gb2312'));
	$key = $_GET['key'];
    $fl = $_GET['fl'];

    //查询数据
    $i=1;	
	$Page_size =15;
	$sqld ="select sid,cat,name,name_pro from `".$dbpre."product` where (name like '%$key%' or name_pro like '%$key%') and sid!=0";
    if($fl){
        $sqld .=" and cat='".$fl."'";
    }
    $sqld .= " group by sid";
	$resultd = mysql_query($sqld,$conn);
	$count = mysql_num_rows($resultd);
	$page_count = ceil($count / $Page_size);

	$init = 1;
	$page_len = 5;
	$max_p = $page_count;
	$pages = $page_count;

	//判断当前页码 
	if (empty($_GET['page']) || $_GET['page'] < 0)
	{
		$page = 1;
	}
	else
	{
		$page = $_GET['page'];
	}
	$offset = $Page_size * ($page - 1);
	
	
	
	//查询SEO
    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=11",$conn);
    $rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>"<?php echo $_GET['key'];?>"搜索结果第<?php echo $_GET['page'];?>页--全式金生物</title>
        
        <meta name="description" content="<?php echo $rsseo['description'];?>" />
        <base href="<?php echo $weburl;?>" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <style type="text/css">
		/*9.12*/
		.xia:hover{background:url(images/dow.png) no-repeat;}
		.xia{text-indent:0;text-align:center;}
		.one1{width:85px;}
		.three3{width:85px;}
		.five5{width:55px;}
		.four4{width:70px;}
		.goList li a.xia{color:#fff;font-family:"微软雅黑";line-height:26px;width:55px;margin-right:10px;}
		.down{width:250px;text-align:center;font-size:14px;}
		</style>
    </head>
    <body>
        <div id="main" class="mAuto">
            <div class="wid980 mAuto">
                <?php require 'head1.php';?>
                <div>
                    <p class="f24 fM">您搜索关键词"<?php echo $key;?>"有（<?php echo $count;?>）个匹配结果</p>
                </div>
                <div id="textList" class="clearfix" style="padding-bottom:28px;">
                    <div class="left">
                        <div class="join_title sea1">
                            <h2 class="tC f16 fM">当前过滤条件</h2>
                        </div>
                        <ul class="join_list">
                            <?php
                                $sqlcat = mysql_query("select id,catname from `".$dbpre."product_cat` where cid!=0 and id in(select cat from `".$dbpre."product` where (name like '%$key%' or name_pro like '%$key%') and sid!=0) order by px desc",$conn);
                                while($rscat = mysql_fetch_array($sqlcat)){
                                ?>
                                <li <?php if($rscat['id']==$fl){echo " class=\"se4 bg1\"";}?>><a href="search/<?php echo $key;?>_<?php echo $rscat['id'];?>_1.html" rel="nofollow"><?php echo $rscat['catname'];?></a></li>
                                <?php }?>
                        </ul>
                    </div>
                    <div class="right wid720">
                        <div>
                            <div class="hot c6 f16 fM">全部搜索结果:<?php echo $count;?></div>



                            <div>
                                <?php
                                	$b = 1;
									$sqlzt ="select sid,cat,name,name_pro from `".$dbpre."product` where (name like '%$key%' or name_pro like '%$key%') and sid!=0";
									if($fl){
										$sqlzt .=" and cat='".$fl."'";
									}
									$sqlzt .= " group by sid asc limit $offset,$Page_size";
									$queryzt = mysql_query($sqlzt, $conn);
									while ($rsd = mysql_fetch_array($queryzt)){
                                         $b++;
                                        $sqllist = mysql_query("select * from `".$dbpre."product` where id='".$rsd['sid']."'",$conn);
                                        while($rslist = mysql_fetch_array($sqllist)){
                                           
                                        ?>
                                        <div class="fa headT add12 <?php echo $b%2 ? 'bgHui' : 'fM';?>"><a><?php echo $rslist['name'];?></a></div>
                                        <ul class="goList <?php if($i!=2){echo "dN";}?>" style="border:none;">
                                            <li class="clearfix specials"> <a class="left one1">目录号</a> <a class="left three3">规 格</a> <a class="left four4">单 价</a> <a class="left five5">数 量</a> <a class="left six6 wid120">加入购物车</a> <a class="left down">文档下载</a> </li>
                                            <?php
                                                $a = 1;
                                                $sqlsid = mysql_query("select id,sid,name,guige,price,downloada,downloadb,downloadc,downloadd from `".$dbpre."product` where sid='".$rslist['id']."' order by id asc",$conn);
                                                while($rssid = mysql_fetch_array($sqlsid)){
                                                    $a++;
                                                ?>
                                                <li class="clearfix <?php echo $a%2 ? 'hui' : 'bai';?>"> <a title="<?php echo $rssid['name'];?>" class="left one1"><?php echo $rssid['name'];?></a> <a title="<?php echo $rssid['guige'];?>" class="left three3"><?php echo $rssid['guige'];?></a> <a class="left four4"><span><?php echo $rssid['price'];?></span> 元</a>
                                                    <div class="left five5">
                                                        <input type="hidden" value='<?php echo $rssid['id'];?>' />
                                                    <a class="left jian" onclick="ImgClickChang(this,0)"></a> <a class="left num"><span>1</span></a> <a class="left jia" onclick="ImgClickChang(this,1)"></a> </div>
                                                <a class="left six66 wid120" onclick="addshop(this)">加入购物车</a>
                                                <?php
                                                if($rssid['downloada']!='无'){?>
                                                <a class="left down xia" href="<?php echo $rssid['downloada'];?>">说明书</a>
                                                <?php }else{?>
                                                <a class="left down xia" style="font-size:13px;" onClick="return errorurl()">说明书</a>
                                                <?php }?>
                                               	
                                                <?php
                                                if($rssid['downloadb']!='无'){?>
                                                <a class="left down xia" href="<?php echo $rssid['downloadb'];?>"></a>
                                                <?php }else{?>
                                                <a class="left down xia" style="font-size:13px;" onClick="return errorurl()">相关文献</a>
                                                <?php }?>
                                                
                                                <?php
                                                if($rssid['downloadc']!='无'){?>
                                                <a class="left down xia" href="<?php echo $rssid['downloadc'];?>">MSDS</a>
                                                <?php }else{?>
                                                <a class="left down xia" onClick="return errorurl()">MSDS</a>
                                                <?php }?>
                                                
                                                <?php
                                                if($rssid['downloadd']!='无'){?>
                                                <a class="left down xia" href="<?php echo $rssid['downloadd'];?>"></a>
                                                <?php }else{?>
                                                <a class="left down xia" onClick="return errorurl()">COA</a>
                                                <?php }?>
                                                </li>
                                                <?php }?>
                                            <!--下面描述-->
                                            <li class="addHei">
                                                <h1 class="fW">产品说明</h1>
                                                <p> <?php echo $rslist['sm'];?> </p>
                                            </li>
                                            <li class="addHei2 clearfix">
                                                <h1 class="fW left">特点：</h1>
                                                <p class="left"><?php echo $rslist['tedian'];?></p>
                                            </li>
                                            <li class="addHei2 clearfix">
                                                <h1 class="fW left">适用范围：</h1>
                                                <p class="left"><?php echo $rslist['fanwei'];?></p>
                                            </li>
                                            <li class="addHei2 clearfix">
                                                <h1 class="fW left">保存：</h1>
                                                <p class="left"><?php echo $rslist['baocun'];?></p>
                                            </li>
                                        </ul>
                                        <?php
                                        } 
                                    }
                                $page_len   = ($page_len % 2) ? $page_len : $pagelen + 1; //页码个数
                                $pageoffset = ($page_len - 1) / 2; //页码个数左右偏移量

                                //判断URL地址参数
                                $url        = '';
                                if ($key) {
                                    $url .= "/".$key."_".$fl;
                                }

                                $key = "<div style='padding-top:30px;' class=\"page\">";
                                if ($page != 1) {
                                    $key .= "<a href=\"search".$url."_1.html\" rel='nofollow'>First</a>"; //首页
                                    $key .= "<a href=\"search".$url."_".($page-1).".html\" rel='nofollow'>Prev</a>";//上一页	
                                }
                                else {
                                    $key .= "<a rel='nofollow'>First</a>"; //首页
                                    $key .= "<a rel='nofollow'>Prev</a>"; //第一页
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
                                        $key .= "<a href=\"search".$url."_" . $i . ".html\" class=\"page_a\">" . $i . "</a>";
                                    }
                                    else {
                                        $key .= "<a href=\"search".$url."_" . $i . ".html\">" . $i . "</a>";
                                    }

                                }
                                if ($page != $pages) {
                                    $key .= "<a href=\"search".$url."_".($page+1).".html\" rel='nofollow'>Next</a>";//下一页
                                    $key .= "<a href=\"search".$url."_{$pages}.html\" rel='nofollow'>Last</a>"; //最后一页
                                }
                                else {
                                    $key .= "<a rel='nofollow'>Next</a>";//下一页
                                    $key .= "<a rel='nofollow'>Last</a>"; //最后一页
                                }
                                $key .= "</div>";
                                ?>
                            </div>
							
							<div>
							<?php if($count >0){ echo $key;}else{echo "暂无内容";}?>
							</div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'footer.php';?>
		<script type="text/javascript">       
            //加入购物车
            function addshop(e,num){
                var num = $(e).prev().find("span").html();
                var did = $(e).parent().find("input:hidden").val();
                var price = $(e).parent().find("span").html();

                //修改COOKIE 数组
                $.post("add_shop.php", { Action: "post", did: did, nnum: num, price: price },
                    function(_obj) {
                        var result = _obj;

                        if (result == null || result == "") {
                            alert('程序出错!');
                            return false;
                        }
                        result = result.split("|");           
                        if (result[0] == "1") {
                            alert('已加入购物车');
                        }else{
                            alert('加入失败');
                        }
                });
            }

            //修改数量
            function ImgClickChang(e, type) {
                var num = $(e).parent().find("span").html();
                var did = $(e).parent().find("input:hidden").val();   
                num = parseInt(num);
                if (type == "1") {
                    num = num + 1;
                }
                if (type == "0") {
                    num = num - 1;
                }
                if (num <= 0) {
                    num = 1;
                } 
                $(e).parent().find("span").html(num);
            }
        </script>
        <script type="text/javascript">
			function errorurl(){
				alert("暂无下载资料!");
				return false;
			}
		</script>
    </body>
</html>
