<?php
include("../../assets/config.php");
if ( !empty($_COOKIE['sid']) ){
$selectaccount = mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'");
if ( $selectaccount->num_rows == 1 ){

if ( $sc = $selectaccount->fetch_array() ){
$uid  = $sc['id'];
$balance = $sc['balance'];
$name = $sc['name'];

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
  <h3 style = "margin-bottom:20px" class = "text eng9">Пополнение</h3>
      <div class = "flex" style = "margin-bottom:10px">
      <!-- <div id = "fkBut" class = "block" style = "border: 1px solid rgba(255,255,255,0.03);cursor:pointer;padding: 5px 10px 5px 10px;margin: 0;margin-right: 10px;border-radius: 10px;" onclick = "$('#freekassa').show();$('#fkBut').css('border','1px solid #3c484f');$('#sfBut').css('border','1px solid rgba(255,255,255,0.03)');$('#swiftpay').hide()">
        <img src = "../static/fk.png" style = "width: 128px;cursor:pointer" />
      </div> -->
      <div id = "sfBut" class = "flex" style = "cursor:pointer;padding: 5px 10px 5px 10px;border-radius: 10px;">
        <img src="https://static.swiftpay.ru/logo/512.png" style = "width: 36px;cursor:pointer">
        <span style = "font-family: Montserrat">SWIFTPAY</span>
      </div>
    </div>
    <span class = "eng37"><input id="depositSize" onkeyup="validateBetSize(this)" AUTOCOMPLETE="off" class="input flex" type="text" name="" value="" placeholder="Сумма"></span>
    <div class = "flex">
      <h5 class = "grayText eng34" style="font-family: Montserrat;text-align: center;margin-bottom: 0;font-size: 12px;margin-right: 10px;"><i class="fas fa-file-invoice-dollar icon"></i>Все комиссии на нас</h5>
      <div class="button buttonMode flexNot eng36" id = "freekassa" style="width: 45%;background-color: #070707; margin: 10px auto;" onclick="deposit()">
        Далее<i class="fas fa-arrow-right" style="margin-left: 10px;"></i>
      </div>

    </div>

</div>
<div class="block" style="min-height: 470px;max-height: 470px;height: 100%; height: 100%" >
  <h5 class = "text eng35" style = "margin-bottom:20px">История</h5>
  <div class="add-history">
    <?php
$query = mysqli_query($bsd, "SELECT * FROM `deposits` WHERE user_id = '$uid' ORDER by id DESC LIMIT 10");
if ( $query->num_rows < 1 ){
?>
<h6 style="text-align: center; margin-top: 20px;">История пуста</h6></div>
<?php } else {

while ( ($wh = $query->fetch_array())){
if ( $_COOKIE['dark'] == 0 ){
$p.="<div class=\"add-history-item\">
          <div class=\"row\">
              <div class=\"col-6\" style=\"text-align: center;\">
                <h3 class=\"flexNot\" style=\"justify-content: end;font-size: 20px;\">  <i class=\"fas fa-plus flexNot\" style=\"width: 26px;height: 26px;color: #1fffff;border: 3px solid #1fffff;border-radius: 100px;margin-right:10px;font-size: 16px;\"></i>
                <div style=\"font-family: Montserrat;color:rgba(214,224,255,0.6)\">
                  $wh[size]
                </div>
              </h3>
              </div>
              <div class=\"col-6\" style=\"text-align: center;\">
                <h3 style=\"font-size: 20px;color: rgba(214,224,255,0.6) ;font-family: Montserrat;\"><i class=\"far fa-calendar-alt\" style=\"margin-right: 10px\"></i>".explode(' ', $wh['data'])[0]."</h3>
              </div>
          </div>
        </div>";

}else{
  $p.="<div class=\"add-history-item\">
          <div class=\"row\">
              <div class=\"col-6\" style=\"text-align: center;\">
                <h3 class=\"flexNot\" style=\"justify-content: end;font-size: 20px;\">  <i class=\"fas fa-plus flexNot\" style=\"width: 26px;height: 26px;color: #527BEE;border: 3px solid #527BEE;border-radius: 100px;margin-right:10px;font-size: 16px;\"></i>
                <div style=\"font-family: Montserrat;color:#424242\">
                  $wh[size]
                </div>
              </h3>
              </div>
              <div class=\"col-6\" style=\"text-align: center;\">
                <h3 style=\"font-size: 20px;color: #424242 ;font-family: Montserrat;\"><i class=\"far fa-calendar-alt\" style=\"margin-right: 10px\"></i>".explode(' ', $wh['data'])[0]."</h3>
              </div>
          </div>
        </div>";

}
}
echo $p;
}
  ?>
  </div>
</div>
<script>var kassa = 0</script><script>var fkassa = 0</script><script type="text/javascript">
// if (getCookie('lang') == 1 || langCheck == 1) {
//   language(1)
// } else {
//   language(2)
// }
function deposit(){
  if (fkassa == 1) {
    return error('Пополнения закрыты на время активации кассы')
  }
    if ( $('#depositSize').val() == ''){
        return error('Введите сумму');
      }
      if (!$.isNumeric($('#depositSize').val())){
        return error('Введите корректную сумму');
      }
     $.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
        type: 'deposit',
        amount: $('#depositSize').val()
      },
    success: function(data) {
      var obj = jQuery.parseJSON(data);

   if ( obj.msgType == "success" ){
      if ( obj.link !== '' ){

          document.location.href = obj.link;

      }
        }else{
            error(obj.msg);
        }
    },
    error: function(){
      error('Произошла ошибка');
    }
    });
  }
</script>
<?}?>