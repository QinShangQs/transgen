<?php require 'config.inc.php'; ?>
<!Doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>全式金-实验技术委托服务进度查询</title>
<base href="<?php echo $weburl;?>" />
</head>
<body>
    <?php require 'head.php';?>   
	<div class="winContent">
		<div class="win980">
			<div class="comme">
				<div class="f18">实验技术委托服务进度查询</div>
				<div class="sub">
					<a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>实验技术委托服务进度查询</span>
				</div>
			</div>
			<div id="content" style="height: 400px;">
				<form action="jishu_jieguo.php" method="post"
					style="display: block; text-align: center; padding: 40px;">
					<span
						style="display: block; height: 34px; line-height: 34px; font-size: 20px; margin-right: 60px;">请输入您的订单号</span><input
						name="dingdanhao" type="text" id="dingdanhao"
						style="width: 400px; height: 30px;" /> <input type="submit"
						name="Submit" value="查询" id="select"
						style="width: 60px; height: 40px; margin-left: 20px;" />
				</form>
			</div>
		</div>
	</div>
	<?php require 'footer.php';?>
    </body>
<script type="text/javascript" id="bdshare_js"
	data="type=tools&amp;uid=0"></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
</html>
