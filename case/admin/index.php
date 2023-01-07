<?php
include("../assets/config.php");
$me = mysqli_query($bsd, "SELECT * FROM `users` WHERE sid='$_COOKIE[sid]'");
if ( $mm = $me->fetch_array() ){

$prava = $mm['prava'];
$uname = $mm['name'];
$uava = $mm['img'];
}

if ( $prava != 1 ){

header("Location: /");

}else{
//сумма пополнений за неделю
$lastweekdeps = mysqli_query($bsd, "SELECT SUM(size) FROM `deposits` WHERE data > NOW() - INTERVAL 7 DAY");
$lastweekdeps = $lastweekdeps->fetch_array()['SUM(size)'];
//сумма выплат в ожидании
$wwsum = mysqli_query($bsd, "SELECT SUM(amount) FROM `withdraws` WHERE `status`='0'");
$wwsum = round($wwsum->fetch_array()['SUM(amount)'],2);
//новых пользователей за ласт вик
$newusers = mysqli_query($bsd, "SELECT * FROM `users` WHERE regdate > NOW() - INTERVAL 7 DAY;");
$newusers = $newusers->num_rows;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админ-панель</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/noty-2.4.1/js/noty/packaged/jquery.noty.packaged.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/google-code-prettify/prettify.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/share.min.js"></script>
    <script type="text/javascript" src="https://ned.im/noty/v2/vendor/showdown/showdown.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>



        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?=$uava?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?=$uname?></span>
                  <span class="text-secondary text-small">Администратор</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" hrefl="/admin">
                <span class="menu-title">Главная</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/users.php">
                <span class="menu-title">Пользователи</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin/prefix.php">
                <span class="menu-title">Привилегии</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/admin/withdraws.php">
                <span class="menu-title">Выплаты</span>
                <i class="mdi mdi-arrow-bottom-left-bold-outline menu-icon"></i>
              </a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="/admin/deposits.php">
                <span class="menu-title">Пополнения</span>
                <i class="mdi mdi-arrow-top-right-bold-outline menu-icon"></i>
              </a>
            </li>

            <li class="nav-item sidebar-actions">
              <span class="nav-link">


                  <a href="/"><button class="btn btn-block btn-lg btn-gradient-primary mt-4"><i class="mdi mdi-arrow-left"></i></button></a>

              </span>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Главная </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Статистика проекта <i title="Скрипт куплен в ScriptArchive / у пользователя Enigman / Никиты Корнеева" class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Пополнения за последнюю неделю <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><i class="mdi mdi-currency-rub"></i> <?=$lastweekdeps?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Сумма выплат в обработке <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><i class="mdi mdi-currency-rub"></i> <?=$wwsum?></h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Новых пользователей за последнюю неделю <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?=$newusers?></h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Настройка проекта</h4>
                      <button class="btn btn-gradient-success float-right" id="saveSettings" onClick="saveSettings();">Сохранить</button>
                    </div>
                    <script>
                        function saveSettings(){

                            var sitename = $("#sitename").val(),
                            sitedomain = $("#sitedomain").val(),
                            vkgroup = $("#vkgroup").val(),
                            vkgid = $("#vkgid").val(),
                            vkgtoken = $("#vkgtoken").val(),
                            minbet = $("#minbet").val(),
                            maxbet = $("#maxbet").val(),
                            minvivod = $("#minvivod").val(),
                            changecolorsum = $("#changecolorsum").val(),
                            changenicksum = $("#changenicksum").val(),
                            chatunbansum = $("#chatunbansum").val(),
                            standartbonus = $("#standartbonus").val(),
                            merchant_id = $("#merchant_id").val(),
                            merchant_secret_1 = $("#merchant_secret_1").val(),
                            merchant_secret_2 = $("#merchant_secret_2").val(),
                            recaptchasitekey = $("#recaptchasitekey").val(),
                            recaptchasecretkey = $("#recaptchasecretkey").val(),
                            refsum = $("#refsum").val();
                            $.ajax({

                                type: 'POST',
                                url: 'adminengine.php',
                                data: {
                                    type: 'saveSettings',
                                    sitename: sitename,
                                    sitedomain: sitedomain,
                                    vkgroup: vkgroup,
                                    vkgid: vkgid,
                                    vkgtoken: vkgtoken,
                                    minbet: minbet,
                                    maxbet: maxbet,
                                    minvivod: minvivod,
                                    changecolorsum: changecolorsum,
                                    changenicksum: changenicksum,
                                    chatunbansum: chatunbansum,
                                    standartbonus: standartbonus,
                                    merchant_id: merchant_id,
                                    merchant_secret_1: merchant_secret_1,
                                    merchant_secret_2: merchant_secret_2,
                                    recaptchasitekey: recaptchasitekey,
                                    recaptchasecretkey: recaptchasecretkey,
                                    refsum: refsum,

                                },
                                  beforeSend: function(){

                                      $("#saveSettings").prop("disabled","disabled");
                                  },
                                  success: function(data){
  $("#saveSettings").prop("disabled","");
                                      var obj = jQuery.parseJSON(data);
                                      if (obj.msgType == "success" ){
                                   noty({
    text: 'Изменения сохранены!',
    type: 'success',
    timeout: 4000,
  });
}else{

          noty({
    text: obj.msg,
    type: 'error',
    timeout: 4000,
  });

}
                                  },
                                  error: function(){
 $("#saveSettings").prop("disabled","");
                                   noty({
    text: "Ошибка подключения",
    type: 'error',
    timeout: 4000,
  });

                                  }


                            });



                        }

                    </script>
<div class="row">
    <div class="col-md-6 grid-margin">
                      <h5>Обязательные настройки</h5>
                    <label>Название сайта:</label>
                    <input class="form-control" id="sitename" value="<?=$sitename?>" placeHolder="ScriptArchive" style="width: 50%"/>
                 <br>
                    <label>Домен сайта:</label>
                    <input class="form-control" id="sitedomain" value="<?=$sitedomain?>" placeHolder="script-archive.fun" style="width: 50%"/>

                  <br>
                    <label>Группа ВК:</label>
                    <input class="form-control" id="vkgroup" value="<?=$vkgroup?>" placeHolder="https://vk.com/script.archive" style="width: 50%"/>
                   </div>
   <div class="col-md-6 grid-margin">
                      <h5>VK API</h5>
                    <label>ID группы ВК:</label>
                    <input class="form-control" type="number" id="vkgid" value="<?=$vkgid?>" placeHolder="191281518" style="width: 50%"/>
                 <br>
                    <label>Токен группы ВК:</label>
                    <input class="form-control" id="vkgtoken" value="<?=$vkgtoken?>" placeHolder="23c1efe5033eb1a9e782d###########################################1a73c2f85fab958c661f5" style="width: 50%"/>
                  </div>

   <div class="col-md-6 grid-margin">
                      <h5>Основные настройки сайта</h5>
                    <label>Минимальная ставка</label>
                    <input class="form-control" type="number" min="0" id="minbet" value="<?=$minbet?>" placeHolder="1" style="width: 50%"/>
                 <br>
                    <label>Максимальная ставка:</label>
                    <input class="form-control" type="number" min="0" id="maxbet" value="<?=$maxbet?>" placeHolder="2000" style="width: 50%"/>

                  <br>
                    <label>Минимальная сумма вывода:</label>
                    <input class="form-control" type="number" min="0" id="minvivod" value="<?=$minvivod?>" placeHolder="50" style="width: 50%"/>
                  <br>
                    <label>Сумма за активацию реф.кода:</label>
                    <input class="form-control" type="number" min="0" id="refsum" value="<?=$refsum?>" placeHolder="1" style="width: 50%"/>

                  </div>
                  <div class="col-md-6 grid-margin">
                    <h5>&nbsp;</h5>
                    <label>Цена за смену цвета ника:</label>
                    <input class="form-control" type="number" min="0"  id="changecolorsum" value="<?=$changecolorsum?>" placeHolder="25" style="width: 50%"/>

                  <br>
                    <label>Цена за смену ника:</label>
                    <input class="form-control" type="number" min="0"  id="changenicksum" value="<?=$changenicksum?>" placeHolder="25" style="width: 50%"/>

                  <br>
                    <label>Цена за разбан в чате:</label>
                    <input class="form-control" type="number" min="0" id="chatunbansum" value="<?=$chatunbansum?>" placeHolder="25" style="width: 50%"/>

                  <br>
                    <label>Стандартный бонус:</label>
                    <input class="form-control" type="number" min="0"  id="standartbonus" value="<?=$standartbonus?>" placeHolder="0.1" style="width: 50%"/>
                  </div>
                  <div class="col-md-6">
                    <h5>FREE-KASSA</h5>
                     <label>ID Мерчанта:</label>
                    <input class="form-control" type="number" min="1" id="merchant_id" value="<?=$merchant_id?>" placeHolder="99999" style="width: 50%"/>
                        <br>
                     <label>Секретный ключ №1:</label>
                    <input class="form-control" placeHolder="abcdefg" id="merchant_secret_1" value="<?=$merchant_secret_1?>"style="width: 50%"/>
                        <br>
                     <label>Секретный ключ №2:</label>
                    <input class="form-control" placeHolder="gfedcba" id="merchant_secret_2" value="<?=$merchant_secret_2?>"style="width: 50%"/>

                  </div>
                  <div class="col-md-6">
                    <h5>RECAPTCHA</h5>
                     <label>Ключ сайта</label>
                    <input class="form-control" id="recaptchasitekey" value="<?=$recaptchasite?>" style="width: 50%"/>
                        <br>
                     <label>Секретный ключ:</label>
                    <input class="form-control" id="recaptchasecretkey" value="<?=$recaptchasecret?>"style="width: 50%"/>

                  </div>

</div>



                  </div>
                </div>
              </div>


            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Последние пользователи</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Имя </th>
                            <th> Баланс </th>
                            <th> Дата регистрации </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $query = mysqli_query($bsd, "SELECT * FROM `users` ORDER BY id DESC LIMIT 5");

                            while ( ($uu = $query->fetch_array())){

                                $p.= "<tr>
                                <td>$uu[id]</td>
                            <td>
                              <img src=\"$uu[img]\" class=\"mr-2\" alt=\"image\"> $uu[name] </td>
                            <td> $uu[balance] </td>
                            <td> $uu[regdate] </td>
                          </tr>";

                            }

                              echo $p;
                          ?>


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">https://vk.com/kur4ch_yt</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Сделано в ScriptArchive с  <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>

    <!-- End custom js for this page -->
  </body>
</html>