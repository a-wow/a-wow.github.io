window.Modernizr=function(e,t,n){function r(e){d.cssText=e}function o(e,t){return typeof e===t}var i,a,c={},l=t.documentElement,s="modernizr",u=t.createElement(s),d=u.style,f=" -webkit- -moz- -o- -ms- ".split(" "),p={},h=[],m=h.slice,y=function(e,n,r,o){var i,a,c,u,d=t.createElement("div"),f=t.body,p=f||t.createElement("body");if(parseInt(r,10))for(;r--;)(c=t.createElement("div")).id=o?o[r]:s+(r+1),d.appendChild(c);return i=["&#173;",'<style id="s',s,'">',e,"</style>"].join(""),d.id=s,(f?d:p).innerHTML+=i,p.appendChild(d),f||(p.style.background="",p.style.overflow="hidden",u=l.style.overflow,l.style.overflow="hidden",l.appendChild(p)),a=n(d,e),f?d.parentNode.removeChild(d):(p.parentNode.removeChild(p),l.style.overflow=u),!!a},v={}.hasOwnProperty;for(var g in a=o(v,"undefined")||o(v.call,"undefined")?function(e,t){return t in e&&o(e.constructor.prototype[t],"undefined")}:function(e,t){return v.call(e,t)},Function.prototype.bind||(Function.prototype.bind=function(e){var t=this;if("function"!=typeof t)throw new TypeError;var n=m.call(arguments,1),r=function(){if(this instanceof r){var o=function(){};o.prototype=t.prototype;var i=new o,a=t.apply(i,n.concat(m.call(arguments)));return Object(a)===a?a:i}return t.apply(e,n.concat(m.call(arguments)))};return r}),p.touch=function(){var n;return"ontouchstart"in e||e.DocumentTouch&&t instanceof DocumentTouch?n=!0:y(["@media (",f.join("touch-enabled),("),s,")","{#modernizr{top:9px;position:absolute}}"].join(""),(function(e){n=9===e.offsetTop})),n},p)a(p,g)&&(i=g.toLowerCase(),c[i]=p[g](),h.push((c[i]?"":"no-")+i));return c.addTest=function(e,t){if("object"==typeof e)for(var r in e)a(e,r)&&c.addTest(r,e[r]);else{if(e=e.toLowerCase(),c[e]!==n)return c;t="function"==typeof t?t():t,l.className+=" "+(t?"":"no-")+e,c[e]=t}return c},r(""),u=null,function(e,t){function n(){var e=h.elements;return"string"==typeof e?e.split(" "):e}function r(e){var t=p[e[d]];return t||(t={},f++,e[d]=f,p[f]=t),t}function o(e,n,o){return n||(n=t),c?n.createElement(e):(o||(o=r(n)),(i=o.cache[e]?o.cache[e].cloneNode():u.test(e)?(o.cache[e]=o.createElem(e)).cloneNode():o.createElem(e)).canHaveChildren&&!s.test(e)?o.frag.appendChild(i):i);var i}function i(e){e||(e=t);var i=r(e);return h.shivCSS&&!a&&!i.hasCSS&&(i.hasCSS=!!function(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}(e,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),c||function(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return h.shivMethods?o(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+n().join().replace(/\w+/g,(function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'}))+");return n}")(h,t.frag)}(e,i),e}var a,c,l=e.html5||{},s=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,u=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,d="_html5shiv",f=0,p={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",a="hidden"in e,c=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return void 0===e.cloneNode||void 0===e.createDocumentFragment||void 0===e.createElement}()}catch(e){a=!0,c=!0}}();var h={elements:l.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:!1!==l.shivCSS,supportsUnknownElements:c,shivMethods:!1!==l.shivMethods,type:"default",shivDocument:i,createElement:o,createDocumentFragment:function(e,o){if(e||(e=t),c)return e.createDocumentFragment();for(var i=(o=o||r(e)).frag.cloneNode(),a=0,l=n(),s=l.length;a<s;a++)i.createElement(l[a]);return i}};e.html5=h,i(t)}(this,t),c._version="2.6.2",c._prefixes=f,c.testStyles=y,l.className=l.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+" js "+h.join(" "),c}(this,this.document),function(e,t,n){function r(e){return"[object Function]"==y.call(e)}function o(e){return"string"==typeof e}function i(){}function a(e){return!e||"loaded"==e||"complete"==e||"uninitialized"==e}function c(){var e=v.shift();g=1,e?e.t?h((function(){("c"==e.t?f.injectCss:f.injectJs)(e.s,0,e.a,e.x,e.e,1)}),0):(e(),c()):g=0}function l(e,n,r,o,i,l,s){function u(t){if(!p&&a(d.readyState)&&(b.r=p=1,!g&&c(),d.onload=d.onreadystatechange=null,t))for(var r in"img"!=e&&h((function(){j.removeChild(d)}),50),T[n])T[n].hasOwnProperty(r)&&T[n][r].onload()}s=s||f.errorTimeout;var d=t.createElement(e),p=0,y=0,b={t:r,s:n,e:i,a:l,x:s};1===T[n]&&(y=1,T[n]=[]),"object"==e?d.data=n:(d.src=n,d.type=e),d.width=d.height="0",d.onerror=d.onload=d.onreadystatechange=function(){u.call(this,y)},v.splice(o,0,b),"img"!=e&&(y||2===T[n]?(j.insertBefore(d,E?null:m),h(u,s)):T[n].push(d))}function s(e,t,n,r,i){return g=0,t=t||"j",o(e)?l("c"==t?w:C,e,t,this.i++,n,r,i):(v.splice(this.i++,0,e),1==v.length&&c()),this}function u(){var e=f;return e.loader={load:s,i:0},e}var d,f,p=t.documentElement,h=e.setTimeout,m=t.getElementsByTagName("script")[0],y={}.toString,v=[],g=0,b="MozAppearance"in p.style,E=b&&!!t.createRange().compareNode,j=E?p:m.parentNode,C=(p=e.opera&&"[object Opera]"==y.call(e.opera),p=!!t.attachEvent&&!p,b?"object":p?"script":"img"),w=p?"script":C,S=Array.isArray||function(e){return"[object Array]"==y.call(e)},N=[],T={},x={timeout:function(e,t){return t.length&&(e.timeout=t[0]),e}};(f=function(e){function t(e,t,n,o,i){var a=function(e){e=e.split("!");var t,n,r,o=N.length,i=e.pop(),a=e.length;for(i={url:i,origUrl:i,prefixes:e},n=0;n<a;n++)r=e[n].split("="),(t=x[r.shift()])&&(i=t(i,r));for(n=0;n<o;n++)i=N[n](i);return i}(e),c=a.autoCallback;a.url.split(".").pop().split("?").shift(),a.bypass||(t&&(t=r(t)?t:t[e]||t[o]||t[e.split("/").pop().split("?")[0]]),a.instead?a.instead(e,t,n,o,i):(T[a.url]?a.noexec=!0:T[a.url]=1,n.load(a.url,a.forceCSS||!a.forceJS&&"css"==a.url.split(".").pop().split("?").shift()?"c":undefined,a.noexec,a.attrs,a.timeout),(r(t)||r(c))&&n.load((function(){u(),t&&t(a.origUrl,i,o),c&&c(a.origUrl,i,o),T[a.url]=2}))))}function n(e,n){function a(e,i){if(e){if(o(e))i||(d=function(){var e=[].slice.call(arguments);f.apply(this,e),p()}),t(e,d,n,0,s);else if(Object(e)===e)for(l in c=function(){var t,n=0;for(t in e)e.hasOwnProperty(t)&&n++;return n}(),e)e.hasOwnProperty(l)&&(!i&&!--c&&(r(d)?d=function(){var e=[].slice.call(arguments);f.apply(this,e),p()}:d[l]=function(e){return function(){var t=[].slice.call(arguments);e&&e.apply(this,t),p()}}(f[l])),t(e[l],d,n,l,s))}else!i&&p()}var c,l,s=!!e.test,u=e.load||e.both,d=e.callback||i,f=d,p=e.complete||i;a(s?e.yep:e.nope,!!u),u&&a(u)}var a,c,l=this.yepnope.loader;if(o(e))t(e,0,l,0);else if(S(e))for(a=0;a<e.length;a++)o(c=e[a])?t(c,0,l,0):S(c)?f(c):Object(c)===c&&n(c,l);else Object(e)===e&&n(e,l)}).addPrefix=function(e,t){x[e]=t},f.addFilter=function(e){N.push(e)},f.errorTimeout=1e4,null==t.readyState&&t.addEventListener&&(t.readyState="loading",t.addEventListener("DOMContentLoaded",d=function(){t.removeEventListener("DOMContentLoaded",d,0),t.readyState="complete"},0)),e.yepnope=u(),e.yepnope.executeStack=c,e.yepnope.injectJs=function(e,n,r,o,l,s){var u,d,p=t.createElement("script");o=o||f.errorTimeout;for(d in p.src=e,r)p.setAttribute(d,r[d]);n=s?c:n||i,p.onreadystatechange=p.onload=function(){!u&&a(p.readyState)&&(u=1,n(),p.onload=p.onreadystatechange=null)},h((function(){u||(u=1,n(1))}),o),l?p.onload():m.parentNode.insertBefore(p,m)},e.yepnope.injectCss=function(e,n,r,o,a,l){var s;o=t.createElement("link"),n=l?c:n||i;for(s in o.href=e,o.rel="stylesheet",o.type="text/css",r)o.setAttribute(s,r[s]);a||(m.parentNode.insertBefore(o,m),h(n,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};