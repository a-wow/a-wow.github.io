<?php
include("assets/config.php");


if ( is_numeric($_GET['id']) ){

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

$selectgame = mysqli_query($bsd, "SELECT * FROM `games` WHERE id='$_GET[id]'");
if ( $selectgame->num_rows == 1 ){
if ( $sg = $selectgame->fetch_array() ){

$numgame = $sg['number'];
$useid = $sg['user_id'];
$bet = $sg['bet'];
$chance = $sg['chance'];
$color = $sg['color'];
$dropcolor = $sg['dropcolor'];
$date = $sg['data'];

if ( is_numeric($useid) ){

if ( $uis = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$useid'")->fetch_array() ){

$player = $uis['name'];

}

}

$ccolor = str_replace("red", "Красный", $color);$ccolor = str_replace("blue", "Синий", $ccolor);$cccolor = str_replace("red", "Красный", $dropcolor);$cccolor = str_replace("blue", "Синий", $cccolor);


}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BATTLE</title>
    <meta name = "description" content = "BATTLE - это первая онлайн-игра, где вы можете повысить не только свои шансы на победу, но и шансы всей команды." />
<meta name = "keywords" content = "батл кеш, battle, cash, battlecash, battle.legendary, battle.farm, battle.farm, battlegold командный, онлайн, игры" />
<meta name = "robots" content = "index,nofollow" />
<meta name="yandex-verification" content="c5838546c5165784" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="/assets/styles/jquery-ui.css">
<link rel="stylesheet" href="/assets/styles/jquery-ui.theme.css">
<script src="/assets/js/jquery-ui.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/js/script2.js?v=1.455521253512355154132325"></script>
<script type="text/javascript" src="/assets/js/slimscroll.js"></script>
<meta property=og:image content=https://battle.digital/static/100.png>
<script type="text/javascript" src = "/assets/js/Chart.min.js"></script>
<script src="/assets/socket.io/socket.io.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/styles/style.css?v=1.121332342323317">
<link rel="stylesheet" href="/assets/styles/dark.css?v=1.1322233336">
<link rel="stylesheet" href="/assets/styles/scrollbar1.css">
<link rel="stylesheet" href="/assets/styles/loader-1.css">
<script src="https://d3js.org/d3-path.v1.min.js"></script>
<script src="https://d3js.org/d3-shape.v1.min.js"></script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?158"></script>
<script src="/assets/js/jscolor.js"></script>
<meta name="viewport" content="width=900px">
  </head>
  <body>
    <script>
    $(function(){
      if (ios() == true) {
        $(".ios").hide();
      }
    })
admin = 1;
if(getCookie('dark') == 1){
dark_Mode();
darkMode = 1
}
    </script>
    <div class="gameCheck">
      <div class="block1Game flex" style = "justify-content: space-around;">
        <div class="circleGame">
            <div class="roulette no-copy">
              <div class="counter flex">
                <div class="playGame" style = "z-index:2;"><i class="fas fa-play"></i></div>
              </div>
              <svg class="UsersInterestChart" width="400" height="400">
                <linearGradient id="linear-red">
                  <stop offset="0%" stop-color="#FF005B"/>
                  <stop offset="100%" stop-color="#B81681"/>
                </linearGradient>
                <linearGradient id="linear-blue">
                  <stop offset="0%" stop-color="#00BBFF"/>
                  <stop offset="100%" stop-color="#4579F5"/>
                </linearGradient>
                <linearGradient id="linear-redWhite">
                  <stop offset="0%" stop-color="#E88537"/>
                  <stop offset="100%" stop-color="#DC3376"/>
                </linearGradient>
                <linearGradient id="linear-blueWhite">
                  <stop offset="0%" stop-color="#5D38C5"/>
                  <stop offset="100%" stop-color="#30B8FB"/>
                </linearGradient>
                <g class="chart" transform="translate(200, 200)">
                  <g class="timer" transform="translate(0,0)">
                  <g class="bets" id="circle" style="transition: ; transform: rotate(0deg);">
                    <path id="blue" fill="url(#linear-blue)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 1;"></path>
                    <path id="red" fill="url(#linear-red)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 1;"></path>
                    <!-- <path id="blue2" fill="url(#linear-blue)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.1;"></path> -->
                    <path id="red2" fill="url(#linear-red)" stroke-width="5px" d="" transform="rotate(0)" style="opacity: 0.2;"></path>
                  </g>
                </g>
              </g>
                  <circle cx="200" cy="41" r="7" stroke="#00c0c0" fill="#1fffff" stroke-width="2"></circle>
              </svg>
              <div class="counter counterW cwhite ios" style="z-index:1!important;">

              </div>
              <div class = "cBlue ios">

              </div>
            </div>
        </div>
        <div class="infoGame block" style = "width:50%;">
          <h4 style = "text-align: right;"><?=$date?></h4>
          <h3>Игрок: <span><?=$player?></span></h3>
          <h3>Ставка: <span><?=$bet?> монет</span></h3>
          <h3>Цвет: <span><?=$ccolor?></span></h3>
          <h3>Выпавший цвет: <span><?=$cccolor?></span></h3>
          <h3 style = "margin-bottom:15px;">Число: <span><?=$numgame?></span></h3>
        </div>
      </div>

    </div>
  </body>

  <script>
    var per = <?=$chance?>;
    var color = '<?=$color?>';

  if(color == "blue") {
    var chance = (0 + per) / 100;
  }
  if(color == "red") {
    var chance = (100 - per) / 100;
  }
  build(chance);
$("#circle").css('transition', 'transform 3.9s cubic-bezier(0.15, 0.15, 0, 1)');
$("#circle").css('transform', 'rotate(' + (3600 + <?=$numgame?> * 0.36) + 'deg)');
  </script>
</html>
<?}}?>