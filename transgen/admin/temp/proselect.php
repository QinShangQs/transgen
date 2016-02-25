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
<select id="cat" name="cat">  
    <?php   
        foreach($fid as $k=>$v){  
        ?>  
        <option value='<?php echo $v['id']?>'><?php echo $v['name']?></option>  
        <?php   
        }  
    ?>  
</select>
<?php
}else{
?>
<span>没有此产品&nbsp;&nbsp;&nbsp;</span>
<?php }?>