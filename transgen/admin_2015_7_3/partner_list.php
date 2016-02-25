<?php
session_start();
require '../config.inc.php';
require 'power.php';//权限表
require 'checkadmin.php';
header('Content-Type: text/html; charset=utf-8');
if(!in_array('11',$quanxian)){
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
		
		$str="delete from `".$dbpre."partner` where id in ($id)";
		mysql_query($str);
		echo "<script>alert('删除成功！');window.location.href='partner_list.php?PB_page=$pg';</script>";
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
  <DIV class="ListTit">合作伙伴列表</DIV>
  <DIV class="ListfBox">
  <form id="form2" name="form2" method="post" action="?action=del">
<input type="hidden" id="pg" name="pg" value="<?php echo $_GET['PB_page'];?>" />   
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
              <td width="4%" height="30" align="center" class="bline">ID</td>
              <td width="6%" align="left" class="bline">&nbsp;</td>
              <td width="17%" align="left" class="bline">信息名称</td>
              <td width="49%" align="center" class="bline">链接地址</td>
              <td width="14%" align="center" class="bline">发布时间</td>
              <td width="10%" align="center" class="bline">相关操作</td>
          </tr>
          <?php
			$cat = $_GET['cat'];
			$Page_size =12;		
			$sqld = "SELECT id FROM `".$dbpre."partner` where 1=1";
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
			$sqlzt = "select id,name,weburl,addtime from `".$dbpre."partner` where 1=1";
			if($cat){
				$sqlzt.= " and cat='".$cat."'";
			}
			$sqlzt.= " order by addtime desc limit $offset,$Page_size";
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
                  <td align="left" class="bline"><?php echo $rslist['name']; ?></td>
                  <td align="center" class="bline"><?php echo $rslist['weburl']; ?></td>
                  <td align="center" class="bline"><?php echo  date('Y-m-d H:i:s', $rslist['addtime']);?></td>
                  <td align="center" class="bline"><a href="partner_edit.php?id=<?php echo $rslist['id']; ?>">编辑</a></td>
              </tr>	
             <?php
			}
			$page_len = ($page_len % 2) ? $page_len : $pagelen + 1; //页码个数 
			$pageoffset = ($page_len - 1) / 2; //页码个数左右偏移量
			
			//判断URL地址参数
			$url = '';
			if($cat){
				$url .= "cat=".$cat."&";	
			}
		
			$key = "<div class=\"page\">";
			if($page!=1){ 
			 $key.="<a href=\"?".$url."page=1\">首页</a>";    //第一页 
			 $key.="<a href=\"?".$url."page=".($page-1)."\">上一页</a>";//上一页  
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
				$key .= "<a href=\"?".$url."page=" . $i . "\" class=\"curr\">" . $i . "</a>";
			}else{
				$key .= "<a href=\"?".$url."page=" . $i . "\">" . $i . "</a>";
			}
		
			}
			if($page!=$pages){ 
			 $key.="<a href=\"?".$url."page=".($page+1)."\">下一页</a>";//下一页 
			 $key.="<a href=\"?".$url."page={$pages}\">尾页</a>"; //最后一页 
			 }else { 
			 $key.="<a>下一页</a>";//下一页 
			 $key.="<a>尾页</a>"; //最后一页 
			 } 
			$key.="</div>"; 
			?>
            <tr bgcolor="#ffffff">
                <td height="40" colspan="6" align="left">
                <div style="padding-left:10px;"><input type="button" value="全选" class="btbg" onClick="selectBox('all')"/> 
  <input type="button" value="反选" onClick="selectBox('reverse')"/> 
  <input type="submit" name="btnSave" value="删除"/></div>
                </td>
           </tr>
           <tr bgcolor="#ffffff">
                <td height="30" colspan="6" align="center"><?php if($count >0){ echo $key;}else{echo "暂无内容";}?></td>
           </tr>	
    </table>
    </form>
  </DIV>
</DIV>
</body>
</html>