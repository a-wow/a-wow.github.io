<?php
include("assets/config.php");

if ( !empty($_COOKIE['sid']) ){
$selectaccount = mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'");
if ( $selectaccount->num_rows == 1 ){

if ( $sc = $selectaccount->fetch_array() ){

$balance = $sc['balance'];
$name = $sc['name'];
$uprava = $sc['prava'];
$uid = $sc['id'];
$uava = $sc['img'];
$uban = $sc['ban'];
}

}

}

?>

<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=$sitename?></title>
    <meta name = "description" content = "<?=$sitename?> - это первая онлайн-игра, где вы можете повысить не только свои шансы на победу, но и шансы всей команды." />
<meta name = "keywords" content = "<?=$sitename?>, <?=$sitedomain?>, <?=$sitedomain?> командный, онлайн, игры" />
<meta name = "robots" content = "index,nofollow" />
<meta name="yandex-verification" content="c5838546c5165784" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

<script>var msgcounts = <?php echo mysqli_query($bsd, "SELECT * FROM chat")->num_rows ?>;</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/assets/js/script2.js?v=1.455521253512355154132325"></script>
<script type="text/javascript" src="/assets/js/slimscroll.js"></script>
<meta property=og:image content=/assets/static/100.png>
<script type="text/javascript" src = "/assets/js/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="/assets/styles/jquery-ui.css">
<link rel="stylesheet" href="/assets/styles/jquery-ui.theme.css">
<script src="/assets/js/jquery-ui.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<script src="/assets/socket.io/socket.io.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/styles/style.css?v=1.121332342323317">
<link rel="stylesheet" href="/assets/styles/dark.css?v=1.1322233336">
<link rel="stylesheet" href="/assets/styles/scrollbar1.css">
<link rel="stylesheet" href="/assets/styles/loader-1.css">
<script src="https://d3js.org/d3-path.v1.min.js"></script>
<script src="https://d3js.org/d3-shape.v1.min.js"></script>
<link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?158"></script>
<script src="/assets/js/jscolor.js"></script>
<meta name="viewport" content="width=900px">
  </head>
  <body class="wrapper" style="">
    <div class="screen flex"><div class="backScreen"></div>
    <div class="mainlogo preDark" style="display: none;background: url(/assets/static/nightLogo2.png) no-repeat;background-size: 100%;height: 115px;width: 115px;margin-right: 5px;cursor: pointer;z-index: 10;position: absolute;"></div>
    <div class="mainlogo preWhite" style="display:block;background: url(/assets/static/nightLogo2.png) no-repeat;background-size: 100%;height: 115px;width: 115px;margin-right: 5px;cursor: pointer;z-index: 10;position: absolute;"></div>
      <div class="col-lg-4 col-md-6 col-sm-12" style="display: block;height: 377px;min-height: 466px;max-height: 466px;z-index: 10;">
          <div class="loader-wrapper" id="loader-1" style="height: 100%;">
          <div id="loader"></div>
      </div>
        </div>
      </div>
  <div class = "ochko">

  <div class="block console" style = "display:none">
    <div class="offConsole" onclick = "offConsole()">
    <i class="fas fa-arrow-circle-up"></i>
    </div>
    <input type="text" class="input flex" id = "console">
  </div>
  <div class="error error-anim" id="error" style="display: none; border-radius: 2px;">
    Произошла ошибка. Повторите позже.
  </div>
  <script type="text/javascript">
    var error_timer;
    function error(text, type) {
      if(type == true){
        var er_icon = '<i class="fas fa-check" style="margin-right: 10px"></i>';
        $("#error").css('background-color', '#6EC932');
      }else{
        var er_icon = '<i class="fas fa-times" style="margin-right: 10px"></i>';
        $("#error").css('background-color', '#D1345B');
      }
      var cerror = document.getElementById("error");
      cerror.classList.remove("error-anim");
      void cerror.offsetWidth;
      cerror.classList.add("error-anim");
      clearTimeout(error_timer);
      $("#error").html(er_icon + text);
      $("#error").css('display', 'block');
      $("#error").css('left', '30px');
      error_timer = setTimeout(function(){
        $("#error").css('display', 'none');
      }, 2900);
    }
  </script>
  <!-- Interface -->

<div class="no-copy preload menunav" style = "margin-top: 30px;">
<?php if ( empty($_COOKIE['sid']) || mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'")->num_rows < 1){ ?>

 <div class="header flex" style="justify-content: left;">
      <div class="logo flex" style="justify-content: left; margin-left: 0;">
        <div style="background: url(../static/100.png) no-repeat; background-size: 100%; height: 30px; width: 30px; margin-right: 5px;"></div>
        <?=$sitename?>
      </div>
      <div class="auth" style="margin-left: auto;">
             <div id="uLogin2" style="max-width: 200px;width: 100%;cursor: pointer;color: white;margin: 10px auto;background: linear-gradient(56deg, #00ffffd9,#0088c9);border-radius: 12px;" class="button flex eng5" data-ulogin="display=buttons;fields=photo_big,first_name,last_name;mobilebuttons=0;redirect_uri=http%3A%2F%2F<?=$_SERVER['HTTP_HOST']?>/engine.php;"><a data-uloginbutton="vkontakte"><i class="fab fa-vk" style="margin-right: 10px;"></i>Войти через VK</a></div>
              <script src="//ulogin.ru/js/ulogin.js"></script>

          </div>
       </div>

<?}else{?>

 <div class="menu container-fluid" style="justify-content: space-evenly; margin-top: 10px;">
    <div class = "flex" style = "justify-content: space-between;">
      <div class="menu-item">
        <div style="width: 48px;height: 48px;" class="menu-circle V flexNot profileClass" onclick="main();">
        <?php
$ss = strlen($sitename);
$ss -=1;
$sitebukva = substr($sitename, 0, -$ss);
echo $sitebukva;
        ?>
        </div>
      </div>
      <!-- <div class="menu-item">
      <div class="menu-circle flexNot" onclick="quest();">
        <i class="fas fa-home icon"></i>
        <span class = "menuText eng8">Квесты</span>
        </div>
      </div> -->
      <div class="menu-item">
      <div class="menu-circle flexNot" onclick="add();">
        <i class="far fa-plus-square icon"></i>
        <span class = "menuText eng9">Пополнение</span>
        </div>
      </div>
      <div class="menu-item">
      <div class="menu-circle flexNot" onclick="sub();">
        <i class="far fa-minus-square icon"></i>
        <span class = "menuText eng10">Вывод</span>
      </div>
      </div>
      <div class="menu-item">
      <div class="menu-circle flexNot" onclick="bonus();">
        <i class="fas fa-gift icon"></i>
        <span class = "menuText eng11">Бонус</span>
        </div>
      </div>
      <div class="menu-item">
      <div class="menu-circle flexNot" onclick="faq();">
        <i class="fas fa-clipboard-list icon"></i>
        <span class = "menuText eng12">FAQ</span>
        </div>
      </div>
      <div class="menu-item">
        <div class="menu-circle flexNot" onclick="profile();">
          <div class="flex" onclick="profile();">
            <i class="fas fa-cog icon"></i>
            <span class = "menuText eng13">Настройки</span>
        </div>
        </div>
      </div>

      <div class="menu-item">
        <div class="menu-circle flexNot" onclick="exit();">
        <!-- <div class="ava" style="background-image: url(https://sun1-30.userapi.com/c852120/v852120273/1c03b7/4TMkMEw2hME.jpg?ava=1); margin-right: 10px;"></div> -->
        <i class="fas fa-sign-out-alt icon"></i>
          <span class = "menuText eng14">Выйти</span>
        </div>
      </div>
      <div class="menu-item">
        <div class="menu-circle flexNot">
        <div class="buttonec r" id="button-1" style="
"><input type="checkbox" class="checkbox"><div class="knobs"></div><div class="layer"></div>
          <span class = "menuText eng15">Темная</span>
</div>
<div class="buttonecD r" id="button-1d" style="display:none;
"><input type="checkbox" class="checkbox"><div class="knobs"></div>
        </div>
<span class = "menuText eng15">Темная</span>
</div>

        </div>
      </div>
    </div>

<?}?>
    </div>
    <!-- <div class="flex battle" onclick="main();">
      <div class="mainlogo" style="background: url(/assets/static/100.png) no-repeat;background-size: 100%;height: 70px;width: 70px;margin-right: 5px; cursor: pointer;"></div>
  </div> -->
  <!-- <div class="flex jackec" onclick="jackPotniy();">
    <div class="mainlogo" style="background: url(/assets/static/logos_bat.png) no-repeat;background-size: 100%;height: 70px;width: 75px;margin-right: 5px; cursor: pointer;"></div>
</div> -->
<div class="flex battleDark" onclick="main();" style = "display:none">
  <div class="mainlogo" style="background: url(/assets/static/nightLogo2.png) no-repeat;background-size: 100%;height: 70px;width: 70px;margin-right: 5px;cursor: pointer;"></div>
</div>
<!-- <div class="flex jackecDark" onclick="jackPotniy();" style = "display:none">
<div class="mainlogo" style="background: url(/assets/static/nightLogo.png) no-repeat;background-size: 100%;height: 70px;width: 75px;margin-right: 5px;cursor: pointer;"></div>
</div> -->
</div>

<style>

.mainlogo{
  transition: transform 250ms ease-out;
}
.mainlogo:hover{
  transform: scale(1.1);
}
.menu-item{
   font-size: 20px;
}
@media (max-width: 1200px){
  .menu-item{
     font-size: 15px;
  }
}
</style>
    <!-- Content -->

    <script>
$(function(){
var darkMode = 0;
if(getCookie('dark') == 1){
dark_Mode();
darkMode = 1
}
// var langCheck;
// if (getCookie('lang') == 1 || langCheck == 1) {
//   language(1)
// } else {
//   language(2)
// }


if (darkMode == 1) {
$('.buttonec').hide();
$('.buttonecD').show();
} else {
  $('.buttonecD').hide();
  $('.buttonec').show();
}

$('.buttonecD').click(function(){
  console.log('darkoff')
  $('.buttonecD').hide();
  darkModeOff();
  $('.buttonec').show();
  // $('.buttonec').click(function(){
  //   $('.buttonec').hide();
  //   dark_Mode();
  //   $('.buttonecD').show();
  // })
})

$('.buttonec').click(function(){
      console.log('whiteoff')
  $('.buttonec').hide();
  dark_Mode();
  $('.buttonecD').show();
  // $('.buttonecD').click(function(){
  //   $('.buttonecD').hide();
  //   darkModeOff();
  //   $('.buttonec').show();
  // })
})
  $('[data-toggle="tooltip"]').tooltip()
});
</script>
<style id = "circleMain">

</style>
<?php if ($_COOKIE['modal'] != 1 ){ ?>
<div class="modalWindow">
  <div class="window">
    <h1>Внимание</h1>
    <ul>
      <li><p>Наш сайт расположен по адресу <span><?=$sitedomain?></span>. Будьте внимательны, когда пополняете баланс и переходите на сайт из поисковых систем.</p></li>
      <li><p>Участие в проекте является исключительно добровольным. Проект был создан в развлекательных целях. В его задачи <span>НЕ</span> входит заработок средств. Вносите только ту сумму, которую вам не жалко будет потерять в случае проигрыша.</p></li>
      <li><p><span>Никогда</span> не запускайте ботов в консоле разработчика(F12) и не передавайте свой секретный токен(SID). Администрация <span>НЕ</span> несет ответственности за взломы вашего аккаунта таким методом.</p></li>
      <li><p>Изучите правила сервиса в разделе FAQ</p></li>
    </ul>
    <div class="button buttonMode flexNot" onClick="modalOff()">Понятно</div>
  </div>
</div>
<? } ?>

<div class="modal-wrapper" onclick = "closeWindow()">

</div>
<div class = "modal" style = "display:none">
<img src="static/close.svg" class="close" onclick="closeWindow()" />
<div class = "flex">

</div>
</div>

<style>
  .modalWindow{
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.3);
    width: 100vw;
    height: 100vh;
    z-index: 99999;
  }
  .modalWindow .window{
    width: 700px;
    background: rgba(0, 17, 43, 0.68);
    border-radius: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 0 20px;
  }
  .window h1{
    color: #D1345B;
    text-align: center;
  }
  .window p {
    font-size: 1.2em;
  }
  .modalWindow .button{
    background-color: #3454D1;
    margin: 20px auto 20px auto;
    opacity: 0;
    animation: 250ms appear ease 3s forwards;
    visibility: hidden;
  }
  .modalWindow li span{
    color: #D1345B;
  }
  @keyframes appear {
    0%{
      visibility: visible;
      opacity: 0;
    }
    100%{
      opacity: 1;
      visibility: visible;
    }
  }
</style>

<div class="main preload">
  <div class="container-fluid">
    <div class="grid">
      <div class="leftBlockM" id="preloader" style="display: none; height: 466px; min-height: 466px; max-height: 466px; margin-bottom: 50px;">
        <div class="loader-wrapper" id="loader-1" style="height: 100%;">
        <div id="loader"></div>
    </div>
      </div>
      <div class="leftBlockM" id="active" style="display: block; height: 466px; transform: scale(1); ">

   <script>

  $.ajax({
    type: 'POST',
    url: '../modules/menu/main.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
    }
    });

</script>
  <div class="block battleMainButton">
    <h4 style="cursor: pointer;margin-bottom: 20px;" onclick="faq()" class = "text eng3"></i>Честная игра</h4>
    <div class = "flex">
      <div class="honestBlock hR">
        <div id="red_persent" class="fair-item no-copy flex" style="">
          <i class="fas fa-question"></i>
        </div>
        <div class="fair-item-bottom flex" style = "  font-family: Montserrat;
  font-size: 14px;
  font-weight: 500;
  line-height: 24px;">
          1-<span id="red_tickets"><i class="fas fa-question"></i></span>
        </div>
      </div>
      <div style = "width:1%;">

      </div>
      <div class="honestBlock hB">
        <div id="blue_persent" class="fair-item no-copy flex" style="">
          <i class="fas fa-question"></i>
        </div>
        <div class="fair-item-bottom flex" style = "  font-family: Montserrat;
  font-size: 14px;
  font-weight: 500;
  line-height: 24px;">
          <span id="blue_tickets"><i class="fas fa-question"></i></span>-1000
        </div>
      </div>
    </div>
  </div>
  <div class="block battleNoLimit" style = "display:none">
    <h4 style="cursor: pointer;margin-bottom: 20px;" onclick="faq()" class = "text eng3"></i>Честная игра</h4>
    <div class = "flex">
      <div class="honestBlock hR">
        <div id="red_persent2" class="fair-item no-copy flex" style="">
          <i class="fas fa-question"></i>
        </div>
        <div class="fair-item-bottom flex" style = "  font-family: Montserrat;
  font-size: 14px;
  font-weight: 500;
  line-height: 24px;">
          1-<span id="red_tickets2"><i class="fas fa-question"></i></span>
        </div>
      </div>
      <div style = "width:1%;">

      </div>
      <div class="honestBlock hB">
        <div id="blue_persent2" class="fair-item no-copy flex" style="">
          <i class="fas fa-question"></i>
        </div>
        <div class="fair-item-bottom flex" style = "  font-family: Montserrat;
  font-size: 14px;
  font-weight: 500;
  line-height: 24px;">
          <span id="blue_tickets2"><i class="fas fa-question"></i></span>-1000
        </div>
      </div>
    </div>
  </div>
  <div class="block battleMainButton">
    <h4 style = "margin-bottom:20px" class = "text eng4">Последние игры</h4>
    <div class="flex" style="margin-bottom: 10px;" id="history">
      <a href="/game.php?id=1314933" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game.php?id=1314932" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game.php?id=1314931" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game.php?id=1314930" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game.php?id=1314929" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game.php?id=1314928" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game.php?id=1314927" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a>    </div>
  </div>
  <div class="block battleNoLimit" style = "display:none">
    <h4 style = "margin-bottom:20px" class = "text eng4">Последние игры</h4>
    <div class="flex" style="margin-bottom: 10px;" id="history2">
      <a href="/game2.php?id=2339" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game2.php?id=2338" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game2.php?id=2337" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game2.php?id=2336" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game2.php?id=2335" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a><a href="/game2.php?id=2334" target="_blank"><div style = "position:relative"><input class="lastgame B" style="background: #F4F7FF" ><div style = "color:#6883DD"class = "textL Btext">B</div></div></a><a href="/game2.php?id=2333" target="_blank"><div style = "position:relative"><input class="lastgame R" style="background: #FFF3F3" ><div style = "color:#E95B4C"class = "textL Rtext">R</div></div></a>    </div>
  </div>
<script type="text/javascript">
// if (getCookie('lang') == 1) {
//   language(1)
// } else {
//   language(2)
// }
    $(function () {
      getInfo();
      getInfo2();
    });
</script>
      </div>
        <div class="circleBlock main-block flex" style="margin-top: 10%;align-items: baseline;">
                      <div class="roulette no-copy">
            <div class="counter flex">
              <span id="timer"><i class="fas fa-hourglass-start"></i></span>
            </div>
           <svg class="UsersInterestChart" width="400" height="400">
              <linearGradient id="linear-red">
                <stop offset="0%" stop-color="#FF005B"></stop>
                <stop offset="100%" stop-color="#B81681"></stop>
              </linearGradient>
              <linearGradient id="linear-blue">
                <stop offset="0%" stop-color="#00BBFF"></stop>
                <stop offset="100%" stop-color="#4579F5"></stop>
              </linearGradient>
              <linearGradient id="linear-redWhite">
                <stop offset="0%" stop-color="#E88537"></stop>
                <stop offset="100%" stop-color="#DC3376"></stop>
              </linearGradient>
              <linearGradient id="linear-blueWhite">
                <stop offset="0%" stop-color="#5D38C5"></stop>
                <stop offset="100%" stop-color="#30B8FB"></stop>
              </linearGradient>
              <g class="chart" transform="translate(200, 200)">
                <g class="timer" transform="translate(0,0)">
                <g class="bets" id="circle" style="transform: rotate(0deg);">
                  <path id="blue" fill="url(#linear-blue)" stroke-width="5px" d="M1.1021821192326179e-14,-180A180,180,0,1,1,-11.532628389071352,179.6301714146028L-10.571576023315405,164.6609904633859A165,165,0,1,0,1.0103336092965664e-14,-165Z" transform="rotate(0)" style="opacity: 1;"></path>
                  <path id="red" fill="url(#linear-red)" stroke-width="5px" d="M-11.532628389071352,179.6301714146028A180,180,0,0,1,-3.3065463576978534e-14,-180L-3.031000827889699e-14,-165A165,165,0,0,0,-10.571576023315405,164.6609904633859Z" transform="rotate(0)" style="opacity: 1;"></path>
                  <!-- <path id="blue2" fill="url(#linear-blue)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.1;"></path> -->
                  <!-- <path id="red2" fill="url(#linear-red)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.2;"></path> -->
                </g>
              </g>
            </g>
            <!-- <circle cx="200" cy="41" r="7" stroke="#00c0c0" fill="#1fffff" stroke-width="2"></circle> -->
            <polygon points="200,30 220,80 180,80" style="fill:#070707;stroke:white;stroke-width:2"></polygon>
            </svg>
            <div class="counter2 counterW cwhite ios" style="">

            </div>
            <div class = "cBlue ios">

            </div>
          </div>
          <div class="roulette2 no-copy" style = "display:none">
            <div class="counter flex">
              <span id="timer2"><i class="fas fa-hourglass-start"></i></span>
            </div>
            <svg class="UsersInterestChart" width="400" height="400">
              <linearGradient id="linear-red2">
                <stop offset="0%" stop-color="#FF005B"/>
                <stop offset="100%" stop-color="#B81681"/>
              </linearGradient>
              <linearGradient id="linear-blue2">
                <stop offset="0%" stop-color="#00BBFF"/>
                <stop offset="100%" stop-color="#4579F5"/>
              </linearGradient>
              <linearGradient id="linear-redWhite2">
                <stop offset="0%" stop-color="#E88537"/>
                <stop offset="100%" stop-color="#DC3376"/>
              </linearGradient>
              <linearGradient id="linear-blueWhite2">
                <stop offset="0%" stop-color="#5D38C5"/>
                <stop offset="100%" stop-color="#30B8FB"/>
              </linearGradient>
              <g class="chart" transform="translate(200, 200)">
                <g class="timer" transform="translate(0,0)">
                <g class="bets" id="circle2" style="transition: ; transform: rotate(0deg);">
                  <path id="blue2" fill="url(#linear-blue2)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 1;"></path>
                  <path id="red_2" fill="url(#linear-red2)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 1;"></path>
                  <!-- <path id="blue2" fill="url(#linear-blue)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.1;"></path> -->
                  <!-- <path id="red3" fill="url(#linear-red2)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.2;"></path> -->
                </g>
              </g>
            </g>
            <!-- <circle cx="200" cy="41" r="7" stroke="#00c0c0" fill="#1fffff" stroke-width="2"></circle> -->
            <polygon points="200,30 220,80 180,80" style="fill:#070707;stroke:white;stroke-width:2" />
            </svg>
            <div class="counter2 counterW cwhite ios" style="">

            </div>
            <div class = "cBlue ios">

            </div>
          </div>
          <div class = "jackPotniy" style = "display:none">
            <div class="counter flex">
              <span id="timerJack" class = "flex" style="-webkit-animation: blink 2s linear infinite; animation: blink 2s linear infinite"><i class="fas fa-hourglass-start"></i></span>
            </div>

<div>
  <svg style="
        position: absolute;
        top: -8px;
        left:50%;
        transform: translate(-50%, 0);
        z-index: 1;
    " class="flex"><polygon points="151,20 125,70 175,70" style="fill:#070707;stroke:white;stroke-width:2;"></polygon></svg>
  <div class = "canvasio">
            <canvas width="400" height="400" id = "myChart"></canvas>
  </div>
</div>
          </div>
        </div>


      <div class="chatM">
        <div class="chat block" style="word-wrap: break-word;">

          <div class="chattop" style="justify-content: left;padding: 0 20px;margin-bottom: 25px;">
            <div class = "flex" style = "
    margin: 0;
    justify-content: space-between;
">
              <div class = "flexNot">
                <h3 class = "chatText eng17" style = "
    color: rgba(255,255,255,0.8);
    font-family: Montserrat;
    font-weight: 600;
    line-height: 28px;
">Чат</h3>
                <div class="online" style="">
                  <svg id = "circleOnline" style="
    width: 19px;
    height: 30px;
">
    <circle cx="12" cy="13" r="4" stroke="#00c0c0" fill="#1fffff" stroke-width="2"></circle>
    </svg>
                  <span id="online"></span>
                </div>
              </div>
              <div class = "flexNot">
                <i class="fas fa-arrow-down grayText" style="cursor: pointer;margin-left: 10px; font-size: 1.75em" data-toggle="tooltip" data-original-title="Автоскролл" onclick="autoscroll();" id="autoscroll"></i>
                <a data-toggle="collapse" data-target="#hide_message"><hr class = "grayLine" style="
    width: 24px;
    height: 3px;
    background: rgba(214,224,255,0.4);
    margin-left: 25px;cursor:pointer;
"></a>
              </div>
            </div>
          </div>
          <div class="collapse" id="hide_message">
            <div id="messagesblock">
          <div class="message-block" style="padding: 0 5px;" id="message_block">


            <?php
      $query = ("SELECT * FROM `chat`");
      $result = mysqli_query($bsd, $query);

    while(($chat = $result->fetch_array() )){
    $mess = $chat['msg'];
     $user_id = $chat['user_id'];
     if ( $user_id != 0 ){
     $rres = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$user_id'");
      if ( $cui = $rres->fetch_array() ){
     $chatLogin = $cui['name'];
     $colorNick = $cui['namecolor'];
     $avaimg = $cui['img'];
     $banned = $cui['ban'];
     $praava = $cui['prava'];
     $vkurl = $cui['vk_url'];
     $usid = $cui['id'];
     if ( $praava == 1 || $praava == 2 ){

$crown = "<adm><i class=\"fas fa-crown\"></i> </adm>";

}else{

  $crown = "";
}
if ( empty($colorNick) ){
if ( $_COOKIE['dark'] == 1 ){$rgba = 'rgb(0, 0, 0);';}else{$rgba = 'rgb(255, 255, 255);';}
}else{
$rgba = "#$colorNick";
}


$msgid = $chat['id'];


$r = mysqli_query($bsd, "SELECT SUM(size) FROM `deposits` WHERE user_id = '$user_id'")->fetch_array()['SUM(size)'];
if ( empty($r) ){$r = 0;}
$qqqqqqq = mysqli_query($bsd, "SELECT * FROM `prefix` WHERE deposit <= '$r' ORDER BY `deposit` DESC LIMIT 1");
$pr = $qqqqqqq->fetch_array();
   $pcolor = htmlspecialchars($pr['color']);
        $prefixx = htmlspecialchars($pr['prefix']);
        if ( $qqqqqqq->num_rows >= 1 ){
  $prefix = '<color style="color: '.$pcolor.'">['.$prefixx.']</color>';
}else{
$prefix = "";
}
   }else{
$chatLogin = 'Никто';
$avaimg = '.';

   }
}



if ( $user_id == 0 ){

if ( $uprava == 1 || $uprava == 2 ){

$icon = "<i class=\"fas fa-trash-alt chaticon\" style=\"color: #D1345B\" onclick=\"deleteMessage($msgid)\"></i>";
}

 $p.="<div class=\"message-item\" message_id=\"$msgid\">
    <div class=\"flex\" style=\"align-items: flex-end;justify-content: flex-start\">
        <div class=\"\" ><img class=\"ava\" src='https://sun9-43.userapi.com/c845017/v845017490/1e5618/bec1k2fSfUc.jpg'></div>
        <div class=\"block blueB\" style=\"align-items: flex-end;width:auto;border-bottom-left-radius:0;margin-bottom:0;padding: 20px;padding-left: 20px;\">

            <div class=\"message-text\" style=\"color: #fff; text-align: right;\">$mess $icon</div>

        </div>
    </div>
</div>";
}else{
if ( $uprava == 1 || $uprava == 2 ){

if ( $banned == 2 ) { $banicon = '<i class="fas fa-lock chaticon" style="color: #3454D1; margin-right: 5px;" onclick="unban('.$user_id.')"></i>'; }else{ $banicon = '<i class="fas fa-exclamation-circle chaticon" style="color: #850000" onclick="warn('.$user_id.')"></i>';}

 $p.="<div class=\"message-item\" message_id=\"$msgid\">
    <div class=\"flex\" style=\"align-items: flex-end;justify-content: flex-start\">
        <div class=\"\" style=\"cursor: pointer;\" onclick=\"window.open('$vkurl')\"><img class=\"ava\" src='".$avaimg."'></div>
        <div class=\"block\" style=\"align-items: flex-end;width:auto;border-bottom-left-radius:0;margin-bottom:0;padding: 10px;padding-left: 20px;\">
            <div class=\"colorit message-name\" style=\"color: $rgba\" data-toggle=\"tooltip\" data-html=\"true\" title=\"\" style=\"cursor:pointer;\" data-original-title=\"ID: $user_id\">
               $prefix $crown $chatLogin <i class=\"fas fa-trash-alt chaticon\" style=\"color: #D1345B\" onclick=\"deleteMessage($msgid)\"></i>$banicon</div>
            <div class=\"message-text\">$mess</div>
        </div>
    </div>
</div>";

}else{


     $p.="<div class=\"message-item\" message_id=\"$msgid\">
    <div class=\"flex\" style=\"align-items: flex-end;justify-content: flex-start\">
        <div class=\"\" style=\"cursor: pointer;\" onclick=\"window.open('$vkurl')\"><img class=\"ava\" src='".$avaimg."'></div>
        <div class=\"block\" style=\"align-items: flex-end;width:auto;border-bottom-left-radius:0;margin-bottom:0;padding: 10px;padding-left: 20px;\">
            <div class=\"colorit message-name\" style=\"color: $rgba\">
               $prefix $crown $chatLogin</div>
            <div class=\"message-text\">$mess</div>
        </div>
    </div>
</div>";
    }
}
}

echo $p;
    ?>
            <script> admin = 0;</script>          </div></div>
            <? if ( $uban == 2 ){ ?>
              <div class="chat-panel">
    <h6 class="eng7" style="font-weight: 500; text-align: center;"><i class="fas fa-lock" style="margin-right: 10px;"></i>Чат заблокирован. <span style="color: #3454D1; cursor: pointer;" onclick="chat_unlock()">Разблокировать(<i class="fas fa-coins" style="margin: 2px;"></i> -<?=$chatunbansum?>)</span></h6>
</div>

                        <? }else{ ?>
                           <div class="chat-panel">
                          <input maxlength="100" class="chat-input" type="text" name="" value="" onkeyup='$("#chatMessage").val($("#chatMessage").val().replace(/[<>\\]/i, ""))' placeholder="Введите сообщение" id="chatMessage">          </div>
                          <?}?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

var timersend = 0;
var intid = "";
 function modalOff(){
    var date = new Date(Date.now() + 604800000);
    setCookie('modal', 1, date.getFullYear(), date.getMonth(), date.getDate());
    $('.modalWindow').css('display', 'none');
  }
  function chat_unlock(){

   $.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "chatUnlock",
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
            error("Вы успешно разблокированы в чате!", true);
            setTimeout(function(){location.reload()},1000);
}
if ( obj.msgType == "error" ){

error(obj.msg);

}

    },
    error: function(){
      error("Произошла ошибка");
    }
    });

  }
  function deleteMessage(msgid){

$.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "deleteMsg",
        messid: msgid,
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
            error("Сообщение удалено!", true);
}
if ( obj.msgType == "error" ){

error(obj.msg);

}

    },
    error: function(){
      error("Произошла ошибка");
    }
    });

  }
  function warn(userid){

$.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "warn",
        userid: userid,
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
            error(obj.msg, true);
}
if ( obj.msgType == "error" ){

error(obj.msg);

}

    },
    error: function(){
      error("Произошла ошибка");
    }
    });

  }
  function unban(userid){

$.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "unban",
        userid: userid,
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
 error("Пользователь разблокирован!", true);
}
if ( obj.msgType == "error" ){
     error(obj.msg);


}

    },
    error: function(){
      error("Произошла ошибка");
    }
    });

  }

function addmsg(){

var mess = $("#chatMessage").val();
if ( timersend == 0 ){
  timersend = 1;
$.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "addMsg",
        mess: mess,
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
            error("Сообщение отправлено", true);
            $("#chatMessage").val("");
               var chat_scroll = document.getElementById("message_block");
    setTimeout(function(){

      chat_scroll.scrollTop = chat_scroll.scrollHeight;
    }, 1000);
              $("#chatMessage").attr("placeHolder", "Ожидайте...");
              $("#chatMessage").prop("disabled", "disabled");
              timersend = 0;
              intid = setInterval(function(){

            ++timersend;

                  if ( timersend == 5 ){
                      timersend = 0;
                      clearInterval(intid);
                      $("#chatMessage").attr("placeHolder", "Введите сообщение");
                      $("#chatMessage").prop("disabled", "");

                  }else{
                      $("#chatMessage").attr("placeHolder", "Ожидайте...");
                      $("#chatMessage").prop("disabled", "disabled");

                  }

                }, 1000);

$('.message-block').stop().animate({
            scrollTop: $('.message-block')[0].height
        }, 800);
       $('.message-block').stop().animate({
            scrollTop: $('.message-block')[0].height
        }, 800);

}
if ( obj.msgType == "error" ){

error(obj.msg);

}

    },
    error: function(){
      error("Произошла ошибка");
    }
    });
}
}

setInterval(function(){
  $.ajax({
    type: 'POST',
    url: 'engine.php',
    data: {
        type: "messagesCount",
    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
        if ( obj.count > msgcounts && obj.count !== undefined && obj.count !== null || obj.count < msgcounts ){

            msgcounts = obj.count;
             $.ajax({
    url: "engine.php",
    dataType: "html",
    type: "POST",
    data: {
      type: "messagesGet",
    },
    success: function(response){
      obj =  $.parseJSON(response);



      $(".message-block").html(obj.chat);
      if ( as == 0 ){
   var chat_scroll = document.getElementById("message_block");
    chat_scroll.scrollTop = chat_scroll.scrollHeight;

     }
    }
  });
        }
    },
    error: function(){
      error('Произошла ошибка');
    }
    });
}, 1000);
            </script>
<script type="text/javascript">
  var as = 0;
var darkMode = 0;
if(getCookie('dark') == 1){
dark_Mode();
darkMode = 1
}
var chatBlock = [];
if (ios() == true) {
  $(".ios").hide();
}
if ( as == 0 ){
 if (darkMode == 1) {
      $("#autoscroll").css('color', '#4F7AEC');
    } else {
      $("#autoscroll").css('color', '#1fffff');
    }

}
function autoscroll() {
  if(as == 1){
    as = 0;
    if (darkMode == 1) {
      $("#autoscroll").css('color', '#4F7AEC');
    } else {
      $("#autoscroll").css('color', '#1fffff');
    }
  }else{
    as = 1;
    var chat_scroll = document.getElementById("message_block");
    chat_scroll.scrollTop = chat_scroll.scrollHeight;
    if (darkMode == 1) {
      $("#autoscroll").css('color', 'rgb(120, 119, 124)');
    } else {
      $("#autoscroll").css('color', 'rgba(214,224,255,0.4)');
    }
  }
}
$('.collapse').collapse();
$('#chatMessage').keyup(function(){
    if(event.keyCode==13 && $('#chatMessage').val().length > 0 )
       {
         addmsg();
       }
});
</script>
    <!-- Footer -->
    <!-- VK Widget -->
<div id="vk_community_messages"></div>
<!-- <script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 180247559, {disableExpandChatSound: "1",disableButtonTooltip: "1"});
</script> -->
    </div>
  </body>

<?php if ( $_COOKIE['dark'] == 1 ){

echo "<script> $('body').css({
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
  $(\".R\").removeClass('rAdd')
  $(\".B\").removeClass('bAdd')
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
 $('body').addClass('dark')";
}?>

</html>
