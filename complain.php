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
  $id_compAd=$_GET['id'];
  $result2 = mysql_query("SELECT * FROM advert WHERE id_ad='$id_compAd'",$db);
  $myrow2 = mysql_fetch_array($result2)

?>
<!DOCTYPE html>
<html lang="ru"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Жалоба</title>
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
            <form action='complained.php' method='post'>
                <div class="form-group">
                    <label>Название жалобы</label>
                    <input name='nameComp'required type="text" class="form-control" placeholder="Название жалобы" value="">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание жалобы</label>
                    <textarea class="form-control" required name="descComp" id="exampleFormControlTextarea1" placeholder="Описание жалобы" rows="5"></textarea>
                    <input type="hidden"  name="idAdvert" value="<?php  echo $id_compAd ?>">
                </div>

                <input type='submit' name='submit' value='Отправить'>
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