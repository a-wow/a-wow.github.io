<?php
include("../assets/config.php");
$type = $_POST['type'];
$msgType = "success";
$msg = "";
$me = mysqli_query($bsd, "SELECT * FROM `users` WHERE sid='$_COOKIE[sid]'");
if ( $mm = $me->fetch_array() ){

$prava = $mm['prava'];
$uname = $mm['name'];
$uava = $mm['img'];
}

if ( $prava == 1 ){
	if ( $type == "deletePrefix" ){

$id = $_POST['id'];

if ( mysqli_query($bsd, "SELECT * FROM `prefix` WHERE id='$id'")->num_rows != 1 ){

$msgType = 'error';
$msg = 'Префикс не существует!';

}
if ( $msgType == 'success' ){

mysqli_query($bsd, "DELETE FROM `prefix` WHERE id='$id'");

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");
	}
	if ( $type == "addPrefix" ){
$prefixname = $_POST['prefixname'];
$deposit = $_POST['deposit'];
$bonussize = $_POST['bonussize'];
$prefixcolor = $_POST['prefixcolor'];
if ( empty($prefixname) || !is_numeric($deposit) || !is_numeric($bonussize) || empty($prefixcolor) ){

$msgType = 'error';
$msg = 'Заполните все поля!';

}
if ( $msgType == 'success' ){

mysqli_query($bsd, "INSERT INTO `prefix` (`prefix`, `deposit`, `bonussize`, `color`) VALUES ('$prefixname', '$deposit', '$bonussize', '$prefixcolor');");

}
		$result = array("msgType"=>"$msgType","msg"=>"$msg");
	}
	if ( $type == "saveEditUser" ){
$userid = $_POST['userid'];
$usname = $_POST['usname'];
$usnamecolor = str_replace('#', '', $_POST['usnamecolor']);
$usbal = $_POST['usbal'];
$usprava = $_POST['usprava'];
$usrefcode = $_POST['usrefcode'];
$uswarns = $_POST['uswarns'];
$usban = $_POST['usban'];

if ( !is_numeric($userid) || !is_numeric($usprava) || !is_numeric($usbal) || !is_numeric($uswarns) || !is_numeric($usban) || empty($usname) || empty($usrefcode) ){

$msgType = "error";
$msg = "Заполните все поля!";

	}
if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `users` SET `name` = '$usname' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `namecolor` = '$usnamecolor' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `balance` = '$usbal' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `prava` = '$usprava' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `ref_code` = '$usrefcode' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `warns` = '$uswarns' WHERE id='$userid'");
mysqli_query($bsd, "UPDATE `users` SET `ban` = '$usban' WHERE id='$userid'");

}
$result = array("msgType"=>"$msgType","msg"=>"$msg");

	}
if ( $type == "withdrawStatus" ){

	$wid = $_POST['id'];
	$status = $_POST['status'];
		if (mysqli_query($bsd, "SELECT * FROM `withdraws` WHERE id='$wid'")->num_rows != 1 ){

				$msgType = "error";
				$msg = "Выплаты не существует!";

		}else{
				mysqli_query($bsd, "UPDATE `withdraws` SET `status`='$status' WHERE id='$wid'");
				$msgType = "success";
		}

		$result = array("msgType"=>"$msgType","msg"=>"$msg");

}
if ( $type == "saveSettings" ){
$sn = $_POST['sitename'];
$sd = $_POST['sitedomain'];
$vgroup = $_POST['vkgroup'];
$vid = $_POST['vkgid'];
$vtoken = $_POST['vkgtoken'];
$mvivod = $_POST['minvivod'];
$mnbet = $_POST['minbet'];
$mxbet = $_POST['maxbet'];
$ccs = $_POST['changecolorsum'];
$cns = $_POST['changenicksum'];
$cus = $_POST['chatunbansum'];
$sb = $_POST['standartbonus'];
$mi = $_POST['merchant_id'];
$ms1 = $_POST['merchant_secret_1'];
$ms2 = $_POST['merchant_secret_2'];
$rsk1 = $_POST['recaptchasitekey'];
$rsk2 = $_POST['recaptchasecretkey'];
$rsum = $_POST['refsum'];

if ( empty($sn) || empty($sd) || empty($rsum) || !is_numeric($rsum) || empty($vgroup) || empty($vid) || empty($vtoken) || empty($mnbet) || empty($mxbet) || empty($ccs) || empty($cns) || empty($cus) || empty($sb) || empty($mi) || empty($ms1) || empty($ms2) || empty($mvivod) || empty($rsk1) || empty($rsk2) || !is_numeric($mnbet) || !is_numeric($mxbet) || !is_numeric($vid) || !is_numeric($ccs) || !is_numeric($cns) || !is_numeric($mvivod) || !is_numeric($cus) || !is_numeric($sb) || !is_numeric($mi)){

$msgType = "error";
$msg = "Заполните все поля!";

}
if ( $msgType == "success" ){

mysqli_query($bsd, "UPDATE `config` SET `name` = '$sn' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `domain` = '$sd' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `vkgroup` = '$vgroup' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `vkid` = '$vid' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `vktoken` = '$vtoken' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `minvivod` = '$mvivod' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `minbet` = '$mnbet' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `maxbet` = '$mxbet' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `changecolorsum` = '$ccs' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `changenicksum` = '$cns' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `chatunbansum` = '$cus' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `refsum` = '$rsum' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `standartbonus` = '$sb' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `merchant_id` = '$mi' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `merchant_secret_1` = '$ms1' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `merchant_secret_2` = '$ms2' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `recaptchasitekey` = '$rsk1' WHERE id='1'");
mysqli_query($bsd, "UPDATE `config` SET `recaptchasecretkey` = '$rsk2' WHERE id='1'");

}

$result = array("msgType"=>"$msgType","msg"=>"$msg");

}


}else{

$result = array("msgType"=>"error", "msg"=>"Вы не являетесь администратором!");

}


echo json_encode($result);
?>