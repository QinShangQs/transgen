<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>网站后台管理中心</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="css/common.css">
<LINK rel=stylesheet type=text/css href="css/default.css">
<SCRIPT type=text/javascript src="js/jquery-1.7.1.min.js"></SCRIPT>
<SCRIPT type=text/javascript>
jQuery(document).ready(function($) {
	$("#oclleft").toggle(function(){
			window.top.document.getElementById("lrframe").cols="0,*";
			this.title="打开左边管理导航菜单";
			$(this).text("打开左栏");
		},function(){
			window.top.document.getElementById("lrframe").cols="215,*";
			this.title="关闭左边管理导航菜单";
			$(this).text("关闭左栏");
			});
		//this.blur();
});
</SCRIPT>
</HEAD>
<BODY>
<UL class=arTop>
  <LI><A id=oclleft title=关闭左边管理导航菜单 href="javascript:void(0);">关闭左栏</A></LI>
  <LI><A href="../" target=_blank>打开网站首页</A></LI></UL>
</BODY>
</HTML>
