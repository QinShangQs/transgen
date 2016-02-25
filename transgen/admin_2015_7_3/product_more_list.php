<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('17',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}


$sid = $_GET['sid'];

$action=$_GET['action'];
switch($action){
	//删除记录
    case"del";
		
        if(empty($_POST['id'])){
			echo"<script>alert('必须选择一条信息,才可以删除!');history.back(-1);</script>";
			exit;
		}else{
		/*如果要获取全部数值则使用下面代码*/
		
		$id= implode(",",$_POST['id']);
		$sid = trim($_POST['sid']);
		
		$str="delete from `".$dbpre."product` where id in ($id)";
		mysql_query($str);
		echo "<script>alert('删除成功！');window.location.href='product_more_list.php?sid=$sid';</script>";
		}
        break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CPWEB</title>
<LINK rel=stylesheet type=text/css href="css/common.css">
<LINK rel=stylesheet type=text/css href="css/default.css">
<script type="text/javascript" language="javascript">
function selectBox(selectType){
var checkboxis = document.getElementsByName("id[]");
if(selectType == "reverse"){
for (var i=0; i<checkboxis.length; i++){
//alert(checkboxis[i].checked);
checkboxis[i].checked = !checkboxis[i].checked;
}
}
else if(selectType == "all")
{
for (var i=0; i<checkboxis.length; i++){
//alert(checkboxis[i].checked);
checkboxis[i].checked = true;
}
}
}
</script>
</head>
<body>
<DIV class="Listbox">
  <DIV class="ListTit">产品列表</DIV>
  <DIV class="ListfBox">
  <form id="form2" name="form2" method="post" action="?action=del">
<input type="hidden" id="sid" name="sid" value="<?php echo $sid;?>" />   
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="40" colspan="3" align="left" class="bline">
            　<b>产品名称：<?php
			  $sqlcat = mysql_query("select name from `".$dbpre."product` where id='".$sid."'",$conn);
			  $rowcat = mysql_fetch_array($sqlcat);
			  echo $rowcat['name'];
			  ?></b>
            </td>
            <td align="center" class="bline">&nbsp;</td>
            <td align="center" class="bline">&nbsp;</td>
            <td align="center" class="bline">&nbsp;</td>
            <td align="center" class="bline">&nbsp;</td>
          </tr>
          <tr>
              <td width="4%" height="30" align="center" class="bline">ID</td>
              <td width="6%" align="left" class="bline">&nbsp;</td>
              <td width="37%" align="left" class="bline">目录号</td>
              <td width="15%" align="center" class="bline">规格</td>
              <td align="center" class="bline">单价</td>
              <td width="10%" align="center" class="bline">热销产品</td>
              <td width="15%" align="center" class="bline">相关操作</td>
          </tr>
          <?php
			$sqlzt = "select * from `".$dbpre."product` where sid='".$sid."' order by addtime";
			$queryzt = mysql_query($sqlzt, $conn);
			$count = mysql_num_rows($queryzt);
			while ($rslist = mysql_fetch_array($queryzt))
				{
			?>					
              <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
                  <td height="30" align="center" class="bline">
                  <label>
                <input type="checkbox" name="id[]" value="<?php echo $rslist['id'];?>" style="background:none; border:none;" />
                </label>
                  </td>
                  <td align="left" class="bline"><?php echo $rslist['id']; ?></td>
                  <td align="left" class="bline"><?php echo $rslist['name']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['guige'];?></td>
                  <td width="13%" align="center" class="bline"><?php echo $rslist['price']; ?></td>
                  <td align="center" class="bline">
                  <?php 
				  if($rslist['hot']==1){
					echo "<span style=\"color:#690;\">是</span>";  
				  }else{
				    echo "否";  
				  }
				  ?>
                  </td>
                  <td align="center" class="bline"><a href="product_more_edit.php?id=<?php echo $rslist['id']; ?>">编辑</a></td>
              </tr>	
             <?php
			}
			
			if($count >0)
			{
			?>            
            <tr bgcolor="#ffffff">
                <td height="40" colspan="7" align="left">
                <div style="padding-left:10px;"><input type="button" value="全选" class="btbg" onClick="selectBox('all')"/> 
  <input type="button" value="反选" onClick="selectBox('reverse')"/> 
  <input type="submit" name="btnSave" value="删除"/></div>
                </td>
           </tr>
           <?php
			}else{
		   ?>
           <tr bgcolor="#ffffff">
                <td height="30" colspan="7" align="center">暂无内容</td>
           </tr>
           <?php }?>	
    </table>
    </form>
  </DIV>
</DIV>
</body>
</html>