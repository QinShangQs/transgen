<?php
require 'config.inc.php';

$id = 1;
$sql = mysql_query("select * from `".$dbpre."contact` where id='".$id."'",$conn);
$rs = mysql_fetch_array($sql);

$sqlseo = mysql_query("select * from `".$dbpre."seo` where id=7",$conn);
$rsseo = mysql_fetch_array($sqlseo);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>走进全式金-<?php echo $rsseo['title'];?></title>
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
                <li><a href="partner.html">合作伙伴</a></li>
                <li class="se4 bg1"><a href="contact.html">联系我们</a></li>
            </ul>
        </div>
        <div class="right wid720">
        	<div class="clearfix comTitle">
            	<div class="left f18 fM">联系我们</div>
                <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <a href="about.html">走进全式金</a> > <span>联系我们</span></div>
            </div>
            <div class="map">
            	<div><br /><br />
                	<h1 class="fM f16">客户服务电话：<span class="cF f18"><?php echo $rs['khtel'];?></span></h1>
                    <h1 class="fM f16">技术支持热线：<span class="cF f18"><?php echo $rs['jstel'];?></span></h1>
                    <br />
                </div>
                <div class="clearfix">
                	<div class="left leftSide1">
                    	<p class="f16 fW zong cF"><?php echo $rs['name1'];?></p>
                    	<div class="wid254">
                        	<p><?php echo $rs['content1'];?></p>
                        </div>
                    </div>
                    <div class="right">
                    	<div style="width:405px;height:341px;border:#ccc solid 1px;" id="dituContent"></div>
                    </div>
                </div>
                <div class="clearfix marTop">
                	<div class="left leftSide1">
                    	<p class="f16 fW zong"><?php echo $rs['name2'];?></p>
                    	<div class="wid254">
                        	<p><?php echo $rs['content2'];?></p>
                        </div>
                    </div>
                    <div class="right">
                    	<div style="width:405px;height:341px;border:#ccc solid 1px;" id="dituContent2"></div>
                    </div>
                </div>
				  <div class="clearfix marTop">
                	<div class="left leftSide1">
                    	<p class="f16 fW zong"><?php echo $rs['name3'];?></p>
                    	<div class="wid254">
                        	<p><?php echo $rs['content3'];?></p>
                        </div>
                    </div>
                    <div class="right">
                    	<div style="width:405px;height:341px;border:#ccc solid 1px;" id="dituContent1"></div>
                    </div>
                </div>

				<div class="clearfix marTop">
                	<div class="left leftSide1">
                    	<p class="f16 fW zong"><?php echo $rs['name4'];?></p>
                    	<div class="wid254">
                        	<p><?php echo $rs['content4'];?></p>
                        </div>
                    </div>
                    <div class="right">
                    	<div style="width:405px;height:341px;border:#ccc solid 1px;" id="dituContent3"></div>
                    </div>
                </div>

            </div>
            
        </div>
      </div>
   </div> 
</div>
<?php require 'footer.php';?>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
<script type="text/javascript">  
$(document).ready(function(){  
$('.nav li').eq(3).addClass('se1');  
});  
</script>
</body>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(116.365465,40.049464);//定义一个中心点坐标
        map.centerAndZoom(point,15);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    
    initMap();//创建和初始化地图
</script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent2");//在百度地图容器中创建一个地图
        var point = new BMap.Point(121.447569,31.184089);//定义一个中心点坐标
        map.centerAndZoom(point,17);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    
    initMap();//创建和初始化地图
</script>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent1");//在百度地图容器中创建一个地图
        var point = new BMap.Point(113.327769,23.142623);//定义一个中心点坐标
        map.centerAndZoom(point,20);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    
    initMap();//创建和初始化地图
</script>

<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent3");//在百度地图容器中创建一个地图
        var point = new BMap.Point(113.927965,22.52275);//定义一个中心点坐标
        map.centerAndZoom(point,20);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
                //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
	map.addControl(ctrl_sca);
    }
    
    
    initMap();//创建和初始化地图
</script>

</html>
