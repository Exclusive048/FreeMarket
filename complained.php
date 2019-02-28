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
  $id_compAd = $_POST['idAdvert'];
  $result2 = mysql_query("SELECT * FROM advert WHERE id_ad='$id_compAd'",$db);
  $myrow2 = mysql_fetch_array($result2);
  $id_userAd = $myrow2['id_users'];
  $date=date("F j, Y"); 
  $nameC=$_POST['nameComp'];
  $descC=$_POST['descComp'];
  $result = mysql_query("INSERT INTO complain (id_advert,id_userAd,name_comp,description_comp,date_comp) VALUES ('$id_compAd','$id_userAd','$nameC','$descC','$date')");
  //$result = mysql_query("UPDATE complain SET id_advert = '$id_compAd',id_userAd =".$myrow2['id_users'].",name_comp='$nameC',description_comp='$descC',date_comp='$date' WHERE ")
  if($result=='TRUE')
  {
      header('Location: http://localhost/all_advert.php'); 
  }
  else
  {
    echo $date;
  } 
?>