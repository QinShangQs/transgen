<?php
require 'config.inc.php';
$sqlseo = mysql_query("select * from `" . $dbpre . "seo` where id=5", $conn);
$rsseo = mysql_fetch_array($sqlseo);
$uname = $_SESSION['username'];
$action = $_GET['action'];
switch ($action) {
    //添加记录
    case"del";
        $did = getParam('did', 'GET');

        $sql = "delete from `" . $dbpre . "cartemp` where id='" . $did . "'";
        mysql_query($sql, $conn);
        echo "<script>location.href='shop.html'</script>";
        break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $rsseo['title']; ?></title>
<meta name="keywords" content="<?php echo $rsseo['keywords']; ?>"/>
<meta name="description" content="<?php echo $rsseo['description']; ?>"/>
<base href="<?php echo $weburl; ?>"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
    <?php require 'head.php';?>   
    <div class="wid980 mAuto">  
        <div class="dN"><img src="images/ding.jpg" width="980" height="150"/></div>
        <div id="textList" class="clearfix" style="padding-bottom:28px;">
            <div class="left widt220">
                <div class="join_title">
                    <h1 class="tC f24">ORDERING</h1>

                    <h2 class="tC f24 fM">订购中心</h2>
                </div>
                <ul class="join_list">
                    <?php
                    $sqlcat = mysql_query("select id,catname from `" . $dbpre . "product_cat` order by px desc", $conn);
                    while ($rscat = mysql_fetch_array($sqlcat)) {
                        ?>
                        <li style="width: 100%" onclick="return playFLVA2('<?php echo $rscat['id'];?>')"><?php echo $rscat['catname']; ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="right wid720">
                <div class="clearfix comTitle">
                    <div class="left f18 fM">订购中心</div>
                    <div class="right"><a href="http://www.transgen.com.cn" rel="nofollow">首页</a> > <span>订购中心</span></div>
                </div>
                <div>
                    <div class="f16 fM hot">购物车</div>
                    <ul class="goList" style="border:none;">
                        <li class="clearfix specials">
                            <a class="left one1">目录号</a>
                            <a class="left two2">产品名称</a>
                            <a class="left three3">规 格</a>
                            <a class="left four4">单 价</a>
                            <a class="left five5">数 量</a>
                            <a class="left six6">相关操作</a>
                        </li>
                        <?php
                        $sun_jiage = 0;
                        $sql = mysql_query("select * from `" . $dbpre . "cartemp` where dingdanhao='" . $_COOKIE['dingdanhao'] . "' and flag=0 order by id desc", $conn);
                        while ($rscp = mysql_fetch_array($sql)) {
                            $sqlpro = mysql_query("select * from `" . $dbpre . "product` where id='" . $rscp['sp_id'] . "'", $conn);
                            $rspro = mysql_fetch_array($sqlpro);

                            $sun_jiage2 = ($rscp['suliang']) * ($rspro['price']);
                            $sun_jiage = $sun_jiage2 + $sun_jiage;
                            ?>
                            <li class="clearfix bai">
                                <a class="left one1 wid250"><?php echo $rspro['name']; ?></a>
                                <a class="left two2"
                                   title="<?php echo $rspro['name_pro']; ?>"><?php echo mb_strcut($rspro['name_pro'], 0, 15, 'utf8'); ?></a>
                                <a class="left three3"><?php echo $rspro['guige']; ?></a>
                                <a class="left four4"><span><?php echo $rspro['price']; ?></span>元</a>

                                <div class="left five5">
                                    <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                    <a class="left jian" onclick="ImgClickChang(this,0)"></a>
                                    <a class="left num"><span><?php echo $rscp['suliang']; ?></span></a>
                                    <a class="left jia" onclick="ImgClickChang(this,1)"></a></div>
                                <a class="left six77" onclick="delproduct(this);">删除商品</a></li>
                            <!--href="shop.php?action=del&did=<?php //echo $rscp['id'];?>"-->
                        <?php
                        }
                        ?>
                    </ul>
                    
                    <div class="clearfix" style="border-bottom:1px solid #ccc;padding-bottom:12px;">
                    	<?php
                        if($_SESSION['username']){
						?>
                    	<a class="right r1" style="margin-right:20px;" href="javascript:playFLVA1()"></a>
                        <?php
						}else{
						?>
                        <a class="right r1" style="margin-right:20px;" href="javascript:playFLVA1()"></a>
                        <?php
						}
						?>
                    </div>
                    
                    <div class="please">
                    	<span class="f16 fM">快速订购</span>
                        <a>( 请输入待订购产品的准确目录号、数量，即可快速完成简单订购。)</a>
                    </div>
                    <ul class="goList goList2">
                        <li class="clearfix specials"><a class="left one1 wid250">产品目录号</a> 
                         <a class="left three3">单 价</a> <a class="left four4 wid150">数 量</a> <a class="left five5">小 计</a>
                        </li>

                        <li class="clearfix hui"><a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value=''/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>

                        <li class="clearfix hui"><a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>

                        <li class="clearfix hui"><a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>

                        <li class="clearfix hui"><a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>

                        <li class="clearfix hui"><a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>

                        <li class="clearfix hui" id="shang">
                            <a class="left one1 wid250">
                                <input class="left" type="text" onblur="getquestion(this);"/>
                            </a> <a class="left two2 dN">
                                <input class="left" type="text"/>
                            </a> <a class="left three3"><span>0</span>元</a>

                            <div class="left five5 wid150">
                                <input type="hidden" value='<?php echo $rscp['id']; ?>'/>
                                <a class="left jian" onclick="KsClickChang(this,0)"></a>
                                <a class="left num"><span>1</span></a>
                                <a class="left jia" onclick="KsClickChang(this,1)"></a>
                            </div>
                            <a class="left textI"><span>0</span>元</a></li>


                        <li class="clearfix tiJ" style="overflow:inherit;  padding-top:10px">
                            <a class="left l1" onclick="fuzhi(this);"></a>
                            <?php
							if($_SESSION['username']){
							?>
							<a class="right r1" style="margin-right:20px;" href="javascript:playFLVA1()"></a>
							<?php
							}else{
							?>
							<a class="right r1" style="margin-right:20px;" href="javascript:playFLVA1()"></a>
							<?php
							}
							?>
                            <a class="right r2 f18 fM" href="#">总计：<span
                                    id="SpanSumPrice"><?php echo $sun_jiage; ?></span>元</a>
                        </li>

                    </ul>
                    <div class="f16 fM hot">热销产品</div>
                    <ul class="goList">
                        <li class="clearfix specials">
                            <a class="left one1">目录号</a>
                            <a class="left two2">产品名称</a>
                            <a class="left three3">规 格</a>
                            <a class="left four4">单 价</a>
                            <a class="left five5 five5-1">数 量</a>
                            <a class="left six6">加入购物车</a>
                        </li>
                        <?php
                        $i = 0;
                        $sqlhot = mysql_query("select id,name,name_pro,guige,price,hot,sid from `" . $dbpre . "product` where hot=1 and sid!=0 order by id desc limit 0,10", $conn);
                        while ($rshot = mysql_fetch_array($sqlhot)) {
                            $i++;
                            ?>
                            <li class="clearfix <?php if ($i % 2) {
                                echo "hui";
                            } ?>">
                                <a class="left one1"><?php echo $rshot['name']; ?></a>
                                <a class="left two2"
                                   title="<?php echo $rshot['name_pro']; ?>"><?php echo mb_strcut($rshot['name_pro'], 0, 15, 'utf8'); ?></a>
                                <a class="left three3"><?php echo $rshot['guige']; ?></a>
                                <a class="left four4"><span><?php echo $rshot['price']; ?></span>元</a>

                                <div class="left five5 five5-1">
                                    <input type="hidden" value='<?php echo $rshot['id']; ?>'/>
                                    <a class="left jian" onclick="HotClickChang(this,0)"></a>
                                    <a class="left num"><span>1</span></a>
                                    <a class="left jia" onclick="HotClickChang(this,1)"></a>
                                </div>
                                <a class="left six66" onclick="addshop(this)">加入购物车</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="fan fM f14 tC"><a href="products.html">返回</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.nav li').eq(2).addClass('se1');
    });
</script>
<script type="text/javascript">
	
	//已经登录了，提交订单
    function oklogin() {
		var zjiage = $("#SpanSumPrice").html();

        if (zjiage < 1) {
            alert("购物车没有产品，请先选购产品在提交订单！");
            return;
        }
		var uname = $("#uname").html();
		$.post("save2.php", { Action: "post", username: uname },
            function (_obj) {
                var result = _obj;
                if (result == null || result == "") {
                    alert('程序出错!');
                    return false;
                }
                result = result.split("|");
                if (result[0] == "1") {
                    alert('订单提交成功，我们会尽快联系您');
                    window.location.reload();
                } else {
                    alert('订单提交失败，请重新提交试试');
                }
            });
    }


    function playFLVA1() {

        var zjiage = $("#SpanSumPrice").html();

        if (zjiage < 1) {
            alert("购物车没有产品，请先选购产品在提交订单！");
            return;
        }

        _set_interface();
        $('#jquery-lightbox').append("<iframe height=465 width=760 style='*height:500px;*width:743px;' src=\"reg.php?type=1\" frameborder=0 allowfullscreen></iframe>");
        $(window).scrollTop() = 0;
    }
    ;

    function playFLVA2(id) {

        _set_interface();
        var info = "<iframe height=740 width=1000 src='detail.php?id="+ id +"' frameborder=0 allowfullscreen></iframe>";
        $('#jquery-lightbox').append(info);
        $(window).scrollTop() = 0;
    }
    ;

    function hide() {
        $('#jquery-lightbox').remove();
        $('#jquery-overlay').fadeOut(function () {
            $('#jquery-overlay').remove();
        });
    }

</script>


<script type="text/javascript">

    //购物车修改数量，价格计算
    function ImgClickChang(e, type) {

        var num = $(e).parent().find("span").html();
        var price = $(e).parent().next().find("span").html();

        num = parseInt(num);
        price = parseFloat(price);
        if (type == "1") {
            num = num + 1;
        }
        if (type == "0") {
            num = num - 1;
        }
        if (num <= 0) {
            num = 1;
        }
        var sum = num * price;

        $(e).parent().next().next().find("span").html(sum);
        $(e).parent().find("span").html(num);

        var did = $(e).parent().find("input:hidden").val();

        //修改数据库信息
        $.post("update_shop.php", { Action: "post", did: did, nnum: num },
            function (_obj) {
                var result = _obj;

                if (result == null || result == "") {
                    alert('程序出错!');
                    return false;
                }
                result = result.split("|");
                if (result[0] == "-1") {
                    alert(result[1]);
                    return false;
                }
                $("#SpanSumPrice").html(result[1]);
            });
    }


    //提交判断目录号
    function getquestion(obj) {
        $.getJSON("qu.php?name=" + $(obj).val(), function (result) {

            if (result == 0) {
                return false;
            } else if (result == 1) {
                alert("购物车已存在此产品，请修改数量");
                return false;
            } else {
                var zjiage = $("#SpanSumPrice").html();
                var zjiage = parseFloat(zjiage);
                var price = parseFloat(result.price);
                var zongjiage = zjiage + price;

                $(obj).parent().next().next().next().find("input:hidden").val(result.id);
                $(obj).parent().next().next().find("span").html(result.price);
                $(obj).parent().next().next().next().next().find("span").html(result.price);
                $("#SpanSumPrice").html(zongjiage);
            }
        });
    }

    //修改快速数量
    function KsClickChang(e, type) {
        var num = $(e).parent().find("span").html();
        var price = $(e).parent().prev().find("span").html();
        var zjiage = $("#SpanSumPrice").html();

        num = parseFloat(num);
        price = parseFloat(price);
        zjiage = parseFloat(zjiage);

        if (type == "1") {
            num = num + 1;
            var zongjiage = zjiage + price;
        }
        if (type == "0") {
            num = num - 1;
            var zongjiage = zjiage - price;
        }
        if (num <= 0) {
            num = 1;
            var zongjiage = zjiage;
        }
        var sum = num * price;
        $(e).parent().find("span").html(num);
        $(e).parent().next().find("span").html(sum);
        $("#SpanSumPrice").html(zongjiage);

        var did = $(e).parent().find("input:hidden").val();

        //修改数据数量
        $.post("update_shop.php", { Action: "post", did: did, nnum: num },
            function (_obj) {
                var result = _obj;

                if (result == null || result == "") {
                    alert('程序出错!');
                    return false;
                }
                result = result.split("|");
                if (result[0] == "-1") {
                    alert(result[1]);
                    return false;
                }
                $("#SpanSumPrice").html(zongjiage);
            });
    }


    //复制一份内容
    function fuzhi(obj) {
        $(".tiJ").css("{padding:10px 0 0 0;}");
        $("#shang").before("<li class='clearfix hui'><a class='left one1 wid250'><input class='she left' type=text onblur=getquestion(this); /></a> <a class=\"left two2 dN\"><input class=\"left\" type=\"text\" /></a> <a class=\"left three3\"><span>0</span>元</a><div class=\"left five5 wid150\"><input type=\"hidden\" value=\"<?php echo $rscp['id'];?>\" /><a class=\"left jian\" onclick=\"KsClickChang(this,0)\"></a><a class=\"left num\"><span>1</span></a><a class=\"left jia\" onclick=\"KsClickChang(this,1)\"></a></div><a class=\"left textI\"><span>0</span>元</a></li>");
    }

    //删除商品
    function delproduct(e) {

        var did = $(e).parent().find("input:hidden").val();
        var num = $(e).prev().find("span").html();
        var price = $(e).parent().find("span").html();

        num = parseFloat(num);
        price = parseFloat(price);
        var delprice = num * price;

        $.post("del_shop.php", { Action: "post", did: did },
            function (_obj) {
                var result = _obj;

                if (result == null || result == "") {
                    alert('程序出错!');
                    return false;
                }
                result = result.split("|");
                if (result[0] == "-1") {
                    alert(result[1]);
                    return false;
                }

                var zjiage = $("#SpanSumPrice").html();
                var zjiage = parseFloat(zjiage);
                var price = parseFloat(result.price);
                var zongjiage = zjiage - delprice;
                $("#SpanSumPrice").html(zongjiage);
                $(e).parent().remove();
            });
    }


    //热销产品 加入购物车
    function addshop(e, num) {
        var num = $(e).prev().find("span").html();
        var did = $(e).parent().find("input:hidden").val();
        var price = $(e).parent().find("span").html();

        //修改数据库信息
        $.post("add_shop.php", { Action: "post", did: did, nnum: num, price: price },
            function (_obj) {
                var result = _obj;

                if (result == null || result == "") {
                    alert('程序出错!');
                    return false;
                }
                result = result.split("|");
                if (result[0] == "1") {
                    alert('已加入购物车');
                    window.location.reload();
                } else {
                    alert('加入失败');
                }
            });
    }

    //修改热销产品数量
    function HotClickChang(e, type) {
        var num = $(e).parent().find("span").html();
        var did = $(e).parent().find("input:hidden").val();
        num = parseInt(num);
        if (type == "1") {
            num = num + 1;
        }
        if (type == "0") {
            num = num - 1;
        }
        if (num <= 0) {
            num = 1;
        }
        $(e).parent().find("span").html(num);
    }
	
</script>
</body>
</html>
