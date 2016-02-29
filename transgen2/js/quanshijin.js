// JavaScript Document
$(function(){
	/*$(".cont").focus(function(){
		if(this.value=='easypure , plasmid, miniprep, kit'){this.value='';}	
	}).blur(function(){if(this.value==''){this.value='easypure , plasmid, miniprep, kit';}})*/
	$(".commonUl1>li").hover(function(){
			$(this).addClass("se2").siblings().removeClass("se2");},function(){
				$(this).removeClass("se2");
					
			})
	$(".title1>h1").click(function(){
		$(this).addClass("se3").siblings().removeClass("se3");
		$(".threeUl").children().eq($(this).index()).show().siblings().hide();
	})
	$(".title2>h1").click(function(){
		$(this).addClass("se3").siblings().removeClass("se3");
		$(".twoUl").children().eq($(this).index()).show().siblings().hide();
	})
	
	
	var i = 0;
	var sid = setInterval(move,5000);
	function move()
	{
		i++;
		if(i == $(".allImg_myself img").length){i=0;}
		$(".pageBox_myself span").eq(i).click();
	}
	$(".pageBox_myself span").click(function(){
		$(".allImg_myself img").fadeOut(1000).eq($(this).index()).fadeIn(1000);
		$(this).addClass("se").siblings(".se").removeClass("se");
	}).mousemove(function(){
		clearInterval(sid);
		i = $(this).index();
	}).mouseout(function(){
		sid = setInterval(move,5000);
	})
	//join
	$(".join_list>li").hover(function(){
		$(this).addClass("se4").siblings().removeClass("se4");	
	},function(){$(this).removeClass("se4");});
	
	$(".pages a").click(function(){
		$(this).addClass("se5").siblings().removeClass("se5");	
	})
	
	//off
	$(".off1").click(function(){
		$(this).parent().hide();	
	});
	
	$(".clicks").click(function(){
		$(this).toggleClass("se6").next().slideToggle().siblings(".goList").slideUp();	
		$(this).siblings(".clicks").removeClass("se6");
		$(this).children(":first").css({color:"#ff6600"});
	});	
	
	
	
	$(".fa").click(function(){
		$(this).toggleClass("seFA").next().slideToggle().siblings(".goList").slideUp();	
		$(this).siblings(".fa").removeClass("seFA")
	});
	
	//导航
	$(".nav li").hover(function(){
			$(this).children(":last").show();
		},function(){
				$(this).children(":last").hide();
			})
	
	$(".leis a").hover(function(){
		$(this).addClass("hov");
	},function(){
		$(this).removeClass("hov");
	})
	
	$(".add12").click(function(){$(this).children().css({color:"#F60"})})
	
	
	
	$(".join_list1 li a").click(function(){
		$(this).css({color:"#fd2020"});
	});
	
	
	
})