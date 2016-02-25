<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('6',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

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
        $pg = trim($_POST['pg'])!="" ? trim($_POST['pg']) : 1;
        
        $str="delete from `".$dbpre."banner` where id in ($id)";
        mysql_query($str);
        echo "<script>alert('删除成功！');window.location.href='banner_list.php';</script>";
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
  <DIV class="ListTit">BANNER管理</DIV>
  <DIV class="ListfBox"> 
  <form id="form2" name="form2" method="post" action="?action=del">  
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td width="6%" height="30" align="center" class="bline">ID</td>
              <td width="60%" align="left" class="bline">栏目名称</td>
              <td width="13%" align="center" class="bline">栏目名称</td>
              <td width="10%" align="center" class="bline">是否启用</td>
              <td width="11%" align="center" class="bline">相关操作</td>
          </tr>
          <?php
          $queryd = mysql_query("SELECT * from `".$dbpre."banner` order by id asc", $conn);
          while ($rss = mysql_fetch_array($queryd)) {
              ?>					
              <tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
                  <td height="30" align="center" class="bline">
                  <label>
                <input type="checkbox" name="id[]" value="<?php echo $rss['id'];?>" style="background:none; border:none;" />
                </label>
                  </td>
                  <td align="left" class="bline"><?php echo $rss['name']; ?></td>
                  <td align="center" class="bline">
				  <?php
                  	if($rss['fid']==1){
						echo "首页BANNER";
					}elseif($rss['fid']==2){
						echo "首页快速下载";	
					}elseif($rss['fid']==3){
						echo "首页人才招聘";	
					}elseif($rss['fid']==4){
						echo "服务与支持";	
					}elseif($rss['fid']==5){
						echo "订购中心";	
					}elseif($rss['fid']==6){
						echo "产品中心";	
					}elseif($rss['fid']==7){
						echo "走进全式金";	
					}
                  ?>
                  </td>
                  <td align="center" class="bline"><?php echo $rss['isok']==1 ? '已启用' : '未启用';?></td>
                  <td align="center" class="bline"><a href="banner_edit.php?id=<?php echo $rss['id']; ?>">编辑</a></td>
              </tr>					
              
              <?php
              }
          ?>
          <tr bgcolor="#ffffff">
                <td height="40" colspan="5" align="left">
                <div style="padding-left:10px;"><input type="button" value="全选" class="btbg" onClick="selectBox('all')"/> 
  <input type="button" value="反选" onClick="selectBox('reverse')"/> 
  <input type="submit" name="btnSave" value="删除"/></div>
                </td>
           </tr>
           <tr bgcolor="#ffffff">
                <td height="30" colspan="5" align="center"><?php if($count >0){ echo $key;}else{echo "暂无内容";}?></td>
           </tr>
    </table>
    </form>
  </DIV>
</DIV>
</body>
</html>