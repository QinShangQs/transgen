<?php
$key=isset($_GET['key'])?trim($_GET['key']):'';
$fl=isset($_GET['fl'])?trim($_GET['fl']):'0';
$page=isset($_GET['page'])?trim($_GET['page']):'1';
$searchurl=$_SERVER['HTTP_HOST']."/search/".$key."_".$fl."_".$page.".".html;
header('Location:http://'.$searchurl);
?>