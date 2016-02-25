<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>全式金生物-网站后台管理中心</title>
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/login.css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
        var username_reg = /[a-zA-Z0-9]{1,}/;
        //验证
        function myvalidate() {
            var username = $.trim($("#txt_UserName").val());
            var password = $.trim($("#txt_Password").val());
            var yancode = $.trim($("#txt_YanCode").val());
            
            var message = "";
            if (username == "") {
                message += "- 用户名不能为空\n";
            }
            else if (!username_reg.test(username)) {
                message += "- 用户名必须为A-Z0-9的字符\n";
            }
            if (password == "") {
                message += "- 密码不能为空\n";
            }
            else if (!username_reg.test(password)) {
                message += "- 密码必须为A-Z0-9的字符\n";
            }
            if (yancode == "") {
                message += "- 验证码不能为空\n";
            }
            else if (yancode.length != 4) {
                message += "- 验证码必须是为4位的字符\n";
            }

            if (message != "") {
                alert(message);
                return false;
            }

            return true;
        }
        
        //设置密码
        function writepassword() {
            var username = $.trim($("#txt_UserName").val());
            if (pwd != "" && pwd.split('+')[0] == username) {
                $("#txt_Password").val(pwd.split('+')[1]);
            }
        }

        var chk_login_reg = /index.php$/;
        //判断登录地址
        function loadurl() {
            if (window.parent != null && !chk_login_reg.test(window.parent.location.href)) {
                window.parent.location.href = 'index.php';
            }
        }
        loadurl();
    </script>
</head>
<body>
<form id="loginform" name="loginform" method="post" action="logincheck.php">
  <div class="topBar">
    <h2>网站管理系统</h2>
  </div>
  <div class="logBox">
    <div class="logTit"></div>
    <div class="logForm">
      <div class="iptL name">
        <input name="txt_UserName" type="text" id="txt_UserName" value="" onblur="writepassword();" />
      </div>
      <div class="iptL pass">
        <input name="txt_Password" type="password" value="" id="txt_Password" />
      </div>
      <div class="iptYc">
        <div class="iptC">
          <input name="txt_YanCode" type="text" id="txt_YanCode" style="height:21px; line-height:21px;" />
        </div>
        <img src="../vcode.php" alt="点击刷新换一个验证码" name="txt_YanCodeImage" width="94" height="26" align="middle" id="txt_YanCodeImage" style="cursor:pointer; border:1px #ccc solid;" onclick="this.src=this.src+'?'" />
         </div>
      <div class="btnl">
        <input type="submit" name="but_login" value="登录" onclick="return myvalidate();" id="but_login" class="btns" />
        <input name="" type="reset" value="重置" class="btns" />
</div>
    </div>
  </div>
  <div id="botBar" class="botBar">
    <h2><a href="http://www.ucantech.com" target="_blank">天照科技</a></h2>
    <p><a href="http://www.ucantech.com" target="_blank">上海永灿信息科技有限公司</a>版权所有</p>
  </div>
  <script type="text/javascript">
//<![CDATA[
var pwd='';//]]>
</script>
</form>
<script type="text/javascript">
	var wid = document.documentElement.clientWidth;
	document.getElementById("botBar").style.width=(wid-60)+"px";
	var hei = document.documentElement.clientHeight;
	if(hei<550){
		document.getElementById("botBar").style.position = "static";
		document.getElementById("botBar").style.marginTop = "120px";
		}
</script>
</body>
</html>