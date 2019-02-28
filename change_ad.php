<?php
 include ("config.php");
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];
    
  } //id "хозяина" странички 
  else
  { 
    exit("Вы зашли на    страницу без параметра!");
  } 

  if (!empty($_SESSION['email']) and !empty($_SESSION['password']))
  {
    //если    существует логин и пароль в сессиях, то проверяем, действительны ли они
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $result2 = mysql_query("SELECT * FROM user WHERE email_user='$email' AND pass_user='$password'",$db); 
    $myrow2 = mysql_fetch_array($result2); 
    if (empty($myrow2['id_user']))
      {
      //Если не действительны (может мы удалили    этого пользователя из базы за плохое поведение)

      exit("Вход на эту страницу разрешен только зарегистрированным пользователям!1");
      }
  }
  else 
  {
    //Проверяем,    зарегистрирован ли вошедший
    
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!2"); 
  }
  $result = mysql_query("SELECT * FROM    user WHERE id_user='$id'",$db); 
  $myrow =    mysql_fetch_array($result);//Извлекаем все данные    пользователя с данным id
  if (empty($myrow['email_user'])) 
  {    
    exit("Пользователя не существует! Возможно он был удален.");
  } //если такого не существует
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Объявления</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
include("navbar.php");
if ($myrow['email_user'] == $email) 
{
  $id_ad = $_GET['id'];

  $result3 = mysql_query("SELECT * FROM advert where id_ad='$id_ad' ",$db);
  $myrow3=mysql_fetch_array($result3);
  $checkPhone = $myrow3['phone_ad'];
  $checkEmail = $myrow3['email_ad'];
  $checkAddress = $myrow3['address_ad'];
?>
<body>
<br>
<br>
<br>

        <div class="container">
            <form action='update_advert.php' method='post'  enctype='multipart/form-data'>
                <div class="form-group">
                    <label>Добавить фото</label>
                    <input type="file" name="itemImage" class="form-control-file">
                </div>
                 <div class="form-group">
                    <label for="exampleFormControlTextarea1">Название объявления</label>
                    <input class="form-control" required name="nameAdvert" id="exampleFormControlTextarea1" value="<?php echo $myrow3['name_ad']?>"></input>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание товара</label>
                    <textarea class="form-control" required name="itemInfo" id="exampleFormControlTextarea1" rows="5"><?php echo $myrow3['description_ad']?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Предложение</label>
                    <textarea class="form-control" required name="itemChanged" id="exampleFormControlTextarea1" rows="5"><?php  echo $myrow3['item_ad'] ?></textarea>
                    <input type="hidden"  name="idAdvert" value="<?php  echo $id_ad ?>">
                </div>
                <div class="form-check form-check-inline">
<?php
   if($checkPhone==1) 
  {
    echo ("<input class='form-check-input' name='checkPhone' type='checkbox' id='inlineCheckbox1' checked >"); 
  }
  else
  {
    echo "<input class='form-check-input' name='checkPhone' type='checkbox' id='inlineCheckbox1' >";
  }
?>
                <label class="form-check-label" for="inlineCheckbox1">Показать телефон</label>
                </div>
                <div class="form-check form-check-inline">
<?php
   if($checkEmail==1) 
  {
    echo ("<input class='form-check-input' name='checkEmail' type='checkbox' id='inlineCheckbox2' value='option2' checked >"); 
  }
  else
  {
    echo "<input class='form-check-input' name='checkEmail' type='checkbox' id='inlineCheckbox2' value='option2' >";
  }
?>
                    <label class="form-check-label" for="inlineCheckbox2">Показать Email</label>
                </div>
                <div class="form-check form-check-inline">
<?php
   if($checkAddress==1) 
  {
    echo ("<input class='form-check-input' name='checkAddress' type='checkbox' id='inlineCheckbox3' value='option3' checked >"); 
  }
  else
  {
    echo "<input class='form-check-input' name='checkAddress' type='checkbox' id='inlineCheckbox3' value='option3' >";
  }
?>
                    <label class="form-check-label" for="inlineCheckbox3">Показать адрес</label>
                </div>
                <br>
                <br>
                <input type='submit' name='submit' value='Создать объявление'>
            </form>
        </div>
        
        <br>
<?php
include("footer.php");
}
?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>