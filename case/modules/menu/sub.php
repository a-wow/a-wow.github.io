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
  <h3 class = "text eng10" style = "margin-bottom:20px">Вывод</h3>
  <select class=" input hide-search form-control select2-hidden-accessible" id="sub_list" value='1' onchange="withdrawSelect()" tabindex="-1" aria-hidden="true">
    <optgroup label="Платежные системы">
      <option selected value="1">Qiwi</option>
      <option value="2">Яндекс.Деньги (Только верифицированные!)</option>
      <option value="3">Payeer</option>
    </optgroup>
    <optgroup label="Мобильная связь (Россия)">
      <option value="4">Билайн</option>
      <option value="5">Мегафон</option>
      <option value="6">МТС</option>
      <option value="7">Теле 2</option>
    </optgroup>
    <optgroup label="Банковские карты">
      <option value="8">VISA (от 1100р)</option>
      <option value="9">MASTERCARD (от 1100р)</option>
      <option value="10">МИР (от 1100р)</option>
    </optgroup>

    </select>
    <input AUTOCOMPLETE="off" onkeyup="if($('#sub_amount').val() < <?=$minvivod?>){$('#cur_with').html('От <?=$minvivod?>')}else{$('#cur_with').html(Math.max(<?=$minvivod - 1?>, parseFloat($('#sub_amount').val() * 0.98).toFixed(2)))}" id="sub_amount" class="input flex" type="text" name="" value="<?=$minvivod?>" placeholder="Сумма" style="margin-top: 10px;">
    <input AUTOCOMPLETE="off" placeholder="+79995556767" onkeyup="$('#sub_wallet').val($('#sub_wallet').val().replace(/[^+PR0-9]/gim, ''))" id="sub_wallet" class="input flex" type="text" name="" value="" placeholder="Кошелёк" style="margin-top: 10px;">
    <div class="button buttonMode flex eng38" style="width:61%;background: linear-gradient(90deg, #FF005B, #B81681, #6D338F);  box-shadow: 0px 16px 24px rgba(184,22,129,0.24); color: white; margin-top: 10px;" onclick="withdraw()">
      <i class="fas fa-credit-card icon"></i>Вывод(<i class="fas fa-file-invoice" style="margin: 0 5px;"></i><span id="cur_with"><?php echo round($minvivod * 0.98, 2);?></span>)
    </div>
</div>
<div class="block" style="min-height: 380px;max-height: 380px;height: 100%;">
  <h5 class = "text eng35" style = "margin-bottom:20px"></i>История</h5>
  <div id="wd_history">

<?php
$query = mysqli_query($bsd, "SELECT * FROM `withdraws` WHERE user_id = '$uid' ORDER by id DESC LIMIT 10");
if ( $query->num_rows < 1 ){
?>
<h6 style="text-align: center; margin-top: 20px;">История пуста</h6></div>
<?php } else {

while ( ($wh = $query->fetch_array())){

switch($wh['status']){

case '0':
$status = 'wait';
$icon = 'clock';
$title = 'В обработке...';
break;
case '1':
$status = 'success';
$icon = 'check-circle';
$title = 'Выполнено';
break;
case '2':
$status = 'decline';
$icon = 'times-circle';
$title = 'Отклонено';
break;

}

$p.="<div class=\"withdraw-history-item\">
    <div class=\"row\">
        <div class=\"col-2\"> <i class=\"far fa-calendar-alt\" data-toggle=\"tooltip\" title=\"$wh[date]\" style=\"cursor: help\"></i> </div>
        <div class=\"col-6\"> <img src=\"../static/wallets/4.png\" style=\"width: 1em; height: 1em;\">$wh[wallet] </div>
        <div class=\"col-2\"> $wh[amount] </div>
        <div class=\"col-2\">
            <div class=\"status_$status\"><i class=\"fas fa-$icon\" data-toggle=\"tooltip\" data-html=\"true\" title=\"$title\"></i></div>
        </div>
    </div>
</div>";


}
echo $p;
}
  ?>
</div>
<script type="text/javascript">
// if (getCookie('lang') == 1 || langCheck == 1 ) {
//   language(1)
// } else {
//   language(2)
// }
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
var sendwait = 0;
var waittime = 0;
setInterval(function() {
  if(waittime > 0){
    waittime = waittime - 1;
  }
}, 1000);
var plus = [4,5,6,8];
function withdraw(){

      //return error('Выводы временно отключены до окончания тестов нового движка');

  if (waittime > 0){
      return error('Подождите ' + waittime + ' перед следующим выводом...');
  }
  if (sendwait == 1){
      return error('Обрабатываем запрос...');
    }
  if ( $('#sub_amount').val() == ''){
      return error('Введите сумму');
    }
    if ( $('#sub_wallet').val() == ''){
        return error('Укажите кошелёк');
      }
    if (!$.isNumeric($('#sub_amount').val())){
      return error('Введите корректную сумму');
    }
  $.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
        type: 'createWithdraw',
        amount: $('#sub_amount').val(),
        wallet: $('#sub_wallet').val(),
        system: $('#sub_list').val(),
      },
       beforeSend: function() {
      sendwait = 1;
    },
    success: function(data) {
      waittime = 10;
      sendwait = 0;
      var obj = jQuery.parseJSON(data);

   if ( obj.msgType == "success" ){

          error(obj.msg,true);
          $('#sub_amount').val('');
          $('#sub_wallet').val('');
        }else{
            error(obj.msg);
        }
    },
    error: function(){
      error('Произошла ошибка');
    }
    });
}
var sendwait22
function deleteWithdraw(id){
return
  if (sendwait22 == 1){
      return error('Обрабатываем запрос...');
    }

  $.ajax({
    type: 'POST',
    url: '/api/refundWithdraw',
    beforeSend: function() {
      sendwait22 = 1;
    },
    contentType: "application/json",
    data: JSON.stringify({
        'id': id,
        'token': getCookie('token')
  }),
    success: function(data) {
      var obj = data;
      sendwait22 = 0;
      try{
        if('success' in obj){
          if (getCookie('dark') == 1) {
            var colorS = '#FE4B31';
          } else {
            var colorS = '#ff00aa';
          }
          $('#refund'+id).html('<i style = "color: #D1345B" class="fas fa-times-circle" data-toggle="tooltip" data-html="true" title="" data-original-title="Выплата отменена. Средства на балансе. <br ></i>" aria-describedby="tooltip571612"></i>');
          $('#refund2'+id+' > i').css('border', '3px solid '+colorS)
          error(obj.success.text,true);
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
</script>
<?}?>