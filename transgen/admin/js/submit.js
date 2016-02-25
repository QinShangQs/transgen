/**************************************ajax提交form下的所有表单***********************************************/
var UCan = {
    Url: location.href,
    ajaxForm: function () { },
    getAjaxAjax: function () { },
    ajaxStart: function () { },
    ajaxEnd: function () { },
    ajaxLoadShow: function () { return false; },
    alert: function () { },
    confirm: function () { },
    getFormjson: function () { },
    listPage: function () { },
    addPage: function () { }
};
UCan.ajaxStart = function (parent) {
    if ($(parent).find('._ajax_loading').length > 0) { return; }
    $('html,body').css({height:'100%',width:'100%'}); //height:100%;width:100%;
    $(parent).append('<div class="_ajax_loading"><div class="_loading_div"><img src="/app_js/loading3.gif"/><span>数据加载中请稍候...</span></div></div>');
    $(parent).css("position", "relative");
    var div = $(parent).children('._ajax_loading');
    var img = div.children("._loading_div");
    div.height($(parent).innerHeight());
    div.width($(parent).innerWidth());
    var mtop = ($(parent).innerHeight() / 2 - parseInt((img.innerHeight() / 1.5)));
    img.css("margin-top", mtop + "px"); var s = "ss";
    $(window).resize(function () {
        var div = $(parent).children('._ajax_loading');
        var img = div.children("._loading_div");
        div.height($(parent).innerHeight());
        div.width($(parent).innerWidth());
        var mtop = ($(parent).innerHeight() / 2 - parseInt((img.innerHeight() / 1.5)));
        img.css("margin-top", mtop + "px");
    });
}
UCan.ajaxLoadShow =function(parent)
{
    if ($(parent).find('._ajax_loading').length > 0) { return true; }
	else return false;
}
UCan.ajaxEnd = function(parent) {
    $(parent).find('._ajax_loading').remove();
}
UCan.ajaxForm= function(form,startFunc,endFunc)
{
	var options ={};
	var url = $("#"+form).attr("action");
	if(!url || url ==''){UCan.alert('服务器忙！请稍候重试',function(){});}	
	$("#"+form).find("input,textarea").each(function(){
		options[$(this).attr("name")] = $(this).val();
	});
}
UCan.alert = function(msg,func)
{
	Boxy.alert(msg,func, {title: "提示信息"});return false;
}
UCan.confirm = function(msg,func)
{
	Boxy.confirm(msg, func, {title: "提示信息"});return false;
}
UCan.listPage = function () {
    var ajax_new_page = function (obj) {
        var url = $(obj).attr("href");
        return load_page(url);
        return false;
    }
    var load_page = function (url) {
        if (!url || url == "") { return true; }
        if (UCan.ajaxLoadShow(".ajax_box") == false) {
            $(".ajax_data_list").hide();
            UCan.ajaxStart(".ajax_box");
        }
        $.get(url, {"_n":new Date().getTime()}, function (data) {
            var container = $(".ajax_box", data).eq(0);
            if (0 == container.length) {
                container = $(data).filter(".ajax_box").eq(0);
            }
            $(".ajax_box").html($(container).html());
            UCan.Url = url;
            $(".arTabBox tr:gt(0):odd").css("background", "#F1F1F1");
            $(".arPage a").click(function () {
                return ajax_new_page(this);
            });
            //初始化 审核事件
			$(".submit_list .submit_check").each(function(){
				var _event;
				_event =("_event=function(){"+$(this).attr("onclick")+"}");
				eval("("+_event+")");
				$(this).removeAttr("onclick");
				$(this).click(function(){
					if(_event()){
						return checkEvent(this);
					}
					else return false;
				});
			});
			//初始化预览
    $("a.reading_glass").fancybox({
        'titleShow': false,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic'
    });
	_sort();
	$("#form1").attr("action", UCan.Url);
            UCan.ajaxEnd(".ajax_box"); return false;
        });
        return false;
    }
    var search = function () {
        var query = "";
        //文本
        var texts = $("#searchBox [type=text]");
        for (var i = 0; i < texts.length; i++) {
            var _id = $(texts[i]).attr("ID");
            var _text = $.trim($(texts[i]).val());
            if (_text != "") {
                if (query != "") {
                    query += "&";
                }
                query += _id + "=" + escape(_text);
            }
        }
        //隐藏文本
        var hids = $("#searchBox [type=hidden]");
        for (var i = 0; i < hids.length; i++) {
            var _id = $(hids[i]).attr("ID");
            var _text = $.trim($(hids[i]).val());
            if (_text != "") {
                if (query != "") {
                    query += "&";
                }
                query += _id + "=" + escape(_text);
            }
        }
        //下拉列表
        var selects = $("#searchBox select")
        for (var i = 0; i < selects.length; i++) {
            var _id = $(selects[i]).attr("ID");
            var _text = $.trim($(selects[i]).val());
            if (_text != "") {
                if (query != "") {
                    query += "&";
                }
                query += _id + "=" + escape(_text);
            }
        }
        return (location.pathname + "?" + query);
    }

    var checkEvent = function (obj) {
        var url = location.pathname;
        var parms = { "action": "check", "check": $(obj).attr("id"), "checkids": "" };
        if (!parms.check || parms.check == "") { return false; }
        $("#tb_list [name=checkboxs]:checked'").each(function () {
            parms.checkids += ($(this).val() + ",");
        });
        parms.checkids = parms.checkids.replace(/[,]$/, "");
        if (parms.checkids == "") return false;
        UCan.ajaxStart(".ajax_box");
        $.ajax({ type: "post", url: url, data: parms, cache: false,
            success: function (_data) {
                if (_data == "200") {
                    load_page(UCan.Url); return true;
                }
                else if (_data == "100") {
                    UCan.ajaxEnd(".ajax_box");
                    UCan.alert("更新失败"); return false;
                }
                UCan.ajaxEnd(".ajax_box");
                return false;
            }
        });
        return false;
    }
    $(function () {
        //初始化分页事件
        $(".arTabBox tr:gt(0):odd").css("background", "#F1F1F1");
        $(".arPage a").click(function () {
            return ajax_new_page(this);
        });
        //初始化查询事件
		$(".search_select_list").unbind("change");
		$(".search_select_list").removeAttr('onchange');
		$(".search_select_list").change(function () {
			return load_page(search());
		});
		$("#search_list").unbind("click");
		$("#search_list").removeAttr('onclick');		
		$("#search_list").click(function () {
			return load_page(search());
		});
        //初始化 审核事件
 		$(".submit_list .submit_check").each(function(){
			var _event;
			_event =("_event=function(){"+$(this).attr("onclick")+"}");
			eval("("+_event+")");
			$(this).removeAttr("onclick");
			$(this).click(function(){
				if(_event()){
					return checkEvent(this);
				}
				else return false;
			});
		});
    });
}
UCan.addPage = function () {

}
function _sort() {
    $("#tb_list .list_sort_up").click(function () {
        var onthis = $(this).parent().parent();
        var onup = $(this).parent().parent().prev();
        if(onup.attr("class") =="ajax_data_list"){
            $(onup).before(onthis);
            $(".arTabBox tr").css("background", "#fff");
            $(".arTabBox tr:gt(0):odd").css("background", "#F1F1F1");
            $(onthis).css("background", "#FFF68F");
		}
    });
	$("#tb_list .list_sort_down").click(function () {
        var onthis = $(this).parent().parent();
        var getdown = $(this).parent().parent().next();
        if(getdown.attr("class") =="ajax_data_list"){
            $(getdown).after(onthis);
            $(".arTabBox tr").css("background", "#fff");
            $(".arTabBox tr:gt(0):odd").css("background", "#F1F1F1");
            $(onthis).css("background", "#FFF68F");
		}
    });    
}
$(function(){
	_sort();
})
