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
  $id_admined = $_GET['id'];
  $result = mysql_query("UPDATE user SET admin_user='1' WHERE id_user='$id_admined'",$db);
  if($result=='TRUE')
  {
      header('Location: http://localhost/page_users.php?id='.$id_admined.''); 
  }
  else
  {
    echo $id_admined;
  } 
?>