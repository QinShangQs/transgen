<?php
require 'config.inc.php';
$sqlseo = mysql_query("select * from `".$dbpre."seo` where id=1",$conn);
$rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $rsseo['title'];?></title>
<meta name="keywords" content="<?php echo $rsseo['keywords'];?>" />
<meta name="description" content="<?php echo $rsseo['description'];?>" />
<meta name="baidu-site-verification" content="qH90G4ZYKi" />
<link rel="icon" href="http://www.transgen.com.cn/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<!--  左下角弹窗样式开始 -->
<!--
<style type="text/css">
*{padding:0px;margin:0px;}
.box{position:absolute;width:216px;height:294px;border:2px solid #FE8729;border-radius:5px;}
.box li{list-style:none;padding-left:5px;}
.box .box_t{display:block;border-bottom:1px solid #d6d6d6;height:40px;line-height:40px;font-size:14px;overflow:hidden;}
.box_hd,.box_fd{padding-right:10px;height:45px;background:#FE8729;display:block;border-bottom:1px solid #d6d6d6;color:#fff;font-size:20px;line-height:45px;}
.box_fd{ text-align:right;}
.box_fd a{color:#fff; text-decoration:none;}
.box_fd a:hover{color:#d9d9d9;}
.box ul{background:#fff;}
.box ul > .box_t > a{color:#666; text-decoration:none;}
.box ul > .box_t > a:hover{color:#FE8729;text-decoration:underline;}
</style>
-->
<!--  左下角弹窗样式结束 -->
</head>
<body>
<div id="main" class="mAuto">
   <div class="wid980 mAuto">
      <?php require 'head.php';?>
      <div class="banner2">
        <div class="img">
            <ul>
                <?php
                $sqlad = mysql_query("select * from `".$dbpre."banner` where fid=1 and isok=1 order by id desc",$conn);
                while($rsad = mysql_fetch_array($sqlad)){
                ?>
                <li><a href="<?php echo $rsad['weburl'];?>"><img src="<?php echo $rsad['pic'];?>" width="980" height="410" alt="<?php echo $rsad['alt'];?>" /></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
      </div>
      <div id="textList" class="clearfix">
        <div class="left pR wid436">
          <div class="clearfix title1">
              <h1 class="left se3 nav_bg_right">新闻动态</h1>
              <h1 class="left nav_bg_right">产品动态</h1>
              <h1 class="left">服务动态</h1>
          </div>
          <div class="threeUl">
              <ul class="commonUl1 commonUl1_1">
              <div class="pA more2"><a href="news/1.html">新闻动态列表</a></div>
                <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=1 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
                <li class="clearfix">
                	<span class="left"><?php echo date('Y/m/d',$rs['addtime']);?></span>
                    <a href="news_show/<?php echo $rs['id'];?>.html"  title="<?php echo $rs['name'];?>" class="left">【<?php echo mb_strcut($rs['name'],0,90,'utf8');?>】</a>
                </li>
                <?php
				}
				?>
              </ul>
              <ul class="commonUl1 dN">
              <div class="pA more2"><a href="news/2.html">产品动态列表</a></div>
                <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=2 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
                <li class="clearfix">
                	<span class="left"><?php echo date('Y/m/d',$rs['addtime']);?></span>
                    <a href="news_show/<?php echo $rs['id'];?>.html"  title="<?php echo $rs['name'];?>" class="left">【<?php echo mb_strcut($rs['name'],0,90,'utf8');?>】</a>
                </li>
                <?php
				}
				?>
              </ul>
              <ul class="commonUl1 dN">
              <div class="pA more2"><a href="news/3.html">服务动态列表</a></div>
                <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=3 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
                <li class="clearfix">
                	<span class="left"><?php echo date('Y/m/d',$rs['addtime']);?></span>
                    <a href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>" rel="nofollow" class="left">【<?php echo mb_strcut($rs['name'],0,90,'utf8');?>】</a>
                </li>
                <?php
				}
				?>
              </ul>
          </div>
          <!--<div class="pA more2"><a>更多动态</a></div>-->
        </div>
        <div class="left wid524">
          <div class="clearfix title2">
              <h1 class="left se3 nav_bg_right">快速下载</h1>
              <h1 class="left nav_bg_right">人才招聘</h1>
              <h1 class="left">公益基金</h1>
          </div>
          <div class="twoUl">
          	<div class="clearfix">
            	<div class="left widX">
                	<p><img src="images/img1.jpg" width="263" height="150" alt="全式金资料下载" /></p>
                    <p class="tR more1"><a href="service.html">资料下载列表</a></p>
                </div>
            	<ul class="commonUl1 left wid245 add17">
                <?php
                $sql = mysql_query("select id,name,address,addtime from `".$dbpre."download` order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
                <li class="clearfix">
                	<span class="left dN"><?php echo date('Y/m/d',$rs['addtime']);?></span>
                    <a href="<?php echo $rs['address'];?>" rel="nofollow" title="<?php echo $rs['name'];?>" class="left">【<?php echo $rs['name'];?>】</a>
                </li>
                <?php
				}
				?>
                </ul>
            </div>
            <div class="clearfix dN">
            	<div class="left widX">
                	<p><img src="images/img2.jpg" width="263" height="150" alt="全式金招聘信息" /></p>
                    <p class="tR more1"><a href="job.html">招聘信息列表</a></p>
                </div>
            	<ul class="commonUl1 left wid245 xin1">
                <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."job` order by addtime desc limit 0,5",$conn);
                while($rs = mysql_fetch_array($sql)){
                ?>
                <li class="clearfix">
                    <span class="left"><?php echo date('Y/m/d',$rs['addtime']);?></span>
                    <a class="left" style="width:160px;" rel="nofollow" href="job_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>">【<?php echo $rs['name'];?>】</a>
                </li>
                <?php
                }
                ?>
                </ul>
            </div>  
            <!-- 公益项目开始 -->
            <div class="clearfix dN">
            	<div class="left widX">
                	<p><img src="images/gongyi.png" width="263" height="150" alt="全式金助研基金信息" /></p>
                    <p class="tR more1"><a href="news/4.html">基金资讯列表</a></p>
                </div>
            	<ul class="commonUl1 left wid245 xin1">
                <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=4 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
                <li class="clearfix">
                <!--    <span class="left"><?php echo date('Y/m/d',$rs['addtime']);?></span>   -->
                    <a class="left" style="width:235px;" href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>">【<?php echo $rs['name'];?>】</a>
                </li>
                <?php
                }
                ?>
                </ul>
            </div>  
           <!-- 公益项目结束 -->
          </div>
       	 </div>
      </div>
   </div> 
   <div class="weiX" style="right:0;top:345px;cursor:pointer;">
   	 	<img src="images/wenxin.png" width="110" height="128" alt="全式金生物官方微信号--'transgen'" />
        
        <div id="BDBridgeFixedWrap" style="top:-227px;"></div>
   </div>
</div>
<?php require 'footer.php';?>
<!-- 左下角弹窗代码开始-->
<!--
<div class="box" id="box1" style="bottom:0;left:0;">
	<ul>
		<li class="box_hd">最新讲座资讯</li>
		<li class="box_t"><a href="#">北京大学--2014/7/30</a></li>
		<li class="box_t"><a href="#">北京大学--2014/7/30</a></li>
		<li class="box_t"><a href="#">北京大学--2014/7/30</a></li>
		<li class="box_t"><a href="#">北京大学--2014/7/30</a></li>
		<li class="box_t"><a href="#">北京大学--2014/7/30</a></li>
		<li class="box_fd"><a href="#">更多...</a></li>
	</ul>
</div>
<script type="text/javascript">
var $id=function(id){
return (document.getElementById(id)) || id;
}
var locked=false;
var scroll=function (o){
var space=$id(o).offsetTop;
$id(o).style.top=space+'px';
var fixed = function(){
if(locked) return;
locked=true;
var roll=setInterval(function(){
var height =document.documentElement.scrollTop+document.body.scrollTop+space;
var top = parseInt($id(o).style.top);
if(height!= top){
goTo = height-parseInt((height - top)*0.9);					$id(o).style.top=goTo+'px';
}
else{
if(roll) clearInterval(roll);
locked=false;
}
},50);
}
return fixed;
}
window.onscroll=scroll('box1');
</script>
-->
<!-- 左下角弹窗代码结束-->
<script type="text/javascript" src="js/banner-min.js"></script>
<script type="text/javascript">
$(function(){
	$('.banner2').banner({
		mode:'fade', //动画方式 fade(渐隐渐现) / slide (左右滑入)
		pages:true,	 //是否需要pages true/false
		btns:true,	//是否需要btns true/false
		title:true,	//是否需要title true/false
		auto:5000,	//停留时间
		animation:1000 //动画时间
	});	
	
})
</script>
</body>
</html>
