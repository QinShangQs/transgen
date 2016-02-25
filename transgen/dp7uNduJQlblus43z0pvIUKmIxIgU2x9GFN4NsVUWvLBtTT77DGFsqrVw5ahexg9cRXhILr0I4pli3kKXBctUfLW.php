<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=技术委托服务订单信息汇总表.xls "); 
	  $title="编号\t";
	  $title .="实验条目ID\t";
	  $title .="实验名称\t";
	  $title .="实验状态\t";
	  $title .="实验员\t";
	  $title .="实验费用\t";
	  $title .="业务员\t";
	  $title .="订单号\t";
	  $title .="委托日期\t";
	  $title .="客户姓名\t";
	  $title .="手机\t";
	  $title .="邮箱\t";
	  $title .="传真\t";
	  $title .="单位\t";
	  $title .="所在实验室或部门\t";
	  $title .="地址\t";
	  $title .="邮编\t";
	  $title = mb_convert_encoding($title, "GBK", "UTF-8");
	  echo $title."\n";
require 'config.inc.php';
$sql = "select * from `".$dbpre."jishu` where 1=1";
$query = mysql_query($sql, $conn);
$a=1;
while ($rs = mysql_fetch_array($query))
{
	$content = $a."\t".$rs['id']."\t".$rs['shiyanname']."\t";
	$sqlcat = mysql_query("select id,catname from `".$dbpre."catjishu` where id='".$rs['cat']."'",$conn);
				  $rowcat = mysql_fetch_array($sqlcat);
				  $catname=$rowcat['catname'];
	$content .=$catname."\t";
	$content .= $rs['shiyanyuan']."\t".$rs['shiyanfeiyong']."\t".$rs['yewuyuan']."\t".$rs['dingdanhao']."\t";
	$content .=$rs['weituoriqi']."\t".$rs['name']."\t".$rs['mobile']."\t".$rs['email']."\t".$rs['fax']."\t".$rs['danwei']."\t".$rs['bumen']."\t".$rs['dizhi']."\t".$rs['youbian'];
	$content = mb_convert_encoding($content, "GBK", "UTF-8");
	echo $content."\n";
     $a++;}; 
	 ?>
