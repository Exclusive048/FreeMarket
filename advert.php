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
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!2"); 
  }
  $result = mysql_query("SELECT * FROM    user WHERE id_user='$id'",$db); 
  $myrow =    mysql_fetch_array($result);//Извлекаем все данные    пользователя с данным id
  if (empty($myrow['email_user'])) 
  {    
    exit("Пользователя не существует! Возможно он был удален.");
  }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Создать Объявление</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include("navbar.php");
if ($myrow['email_user'] == $email) 
{
?>
    <br>
    <br>
    <br>
    <br>
        <div class="container">
            <form action='save_advert.php' method='post' enctype='multipart/form-data'>
                <div class="form-group">
                    <label>Добавить фото</label>
                    <input type="file" name="itemImage" required class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Название объявления</label>
                    <input class="form-control" required name="nameAdvert" id="exampleFormControlTextarea1" placeholder="Название"  value=""></input>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание товара</label>
                    <textarea class="form-control"required name="itemInfo" id="exampleFormControlTextarea1"placeholder="Описание" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Предложение</label>
                    <textarea class="form-control" required name="itemChanged" id="exampleFormControlTextarea1"placeholder="Предложение" rows="5"></textarea>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  name="checkPhone" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Показать телефон</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  name="checkEmail" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">Показать Email</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"  name="checkAddress" type="checkbox" id="inlineCheckbox3" value="option3">
                    <label class="form-check-label" for="inlineCheckbox3">Показать адрес</label>
                </div>
                <br>
                <br>
                <input type='submit' name='submit' value='Создать объявление'>
            </form>
        </div>
        
        <br>
<?php
}
 include("footer.php");
?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>    