<?php 
header('Content-Type: text/html; charset=utf-8');
  include ("config.php");
  include ("bd.php");
  if (!empty($_SESSION['email']) and !empty($_SESSION['password']))
  {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $result2 = mysql_query("SELECT * FROM user WHERE email_user='$email' AND pass_user='$password'",$db); 
    $myrow2 = mysql_fetch_array($result2); 
    if (empty($myrow2['id_user']))
       {
        exit("Вход на эту страницу разрешен    только зарегистрированным пользователям!");
       }
  }
  else 
  {
    exit("Вход на эту    страницу разрешен только зарегистрированным пользователям!"); 
  }
  $old_email = $_SESSION['email'];
  $id = $_SESSION['id'];

  if (isset($_POST['email']))
    {
      $email = $_POST['email'];
      $email = stripslashes($email); 
      $email = htmlspecialchars($email); 
      $email = trim($email);
      if (strlen($email) < 3 or strlen($email)    > 50) 
      {
        exit ("Email должен    состоять не менее чем из 3 символов и не более чем из 50."); //останавливаем выполнение сценариев
      }
      $result = mysql_query("SELECT * FROM    user WHERE email_user='$email'",$db);
      $myrow = mysql_fetch_array($result);
      if (!empty($myrow['id'])) 
      {
        exit ("Извините, введённый вами email уже зарегистрирован. Введите другой email."); //останавливаем выполнение сценариев
      }
    } 
  if (isset($_POST['password'])) //Если существует    пароль
    {
      $password = $_POST['password'];
      $password = stripslashes($password);
      $password = htmlspecialchars($password);
      $password = trim($password);//удаляем все лишнее 
      if (strlen($password) < 3    or strlen($password) > 15) 
      {//проверка на    количество символов
        exit ("Пароль должен    состоять не менее чем из 3 символов и не более чем из 15."); //останавливаем выполнение сценариев
      }
      $result4 = mysql_query("UPDATE user SET pass_user='$password' WHERE email_user='$old_email'",$db);//обновляем пароль 
      if ($result4=='TRUE') 
      {//если верно, то обновляем его в сессии
      $_SESSION['password'] = $password;
    }
  if (isset($_POST['fio'])) //Если существует    пароль
  {
    $fio = $_POST['fio'];
    $fio = stripslashes($fio);
    $fio = htmlspecialchars($fio);
    $fio = trim($fio);//удаляем все лишнее 
    if (strlen($fio) <10    or strlen($fio) > 100) 
    {//проверка на    количество символов
      exit ("FIO должno    состоять не менее чем из 3 символов и не более чем из 100."); //останавливаем выполнение сценариев
    }
    $result4 = mysql_query("UPDATE user SET fio_user='$fio' WHERE email_user='$email'",$db);//обновляем пароль 
    }
  if (isset($_POST['phone'])) 
  {
    $phone = $_POST['phone'];
    $phone = stripslashes($phone);
    $phone = htmlspecialchars($phone);
    $phone = trim($phone);

    if (strlen($phone) <= 5    or strlen($phone) > 100) 
    {
      exit ("phone должno    состоять не менее чем из 3 символов и не более чем из 100."); 
    }
    $result4 = mysql_query("UPDATE user SET phone_user='$phone' WHERE email_user='$email'",$db); 
    }
  if (isset($_POST['info']))
  {
    $info = $_POST['info'];
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
    $info = trim($info); 

    if (strlen($info) <= 0    or strlen($info) > 200) 
      {
        exit ("info должno    состоять не менее чем из 3 символов и не более чем из 200.");
      }
    }
  if (isset($_POST['address'])) //Если существует    пароль
    {
        $address = $_POST['address'];
         $address = stripslashes($address);
        $address = htmlspecialchars($address);
        $address = trim($address);//удаляем все лишнее 
      if (strlen($address) <=0    or strlen($address) > 200) 
        {//проверка на    количество символов
          exit ("address должno    состоять не менее чем из 3 символов и не более чем из 200."); //останавливаем выполнение сценариев
        }
    }
  if (!empty($_FILES['userImage']['tmp_name']))
    {
    $image = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
      $result4 = mysql_query("UPDATE user SET email_user='$email',address_user='$address',info_user='$info',phone_user='$phone',fio_user='$fio',pass_user='$password',photo_user='$image' WHERE id_user='$id'",$db);//обновляем в базе email пользователя
      $_SESSION['email']=$email;
      if($result4=='TRUE')
      {
        if($myrow['admin_user']=='1')
          {
              header('Location: http://localhost/adminProfile.php');
          }
          else
          {
              header('Location: http://localhost/page.php');
          }
      }           
  }
  else
  {
      $result4 = mysql_query("UPDATE user SET email_user='$email',address_user='$address',info_user='$info',phone_user='$phone',fio_user='$fio',pass_user='$password' WHERE id_user='$id' ",$db);//обновляем в базе email пользователя
      $_SESSION['email']=$email;
      if($result4=='TRUE')
      {
        if($myrow['admin_user']=='1')
          {
              header('Location: http://localhost/adminProfile.php');
          }
          else
          {
              header('Location: http://localhost/page.php');
          }
      }    
  }     
}     
?>