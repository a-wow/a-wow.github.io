Date.now||(Date.now=function(){return(new Date).getTime()}),function(){"use strict";for(var t=["webkit","moz"],e=0;e<t.length&&!window.requestAnimationFrame;++e){var i=t[e];window.requestAnimationFrame=window[i+"RequestAnimationFrame"],window.cancelAnimationFrame=window[i+"CancelAnimationFrame"]||window[i+"CancelRequestAnimationFrame"]}if(/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent)||!window.requestAnimationFrame||!window.cancelAnimationFrame){var s=0;window.requestAnimationFrame=function(t){var e=Date.now(),i=Math.max(s+16,e);return setTimeout((function(){t(s=i)}),i-e)},window.cancelAnimationFrame=clearTimeout}}(),function(t){t.snowfall=function(e,i){function s(s,n,o,d){this.x=s,this.y=n,this.size=o,this.speed=d,this.step=0,this.stepSize=a(1,10)/100,i.collection&&(this.target=f[a(0,f.length-1)]);var c=null;i.image?(c=document.createElement("img")).src=i.image:(c=document.createElement("div"),t(c).css({background:i.flakeColor})),t(c).attr({class:"snowfall-flakes"}).css({width:this.size,height:this.size,position:i.flakePosition,top:this.y,left:this.x,fontSize:0,zIndex:i.flakeIndex}),t(e).get(0).tagName===t(document).get(0).tagName?(t("body").append(t(c)),e=t("body")):t(e).append(t(c)),this.element=c,this.update=function(){if(this.y+=this.speed,this.y>h-(this.size+6)&&this.reset(),this.element.style.top=this.y+"px",this.element.style.left=this.x+"px",this.step+=this.stepSize,this.x+=!1===z?Math.cos(this.step):z+Math.cos(this.step),i.collection&&this.x>this.target.x&&this.x<this.target.width+this.target.x&&this.y>this.target.y&&this.y<this.target.height+this.target.y){var t=this.target.element.getContext("2d"),e=this.x-this.target.x,s=this.y-this.target.y,n=this.target.colData;if(void 0!==n[parseInt(e)][parseInt(s+this.speed+this.size)]||s+this.speed+this.size>this.target.height)if(s+this.speed+this.size>this.target.height){for(;s+this.speed+this.size>this.target.height&&this.speed>0;)this.speed*=.5;t.fillStyle="#fff",null==n[parseInt(e)][parseInt(s+this.speed+this.size)]?(n[parseInt(e)][parseInt(s+this.speed+this.size)]=1,t.fillRect(e,s+this.speed+this.size,this.size,this.size)):(n[parseInt(e)][parseInt(s+this.speed)]=1,t.fillRect(e,s+this.speed,this.size,this.size)),this.reset()}else this.speed=1,this.stepSize=0,parseInt(e)+1<this.target.width&&null==n[parseInt(e)+1][parseInt(s)+1]?this.x++:parseInt(e)-1>0&&null==n[parseInt(e)-1][parseInt(s)+1]?this.x--:(t.fillStyle="#fff",t.fillRect(e,s,this.size,this.size),n[parseInt(e)][parseInt(s)]=1,this.reset())}(this.x+this.size>r-l||this.x<l)&&this.reset()},this.reset=function(){this.y=0,this.x=a(l,r-l),this.stepSize=a(1,10)/100,this.size=a(100*i.minSize,100*i.maxSize)/100,this.element.style.width=this.size+"px",this.element.style.height=this.size+"px",this.speed=a(i.minSpeed,i.maxSpeed)}}var n=[],a=(i=t.extend({flakeCount:35,flakeColor:"#ffffff",flakePosition:"absolute",flakeIndex:999999,minSize:1,maxSize:2,minSpeed:1,maxSpeed:5,round:!1,shadow:!1,collection:!1,collectionHeight:40,deviceorientation:!1},i),function(t,e){return Math.round(t+Math.random()*(e-t))});t(e).data("snowfall",this);var o=0,h=t(e).height(),r=t(e).width(),l=0,d=0;if(!1!==i.collection){var c=document.createElement("canvas");if(c.getContext&&c.getContext("2d")){var f=[],p=t(i.collection),m=i.collectionHeight;for(o=0;o<p.length;o++){var w=p[o].getBoundingClientRect(),u=t("<canvas/>",{class:"snowfall-canvas"}),g=[];if(w.top-m>0){t("body").append(u),u.css({position:i.flakePosition,left:w.left+"px",top:w.top-m+"px"}).prop({width:w.width,height:m});for(var x=0;x<w.width;x++)g[x]=[];f.push({element:u.get(0),x:w.left,y:w.top-m,width:w.width,height:m,colData:g})}}}else i.collection=!1}for(t(e).get(0).tagName===t(document).get(0).tagName&&(l=25),t(window).bind("resize",(function(){h=t(e)[0].clientHeight,r=t(e)[0].offsetWidth})),o=0;o<i.flakeCount;o+=1)n.push(new s(a(l,r-l),a(0,h),a(100*i.minSize,100*i.maxSize)/100,a(i.minSpeed,i.maxSpeed)));i.round&&t(".snowfall-flakes").css({"-moz-border-radius":i.maxSize,"-webkit-border-radius":i.maxSize,"border-radius":i.maxSize}),i.shadow&&t(".snowfall-flakes").css({"-moz-box-shadow":"1px 1px 1px #555","-webkit-box-shadow":"1px 1px 1px #555","box-shadow":"1px 1px 1px #555"});var z=!1;i.deviceorientation&&t(window).bind("deviceorientation",(function(t){z=.1*t.originalEvent.gamma})),function t(){for(o=0;o<n.length;o+=1)n[o].update();d=requestAnimationFrame((function(){t()}))}(),this.clear=function(){t(".snowfall-canvas").remove(),t(e).children(".snowfall-flakes").remove(),cancelAnimationFrame(d)}},t.fn.snowfall=function(e){return"object"==typeof e||null==e?this.each((function(){new t.snowfall(this,e)})):"string"==typeof e?this.each((function(){var e=t(this).data("snowfall");e&&e.clear()})):void 0}}(jQuery);