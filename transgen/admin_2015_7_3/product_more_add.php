<?php
    session_start();
    require '../config.inc.php';
    require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('17',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


    header('Content-Type: text/html; charset=utf-8');
    $action = $_GET['action'];
    switch ($action) {
        //添加记录
        case"add";
            $cat = lib_replace_end_tag(trim($_POST["cat"]));
            $name = lib_replace_end_tag(trim($_POST["name"]));
			$hot = lib_replace_end_tag(trim($_POST["hot"]))=='' ? '0' : lib_replace_end_tag(trim($_POST["hot"]));
            $guige = lib_replace_end_tag(trim($_POST["guige"]));
            $price = lib_replace_end_tag(trim($_POST["price"]));
            $zipa = $_FILES["downloada"];
            $zipb = $_FILES["downloadb"];
            $zipc = $_FILES["downloadc"];
            $zipd = $_FILES["downloadd"];
            $u = "无";
            $addtime = strtotime($_POST['addtime']);
            var_dump($zipa["type"]);
            var_dump($zipb["type"]);
            //判断上传文件格式
            $pass_type = array(
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/x-zip-compressed',
                'application/pdf',
				'application/octet-stream'
            );
            if ($zipa["type"]!=''){
                if(!in_array($zipa["type"],$pass_type))
                {
                    echo "<script>alert('中文，只能上传docx,pptx,xlsx,pdf格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipb["type"]!=''){

                if(!in_array($zipb["type"],$pass_type))
                {
                    echo "<script>alert('英文，只能上传docx,pptx,xlsx,pdf格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipc["type"]!=''){

                if(!in_array($zipb["type"],$pass_type))
                {
                    echo "<script>alert('MSDS，只能上传docx,pptx,xlsx,pdf格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipd["type"]!=''){

                if(!in_array($zipb["type"],$pass_type))
                {
                    echo "<script>alert('COA，只能上传docx,pptx,xlsx,pdf,格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            //上传保存的路径
            if (!is_dir("../attached/down"))
            {
                mkdir("../attached/down");
            }

            if ($zipa["type"]!=''){
                $filenamea = $zipa['name'];
                $fileExa = strtolower(substr(strrchr($filenamea,"."),1));
            }
            if ($zipb["type"]!=''){
                $filenameb = $zipb['name'];
                $fileExb = strtolower(substr(strrchr($filenameb,"."),1));
            }
            if ($zipc["type"]!=''){
                $filenamec = $zipc['name'];
                $fileExc = strtolower(substr(strrchr($filenamec,"."),1));
            }
            if ($zipd["type"]!=''){
                $filenamed = $zipd['name'];
                $fileExd = strtolower(substr(strrchr($filenamed,"."),1));
            }


            if ($zipa["type"]!=''){
                $patha = "../attached/down/" . $name. "_" . date(YmdH) . "." . $fileExa;
                move_uploaded_file($zipa["tmp_name"], $patha);
            }else{
                $patha = $u;
            }
            if ($zipb["type"]!=''){
                $pathb = "../attached/down/" . $name. "_" . date(YmdH) . "." . $fileExb;
                move_uploaded_file($zipb["tmp_name"], $pathb);
            }else{
                $pathb = $u;
            }
            if ($zipc["type"]!=''){
                $pathc = "../attached/down/" . $name. "_" . date(YmdH) . "." . $fileExc;
                move_uploaded_file($zipc["tmp_name"], $pathc);
            }else{
                $pathc = $u;
            }
            if ($zipd["type"]!=''){
                $pathd = "../attached/down/" . $name. "_" . date(YmdH) . "." . $fileExd;
                move_uploaded_file($zipd["tmp_name"], $pathd);
            }else{
                $pathd = $u;
            }

            //查询产品名称
            $sqlcp = mysql_query("select id,name,cat from `".$dbpre."product` where id='".$cat."'",$conn);
            $rscp = mysql_fetch_array($sqlcp);

            $sql = "insert into `".$dbpre."product` (cat,sid,name,name_pro,guige,price,downloada,downloadb,downloadc,downloadd,hot,addtime) values ('".$rscp['cat']."','$cat','$name','".$rscp['name']."','$guige','$price','$patha','$pathb','$pathc','$pathd','$hot','$addtime')";
            if (mysql_query($sql, $conn))
            {
                echo "<script>alert('添加成功');window.location.href='product_more_add.php'</script>";
                exit();
            }
            else
            {
                echo "<script>alert('添加失败');window.location.href='javascript:history.go(-1)'</script>";
                exit();
            }
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>CPWEB</title>
        <LINK rel=stylesheet type=text/css href="css/common.css">
        <LINK rel=stylesheet type=text/css href="css/default.css">
        <!--查询用户用是否重复-->       
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../js/easy_validator.pack.js"></script>
        <script type="text/javascript" src="../js/jquery.bgiframe.min.js"></script>
        <SCRIPT language="JavaScript">

            var isExtendsValidate = true;    //如果要试用扩展表单验证的话，该属性一定要申明
            function extendsValidate(){    //函数名称，固定写法

                //如果觉得官方提供的错误提示UI API 过于复杂，完全可以选择自定义，可以试试下面注释掉的代码

                if( $('#catname').val() == ''){
                    alert("请选择产品名称");
                    $('#catname').focus();
                    return false;
                }
                if( $('#name').val() == ''){
                    alert("请填写目录名称");
                    $('#name').focus();
                    return false;
                }
                if( $('#guige').val() == ''){
                    alert("请填写规格");
                    $('#guige').focus();
                    return false;
                }
                if( $('#price').val() == ''){
                    alert("请填写单价");
                    $('#price').focus();
                    return false;
                }

                //checkbox 验证，必须选择一个checkbox
                //if($("[name='lover']:checked").length < 1){
                //    alert("必须得有一个lover!");
                //    return false;
                //}


            }


        </SCRIPT>
        
        <script>  
            $(document).ready(function(){  
                $("#catname").change(function(){  
                    var catname=$(this).val();
                    $("#catSpan").load("proselect.php?catname="+catname);  
                });  
            })  
        </script>
        <style>
            p#vtip {position: absolute; padding: 5px; left: 5px; font-size:12px; background-color: white; border: 1px solid #a6c9e2; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;}
            p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
            .input_validation-failed { border:1px solid #f00; color:red;}

            .tabs input{ height:24px; line-height:24px; width:auto; padding:0 5px;}
        </style>
    </head>
    <body>
        <DIV class="Listbox">
            <DIV class="ListTit">更多规格产品添加</DIV>
            <DIV class="ListfBox">
                <form name="validateForm1" id="validateForm1" action="?action=add" method="post" enctype="multipart/form-data">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="40" align="center" class="bline">选择产品</td>
                            <td align="left" class="bline">
                                <input type="text" name="catname" id="catname" />  
                                <span id="catSpan"></span>
                                <span>请输入产品名称相关词</span>
                            </td>
                        </tr>
                        <tr>
                          <td height="40" align="center" class="bline">热销产品</td>
                          <td align="left" class="bline"><input type="radio" name="hot" id="hot" value="1" />
                            是
                              <input name="hot" type="radio" id="hot" value="0" checked="checked" /> 
                              否
</td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">目录名</td>
                            <td align="left" class="bline"><input name="name" type="text" id="name" style="width:200px;" url="checkinput.php" tip="请输入目录名！"  /></td>
                        </tr>
                        <tr>
                            <td width="13%" height="40" align="center" class="bline">规格</td>
                            <td width="87%" align="left" class="bline"><input name="guige" type="text" id="guige" style="width:200px;" /></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">单价</td>
                            <td align="left" class="bline"><input name="price" type="text" id="price" style="width:200px;" /></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">文件</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloada" id="downloada" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">文件</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadb" id="downloadb" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">文件</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadc" id="downloadc" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">文件</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadd" id="downloadd" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                            </td>
                        </tr>
                        <tr>
                            <td height="60" align="center" class="bline">发布时间</td>
                            <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', time());?>" /></td>
                        </tr>
                        <tr>
                            <td height="60" align="center">&nbsp;</td>
                            <td align="left">
                                <input type="submit" name="Submit" value="添加内容" class="bn2" /></td>
                        </tr>
                    </table>
                </form>
            </DIV>
        </DIV>
    </body>
</html>