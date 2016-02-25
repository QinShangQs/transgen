<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('23',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";
    
	 $cat = trim($_POST['cat']);
	 $name = trim($_POST['name']);
     $content = trim($_POST['content']);
	 $title = trim($_POST['title']);
     $keywords = trim($_POST['keywords']);
	 $description = trim($_POST['description']);
	 $hist = getParam('hist', 'POST', 0);
	 $addtime = strtotime($_POST['addtime']);
		
        $sql = "insert into `".$dbpre."news` (cat,`name`,title,keywords,description,content,hist,addtime) values ('$cat','$name','$title','$keywords','$description','$content','$hist','$addtime')";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('添加成功');window.location.href='news_add.php'</script>";
		}else{
			echo "<script>alert('添加失败');window.location.href='javascript:history.go(-1)'</script>";
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>添加资讯文章</title>
<LINK rel=stylesheet type=text/css href="css/common.css">
<LINK rel=stylesheet type=text/css href="css/default.css">
<link rel="stylesheet" href="../themes/default/default.css" />
		<script charset="utf-8" src="kindeditor/kindeditor-all.js"></script>
		<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
				K('input[name=getHtml]').click(function(e) {
					alert(editor.html());
				});
				K('input[name=isEmpty]').click(function(e) {
					alert(editor.isEmpty());
				});
				K('input[name=getText]').click(function(e) {
					alert(editor.text());
				});
				K('input[name=selectedHtml]').click(function(e) {
					alert(editor.selectedHtml());
				});
				K('input[name=setHtml]').click(function(e) {
					editor.html('<h3>Hello KindEditor</h3>');
				});
				K('input[name=setText]').click(function(e) {
					editor.text('<h3>Hello KindEditor</h3>');
				});
				K('input[name=insertHtml]').click(function(e) {
					editor.insertHtml('<strong>插入HTML</strong>');
				});
				K('input[name=appendHtml]').click(function(e) {
					editor.appendHtml('<strong>添加HTML</strong>');
				});
				K('input[name=clear]').click(function(e) {
					editor.html('');
				});
			});
		</script>
<SCRIPT language="JavaScript">
function checkform(o){
	if(o.name.value==""){
		alert("请填写新闻标题");
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
  <DIV class="ListTit">新闻添加</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="40" align="center" class="bline">新闻标题</td>
          <td align="left" class="bline"><input name="name" type="text" id="name" style="width:500px;" /></td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">栏目分类</td>
          <td width="87%" align="left" class="bline">
          <select name="cat" id="cat">
            <option value="" selected="selected">--请选择栏目分类--</option>
            <?php
            $sqlcat = mysql_query("select id,catname from `".$dbpre."catnews` order by id asc",$conn);
			while($row = mysql_fetch_array($sqlcat)){
			?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['catname'];?></option>
            <?php
			}
			?>
          </select></td>
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
          <td height="318" align="center" class="bline">内容</td>
          <td align="left" class="bline">
		<textarea id="content" name="content" cols="100" rows="8" style="width:100%;height:300px;visibility:hidden;"><?php echo htmlspecialchars($htmlData,ENT_QUOTES,'utf-8'); ?></textarea>
		<p>
				<input type="button" name="getHtml" value="取得HTML" />
				<input type="button" name="isEmpty" value="判断是否为空" />
				<input type="button" name="getText" value="取得文本(包含img,embed)" />
				<input type="button" name="selectedHtml" value="取得选中HTML" />
				<br />
				<br />
				<input type="button" name="setHtml" value="设置HTML" />
				<input type="button" name="setText" value="设置文本" />
				<input type="button" name="insertHtml" value="插入HTML" />
				<input type="button" name="appendHtml" value="添加HTML" />
				<input type="button" name="clear" value="清空内容" />
				<input type="reset" name="reset" value="Reset" />
			</p>
          </td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">浏览次数</td>
          <td align="left" class="bline"><input name="hist" type="text" id="hist" style="width:50px;" value="0" /></td>
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