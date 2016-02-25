<?php
    require 'config.inc.php';
    header('Content-Type: text/html; charset=utf-8');
    $did = $_POST['did'];
    $nnum = $_POST['nnum'];
	
	if($did>0){
		$sql = "update `".$dbpre."cartemp` set suliang=$nnum where id='".$did."' and dingdanhao='".$_COOKIE['dingdanhao']."' and flag=0";
        mysql_query($sql, $conn);
	}else{
		echo "0|0";
	}
	
	$sun_jiage = 0;
	$sqlc = mysql_query("select id,suliang,price,dingdanhao from `".$dbpre."cartemp` where dingdanhao='".$_COOKIE['dingdanhao']."'",$conn);
	while ($c_rs = mysql_fetch_array($sqlc)) {
		
		$sun_jiage2 = ($c_rs['suliang']) * ($c_rs['price']);
		$sun_jiage = $sun_jiage2 + $sun_jiage;
	}
    echo "1|".$sun_jiage;
?>
