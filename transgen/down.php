 <?php     
require 'config.inc.php';
$dingdanhao = trim($_POST['dingdanhao']);
$sql = "select * from `".$dbpre."jishu` where dingdanhao='" . $dingdanhao . "'";
$query = mysql_query($sql, $conn);
$rs = mysql_fetch_array($query);  
header("Content-Type:   application/msword");       
header("Content-Disposition:   attachment;   filename=全式金生物实验技术委托服务进度查询结果.doc"); //指定文件名称  
header("Pragma:   no-cache");
header("Expires:   0");
$html  ="全式金生物";

$html .="实验技术委托项目名称：".$rs['shiyanname']."\n\n";

$html .="查询的订单号：".$rs['dingdanhao']."\n";

$html .="实验委托日期：".$rs['weituoriqi']."\n";
?>
<?php
						$cat=$rs['cat'];
						if($cat=1){
						$html .= "实验状态:正在进行\n";
						}else
						{
						$html .= "实验状态：已完成\n";
						};
?>
<?php
$html .= "客户姓名：".$rs['name']."\n联系电话：".$rs['mobile']."\n常用邮箱：".$rs['email']."\n单位：".$rs['danwei']."\n实验室或部门：".$rs['bumen']."\n地址：".$rs['dizhi']."\n邮编：".$rs['youbian']."\n实验员：".$rs['shiyanyuan']."\n业务员：".$rs['yewuyuan']."\n实验费用：".$rs['shiyanfeiyong']."\n";
$html .= "\n实验进度详情如下：\n\n";
?>
<?php 
						$a=1;
						while($a<=20){
							$b="syjd".$a;
							if(trim($rs[''.$b.''])<>NULL){
							$html .= "实验第".$a."阶段:\n    ".trim($rs[''.$b.''])."\n";
							};
							$a++;
						};
						if(trim($rs['beizhu'])<>NULL){
						$html .= "\n备注：\n\n    ".$rs['beizhu'];
                        }
						?>
<?php
					$html = mb_convert_encoding($html, "GBK", "UTF-8");
					echo  $html;
?>