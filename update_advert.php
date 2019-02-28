<?php
include ("config.php");
include ("bd.php");
if (!empty($_SESSION['email']) and !empty($_SESSION['password']))
{

    //если    существует логин и пароль в сессиях, то проверяем, действительны ли они
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
if (isset($_POST['itemInfo']) and isset($_FILES['itemImage']['tmp_name']) and isset($_POST['itemChanged']) and isset($_POST['nameAdvert']) )
{
    $idAd = $_POST['idAdvert'];
    $nameAd = $_POST['nameAdvert'];
    $itemInfo = $_POST['itemInfo'];
    $itemChanged = $_POST['itemChanged'];
    $checkPhone = $_POST['checkPhone']? 1 : 0;
    $checkEmail = $_POST['checkEmail']? 1 : 0;
    $checkAddress = $_POST['checkAddress']? 1 : 0;    
    if ($itemInfo == '' || $itemChanged == '' || $nameAd == '' ) 
    {    
      exit("Вы не заполнили поля");
    }  
    if (strlen($itemInfo) < 1 or strlen($itemInfo)    > 100) 
    {//проверяем    дину 
      exit ("Описание должно быть не менее 10 символов и не более 100."); //останавливаем выполнение сценариев
    }
    if (strlen($itemChanged) < 1 or strlen($itemChanged)    > 100) 
    {//проверяем    дину 
      exit ("Опишите желаемый предмет от 10 до 100 символов."); //останавливаем выполнение сценариев
    }
    $email = $_SESSION['email'];
    $result = mysql_query("SELECT * FROM user WHERE email_user='$email'",$db);
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['id_user'])) 
    {
      exit ("Пожалуйста зарегистрируйтесь в системе."); //останавливаем выполнение сценариев
    }
    else
    {
        $user_id=$myrow['id_user'];
        if (!empty($_FILES['itemImage']['tmp_name']))
        {
            $itemPhoto = addslashes(file_get_contents($_FILES['itemImage']['tmp_name']));
            $result4 = mysql_query("UPDATE advert  SET name_ad='$nameAd',description_ad='$itemInfo',photo_a='$itemPhoto',item_ad='$itemChanged',phone_ad='$checkPhone',email_ad='$checkEmail',address_ad='$checkAddress' WHERE id_ad='$idAd'",$db); 
        }
        else
        {
            $result4 = mysql_query("UPDATE advert  SET name_ad='$nameAd',description_ad='$itemInfo',item_ad='$itemChanged',phone_ad='$checkPhone',email_ad='$checkEmail',address_ad='$checkAddress' WHERE id_ad='$idAd'",$db); 
        }  
        if ($result4=='TRUE') 
        {
            if($myrow['admin_user']==1)
            {
               header('Location: http://localhost/adminProfile.php'); 
            }
            else
            {
               header('Location: http://localhost/page.php'); 
            }
        }
        else
        {
            echo var_dump($itemChanged);
            echo var_dump($checkPhone);
            echo var_dump($checkEmail);
            echo var_dump($checkAddress);
        }   
}}
?>