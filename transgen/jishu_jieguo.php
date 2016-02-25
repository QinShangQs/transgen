<?php
require 'config.inc.php';
$dingdanhao = trim($_POST['dingdanhao']);
$sql = "select * from `".$dbpre."jishu` where dingdanhao='" . $dingdanhao . "'";
$query = mysql_query($sql, $conn);
$rs = mysql_fetch_array($query);
if(empty($rs['dingdanhao'])){
			echo"<script>alert('您输入的订单号有误，请确认无误后重新输入!');history.back(-1);</script>";
			exit;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>全式金实验技术委托服务进度查询结果页</title>
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
	#jishu_jieguojd{font-weight:bold;font-size:16px;line-height:20px;border-right:#ccc 1px solid;padding:10px;background:#eee;text-align:right;}
	#jishu_jieguo{padding:10px;font-size:14px;line-height:20px;background: #f2f2f2;}
	#jishu_xinxi{background:#eee; text-align:right;font-size:16px;line-height:20px;font-weight:bold;border-right:#ccc 1px solid;padding:10px;width:100px;}
	#downfm{ text-align:center;}
	#down{margin:10px 0;}
	table{margin:0 auto;border:#ccc 1px solid;}
	tr{border-bottom:#ccc 1px solid;}
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
                            <div class="left f18 fM">实验技术委托服务进度查询结果</div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>实验技术委托服务进度查询结果</span></div>
                        </div>
                        <div id="content">
                        <table width="680px" cellpadding="0" cellspacing="0">
                        <tr>
                        	<td colspan="2" align="center" style="padding:15px;"><h1 class="f18 fM" style="font-size:24px;color:#ff6600;">实验技术委托项目名称：<?php echo $rs['shiyanname'];?></h1>
                            </td>
                      	</tr>
						<tr>
                        	<td id="jishu_xinxi">查询的订单号</td>
                            <td id='jishu_jieguo'><?php echo $rs['dingdanhao'];?></td>
                            </tr>
                        <tr>
                        	<td id="jishu_xinxi">委托日期</td>
                            <td id='jishu_jieguo'><?php echo $rs['weituoriqi'];?></td>
                        </tr>
						<tr>
                        	<td id="jishu_xinxi">实验状态</td>
                            <td id='jishu_jieguo'><?php $cat=$rs['cat'];
							switch ($cat)
							{
							case 1:
							  echo "已完成";
							  break;
							case 2:
							  echo "正在进行";
							  break;}?></td>
  						</tr>
						<tr>
                        	<td id="jishu_xinxi">客户姓名</td>
                            <td id='jishu_jieguo'><?php echo $rs['name'];?></td>
                        </tr>
                        <tr>
                        	<td id="jishu_xinxi">联系电话</td>
                            <td id='jishu_jieguo'><?php echo $rs['mobile'];?></td>
                        </tr>
                        <tr>
                        	<td id="jishu_xinxi">联系邮箱</td>
                            <td id='jishu_jieguo'><?php echo $rs['email'];?></td>
                        </tr>
                        <tr>
                        	<td  id="jishu_xinxi">单位</td>
                            <td id='jishu_jieguo'><?php echo $rs['danwei'];?></td>
                        </tr>
                        
						<tr>
                        	<td id="jishu_xinxi">实验员</td>
                            <td id='jishu_jieguo'><?php echo $rs['shiyanyuan'];?></td>
                        </tr>
                        <tr>
                        	<td id="jishu_xinxi">业务员</td>
                            <td id='jishu_jieguo'><?php echo $rs['yewuyuan'];?></td>
                        </tr>
                        <tr>
                        	<td id="jishu_xinxi">实验服务费</td>
                            <td id='jishu_jieguo'><?php echo $rs['shiyanfeiyong'];?></td>
                        </tr>
                        <tr style="text-align:center;">
                        	<td colspan="2"><h1 style="color:#F63;font-size:20px;padding:10px;">实验进度详情</h1></td>
                        </tr>
						<?php 
						$a=1;
						while($a<=20){
							$b="syjd".$a;
							if(trim($rs[''.$b.''])<>NULL){
							echo "<tr><td id='jishu_jieguojd'>实验第".$a."阶段</td><td id='jishu_jieguo'>".trim($rs[''.$b.''])."</td></tr>";
							};
							$a++;
						}
						?>
                        <?php 
						if(trim($rs['beizhu'])<>NULL){
						echo "<tr><td id='jishu_xinxi'>备  注</td><td id='jishu_jieguo'>".$rs['beizhu']."</td></tr>";
                        }
                        ?>
                        <tr>
                        	<td colspan="2">
                            	<form method="post" action="down.php" name="downfm" id="downfm">
                                    <input type="text" value="<?php echo $rs['dingdanhao']; ?> " name="dingdanhao" id="dingdanhao" style="display:none;" />
                                    <input style="background:#F63;padding:5px; box-shadow:0px 0px 5px #F63;font-size:14px; font-weight:bold;" type="submit" value="下载实验进度" id="down" name="down" />
                                </form>
                            </td>
                        </tr>
                        </table>
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
