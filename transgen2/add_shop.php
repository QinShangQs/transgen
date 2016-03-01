<?php
    require 'config.inc.php';
    header('Content-Type: text/html; charset=utf-8');
    $did = $_POST['did'];
    $nnum = $_POST['nnum'];
	$price = $_POST['price'];
	
	if(isset($_COOKIE['dingdanhao']) && $_COOKIE['dingdanhao']){
		$dingdanhao = $_COOKIE['dingdanhao'];
	}else{
		setcookie("dingdanhao",time(),time()+36000*24);
		$dingdanhao = time();
	}
    
	if($did>0){
		
		//查询有没有此产品
		$sqlsel = mysql_query("select * from `".$dbpre."cartemp` where sp_id='".$did."' and dingdanhao='".$dingdanhao."' and flag=0",$conn);
		$count = mysql_num_rows($sqlsel);
		
		if($count>0){
			$sql ="update `".$dbpre."cartemp` set suliang=suliang+'".$nnum."' where sp_id='".$did."' and dingdanhao='".$dingdanhao."' and flag=0";
		}else{
			$sql = "insert into `".$dbpre."cartemp` (sp_id,suliang,price,dingdanhao) values ('$did','$nnum','$price','".$dingdanhao."')";
		}
		mysql_query($sql, $conn);
		echo "1|1";
	}else{
		echo "0|0";	
	}
	?>
