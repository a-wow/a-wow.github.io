const body=document.querySelector("body"),modeToggle=body.querySelector(".mode-toggle");sidebar=body.querySelector("[data-navbar]"),sidebarToggle=body.querySelector("[data-nav-toggler]");const navbar=document.querySelector("[data-navbar]"),navTogglers=document.querySelectorAll("[data-nav-toggler]"),overlay=document.querySelector("[data-overlay]"),toggleNavbar=function(){navbar.classList.toggle("active"),overlay.classList.toggle("active"),document.body.classList.toggle("active")},addEventOnElem=function(e,t,a){if(e.length>1)for(let o=0;o<e.length;o++)e[o].addEventListener(t,a);else e.addEventListener(t,a)};addEventOnElem(navTogglers,"click",toggleNavbar);let getMode=localStorage.getItem("mode");getMode&&"dark"===getMode&&body.classList.toggle("dark");let getStatus=localStorage.getItem("status");getStatus&&"close"===getStatus&&sidebar.classList.toggle("close"),modeToggle.addEventListener("click",(()=>{body.classList.toggle("dark"),body.classList.contains("dark")?localStorage.setItem("mode","dark"):localStorage.setItem("mode","light")})),sidebarToggle.addEventListener("click",(()=>{sidebar.classList.toggle("close"),sidebar.classList.contains("close")?localStorage.setItem("status","close"):localStorage.setItem("status","open")}));