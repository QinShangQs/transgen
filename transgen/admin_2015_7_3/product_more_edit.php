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

    $id     = getParam('id', 'GET');
    $sqlc   = mysql_query("select * from `".$dbpre."product` where id='" . $id . "'", $conn);
    $rs     = mysql_fetch_array($sqlc);

    $action = $_GET['action'];
    switch ($action) {
        //添加记录
        case"edit";

            $id = lib_replace_end_tag(trim($_POST["id"]));
            $cat = lib_replace_end_tag(trim($_POST["cat"]));
            $name = lib_replace_end_tag(trim($_POST["name"]));
			$hot = lib_replace_end_tag(trim($_POST["hot"]))=='' ? '0' : lib_replace_end_tag(trim($_POST["hot"]));
            $catname = lib_replace_end_tag(trim($_POST["catname"]));
            $guige = lib_replace_end_tag(trim($_POST["guige"]));
            $price = lib_replace_end_tag(trim($_POST["price"]));
            $zipa = $_FILES["downloada"];
            $zipb = $_FILES["downloadb"];
            $zipc = $_FILES["downloadc"];
            $zipd = $_FILES["downloadd"];
            $ua = trim($_POST['ua']);
            $ub = trim($_POST['ub']);
            $uc = trim($_POST['uc']);
            $ud = trim($_POST['ud']);
            $addtime = strtotime($_POST['addtime']);

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
                    echo "<script>alert('只能上传docx,pptx,xlsx,zip格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipb["type"]!=''){
                if(!in_array($zipb["type"],$pass_type))
                {
                    echo "<script>alert('只能上传docx,pptx,xlsx,zip格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipc["type"]!=''){
                if(!in_array($zipc["type"],$pass_type))
                {
                    echo "<script>alert('只能上传docx,pptx,xlsx,zip格式的文件');history.go(-1);</script>";
                    exit;
                }
            }
            if ($zipd["type"]!=''){
                if(!in_array($zipd["type"],$pass_type))
                {
                    echo "<script>alert('只能上传docx,pptx,xlsx,zip格式的文件');history.go(-1);</script>";
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

            if($catname){
                //查询产品名称
                $sqlcp = mysql_query("select id,name,cat from `".$dbpre."product` where id='".$cat."'",$conn);
                $rscp = mysql_fetch_array($sqlcp);

                $sql = "update `".$dbpre."product` set cat='".$rscp['cat']."',sid='$cat',name='$name',guige='$guige',price='$price',downloada='$patha',downloadb='$pathb',downloadc='$pathc',downloadd='$pathd',hot='$hot',addtime='$addtime' where id='".$id."'";
            }else{
                $sql = "update `".$dbpre."product` set name='$name',guige='$guige',price='$price',downloada='$patha',downloadb='$pathb',downloadc='$pathc',downloadd='$pathd',addtime='$addtime' where id='".$id."'";
            }
            //echo $sql;die;
            if (mysql_query($sql, $conn))
            {
                echo "<script>alert('修改成功');window.location.href='product_more_edit.php?id=".$id."'</script>";
                exit();
            }
            else
            {
                echo "<script>alert('修改失败');window.location.href='javascript:history.go(-1)'</script>";
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
        <style>
            p#vtip {position: absolute; padding: 5px; left: 5px; font-size:12px; background-color: white; border: 1px solid #a6c9e2; -moz-border-radius: 5px; -webkit-border-radius: 5px; z-index: 9999;}
            p#vtip #vtipArrow { position: absolute; top: -10px; left: 5px }
            .input_validation-failed { border:1px solid #f00; color:red;}

            .tabs input{ height:24px; line-height:24px; width:auto; padding:0 5px;}
        </style>

    </head>
    <body>
        <DIV class="Listbox">
            <DIV class="ListTit">产品修改</DIV>
            <DIV class="ListfBox">
                <form name="validateForm1" id="validateForm1" action="?action=edit" method="post" enctype="multipart/form-data">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="40" align="center" class="bline">选择产品</td>
                            <td align="left" class="bline">
                                <input type="text" name="catname" id="catname" />  
                                <span id="catSpan"></span>
                                <span>请输入产品名称相关词</span>
                                <script>  
                                    $(document).ready(function(){  
                                        $("#catname").change(function(){  
                                            var catname=$(this).val();
                                            $("#catSpan").load("proselect.php?catname="+catname);
                                        });  
                                    })  
                                </script>
                            </td>
                        </tr>
                        <tr>
                          <td height="40" align="center" class="bline">热销产品</td>
                          <td align="left" class="bline"><input type="radio" name="hot" id="hot" value="1" <?php if($rs['hot']==1){echo " checked=\"checked\"";}?> />
                            是
                              <input name="hot" type="radio" id="hot" value="0" <?php if($rs['hot']==0){echo " checked=\"checked\"";}?> /> 
                              否
</td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">目录名</td>
                            <td align="left" class="bline"><input name="name" type="text" id="name" style="width:200px;" value="<?php echo $rs['name'];?>"  url="checkinput.php?id=<?php echo $rs['id'];?>" tip="请输入目录名！" /></td>
                        </tr>
                        <tr>
                            <td width="13%" height="40" align="center" class="bline">规格</td>
                            <td width="87%" align="left" class="bline"><input name="guige" type="text" id="guige" style="width:200px;" value="<?php echo $rs['guige'];?>" /></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">单价</td>
                            <td align="left" class="bline"><input name="price" type="text" id="price" style="width:200px;" value="<?php echo $rs['price'];?>" /></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">中文</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloada" id="downloada" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                                <input type="hidden" name="ua" value="<?php echo $rs['downloada'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">英文</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadb" id="downloadb" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                                <input type="hidden" name="ub" value="<?php echo $rs['downloadb'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">MSDS</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadc" id="downloadc" />
                                只能上传docx,pptx,xlsx,pdf,格式的文件
                                <input type="hidden" name="uc" value="<?php echo $rs['downloadc'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">COA</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="downloadd" id="downloadd" />
                                只能上传docx,pptx,xlsx,pdf格式的文件
                                <input type="hidden" name="ud" value="<?php echo $rs['downloadd'];?>"/>
                            </td>
                        </tr>
                        <?php
                            if($rs['downloada']){
                            ?>
                            <tr>
                                <td height="40" align="center" class="bline">中文文件地址</td>
                                <td align="left" class="bline"><?php echo $rs['downloada'];?></td>
                            </tr>
                            <?php
                            }
                        ?>
                        <?php
                        if($rs['downloadb']){
                            ?>
                            <tr>
                                <td height="40" align="center" class="bline">英文文件地址</td>
                                <td align="left" class="bline"><?php echo $rs['downloadb'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if($rs['downloadc']){
                            ?>
                            <tr>
                                <td height="40" align="center" class="bline">MSDS文件地址</td>
                                <td align="left" class="bline"><?php echo $rs['downloadc'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if($rs['downloadd']){
                            ?>
                            <tr>
                                <td height="40" align="center" class="bline">COA文件地址</td>
                                <td align="left" class="bline"><?php echo $rs['downloadd'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td height="60" align="center" class="bline">发布时间</td>
                            <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', $rs['addtime']);?>" /></td>
                        </tr>
                        <tr>
                            <td height="60" align="center">&nbsp;</td>
                            <td align="left">
                                <input name="id" id="id" value="<?php echo $id;?>" type="hidden" />
                                <input type="submit" name="Submit" value="修改内容" class="bn2" />　　<input type="button" name="button" value="返回列表" onClick="location.href='product_more_list.php?sid=<?php echo $rs['sid'];?>'" class="bn2" /></td>
                        </tr>
                    </table>
                </form>
            </DIV>
        </DIV>
    </body>
</html>