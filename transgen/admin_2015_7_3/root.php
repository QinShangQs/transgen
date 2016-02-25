<?php
session_start();
require '../config.inc.php';
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
//var_dump($_POST);
if($_POST){
	//删除当前用户的所有权限
	$sql="DELETE FROM `quanxian` WHERE `username` = '".$_GET['username']."'";
	//var_dump($sql);
	mysql_query($sql,$conn);
	foreach($_POST['quanxian'] as $quanxianurl){
		$sql="INSERT INTO `quanxian` (`id` ,`urlname` ,`username`) VALUES (NULL , '".$quanxianurl."', '".$_GET['username']."')";
		mysql_query($sql,$conn);
		echo "<script>alert('修改成功');window.location.href='root.php?username=".$_GET['username']."'</script>";
	}
	
}
$sql="select * from quanxian where username='".$_GET['username']."'";


$query=mysql_query($sql,$conn);
while($result=mysql_fetch_array($query)){
	$quanxian[]=$result['urlname'];
}

//var_dump($sql,$quanxian);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CPWEB</title>
<link href="images/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="bodyTitle">
  <div class="bodyTitleLeft"></div>
  <div class="bodyTitleText">权限分配</div>
</div>
<br>
<div style="border-top:2px #309ad6 solid; margin-top:10px;">
  <form name="form1" id="form1" method="post" action="?action=edit&username=<?php echo $_GET['username']; ?>" >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="13%" height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">基本设置</td>
        <td width="87%" align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input <?php echo in_array("passwrod.php",$quanxian)?'checked':'';?> type="checkbox" name="quanxian[]" id="quanxian[]" value="passwrod.php" />
          修改管理员密码
          <input <?php echo in_array("gjz_edit.php",$quanxian)?'checked':'';?> type="checkbox" name="quanxian[]" id="quanxian[]" value="gjz_edit.php" />
          关键字设置
          <input <?php echo in_array("links_add.php",$quanxian)?'checked':'';?> type="checkbox" name="quanxian[]" id="quanxian[]" value="links_add.php" />
          添加友情链接
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("links_list.php",$quanxian)?'checked':'';?> value="links_list.php" />
          友情链接列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("danye_list.php",$quanxian)?'checked':'';?> value="danye_list.php" />
          单页管理</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">装修公司</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongsi_add.php",$quanxian)?'checked':'';?> value="gongsi_add.php" />
          添加装修公司
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongsi_list.php",$quanxian)?'checked':'';?> value="gongsi_list.php" />
          装修公司列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongsi_edit.php",$quanxian)?'checked':'';?> value="gongsi_edit.php" />
          装修公司修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">设计师</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("shejishi_add.php",$quanxian)?'checked':'';?> value="shejishi_add.php" />
          添加设计师
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("shejishi_list.php",$quanxian)?'checked':'';?> value="shejishi_list.php" />
          设计师列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("shejishi_edit.php",$quanxian)?'checked':'';?> value="shejishi_edit.php" />
          设计师修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">建材商</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("jiancaishang_add.php",$quanxian)?'checked':'';?> value="jiancaishang_add.php" />
          添加建材商
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("jiancaishang_list.php",$quanxian)?'checked':'';?> value="jiancaishang_list.php" />
          建材商列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("jiancaishang_edit.php",$quanxian)?'checked':'';?> value="jiancaishang_edit.php" />
          建材商修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">楼盘管理</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("loupanxiaoqu_add.php",$quanxian)?'checked':'';?> value="loupanxiaoqu_add.php" />
          添加楼盘小区
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("loupanxiaoqu_list.php",$quanxian)?'checked':'';?> value="loupanxiaoqu_list.php" />
          楼盘小区列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("loupanxiaoqu_edit.php",$quanxian)?'checked':'';?> value="loupanxiaoqu_edit.php" />
          楼盘小区修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">案例图库</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("xiangce_add.php",$quanxian)?'checked':'';?> value="xiangce_add.php" />
          添加案例
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("xiangce_list.php",$quanxian)?'checked':'';?> value="xiangce_list.php" />
          案例列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("xiangce_edit.php",$quanxian)?'checked':'';?> value="xiangce_edit.php" />
          案例修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">在建工地</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongdi_add.php",$quanxian)?'checked':'';?> value="gongdi_add.php" />
          添加在建工地
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongdi_list.php",$quanxian)?'checked':'';?> value="gongdi_list.php" />
          在建工地列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongdi_edit.php",$quanxian)?'checked':'';?> value="gongdi_edit.php" />
          在建工地修改 </td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">居家百科</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("article_add.php",$quanxian)?'checked':'';?> value="article_add.php" />
          添加居家百科
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("article_list.php",$quanxian)?'checked':'';?> value="article_list.php" />
          居家百科列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("article_edit.php",$quanxian)?'checked':'';?> value="article_edit.php" />
          居家百科修改
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("article_dianpinglist.php",$quanxian)?'checked':'';?> value="article_dianpinglist.php" />
          文章点评列表</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">用户管理</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("member_list.php",$quanxian)?'checked':'';?> value="member_list.php" />
          普通会员列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("member_zxgslist.php",$quanxian)?'checked':'';?> value="member_zxgslist.php" />
          装修公司列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("member_shejishilist.php",$quanxian)?'checked':'';?> value="member_shejishilist.php" />
          设计师列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("member_jcslist.php",$quanxian)?'checked':'';?> value="member_jcslist.php" />
          建材商列表</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">活动管理</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("huodong_add.php",$quanxian)?'checked':'';?> value="huodong_add.php" />
          添加活动
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("huodong_list.php",$quanxian)?'checked':'';?> value="huodong_list.php" />
          活动列表
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("huodong_edit.php",$quanxian)?'checked':'';?> value="huodong_edit.php" />
          活动修改</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">广告管理</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("ad_edit.php",$quanxian)?'checked':'';?> value="ad_edit.php" />
          广告修改
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("ad_list.php",$quanxian)?'checked':'';?> value="ad_list.php" />
          广告列表</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">预约管理</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("gongsiyuyue_list.php",$quanxian)?'checked':'';?> value="gongsiyuyue_list.php" />
          预约列表</td>
      </tr>
      <tr>
        <td height="40" align="center" style="border-bottom:1px #D7EBFF dotted;">口碑值</td>
        <td align="left" style="border-bottom:1px #D7EBFF dotted;">
		<input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("koubei_add.php",$quanxian)?'checked':'';?> value="koubei_add.php" />
          添加口碑值
          <input type="checkbox" name="quanxian[]" id="quanxian[]" <?php echo in_array("koubei_list.php",$quanxian)?'checked':'';?> value="koubei_list.php" />
          口碑值列表</td>
      </tr>
    </table>
    <input type=submit name=button value="分配权限" 、>
  </form>
</div>
</body>
</html>
