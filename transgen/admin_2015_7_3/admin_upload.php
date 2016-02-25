<html>
<head>
<title>图片上传</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$uppath=isset($_REQUEST["upPath"])?$_REQUEST["upPath"]."/":"/attached/";              //文件上传路径
$formName=isset($_REQUEST["formName"])?$_REQUEST["formName"]:$_REQUEST["formName"];          //回传到上页面编辑框所在Form的Name
$editName=isset($_REQUEST["editName"])?$_REQUEST["editName"]:$_REQUEST["editName"];              //回传到上页面编辑框的Name
//示例
/*

<form name="myform">
<input name="pic" Type="text"    size="50" maxlength="50" >
<input type="button" name="Submit" value="点击上传图片" onClick="window.open('Admin_upload.php?formName=myform&editName=pic&upPath=/uploadfile','','status=no,scrollbars=no,top=20,left=110,width=420,height=165')">
</form>

*/
?>
<script language="javascript">
<!--
function mysub()
{
          esave.style.visibility="visible";
}
-->
</script>
<style type="text/css">
<!--
.STYLE2 {
	font-size: 12pt
}
.STYLE3 {
	font-size: 14pt
}
-->
</style>
</head>
<body oncontextmenu='return false' onselectstart="return false" oncopy="return false;" oncut="return false;">
<form name="form1" method="post" action="admin_upfile.php" enctype="multipart/form-data" >
  <div id="esave" style="position:absolute; top:18px; left:40px; z-index:10; visibility:hidden">
    <TABLE WIDTH=340 BORDER=0 CELLSPACING=0 CELLPADDING=0>
      <TR>
        <td width=20?></td>
        <TD bgcolor=#ff0000 width="60%"><TABLE WIDTH=100% height=120 BORDER=0 CELLSPACING=1 CELLPADDING=0>
            <TR>
              <td bgcolor=#ffffff align=center><font color=red>正在上传文件，请稍候...</font></td>
            </tr>
          </table></td>
        <td width=20?></td>
      </tr>
    </table>
  </div>
  <table class="Border" width="100%" border="0" height="100%" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
      <td align="center" class="title" height="30"><b><span class="style2 STYLE3">图 片 上 传</span>
        <input type="hidden" name="upPath" value="<?=$uppath?>">
        <input type="hidden" name="editName" value="<?=$editName?>">
        <input type="hidden" name="formName" value="<?=$formName?>">
        </b> </td>
    </tr>
    <tr bgcolor="#E8F1FF">
      <td height="94" align="center" id="upid">选择文件:
        <input type="file" name="file1" size="20" class="tx1" value="">
        <input type="submit" name="Submit" value="开始上传" class="button" onClick="mysub();">
        <br></td>
    </tr>
  </table>
</form>
</body>
</html>
