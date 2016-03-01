<?php
    require 'config.inc.php';
    header('Content-Type: text/html; charset=utf-8');
    $name = $_GET['name'];
    
    if(isset($_COOKIE['dingdanhao'])){
        $dingdanhao = $_COOKIE['dingdanhao'];
    }else{
        $dingdanhao = setcookie("dingdanhao",time(),time()+86400);
    }
    
    $sqlsel = mysql_query("select id,name,price from `".$dbpre."product` where name='".$name."'",$conn);    
    $count = mysql_num_rows($sqlsel);
    $rs = mysql_fetch_array($sqlsel);

    if($count>0){

        $sqlpd = mysql_query("select sp_id from `".$dbpre."cartemp` where sp_id='".$rs['id']."' and dingdanhao='".$dingdanhao."' and flag=0",$conn);    
        $countc = mysql_num_rows($sqlpd);

        if($countc==0){

            $sql = "insert into `".$dbpre."cartemp` (sp_id,suliang,price,dingdanhao) values ('".$rs['id']."',1,'".$rs['price']."','".$dingdanhao."')";
            mysql_query($sql,$conn);
            $getid = mysql_insert_id();
            echo json_encode(array('id'=>$getid,'price'=>$rs['price']));//正常查询

        }else if(isset($countc)>0){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }else{
        echo json_encode(0); 
    }
?>
