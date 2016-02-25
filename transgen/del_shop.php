<?php
    require 'config.inc.php';
    header('Content-Type: text/html; charset=utf-8');
    $did = $_POST['did'];
    
    if($did>0){
        $sql = "delete from `".$dbpre."cartemp` where dingdanhao='".$_COOKIE['dingdanhao']."' and flag=0 and id='".$did."'";
        mysql_query($sql, $conn);
        echo "1|1";
    }else{
        echo "0|0";    
    }
    ?>
