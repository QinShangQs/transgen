<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('48',$quanxian)){
    echo "<script language='javascript'>alert('权限不足!');location.href='Default.php';</script>";
    exit;
}

$action=$_GET['action'];
$keys=trim($_GET['keys']);
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
		
		$str="delete from `".$dbpre."jishu` where id in ($id)";
		mysql_query($str);
		echo "<script>alert('删除成功！');window.location.href='jishu_list.php?page=$pg';</script>";
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
	<div style="margin-top:10px;margin-bottom:10px;">
    	<form method="get" name="form3">
        	<b>信息筛选：</b><input type="text" name="keys" style="width:300px;" value="<?php echo trim($_GET['keys']) ?>"/>
 			<input type="submit" name="select" value="查询"/> &nbsp;&nbsp;<span style="color:#F30;font-size:12px;">除了“实验名称”、“委托日期”和“单位”为近似匹配，其它选项都为完全匹配。请知悉！</span>
        </form>
    </div>
  <DIV class="ListTit">实验技术管理</DIV>
  <DIV class="ListfBox">
  <form id="form2" name="form2" method="post" action="?action=del">
<input type="hidden" id="pg" name="pg" value="<?php echo $_GET['PB_page'];?>" />   
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td width="5%" colspan="2" height="30" align="center" class="bline">ID</td>
              <td width="20%" align="left" class="bline">实验名称</td>
              <td width="6%" align="center" class="bline">实验员</td>
              <td width="7%" align="center" class="bline">实验状态</td>
              <td width="11%" align="center" class="bline">实验费用</td>
              <td width="7%" align="center" class="bline">业务员</td>
              <td width="6%" align="center" class="bline">客户姓名</td>
              <td width="14%" align="center" class="bline">单位</td>
           	  <td width="12%" align="center" class="bline">订单编号</td>
              <td width="7%" align="center" class="bline">委托日期</td>
              <td width="5%" align="center" class="bline">相关操作</td>
          </tr>
          <?php
			$cat = $_GET['cat'];
			$Page_size =20;		
			$sqld = "SELECT * FROM `".$dbpre."jishu` where 1=1";
			if($cat){
				$sqld.= " and cat='".$cat."'";
			}
			$sqld .= " order by id desc";
			$resultd = mysql_query($sqld,$conn);	
			$count = mysql_num_rows($resultd);
			$page_count = ceil($count / $Page_size);
			
			$init = 1;
			$page_len = 5;
			$max_p = $page_count;
			$pages = $page_count;
			
			//判断当前页码 
			if (empty($_GET['page']) || $_GET['page'] < 0)
			{
				$page = 1;
			}
			else
			{
				$page = $_GET['page'];
			}
			$offset = $Page_size * ($page - 1);
			if($keys == "已完成"){
				$keys=1;
				$sqlzt = "SELECT * FROM `".$dbpre."jishu` WHERE cat='$keys' ORDER BY addtime DESC LIMIT $offset,$Page_size";
			 }else if($keys == "正在进行"){
				 $keys=2;
				 $sqlzt = "SELECT * FROM `".$dbpre."jishu` WHERE cat='$keys' ORDER BY addtime DESC LIMIT $offset,$Page_size";
				 }
			else {$sqlzt = "SELECT * FROM `".$dbpre."jishu` WHERE dingdanhao='$keys' OR shiyanyuan='$keys' OR yewuyuan='$keys' OR shiyanname like '%$keys%' OR name='$keys' OR danwei like '%$keys%' OR mobile='$keys' OR weituoriqi like '%$keys%' ORDER BY addtime DESC LIMIT $offset,$Page_size";}
			$queryzt = mysql_query($sqlzt, $conn);
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
                  <td align="left" class="bline"><?php echo $rslist['shiyanname']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['shiyanyuan']; ?></td>
                  <td align="center" class="bline">
                  <?php
                  $sqlcat = mysql_query("select id,catname from `".$dbpre."catjishu` where id='".$rslist['cat']."'",$conn);
				  $rowcat = mysql_fetch_array($sqlcat);
				  echo $rowcat['catname'];
				  ?>
                  </td>
                  <td align="center" class="bline"><?php echo $rslist['shiyanfeiyong']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['yewuyuan']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['name']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['danwei']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['dingdanhao']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['weituoriqi']; ?></td>
              <td align="center" class="bline"><a href="jishu_edit.php?id=<?php echo $rslist['id']; ?>">编辑</a></td>
              </tr>	
              <?php
			}
			$page_len = ($page_len % 2) ? $page_len : $page_len + 1; //页码个数 
			$pageoffset = ($page_len - 1) / 2; //页码个数左右偏移量
			
			//判断URL地址参数
			$url = '';
			if($cat){
				$url .= "cat=".$cat."&";	
			}
			if($pg){
				$url .= "page=".$pg."&";	
			}
		
			$key = "<div class=\"page\">";
			if($page!=1){ 
			 $key.="<a href=\"?".$url."page=1&keys=".trim($_GET['keys'])."\">首页</a>";    //第一页 
			 $key.="<a href=\"?".$url."page=".($page-1)."&keys=".trim($_GET['keys'])."\">上一页</a>";//上一页  
			}else { 
			 $key.="<a>首页</a>";//第一页 
			 $key.="<a>上一页</a>"; //上一页 
			} 
			if ($pages > $page_len)
			{
				//如果当前页小于等于左偏移 
				if ($page <= $pageoffset)
				{
					$init = 1;
					$max_p = $page_len;
				}
				else
				{ //如果当前页大于左偏移 
					//如果当前页码右偏移超出最大分页数 
					if ($page + $pageoffset >= $pages + 1)
					{
						$init = $pages - $page_len + 1;
					}
					else
					{
						//左右偏移都存在时的计算 
						$init = $page - $pageoffset;
						$max_p = $page + $pageoffset;
					}
				}
			}
			for ($i = $init; $i <= $max_p; $i++)
			{
			if ($i == $page){
				$key .= "<a href=\"?".$url."page=" . $i . "&keys=".trim($_GET['keys'])."\" class=\"curr\">" . $i . "</a>";
			}else{
				$key .= "<a href=\"?".$url."page=" . $i . "&keys=".trim($_GET['keys'])."\">" . $i . "</a>";
			}
		
			}
			if($page!=$pages){ 
			 $key.="<a href=\"?".$url."page=".($page+1)."&keys=".trim($_GET['keys'])."\">下一页</a>";//下一页 
			 $key.="<a href=\"?".$url."page={$pages}&keys=".trim($_GET['keys'])."\">尾页</a>"; //最后一页 
			 }else { 
			 $key.="<a>下一页</a>";//下一页 
			 $key.="<a>尾页</a>"; //最后一页 
			 } 
			$key.="</div>"; 
			?>
            <tr bgcolor="#ffffff">
                <td height="40" colspan="12" align="left">
                <div style="padding-left:10px;"><input type="button" value="全选" class="btbg" onClick="selectBox('all')"/> 
  <input type="button" value="反选" onClick="selectBox('reverse')"/> 
  <input type="submit" name="btnSave" value="删除"/>
  <a href="http://www.transgen.com.cn/dp7uNduJQlblus43z0pvIUKmIxIgU2x9GFN4NsVUWvLBtTT77DGFsqrVw5ahexg9cRXhILr0I4pli3kKXBctUfLW.php" target="_blank"><input type="button" value="导出数据库到EXCEL表格"/></a></div>

                </td>
           </tr>
           <tr bgcolor="#ffffff">
                <td height="30" colspan="12" align="center"><?php if($count >0){ echo $key;}else{echo "暂无内容";}?></td>
           </tr>
    </table>
    </form>
    
  </DIV>
  
  
</DIV>
</body>
</html>