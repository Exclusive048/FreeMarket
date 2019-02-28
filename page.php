<?php
 include ("config.php");
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];  
  }
  if (!empty($_SESSION['email']) and !empty($_SESSION['password']))
  {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $result2 = mysql_query("SELECT * FROM user WHERE email_user='$email' AND pass_user='$password'",$db); 
    $myrow2 = mysql_fetch_array($result2); 
    if (empty($myrow2['id_user']))
      {
      exit("Вход на эту страницу разрешен только зарегистрированным пользователям!1");
      }
  }
  else 
  {
    var_dump($_SESSION['password']);
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!2"); 
  }
  $result = mysql_query("SELECT * FROM    user WHERE id_user='$id'",$db); 
  $myrow =    mysql_fetch_array($result);
  $result3 = mysql_query("SELECT * FROM advert WHERE id_users='$id'",$db); 
  $num=mysql_num_rows($result3);
  if (empty($myrow['email_user'])) 
  {    
    exit("Пользователя не существует! Возможно он был удален.");
  }
?>
<!DOCTYPE html>
<html lang="ru"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Профиль</title>
</head>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/shop-homepage.css" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<body>
<?php
include("navbar.php");
?>
<br>
<br>

<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <?php  echo '<img class="img-thumbnail" style="width: 150px; height: 150px" src="data:image/jpeg;base64,' . base64_encode( $myrow2['photo_user'] ) . '" />'?>
                                      
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?php echo $myrow['fio_user']; ?></a></h2>
                                    <h6 class="d-block"><a href="javascript:void(0)"><?php echo $num; ?></a> Объявления было создано вами</h6>
                                    <a class="btn btn-primary" href="advert.php" role="button">Создать новое объявление</a>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Информация профиля</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="false">Мои объявления</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">ФИО</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $myrow['fio_user']; ?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">E-mail</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $myrow['email_user']; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Обо мне</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $myrow['info_user']; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Телефон</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $myrow['phone_user']; ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Адрес</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $myrow['address_user']; ?>
                                            </div>
                                            
                                        </div>
                                        
                                        <hr />
                                        <a class="btn btn-primary" href="changeProfile.php" role="button">Изменить профиль</a>
                                    </div>
                                    <div class="tab-pane fade" id="ads" role="tabpanel" aria-labelledby="ads-tab">
                                         <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="row">
<?php
$resultUs = mysql_query("SELECT * FROM    user WHERE id_user='$id'",$db); 
while($myrowUs = mysql_fetch_array($resultUs))
{
  $resultAd = mysql_query("SELECT * FROM advert WHERE id_users='$id'",$db);
  while($myrowAd = mysql_fetch_array($resultAd))
  {
?>   
                                                        <div class="col-lg-6 col-md-6 mb-4  ">
                                                            <div class="card h-100 " style="text-align: center!important;">
                                                                <?php  echo '<a><img class="card-img-top" style="height: 400px;"  src="data:image/jpeg;base64,' . base64_encode( $myrowAd['photo_ad'] ) . '"alt="" /></a>'  ?>
                                                                <div class="card-body" >
                                                                    <h4 class="card-title ">
                                                                    <a href="#"><?php echo $myrowAd['name_ad']?></a>
                                                                    </h4>
                                                                    <h5><?php echo $myrowAd['description_ad']?></h5>
                                                                    <p class="card-text"><?php echo $myrowAd['item_ad']?> </p>
                                                                    <a class="btn btn-primary" href="viewAds.php?id=<?php echo $myrowAd['id_ad'];?>" role="button">Посмотреть</a>
                                                                <a class="btn btn-primary" href="change_ad.php?id=<?php echo $myrowAd['id_ad'];?>" role="button">Редактировать</a>
                                                                </div>
                                                            </div>
                                                        </div>
<?php
}}
?>                                    
                                                  </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
    
</div>
<?php

 include("footer.php");
?>
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>