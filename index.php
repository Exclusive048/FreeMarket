<?php 
    session_start();
        // Проверяем, пусты ли переменные email и id пользователя
    if (empty($_SESSION['email']) or empty($_SESSION['id']))
    {

    }
    else
    {
    //Если не пусты, то мы выводим ссылку
    	header('Location: http://localhost/page.php');
    	
    }
?>
<!DOCTYPE html>
<html lang="ru"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Авторизация</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Авторизация</h1>
      <form method="post" action="test_reg.php">
        <div>
          <i class="fa fa-user icon"></i>
          <p><input type="text"required name="email" value="" placeholder="Email"></p>
        </div>
       
        <p><input type="password"required name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
    <div class="login-help">
      <p>У вас нет аккаунта? <a href="reg.php">Нажмите для перехода на страницу регистрации</p>
    </div>
  </section>
</body>
</html>