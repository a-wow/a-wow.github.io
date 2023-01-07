<?php
include("assets/config.php");

$type = $_POST['type'];
$msgType = "success";
$msg = "";

if ( !empty($_COOKIE['sid']) && mysqli_query($bsd, "SELECT * FROM users WHERE sid='$_COOKIE[sid]'")->num_rows == 1 ){

$query = mysqli_query($bsd, "SELECT * FROM users WHERE sid='$_COOKIE[sid]'");
if ( $ui = $query->fetch_array() ){
$uid = $ui['id'];
$uname = $ui['name'];
$ubalance = $ui['balance'];
$uprava = $ui['prava'];
$uava = $ui['img'];
$uban = $ui['ban'];
$bonusdate = $ui['bonustaked'];
$referer = $ui['referer'];
$vk = $ui['vk_url'];
$myref = $ui['ref_code'];
}

$checkuser = mysqli_query($bsd, "SELECT * FROM users WHERE sid='$_COOKIE[sid]'")->num_rows;
/* CHAT START */



if ( $type == "addMsg" ){

$mess = mysqli_real_escape_string($bsd, htmlspecialchars(trim($_POST['mess'])));
$mess = preg_replace('(http://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' target='_blank'>$0</a>", $mess);
$mess = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' target='_blank'>$0</a>", $mess);
$mess = preg_replace('#<a.*>.*</a>#USi', '[ссылка удалена]', $mess);
$sysmsg = explode("/sys ", $mess)[1];

if ( empty($mess) ){

$msgType = "error";
$msg = "Сообщение не может быть пустым";

}

if ( $uprava != 1 and $uprava != 2 ){
if ( strlen(htmlspecialchars_decode($mess)) > 151 ){

$msgType = "error";
$msg = "Максимальное количество символов в тексте - 100";

}
}
if ( $uban == 1 || $uban == 2 ){

$msgType = "error";
$msg = "Вы заблокированы!";

}
if ( $msgType == "success" ){
/* Админ-команды */
if ( $uprava == 1 || $uprava == 2 and $mess == "/clear"){
if ( $uprava == 1 ){
mysqli_query($bsd, "TRUNCATE TABLE `chat`");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Чат очищен администратором проекта.', NOW());");
}elseif ( $uprava == 2 ) {
mysqli_query($bsd, "TRUNCATE TABLE `chat`");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Чат очищен модератором проекта.', NOW());");
}
}elseif ( $uprava == 1 and $sysmsg ){


mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', '$sysmsg', NOW());");


}else{

mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('$uid', '$mess', NOW());");

}

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}

}else{

$result = array("msgType"=>"error","msg"=>"Авторизуйтесь!");
}
if ( $uprava == 1 || $uprava == 2 ){
if ( $type == "deleteMsg") {



$msgId = $_POST['messid'];


if ( mysqli_query($bsd, "SELECT * FROM `chat` WHERE id='$msgId'")->num_rows < 1 ){

$msgType = "error";
$msg = "Данного сообщения не существует.";

}
if ( $msgType == "success" ){

mysqli_query($bsd, "DELETE FROM `chat` WHERE `id` = '$msgId'");

}



$result = array("msgType"=>"$msgType","msg"=>"$msg");

}

if ( $type == "warn") {



$userid = $_POST['userid'];



if ( mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$userid'")->num_rows < 1 ){

$msgType = "error";
$msg = "Данного игрока не существует.";

}else{

$userinfo =  mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$userid'");
if ( $usinfo = $userinfo->fetch_array() ){

$warnscount = $usinfo['warns'];
$warnedname = $usinfo['name'];
$ban = $usinfo['ban'];
$pravaus = $usinfo['prava'];
}

if ( $ban == 2 and $warnscount == 3 ){

$msgType = "error";
$msg = "Этот игрок уже заблокирован в чате.";

}
if ( $uprava <= $pravaus ){

$msgType = "error";
$msg = "У вас нет полномочий выдать варн данному игроку.";

}

}
if ( $msgType == "success" ){

if ( $warnscount > 1 ){
$newwarns = 3;
$ban = 2;
mysqli_query($bsd, "UPDATE `users` SET `warns` = '$newwarns' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `ban` = '$ban' WHERE id='$userid'");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Игрок \"$warnedname\" заблокирован в чате навсегда.', NOW());");
$msg = "Игрок получил 3-е предупреждение и был заблокирован в чате навсегда.";
}elseif ( $warnscount < 2 ){
$warnsnew = $warnscount + 1;
mysqli_query($bsd, "UPDATE `users` SET `warns` = `warns` + 1 WHERE id='$userid'");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Игроку \"$warnedname\" выдано предупреждение $warnsnew/3.', NOW());");
$msg = "Игроку выдано $warnsnew/3 предупреждение.";
}


}



$result = array("msgType"=>"$msgType","msg"=>"$msg");

}


if ( $type == "unban") {



$userid = $_POST['userid'];


if ( mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$userid'")->num_rows < 1 ){

$msgType = "error";
$msg = "Данного игрока не существует.";

}else{

$selectus = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$userid'");
$ss = $selectus->fetch_array();

if ( $ss['ban'] != 2 ){

$msgType = "error";
$msg = "Данный игрок не имеет блокировки в чате.";

}
}
if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `ban` = '0'");
mysqli_query($bsd, "UPDATE `users` SET `warns` = '0'");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Игрок \"$ss[name]\" разблокирован.', NOW());");


}



$result = array("msgType"=>"$msgType","msg"=>"$msg");

}
}

if ( $type == "messagesCount" ){
$msgcounts = mysqli_query($bsd, "SELECT * FROM chat")->num_rows;

if ( mysqli_query($bsd, "SELECT * FROM chat")->num_rows > 100 ){

mysqli_query($bsd, "TRUNCATE TABLE `chat`");
mysqli_query($bsd, "INSERT INTO `chat` (`user_id`, `msg`, `date`) VALUES ('0', 'Чат автоматически очищен', NOW());");

}

$result = array("count" => "$msgcounts");

}

if($type == "messagesGet" ){
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
    $result = array("chat" => "$p");
}
/* CHAT END */

/*FUNCTIONS*/

// get balance
//
if ( $type == "getBalance" ){

$selectuser = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$uid'");

if ( $selectuser->num_rows == 1 ){
$sc = $selectuser->fetch_array();
$result = array("info"=>"$sc[balance]");
}
}

if ( $type == "getLastGames" ){

if ( is_numeric($uid) ){

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
    $result = array("info"=>"$p");
}

}

//сброс токена
if ( $type == "resetToken" ){
  $selectuser = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$uid'");

if ( $selectuser->num_rows == 1 ){

$selc = $selectuser->fetch_array();
$vkid = $selc['vk_url'];

 $resultt = '';
$count = 32;
    $array = array_merge(range('a','z'), range('0','9'));
    for($i = 0; $i < $count; $i++){
                $resultt .= $array[mt_rand(0, 35)];
    }

$resultt .= $vkid;

  $newsid = hash('sha512', $resultt);

        mysqli_query($bsd, "UPDATE `users` SET `sid` = '$newsid' WHERE vk_url='$vkid'");
        setcookie("sid", "");

$msgType = "success";


}else{

$msgType = "error";
$msg = "Авторизуйтесь";

}
$result = array("msgType"=>"$msgType","msg"=>"$msg");
}


//разбан в чате

if ( $type == "chatUnlock" ){

if ( $uban != 2 ){

$msgType = "error";
$msg = "Вы не имеете блокировки в чате.";

}
if ( $ubalance < $chatunbansum ){

$msgType = "error";
$msg = "Недостаточно монет на балансе";

}
if ( mysqli_query($bsd, "SELECT * FROM users WHERE id='$uid'")->num_rows != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}

if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` - $chatunbansum WHERE id = '$uid'");
mysqli_query($bsd, "UPDATE `users` SET `ban` = '0' WHERE id='$uid'");

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");
}




// активация промо/реф.кода

if ( $type == "activateCode" ){

$code = trim($_POST['code']);
$ref = mysqli_query($bsd, "SELECT * FROM `users` WHERE ref_code = '$code'");
$promo = mysqli_query($bsd, "SELECT * FROM `promo` WHERE code = '$code'");

if ( $ref->num_rows == 1 and $promo->num_rows == 1 ){

$msgType = "error";
$msg = "Ошибка";

}
if ( $ref->num_rows < 1 and $promo->num_rows < 1 ){

$msgType = "error";
$msg = "Промокод не существует.";

}
if ( $ref->num_rows == 1 and $promo->num_rows != 1 and !empty($referer) ){

$msgType = "error";
$msg = "Вы уже активировали реф.код";

}
if ( $ref->num_rows == 1 and $promo->num_rows != 1 and $code == $myref ){

$msgType = "error";
$msg = "Вы не можете активировать свой реф.код";

}
if ( $promo->num_rows == 1 and $ref->num_rows != 1 ){
$ppp = $promo->fetch_array();
$usersactive = explode('|', $ppp['users']);
$actives = $ppp['actives'];
$actived = $ppp['actived'];


if ( in_array($uid, $usersactive) ){
$msgType = "error";
$msg = "Вы уже активировали этот промокод.";
}
if ( $actived == $actives ){

$msgType = "error";
$msg = "Активации исчерпаны.";

}
}
 if($vk != '') {
    $user = explode( 'vk.com', $vk )[1];
$http = "http://";
$vks = str_replace($user, '', $vk);
$vks = str_replace($http, '', $vks);
if($vks == "vk.com" || $vks == "m.vk.com")
{
  //good
    $domainvk = explode( 'http://vk.com/id', $vk )[1];
if (!is_numeric($domainvk))
{
  $domainvk = explode( 'com/', $vk )[1];
}

    $vk1 = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$domainvk}&access_token=".$vkgtoken."&v=5.74"));
        $vk1 = $vk1->response[0]->id;
  $resp = file_get_contents("https://api.vk.com/method/groups.isMember?group_id=".$vkgid."&user_id={$vk1}&access_token=".$vkgtoken."&v=5.74");
$data = json_decode($resp, true);


if($data['response']=='0')
{
$msgType = "error";
$msg = "Для получения бонуса необходимо подписаться на группу ВК.";
}
if($data['response']=='1')
{
}
}
}
if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}

if ( $msgType == "success" ){
if ( !empty($_POST["recaptcha_response"]) ){

  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = [
    'secret' => $recaptchasecret, //здесь пишете свой секретный ключ от recaptcha
    'response' => $_POST["recaptcha_response"]
  ];
  $options = [
    'http' => [
      'method' => 'POST',
      'content' => http_build_query($data)
    ]
  ];
  $context  = stream_context_create($options);
  $verify = file_get_contents($url, false, $context);
  $captcha_success=json_decode($verify);
  if ($captcha_success->success==false) { //пользователь робот

      $msg = "Вы не прошли проверку на \"Я не робот\"";
$msgType = "error";
  } else if ($captcha_success->success==true) { //пользователь не робот
 if ( $ref->num_rows == 1 and $promo->num_rows != 1 ){

mysqli_query($bsd, "UPDATE `users` SET `referer` = '$code' WHERE id='$uid'");
mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` + $refsum WHERE id='$uid'");
mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` + $refsum WHERE ref_code='$code'");

}elseif ( $promo->num_rows == 1 and $ref->num_rows != 1 ){


$promo = mysqli_query($bsd, "SELECT * FROM promo WHERE code = '$code'");
if ( $prm = $promo->fetch_array() ){

$promosum = $prm['size'];
$promousers = $prm['users'];
}

$newusers = $promousers . '|' . $uid;
$newbal = $ubalance + $promosum;
mysqli_query($bsd, "UPDATE `users` SET balance = '$newbal' WHERE id='$uid'");
mysqli_query($bsd, "UPDATE `promo` SET `actived` = `actived` + 1 WHERE code='$code'");
mysqli_query($bsd, "UPDATE `promo` SET `users` = '$newusers' WHERE code='$code'");

}
}

}else{

$msg = "Вы не прошли проверку на \"Я не робот\"";
$msgType = "error";

}

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}

//создание промокода

if ( $type == "createPromo" ){

$promo = trim($_POST['promo']);
$count = floor(trim($_POST['count']));
$size = floor(trim($_POST['size']));

$total = $count * $size;
if ( $ubalance < $total ){

$msgType = "error";
$msg = "Недостаточно монет на балансе";

}
if ( mysqli_query($bsd, "SELECT * FROM `promo` WHERE `code` = '$promo'")->num_rows >= 1 || mysqli_query($bsd, "SELECT * FROM `users` WHERE `ref_code` = '$promo'")->num_rows >= 1 ){

$msgType = "error";
$msg = "Код с таким названием уже существует.";

}elseif ( preg_match('/^[A-Z][\d]+/', $promo) ){

$msgType = "error";
$msg = "Вы не можете создать реферальный код!";

}
if ( !is_numeric($count) || !is_numeric($size) || !preg_match('/^[a-zA-ZА-ЯёЁ0-9]+/usix', $promo) ){

$msgType = "error";
$msg = "Недопустимые символы";

}
if ( empty($count) || empty($size) || empty($promo) ){

$msgType = "error";
$msg = "Заполните все поля!";

}
if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}

if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` - $total WHERE id='$uid'");
mysqli_query($bsd, "INSERT INTO `promo` (`code`,`actives`,`size`) VALUES ('$promo', '$count', '$size');");

$msg = "Вы успешно создали промокод на $count активаций, по $size монет!";

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}










//ежедневный бонус

if ( $type == "dailyBonus" ){

$now = time();
$needbonus = $bonusdate + 86400;
if ( $now >= $needbonus  ){
$r = mysqli_query($bsd, "SELECT SUM(size) FROM `deposits` WHERE user_id = '$uid'")->fetch_array()['SUM(size)'];
if ( empty($r) ){$r = 0;}
$query = mysqli_query($bsd, "SELECT * FROM `prefix` WHERE deposit <= '$r' ORDER BY `deposit` DESC LIMIT 1");
if ( $pr = $query->fetch_array() ){
$bonussize = $pr['bonussize'];
}
if ( !is_numeric($bonussize)) {

$bonussize = $standartbonus;

}

mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` + $bonussize WHERE id='$uid'");
mysqli_query($bsd, "UPDATE `users` SET `bonustaked` = '$now' WHERE id='$uid'");

$msgType = "success";
$msg = "Получен бонус в размере " . $bonussize;

}else{

$ostalos = $needbonus - $now;
$ostalos = floor($ostalos / 60);
$msgType = "error";
$msg = "До получения бонуса осталось - $ostalos минут";
}
 if($vk != '') {
    $user = explode( 'vk.com', $vk )[1];
$http = "http://";
$vks = str_replace($user, '', $vk);
$vks = str_replace($http, '', $vks);
if($vks == "vk.com" || $vks == "m.vk.com")
{
  //good
    $domainvk = explode( 'http://vk.com/id', $vk )[1];
if (!is_numeric($domainvk))
{
  $domainvk = explode( 'com/', $vk )[1];
}

    $vk1 = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$domainvk}&access_token=".$vkgtoken."&v=5.74"));
        $vk1 = $vk1->response[0]->id;
  $resp = file_get_contents("https://api.vk.com/method/groups.isMember?group_id=".$vkgid."&user_id={$vk1}&access_token=".$vkgtoken."&v=5.74");
$data = json_decode($resp, true);


if($data['response']=='0')
{
$msgType = "error";
$msg = "Для получения бонуса необходимо подписаться на группу ВК.";
}
if($data['response']=='1')
{
}
}
}
if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}


$result = array("msgType"=>"$msgType","msg"=>"$msg");

} //спустя 30 мин. мучений оказывается нужно было заменить в if ( $bdate >= $needbonus ) на if ( $now >= $needbonus )...

//смена аватарки

if ( $type == "changeImg" ){

$newava = mysqli_real_escape_string($bsd, htmlspecialchars(trim($_POST['img'])));
$ext = explode(".", $newava);
$extt = end($ext);
if ( $extt != 'jpg' and $extt != 'jpeg' ){

$msgType = "error";
$msg = "Изображение должно быть в формате JPEG или JPG.";

}
if ( empty($newava) ){

$msgType = "error";
$msg = "Ссылка на изображение не может быть пустой.";

}

if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}

if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `img` = '$newava' WHERE id ='$uid'");

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}

//смена ника
if ( $type == "changeNick" ){
$newnick = mysqli_real_escape_string($bsd, htmlspecialchars(trim($_POST['nick'])));

if ( empty($newnick) ){
$msgType = "error";
$msg = "Ник не может быть пустым!";
}
if ( strlen($newnick) > 20 ){
$msgType = "error";
$msg = "Максимальная длина ника при изменении - 20 символов!";
}
if ( $ubalance < $changenicksum ){
 $msgType = "error";
  $msg = "Недостаточно монет на балансе";
}
if ( !preg_match('/^[a-zA-ZА-ЯёЁ0-9]+/usix', $newnick) ){
 $msgType = "error";
  $msg = "Недопустимые символы!";

}
if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}
if ( $newnick == $uname ){

 $msgType = "error";
  $msg = "Новый ник не может быть равен старому!";

}
if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `name` = '$newnick' WHERE id='$uid'");
mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` - $changenicksum WHERE id='$uid'");


}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}

//смена цвета ника
if ( $type == "changeColor" )
{
$color = str_replace(" ", "", mysqli_real_escape_string($bsd, htmlspecialchars(trim($_POST['color']))));

if ( $ubalance >= $changecolorsum ){

if(preg_match('/^([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/i', $color)){

   mysqli_query($bsd, "UPDATE `users` SET `namecolor` = '$color' WHERE id='$uid'");
   mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` - $changecolorsum WHERE id='$uid'");
  $msgType = "success";

}
else{
  $msgType = "error";
  $msg = "Не валидный цвет!";
}
}else{
 $msgType = "error";
  $msg = "Недостаточно монет на балансе";

}
if ( $checkuser != 1 ){

$msgType = "error";
$msg = "Авторизуйтесь";

}
$result = array("msgType"=>"$msgType","msg"=>"$msg");

}


// вывод средств

if ( $type == 'createWithdraw' ){

$amount = trim($_POST['amount']);
$wallet = trim(mysqli_real_escape_string($bsd, htmlspecialchars($_POST['wallet'])));
$system = $_POST['system'];
$systems = array(1 => "qiwi", 2 => "yandex", 3 => "payeer", 4 => "beeline", 5 => "megafon", 6 => "mts", 7 => "tele2", 8 => "visa", 9 => "mastercard", 10 => "mir");
$systemss = array(1,2,3,4,5,6,7,8,9,10);
if ( $ubalance < $amount ){

$msgType = "error";
$msg = "Недостаточно монет на балансе";

}
if ( $amount < $minvivod ){

$msgType = "error";
$msg = "Минимальный вывод - $minvivod";

}
if ( !in_array($system, $systemss) ){

$msgType = "error";
$msg = "Выберите систему!";

}
if ( !is_numeric($amount) ){

$msgType = "error";
$msg = "Введите сумму.";

}
if ( empty($wallet) || empty($system) || empty($amount) ){

$msgType = "error";
$msg = "Заполните все поля.";

}
if ( $checkuser != 1 ){
$msgType = "error";
$msg = "Авторизуйтесь";

}
if ( $msgType == "success" ){
$sys = $systems[$system];
$totalamount = round($amount * 0.98, 2);
mysqli_query($bsd, "INSERT INTO `withdraws` (`user_id`, `system`, `wallet`, `amount`, `status`, `date`) VALUES ('$uid', '$sys', '$wallet', '$totalamount', '0', NOW());");
mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` - $amount WHERE id='$uid'");
$msg = "Создана заявка на вывод $amount монет на кошелёк: $wallet";

}
$result = array("msgType"=>"$msgType","msg"=>"$msg");

}


//пополнение

// 08.03.2020 19:23 - попытка #1 пытаюсь подключить swiftpay.
//

if ( $type == "deposit" ){

$amount = $_POST['amount'];

if ( !is_numeric($amount) ){

$msgType = "error";
$msg = "Сумма введена неверно.";

}
  if($msgType == "success") {
$sign = md5($merchant_id.':'.$amount.':'.$merchant_secret_1.':'. $uid);
}
    $result = array(
  'msgType' => "$msgType",
  'msg' => "$msg",
  'link' => "https://www.free-kassa.ru/merchant/cash.php?m=".$merchant_id."&oa={$amount}&o={$uid}&s=".$sign.""
    );


}


if ( isset($_POST['MERCHANT_ORDER_ID']) ){


  function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
    }
    if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '136.243.38.108'))) {
    die("hacking attempt!");
    }

    $sign = md5($merchant_id.':'.$_REQUEST['AMOUNT'].':'.$merchant_secret_2.':'.$_REQUEST['MERCHANT_ORDER_ID']);

    if ($sign != $_REQUEST['SIGN']) {
    die('wrong sign');
    }
    if ( !is_numeric($_POST['MERCHANT_ORDER_ID']) || !is_numeric($_POST['AMOUNT']) ){
    die("you can't hack me!");
    }

    $pay_id = $_POST['intid'];
    $amount = $_POST['AMOUNT'];
    $user_id = $_POST['MERCHANT_ORDER_ID'];
    $users = mysqli_query($bsd, "SELECT * FROM `users` WHERE id='$user_id'");
      if ( $users->num_rows == 1 ){

          mysqli_query($bsd, "UPDATE `users` SET `balance` = `balance` + $amount WHERE id='$user_id'");
          mysqli_query($bsd, "INSERT INTO `deposits` (`pay_id`, `user_id`, `size`, `data`) VALUES ('$pay_id', '$user_id', '$amount', NOW());");

      }else{

          die("user not found");

      }
    die('YES');

}
/* END FUNCTIONS */


/* game functional */

if ( $type == "bet" ){
  $rand = rand(1, 1000);
  $betteam = $_POST['team'];
  $chance = $_POST['chance'];
  $betsize = $_POST['betsize'];
  $win = round((100 / $chance) * $betsize, 2);
  $comissionwin = $win / 100 * 10;
  $win -= $comissionwin;

 if ( $betteam != "red" and $betteam != "blue" || empty($betteam) ){

        $msgType = "nerror";
        $msg = "Выберите цвет";

    }
    if ( $betsize < $minbet ){

        $msgType = "nerror";
        $msg = "Минимальная ставка - $minbet монет";

    }
    if ( $betsize > $maxbet ){

        $msgType = "nerror";
        $msg = "Максимальная ставка - $maxbet монет";

    }

    if ( $ubalance < $betsize ){

        $msgType = "nerror";
        $msg = "Недостаточно монет на балансе";

    }
    if ( !is_numeric($betsize) || !is_numeric($chance) ){

         $msgType = "nerror";
        $msg = "Ошибка!";


    }

  if (!preg_match("#^[.0-9]+$#",$betsize) || !preg_match("#^[.0-9]+$#",$chance) ) {
    $msgType = "nerror";
   $msg = "Недопустимые символы!";
  }

  if(mysqli_query($bsd, "SELECT * FROM users WHERE id='$uid'")->num_rows != 1) {
 $msgType = "nerror";
 $msg = "Авторизуйтесь!";

  }

  if($msgType != "nerror") {
  if($betteam == "red") {
    $win_range = ($chance / 100) * 1000;
    if($rand > $win_range) {
       $balance = round($ubalance - $betsize,2);
     mysqli_query($bsd, "UPDATE `users` SET balance = '$balance' WHERE id = '$uid'");
     mysqli_query($bsd, "INSERT INTO `games` (`user_id`, `bet`, `number`,`color`, `dropcolor`,`chance`, `data`) VALUES ('$uid', '$betsize', '$rand', 'red', 'blue', '$chance', NOW());");

   $msg = "Вы проиграли! Номер билета: $rand";
     $msgType = "error";
    }
    if($rand <= $win_range) {
       $balance = round(($ubalance + $win) - $betsize,2);
     mysqli_query($bsd, "UPDATE `users` SET balance = '$balance' WHERE id = '$uid'");
     mysqli_query($bsd, "INSERT INTO `games` (`user_id`, `bet`, `number`,`color`, `dropcolor`, `chance`, `data`) VALUES ('$uid', '$betsize', '$rand', 'red', 'red', '$chance', NOW());");

      $msgType = "success";
    }
  }

 if($betteam == "blue") {
   $win_range = 1000 - ($chance / 100) * 1000;
    if($rand < $win_range) {
     $balance = round($ubalance - $betsize,2);
     mysqli_query($bsd, "UPDATE `users` SET balance = '$balance' WHERE id = '$uid'");
     mysqli_query($bsd, "INSERT INTO `games` (`user_id`, `bet`, `number`,`color`, `dropcolor`, `chance`, `data`) VALUES ('$uid', '$betsize', '$rand', 'blue', 'red', '$chance', NOW());");
     $msg = "Вы проиграли! Номер билета: $rand";
     $msgType = "error";
    }
    if($rand >= $win_range) {
        $balance = round(($ubalance + $win) - $betsize,2);
     mysqli_query($bsd, "UPDATE `users` SET balance = '$balance' WHERE id = '$uid'");
     mysqli_query($bsd, "INSERT INTO `games` (`user_id`, `bet`, `number`,`color`, `dropcolor`, `chance`, `data`) VALUES ('$uid', '$betsize', '$rand', 'blue', 'blue', '$chance', NOW());");
     $msgType = "success";
    }
  }
  }

  $result = array(
  'msgType' => "$msgType",
  'msg' => "$msg",
    'number' => "$rand",
    'win' => "$win"
    );

}
/* game functional end*/


/* REG && LOGIN */

if ( isset($_POST['token']) ){

                    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
                    $user = json_decode($s, true);
  $network = $user['network']; //- соц. сеть, через которую авторизовался игрок
  $vkid = $user['identity']; //- уникальная строка определяющая конкретного игрока соц. сети
  $firstname = $user['first_name']; //- имя игрока
  $lastname = $user['last_name']; //- фамилия игрока
  $photoimg = $user['photo_big']; //- аватарка

  $fullname = mysqli_real_escape_string($bsd, htmlspecialchars($firstname.' '.$lastname));
if ( !empty($vkid) ){
 $result = '';
$count = 32;
    $array = array_merge(range('a','z'), range('0','9'));
    for($i = 0; $i < $count; $i++){
                $result .= $array[mt_rand(0, 35)];
    }

$result .= $vkid;

  $newsid = hash('sha512', $result);

  $selectuser = mysqli_query($bsd, "SELECT * FROM `users` WHERE vk_url='$vkid'");

  if ( $selectuser->num_rows == 1 ){
        mysqli_query($bsd, "UPDATE `users` SET `sid` = '$newsid' WHERE vk_url='$vkid'");
        setcookie("sid", "$newsid");
        header("Location: /");

  }elseif ( $selectuser->num_rows < 1 ){

        $rcode = mysqli_query($bsd, "SELECT * FROM `users`")->num_rows;
        if ( $rcode < 100000 ){
                $newrcode = $rcode + 1;
                $rcode = str_pad($newrcode, 6, "0", STR_PAD_LEFT);
                $rcode = range('A','Z')[mt_rand(0,25)] . $rcode;

        }else{

                $rcode = range('A','Z')[mt_rand(0,25)] . $rcode + 1;

        }

        mysqli_query($bsd, "INSERT INTO `users` (`name`,`prava`,`balance`,`sid`,`img`,`vk_url`,`ref_code`,`warns`,`ban`,`online`,`regdate`) VALUES ('$fullname', '0', '0', '$newsid', '$photoimg', '$vkid', '$rcode', '0', '0', '0', NOW());");
         setcookie("sid", "$newsid");
        header("Location: /");

  }

}
/* END REG && LOGIN */
}else{


echo json_encode($result);
}
?>