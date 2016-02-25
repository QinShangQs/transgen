<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>登陆</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <style>
            p#vtip {position: absolute; padding: 5px; left: 5px; font-size:12px; background-color: white; border: 1px solid #a6c9e2; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;}
            p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
            .input_validation-failed { border:1px solid #f00; color:red;}

            .tabs input{ height:24px; line-height:24px; width:auto; padding:0 5px;}
        </style>
    </head>
    <body>
        <div class="add add1">
            <div class="clearfix titleA">
                <span class="left jixu">会员中心</span>
                <span class="right off" onclick="window.parent.hide()" title="关闭"></span>
            </div>
            <div class="clearfix">
                <div class="left divCom">
                    <div class="user fM">　用户登录</div>
                    <form name="formu" id="formu" method="post" action="loginsave.php?action=login" onSubmit="return checkforml(this)">
                        <ul class="addList addList1">
                            <li class="clearfix">
                                <label class="left">用户名:</label>
                                <input class="left" type="text" name="text_username" id="name="text_username"" />
                            </li>
                            <li class="clearfix">
                                <label class="left">密码:</label>
                                <input class="left" type="password" name="text_password" id="text_password" />
                            </li>
                            <br />
                            <li class="clearfix oH">
                                <label class="left">验证码:</label>
                                <input class="left te" type="text" name="checks" id="checks" maxlength="4" />
                                <img src="vcode.php" alt="点击刷新换一个验证码" name="txt_YanCodeImage" width="86" height="27" align="middle" id="txt_YanCodeImage" style="cursor:pointer; border:1px #ccc solid; margin-top:2px;float:left; padding-left:7px;" onclick="this.src=this.src+'?'" />
                            </li>

                            <li class="dan"><input type="submit" class="ding1" value="提交订单" style="border:none;" /></li>
                        </ul>
                    </form>
                </div>
                <div class="left divCom divCom2">
                    <div class="user fM">　用户注册</div>
                    <form name="validateForm1" id="validateForm1" method="post" action="loginsave.php?action=addreg">
                        <ul class="addList addList1">
                            <li class="clearfix">
                                <label class="left">用户名:</label>
                                <input class="left" type="text" name="username" id="username" url="checkreg.php" tip="请输入用户名" />
                            </li>
                            <li class="clearfix">
                                <label class="left">密码:</label>
                                <input class="left" type="password" name="password" id="pwd1" reg="^\w{6,20}$" tip="请设置密码！" />
                            </li>
                            <li class="clearfix">
                                <label class="left">确认密码:</label>
                                <input class="left" type="password" name="password2" id="pwd2" reg="^\w{6,20}$" tip="6-20个字符，请确认两次密码输入相同" />
                            </li>
                            <li class="clearfix">
                                <label class="left">手机:</label>
                                <input class="left" type="text" name="mobile" id="mobile" maxlength="11" reg="^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$" tip="请输入手机号码" />
                            </li>
                            <li class="clearfix">
                                <label class="left">邮箱:</label>
                                <input class="left" type="text" name="email" id="email" reg="^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$" tip="请填写电子邮箱，方便发货时联系" />
                            </li>
                            <li class="clearfix">
                                <label class="left">收件人:</label>
                                <input class="left" type="text" name="realname" id="realname"  />
                            </li>
                            <li class="clearfix">
                                <label class="left">收货地址:</label>
                                <input class="left" type="text" name="address" id="address"  />
                            </li>
                            <br />
                            <li class="clearfix oH">
                                <label class="left">验证码:</label>
                                <input class="left te" type="text" name="checks" id="checks" maxlength="4" reg="^\w{4,4}$" tip="请输入验证码" />
                                <img src="vcode.php" alt="点击刷新换一个验证码" name="txt_YanCodeImage" width="86" height="27" align="middle" id="txt_YanCodeImage" style="cursor:pointer; border:1px #ccc solid; margin-top:2px;float:left; padding-left:7px;" onclick="this.src=this.src+'?'" />
                            </li>

                            <li class="dan"><input type="submit" value="提交订单" class="ding1 ding2" style="border:none;" /></li>
                        </ul>
                    </form>
                </div>
            </div>

        </div>
		<script type="text/javascript" src="js/easy_validator.pack.js"></script>
        <script type="text/javascript" src="js/jquery.bgiframe.min.js"></script>
        <SCRIPT language="JavaScript">
            var isExtendsValidate = true;    //如果要试用扩展表单验证的话，该属性一定要申明
            function extendsValidate(){ 

                //密码匹配验证
                if( $('#pwd1').val() == $('#pwd2').val() ){    //匹配成功
                    $('#pwd2').validate_callback(null,"sucess");    //此次是官方提供的，用来消除以前错误的提示
                }else{//匹配失败
                    $('#pwd2').validate_callback("密码不匹配","failed");    //此处是官方提供的API，效果则是当匹配不成功，pwd2表单 显示红色标注，并且TIP显示为“密码不匹配”
                    return false;
                }
            }

            function checkforml(o){
                if(o.text_username.value==""){
                    alert("请填写用户名!");
                    o.text_username.focus();
                    return false;
                }
                if(o.text_password.value==""){
                    alert("请填写密码!");
                    o.text_password.focus();
                    return false;
                }
                if(o.checks.value==""){
                    alert("请填写验证码!");
                    o.checks.focus();
                    return false;
                }
                if(o.checks.value.length < 4){
                    alert("验证码填写有误!");
                    o.checks.focus();
                    return false;
                }
                return true;
            }

        </SCRIPT>
    </body>
</html>
