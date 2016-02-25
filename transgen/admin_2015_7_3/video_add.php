<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('34',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";
    
	 $name = trim($_POST['name']);
     $weburl = trim($_POST['weburl']);
	 $pic = trim($_POST['pic']);
	 $addtime = strtotime($_POST['addtime']);
		
        $sql = "insert into `".$dbpre."video` (`name`,pic,weburl,addtime) values ('$name','$pic','$weburl','$addtime')";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('添加成功');window.location.href='video_add.php'</script>";
		}else{
			echo "<script>alert('添加失败');window.location.href='javascript:history.go(-1)'</script>";
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
		alert("请填写视频名称");
		o.name.focus();
		return false;
	}
	if(o.pic.value==""){
		alert("请上传视频图片");
		o.pic.focus();
		return false;
	}
	if(o.weburl.value==""){
		alert("请填写视频地址");
		o.weburl.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">视频讲座添加</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" height="40" align="center" class="bline">视频名称</td>
          <td width="87%" align="left" class="bline"><input name="name" type="text" id="name" style="width:400px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">视频图片</td>
          <td align="left" class="bline">
          <input name="pic" type="text" id="pic" style="width:400px;" />
                            <input type="button" name="Submit" value="点击上传图片" onclick="window.open('admin_upload.php?formName=myform&editName=pic&upPath=/attached','','status=no,scrollbars=no,top=20,left=110,width=420,height=165')" />
                            建议尺寸：347 * 238px
          </td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">视频地址</td>
          <td align="left" class="bline"><input name="weburl" type="text" id="weburl" style="width:400px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">发布时间</td>
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