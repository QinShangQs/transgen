<?php require 'config.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>全式金-实验技术委托服务进度查询</title>
		<base href="<?php echo $weburl;?>" />
        <link rel="stylesheet" type="text/css" href="css/base.css"/>
        <link rel="stylesheet" type="text/css" href="css/common.css"/>
        <link rel="stylesheet" type="text/css" href="css/page.css"/>
        <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css"/>
        <script src="js/jq.js"></script>
        <script src="js/quanshijin.js"></script>
        <script src="js/alertbox.js"></script>
		<script>
    function login() {

        _set_interface();
        $('#jquery-lightbox').append("<iframe height=465 width=760 style='*height:500px;*width:743px;' src=\"zhuce.php?type=1\" frameborder=0 allowfullscreen></iframe>");
        $(window).scrollTop() = 0;
    }
    ;

    function hide() {
        $('#jquery-lightbox').remove();
        $('#jquery-overlay').fadeOut(function () {
            $('#jquery-overlay').remove();
        });
    }

</script>
<style type="text/css">
	.ddd p{ border: 0px !important; padding: 0px !important; line-height: 24px !important;}
</style>
</head>
    <body>
	 <div id="main" class="mAuto">
            <div class="wid980 mAuto">
                <?php require 'head1.php';?>      
                <div class="dN">
                    <img src="images/join1.jpg" width="980" height="150" />
                </div>
                <div id="textList">
                    <div class="wid720" style="width:980px;">
                        <div class="clearfix comTitle">
                            <div class="left f18 fM">实验技术委托服务进度查询</div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>实验技术委托服务进度查询</span></div>
                        </div>
                        <div id="content" style="height:400px;">
						<form action="jishu_jieguo.php" method="post" style="display:block;text-align:center;padding:40px;" >
						<span style="display:block;height:34px;line-height:34px;font-size:20px;margin-right:60px;">请输入您的订单号</span><input name="dingdanhao"  type="text" id="dingdanhao" style="width:400px;height:30px;" />
						<input type="submit" name="Submit" value="查询" id="select" style="width:60px;height:40px;margin-left:20px;" />
						</form>
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
