<?php
require 'config.inc.php';
$id = getParam('id', 'GET');
if($id){
	$sql = mysql_query("select * from `".$dbpre."news` where id='".$id."'",$conn);
	$rs = mysql_fetch_array($sql);
	
	$sqlcat = mysql_query("select id,catname from `".$dbpre."catnews` where id='".$rs['cat']."'",$conn);
	$rscat = mysql_fetch_array($sqlcat);
	
	//文章浏览量增加
	$yuedu = $rs['hist'] + 1;
	$sql_edit_yuedu = "update `".$dbpre."news` set hist=$yuedu where id='" . $id . "'";
	mysql_query ( $sql_edit_yuedu, $conn );
	
}else{
	echo "<script>alert('参数错误');window.location.href='javascript:history.go(-1)'</script>";
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $rs['title'];?>-全式金生物</title>
<meta name="description" content="<?php echo $rs['description'];?>" />
<base href="<?php echo $weburl;?>" />
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div id="main" class="mAuto">
   <div class="wid980 mAuto">
      <?php require 'head1.php';?>      
      <div class="dN">
      	<img src="images/new.jpg" width="980" height="150" />
      </div>
      <div id="textList">
        <div class="wid720" style="width:980px;">
        	<div class="clearfix comTitle">
            	<div class="left f18 fM"><?php echo $rscat['catname'];?></div>
                <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span><?php echo $rscat['catname'];?></span></div>
            </div>
            <div id="content">
            	<h1 class="f18 fM waiJ"><?php echo $rs['name'];?></h1>
                <div class="clearfix read">
                	<span class="left dN">已被阅读 <?php echo $rs['hist'];?> 次</span>
                    
                </div>
                <div style="float:none;" id="bdshare" class="bdshare_t bds_tools get-codes-bdshare clearfix">
                  <span class="bds_more">分享到：</span>
                  <a class="bds_qzone"></a>
                  <a class="bds_tsina"></a>
                  <a class="bds_tqq"></a>
                  <a class="bds_renren"></a>
                  <a class="bds_t163"></a>
                  <a class="shareCount"></a>
                </div>
                <p>
                <?php echo $rs['content'];?>
                </p>
                <div class="pR return">
                <?php
				$sql ="select * from `".$dbpre."news` where id>$id and cat='".$rs['cat']."' order by id asc limit 0,1";   
				//上一篇文章  
				$sql1 ="select * from `".$dbpre."news` where id<$id and cat='".$rs['cat']."' order by id desc limit 0,1";  
				//下一篇文
			
				$result1 = mysql_query( $sql1);  
				if( mysql_num_rows($result1))  
				{  
				$rs1 = mysql_fetch_array( $result1 );  
				  
				 echo "<div>上一篇：<a href='news_show/".$rs1['id'].".html'>".$rs1['name']."</a></div>";   
				 } else {  
				  echo "<div>上一篇：<a>没有了</a></div>";   
				 }
				
				
				$result = mysql_query($sql);   
				if( mysql_num_rows( $result )) {   
				$rs = mysql_fetch_array( $result );  
			 
				 echo "<div>下一篇：<a href='news_show/".$rs['id'].".html'>".$rs['name']."</a></div>";   
				 } else {  
				  echo "<div>下一篇：<a>没有了</a></div>";    
				}
			  ?>
                <a class="pA tC" href="news/<?php echo $rs['cat'];?>.html">返回列表</a>
                </div>
            </div>
        </div>
      </div>
   </div> 
</div>
<?php require 'footer.php';?>
</body>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
</html>
