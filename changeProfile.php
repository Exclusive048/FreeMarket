<?php
  session_start();
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];
    
  } //id "хозяина" странички 
  else
  { 
    exit("Вы зашли на    страницу без параметра!");
  } //если не    указали id, то выдаем ошибку
  if (!preg_match("|^[\d]+$|", $id))    
  {
    exit("<p>Неверный    формат запроса! Проверьте URL</p>");//если id не число, то выдаем    ошибку
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
      exit("Вход на эту страницу разрешен только зарегистрированным пользователям!1");
      }
  }
  else 
  {
    var_dump($_SESSION['password']);
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!2"); 
  }
  $result = mysql_query("SELECT * FROM    user WHERE id_user='$id' ",$db); 
  $myrow =    mysql_fetch_array($result);//Извлекаем все данные    пользователя с данным id
?>
<!DOCTYPE html>
<html lang="ru"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Профиль</title>
</head>

<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<body>
<?php
include("navbar.php");
?>
<br>
<br>
<br>
        <div class="container">
            <form action='update_user.php' method='post' enctype='multipart/form-data'>
                <div class="form-group">
                    <label>Email</label>
                    <input name='email' type="email"required class="form-control" value="<?php echo $myrow['email_user']; ?>">
                </div>
                <div class="form-group">
                        <label>Пароль</label>
                        <input name='password' type="password"required class="form-control" value="<?php echo $myrow['pass_user']; ?>">
                </div>
                <div class="form-group">
                        <label>ФИО</label>
                        <input name='fio' type="fio"required class="form-control" value="<?php echo $myrow['fio_user']; ?>">
                </div>
                <div class="form-group">
                        <label>Телефон</label>
                        <input name='phone' type="phone" class="form-control" value="<?php echo $myrow['phone_user']; ?>">
                </div>
                <div class="form-group">
                        <label>Адрес</label>
                        <input name='address' type="address" class="form-control" value="<?php echo $myrow['address_user']; ?>">
                </div>
                <div class="form-group">
                        <label>Изменить аватар</label>
                        <input type="file" name="userImage" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Обо мне</label>
                    <textarea class="form-control" name="info" id="exampleFormControlTextarea1" rows="5"><?php echo $myrow['info_user']; ?></textarea>
                </div>
                <input type='submit' name='submit' value='Изменить'>
            </form>
        </div>
        
        <br>
<?php
include("footer.php");
?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>