<?php
    require '../config.inc.php';
    require 'checkadmin.php';
    header('Content-Type: text/html; charset=utf-8');

    $catname = getParam('catname', 'GET');
    $sql="select id,name,sid from `".$dbpre."product` where sid=0 and name like '%$catname%' order by id asc";
    $query=mysql_query($sql,$conn);
    $count = mysql_num_rows($query);  
    while($row=mysql_fetch_array($query)){  
        $fid[]=$row;  
    }  
?>

<?php
if($count>0){
?> 
<DIV class="Listbox">
  <DIV class="ListTit">产品名称搜索列表</DIV>
  <DIV class="ListfBox">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="4%" height="30" align="center" class="bline">ID</td>
		<td width="43%" align="left" class="bline">栏目名称</td>
		<td align="center" class="bline">更多规格管理</td>
		<td width="9%" align="center" class="bline">相关操作</td>
	</tr>
    <?php   
        foreach($fid as $k=>$v){  
        ?>  
	<tr bgcolor="#ffffff" onmouseover="this.style.background='#EEFAFF'; " onmouseout ="this.style.background='#ffffff'; this.style.bordercolor=''">
        <td height="30" align="center" class="bline">
			<label>
				<?php echo $v['id']?>
			</label>
		</td> 
		<td align="left" class="bline"><?php echo $v['name']; ?></td>

		<td width="17%" align="center" class="bline"><a target="_blank" href="product_more_list.php?sid=<?php echo $v['id'];?>">查看更多规格产品</a></td>
		<td align="center" class="bline"><a target="_blank" href="product_edit.php?id=<?php echo $v['id']; ?>">编辑</a></td>


	</tr>
        <?php   
        }  
    ?>  
</table>
</DIV>
<?php
}else{
?>
<?php }?>


