<?php
include("../../assets/config.php");
if ( !empty($_COOKIE['sid']) ){
$selectaccount = mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'");
if ( $selectaccount->num_rows == 1 ){

if ( $sc = $selectaccount->fetch_array() ){

$balance = $sc['balance'];
$name = $sc['name'];
$ref_code = $sc['ref_code'];
}

$refcounts = mysqli_num_rows(mysqli_query($bsd, "SELECT * FROM users WHERE referer = '$ref_code'"));


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
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="block">
  <h3 class = "text eng39">Бонус <span style="cursor: pointer; font-size: .75em;margin-bottom:20px" onclick="more();">[<i class="far fa-hand-pointer" style="margin: 0 5px;"></i>Доп. бонусы ]</span></h3>
  <h6 class = "eng40" style = "margin-bottom:20px">Вступите <a href="<?=$vkgroup?>" target="_blank">в группу</a>, введите промокод и получите бонус</h6>
  <div class = "eng41">
    <input style = "margin-bottom:20px" id="promo" AUTOCOMPLETE="off" class="input flex" type="text" name="" value="" placeholder="Промокод">
  </div>
  <div class="g-recaptcha flex" data-sitekey="<?=$recaptchasite?>" style="margin-top: 5px;"></div>
  <div class="flexNot button buttonMode eng22" style="background-color: #070707;color: white;margin-top: 15px;" onclick="promo()">
    <i class="far fa-handshake" style="margin-right: 5px;"></i>Получить
  </div>
</div>
<div class="block">
  <h6 style = "font-size: 18px" class = "text"><span class = "eng42">Реферальный промокод</span> <i class="fas fa-users"></i> <?=$refcounts?></h6>
  <p class = "eng43" style="<?php if ( $_COOKIE['dark'] == 1 ){ echo 'color: rgb(0,0,0);'; } else { echo 'color: rgba(214,224,255,0.6);'; }?>margin-left: 18px;position: relative;top: 10px;">
      (1 акт = <?=$refsum?>р)
    </p>
  <input class="input flex" type="text" name="" value="<?=$ref_code?>" disabled style="margin-bottom: 5px; font-size: 1.25em;">
</div>
<div class="block">
      <h3 class = "text eng44" style = "margin-bottom:20px">Создать промокод</h3>
  <div class = "flex eng45" style = "margin-bottom:15px">
    <input style ="width:60%" id="createpromo" AUTOCOMPLETE="off" class="input flex" type="text" name="" value="" placeholder="Название от 3 до 10 символов">
    <input style = "width: 40%;margin-left: 15px" onkeyup="promo_minus()" AUTOCOMPLETE="off" class="input" type="text" name="" value="" placeholder="Кол-во" id="count">
  </div>
  <div class="flex">
    <div class = "eng46">
      <input  onkeyup="promo_minus()" AUTOCOMPLETE="off" class="input" type="text" name="" value="" placeholder="Награда" id="reward">
    </div>
    <div class="button buttonMode flexNot eng47" style="width: 50%;margin-left:15px;font-size: 15px;color: white;" onclick="createPromo()">
      <i class="fas fa-gift" style="margin-right: 10px;"></i>Создать(-<span id="promo_minus"></span>)
    </div>
  </div>

</div>
<script type="text/javascript">
// if (getCookie('lang') == 1 || langCheck == 1 ) {
//   language(1)
// } else {
//   language(2)
// }
function promo_minus(){
  $("#promo_minus").html($('#reward').val() * $('#count').val());
}
var promo_load = 0;
var promo_create = 0;
function promo(){

  if(promo_load == 1){
    error('Обработка запроса...');
    return;
  }
 $.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
      type: 'activateCode',
      recaptcha_response: $('.g-recaptcha-response').val(),
      code: $("#promo").val(),
},
beforeSend: function(){

promo_load = 1;

},
    success: function(data) {
      var obj = jQuery.parseJSON(data);
      promo_load = 0;
     if ( obj.msgType == "success" ){

        error("Вы успешно активировали код!", true);

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
function createPromo(){
  if(promo_create == 1){
    error('Обработка запроса...');
    return;
  }
  $.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
      'type': 'createPromo',
      'promo': $('#createpromo').val(),
      'count': $('#count').val(),
      'size': $('#reward').val(),
  },
    beforeSend: function() {
        promo_create = 1;
      $("#createpromo").val('');
    },
    success: function(data) {
      promo_create = 0;
      var obj = jQuery.parseJSON(data);
      if ( obj.msgType == "success" ){

          error(obj.msg, true);

      }else{

          error(obj.msg);

      }
    },
    error: function(){
      promo_create = 0;
      error('Произошла ошибка');
    }
    });
}
</script>
<?}?>