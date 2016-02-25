<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php
//这里上传 $upsize判断上传文件的大小
    $uppath = isset($_REQUEST["upPath"]) ? $_REQUEST["upPath"] : "/attached/";              //文件上传路径
    $formName = isset($_REQUEST["formName"]) ? $_REQUEST["formName"] : $_REQUEST["formName"];          //回传到上页面编辑框所在Form的Name
    $editName = isset($_REQUEST["editName"]) ? $_REQUEST["editName"] : $_REQUEST["editName"];              //回传到上页面编辑框的Name
//转换根目录的路径
    if (strpos($uppath, "/") == 0) {
        $i = 0;
        $thpath = $_SERVER["SCRIPT_NAME"];
        $thpath = substr($thpath, 1, strlen($thpath));
        while (strripos($thpath, "/") !== false) {
            $thpath = substr($thpath, strpos($thpath, "/") + 1, strlen($thpath));
            $i = ++$i;
        }

        $pp = "";
        for ($j = 0; $j < $i; ++$j) {
            $pp .="../";
        }

        $uppaths = $pp . substr($uppath, 1, strlen($thpath));
    }
    $filename = date("y-m");
    if (is_dir($uppaths . $filename) != TRUE)
        mkdir($uppaths . $filename, 0777);
// if(is_dir($filename."/".$ctime)!=TRUE) mkdir($filename."/".$ctime,0777);

    $f = $_FILES['file1'];
	
    if ($f["type"] != "image/gif" && $f["type"] != "image/pjpeg" && $f["type"] != "image/jpeg" && $f["type"] != "image/x-png" && $f["type"] != "image/png"){
        echo "<script>alert('只能上传图片格式的文件');window.close()</script>";
        //echo $f['type'];
        return false;
    }

//获得文件扩展名
    $temp_arr = explode(".", $f["name"]);
    $file_ext = array_pop($temp_arr);
    $file_ext = trim($file_ext);
    $file_ext = strtolower($file_ext);

//新文件名
    $new_file_name = date("YmdHis") . '.' . $file_ext;

    $dest = $uppaths . $filename . "/" . $new_file_name; //设置文件名为日期加上文件名避免重复 上传目录
    $dest1 = $uppath . $filename . "/" . $new_file_name; //设置文件名为日期加上文件名避免重复
    $r = move_uploaded_file($f['tmp_name'], $dest);
    if ($f['size'] > 0) {

        echo "<script>window.opener.document." . $formName . "." . $editName . ".value='" . $dest1 . "'</script>";
        echo "<script>alert('图片上传成功');window.close()</script>";
    }
    ?>
</html>
