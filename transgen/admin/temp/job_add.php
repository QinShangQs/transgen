<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('28',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";
    
	 $name = trim($_POST['name']);
     $renshu = trim($_POST['renshu']);
	 $area = trim($_POST['area']);
	 $title = trim($_POST['title']);
     $keywords = trim($_POST['keywords']);
	 $description = trim($_POST['description']);
	 $zhize = trim($_POST['zhize']);
	 $yaoqiu = trim($_POST['yaoqiu']);
	 $addtime = strtotime($_POST['addtime']);
		
        $sql = "insert into `".$dbpre."job` (`name`,renshu,area,title,keywords,description,zhize,yaoqiu,addtime) values ('$name','$renshu','$area','$title','$keywords','$description','$zhize','$yaoqiu','$addtime')";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('添加成功');window.location.href='job_add.php'</script>";
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
<link rel="stylesheet" href="edit/edit.css" />
<script type="text/javascript" src="edit/kindeditor.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<SCRIPT language="JavaScript">
function checkform(o){
	if(o.name.value==""){
		alert("请填写职位名称");
		o.name.focus();
		return false;
	}
	if(o.renshu.value==""){
		alert("请填写招聘人数");
		o.renshu.focus();
		return false;
	}
	if(o.area.value==""){
		alert("请填写招聘地区");
		o.area.focus();
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
  <DIV class="ListTit">人才招聘添加</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="40" align="center" class="bline">职位名称</td>
          <td align="left" class="bline"><input name="name" type="text" id="name" style="width:400px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">招聘人数</td>
          <td align="left" class="bline"><input name="renshu" type="text" id="renshu" style="width:100px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">招聘地区</td>
          <td align="left" class="bline"><input name="area" type="text" id="area" style="width:100px;" /></td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">title</td>
          <td width="87%" align="left" class="bline"><input name="title" type="text" id="title" style="width:400px;" />
            仅SEO优化使用</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">keywords</td>
          <td align="left" class="bline"><input name="keywords" type="text" id="keywords" style="width:400px;" />
仅SEO优化使用</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">description</td>
          <td align="left" class="bline">
          <input name="description" type="text" id="description" style="width:400px;" />
仅SEO优化使用</td>
        </tr>
        <tr>
          <td height="345" align="center" class="bline">内容</td>
          <td align="left" class="bline">
          <ul class="nav_list">
		  <li>岗位职责</li>                      
		  <li>任职要求</li>
			</ul>
            <div class="neir">
            <script >
        KE.show({
            id : 'zhize',
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
    	<textarea id="zhize" name="zhize" style="width:100%;height:300px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
        </div>
	
            <div class="neir">
            <script >
        KE.show({
            id : 'yaoqiu',
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
        <textarea id="yaoqiu" name="yaoqiu" style="width:100%;height:300px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
        </div>
          </td>
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