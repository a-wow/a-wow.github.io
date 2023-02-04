$(document).ready(function () {
  $(".forum__item").hover(function () {
    $(this).find(".forum__item-btn").toggleClass("forum-btn_active");
    $(this).toggleClass("forum__item_active");
  });
  $(".leader__tab").on("click", function () {
    $(".leader__tab").removeClass("leader__tab_active");
    $(this).addClass("leader__tab_active");
  });
  $(".start__btn").hover(function () {
    $(this).toggleClass("start__btn-active");
  });
  $(".rating__btn").click(function () {
    $(".rating__btn").removeClass("rating__btn-active");
    $(this).addClass("rating__btn-active");
  });

  $(".servers__time-lapse").append(
    `<div class="servers__time-info hide"><span class="time-info-title">Открылся Old Server</span><span class="time-info-text">20 Июня 2020</span></div>`
  );
  $(".servers__time-drop").hover(function () {
    $(".servers__time-info").toggleClass("hide");
  });

  $(".hamburger__button").on("click", function () {
    $(".mobile__menu").toggleClass("open_mobile");
    $('html, body').animate({scrollTop: 0}, 600);
    $("body, html").toggleClass("overflow");
  });

  $("#nav_main").hover(function () {
    $(".active__nav-item").css("left", "2px");
  });
  $("#nav_stocks").hover(function () {
    $(".active__nav-item").css("left", "140px");
  });
  $("#nav_servers").hover(function () {
    $(".active__nav-item").css("left", "275px");
  });
  $("#nav_files").hover(function () {
    $(".active__nav-item").css("left", "418px");
  });
  $("#nav_donat").hover(function () {
    $(".active__nav-item").css("left", "548px");
  });
  $("#nav_forum").hover(function () {
    $(".active__nav-item").css("left", "679px");
  });
  $("#nav_supp").hover(function () {
    $(".active__nav-item").css("left", "828px");
  });
});
