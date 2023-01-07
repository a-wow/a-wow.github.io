  <?php
include("../../assets/config.php");
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

$selectaccount = mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'");
if ( $selectaccount->num_rows == 1 ){

if ( $sc = $selectaccount->fetch_array() ){

$balance = $sc['balance'];
$name = $sc['name'];
$uprava = $sc['prava'];
$uava = $sc['img'];
$ucolornick = $sc['namecolor'];
}

}

  ?>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    this.classList.toggle("activeProf");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      $(this).find('.plusik').show()
      $(this).find('.minusik').hide()
      panel.style.display = "none";
    } else {
      $(this).find('.plusik').hide()
      $(this).find('.minusik').show()
      panel.style.display = "block";
    }
  });
}
</script>
<div class="block" style="position:relative" >
  <!-- <div class = "rBonus" style="position: absolute;top: 0px;right: 54px;font-size: 39px;">
    <span style="cursor: pointer; font-size: .75em;" onclick="rBonus();">
      <i class="fas fa-clipboard" style="margin: 0 5px;"></i>
    </span>
  </div> -->
  <h5 class = "text eng60" ></i>Мой профиль</h5>
  <div class="add-history" style="height:auto">
    <div class = "flex" style = " "> <div><div class="reset flex" onclick = "resetToken()"> <i class="fas fa-power-off"></i>  </div> <div > </div> </div> </div>  <div class = "flexNot" style = "margin-top:20px;margin-bottom:20px;"> <div> <img style = "border-radius:100px;width:60px;margin-right:5px;" src="<?=$uava?>" /> </div> <div style = "color: <?php
if ( !empty($ucolornick) ){echo "#$ucolornick";}else{if ( $_COOKIE['dark'] == 1 ){ echo '#070707'; } else { echo '#fff'; }}?>;margin-left: 15px;font-size: 20px;width: 80%;"> <?=$name?> </div> </div><div class = "eng61" > <input id="changeImg" onkeyup="validNick()" autocomplete="off" class="input flex" type="text" name="" value="" placeholder="Ссылка на фото">  </div> <div class = "flexNot" style = "margin-top:15px;justify-content: space-between;"> <div style = "text-align:center;color: "rgba(214,224,255,0.6)";font-family: Montserrat;"> 100x100 jpg file </div> <div> <div class = "button flexNot buttonMode" style = "width:100%;background-color: #070707;color: white;" onclick = "window_add_img()">   <span class ="eng64">Cменить</span>  </div>  </div> </div></div>
  </div>
</div>

<!-- <div class = "block accordion" data-toggle="collapse" data-target="#last">
  <h5 class = "text" >Ваши последние игры </h5>
  <i class="fas fa-plus plusik"></i>
  <i class="fas fa-minus minusik" style = "display:none"></i>
</div>
<div  id = "last" class = "collapse block accord" style = "margin-top:20px;">
  <div class = "flex">
      </div>
</div> -->



<div class = "block" style = "/*min-height: 221px; max-height: 221px;*/ ">
<h5 class = "text eng62" style = "margin-bottom:20px" >Изменить ник</h5>
  <div class = "flex eng63" style = "margin-bottom:20px;">
    <input id="changeNick" onkeyup="validNick()" autocomplete="off" class="input flex" type="text" name="" value="" placeholder="Ник">
  </div>
  <div class = "button buttonMode flexNot" style = "width:51%;background-color: #070707;color: white;" onclick = "window_add()">
    <span class = "eng64">Cменить</span> (-<?=$changenicksum?>)
  </div>

</div>
<div class = "block" style = "/*min-height: 221px; max-height: 221px;*/ ">
<h5 class = "text" style = "margin-bottom:20px" >Изменить цвет ника</h5>
  <div class = "flex eng65" style = "margin-bottom:20px;">
    <script src="../js/jscolor.js"></script>
  <input id="changeColor" onkeyup="validNick()" autocomplete="off" class="input flex jscolor" type="text" name="" value="" placeholder="Цвет HEX без знака # (например cf2020) ">
  </div>
  <div class = "button buttonMode flexNot" style = "width:51%;background-color: #070707;color: white;" onclick = "window_add_color()">
    <span class = "eng64">Cменить</span> (-<?=$changecolorsum?>)
  </div>

</div>

<script type="text/javascript">

// if (getCookie('lang') == 1 || langCheck == 1 ) {
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
var token_load = 0;
  function resetToken(){
   if (token_load == 1) {
     return error('Обработка запроса...');
   }

$.ajax({
    type: 'POST',
    url: '../engine.php',
    data: {
        type: "resetToken",
    },
    beforeSend: function(){

        token_load = 1;

    },
    success: function(data) {
      var obj = jQuery.parseJSON(data);
            if ( obj.msgType == "success" ){
            error("Авторизация на всех устройствах сброшена!", true);
            setTimeout(function(){ location.reload(); }, 1000);
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
</script>
<?}?>