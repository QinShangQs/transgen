<?php
    require 'config.inc.php';

    if($_GET['cat']){
        $sqlcat = mysql_query("select id,catname,ms from `".$dbpre."product_cat` where id='".$_GET['cat']."' order by id",$conn);
        $rsfl = mysql_fetch_array($sqlcat);
    }else{
        $sqlcat = mysql_query("select id,catname,ms from `".$dbpre."product_cat` order by px desc limit 0,1",$conn);
        $rsfl = mysql_fetch_array($sqlcat);
    }
    $cat = getParam('cat', 'GET', $rsfl['id']);

    $sqlseo = mysql_query("select * from `".$dbpre."seo` where id=11",$conn);
    $rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $rsfl['catname']."-".$rsseo['title'];?></title>
        <meta name="description" content="<?php echo mb_substr(strip_tags($rsfl['ms']),0,120,'utf-8');?>" />
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
		.goList li a.xia{color:#fff;font-family:"微软雅黑";line-height:31px;width:55px;margin-right:10px;}
		.down{width:250px;text-align:center;}
		.goList li a.xiaS{line-height:28px;}
		.textIn{text-indent:-8px\0;}
		</style>
    </head>
    <body>
        <div id="main" class="mAuto">
            <div class="wid980 mAuto">
                <?php require 'head1.php';?>                
                <div class="dN">
                    <img src="images/chanpin1.jpg" width="980" height="150" />
                </div>
                <div id="textList" class="clearfix" style="padding-bottom:28px;">
                    <div class="left widt220">
                        <div class="join_title">
                            <h1 class="tC f24"></h1>
                            <h2 class="tC f24 fM">产品中心</h2>
                        </div>
                        <ul class="join_list join_list1">
                            <?php
                                $sqlcat = mysql_query("select id,catname from `".$dbpre."product_cat` where cid!=0 order by px desc",$conn);
                                while($rscat = mysql_fetch_array($sqlcat)){
                                ?>
                                <li <?php if($rscat['id']==$cat){echo " class=\"se4 bg1\"";}?>><a href="products/<?php echo $rscat['id'];?>.html"><?php echo $rscat['catname'];?></a>
                                	
                                </li>
                                <?php }?>   
                        </ul>
                    </div>
                    <div class="right wid720">
                        <div class="clearfix comTitle">
                            <div class="left f18 fM"><?php echo $rsfl['catname'];?></div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <a href="products.html" rel="nofollow">产品中心</a> ><span> <?php echo $rsfl['catname'];?></span></div>
                        </div>
                        <div>
                            <div class="hot c6"><?php echo $rsfl['ms'];?></div>
                            <div>
                                <?php
                                    $i=1;
                                    $sqllist = mysql_query("select id,name,cat,sid,sm,tedian,fanwei,baocun from `".$dbpre."product` where cat='".$cat."' and sid=0 order by addtime",$conn);
                                    while($rslist = mysql_fetch_array($sqllist)){
                                        $i++;
                                    ?>
                                    <div class="headT fM clicks <?php if($i%2){echo "bgHui";}?>"><a><?php echo $rslist['name'];?></a></div>
                                    <ul class="goList <?php if($i!=2){echo "dN";}?>" style="border:none;display:none;">

                                        <li class="clearfix specials">
                                            <a class="left one1">目录号</a>
                                            <a class="left three3">规 格</a>
                                            <a class="left four4">单 价</a>
                                            <a class="left five5">数 量</a>
                                            <a class="left six6 wid120">加入购物车</a>
                                            <a class="left down">文档下载</a>
                                        </li>
                                        <?php
                                            $a = 1;
                                            $sqlsid = mysql_query("select id,sid,name,guige,price,downloada,downloadb,downloadc,downloadd from `".$dbpre."product` where sid='".$rslist['id']."' order by addtime",$conn);
                                            while($rssid = mysql_fetch_array($sqlsid)){
                                                $a++;
                                            ?>
                                            <li class="clearfix <?php echo $a%2 ? 'hui' : 'bai';?>">                                        
                                                <a class="left one1 fA f14" title="<?php echo $rssid['name'];?>"><?php echo $rssid['name'];?></a>
                                                <a class="left three3 fA f14" title="<?php echo $rssid['guige'];?>"><?php echo $rssid['guige'];?></a>
                                                <a class="left four4 fA f14"><span><?php echo $rssid['price'];?></span> 元</a>
                                                <div class="left five5">
                                                    <input type="hidden" value='<?php echo $rssid['id'];?>' />
                                                    <a class="left jian" onclick="ImgClickChang(this,0)"></a>
                                                    <a class="left num"><span>1</span></a>                                        
                                                    <a class="left jia" onclick="ImgClickChang(this,1)"></a>
                                                </div>
                                                <a class="left six66 wid120" onclick="addshop(this)">加入购物车</a>
                                                <?php
                                                if($rssid['downloada']!='无'){?>
                                                <a class="left down xia textIn" href="<?php echo $rssid['downloada'];?>">说明书</a>
                                                <?php }else{?>
                                                <a class="left down xia textIn" onClick="return errorurl()">说明书</a>
                                                <?php }?>
                                               	
                                                <?php
                                                if($rssid['downloadb']!='无'){?>
                                                <a class="left down xia textIn" href="<?php echo $rssid['downloadb'];?>">相关文献</a>
                                                <?php }else{?>
                                                <a class="left down xia textIn" onClick="return errorurl()">相关文献</a>
                                                <?php }?>
                                                
                                                <?php
                                                if($rssid['downloadc']!='无'){?>
                                                <a class="left down xia xiaS f14" href="<?php echo $rssid['downloadc'];?>">MSDS</a>
                                                <?php }else{?>
                                                <a class="left down xia xiaS f14" onClick="return errorurl()">MSDS</a>
                                                <?php }?>
                                                
                                                <?php
                                                if($rssid['downloadd']!='无'){?>
                                                <a class="left down xia xiaS f14" href="<?php echo $rssid['downloadd'];?>">COA</a>
                                                <?php }else{?>
                                                <a class="left down xia xiaS f14" onClick="return errorurl()">COA</a>
                                                <?php }?>
                                                
                                            </li>
                                            <?php }?>

                                        <!--下面描述-->

                                        <li class="addHei">
                                            <h1 class="fW">产品说明</h1>
                                            <p>
                                                <?php echo $rslist['sm'];?>
                                            </p>
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
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php require 'footer.php';?>
		        <script type="text/javascript">  
            $(document).ready(function(){
                $('.nav li').eq(0).addClass('se1');  
            });  
        </script>
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
