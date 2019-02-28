    <!DOCTYPE html>
<html lang="ru"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Регистрация</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Регистрация</h1>
      <form method="post" action="save_user.php">
        <p><input type="text"required name="Fio" value="" placeholder="ФИО"></p>
        <p><input type="text"required name="email" value="" placeholder="Email"></p>
        <p><input type="password"required name="password" value="" placeholder="Password"></p>
        <p><input type="password"required name="password2" value="" placeholder="Confirm Password "></p>
        <p class="remember_me">

        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>
  </section>
</body>
</html>