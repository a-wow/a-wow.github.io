
$(function(){
getInfoJack();
messagesLoad();
var four;
var lang;
})

$(window).on('load', function () {
    $('.preload').fadeIn("slow");
    var chat_scroll = document.getElementById("message_block");
    try {
      chat_scroll.scrollTop = chat_scroll.scrollHeight;
    } catch (e) {

    }
    $('.screen').fadeOut('slow'); // и скрываем сам блок прелоудера.
});

$(window).focus(function(){
  if(start == 0){
    if (start == 1) {
      return
    }

    getInfo();
    getInfo2();
  //  getInfoJack();
  }
})


function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie( name, value, exp_y, exp_m, exp_d, path, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );

  if ( exp_y )
  {
    var expires = new Date ( exp_y, exp_m, exp_d );
    cookie_string += "; expires=" + expires.toGMTString();
  }

  if ( path )
        cookie_string += "; path=" + escape ( path );

  if ( domain )
        cookie_string += "; domain=" + escape ( domain );

  if ( true )
        cookie_string += "; secure";

  document.cookie = cookie_string;
}

function updateBanks(bank,color, user) {

// if (user && user.length > 0) {
//   var myGame = -1;
//   var borders = [];
//   for (var i = 0; i < user.length; i++) {
//     for (var z = 0; z < user[i].length; z++) {
//       if (user[i][z] == user_id) {
//         myGame = i;
//       }
//     }
//     borders[i] = '#ffffff';
//   }
//   if (myGame >= 0) {
//     borders[myGame] = '#000000';
//     circle.data.datasets[0].borderColor = borders;
//   }
// } else {
//   circle.data.datasets[0].borderColor = ['#fff'];
// }

circle.data.datasets[0].data = bank;
circle.data.datasets[0].backgroundColor = color;
circle.update();

}
var cik = 0;
function offConsole(){
  if (cik == 0) {
    $('.console').slideUp();
    $('.offConsole').slideUp();
    setTimeout(function(){
    $('.offConsole').html('<i class="fas fa-arrow-circle-down"></i>');
    },500)
    cik = 1;
    return
  }
  if (cik == 1) {
    $('.console').slideDown();
    $('.offConsole').slideDown();
    setTimeout(function(){
    $('.offConsole').html('<i class="fas fa-arrow-circle-up"></i>');
    },500)
    cik = 0;
    return
  }

}

function exit() {
  setCookie('sid', '');
  setCookie('token', '');
  window.location = '/';
}

var jgjger = setInterval(function() {
  console.log("%cОстановитесь!","color: red; font-size: 42px; font-weight: 700"),console.log("%cЕсли кто-то сказал вам, что вы можете скопировать и вставить что-то здесь, то это мошенничество, которое даст злоумышленнику доступ к вашему аккаунту.","font-size: 20px;");

}, 2000);

function mute(id){
  if (chatBlock.indexOf( id ) != -1) {
    return error('Игрок уже заблокирован')
  }
  chatBlock.push(id)
  return error('Игрок заблокирован',true)
}
function unmute(id){
  if (chatBlock.indexOf( id ) == -1) {
    return error('Игрок разблокирован')
  }
  chatBlock.splice(chatBlock.indexOf(id), 1);
  return error('Игрок разблокирован',true)
}

const prefixList = [['', 'span'], ['[PREMIUM] ','premium'], ['[VIP] ','vip'], ['<i class="fab fa-youtube"></i> ','yt'], ['<i class="fas fa-crown"></i> ','adm'], ['[GOD] ', 'god'], ['[BATTLER] ', 'batler']]

function messagesLoad(){
  $.ajax({
    type: 'GET',
    url: '/api/getMessages',
    success: function(data) {
      if('success' in data){
        data = data.success.data.reverse();
        darkModis = getCookie('dark');
        var coloritniy = '';
        var colorbi = '';
        var darkback = '';
        for(let i = 0; i < data.length; i++){
          if (darkModis == 0 && data[i].color == '#070707') {
            coloritniy = '#fff';
            colorbi = 'colorit';
          } else if (darkModis == 1 && data[i].color == '#fff') {
              coloritniy = '#000';
              colorbi = 'colorit';
            } else if (darkModis == 1 && data[i].color == '#070707') {
                coloritniy = data[i].color;
                colorbi = 'colorit';
              } else {
              coloritniy = data[i].color;
              colorbi = ''
            }
          // if (darkModis == 1 && data[i].color == '#070707') {
          //   coloritniy = data[i].color;
          // } else {
          //   colorbi = 'colorit'
          //   coloritniy = '#fff';
          // }
          if (darkModis == 0) {
            darkBack = 'darkBack'
          }
          let tools1 = '';
          let tools2 = '';
          let tools3 = '';
          let tools4 = '';
          let cursor = '';
          if(admin == 1){
            tools1 = `<i class="fas fa-lock" style="color: #3454D1; margin-right: 5px;" onclick="chatban(${data[i].player_id})"></i>`;
            tools2 = `<i class="fas fa-trash-alt chaticon" style="color: #D1345B" onclick="deleteMessage(${data[i].id})"></i>`;
            tools3 = '<i class="fas fa-exclamation-circle chaticon" style="color: #850000" onclick="warn('+ data[i].player_id + ')"></i>';
            tools4 = 'data-toggle="tooltip" data-html="true" title="ID: ' + data[i].player_id + '"'
            cursor = 'cursor:pointer;'
          }
          $('#message_block').append(`<div class="message-item" message_id="${data[i].id}"><div class = "flex" style = "align-items: flex-end;justify-content: flex-start"><div class="ava" style="cursor: pointer;" onclick="window.open(\'https://vk.com/id${data[i].vk_id}\')"><img class = "ava" src = "${data[i].url}"/></div><div class="block ${darkback}" style="align-items: flex-end;width:auto;border-bottom-left-radius:0;margin-bottom:0;padding: 10px;padding-left: 20px;"><div class="${colorbi} message-name" ${tools4} style = "${cursor}color: ${coloritniy}">${tools1}<${prefixList[Number(data[i].pref)][1]}>${prefixList[Number(data[i].pref)][0]}</${prefixList[Number(data[i].pref)][1]}>${data[i].name}${tools2}${tools3}</div>
<div class="message-text">${data[i].text}</div></div></div></div>`);
        }
        var chat_scroll = document.getElementById("message_block");
        try {
          chat_scroll.scrollTop = chat_scroll.scrollHeight;
        } catch (e) {

        }
        $('[data-toggle="tooltip"]').tooltip()
      }else{
          error(obj.error);
      }
    },
    error: function(){
      setbet = 0;
      error('Произошла ошибка');
    }
    });
}

function closeWindow(){
	$('.modal').fadeOut(100)
	$('.modal-wrapper').fadeOut(100)
}

function dark_Mode(){
  darkMode = 1;
  var date = new Date(Date.now() + 604800000);
  setCookie('dark', 1, date.getFullYear(), date.getMonth(), date.getDate());
  $('body').css({
  'background' : '#fff',
  'color' : '#939298'
  });
  $('.backScreen').css({
  'background' : '#fff'
  });
  $('.B').css({
    'background': '#F4F7FF'
  })
  $('.R').css({
    'background':'#FFF3F3'
  })
  $(".R").removeClass('rAdd')
  $(".B").removeClass('bAdd')
  $('.Btext').css({
    'color' :'#6883DD'
  })
  $('.Rtext').css({
    'color': '#E95B4C'
  })
  $('.colorit').removeClass('coloritD')
  $('.colorit').addClass('coloritDf')
  // $('.counterW').removeClass('cwhite');
  $('#red2').hide();
  $('#red3').hide();

  $('#timerJack').css({
    'color': '#D3D3D3'
  });

  $('#timer').css({
    'color': '#626167'
  });
  $('#timer2').css({
    'color': '#626167'
  });




 // $('.battle').hide();
 // $('.jackec').hide();
 $('.preWhite').hide();
 // $('.battleDark').show();
 // $('.jackecDark').show();
 $('.preDark').show();

  $('body').addClass('dark')
}

function darkModeOff(){
  darkMode = 0;
  var date = new Date(Date.now() + 604800000);
  setCookie('dark', 0, date.getFullYear(), date.getMonth(), date.getDate());
  $('body').css({

    'background': 'radial-gradient(circle, #1D294E, #131C34, #0B0F1D)',
    'color': '#fff'

  });

  $('.backScreen').css({
  'background' : 'url(/styles/bg.png)'
  });
  $('.colorit').removeClass('coloritDf')
  $('.colorit').addClass('coloritD')
  $('.preWhite').hide();
  $('.battleDark').hide();
  $('.jackecDark').hide();
  $('.battle').show();
  $('.jackec').show();
  $('.preDark').show();

  $('#red2').show();
  $('#red3').show();

  // $('.R').css({
  //   'background': 'rgba(255,0,170,0.12)'
  // })
  // $('.B').css({
  //   'background': 'rgba(31,255,255,0.06)'
  // })
  $(".R").addClass('rAdd')
  $(".B").addClass('bAdd')
  $('.Rtext').css({
    'color':'#ff00aa'
  })

  $('.Btext').css({
    'color':'#1fffff'
  })

  $('#timer').css({
    'color':'#fff'
  })

  $('#timer2').css({
    'color':'#fff'
  })

  $('body').removeClass('dark')
}

function validNick(){
  $("#changeNick").val($("#changeNick").val().replace(/[<>\/\\]/i, ""));
}

function window_add(){

$('.modal').html(

`
<img src="static/close.svg" class="close" onclick="closeWindow()" />
<div class = "h2" style = "font-size: 1.4em;margin-top: 10px;margin-bottom:15px">Подтвердите смену ника</div>
  <div class = "flex">
  <div class = "button buttonMode flexNot" onclick = "closeWindow()" style = "background-color: #070707;color: white;width: 25%;">Нет</div>
  <div style = "width:10%"></div>
  <div class = "button buttonMode flexNot" onclick = "changeNick()" style = "background-color: #070707;color: white;width: 25%;">Да</div>
  </div>
`

)
$('.modal').show()
$('.modal-wrapper').fadeIn(100)
}

function window_add_color(){

$('.modal').html(

`
<img src="static/close.svg" class="close" onclick="closeWindow()" />
<div class = "h2" style = "font-size: 1.4em;margin-top: 10px;margin-bottom:15px">Подтвердите смену цвета</div>
  <div class = "flex">
  <div class = "button buttonMode flexNot" onclick = "closeWindow()" style = "background-color: #070707;color: white;width: 25%;">Нет</div>
  <div style = "width:10%"></div>
  <div class = "button buttonMode flexNot" onclick = "changeColor()" style = "background-color: #070707;color: white;width: 25%;">Да</div>
  </div>
`

)
$('.modal').show()
$('.modal-wrapper').fadeIn(100)
}

function window_add_img(){

$('.modal').html(

`
<img src="static/close.svg" class="close" onclick="closeWindow()" />
<div class = "h2" style = "font-size: 1.4em;margin-top: 10px;margin-bottom:15px">Подтвердите смену фото</div>
  <div class = "flex">
  <div class = "button buttonMode flexNot" onclick = "closeWindow()" style = "background-color: #070707;color: white;width: 25%;">Нет</div>
  <div style = "width:10%"></div>
  <div class = "button buttonMode flexNot" onclick = "changeImg()" style = "background-color: #070707;color: white;width: 25%;">Да</div>
  </div>
`

)
$('.modal').show()
$('.modal-wrapper').fadeIn(100)
}



function changeNick(){
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'changeNick',
      'token': getCookie('token'),
      'nick': $('#changeNick').val()
},
    success: function(data) {
      var obj = jQuery.parseJSON(data);
      try{
        if('success' in obj){
          error(obj.success.text,true);
          closeWindow();
          setTimeout(function(){
            location.reload();
          },1000)

        }else{
            error(obj.error);
        }
      }catch(e){
        error('Произошла ошибка');
      }
    },
    error: function(){
      setbet = 0;
      error('Произошла ошибка');
    }
    });
}

function changeColor(){
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'changeColor',
      'token': getCookie('token'),
      'color': $('#changeColor').val()
},
    success: function(data) {
      var obj = jQuery.parseJSON(data);
      try{
        if('success' in obj){
          error(obj.success.text,true);
          closeWindow();
          setTimeout(function(){
            location.reload();
          },1000)

        }else{
            error(obj.error);
        }
      }catch(e){
        error('Произошла ошибка');
      }
    },
    error: function(){
      setbet = 0;
      error('Произошла ошибка');
    }
    });
}

function changeImg(){
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'changeImg',
      'token': getCookie('token'),
      'img': $('#changeImg').val()
},
    success: function(data) {
      var obj = jQuery.parseJSON(data);
      try{
        if('success' in obj){
          error(obj.success.text,true);
          closeWindow();
          setTimeout(function(){
            location.reload();
          },1000)

        }else{
            error(obj.error);
        }
      }catch(e){
        error('Произошла ошибка');
      }
    },
    error: function(){
      setbet = 0;
      error('Произошла ошибка');
    }
    });
}

function main(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/main.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      $('.jackPotniy').hide();
      $('.game_jack').hide();
      $('.roulette').show();
      $('.roulette2').hide();
      $('.gameBattle').show();
      $('.gameBattle2').hide();
      preloader('hide');
    }
    });
}

function quest(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/quest.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function room(){
  $(".gameBattle2").hide()
  $(".gameBattle").show()
  $(".roulette2").hide()
  $(".roulette").show()
  $(".battleNoLimit").hide()
  $(".battleMainButton").show()
}
function room2(){
  $(".gameBattle2").show()
  $(".gameBattle").hide()
  $(".roulette2").show()
  $(".roulette").hide()
  $(".battleNoLimit").show()
  $(".battleMainButton").hide()
}

function profile(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/profile.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function jackPotniy(){
  // error('Режим на технических работах.');
  // return;
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/jackPotniy.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      $('.roulette').hide();
      $('.gameBattle').hide();
      $('.jackPotniy').show();
      $('.game_jack').show();
      //getInfoJack();
      preloader('hide');
    }
    });
}

function add(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/add.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function sub(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/sub.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    },
    error: function(){
      error('Ошибка загрузки. Перезагрузите страницу.');
    }
    });
}

function more(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/more.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function bonus(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/bonus.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function faq(){
  preloader('show');
  $.ajax({
    type: 'POST',
    url: '../modules/menu/faq.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
      preloader('hide');
    }
    });
}

function preloader(data){
  if(data == 'show'){
    $('#active').css('display', 'none');
    $('#preloader').css('display', 'block');
    $('#active').css('transform', 'scale(1.1)');
}else{
  $('#active').css('transform', 'scale(1)');
  $('#preloader').css('display', 'none');
  $('#active').css('display', 'block');
}
}

function ios() {

  var iDevices = [
    'iPad Simulator',
    'iPhone Simulator',
    'iPod Simulator',
    'iPad',
    'iPhone',
    'iPod'
  ];

  if (!!navigator.platform) {
    while (iDevices.length) {
      if (navigator.platform === iDevices.pop()){ return true; }
    }
  }
  return false;
}

function build(blue_cur){
  var blue = d3.arc()
      .innerRadius(165)
      .outerRadius(180)
      .startAngle(0)
      .endAngle(2 * Math.PI * blue_cur);
  $("#blue").attr('d', blue());

  var red = d3.arc()
      .innerRadius(165)
      .outerRadius(180)
      .startAngle(2 * Math.PI * blue_cur)
      .endAngle(2 * Math.PI);
  $("#red").attr('d', red());

}
function build2(blue_cur){
  var blue2 = d3.arc()
      .innerRadius(1)
      .outerRadius(180)
      .startAngle(0)
      .endAngle(2 * Math.PI * blue_cur);
  $("#blue32").attr('d', blue2());
  var red2 = d3.arc()
      .innerRadius(1)
      .outerRadius(180)
      .startAngle(2 * Math.PI * blue_cur)
      .endAngle(2 * Math.PI);
  $("#red2").attr('d', red2());
}

function buildNoLimit(blue_cur){
  var blue = d3.arc()
      .innerRadius(165)
      .outerRadius(180)
      .startAngle(0)
      .endAngle(2 * Math.PI * blue_cur);
  $("#blue2").attr('d', blue());

  var red = d3.arc()
      .innerRadius(165)
      .outerRadius(180)
      .startAngle(2 * Math.PI * blue_cur)
      .endAngle(2 * Math.PI);
  $("#red_2").attr('d', red());

}
function build3(blue_cur){
  var blue2 = d3.arc()
      .innerRadius(1)
      .outerRadius(180)
      .startAngle(0)
      .endAngle(2 * Math.PI * blue_cur);
  $("#blue32").attr('d', blue2());
  var red2 = d3.arc()
      .innerRadius(1)
      .outerRadius(180)
      .startAngle(2 * Math.PI * blue_cur)
      .endAngle(2 * Math.PI);
  $("#red3").attr('d', red2());
}


function getInfo() {
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'getInfo'
},
    success: function(data) {
      try {
        var obj = jQuery.parseJSON(data);
      } catch (e) {

      }
      $("#circle").css('transition', '');
      $("#circle").css('transform', 'rotate(0deg)');
      try{
        if('success' in obj){
          try{
            if(obj.success.red == 0 || obj.success.blue == 0){
              $("#red_persent").html('<i class="fas fa-question"></i>');
              $("#blue_persent").html('<i class="fas fa-question"></i>');
              $("#red_tickets").html('<i class="fas fa-question"></i>');
              $("#blue_tickets").html('<i class="fas fa-question"></i>');
            }else{
              $("#red_persent").html(Math.round(parseFloat(obj.success.red)*100) + '%');
              $("#blue_persent").html(Math.round(parseFloat(obj.success.blue)*100) + '%');
              $("#red_tickets").html(parseInt(parseFloat(obj.success.red)*1000));
              $("#blue_tickets").html(parseInt(parseFloat(obj.success.red)*1000) + 1);
            }
          }catch(e){}

          try {
            r = 0;
            let html_red = '';
            while (r < obj.success.red_list.length) {
            html_red +=
             `
            <div class="list-item flex" style="justify-content: left;"><div class="ava" style="background-image: url('${obj.success.red_list[r].playerImg}');"></div><div class="name">${obj.success.red_list[r].playerName}</div><div class="sum">${obj.success.red_list[r].playerBet}</div></div>
            `

              r++
            }
            $("#red_list").html(html_red);
          } catch (e) {

          }

          try {
            b = 0;
            let html_blue = '';
            while (b < obj.success.blue_list.length) {
            html_blue +=
            `
              <div class="list-item flex" style="justify-content: left;"><div class="ava" style="background-image: url('${obj.success.blue_list[b].playerImg}');"></div><div class="name">${obj.success.blue_list[b].playerName}</div><div class="sum">${obj.success.blue_list[b].playerBet}</div></div>
            `

              b++
            }
            $("#blue_list").html(html_blue);
          } catch (e) {

          }
          if(obj.success.red == 0 || obj.success.blue == 0){
            $("#red_factor").html('<i class="fas fa-question"></i>');
            $("#blue_factor").html('<i class="fas fa-question"></i>');
            $("#red_sum").html(obj.success.red_sum.toFixed(2));
            $("#blue_sum").html(obj.success.blue_sum.toFixed(2));
          }else{
            $("#red_factor").html('x' + parseFloat(100 / (parseFloat(obj.success.red)*100)).toFixed(2));
            $("#red_sum").html(obj.success.red_sum.toFixed(2));
            $("#blue_factor").html('x' + parseFloat(100 / (parseFloat(obj.success.blue)*100)).toFixed(2));
            $("#blue_sum").html(obj.success.blue_sum.toFixed(2));
          }
          if(obj.success.red > 0 && obj.success.blue > 0 && obj.success.bets > 0){
            $('title').text('🔴 ' + Math.round(parseFloat(obj.success.red)*100) + ' % ⚔ ' + Math.round(parseFloat(obj.success.blue)*100) + '%' + ' 🔵');
          }else{
            $('title').text(site_name);
          }
          build(parseFloat(obj.success.blue));
          build2(parseFloat(obj.success.blue));
        }else{
            error(obj.error);
        }
      }catch(e){
        //error('Произошла ошибка');
      }
    },
    error: function(){
      //error('Произошла ошибка');
    }
    });
}

function getInfo2() {
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'getInfo2'
},
    success: function(data) {
      try {
        var obj = jQuery.parseJSON(data);
      } catch (e) {

      }
      $("#circle2").css('transition', '');
      $("#circle2").css('transform', 'rotate(0deg)');
      try{
        if('success' in obj){
          try{
            if(obj.success.red == 0 || obj.success.blue == 0){
              $("#red_persent2").html('<i class="fas fa-question"></i>');
              $("#blue_persent2").html('<i class="fas fa-question"></i>');
              $("#red_tickets2").html('<i class="fas fa-question"></i>');
              $("#blue_tickets2").html('<i class="fas fa-question"></i>');
            }else{
              $("#red_persent2").html(Math.round(parseFloat(obj.success.red)*100) + '%');
              $("#blue_persent2").html(Math.round(parseFloat(obj.success.blue)*100) + '%');
              $("#red_tickets2").html(parseInt(parseFloat(obj.success.red)*1000));
              $("#blue_tickets2").html(parseInt(parseFloat(obj.success.red)*1000) + 1);
            }
          }catch(e){}

          try {
            r = 0;
            let html_red = '';
            while (r < obj.success.red_list.length) {
            html_red +=
             `
            <div class="list-item flex" style="justify-content: left;"><div class="ava" style="background-image: url('${obj.success.red_list[r].playerImg}');"></div><div class="name">${obj.success.red_list[r].playerName}</div><div class="sum">${obj.success.red_list[r].playerBet}</div></div>
            `

              r++
            }
            $("#red_list2").html(html_red);
          } catch (e) {

          }

          try {
            b = 0;
            let html_blue = '';
            while (b < obj.success.blue_list.length) {
            html_blue +=
            `
              <div class="list-item flex" style="justify-content: left;"><div class="ava" style="background-image: url('${obj.success.blue_list[b].playerImg}');"></div><div class="name">${obj.success.blue_list[b].playerName}</div><div class="sum">${obj.success.blue_list[b].playerBet}</div></div>
            `

              b++
            }
            $("#blue_list2").html(html_blue);
          } catch (e) {

          }
          if(obj.success.red == 0 || obj.success.blue == 0){
            $("#red_factor2").html('<i class="fas fa-question"></i>');
            $("#blue_factor2").html('<i class="fas fa-question"></i>');
            $("#red_sum2").html(obj.success.red_sum.toFixed(2));
            $("#blue_sum2").html(obj.success.blue_sum.toFixed(2));
          }else{
            $("#red_factor2").html('x' + parseFloat(100 / (parseFloat(obj.success.red)*100)).toFixed(2));
            $("#red_sum2").html(obj.success.red_sum.toFixed(2));
            $("#blue_factor2").html('x' + parseFloat(100 / (parseFloat(obj.success.blue)*100)).toFixed(2));
            $("#blue_sum2").html(obj.success.blue_sum.toFixed(2));
          }
          if(obj.success.red > 0 && obj.success.blue > 0 && obj.success.bets > 0){
            $('title').text('🔴 ' + Math.round(parseFloat(obj.success.red)*100) + ' % ⚔ ' + Math.round(parseFloat(obj.success.blue)*100) + '%' + ' 🔵');
          }else{
            $('title').text(site_name);
          }
          buildNoLimit(parseFloat(obj.success.blue));
          build3(parseFloat(obj.success.blue));
        }else{
            error(obj.error);
        }
      }catch(e){
        //error('Произошла ошибка');
      }
    },
    error: function(){
      //error('Произошла ошибка');
    }
    });
}

function getInfoJack() {
  $.ajax({
    type: 'POST',
    url: '../action.php',
    data: {
      'type': 'getInfoJack'
},
    success: function(data) {
   try {
       var obj = jQuery.parseJSON(data);
   } catch (e) {
     $('#myInfo').html(
       `
       <div class = "flex" style = "justify-content:space-between;">
          <h5 style="cursor: pointer;" onclick="faq()"><i class="fas fa-gavel" style="margin-right: 10px;"></i>Информация об игре</h5>
          <h5>
         Ставок: 0
          </h5>
       </div>
       <div class = "flex" style = "margin-bottom: 15px;margin-top: 10px;" >
     <h2 style = "">
     Банк: 0
     </h2>
       </div>

   <div class = "flex" style = "justify-content:space-evenly;">
       <h4 style = "color: #D1345B">
     Min: 0
       </h4>
       <div style="border-left: 1px solid;width: 1px;height: 35px;border-right: 1px solid;"></div>
       <h4 style = "color: #3454D1">
     Max: 0
       </h4>
       </div>
       `
     );
   }



      $(".canvasio").css('transition', '');
      $(".canvasio").css('transform', 'rotate(0deg)');

      try{
        if('success' in obj){

          let html = '';

          if (obj.off == 'yes') {
            $('.currentBets').html(obj.go);
          } else {
            i = 0;
            while (i < obj.go.length) {
              if (darkMode == 1 && obj.go[i][5].playerColorName == '#070707') {
                colorName = 'fff';
              } else {
                colorName = obj.go[i][5].playerColorName;
              }
            html +=
             `
             <div class="playerBet flexNot block" style = "border-left: 5px solid #${obj.go[i][0].color}!important;border: 0px solid" id = "game${obj.go[i][1].betId}"> <div class = "chances"> <div class = "percent flexNot"> ${obj.go[i][2].percent}% </div> <div class="tickets flexNot"> ${obj.go[i][3].tickets} </div> </div> <div class= "playerBetOne flexNot"> <img style = "width:64px;border-radius:100px;" src = "${obj.go[i][4].playerImg}" /><div style = "color:${colorName}" class = "pepkins">${obj.go[i][6].playerName}</div> </div> <div class="multiplier flexNot"> X${obj.go[i][7].multiplier} </div> <div class="bankBet flexNot"> <i class="fas fa-piggy-bank" style="color: #${obj.go[i][0].color};cursor: pointer;margin-right: 10px;" data-toggle="tooltip" title="" data-original-title="Ставка игрока"></i> <span style = "margin-left:5px">${obj.go[i][8].bet}</span> </div> </div>
            `

              i++
            }


            $('.currentBets').html(obj.go[0][9].infoBet+html);
          }



       if (obj.infoForCircle == undefined) {
         updateBanks([1,1,1],['#DC3C55','#E063C9','#5445EE']);
       } else {
         updateBanks(obj.infoForCircle.banks_agg,obj.infoForCircle.colors_agg, obj.infoForCircle.user_id);
       }

       if (obj.myInfo.maxBet == null || obj.myInfo.minBet == null) {
         maxBet = 0;
         minBet = 0;
       } else {
         maxBet = obj.myInfo.maxBet;
         minBet = obj.myInfo.minBet;
       }
       $('#myInfo').html(
         `
         <div class = "flex" style = "justify-content:space-between;">
            <h5 style="cursor: pointer;" onclick="faq()"><i class="fas fa-gavel" style="margin-right: 10px;"></i>Информация об игре</h5>
            <h5>
           Ставок: ${obj.myInfo.allBets}
            </h5>
         </div>
         <div class = "flex" style = "margin-bottom: 15px;margin-top: 10px;" >
       <h2 style = "">
       Банк: ${obj.myInfo.bank}
       </h2>
         </div>

     <div class = "flex" style = "justify-content:space-evenly;">
         <h4 style = "color: #D1345B">
       Min: ${obj.myInfo.minBet}
         </h4>
         <div style="border-left: 1px solid;width: 1px;height: 35px;border-right: 1px solid;"></div>
         <h4 style = "color: #3454D1">
       Max: ${obj.myInfo.maxBet}
         </h4>
         </div>
         `
       );


        }else{
            error(obj.error);
        }
      }catch(e){
        //error('Произошла ошибка');

      }
    },
    error: function(){
      //error('Произошла ошибка');
    }
    });
}

function validateBetSize(inp) {
    inp.value = inp.value.replace(/[,]/g, '.')
    .replace(/[^\d,.]*/g, '')
    .replace(/([,.])[,.]+/g, '$1')
    .replace(/^[^\d]*(\d+([.,]\d{0,2})?).*$/g, '$1');
}
function withdrawSelect() {
                $('#sub_wallet').val('');
                var e = $('#sub_list').val();
                if (e == 4 || e == 6) {
                    $('#sub_wallet').attr('placeholder', '+79123456789');
                }
                if (e == 4) {
                    $('#sub_wallet').attr('placeholder', '+79995556767');
                }
                if (e == 5) {
                    $('#sub_wallet').attr('placeholder', '220007XXXX785577');
                }
                if (e == 7) {
                    $('#sub_wallet').attr('placeholder', 'P1000000');
                }
                if (e >= 1 && e <= 3) {
                    if (e == 2) {
                        $('#sub_wallet').attr('placeholder', 'P1000000');
                    }
                    if (e == 1) {
                        $('#sub_wallet').attr('placeholder', '410011499718000');
                    }
                    if (e == 3) {
                        $('#sub_wallet').attr('placeholder', 'R123456789000');
                    }
                }
                if (e >= 9) {
                    if (e == 10) {
                        $('#sub_wallet').attr('placeholder', '512107XXXX785577');
                    } else {
                        $('#sub_wallet').attr('placeholder', '412107XXXX785577');
                    }
                }
            }
