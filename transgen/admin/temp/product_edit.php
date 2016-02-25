<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('16',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');

$id = trim($_GET['id']);

$sql1 = "select * from `".$dbpre."product` where id='" . $id . "'";
$query1 = mysql_query($sql1, $conn);
$rs = mysql_fetch_array($query1);

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"edit";
    
	 $id = trim($_POST['id']);
	 $cat = trim($_POST['cat']);
	 $name = trim($_POST['name']);
     $tedian = trim($_POST['tedian']);
	 $fanwei = trim($_POST['fanwei']);
     $baocun = trim($_POST['baocun']);
	 $sm = addslashes(trim($_POST['sm']));
	 $addtime = strtotime($_POST['addtime']);
		
     $sql = "update `".$dbpre."product` set cat='$cat',name='$name',tedian='$tedian',fanwei='$fanwei',baocun='$baocun',sm='$sm',addtime='$addtime' where id='".$id."'";
	 
		if(mysql_query($sql, $conn)){
			
			$sqlu = "update `".$dbpre."product` set name_pro='$name' where sid='".$id."'";
			mysql_query($sqlu, $conn);
			
        	echo "<script>alert('修改成功');window.location.href='product_edit.php?id=".$id."'</script>";
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
<SCRIPT language="JavaScript">
function checkform(o){
	if(o.name.value==""){
		alert("请填写产品名称");
		o.name.focus();
		return false;
	}
	if(o.cat.value==""){
		alert("请选择栏目分类");
		o.cat.focus();
		return false;
	}
	if(o.tedian.value==""){
		alert("请填写产品特点");
		o.tedian.focus();
		return false;
	}
	if(o.fanwei.value==""){
		alert("请填写适用范围");
		o.fanwei.focus();
		return false;
	}
	if(o.baocun.value==""){
		alert("请填写保存");
		o.baocun.focus();
		return false;
	}
	return true;
}
</SCRIPT>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">产品修改</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=edit" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="40" align="center" class="bline">产品名称</td>
          <td align="left" class="bline"><input name="name" type="text" id="name" style="width:500px;" value="<?php echo $rs['name'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">推广链接</td>
          <td align="left" class="bline"><?php echo $weburl;?>products_show/<?php echo $rs['id'];?>.html</td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">栏目分类</td>
          <td width="87%" align="left" class="bline">
          <select name="cat" id="cat">
            <option value="" selected="selected">--请选择栏目分类--</option>
            <?php
            $sqlcat = mysql_query("select id,catname from `".$dbpre."product_cat` where cid!=0 order by id asc",$conn);
			while($row = mysql_fetch_array($sqlcat)){
			?>
            <option value="<?php echo $row['id'];?>" <?php if($row['id']==$rs['cat']){echo " selected=\"selected\"";}?>><?php echo $row['catname'];?></option>
            <?php
			}
			?>
          </select></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">特点</td>
          <td align="left" class="bline"><input name="tedian" type="text" id="tedian" style="width:400px;" value="<?php echo $rs['tedian'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">适用范围</td>
          <td align="left" class="bline"><input name="fanwei" type="text" id="fanwei" style="width:400px;" value="<?php echo $rs['fanwei'];?>" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">保存</td>
          <td align="left" class="bline"><input name="baocun" type="text" id="baocun" style="width:400px;" value="<?php echo $rs['baocun'];?>" /></td>
        </tr>
        <tr>
          <td height="318" align="center" class="bline">产品说明</td>
          <td align="left" class="bline">
          <script >
			KE.show(
				{
					id: 'sm',
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
		<textarea id="sm" name="sm" cols="100" rows="8" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['sm'];?></textarea>
          </td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">发布时间</td>
          <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', $rs['addtime']);?>" /></td>
        </tr>
        <tr>
          <td height="60" align="center">&nbsp;</td>
          <td align="left">
          <input type="hidden" name="id" value="<?php echo $id;?>" />
            <input type="submit" name="Submit" value="修改产品" class="bn2" /></td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>