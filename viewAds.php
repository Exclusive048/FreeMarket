<?php
  include ("config.php");
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];  
  }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Просмотр объявления</title>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/shop-homepage.css" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 </head>
<body>
<?php
include("navbar.php");
$id_ad=$_GET['id'];
$result = mysql_query("SELECT * FROM user WHERE block_user=0 ",$db);
$result2 = mysql_query("SELECT * FROM advert WHERE id_ad='$id_ad'",$db);
$myrow2 = mysql_fetch_array($result2);
?>
        <br>
        <br>
        <br>
        <br>

<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="userData ml-3">
                            <br>
                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?php echo $myrow2['name_ad']; ?></a></h2>
                        <br>
<?php
if($myrow2['advertAction_ad']=='1')
{
?>  
                                                                                    <a class="btn btn-outline-danger" href="complain.php?id=<?php echo $myrow2['id_ad'];?>" role="button">Пожаловаться на объявление</a>
<?php
}
else
{   
?>
                                                                                    <a href="#" class="btn btn-danger">Заблокировано</a>
                                                                                    <br>
                                                                                    <br>
                                                                                    <a href="unblocked_ad.php?id=<?php echo $myrow2['id_ad'];?>" class="btn btn-primary">Разблокировать объявление </a>
<?php
}
?>     
                    </div>
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                
                                <div class="image-container">
                                    <?php  echo '<img class="card-img-top" style="width: 350px; height: 350px" src="data:image/jpeg;base64,' . base64_encode( $myrow2['photo_ad'] ) . '" />'  ?>
                                    <!-- <img src="img/kek2.png" id="imgProfile" style="width: 400px; height: 400px" class="img-thumbnail" />   -->
                                </div>
                                
                                <div class="container">
                            
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            
    
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Описание товара</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                   <?php echo $myrow2['description_ad']; ?>
                                                </div>
                                            </div>
                                            <hr />
    
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Предложение</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?php echo $myrow2['item_ad']; ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">E-mail</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?php if ($myrow2['email_ad'] == 1){ ?>
                                                    <p> <?php echo $myrow['email_user']?> </p>
                                                    <?php }else { echo "Не указан";} ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Телефон</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?php if ($myrow2['phone_ad'] == 1){ ?>
                                                    <p> <?php echo $myrow['phone_user']?> </p>
                                                    <?php }else { echo "Не указан";} ?>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Адрес</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?php if ($myrow2['address_ad'] == 1){ ?>
                                                    <p> <?php echo $myrow['address_user']?> </p>
                                                    <?php }else { echo "Не указан";} ?>
                                                </div>
                                                
                                            </div>
                                            
                                            <hr />
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