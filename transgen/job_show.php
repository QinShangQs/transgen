<?php
    require 'config.inc.php';
    $id = getParam('id', 'GET');
    if($id){
        $sql = mysql_query("select * from `".$dbpre."job` where id='".$id."'",$conn);
        $rs = mysql_fetch_array($sql);  
    }else{
        echo "<script>alert('参数错误');window.location.href='javascript:history.go(-1)'</script>";
        exit();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>全式金招聘-<?php echo $rs['name'].",".$rs['renshu']."人,".$rs['area'];?>【<?php echo date('Y-m-d', $rs['addtime']);?>】</title>
        <meta name="description" content="<?php echo substr(strip_tags($rs['yaoqiu']),1,200);?>" />
        <base href="<?php echo $weburl;?>" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
                            <div class="left f18 fM">人才招聘</div>
                            <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>人才招聘</span></div>
                        </div>
                        <div id="content">
                            <h1 class="f18 fM" style="color:#ff6600;"><?php echo $rs['name'];?></h1>
                            <div>
                                <div class="renCom">
                                    <div><h2 class="fW tC">岗位职责</h2></div>

                                    <div class="ddd">
                                        <?php echo $rs['zhize'];?>
                                    </div>
                                </div>
                                <div class="renCom">
                                    <div><h2 class="fW tC">任职要求</h2></div>
                                    <div class="ddd">
                                        <?php echo $rs['yaoqiu'];?>
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="liuyan">
                                  <form action="save.php?action=jobadd" name="formjob" id="formjob" method="post" enctype="multipart/form-data" onsubmit="return checkform(this)">	
                                    <ul>
                                        <li class="clearfix">
                                            <label class="left">姓　　名:</label><input class="left" type="text" name="realname" id="realname" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">性　　别:</label>
                                            <input class="left" style="width:20px;" type="radio" name="sex" value="男" checked="checked"/> 
                                            <span class="left" style="height:25px;line-height:28px;">男</span>
                                            <input class="left" style="width:20px;" type="radio" name="sex" value="女" /> 
                                            <span class="left" style="height:25px;line-height:28px;">女</span>
                                        </li>
                                        
                                        <li class="clearfix">
                                            <label class="left">申请职位:</label><input class="left" type="text" name="zhiwei" id="zhiwei" value="<?php echo $rs['name'];?>" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">学　　历:</label><input class="left" type="text" name="xuelei" id="xuelei" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">工作年限:</label><input class="left" type="text" name="nianxian" id="nianxian" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">手机号码:</label><input class="left" type="text" name="tel" id="tel" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">邮件地址:</label><input class="left" type="text" name="email" id="email" />
                                        </li>
                                        <li class="clearfix">
                                            <label class="left">个人简历:</label>
                                            <input class="left" type="file" style="width:240px;" name="down" id="down" />
                                        </li>
										<li class="clearfix">
                                            <label class="left">验证码:</label><input class="left" style="width:100px;" maxlength="4" type="text" name="checks" id="checks" /><img src="vcode.php" alt="点击刷新换一个验证码" name="checks" width="94" height="24" align="middle" id="checks" style="cursor:pointer; border:1px #ccc solid;" onclick="this.src=this.src+'?'" />
                                        </li>
                                        <li class="speacial">
                                            <input class="input1" type="submit" value="提 交" id="tijiao" name="tijiao" />
                                            <input class="input2" type="reset" value="重 填" />
                                        </li>
                                    </ul>
                                </form>
                              </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <?php require 'footer.php';?>
		
<SCRIPT language="JavaScript">
        function checkform() {
            if ($("#realname").val() == "" || $("#realname").val().trim() == "") {
                alert("请填写姓名！");
                $("#realname").focus();
                return false;
            }
			if ($("#zhiwei").val() == "" || $("#zhiwei").val().trim() == "") {
                alert("请填写申请职位！");
                $("#zhiwei").focus();
                return false;
            }
			if ($("#xuelei").val() == "" || $("#xuelei").val().trim() == "") {
                alert("请填写学历！");
                $("#xuelei").focus();
                return false;
            }
			if ($("#nianxian").val() == "" || $("#nianxian").val().trim() == "") {
                alert("请填写工作年限！");
                $("#nianxian").focus();
                return false;
            }
            if (!$("#tel").val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)) {
                alert("请填写手机号码！");
                $("#tel").focus();
                return false;
            }
            if (!$("#email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)) {
                alert("请填写电子邮箱！");
                $("#email").focus();
                return false;
            }
            var f_content = $("#down").val();
                var fileext = f_content.substring(f_content.lastIndexOf("."), f_content.length);
                fileext = fileext.toLowerCase();
            if (fileext != '.docx' && fileext != '.doc') {
                    alert("对不起，上传文件格式必须为docx，doc格式，请您调整格式后重新上传，谢谢 ！");
                    $("#down").focus();
                    return false;
            }
			if ($("#checks").val().length < 4 ) {
                alert("请填写验证码！");
                $("#checks").focus();
                return false;
            }
            return true;
        }
    </SCRIPT>
    </body>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
</html>
