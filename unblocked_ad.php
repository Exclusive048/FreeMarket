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
  $id_blockedAd = $_GET['id'];
  $result = mysql_query("UPDATE advert SET advertAction_ad='1' WHERE id_ad='$id_blockedAd'",$db);
  if($result=='TRUE')
  {
      header('Location: http://localhost/viewAds.php?id='.$id_blockedAd.''); 
  }
  else
  {
    echo $id_blockedAd;
  } 
?>