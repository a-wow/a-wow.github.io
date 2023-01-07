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
<div class="left-block block">
    <div class="left-block-top flex">
      <div class="sub-balance flexNot" onclick="sub();">
        <i class="fas fa-minus minus"></i>
      </div>
      <div class="balance">
        <h1><span id="balance"><?=$balance?></span></h1>
      </div>
      <div class="add-balance flexNot" onclick="add();">
        <i class="fas fa-plus plus"></i>
      </div>
    </div>
    <input style = "margin-bottom: 8px;" onkeyup="validateBetSize(this)" AUTOCOMPLETE="off" id="betSize" class="input flex" type="text" name="" value="1" placeholder="Ставка">
    <input style = "margin-bottom: 8px;" onkeyup="validateBetSize(this);battlechance();" AUTOCOMPLETE="off" id="betper" class="input flex" type="text" name="" value="50" placeholder="Процент">
    <div class="tools no-copy" style="margin-top: 5px;">
      <!-- <div class="tool-item" onclick="$('#betSize').val('')">
        <i class="fas fa-trash"></i>
      </div> -->
      <div class="flexNot" style = "margin-bottom: 10px;">
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) + 0.1).toFixed(2)))">
          +0.1
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) + 1).toFixed(2)))">
          +1
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) + 5).toFixed(2)))">
          +5
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) + 10).toFixed(2)))">
          +10
        </div>
      </div>
      <div class = "flexNot" style = "margin-bottom: 20px;">
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) + 100).toFixed(2)))">
          +100
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val())*2).toFixed(2)))">
          x2
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number(parseFloat(Number($('#betSize').val()) / 2).toFixed(2)))">
          1/2
        </div>
        <div class="tool-item flex" onclick="$('#betSize').val(Number($('#balance').html()))">
          MAX
        </div>
      </div>
    </div>
    <div class="flex battleMainButton">
      <button class="button redB flex eng16" style="border: 0;" onclick="select_team('red', 'blue');battlebet();">
        <i class="fas fa-crosshairs icon"></i>Поставить
      </button>
      <div style = "width:2%">

      </div>
      <button class="button blueB flex eng16" style="border: 0;" onclick="select_team('blue', 'red');battlebet();">
        <i class="fas fa-crosshairs icon"></i>Поставить
      </button>
    </div>
    <div class="flex battleNoLimit" style = "display:none">
      <div class="button redB flex eng16" style="" onclick="bet2(0)">
        <i class="fas fa-crosshairs icon"></i>Поставить
      </div>
      <div style = "width:2%">

      </div>
      <div class="button blueB flex eng16" style="" onclick="bet2(1)">
        <i class="fas fa-crosshairs icon"></i>Поставить
      </div>
    </div>
  </div>

  <div class="block battleMainButton">
    <h4 style = "margin-bottom:20px" class = "text eng4">Ваши последние игры</h4>
    <div class="flex" style="margin-bottom: 10px;" id="history">
      <?php
       $query = ("SELECT * FROM `games` WHERE `user_id` = '$uid' ORDER BY id DESC LIMIT 7");
      $result = mysqli_query($bsd, $query);

    while(($lg = $result->fetch_array() )){
        $gameid = $lg['id'];
        $dropcolor = $lg['dropcolor'];

        if ( $dropcolor == 'red' ){

          $r = 'R';
          if ( $_COOKIE['dark'] == 0 ){

              $bg = '<a href="/game.php?id='.$gameid.'" target="_blank"><div style="position:relative"><input class="lastgame R rAdd" style="background: rgb(255, 243, 243);"><div class="textL Rtext" style="color: rgb(255, 0, 170);">R</div></div></a>';

          }else{

              $bg = '<a href="/game.php?id='.$gameid.'" target="_blank"><div style="position:relative"><input class="lastgame R" style="background: rgb(255, 243, 243);"><div class="textL Rtext" style="color: rgb(233, 91, 76);">R</div></div></a>';

          }

        }else{

            $r = 'B';

          if ( $_COOKIE['dark'] == 0 ){

              $bg = '<a href="/game.php?id='.$gameid.'" target="_blank"><div style="position:relative"><input class="lastgame B bAdd" style="background: rgb(244, 247, 255);"><div class="textL Btext" style="color: rgb(31, 255, 255);">B</div></div></a>';

          }else{

              $bg = '<a href="/game.php?id='.$gameid.'" target="_blank"><div style="position:relative"><input class="lastgame B" style="background: rgb(244, 247, 255);"><div class="textL Btext" style="color: rgb(104, 131, 221);">B</div></div></a>';

          }
        }


          $p .= $bg;

    }
    echo $p;
    ?>
          </div>
  </div>
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

<?}?>