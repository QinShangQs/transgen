<?php
    session_start();
    require '../config.inc.php';
    require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('30',$quanxian)){
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
            $zip = $_FILES["address"];

            //判断上传文件格式
            $pass_type = array(
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/x-zip-compressed',
                'application/pdf',
				'application/octet-stream'
            );

            if(!in_array($zip["type"],$pass_type))
            {
                echo "<script>alert('只能上传docx,pptx,xlsx,pdf格式的文件');history.go(-1);</script>";
                exit;
            }

            //上传保存的路径
            if (!is_dir("../attached/down"))
            {
                mkdir("../attached/down");
            }

            $filename = $zip['name'];
            $fileEx = strtolower(substr(strrchr($filename,"."),1));

            $path = "../attached/down/" . $name . "_" . date(YmdH) . "." . $fileEx;
            move_uploaded_file($zip["tmp_name"], $path);

            $sql = "insert into `".$dbpre."download` (cat,name,address,extension,addtime) values ('$cat','$name','$path','$fileEx','".time()."')";
            if (mysql_query($sql, $conn))
            {
                echo "<script>alert('资料下载添加成功');window.location.href='download_add.php'</script>";
                exit();
            }
            else
            {
                echo "<script>alert('资料下载添加失败');window.location.href='javascript:history.go(-1)'</script>";
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
        <SCRIPT language="JavaScript">
            function checkform(o){
                if(o.name.value==""){
                    alert("请填写信息标题");
                    o.name.focus();
                    return false;
                }
                if(o.cat.value==""){
                    alert("请选择栏目分类");
                    o.cat.focus();
                    return false;
                }	
                return true;
            }
        </SCRIPT>
    </head>
    <body>
        <DIV class="Listbox">
            <DIV class="ListTit">资料下载添加</DIV>
            <DIV class="ListfBox">
                <form name="myform" id="myform" action="?action=add" method="post" enctype="multipart/form-data"  onsubmit="return checkform(this)">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="40" align="center" class="bline">资料下载标题</td>
                            <td align="left" class="bline"><input name="name" type="text" id="name" style="width:400px;" /></td>
                        </tr>
                        <tr>
                            <td width="13%" height="40" align="center" class="bline">栏目分类</td>
                            <td width="87%" align="left" class="bline">
                            <select name="cat" id="cat">
                                    <option value="" selected="selected">--请选择栏目分类--</option>
                                    <?php
                                        $sqlcat = mysql_query("select id,catname from `".$dbpre."catdownload` order by id asc",$conn);
                                        while($row = mysql_fetch_array($sqlcat)){
                                        ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['catname'];?></option>
                                        <?php
                                        }
                                    ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td height="40" align="center" class="bline">文件</td>
                            <td align="left" class="bline"><input type="file" style="width:400px;" name="address" id="address" />
                                只能上传docx,pptx,xlsx,pdf,zip,rar格式的文件</td>
                        </tr>
                        <tr>
                            <td height="60" align="center" class="bline">发布时间</td>
                            <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', time());?>" /></td>
                        </tr>
                        <tr>
                            <td height="60" align="center">&nbsp;</td>
                            <td align="left"><input type="submit" name="Submit" value="添加内容" class="bn2" /></td>
                        </tr>
                    </table>
                </form>
            </DIV>
        </DIV>
    </body>
</html>