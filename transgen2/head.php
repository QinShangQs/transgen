<script type="text/javascript">
        function checkformkey() {
            if ($("#key").val() == "" || $("#key").val().trim() == "") {
                alert("请填写搜索关键词！");
                $("#key").focus();
                return false;
            }
            return true;
        }
</script>


<div class="wrap cf">
		<div class="top-sub-nav cf">
			<div class="menu fl" style="margin-left: 0">
				<span class="">欢迎来到全式金！</span> 
				 <?php
			        if($_SESSION['username']){
				?>
				<span id="uname" style="color:white;font-weight:bold;padding:0 3px;"><?php echo $_SESSION['username'];?></span>
				<a href="logout.php" rel="nofollow">安全退出</a>
				 <?php
				}else{
				?>
				<span href="" class="login"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<a href="javascript:login()" rel="nofollow">登录</a>/<a href="javascript:login()" rel="nofollow">注册</a></span>
				<?php
				}
				?>
			</div>
			<p class="phone fr">
				<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>0086-400-898-0321
			</p>
			<div class="menu fr">
				<a href="shop.html" class="shop"><span
					class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>购物车</a>
				<span class="share"><span class="glyphicon glyphicon-share"
					aria-hidden="true"></span><a href="http://e.weibo.com/transgen" rel="nofollow"> 新浪微博</a>
				 <a href="http://page.renren.com/601484932" rel="nofollow">人人网</a></span>
				 <a href="http://www.transgenbiotech.com" class="english"><span
					class="glyphicon glyphicon-send" aria-hidden="true"></span>English</a>

			</div>
		</div>
	</div>
	<div class="top-nav wrap cf">
		<div class="logo fl">
			<img src="images/logo.png">
		</div>
		<form id="searchaff" class="search-box cf fr" action="searcha.php"
			onsubmit="return checkformkey()">
			<input type="text" class="search-input fl" name="key" id="key"
				value="请输入您要查询的产品名、货号等关键字..."
				onfocus="if (value =='请输入您要查询的产品名、货号等关键字...'){value =''}"
				onblur="if (value ==''){value='请输入您要查询的产品名、货号等关键字...'}"> <span
				class="glyphicon glyphicon-search search-btn fl" aria-hidden="true" onclick="document.getElementById('searchaff').submit()"></span>
			<!-- <input class="submit-btn" type="submit" value="" name="ok"> -->
		</form>
	</div>
	<div class="bottom-nav cf">
		<div class="wrap cf">
			<ul class="cf fl">
				<li class="product active"><a href=""> <span
						class="glyphicon glyphicon-home" aria-hidden="true"></span>
						<p>产品中心</p> <!-- <b></b> -->
				</a></li>
				<li class="support"><a href=""> <span
						class="glyphicon glyphicon-random" aria-hidden="true"></span>
						<p>服务与支持</p>
				</a></li>
				<li class="booking"><a href=""> <span
						class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
						<p>订购中心</p>
				</a></li>
				<li class="intro"><a href=""> <span class="glyphicon glyphicon-leaf"
						aria-hidden="true"></span>
						<p>走进全式金</p>
				</a></li>
			</ul>

		</div>
	</div>

<?php
?>