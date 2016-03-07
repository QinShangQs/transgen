<?php
require 'config.inc.php';
$sqlseo = mysql_query ( "select * from `" . $dbpre . "seo` where id=1", $conn );
$rsseo = mysql_fetch_array ( $sqlseo );
?>
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $rsseo['title'];?></title>
<meta name="keywords" content="<?php echo $rsseo['keywords'];?>" />
<meta name="description" content="<?php echo $rsseo['description'];?>" />
<meta name="baidu-site-verification" content="qH90G4ZYKi" />
<link rel="icon" href="http://www.transgen.com.cn/favicon.ico"
	type="image/x-icon" />

<link type="text/css" href="css/index.css" rel="stylesheet" />
</head>
<body>
	<?php require 'head.php';?>
	<div class='iosSliderDemo'>
		<div class='fluidHeight'>
			<div class='sliderContainer'>
				<div class='iosSlider'>

					<div class='slider'>
						 <?php
							$sqlad = mysql_query ( "select * from `" . $dbpre . "banner` where fid=1 and isok=1 order by id desc", $conn );
							while ( $rsad = mysql_fetch_array ( $sqlad ) ) {
								?>
			                <div class='item' id='item1' onclick="location.href='<?php echo $rsad['weburl'];?>'" 
			                title="<?php echo $rsad['alt'];?>" style="background:url(<?php echo $rsad['pic'];?>)">
							<div class='caption'>
								<div class='bg'></div>
							</div>
						</div>			                	
			                <?php
			                }
			                ?>

					</div>

				</div>

				<div class='slideSelectors'>
					 <?php
							$sqlad = mysql_query ( "select * from `" . $dbpre . "banner` where fid=1 and isok=1 order by id desc", $conn );
							while ( $rsad = mysql_fetch_array ( $sqlad ) ) {
					?>
						<div class='item'></div>
					<?php
			                }
			         ?>
				</div>
				<div class='scrollbarContainer'></div>
			</div>
		</div>
	</div>

	<div class="art-list-box cf wrap">
		<div class="fl">
			<div class="title-box">
				<a href="news/1.html"><img src="images/news.png" /></a>
				<p class="title">新闻动态</p>
			</div>
			<ul>
				 <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=1 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
				<li><a href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>"><!-- <strong>Trans团购<?php echo date('Y/m/d',$rs['addtime']);?></strong> --> <?php echo mb_strcut($rs['name'],0,90,'utf8');?></a></li>
				 <?php
				}
				?>
			</ul>
		</div>
		<div class="fl border">
			<div class="title-box">
				<a href="news/2.html"><img src="images/product.png" /></a>
				<p class="title">产品动态</p>
			</div>
			<ul>
				 <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=2 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
				<li><a href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>"><!-- <strong>Trans团购<?php echo date('Y/m/d',$rs['addtime']);?></strong> --> <?php echo mb_strcut($rs['name'],0,90,'utf8');?></a></li>
				 <?php
				}
				?>
			</ul>
		</div>
		<div class="fl">
			<div class="title-box">
				<a href="news/3.html"><img src="images/support.png" /></a>
				<p class="title">服务动态</p>
			</div>
			<ul>
				 <?php
                 $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=3 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
				<li><a href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>"><!-- <strong>Trans团购<?php echo date('Y/m/d',$rs['addtime']);?></strong> --> <?php echo mb_strcut($rs['name'],0,90,'utf8');?></a></li>
				 <?php
				}
				?>
			</ul>
		</div>

	</div>

	<div class="cf wrap"  >
		<div class="fl cf file-box" >
			<div><img src="images/img1.jpg" /></div>
			<ul>
				<?php
                $sql = mysql_query("select id,name,address,addtime from `".$dbpre."download` order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>			
				<li>
				<a href="<?php echo $rs['address'];?>" title="<?php echo $rs['name'];?>" >
				<?php echo $rs['name'];?></a></li>
				<?php
				}
				?>
			</ul>
		</div>
		<div class="fl cf gongyi-box">
			<div><img src="images/gongyi.png" /></div>
			<ul >
				 <?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."job` order by addtime desc limit 0,5",$conn);
                while($rs = mysql_fetch_array($sql)){
                ?>
				<li>
				<a  href="job_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>">
					<?php echo $rs['name'];?></a></li>
				 <?php
                }
                ?>
			</ul>
		</div>
		<div class="fl cf recruit">
			<div><img src="images/zhaopin.jpg"  /></div>
			<ul >
			<?php
                $sql = mysql_query("select id,name,addtime from `".$dbpre."news` where cat=4 order by addtime desc limit 0,5",$conn);
				while($rs = mysql_fetch_array($sql)){
				?>
				<li><a href="news_show/<?php echo $rs['id'];?>.html" title="<?php echo $rs['name'];?>"><?php echo $rs['name'];?></a></li>
				<?php
                }
                ?>
			</ul>
		</div>
	</div>

	<?php require 'footer.php';?>
	

	<script type="text/javascript">
		$(document).ready(function() {
				$('.iosSlider').iosSlider({
					desktopClickDrag: true,
					snapToChildren: true,
					infiniteSlider: true,
					snapSlideCenter: true,
					navSlideSelector: '.sliderContainer .slideSelectors .item',
					navPrevSelector: '.sliderContainer .slideSelectors .prev',
					navNextSelector: '.sliderContainer .slideSelectors .next',
					onSlideComplete: slideComplete,
					onSliderLoaded: sliderLoaded,
					onSlideChange: slideChange,
					autoSlide: true,
					scrollbar: true,
					scrollbarContainer: '.sliderContainer .scrollbarContainer',
					scrollbarMargin: '0',
					scrollbarBorderRadius: '0',
					keyboardControls: true
				});
			
			});
			
			function slideChange(args) {
				$('.sliderContainer .slideSelectors .item').removeClass('selected');
				$('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');
			}
			
			function slideComplete(args) {
				if(!args.slideChanged) return false;
				$(args.sliderObject).find('.text1, .text2').attr('style', '');
				$(args.currentSlideObject).find('.text1').animate({
					left: '30px',
					opacity: '0.8'
				}, 700, 'easeOutQuint');
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					left: '30px',
					opacity: '0.8'
				}, 600, 'easeOutQuint');
			}
			
			function sliderLoaded(args) {
				$(args.sliderObject).find('.text1, .text2').attr('style', '');
				$(args.currentSlideObject).find('.text1').animate({
					left: '30px',
					opacity: '0.8'
				}, 700, 'easeOutQuint');
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					left: '30px',
					opacity: '0.8'
				}, 600, 'easeOutQuint');
				slideChange(args);
			}

		
</script>
</body>
</html>


