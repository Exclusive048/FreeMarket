<?php 
    header('Content-Type: text/html; charset=utf-8');
    session_start();
if (isset($_POST['email'])) 
{
    $email = $_POST['email']; 
    if ($email == '') 
    { 
    unset($email);
    } 
} 
    
    if (isset($_POST['password'])) 
        { 
            $password=$_POST['password']; 
            if ($password =='') 
                { 
                    unset($password);
                } 
        }
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $email = trim($email);
    $password = trim($password);
    include ("bd.php");
    $result = mysql_query("SELECT * FROM user WHERE email_user='$email'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    $myrow = mysql_fetch_array($result);
    if (empty($myrow['pass_user']))
    {
    exit ("Извините, введённый вами email или пароль неверный.1");
    var_dump($result);
    }
    else 
    {

    if ($myrow['pass_user']==$password) 
    {
    $_SESSION['email']=$myrow['email_user'];
    $_SESSION['password']=$myrow['pass_user']; 
    $_SESSION['id']=$myrow['id_user'];
    if($myrow['admin_user']=='1')
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
        exit ("Извините, введённый вами email или пароль неверный.2");
    }
    }
?>