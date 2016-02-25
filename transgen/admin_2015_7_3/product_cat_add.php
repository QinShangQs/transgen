<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('19',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"add";
    
	 $catname = trim($_POST['catname']);
	 $ms = trim($_POST['ms']);
     $px = trim($_POST['px']);
	 $cid = trim($_POST['cid']);
		
        $sql = "insert into `".$dbpre."product_cat` (`catname`,px,ms,cid) values ('$catname','$px','$ms','$cid')";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('添加成功');window.location.href='product_cat_add.php'</script>";
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
	if(o.catname.value==""){
		alert("请填写分类名称");
		o.catname.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">产品分类添加</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=add" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="13%" height="40" align="center" class="bline">分类名称</td>
          <td width="87%" align="left" class="bline"><input name="catname" type="text" id="catname" style="width:200px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">分类所属</td>
          <td align="left" class="bline">
          <select name="cid" id="cid">
            <option value="0" selected="selected">顶级分类</option>
            <?php 
			$sqlcid = mysql_query("select id,catname from `".$dbpre."product_cat` where cid=0",$conn);
			while($rscid = mysql_fetch_array($sqlcid)){
			?>
            <option value="<?php echo $rscid['id'];?>"><?php echo $rscid['catname'];?></option>
            <?php
			}
			?>
          </select></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">分类排序</td>
          <td align="left" class="bline"><input name="px" type="text" id="px" value="0" style="width:50px; text-align:center;" /></td>
        </tr>
        <tr style="display:none;">
          <td height="311" align="center">分类描述</td>
          <td align="left">
          <script >
			KE.show(
				{
					id: 'ms',
					width: '80%',
					resizeMode: 1, //只能调整高度
					imageUploadJson: '../../upload_json.php',
					fileManagerJson: '../../file_manager_json.php',
					allowFileManager: true,
					afterCreate: function(id)
					{
						KE.event.ctrl(document, 13, function()
							{
								KE.util.setData(id);
								document.forms['myform'].submit();
							});
						KE.event.ctrl(KE.g[id].iframeDoc, 13, function()
							{
								KE.util.setData(id);
								document.forms['myform'].submit();
							});
					}
				});
		</script>
		<textarea id="ms" name="ms" cols="100" rows="8" style="width:100%;height:300px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
          </td>
        </tr>
        <tr>
          <td height="60" align="center">&nbsp;</td>
          <td align="left">
            <input type="submit" name="Submit" value="添加分类" class="bn2" /></td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>