<?php
    @session_start();
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
	//header('Content-Type: text/html; charset=utf-8');
    $mydbhost = "localhost"; //配置主机
    $mydbuser = "root"; //数据库用户
    //$mydbpw = "Aa123456!@#QWE"; //数据库密码
    $mydbpw = "root"; 
    $mydbname = "qsj"; //数据库名
    $dbpre = "cn_"; //数据库表前缀
    $conn = mysql_connect($mydbhost, $mydbuser, $mydbpw) or die("服务器连接错误" . mysql_error());
    mysql_select_db($mydbname, $conn);
    mysql_query("SET NAMES 'utf8'");
    date_default_timezone_set('PRC');
	
    $weburl = "http://www.transgen.com.cn/";
	
	/**
	邮箱配置
	*/
	$mailhost = "smtp.163.com"; //SMTP服务器
	$mailuserbjhr = "transgen_hr@163.com"; //SMTP用户名
	$mailuserorder = "transgen_order@163.com";//SMTP用户名
	$mailpass = "transgen0321"; //SMTP密码
	$mailbjhr = "bjhr@transgen.com.cn";
	$mailuserproduct = "order@transgen.com.cn";
	
	
    //php 批量过滤post,get敏感数据
    if (get_magic_quotes_gpc()) {
        $_GET = stripslashes_array($_GET);
        $_POST = stripslashes_array($_POST);
    }
    function stripslashes_array(&$array) {
        while (list($key, $var) = each($array)) {
            if ($key != 'argc' && $key != 'argv' && (strtoupper($key) != $key || '' . intval($key) == "$key")) {
                if (is_string($var)) {
                    $array[$key] = stripslashes($var);
                }
                if (is_array($var)) {
                    $array[$key] = stripslashes_array($var);
                }
            }
        }
        return $array;
    }
    //--------------------------
    // 替换HTML尾标签,为过滤服务
    //--------------------------
    function lib_replace_end_tag($str) {
        if (empty($str)) return false;
        $str = htmlspecialchars($str);
        $str = str_replace('/', "", $str);
        $str = str_replace("\\", "", $str);
        $str = str_replace("&gt", "", $str);
        $str = str_replace("&lt", "", $str);
        $str = str_replace("<SCRIPT>", "", $str);
        $str = str_replace("</SCRIPT>", "", $str);
        $str = str_replace("<script>", "", $str);
        $str = str_replace("</script>", "", $str);
        $str = str_replace("select", "select", $str);
        $str = str_replace("join", "join", $str);
        $str = str_replace("union", "union", $str);
        $str = str_replace("where", "where", $str);
        $str = str_replace("insert", "insert", $str);
        $str = str_replace("delete", "delete", $str);
        $str = str_replace("update", "update", $str);
        $str = str_replace("like", "like", $str);
        $str = str_replace("drop", "drop", $str);
        $str = str_replace("create", "create", $str);
        $str = str_replace("modify", "modify", $str);
        $str = str_replace("rename", "rename", $str);
        $str = str_replace("alter", "alter", $str);
        $str = str_replace("cas", "cast", $str);
        $str = str_replace("&", "&", $str);
        $str = str_replace(">", ">", $str);
        $str = str_replace("<", "<", $str);
        $str = str_replace(" ", chr(32) , $str);
        $str = str_replace(" ", chr(9) , $str);
        $str = str_replace("    ", chr(9) , $str);
        $str = str_replace("&", chr(34) , $str);
        $str = str_replace("'", chr(39) , $str);
        $str = str_replace("<br />", chr(13) , $str);
        $str = str_replace("''", "'", $str);
        $str = str_replace("css", "'", $str);
        $str = str_replace("CSS", "'", $str);
        return $str;
    }
    //三元运算
    function getParam($param, $type, $default = '') {
        switch ($type) {
            case 'POST':
                $result = lib_replace_end_tag(trim($_POST[$param]));
                break;

            case 'GET':
                $result = lib_replace_end_tag(trim($_GET[$param]));
                break;

            default:
                $result = lib_replace_end_tag(trim($_POST[$param] ? $_POST[$param] : $_GET[$param]));
                break;
        }
        $result = $result == '' ? $default : $result;
        return $result;
    }
?>
