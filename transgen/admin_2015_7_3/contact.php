<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('13',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');

$id = 1;

$sql1 = "select * from `".$dbpre."contact` where id='" . $id . "'";
$query1 = mysql_query($sql1, $conn);
$rs = mysql_fetch_array($query1);

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"edit";
    
	 $id = trim($_POST['id']);
	 $name1 = trim($_POST['name1']);
     $name2 = trim($_POST['name2']);
	 $name3 = trim($_POST['name3']);    //添加广州办地址  2014.04.23
	 $name4 = trim($_POST['name4']);    //添加深圳办地址  2015.12.02
	 $khtel = trim($_POST['khtel']);
	 $jstel = trim($_POST['jstel']);
	 $content1 = trim($_POST['content1']);
	 $content2 = trim($_POST['content2']);
     $content3 = trim($_POST['content3']);    //添加广州办地址  2014.04.23
     $content4 = trim($_POST['content4']);    //添加广州办地址  2014.04.23
	 
      $sql = "update `".$dbpre."contact` set name1='$name1',name2='$name2',name3='$name3',name4='$name4',content1='$content1',content2='$content2',content3='$content3',content4='$content4',khtel='$khtel',jstel='$jstel' where id='".$id."'";     //2015.12.02 xiugai
	
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('修改成功');window.location.href='contact.php'</script>";
		}else{
			echo "<script>alert('修改失败');window.location.href='javascript:history.go(-1)'</script>";
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
<link rel="stylesheet" href="edit/edit.css" />
<script type="text/javascript" src="edit/kindeditor.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<SCRIPT language="JavaScript">
function checkform(o){
	if(o.name1.value==""){
		alert("请填写地区名称");
		o.name1.focus();
		return false;
	}
	if(o.name2.value==""){
		alert("请填写地区名称");
		o.name2.focus();
		return false;
	}
	if(o.name3.value==""){                    // 2014.04.23
		alert("请填写地区名称");     
		o.name3.focus();
		return false;
	}
	if(o.name4.value==""){                    // 2015.12.02
		alert("请填写地区名称");     
		o.name4.focus();
		return false;
	}
	if(o.khtel.value==""){
		alert("请填写客户服务电话");
		o.khtel.focus();
		return false;
	}
	if(o.jstel.value==""){
		alert("请填写技术支持热线");
		o.jstel.focus();
		return false;
	}
	return true;
}
</SCRIPT>
<script type="text/javascript">
	$(document).ready(function() {//文档就绪时运行
		$(".neir").eq(0).show()//初始化内容  显示第一个标签的内容
		$(".nav_list li").eq(0).addClass("jinn")//初始化内容  第一个标签显示为选中
		$(".nav_list li").click(function() {//如果是鼠标经过效果把click改成mouseenter
			$(".nav_list li").removeClass("jinn")//移除所有的选中效果
			$(this).addClass("jinn")//当前选中标签获得选中效果
			var x = $(this).index()//获得当前点击元素在同级的序号
			$(".neir").hide()//影藏所有的内容
			$(".neir").eq(x).show()//显示当前选中的内容
		})				
		
	})
</script>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">联系我们</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=edit" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="11%" height="40" align="center" class="bline">地区名称</td>
          <td width="89%" align="left" class="bline"><input name="name1" type="text" id="name1" style="width:200px;" value="<?php echo $rs['name1'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">地区名称</td>
          <td align="left" class="bline"><input name="name2" type="text" id="name2" style="width:200px;" value="<?php echo $rs['name2'];?>" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">地区名称</td>       
          <td align="left" class="bline"><input name="name3" type="text" id="name3" style="width:200px;" value="<?php echo $rs['name3'];?>" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">地区名称</td>       
          <td align="left" class="bline"><input name="name4" type="text" id="name4" style="width:200px;" value="<?php echo $rs['name4'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline"><h1>客户服务电话</h1></td>
          <td align="left" class="bline"><input name="khtel" type="text" id="khtel" style="width:200px;" value="<?php echo $rs['khtel'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline"><h1>技术支持热线</h1></td>
          <td align="left" class="bline"><input name="jstel" type="text" id="jstel" style="width:200px;" value="<?php echo $rs['jstel'];?>" /></td>
        </tr>
        <tr>
          <td height="345" align="center" class="bline">内容</td>
          <td align="left" class="bline">
          <ul class="nav_list">
		  <li>内容1</li>                      
		  <li>内容2</li>
		  <li>内容3</li>
		  <li>内容4</li>
			</ul>
            <div class="neir">                             
			<script >
        KE.show({
            id : 'content1',
            width : '100%',
            resizeMode : 1,//只能调整高度
            imageUploadJson : '../../upload_json.php',
            fileManagerJson : '../../file_manager_json.php',
            allowFileManager : true,
            afterCreate : function(id) {
                KE.event.ctrl(document, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
                KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
            }
        });
    	</script>
    	<textarea id="content1" name="content1" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['content1'];?></textarea>
        </div>
	
            <div class="neir">                               
            <script >
        KE.show({
            id : 'content2',
            width : '100%',
            resizeMode : 1,//只能调整高度
            imageUploadJson : '../../upload_json.php',
            fileManagerJson : '../../file_manager_json.php',
            allowFileManager : true,
            afterCreate : function(id) {
                KE.event.ctrl(document, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
                KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
            }
        });
        </script>
        <textarea id="content2" name="content2" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['content2'];?></textarea>
		</div>

		    <div class="neir">                                 
		<script>
		 KE.show({
            id : 'content3',
            width : '100%',
            resizeMode : 1,//只能调整高度
            imageUploadJson : '../../upload_json.php',
            fileManagerJson : '../../file_manager_json.php',
            allowFileManager : true,
            afterCreate : function(id) {
                KE.event.ctrl(document, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
                KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
            }
        });
        </script>
        <textarea id="content3" name="content3" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['content3'];?></textarea>
        </div>

		<div class="neir">                                 
		<script>
		 KE.show({
            id : 'content4',
            width : '100%',
            resizeMode : 1,//只能调整高度
            imageUploadJson : '../../upload_json.php',
            fileManagerJson : '../../file_manager_json.php',
            allowFileManager : true,
            afterCreate : function(id) {
                KE.event.ctrl(document, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
                KE.event.ctrl(KE.g[id].iframeDoc, 13, function() {
                    KE.util.setData(id);
                    document.forms['myform'].submit();
                });
            }
        });
        </script>
        <textarea id="content4" name="content4" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['content4'];?></textarea>
        </div>

          </td>
        </tr>
        <tr>
          <td height="60" align="center" class="bline">&nbsp;</td>
          <td align="left" class="bline">
          	<input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
            <input type="submit" name="Submit" value="修改内容" class="bn2" /></td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>