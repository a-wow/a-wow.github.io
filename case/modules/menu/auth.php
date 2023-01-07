<?php
include("../../assets/config.php");
if ( empty($_COOKIE['sid']) || mysqli_query($bsd, "SELECT * FROM users WHERE sid = '$_COOKIE[sid]'")->num_rows < 1){

?>

<div class="block">
  <h3 class="eng1">Что такое <?=$sitename?>?</h3>
  <div class="text eng2" style="text-align: center;font-size: 15px;">
    <?=$sitename?> - это первая онлайн-игра, где вы можете повысить не только свои шансы на победу, но и шансы всей команды.
     <div id="uLogin" style="max-width: 200px;width: 100%;cursor: pointer;color: white;margin: 10px auto;background: linear-gradient(56deg, #00ffffd9,#0088c9);border-radius: 12px;" class="button flex" data-ulogin="display=buttons;fields=photo_big,first_name,last_name;mobilebuttons=0;redirect_uri=http%3A%2F%2F<?=$_SERVER['HTTP_HOST']?>/engine.php;"><a data-uloginbutton="vkontakte"><i class="fab fa-vk" style="margin-right: 10px;"></i>Войти через VK</a></div>
              <script src="//ulogin.ru/js/ulogin.js"></script>

  </div>
</div>

<?}?>