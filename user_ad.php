<?php
  session_start();
  include ("bd.php");// файл bd.php должен быть в той же папке, что и все    остальные, если это не так, то просто измените путь 
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];
    
  } //id "хозяина" странички 
  else
  { 
    exit("Вы зашли на    страницу без параметра!");
  } 

$result = mysql_query("SELECT * FROM advert A
  WHERE A.id_users = ".$_SESSION['id']."
    ORDER by A.id_users DESC");

// узнаем количество товаров в этой категории    
$num = mysql_num_rows ($result);
$result1 = mysql_query("SELECT * FROM user WHERE id_user=".$_SESSION['id']."",$db);
$row = mysql_fetch_array($result1);
$phone_us = $row['phone_user'];
if ($num)
{
    echo "<strong><center>Количество объявлений:
     ".$num."</strong></center><br>";
    // используем ф-ию для постраничной навигации
?>
<html>
<head>
  <meta charset="utf-8">
  <link href="bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
</html>
<?php
    // лепим массив в цикле
    while($myrow2 = mysql_fetch_assoc($result))
    {    
?>
<div class="row mb-5">
            <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card card-inverse card-primary ">
                  <?php  echo '<img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode( $myrow2['photo_ad'] ) . '" />'  ?>
                    <blockquote class="card-blockquote p-3">
                        <p><?php echo $myrow2['description_ad']?> </p>
                        <p><?php echo $myrow2['item_ad']?> </p>
                        <div class="card-footer">
                            <small>
                              
                          <?php if ($myrow2['phone_ad'] == 1): ?>
                            <p> <?php echo $row['phone_user']?> </p>
                          <?php endif; ?>
                          <?php if ($myrow2['email_ad'] == 1): ?>
                            <p> <?php echo $row['email_user']?> </p>
                          <?php endif; ?>
                          <?php if ($myrow2['address_ad'] == 1): ?>
                            <p> <?php echo $row['address_user']?> </p>
                          <?php endif; ?>
                            </small>
                        </div>
                        <form action = change_ad.php?id= method="post">
                        <button class="btn btn-secondary float-right btn-sm">Редактировать</button>
                      </form>
                    </blockquote>
                </div>
            </div>
</div>
<?php
}}
?>