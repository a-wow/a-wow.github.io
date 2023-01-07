<?php
$bd_server = 'sql8.freesqldatabase.com'; $bd_login = 'sql8588830'; $bd_pass = 'cfLR9j8VKQ'; $bd_name = 'sql8588830';
$bsd = mysqli_connect($bd_server, $bd_login, $bd_pass)//параметры в скобках ("хост", "имя пользователя", "пароль")
or die("<p>Ошибка подключения к базе данных!</p>");
mysqli_select_db($bsd, $bd_name)//параметр в скобках ("имя базы, с которой соединяемся")
 or die("<p>Ошибка выбора базы данных!</p>");
mysqli_query($bsd, "SET NAMES utf8");

$selectinfo = mysqli_query($bsd, "SELECT * FROM `config` WHERE id='1'");
if ( $si = $selectinfo->fetch_array() ){
$sitename = $si['name'];
$sitedomain = $si['domain'];
$vkgroup = $si['vkgroup'];
$vkgtoken = $si['vktoken'];
$vkgid = $si['vkid'];
$chatunbansum = $si['chatunbansum'];
$standartbonus = $si['standartbonus'];
$changenicksum = $si['changenicksum'];
$changecolorsum = $si['changecolorsum'];
$minvivod = $si['minvivod'];
$minbet = $si['minbet'];
$maxbet = $si['maxbet'];
$merchant_id = $si['merchant_id'];
$recaptchasecret = $si['recaptchasecretkey'];
$recaptchasite = $si['recaptchasitekey'];
$merchant_secret_1 = $si['merchant_secret_1'];
$merchant_secret_2 = $si['merchant_secret_2'];
$refsum = $si['refsum'];
}

?>
