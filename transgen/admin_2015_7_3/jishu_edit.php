<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('47',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


header('Content-Type: text/html; charset=utf-8');

$id = trim($_GET['id']);

$sql1 = "select * from `".$dbpre."jishu` where id='" . $id . "'";
$query1 = mysql_query($sql1, $conn);
$rs = mysql_fetch_array($query1);

$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"edit";
	 $id = trim($_POST['id']);
	 $dingdanhao = trim($_POST['dingdanhao']);
	 $weituoriqi = trim($_POST['weituoriqi']);
	 $shiyanyuan = trim($_POST['shiyanyuan']);
	 $shiyanfeiyong = trim($_POST['shiyanfeiyong']);
	 $yewuyuan = trim($_POST['yewuyuan']);
	 $cat = trim($_POST['cat']);
	 $name = trim($_POST['name']);
     $mobile = trim($_POST['mobile']);
	 $email = trim($_POST['email']);
     $shiyanname = trim($_POST['shiyanname']);
	 $syjd1 = trim($_POST['syjd1']);
	 $syjd2 = trim($_POST['syjd2']);
	 $syjd3 = trim($_POST['syjd3']);
	 $syjd4 = trim($_POST['syjd4']);
	 $syjd5 = trim($_POST['syjd5']);
	 $syjd6 = trim($_POST['syjd6']);
	 $syjd7 = trim($_POST['syjd7']);
	 $syjd8 = trim($_POST['syjd8']);
	 $syjd9 = trim($_POST['syjd9']);
	 $syjd10 = trim($_POST['syjd10']);
	 $syjd11 = trim($_POST['syjd11']);
	 $syjd12 = trim($_POST['syjd12']);
	 $syjd13 = trim($_POST['syjd13']);
	 $syjd14 = trim($_POST['syjd14']);
	 $syjd15 = trim($_POST['syjd15']);
	 $syjd16 = trim($_POST['syjd16']);
	 $syjd17 = trim($_POST['syjd17']);
	 $syjd18 = trim($_POST['syjd18']);
	 $syjd19 = trim($_POST['syjd19']);
	 $syjd20 = trim($_POST['syjd20']);
	 $beizhu = trim($_POST['beizhu']);
	 $fax = trim($_POST['fax']);
	 $danwei = trim($_POST['danwei']);
	 $bumen = trim($_POST['bumen']);
	 $dizhi = trim($_POST['dizhi']);
	 $youbian = trim($_POST['youbian']);
	 $addtime = strtotime($_POST['addtime']);
		
        $sql = "update `".$dbpre."jishu` set dingdanhao='$dingdanhao',weituoriqi='$weituoriqi',shiyanyuan='$shiyanyuan',shiyanfeiyong='$shiyanfeiyong',yewuyuan='$yewuyuan',cat='$cat',name='$name',mobile='$mobile',email='$email',shiyanname='$shiyanname',syjd1='$syjd1',syjd2='$syjd2',syjd3='$syjd3',syjd4='$syjd4',syjd5='$syjd5',syjd6='$syjd6',syjd7='$syjd7',syjd8='$syjd8',syjd9='$syjd9',syjd10='$syjd10',syjd11='$syjd11',syjd12='$syjd12',syjd13='$syjd13',syjd14='$syjd14',syjd15='$syjd15',syjd16='$syjd16',syjd17='$syjd17',syjd18='$syjd18',syjd19='$syjd19',syjd20='$syjd20',beizhu='$beizhu',fax='$fax',danwei='$danwei',bumen='$bumen',dizhi='$dizhi',youbian='$youbian',addtime='$addtime' where id='".$id."'";
		if(mysql_query($sql, $conn)){
        	echo "<script>alert('修改成功');window.location.href='jishu_edit.php?id=".$id."'</script>";
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
	if(o.shiyanname.value==""){
		alert("请填写实验名称");
		o.shiyanname.focus();
		return false;
	}
	if(o.dingdanhao.value==""){
		alert("请填写订单号");
		o.dingdanhao.focus();
		return false;
	}
	if(o.yewuyuan.value==""){
		alert("请填写业务员姓名");
		o.yewuyuan.focus();
		return false;
	}
	if(o.shiyanyuan.value==""){
		alert("请填写实验员姓名");
		o.shiyanyuan.focus();
		return false;
	}
	if(o.email.value==""){
		alert("请填写客户邮箱");
		o.email.focus();
		return false;
	}
	if(o.name.value==""){
		alert("请填写客户姓名");
		o.dingdanhao.focus();
		return false;
	}
	if(o.mobile.value==""){
		alert("请填写客户手机");
		o.mobile.focus();
		return false;
	}
	if(o.weituoriqi.value==""){
		alert("请填写委托日期");
		o.weituoriqi.focus();
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
  <DIV class="ListTit">实验技术委托条目修改</DIV>
  <DIV class="ListfBox">
    <form name="myform" id="myform" action="?action=edit" method="post" onsubmit="return checkform(this)">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="40" align="center" class="bline">实验名称</td>
          <td align="left" class="bline"><input name="shiyanname" type="text" id="shiyanname" value="<?php echo $rs['shiyanname'];?>" style="width:600px;" />*必填</td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验委托订单号</td>
          <td align="left" class="bline"><input name="dingdanhao" type="text" id="dingdanhao" value="<?php echo $rs['dingdanhao'];?>" style="width:250px;" />*必填</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">委托日期</td>
          <td align="left" class="bline"><input name="weituoriqi" type="text" id="weituoriqi" value="<?php echo $rs['weituoriqi'];?>" style="width:150px;" />*必填 *日期格式：2014-01-01</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">实验员</td>
          <td align="left" class="bline"><input name="shiyanyuan" type="text" id="shiyanyuan" value="<?php echo $rs['shiyanyuan'];?>" style="width:100px;" />*必填</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">实验费用</td>
          <td align="left" class="bline"><input name="shiyanfeiyong" type="text" id="shiyanfeiyong" value="<?php echo $rs['shiyanfeiyong'];?>" style="width:150px;" />*必填</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">业务员</td>
          <td align="left" class="bline"><input name="yewuyuan" type="text" id="yewuyuan" value="<?php echo $rs['yewuyuan'];?>" style="width:100px;" />*必填</td>
        </tr>
        <tr>
          <td width="13%" height="40" align="center" class="bline">实验状态</td>
          <td width="87%" align="left" class="bline">
          <select name="cat" id="cat">
            <option value="">--请选择实验状态--</option>
            <?php
            $sqlcat = mysql_query("select id,catname from `".$dbpre."catjishu` order by id asc",$conn);
			while($row = mysql_fetch_array($sqlcat)){
			?>
            <option value="<?php echo $row['id'];?>" <?php if($rs['cat']==$row['id']){echo " selected=\"selected\"";}?>><?php echo $row['catname'];?></option>
            <?php
			}
			?>
          </select>*必选</td>
        </tr>
         <tr>
          <td width="13%" height="40" align="center" class="bline">姓名</td>
          <td width="87%" align="left" class="bline"><input name="name" type="text" id="name" value="<?php echo $rs['name'];?>" style="width:100px;" />
            *必填</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">手机</td>
          <td align="left" class="bline"><input name="mobile" type="text" id="mobile" value="<?php echo $rs['mobile'];?>" style="width:150px;" />
*必填</td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">E-mail</td>
          <td align="left" class="bline">
          <input name="email" type="text" id="email" value="<?php echo $rs['email'];?>" style="width:200px;" />
*必填</td>
        </tr>
<!-- 实验阶段开始  -->
		<tr>
          <td height="40" align="center" class="bline">实验阶段一</td>
          <td align="left" class="bline">
          <input name="syjd1" type="text" id="syjd1" value="<?php echo $rs['syjd1'];?>" style="width:600px;" />
</td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段二</td>
          <td align="left" class="bline">
          <input name="syjd2" type="text" id="syjd2" value="<?php echo $rs['syjd2'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段三</td>
          <td align="left" class="bline">
          <input name="syjd3" type="text" id="syjd3" value="<?php echo $rs['syjd3'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段四</td>
          <td align="left" class="bline">
          <input name="syjd4" type="text" id="syjd4" value="<?php echo $rs['syjd4'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段五</td>
          <td align="left" class="bline">
          <input name="syjd5" type="text" id="syjd5" value="<?php echo $rs['syjd5'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段六</td>
          <td align="left" class="bline">
          <input name="syjd6" type="text" id="syjd6" value="<?php echo $rs['syjd6'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段七</td>
          <td align="left" class="bline">
          <input name="syjd7" type="text" id="syjd7" value="<?php echo $rs['syjd7'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段八</td>
          <td align="left" class="bline">
          <input name="syjd8" type="text" id="syjd8" value="<?php echo $rs['syjd8'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段九</td>
          <td align="left" class="bline">
          <input name="syjd9" type="text" id="syjd9" value="<?php echo $rs['syjd9'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十</td>
          <td align="left" class="bline">
          <input name="syjd10" type="text" id="syjd10" value="<?php echo $rs['syjd10'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十一</td>
          <td align="left" class="bline">
          <input name="syjd11" type="text" id="syjd11" value="<?php echo $rs['syjd11'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十二</td>
          <td align="left" class="bline">
          <input name="syjd12" type="text" id="syjd12" value="<?php echo $rs['syjd12'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十三</td>
          <td align="left" class="bline">
          <input name="syjd13" type="text" id="syjd13" value="<?php echo $rs['syjd13'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十四</td>
          <td align="left" class="bline">
          <input name="syjd14" type="text" id="syjd14" value="<?php echo $rs['syjd14'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十五</td>
          <td align="left" class="bline">
          <input name="syjd15" type="text" id="syjd15" value="<?php echo $rs['syjd15'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十六</td>
          <td align="left" class="bline">
          <input name="syjd16" type="text" id="syjd16" value="<?php echo $rs['syjd16'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十七</td>
          <td align="left" class="bline">
          <input name="syjd17" type="text" id="syjd17" value="<?php echo $rs['syjd17'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十八</td>
          <td align="left" class="bline">
          <input name="syjd18" type="text" id="syjd18" value="<?php echo $rs['syjd18'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段十九</td>
          <td align="left" class="bline">
          <input name="syjd19" type="text" id="syjd19" value="<?php echo $rs['syjd19'];?>" style="width:600px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验阶段二十</td>
          <td align="left" class="bline">
          <input name="syjd20" type="text" id="syjd20" value="<?php echo $rs['syjd20'];?>" style="width:600px;" /></td>
        </tr>
<!--  实验阶段结束 -->
          <td height="318" align="center" class="bline">备注</td>
          <td align="left" class="bline">
          <script >
			KE.show(
				{
					id: 'beizhu',
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
		<textarea id="beizhu" name="beizhu" cols="100" rows="8" style="width:100%;height:300px;visibility:hidden;"><?php echo $rs['beizhu'];?></textarea>
          </td>
        </tr>
       <tr>
          <td height="40" align="center" class="bline">单位</td>
          <td align="left" class="bline">
          <input name="danwei" type="text" id="danwei" value="<?php echo $rs['danwei'];?>" style="width:200px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">实验室或部门</td>
          <td align="left" class="bline">
          <input name="bumen" type="text" id="bumen" value="<?php echo $rs['bumen'];?>" style="width:150px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">传真</td>
          <td align="left" class="bline">
          <input name="fax" type="text" id="fax" value="<?php echo $rs['fax'];?>" style="width:100px;" /></td>
        </tr>
		<tr>
          <td height="40" align="center" class="bline">地址</td>
          <td align="left" class="bline">
          <input name="dizhi" type="text" id="dizhi" value="<?php echo $rs['dizhi'];?>" style="width:600px;" /></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">邮编</td>
          <td align="left" class="bline"><input name="youbian" type="text" id="youbian" value="<?php echo $rs['youbian'];?>" style="width:50px;"/></td>
        </tr>
        <tr>
          <td height="40" align="center" class="bline">发布时间</td>
          <td align="left" class="bline"><input name="addtime" type="text" id="addtime" style="width:150px;" value="<?php echo date('Y-m-d H:i:s', $rs['addtime']);?>" /></td>
        </tr>
        <tr>
          <td height="60" align="center">&nbsp;</td>
          <td align="left">
          <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
            <input type="submit" name="Submit" value="修改内容" class="bn2" /></td>
        </tr>
      </table>
    </form>
  </DIV>
</DIV>
</body>
</html>