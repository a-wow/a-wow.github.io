function scrollLoad(){var e=$(".slide-wrapper").height()-50;$(".slider").animate({top:"-"+e},1e3),$("html, body").animate({scrollTop:1},1e3),setTimeout((function(){$(".slide-wrapper .slide").css({opacity:0})}),500)}function portfolioLoad(e,a){Dprevyear="2012"==e?"2007—2012":e,$(".logo-mini").addClass("animate"),$(".preloader-image").fadeIn("fast"),$(".slider-nav li.active").removeClass("active"),$(".slider-nav.active").removeClass("active"),$(".footer").addClass("animate"),animateSlidesNext(),setTimeout((function(){$(".slider").css({top:"50px"}),$(".slide-wrapper").remove(),$(".slide-wrapper-next").addClass("slide-wrapper"),$(".slide-wrapper-next").removeClass("slide-wrapper-next");var i=$(".year").attr("data-prevnum");$(".slider .scroll").append('<div class="slide-wrapper-next"><div class="year linked animate"><div><a class="'+e+'" href="#'+e+'" title="Previous Year"><h3>'+Dprevyear+"</h3>"+i+" "+projectsLang+'</a></div><a class="'+e+'" href="#'+e+'" title="Previous Year"><i class="unsimple-'+a+'"></i></a></div></div>'),$(".slide-wrapper").after($(".slide-wrapper-next"))}),1500)}function loadModalScript(){$.ajax({url:"/assets/js/modal.js",dataType:"script",beforeSend:function(e){}})}function animateElements(){setTimeout((function(){$(".logo-mini").removeClass("animate")}),2e3);var e=400;$(".slider-nav li").each((function(){var a=$(this).find("a");setTimeout((function(){a.removeClass("animate")}),e),e+=200})),setTimeout((function(){$(".change-type").removeClass("animate"),$(".footer").removeClass("animate"),$(".year").removeClass("animate")}),2200)}function animateSlides(){setTimeout((function(){$(".slider .scroll").removeClass("animate")}),300),setTimeout((function(){$(".slide-wrapper .year").slideUp("slow")}),2e3),setTimeout((function(){$(".slider-nav").addClass("active")}),2300);var e=1e3;$(".slider .slide-wrapper .slide").each((function(){var a=$(this);setTimeout((function(){a.removeClass("animate")}),e),e+=200}))}function animateSlidesNext(){setTimeout((function(){$(".slide-wrapper .year").slideUp("slow")}),2e3),setTimeout((function(){$(".slider-nav").addClass("active"),$(".logo-mini").removeClass("animate"),$(".preloader-image").fadeOut("fast")}),2300);var e=100;$(".slider .slide-wrapper-next .slide").each((function(){var a=$(this);setTimeout((function(){a.removeClass("animate")}),e),e+=200})),setTimeout((function(){$(".footer").removeClass("animate"),$(".year").removeClass("animate")}),2e3)}function popupBgPreload(){$(".preloader").append('<img src="/assets/images/modal-bg.png" alt="" class="imgpreload"><img src="/assets/images/inners-bg.png" alt="" class="imgpreload">')}$(window).on("load",(function(){"use strict";$(".preloader-image").delay(2e3).fadeOut("fast"),animateElements(),animateSlides(),popupBgPreload()})),$(document).ready((function(){$(".preloader-image").delay(300).removeClass("home").addClass("inner"),window.initlang=$("html").attr("lang"),"ru"==initlang?(window.stepLang="Шаг",window.projectsLang="проектов"):(window.stepLang="Step",window.projectsLang="projects");var e=location.toString().substr(-4);if("2"==e.charAt(0)){var a=e;if(2011==(i=Number(a)-1))var i=2021,n="up";else n="down";$.ajax({url:"/portfolio/years/"+a+".php?initlang="+initlang,beforeSend:function(e){}}).done((function(e){$(".slide-wrapper-next").html(e),scrollLoad(),portfolioLoad(i,n),$(".slider-nav li."+a).addClass("active")}))}$.ajax({url:"/includes/modal.php?steplang="+stepLang,beforeSend:function(e){}}).done((function(e){$("#include-modal").html(e),setTimeout((function(){loadModalScript()}),300)})),$(document).on("click",".thumb",(function(e){e.preventDefault();var a=$(this).find("a").attr("href");window.location=a})),$(window).scroll((function(e){e.preventDefault(),0==$(window).scrollTop()?setTimeout((function(){$(".prev-year").removeClass("animate")}),300):setTimeout((function(){$(".prev-year").addClass("animate")}),300)})),$(document).on("click",".slider-nav.active li, .linked a",(function(){var e=$(this).attr("class");if(2011==(a=Number(e)-1))var a=2021,i="up";else i="down";$.ajax({url:"/portfolio/years/"+e+".php?initlang="+initlang,beforeSend:function(e){}}).done((function(n){$(".slide-wrapper-next").html(n),scrollLoad(),portfolioLoad(a,i),$(".slider-nav li."+e).addClass("active")}))})),$(document).on("click",".nav a.show-contacts",(function(e){e.preventDefault(),$(".navbar .invisible").toggle(),$(".social, .contacts").toggle()})),$(document).on("click",".contacts .close",(function(e){e.preventDefault(),$(".navbar .invisible").toggle(),$(".social, .contacts").toggle()})),$(document).on("mouseenter",".logo-mini a",(function(){$(window).width()>=960&&$(".navbar").addClass("active").find(".container").stop().animate({opacity:1},(function(){}))})),$(document).on("mouseleave",".navbar .container",(function(){$(window).width()>=960&&$(".navbar .container").stop().animate({opacity:0},(function(){$(".navbar").removeClass("active")}))})),$(document).on("click",".logo-mini a, .navbar-toggle a.close",(function(e){$(window).width()<960&&(e.preventDefault(),$(".navbar").toggleClass("open"))}))}));