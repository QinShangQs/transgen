<div id="top" class="clearfix">
	<dl class="left dZ">
    	<dd class="left">欢迎来到全式金！</dd>
        <?php
        if($_SESSION['username']){
		?>
        <dd class="left"><span id="uname" style="color:#ec8e00;font-weight:bold;padding:0 3px;"><?php echo $_SESSION['username'];?></span></dd>
        <dd class="left"> <a href="logout.php" rel="nofollow">安全退出</a></dd>
        <?php
		}else{
		?>
        <dd class="left" style="padding:0 5px;"><a href="javascript:login()" rel="nofollow">[登陆]</a>  </dd>
        <dd class="left"><a href="javascript:login()" rel="nofollow">[免费注册]</a></dd>
        <?php
		}
		?>
    </dl>
  <ul class="right topLi pR">
    <li class="left li_1" style="border:none;">0086-400-898-0321</li>
    <li class="left li_2"><a href="shop.html" rel="nofollow">购物车</a></li>
    <li class="left li_3"><a href="http://e.weibo.com/transgen" rel="nofollow">新浪微博</a></li>
    <li class="left li_4"><a href="http://page.renren.com/601484932" rel="nofollow">人人网</a></li>
    <li class="left li_5"><a class="ying" href="http://www.transgenbiotech.com" rel="nofollow">English</a></li>
  </ul>
</div>
<div id="header" class="clearfix">
  <div class="left"> <a href="http://www.transgen.com.cn"><img src="images/logo.png" width="323" height="94" alt="细胞生物学-分子生物学-实验技术服务-全式金" title="细胞生物学-分子生物学-实验技术服务-全式金生物试剂" /></a> </div>
  <div class="right">
    <form class="clearfix margin1" action="searcha.php" name="form11" id="form11" onsubmit="return checkformkey()">
      <input type="text" class="left cont" name="key" id="key"  value="请输入您要查询的产品名、货号等关键字..." onfocus="if (value =='请输入您要查询的产品名、货号等关键字...'){value =''}"onblur="if (value ==''){value='请输入您要查询的产品名、货号等关键字...'}"/>
      <input class="left ti" type="submit" value="" name="ok" />
    </form>
    <ul class="clearfix nav">
      <li class="left pR">
      	<a href="products.html" rel="nofollow" class="f16">产品中心</a>
      	<dl class="pA navSon dN">
        	<?php
			$sqlm = mysql_query("select id,catname from `".$dbpre."product_cat` where cid!=0 order by px desc",$conn);
			while($rsm = mysql_fetch_array($sqlm)){
			?>
            <dd class="leis"><a href="products/<?php echo $rsm['id'];?>.html" rel="nofollow" class="zuo fA"><?php echo $rsm['catname'];?></a></dd>
           <?php }?> 
        </dl>
      </li>
      <li class="left pR">
      	<a href="service.html" rel="nofollow" class="f16">服务与支持</a>
      	<dl class="pA navSon dN">
			<dd class="leis"><a href="jishu_chaxun.php" rel="nofollow" class="zuo fA">技术服务查询</a></dd>
        	<?php
			$sqlflm = mysql_query("select id,catname from `".$dbpre."catdownload` order by id desc",$conn);
			while($rsloadm = mysql_fetch_array($sqlflm)){
			?>
            <dd class="leis"><a href="service/<?php echo $rsloadm['id'];?>.html" class="zuo fA" rel="nofollow"><?php echo $rsloadm['catname'];?></a></dd>
            <?php }?>
            <dd class="leis"><a href="faq.html" class="zuo fA" rel="nofollow">产品FAQ</a></dd>
            <dd class="leis"><a href="video.html" rel="nofollow" class="zuo fA">视频讲座</a></dd>
        </dl>
      </li>
      <li class="left pR">
      	<a href="shop.html" rel="nofollow" class="f16">订购中心</a>
      	<dl class="pA navSon navSonL dN">
        	
        </dl>
      </li>
      <li class="left pR">
      	<a class="f16" href="about.html" rel="nofollow">走进全式金</a>
      	<dl class="pA navSon navSonL dN" style="text-align:center;">
        		<?php
                $sqlflab = mysql_query("select id,name from `".$dbpre."danye` order by id desc",$conn);
				while($rsab = mysql_fetch_array($sqlflab)){
				?>
                <dd class="leis"><a href="about/<?php echo $rsab['id'];?>.html" class="zuo fA" style="text-indent:0px;" rel="nofollow"><?php echo $rsab['name'];?></a></dd>
                <?php
				}
				?>
                <dd class="leis"><a href="partner.html" class="zuo fA" style="text-indent:0px;" rel="nofollow">合作伙伴</a></dd>
                <dd class="leis"><a href="contact.html" class="zuo fA" style="text-indent:0px;" rel="nofollow">联系我们</a></dd>
        </dl>
      </li>
    </ul>
  </div>
</div>
