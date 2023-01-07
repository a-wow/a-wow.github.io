<?php
include("../../assets/config.php");

if ( !empty($_COOKIE['sid']) ){
$selectaccount = mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'");
if ( $selectaccount->num_rows == 1 ){

if ( $sc = $selectaccount->fetch_array() ){
$uid  = $sc['id'];
$balance = $sc['balance'];
$name = $sc['name'];
$btake = $sc['bonustaked'];

}
$now = time();
$needbonus = $btake + 84600;
if ( $now >= $needbonus ){

$bonus = '<h5 class = "eng51" id="bonustext" style="color: #6EC932;text-align: center;"><i class="fas fa-lock-open icon"></i>Бонус уже доступен!</h5><div id="timeBonusBut" class="button buttonMode flex eng22" style="margin-top:15px;background-color: #070707; color: white; margin: 10px auto;" onclick="timeBonus()"><i class="far fa-handshake" style="margin-right: 5px;"></i>Получить</div>';

}else{
$ostalos = $needbonus - $now;
$ostalos = floor($ostalos / 60 + 30);

$bonus = "<h5 style=\"color: #D1345B;text-align: center;\"><i class=\"fas fa-lock icon\"></i><span class=\"eng52\">До получения бонуса осталось - $ostalos минут</h5>";

}

}


}

if ( empty($_COOKIE['sid']) || mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'")->num_rows < 1){

?>

 <script>

  $.ajax({
    type: 'POST',
    url: '../modules/menu/auth.php',
    data: {
      'redirict': 'main'
},
    success: function(data) {
      $('#active').html(data);
    }
    });

</script>

<?

}else{
?>
<div class="block">

  <h3 class = "text eng48">Ежедневный бонус</h3>
  <h6 class = "eng49">Не забудьте вступить <a href="<?=$vkgroup?>" target="_blank">в группу</a></h6>
  <h6 clss = "eng50" style="font-size: 0.85em; line-height: 1em;"><i class="fas fa-circle icon"></i>Стандартный: 0.1</h6>
<?php
$query = mysqli_query($bsd, "SELECT * FROM `prefix` ORDER by bonussize ASC");

while ( ($qq = $query->fetch_array() )){


$p.= "<div style=\"display: flex; align-items: center;  justify-content: center;\">

  <h6 style=\"cursor: pointer;font-size: 0.85em;line-height: 1em;/* text-align: center!important; */width: 50%;\" onclick=\"faq()\"><i class=\"fas fa-circle icon\"></i><color style=\"color: $qq[color];\">[$qq[prefix]]</color> $qq[bonussize]</h6></div>";

}

echo $p;

?>



  <?=$bonus?></div>

<script type="text/javascript">
// if (getCookie('lang') == 1 || langCheck == 1 ) {
//   language(1)
// } else {
//   language(2)
// }
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
function promo_minus(){
  $("#promo_minus").html($('#reward').val() * $('#count').val());
}
var promo_load = 0;
var vk_load = 0;
function timeBonus(){
  if(promo_load == 1){
    error('Обработка запроса...');
    return;
  }
   $.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
      'type': 'dailyBonus',
},
beforeSend: function(){

promo_load = 1;

},
    success: function(data) {
      var obj = jQuery.parseJSON(data);
      promo_load = 0;
     if ( obj.msgType == "success" ){

        error(obj.msg, true);

     }else{

        error(obj.msg);

     }
    },
    error: function(){
      promo_load = 0;
      error('Произошла ошибка');
    }
    });
}
var sendwait;
function cashback(){
  if (sendwait == 1){
      return error('Обрабатываем запрос...');
    }
  $.ajax({
    type: 'POST',
    url: '/api/cashback',
    beforeSend: function() {
      sendwait = 1;
    },
    contentType: "application/json",
    data: JSON.stringify({
        'token': getCookie('token')
  }),
    success: function(data) {
      var obj = data;
      sendwait = 0;
      try{
        if('success' in obj){
          error(obj.success.text,true);
          $("#cashbackWindow").html(`
            Цель на сегодня выполнена
            Обновление цели в 23:59 по мск каждый день
            `)
        }else{
            error(obj.error);
        }
      }catch(e){
        error('Произошла ошибка');
      }
    },
    error: function(){
      error('Произошла ошибка');
    }
    });
}
function vkbonus(){
  if(vk_load == 1){
    error('Обработка запроса...');
    return;
  }
  $.ajax({
    type: 'POST',
    url: '/api/likeBonus',
    beforeSend: function() {
      vk_load = 1;
    },
    contentType: "application/json",
    data: JSON.stringify({
        'token': getCookie('token')
  }),
    success: function(data) {
      vk_load = 0;
      var obj = data
      try{
        if('success' in obj){
          error(obj.success.text,true);
        }else{
            error(obj.error);
        }
      }catch(e){
        error('Произошла ошибка');
      }
    },
    error: function(){
      vk_load = 0;
      error('Произошла ошибка');
    }
    });
}
</script>
<?}?>