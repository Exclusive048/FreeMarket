<?php
include ("config.php");
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id']; 
  }
  else
  { 
    exit("Вы зашли на    страницу без параметра!");
  }
  if (!empty($_SESSION['email']) and !empty($_SESSION['password']))
  {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $result2 = mysql_query("SELECT * FROM user WHERE email_user='$email' AND pass_user='$password'",$db); 
    $myrow2 = mysql_fetch_array($result2); 
  }
  else 
  {
    var_dump($_SESSION['password']);
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!2"); 
  }
  $result = mysql_query("SELECT * FROM    user WHERE id_user='$id'",$db); 
  $myrow = mysql_fetch_array($result);
    $result3 = mysql_query("SELECT * FROM advert WHERE id_users='$id'",$db); 
  $num=mysql_num_rows($result3);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Профиль Админа</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/shop-homepage.css" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include("navbar.php");
?>
        <br>
        <br>
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
                                    <li class="nav-item">
                                        <a class="nav-link" id="allAds-tab" data-toggle="tab" href="#allAds" role="tab" aria-controls="allAds" aria-selected="false">Объявления на сайте</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="complaint-tab" data-toggle="tab" href="#complaint" role="tab" aria-controls="complaint" aria-selected="false">Жалобы</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Список пользователей</a>
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

                                        <div class="tab-pane fade" id="allAds" role="tabpanel" aria-labelledby="allAds-tab">
                                                <div class="container-fluid">
                                                        <div class="col-lg-12">
                                                            <div class="row">
<?php
	$resultAll = mysql_query("SELECT * FROM user WHERE block_user=0 ",$db);
	$myrowAll = mysql_fetch_array($resultAll);
  	$result2All = mysql_query("SELECT * FROM advert ",$db);
  while($myrow2All = mysql_fetch_array($result2All))
  {
?>
                                                        <div class="col-lg-6 col-md-6 mb-4  ">
                                                            <div class="card h-100 " style="text-align: center!important;">
                                                                <?php  echo '<a><img class="card-img-top" style="height: 400px;"  src="data:image/jpeg;base64,' . base64_encode( $myrow2All['photo_ad'] ) . '"alt="" /></a>'  ?>
                                                                <div class="card-body" >
                                                                    <h4 class="card-title ">
                                                                    <a href="#"><?php echo $myrow2All['name_ad']?></a>
                                                                    </h4>
                                                                    <h5><?php echo $myrow2All['description_ad']?></h5>
                                                                    <p class="card-text"><?php echo $myrow2All['item_ad']?> </p>
                                                                    <a class="btn btn-primary" href="viewAds.php?id=<?php echo $myrow2All['id_ad'];?>" role="button">Посмотреть</a>
                                                                <?php 
if($myrow2All['advertAction_ad']=='1')
{
?>	
                                                                                    <a href="blocked_ad.php?id=<?php echo $myrow2All['id_ad'];?>" class="btn btn-danger">Заблокировать объявление</a>
<?php
}
else
{	
?>
																					<a href="#" class="btn btn-danger">Заблокировано</a>
																					<br>
																					<br>
																					<a href="unblocked_ad.php?id=<?php echo $myrow2All['id_ad'];?>" class="btn btn-primary">Разблокировать объявление </a>
<?php
}
?>
                                                                </div>
                                                            </div>
                                                        </div>
<?php
}
?>
                                                            </div>            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
                                                        <div class="container">
                                                                
                                                                    <div class="row">
<?php
$resultAll = mysql_query("SELECT * FROM user",$db);
while($myrowAll = mysql_fetch_array($resultAll))
{
?>
                                                                            <div class="col-sm-12">
                                                                            <div class="card text-center">
                                                                                <div class="card-header">
                                                                                    <?php echo $myrowAll['fio_user'];?>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title"><?php echo $myrowAll['email_user'];?></h5>
                                                                                    <p class="card-text"><?php echo $myrowAll['info_user'];?></p>
<?php
if($_SESSION['id']==$myrowAll['id_user'])
{
	if($myrowAll['admin_user']==1)
	{
?>
																					<a href="adminProfile.php" class="btn btn-primary">Профиль пользователя</a>
                                                                                    <br>
                                                                                    <br>
<?php	
}
	else
	{
?>
																					<a href="page.php" class="btn btn-primary">Профиль пользователя</a>
                                                                                    <br>
                                                                                    <br>
<?php	
	}
}
else
{
?>
                                                                                    <a href="page_users.php?id=<?php echo $myrowAll['id_user'];?>" class="btn btn-primary">Профиль пользователя</a>
                                                                                    <br>
                                                                                    <br>	
<?php
}
if($myrowAll['block_user']=='0')
{
?>	
                                                                                    <a href="blocked.php?id=<?php echo $myrowAll['id_user'];?>" class="btn btn-danger">Заблокировать пользователя </a>
<?php
}
else
{	
?>
																					<a href="#" class="btn btn-danger">Заблокирован</a>
																					<a href="unblocked.php?id=<?php echo $myrowAll['id_user'];?>" class="btn btn-primary">Разблокировать пользователя </a>
<?php
}
?>
                                                                                </div>
                                                                                <div class="card-footer text-muted">
<?php 
if($myrowAll['admin_user']==1)
{
	echo "Администратор";
}
else
{
	echo "Пользователь";
} 
?>
                                                                                </div>
                                                                            </div>    
                                                                            <br>          
                                                                 			</div>
<?php
}
?>
                                                        			</div>
                                                		</div>
                                    			</div>
                                    			
                                    				<div class="tab-pane fade" id="complaint" role="tabpanel" aria-labelledby="complaint-tab">
                                                        <div class="container">
                                                                
                                                                    <div class="row">
<?php
$resultComp = mysql_query("SELECT * FROM complain",$db);
while($myrowComp = mysql_fetch_array($resultComp))
{
?>
                                                                            <div class="col-sm-12">
                                                                            <div class="card text-center">
                                                                                <div class="card-header">
                                                                                    Новая жалоба
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title"><?php echo $myrowComp['name_comp'];?></h5>
                                                                                    <p class="card-text"><?php echo $myrowComp['description_comp'];?></p>
                                                                                    <a href="viewAds.php?id=<?php echo $myrowComp['id_advert'];?>" class="btn btn-primary">Просмотреть объявление</a>
                                                                                    <a href="delete_complain.php?id=<?php echo $myrowComp['id_advert'];?>" class="btn btn-success">Отклонить жалобу</a>
                                                                                </div>
                                                                                <div class="card-footer text-muted">
                                                                                    Жалоба поступила <?php echo $myrowComp['date_comp'];?>
                                                                                </div>
                                                                            </div>    
                                                                            <br>          
                                                                 			</div>
<?php
}
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
<br>
<br>
<br>
<?php
include("footer.php");
?>   
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>