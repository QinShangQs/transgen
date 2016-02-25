<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('7',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";
    
	 $fid = trim($_POST['fid']);
	 $name = trim($_POST['name']);
     $weburl = trim($_POST['weburl']);
	 $pic = trim($_POST['pic']);
	 $alt = trim($_POST['alt']);
	 $isok = getParam('isok', 'POST', 0);
		
        $sql = "insert into `".$dbpre."banner` (fid,name,weburl,pic,alt,isok) values ('$fid','$name','$weburl','$pic','$alt','$isok')";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('添加成功');window.location.href='banner_add.php'</script>";
		}else{
			"<script>alert('添加失败');window.location.href='banner_add.php'</script>";
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
	if(o.fid.value==""){
		alert("请选择栏目分类");
		o.fid.focus();
		return false;
	}
	if(o.name.value==""){
		alert("请填写广告名称");
		o.name.focus();
		return false;
	}
	if(o.pic.value==""){
		alert("请上传广告图片");
		o.pic.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">BANNER添加</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" height="40" align="center" class="bline">栏目分类</td>
          <td width="87%" align="left" class="bline">
          <select name="fid" id="fid">
            <option value="" selected="selected">--请选择栏目分类--</option>
            <option value="1">首页BANNER</option>
            <option value="2">首页快速下载</option>
            <option value="3">首页人才招聘</option>
            <option value="4">服务与支持</option>
            <option value="5">订购中心</option>
            <option value="6">产品中心</option>
            <option value="7">走进全式金</option>
          </select></td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">广告名称</td>
          <td width="87%" align="left" class="bline"><input name="name" type="text" id="name" style="width:200px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">广告图片</td>
          <td align="left" class="bline">
          <input name="pic" type="text" id="pic" style="width:400px;" />
                            <input type="button" name="Submit" value="点击上传图片" onclick="window.open('admin_upload.php?formName=myform&editName=pic&upPath=/attached','','status=no,scrollbars=no,top=20,left=110,width=420,height=165')" />
                            图片尺寸：以显示的地方为准
          </td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">链接地址</td>
          <td align="left" class="bline"><input name="weburl" type="text" id="weburl" style="width:400px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">图片描述</td>
          <td align="left" class="bline"><input name="alt" type="text" id="alt" style="width:200px;"  /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">是否启用</td>
          <td align="left" class="bline"><input type="radio" name="isok" id="isok" value="1" />
            启用
              　
              <input name="isok" type="radio" id="isok" value="0" checked="checked" />
停用</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">&nbsp;</td>
          <td align="left" class="bline">
            <input type="submit" name="Submit" value="添加广告" class="bn2" /></td>
        </tr>
        <tr>
          <td height="40" align="center">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>