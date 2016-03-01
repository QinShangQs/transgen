<?php
require 'config.inc.php';

if($_GET['id']){
	$sqlcat = mysql_query("select * from `".$dbpre."danye` where id='".$_GET['id']."'",$conn);
	$rs = mysql_fetch_array($sqlcat);
}else{
	$sqlcat = mysql_query("select * from `".$dbpre."danye` order by id desc limit 0,1",$conn);
	$rs = mysql_fetch_array($sqlcat);
}
$id = getParam('id', 'GET', $rs['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>走进全式金-<?php echo $rs['name'];?></title>
<meta name="keywords" content="<?php echo $rs['keywords'];?>" />
<meta name="description" content="<?php echo $rs['description'];?>" />
<base href="<?php echo $weburl;?>" />
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <?php require 'head.php';?>   
   <div class="wid980 mAuto">  

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
                <li style="width: 100%" <?php if($id==$rsload['id']){echo " class=\"se4 bg1\"";}?>><a href="about/<?php echo $rsload['id'];?>.html"><?php echo $rsload['name'];?></a></li>
                <?php
				}
				?>
                <li style="width: 100%"><a href="partner.html">合作伙伴</a></li>
                <li style="width: 100%"><a href="contact.html">联系我们</a></li>
            </ul>
        </div>
        <div class="right wid720">
        	<div class="clearfix comTitle">
            	<div class="left f18 fM"><?php echo $rs['name'];?></div>
                <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <a href="about.html">走进全式金</a> > <span><?php echo $rs['name'];?></span></div>
            </div>
            <div>
            	<?php echo $rs['content'];?>
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
